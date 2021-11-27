<?php

namespace App\Model\Fastpack;

use App\Helpers\NotMappedHelper;
use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Http\Traits\SearchModel;
use App\Model\Fastpack\Help\Documento;
use App\Model\Fastpack\Help\Endereco;
use App\Model\Fastpack\Help\FilialContratada;
use App\Model\Fastpack\Relationship\PredioHasCliente;
use App\Model\Fastpack\Relationship\ProspecaoHasProduto;
use App\Model\Fastpack\Relationship\VendaHasProduto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Venda extends Model
{
	use FastpackModelLog, SearchModel, NumbersOnly, SoftDeletes;

	public $incrementing = false;
	protected $primaryKey = 'codigo';

	protected $table = 'vendas';
	protected $fillable = [
		'codigo','campanha','campanha_nome','contato_comercial','predio_id','endereco_predio','endereco_correspondencia', 'usuario_id','status','vencimento','email_fatura',
		'contratada_filial_id','observacoes','service_id','predio_cliente_complemento'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = ['endereco_predio','endereco_correspondencia','contato_comercial'];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['cliente_nome','usuario','status_nome'];

	public function setContatoComercialAttribute($value)
	{
		$this->attributes['contato_comercial'] = json_encode($value);
	}

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = array(
		/**
		 * Columns and their priority in search results.
		 * Columns with higher values are more important.
		 * Columns with equal values have equal importance.
		 *
		 * @var array
		 */
		'columns' => array(
			'vendas.codigo',
			'clientes.documento' => 'getOnlyNumbers',
			'clientes.nome',
			'usuarios.usuario'
		),
		'joins' => [
			'prospeccoes' => ['vendas.codigo','prospeccoes.codigo'],
			'clientes' => ['prospeccoes.cliente_documento','clientes.documento'],
			'usuarios' => ['vendas.usuario_id','usuarios.id'],
		]
	);

	public function setPredioClienteComplementoAttribute($value)
	{
		$this->attributes['predio_cliente_complemento'] = mb_strtoupper($value, "UTF-8");
	}

	public function getProdutos(){
		$produtos = [];
		$tipos = DB::table("tipos")->get();
		foreach ($tipos as $tipo){
			$venda_produto = VendaHasProduto::select(["produto_id","config"])->where([["codigo_venda", $this->codigo],["tipo_id", $tipo->id]])->first();
			if(isset($venda_produto)){
				$produtos[$tipo->slug] = [
					'tipo_id' => $tipo->id,
					'produto_id' => $venda_produto->produto_id,
					'nome' => DB::table('produtos')->find($venda_produto->produto_id)->nome,
					'config' => $venda_produto->config
				];
			}
		}
		return $produtos;
	}

	public function getProdutosAttribute(){
		$produtos = $this->getProdutos();
		if(sizeof($produtos) == 0){
			$this->restoreProdutos();
			$produtos = $this->getProdutos();
		}
		return $produtos;
	}

	public function getClienteNomeAttribute()
	{
		return DB::table('prospeccoes')->select("nome")->join('clientes','prospeccoes.cliente_documento','=','clientes.documento')->where("codigo",$this->codigo)->first()->nome;
	}

	public function getClienteDocumentoAttribute()
	{
		return DB::table('prospeccoes')->select("documento")->join('clientes','prospeccoes.cliente_documento','=','clientes.documento')->where("codigo",$this->codigo)->first()->documento;
	}

	public function getClienteAttribute()
	{
		$cliente = DB::table('prospeccoes')->select(["nome","documento","contato","clientes.status","clientes.data_verificacao"])->join('clientes','prospeccoes.cliente_documento','=','clientes.documento')->where("codigo",$this->codigo)->first();
		$predio_cliente = PredioHasCliente::where([['predio_id',$this->predio_id],['cliente_documento',$cliente->documento]])->first();
		return [
			'nome' => $cliente->nome,
			'documento' => $cliente->documento,
			'contato' => json_decode($cliente->contato),
			'complemento' => isset($predio_cliente) ? $predio_cliente->complemento : '',
			'status' => $cliente->status,
			'data_verificacao' => $cliente->data_verificacao
		];
	}

	public function getEnderecoPredioAttribute($value){
		return Endereco::find($value);
	}

	public function getEnderecoCorrespondenciaAttribute($value){
		return Endereco::find($value);
	}

	public function getContatoComercialAttribute($value){
		return json_decode($value);
	}

	public function getUsuarioAttribute(){
		if(isset($this->usuario_id))
			return DB::table("usuarios")->select("usuario")->where("id",$this->usuario_id)->first()->usuario;
		return "Não possui usuário";
	}

	public function getStatusNomeAttribute(){
		return NotMappedHelper::statusVenda($this->status);
	}

	public function getContratadaIdAttribute(){
		$filial = FilialContratada::find($this->contratada_filial_id);
		if(isset($filial))
			$filial = $filial->contratada_id;
		return $filial;
	}

	public function getContratadaFilialAttribute(){
		$filial_contratada = FilialContratada::find($this->contratada_filial_id);
		if(isset($filial_contratada))
			return $filial_contratada;
		return null;
	}

	public function getContratadaAttribute(){
		$filial_contratada = FilialContratada::find($this->contratada_filial_id);
		if(isset($filial_contratada)){
			$filial = DB::table('contratadas')->where('id',$filial_contratada->contratada_id)->first();
			if(isset($filial))
				return $filial;
		}
		return null;
	}

	public function getObservacoesAuditoriaAttribute(){
		$observacoes = DB::table('auditorias')->where('codigo',$this->codigo)->pluck('observacoes');
		return $observacoes;
	}

	public function getDocumentosAttribute() {
		$documentos = Documento::select(['documentos.nome as nome',"documentos.created_at as created_at",'usuarios.usuario as usuario'])
		                                     ->join('usuarios','documentos.usuario_id','=','usuarios.id')
		                                     ->where('codigo',$this->codigo)->orderByDesc('created_at')->get()->toArray();
		return $documentos;
	}

	public function getIsEmpreendimentoAttribute(){
		$predio = DB::table("predios")->select('is_empreendimento')->where('predios.id',$this->predio_id)->first();
		return $predio->is_empreendimento;
	}

	public static function criar($codigo, $ip)
	{
		$prospec = Prospeccao::find($codigo);
		$predio = DB::table('predios')->find($prospec->predio_id);
		$cliente = Cliente::find($prospec->cliente_documento);
		$predio_cliente = PredioHasCliente::where([['predio_id',$predio->id],['cliente_documento',$cliente->documento]])->first();
		$endereco_predio = [
			'cep' => $predio->cep,
			'logradouro' => $predio->logradouro,
			'numero' => $predio->numero,
			'complemento' => $predio->complemento,
			'bairro' => $predio->bairro,
			'cidade' => ['id' => $predio->cidade_id],
		];
		$dados_venda = [
			"usuario_id" => Auth::id(),
			'status' => 'E',
			'predio_id' => $predio->id,
			'observacoes' => $prospec->observacoes,
			'endereco_predio' => Endereco::salvar($endereco_predio,$ip)->id,
			'endereco_correspondencia' => Endereco::salvar($endereco_predio,$ip)->id,
			'contato_comercial' => ['nome'=>'','email'=>'','telefone'=>'','celular'=>''],
			'predio_cliente_complemento' => isset($predio_cliente->complemento) ? $predio_cliente->complemento : ''
		];
		$model = Venda::firstOrCreate(
			[
				"codigo" => $codigo
			],
			$dados_venda
		);
		$produtos = ProspecaoHasProduto::where("codigo_prospec", $model->codigo)->get();
		VendaHasProduto::where("codigo_venda",$model->codigo)->delete();
		foreach ($produtos as $produto){
			$item = [
				'codigo_venda' => $model->codigo,
				'tipo_id' => $produto->tipo_id,
				'produto_id' => $produto->produto_id,
				'config' => $produto->config
			];
			VendaHasProduto::criar($item,$ip);
		}
		$model->saveLog($ip, 'insert',$dados_venda);
		return $model;
	}

	public static function atualizar($data, $ip)
	{
		$venda = Venda::find($data['codigo']);
		if($venda->endereco_correspondencia)
			$data['endereco_correspondencia']['id'] = $venda->endereco_correspondencia->id;
		if(isset($data['predio_cliente_complemento'])){
			$predio = DB::table('predios')->find($venda->predio_id);
			if(!$predio->is_empreendimento)
				PredioHasCliente::atualizar(['predio_id' => $venda->predio_id, 'cliente_documento' => $venda->cliente['documento'],'complemento' => $data['predio_cliente_complemento']],$ip);
		}
		$dados_venda = [
			"contato_comercial" => isset($data["contato_comercial"]) ? $data["contato_comercial"] : null,
			'endereco_correspondencia' => Endereco::salvar($data['endereco_correspondencia'],$ip)->id,
			'vencimento' => isset($data['vencimento']) ? $data['vencimento'] : null,
			'email_fatura' => isset($data['email_fatura']) ? $data['email_fatura'] : null,
			'status' => isset($data['status']) ? $data['status'] : 'E',
			'contratada_filial_id' => isset($data['contratada_filial']['id']) ? $data['contratada_filial']['id'] : null,
			"observacoes" => isset($data['observacoes']) ? $data['observacoes'] : null,
			"campanha" => isset($data['campanha']) ? $data['campanha'] : '',
			"campanha_nome" => isset($data['campanha_nome']) ? $data['campanha_nome'] : '',
			"predio_cliente_complemento" => isset($data['predio_cliente_complemento']) ? $data['predio_cliente_complemento'] : ''
		];
		$model = Venda::updateOrCreate(
			[
				"codigo" => $data["codigo"]
			],
			$dados_venda
		);
		if (isset($data['produtos']) && sizeof($data['produtos']) > 0 ) {
			VendaHasProduto::where("codigo_venda",$model->codigo)->delete();
			foreach ($data['produtos'] as $produto){
				$item = [
					'codigo_venda' => $model->codigo,
					'tipo_id' => $produto['tipo_id'],
					'produto_id' => $produto['produto_id'],
					'config' => isset($produto['config']) ? $produto['config'] : null,
				];
				VendaHasProduto::criar($item,$ip);
			}
		}
		$model->saveLog($ip, 'update',$dados_venda);
		return $model;
	}

	public static function show($codigo)
	{
		$venda = Venda::find($codigo);
		if(!isset($venda))
			return null;
		$venda->append(["produtos",'cliente','contratada_filial','contratada','observacoes_auditoria','documentos','is_empreendimento']);
		$venda->makeVisible(["endereco_predio","endereco_correspondencia","contato_comercial"]);
		return $venda;
	}

	public function reject(){
		$this->status = 'C';
		$this->save();
	}

	public function rejeitar($ip){
		$this->status = "A";
		$this->save();
		$this->saveLog($ip,'update',['status' => "A"]);
	}

	public function aprovar($service_id,$ip){
		$this->status = "F";
		$this->service_id = $service_id;
		$this->save();
		$this->saveLog($ip,'update',['status' => "F","service_id" => $service_id]);
	}

	public static function getNomeCliente($codigo){
		return DB::table('prospeccoes')->select('clientes.nome as nome')->join('clientes','prospeccoes.cliente_documento', '=','clientes.documento')
		         ->where('codigo',$codigo)->first()->nome;
	}

	public function getDadosVenda(){

		$pacote = DB::table('produtos')->where('id',$this->produtos['pacotes']['produto_id'])->limit(1)->first()->nome;
		$internet = $this->getInternet();
		$voz = $this->getVoz();
		$predio = DB::table('predios')->where('id',$this->predio_id)->limit(1)->first();
		$prospeccao = Prospeccao::find($this->codigo);
		$cliente = Cliente::find($prospeccao->cliente_documento);

		$produto_0800 = $this->get0800();
		$smartbox = $this->getSmartBox();
		$cloudbackup = $this->getBackup();

		$vendedor = DB::table("usuarios")->where("id",$this->usuario_id)->first();

		$dados_venda = array(

			//VENDA
			"sell_id" => $this->codigo,
			"vencimento" => $this->vencimento,
			"vendedor" => $vendedor->name,
			"observacoes" => $this->observacoes,
			"predio_abordado" => $predio->abordado,
			"end_corr_email" => $this->email_fatura,

			//CLIENTE
			"documento_cliente" => $cliente->documento,
			"tipo_cliente" => strlen($cliente->documento) == 11 ? 'PF' : 'PJ',
			"ie" => $cliente->inscricao_estadual,
			"nome_cliente" => $cliente->nome,

			"end_cliente_cep"                  => $cliente->endereco->cep,
			"end_cliente_street"               => $cliente->endereco->logradouro,
			"end_cliente_number"               => $cliente->endereco->numero,
			"end_cliente_complemento"          => $cliente->endereco->complemento,
			"end_cliente_state"                => $cliente->endereco->uf['uf'],
			"end_cliente_city"                 => $cliente->endereco->cidade->nome,
			"end_cliente_bairro"               => $cliente->endereco->bairro,

			//CONTATO
			"cont_com_nome" => $this->contato_comercial->nome,
			"cont_com_email" => $this->contato_comercial->email,
			"cont_com_fixo" => $this->contato_comercial->telefone,
			"cont_com_cel" => $this->contato_comercial->celular,

			"cidade" => $this->endereco_predio->cidade->abr,
			"campanha" => $this->campanha,
			"campanha_nome" => $this->campanha_nome,
			"pacote" => $pacote,

			//ENDEREÇO INSTALAÇÃO
			"predio_id"                 => $this->predio_id,
			"inst_cep"                  => $this->endereco_predio->cep,
			"inst_street"               => $this->endereco_predio->logradouro,
			"inst_number"               => $this->endereco_predio->numero,
			"inst_complemento"          => $this->endereco_predio->complemento,
			"inst_complemento_cliente"  => $this->predio_cliente_complemento,
			"inst_state"                => $this->endereco_predio->uf['uf'],
			"inst_city"                 => $this->endereco_predio->cidade->nome,
			"inst_bairro"               => $this->endereco_predio->bairro,

			//ENDEREÇO CORRESPONDÊNCIA
			"end_corr_cep"      => $this->endereco_correspondencia->cep,
			"end_corr_rua"      => $this->endereco_correspondencia->logradouro,
			"end_corr_num"      => $this->endereco_correspondencia->numero,
			"end_corr_comp"     => $this->endereco_correspondencia->complemento,
			"end_corr_estado"   => $this->endereco_correspondencia->uf['uf'],
			"end_corr_cidade"   => $this->endereco_correspondencia->cidade->nome,
			"end_corr_bairro"   => $this->endereco_correspondencia->bairro,

			//INTERNET
			"has-internet" => $internet['has_internet'],
			"internet_preco" => $internet['valor'],
			"internet_desconto" => $internet['desconto'],
			"internet_desconto_periodo" => $internet['ciclos'],

			//VOZ
			"has-voz" => $voz['has_voz'],
			"voz_preco" => $voz['valor'],
			"voz_desconto" => $voz['desconto'],
			"voz_desconto_periodo" => $voz['ciclos'],
			"voz_tecnologia" =>$voz['tecnologia'],
			"voz_tecnologia_sinalizacao" => $voz['tec_sinalizacao'],
			"voz_quantidade_linhas" => $voz['quant_linhas'],
			"voz_faixa_numeracao" => $voz['faixa_numeracao'],


			//0800
			"has-0800" => $produto_0800['has_0800'],
			"0800_preco" => $produto_0800['valor'],
			"0800_desconto" => $produto_0800['desconto'],
			"0800_desconto_periodo" => $produto_0800['quantidade_ciclos'],
			"0800_numero" => $produto_0800['numero_0800'],
			"0800_encaminhamento" => $produto_0800['numero_encaminhamento'],
			"0800_portado" => $produto_0800['portado'], //sim ou não
			"0800_operadora_doadora" => $produto_0800['operadora_doadora'],


			//SMARTBOX
			"has-smartbox" => $smartbox['has_smart'],
			"smartbox_preco" => $smartbox['valor'],
			"smartbox_desconto" => $smartbox['desconto'],
			"smartbox_qtd_ramais" => $smartbox['quantidade_ramais'],
			"smartbox_desconto_periodo" => $smartbox['quantidade_ciclos'],

			//BACKUP
			"has-backup" => $cloudbackup['has_backup'],
			"pacote_backup" => $cloudbackup['pacote_backup'],
			"backup_preco" => $cloudbackup['valor'],
			"backup_desconto" => $cloudbackup['desconto'],
			"backup_desconto_periodo" => $cloudbackup['quantidade_ciclos'],
			"backup_login" => $cloudbackup['backup_login'],
		);

		if(getenv('APP_ENV') != "prod"){
			$dados_venda["env"] = "dev";
		}
		return $dados_venda;
	}

	public function getInternet(){
		$internet = array(
			'has_internet'  => 'nao',
			'valor'         => '',
			'desconto'      => '',
			'ciclos'        => ''
		);
		if(isset($this->produtos['pacotes']['config']->internet)){
			$int = $this->produtos['pacotes']['config']->internet;
			$desconto_internet = self::getDesconto($int);
			$internet = array(
				'has_internet'  => 'sim',
				'valor'         => $int->valor != '' ? number_format($int->valor,2,'.','') : '',
				'desconto'      => $desconto_internet,
				'ciclos'        => isset($int->quantidade_ciclos) ? $int->quantidade_ciclos : ''
			);
		}
		return $internet;
	}

	public function getVoz(){
		$voz = array(
			'has_voz'           => 'nao',
			'valor'             => '',
			'desconto'          => '',
			'ciclos'            => '',
			'tecnologia'        => '',
			'tec_sinalizacao'   => '',
			'quant_linhas'      => '',
			'faixa_numeracao'   => ''
		);
		if(isset($this->produtos['pacotes']['config']->voz)){
			$v = $this->produtos['pacotes']['config']->voz;
			$desconto_voz = self::getDesconto($v);
			$voz = array(
				'has_voz'           => 'sim',
				'valor'         => $v->valor != '' ? number_format($v->valor,2,'.','') : '',
				'desconto'      => $desconto_voz,
				'ciclos'        => isset($v->quantidade_ciclos) ? $v->quantidade_ciclos : '',
				'tecnologia'        => isset($v->tecnologia) ? $v->tecnologia : '',
				'tec_sinalizacao'   => isset($v->tecnologia_sinalizacao) ? $v->tecnologia_sinalizacao : '',
				'quant_linhas'      => isset($v->quantidade_linhas) ? $v->quantidade_linhas : '',
				'faixa_numeracao'   => isset($v->faixa_numeracao) ? $v->faixa_numeracao : ''
			);
		}
		return $voz;
	}

	public function get0800(){
		$produto_0800 = array(
			'has_0800' => 'nao',
			'numero_0800' => '',
			'numero_encaminhamento' => '',
			'portado' => '',
			'operadora_doadora' => '',
			'valor' => '',
			'desconto' => '',
			'quantidade_ciclos' => '',
		);
		if(isset($this->produtos['0800'])){
			$p_0800 = $this->produtos['0800']['config'];
			$desconto_0800 = self::getDesconto($p_0800);
			$produto_0800 = array(
				'has_0800' => 'sim',
				'numero_0800' => isset($p_0800->numero_0800) ? $p_0800->numero_0800 : '',
				'numero_encaminhamento' => isset($p_0800->numero_encaminhamento) ? $p_0800->numero_encaminhamento : '',
				'portado' => isset($p_0800->portado) ? $p_0800->portado : 'não',
				'operadora_doadora' => isset($p_0800->portado) && $p_0800->portado == 'sim' && isset($p_0800->operadora_doadora) ? $p_0800->operadora_doadora : '',
				'valor' => $p_0800->valor != '' ? number_format($p_0800->valor,2,'.','') : '',
				'desconto' => $desconto_0800,
				'quantidade_ciclos' => isset($p_0800->quantidade_ciclos) ? $p_0800->quantidade_ciclos : '',
			);
		}
		return $produto_0800;
	}

	public function getSmartBox(){
		$smart = array(
			'has_smart'         => 'nao',
			'valor'             => '',
			'desconto'          => '',
			'quantidade_ciclos' => '',
			'quantidade_ramais' => '',
			'valor_ramal'       => ''
		);
		if(isset($this->produtos['smartbox'])){
			$sb = $this->produtos['smartbox']['config'];
			$valor_ramal = $sb->valor;
			if(isset($sb->quantidade_ramais))
				$sb->valor = $sb->quantidade_ramais * $sb->valor;
			$desconto_sb = self::getDesconto($sb);
			$smart = array(
				'has_smart'         => 'sim',
				'valor'             => $sb->valor != '' ? number_format($sb->valor,2,'.','') : '',
				'desconto'          => $desconto_sb,
				'quantidade_ciclos' => isset($sb->quantidade_ciclos) ? $sb->quantidade_ciclos : '',
				'quantidade_ramais' => isset($sb->quantidade_ramais) ? $sb->quantidade_ramais : '',
				'valor_ramal'       => isset($valor_ramal) ? $valor_ramal : ''
			);
		}
		return $smart;
	}

	public function getBackup(){
		$smart = array(
			'has_backup'        => 'nao',
			'pacote_backup'     => '',
			'valor'             => '',
			'desconto'          => '',
			'quantidade_ciclos' => '',
			'backup_login'      => ''
		);
		if(isset($this->produtos['cloudbackup'])){
			$cb = $this->produtos['cloudbackup']['config'];
			$pacote_bkp = DB::table('produtos')->where('id',$this->produtos['cloudbackup']['produto_id'])->limit(1)->first();
			$bkp_nome = isset($pacote_bkp) ? $pacote_bkp->nome : '';
			$desconto_cb = self::getDesconto($cb);
			$smart = array(
				'has_backup'        => 'sim',
				'pacote_backup'     => $bkp_nome,
				'valor'             => $cb->valor != '' ? number_format($cb->valor,2,'.','') : '',
				'desconto'          => $desconto_cb,
				'quantidade_ciclos' => isset($cb->quantidade_ciclos) ? $cb->quantidade_ciclos : '',
				'backup_login'      => $cb->email
			);
		}
		return $smart;
	}

	public static function getDesconto($produto){
		$retorno = '';
		if(isset($produto->desconto) && $produto->desconto != ''){
			if(isset($produto->is_percent) && $produto->is_percent == true){
				$desconto = $produto->valor * ( 0.01 * $produto->desconto);
				$desconto = $desconto <= $produto->valor ? $desconto : $produto->valor;
				$retorno = $desconto  > 0 ? number_format($desconto,2,'.',''): "0.00";
			}else{
				$retorno = $produto->desconto > 0 ? ($produto->desconto <= $produto->valor ? number_format($produto->desconto, 2, '.','') : number_format($produto->valor, 2, '.','')) : "0.00";
			}
		}
		return $retorno;
	}

	public function getDadosContrato(){
		$dados_documento = array();
		$cliente = Cliente::find($this->cliente_documento);
		$contratada_id = '';
		if(isset($this->contratada)){
			$contratada_id = $this->contratada->id;
			$dados_documento['contratada'] = $this->contratada->nome;
		}
		else{
			$contratada = DB::table('contratadas')->first();
			if(isset($contratada)){
				$contratada_id = $contratada->id;
				$dados_documento['contratada'] = $contratada->nome;
			}
			$dados_documento['contratada'] = '';
		}
		$filiais = FilialContratada::where('contratada_id',$contratada_id)->select(["id","cnpj","nome","endereco"])->get();
		$dados_documento['filiais'] = array();
		foreach ($filiais as $filial){
			$current_filial = array(
				'selected' => '0',
				'nome' => $filial->nome,
				'cnpj' => $filial->cnpj,
				'endereco' => $filial->endereco->logradouro.','.$filial->endereco->numero.(($filial->endereco->complemento != '') ? (', '.$filial->endereco->complemento) : '').' - '.$filial->endereco->bairro.' - CEP: '. $filial->endereco->cep
			);
			if(isset($this->contratada_filial_id) && $this->contratada_filial_id == $filial->id)
				$current_filial['selected'] = '1';
			$dados_documento['filiais'][] = $current_filial;
		}
		$dados_documento['cliente'] = array(
			'nome' => isset($cliente->nome) ? $cliente->nome : '',
			'documento' => isset($cliente->documento) ? $cliente->documento : '',
			'ie' => isset($cliente->inscricao_estadual) ? $cliente->inscricao_estadual : '',
			'logradouro' => isset($cliente->endereco->logradouro) ? $cliente->endereco->logradouro : '',
			'numero' => isset($cliente->endereco->numero) ? $cliente->endereco->numero : '',
			'complemento' => isset($cliente->endereco->complemento) ? $cliente->endereco->complemento : '',
			'bairro' => isset($cliente->endereco->bairro) ? $cliente->endereco->bairro : '',
			'cep' => isset($cliente->endereco->cep) ? $cliente->endereco->cep : '',
			'cidade' => isset($cliente->endereco->cidade->nome) ? $cliente->endereco->cidade->nome : '',
			'uf' => isset($cliente->endereco->uf['uf']) ? $cliente->endereco->uf['uf'] : '',
		);
		$dados_documento['fatura'] = array(
			'vencimento' => isset($this->vencimento) ? $this->vencimento : '',
			'email_fatura' => isset($this->email_fatura) ? $this->email_fatura : '',
			'logradouro' => isset($this->endereco_correspondencia->logradouro) ? $this->endereco_correspondencia->logradouro : '',
			'numero' => isset($this->endereco_correspondencia->numero) ? $this->endereco_correspondencia->numero : '',
			'complemento' => isset($this->endereco_correspondencia->complemento) ? $this->endereco_correspondencia->complemento : '',
			'bairro' => isset($this->endereco_correspondencia->bairro) ? $this->endereco_correspondencia->bairro : '',
			'cep' => isset($this->endereco_correspondencia->cep) ? $this->endereco_correspondencia->cep : '',
			'cidade' => isset($this->endereco_correspondencia->cidade->nome) ? $this->endereco_correspondencia->cidade->nome : '',
			'uf' => isset($this->endereco_correspondencia->uf['uf']) ? $this->endereco_correspondencia->uf['uf'] : '',
		);
		$dados_documento['endereco_predio'] = array(
			'logradouro' => isset($this->endereco_predio->logradouro) ? $this->endereco_predio->logradouro : '',
			'numero' => isset($this->endereco_predio->numero) ? $this->endereco_predio->numero : '',
			'complemento' => isset($this->endereco_predio->complemento) ? $this->endereco_predio->complemento : '',
			'bairro' => isset($this->endereco_predio->bairro) ? $this->endereco_predio->bairro : '',
			'cep' => isset($this->endereco_predio->cep) ? $this->endereco_predio->cep : '',
			'cidade' => isset($this->endereco_predio->cidade->nome) ? $this->endereco_predio->cidade->nome : '',
			'uf' => isset($this->endereco_predio->uf['uf']) ? $this->endereco_predio->uf['uf'] : '',
			'complemento_cliente' => isset($this->predio_cliente_complemento) ? $this->predio_cliente_complemento : '',
		);
		$contato_comercial = array(
			'nome' => isset($this->contato_comercial->nome) ? $this->contato_comercial->nome : '',
			'email' => isset($this->contato_comercial->email) ? $this->contato_comercial->email : '' ,
			'telefone' => isset($this->contato_comercial->telefone) ? $this->contato_comercial->telefone : '',
			'celular' => isset($this->contato_comercial->celular) ? $this->contato_comercial->celular : ''
		);
		$dados_documento['contato_comercial'] = $contato_comercial;
		$dados_documento['codigo'] = $this->codigo;
		$dados_documento['consultor'] = DB::table("usuarios")->select("name")->where("id",$this->usuario_id)->first()->name;
		$dados_documento['data'] = date("d/m/Y H:i:s");
		$dados_documento['cod_campanha'] = isset($this->campanha) ? $this->campanha : '';
		$dados_documento['campanha_nome'] = isset($this->campanha_nome) ? $this->campanha_nome : '';
		$config = DB::table('configuracoes')->first();
		$dados_documento['observacoes_gerais'] = isset($config) ? $config->texto_legal : '';
		$dados_documento['venda'] = array(
			'campanha' => $this->campanha,
			'pacotes' => array(
				'pacote' => $this->produtos['pacotes']['produto_id']
			),
			'contratada_filial_id' => isset($this->contratada_filial_id) ? $this->contratada_filial_id : ''
		);
		$internet = $this->getInternet();
		$voz = $this->getVoz();
		$_0800 = $this->get0800();
		$smartbox = $this->getSmartBox();
		$backup = $this->getBackup();
		$dados_documento['piloto'] = '';
		$dados_documento['identificacao'] = '';
		if($voz['has_voz'] == 'sim'){
			if($voz['tecnologia'] != "Analógica"){
				$dados_documento['piloto'] = isset($voz['faixa_numeracao']->piloto) ? $voz['faixa_numeracao']->piloto : '';
				$dados_documento['identificacao'] = isset($voz['faixa_numeracao']->identificacao) ? $voz['faixa_numeracao']->identificacao : '';
			}
			$dados_documento['voz'] = array();
			for ($i = 0; $i < 5;$i++){
				if(isset($voz['faixa_numeracao']->lista_numeros[$i])){
					$dados_documento['voz'][] = array(
						'faixa' => 'Faixa '.($i+1),
						'portado' => isset($voz['faixa_numeracao']->lista_numeros[$i]->portado) ? $voz['faixa_numeracao']->lista_numeros[$i]->portado : '',
						'inicial' => isset($voz['faixa_numeracao']->lista_numeros[$i]->inicial) ? $voz['faixa_numeracao']->lista_numeros[$i]->inicial : '',
						'final' => isset($voz['faixa_numeracao']->lista_numeros[$i]->final) ? $voz['faixa_numeracao']->lista_numeros[$i]->final : '',
						'operadora_doadora' => isset($voz['faixa_numeracao']->lista_numeros[$i]->operadora_doadora) ? $voz['faixa_numeracao']->lista_numeros[$i]->operadora_doadora : ''
					);
				}else{
					$dados_documento['voz'][] = array(
						'faixa' => 'Faixa '.($i+1),
						'portado' => '',
						'inicial' => '',
						'final' => '',
						'operadora_doadora' => ''
					);
				}
			}
		}

		$pacote = array(
			'nome'                      => '',
			'extra'                     => '',
			'num_linhas'                => '',
			'linha'                     => '',
			'valor_base_internet'       => '',
			'valor_base_voz'            => '',
			'desconto_internet'         => '',
			'desconto_voz'              => '',
			'valor_liquido_internet'    => '',
			'valor_liquido_voz'         => '',
			'periodo_internet'          => '',
			'periodo_voz'               => '',
		);
		if(isset($this->produtos['pacotes']['produto_id'])){
			$pacote_db = DB::table('produtos')->select(['produtos.nome','produtos.extra'])
			               ->where('produtos.id','=',$this->produtos['pacotes']['produto_id'])->first();
			if(isset($pacote_db)){
				$pacote['nome'] = $pacote_db->nome;
				$pacote['extra'] = $pacote_db->extra;
				if($internet['has_internet'] == 'sim'){
					$pacote['valor_liquido_internet'] = 'R$ '.number_format(floatval($internet['valor']) - floatval($internet['desconto']),2,'.','');
					$pacote['valor_base_internet'] = 'R$ '.number_format(floatval($internet['valor']),2,'.','');
					$pacote['desconto_internet'] = 'R$ '.number_format(floatval($internet['desconto']),2,'.','');
					$pacote['periodo_internet'] = $internet['ciclos'];
				}
				if($voz['has_voz'] == 'sim'){
					$pacote['valor_liquido_voz'] = 'R$ '.number_format(floatval($voz['valor']) - floatval($voz['desconto']),2,'.','');
					$pacote['valor_base_voz'] = 'R$ '.number_format(floatval($voz['valor']),2,'.','');
					$pacote['desconto_voz'] = 'R$ '.number_format(floatval($voz['desconto']),2,'.','');
					$pacote['periodo_voz'] = $voz['ciclos'];
					$pacote['num_linhas'] = $voz['quant_linhas'];
					if(Str::slug($voz['tecnologia']) == 'analogica')
						$pacote['linha'] = 'Analógicas';
					if(Str::slug($voz['tecnologia']) == 'sip')
						$pacote['linha'] = 'Canais SIP';
					if(Str::slug($voz['tecnologia']) == 'digital')
						$pacote['linha'] = 'Canais R2/ISDN';
				}
			}
		}

		$dados_documento['cloud_selected'] = '0';
		$dados_documento['pacote_cloud'] = '';
		$dados_documento['cloud_bkp_valor'] = '';
		$dados_documento['cloud_bkp_desconto'] = '';
		$dados_documento['cloud_bkp_liquido'] = '';
		$dados_documento['periodo_cloud_bkp'] = '';
		$dados_documento['email_cloud_bkp'] = '';
		if($backup['has_backup'] == 'sim'){
			$cloudbackup = DB::table('produtos')->select(['produtos.nome',])
			               ->where('produtos.id','=',$this->produtos['cloudbackup']['produto_id'])->first();
			if(isset($cloudbackup)){
				$dados_documento['cloud_selected'] = '1';
				$dados_documento['pacote_cloud'] = $cloudbackup->nome;
				$dados_documento['email_cloud_bkp'] = isset($backup['backup_login']) ? $backup['backup_login'] : '';
				$dados_documento['cloud_bkp_valor'] = 'R$ '.number_format(floatval($backup['valor']),2,'.','');
				$dados_documento['cloud_bkp_desconto'] = 'R$ '.number_format(floatval($backup['desconto']),2,'.','');
				$dados_documento['cloud_bkp_liquido'] = 'R$ '.number_format(floatval($backup['valor']) - floatval($backup['desconto']),2,'.','');
				$dados_documento['periodo_cloud_bkp'] = $backup['quantidade_ciclos'];
			}
		}

		$dados_documento['smart_box_selected'] = '0';
		$dados_documento['smart_box_qtd'] = '';
		$dados_documento['smart_box_total'] = '';
		$dados_documento['smart_box_desconto'] = '';
		$dados_documento['smart_box_valor'] = '';
		$dados_documento['periodo_smart_box'] = '';
		if($smartbox['has_smart'] == 'sim'){
			$dados_documento['smart_box_selected'] = '1';
			$dados_documento['smart_box_qtd'] = isset($smartbox['quantidade_ramais']) ? $smartbox['quantidade_ramais'] : '';
			$dados_documento['smart_box_total'] = 'R$ '.number_format(floatval($smartbox['valor']) - floatval($smartbox['desconto']),2,'.','');
			$dados_documento['smart_box_desconto'] = 'R$ '.number_format(floatval($smartbox['desconto']),2,'.','');
			$dados_documento['smart_box_valor'] = 'R$ '.number_format(floatval($smartbox['valor_ramal']),2,'.','');
			$dados_documento['periodo_smart_box'] = $smartbox['quantidade_ciclos'];
		}

		$dados_documento['p_0800_selected'] = '0';
		$dados_documento['p_0800_texto'] = '0800';
		$dados_documento['p_0800_numero'] = '';
		$dados_documento['p_0800_numero_encaminhamento'] = '';
		$dados_documento['p_0800_portado'] = '';
		$dados_documento['p_0800_operadora_doadora'] = '';
		$dados_documento['p_0800_total'] = '';
		$dados_documento['p_0800_desconto'] = '';
		$dados_documento['p_0800_valor'] = '';
		$dados_documento['periodo_0800'] = '';
		if($_0800['has_0800'] == 'sim'){
			$dados_documento['p_0800_selected'] = '1';
			$dados_documento['p_0800_texto'] = '0800 - R$ '.number_format(floatval($_0800['valor']) - floatval($_0800['desconto']),2,'.','');
			$dados_documento['p_0800_numero'] = isset($_0800['numero_0800']) ? $_0800['numero_0800'] : '';
			$dados_documento['p_0800_numero_encaminhamento'] = isset($_0800['numero_encaminhamento']) ? $_0800['numero_encaminhamento'] : '';
			$dados_documento['p_0800_portado'] = isset($_0800['portado']) ? $_0800['portado'] : '';
			$dados_documento['p_0800_operadora_doadora'] = isset($_0800['operadora_doadora']) ? $_0800['operadora_doadora'] : '';
			$dados_documento['p_0800_total'] = 'R$ '.number_format(floatval($_0800['valor']) - floatval($_0800['desconto']),2,'.','');
			$dados_documento['p_0800_desconto'] = 'R$ '.number_format(floatval($_0800['desconto']),2,'.','');
			$dados_documento['p_0800_valor'] = 'R$ '.number_format(floatval($_0800['valor']),2,'.','');
			$dados_documento['periodo_0800'] = $_0800['quantidade_ciclos'];

		}
		$dados_documento['pacotes'] = $pacote;

		return $dados_documento;
	}

	public function getDadosChecklist(){
		$_0800 = $this->get0800();
		$smartbox = $this->getSmartBox();
		if($_0800['has_0800'] == 'sim' && $smartbox['has_smart'] == 'sim'){
			$cliente = Cliente::find($this->cliente_documento);
			$dados_documento = array(
				'cliente_nome' => $cliente->nome,
				'cliente_documento' => $cliente->documento,
				'logradouro' => isset($this->endereco_predio->logradouro) ? $this->endereco_predio->logradouro : '',
				'numero' => isset($this->endereco_predio->numero) ? $this->endereco_predio->numero : '',
				'complemento' => isset($this->endereco_predio->complemento) ? $this->endereco_predio->complemento : '',
				'bairro' => isset($this->endereco_predio->bairro) ? $this->endereco_predio->bairro : '',
				'cep' => isset($this->endereco_predio->cep) ? $this->endereco_predio->cep : '',
				'cidade' => isset($this->endereco_predio->cidade->nome) ? $this->endereco_predio->cidade->nome : '',
				'uf' => isset($this->endereco_predio->uf['uf']) ? $this->endereco_predio->uf['uf'] : '',
				'complemento_cliente' => isset($this->predio_cliente_complemento) ? $this->predio_cliente_complemento : '',
				'contato_nome' => isset($this->contato_comercial->nome) ? $this->contato_comercial->nome : '',
				'contato_email' => isset($this->contato_comercial->email) ? $this->contato_comercial->email : '' ,
				'contato_telefone' => isset($this->contato_comercial->telefone) ? $this->contato_comercial->telefone : '',
				'contato_celular' => isset($this->contato_comercial->celular) ? $this->contato_comercial->celular : '',
				'numero_0800' => isset($_0800['numero_0800']) ? $_0800['numero_0800'] : '',
				'numero_encaminhamento' => isset($_0800['numero_encaminhamento']) ? $_0800['numero_encaminhamento'] : '',
			);
			return $dados_documento;
		}else{
			return false;
		}
	}

	public function restoreProdutos(){
		$produtos = ProspecaoHasProduto::where("codigo_prospec", $this->codigo)->get();
		VendaHasProduto::where("codigo_venda",$this->codigo)->delete();
		foreach ($produtos as $produto){
			$item = [
				'codigo_venda' => $this->codigo,
				'tipo_id' => $produto->tipo_id,
				'produto_id' => $produto->produto_id,
				'config' => $produto->config
			];
			VendaHasProduto::criar($item,'');
		}
	}
}
