<?php

namespace App\Model\Fastpack;

use App\Helpers\NotMappedHelper;
use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Http\Traits\SearchModel;
use App\Model\Fastpack\Help\ProspecaoChangeStatus;
use App\Model\Fastpack\Help\ProspecaoVendaPerdida;
use App\Model\Fastpack\Relationship\ProspecaoHasProduto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Prospeccao extends Model
{
	use  FastpackModelLog, SearchModel, NumbersOnly, SoftDeletes;

	public $incrementing = false;

	protected $primaryKey = 'codigo';
	protected $table = 'prospeccoes';
	protected $fillable = ['codigo','cliente_documento','data_contato','status','status_negociacao','observacoes','usuario_id','predio_id'];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['cliente_nome','usuario','status_nome','status_negociacao_nome','has_venda'];

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
			'prospeccoes.codigo',
			'clientes.documento' => 'getOnlyNumbers',
			'clientes.nome',
			'usuarios.usuario'
		),
		'joins' => [
			'clientes' => ['prospeccoes.cliente_documento', 'clientes.documento'],
			'usuarios' => ['prospeccoes.usuario_id','usuarios.id']
		]
	);

	public function getHasVendaAttribute(){
		return Venda::find($this->codigo) != null;
	}

	public function getDataContatoAttribute($value){
		return (new \DateTime($value))->format('d-m-Y');
	}

	public function getClienteNomeAttribute()
	{
		return DB::table("clientes")->select("nome")->where("documento",$this->cliente_documento)->first()->nome;
	}

	public function getClienteAttribute()
	{
		return [
			'nome' => DB::table("clientes")->select("nome")->where("documento",$this->cliente_documento)->first()->nome,
			'documento' => $this->cliente_documento
		];
	}

	public function getPredioAttribute(){
		$predio = DB::table("predios")->join('bairros','predios.bairro','=','bairros.id')
		             ->join('cidades','predios.cidade_id','=','cidades.id')->where('predios.id',$this->predio_id)
		             ->select("predios.nome","predios.is_empreendimento", DB::raw("CONCAT(logradouro,', ',numero, ' - ', bairros.nome,', ', cidades.nome, ' - ',cidades.uf) as endereco"))->first();
		if(isset($predio)){
			return [
				'predio_id' => $this->predio_id,
				'nome' => $predio->nome,
				'endereco' => $predio->endereco,
				'is_empreendimento' => $predio->is_empreendimento
			];
		}
		return [];
	}

	public function getIsEmpreendimentoAttribute(){
		$predio = DB::table("predios")->select('is_empreendimento')->where('predios.id',$this->predio_id)->first();
		return $predio->is_empreendimento;
	}

	public function getUsuarioAttribute(){
		if(isset($this->usuario_id))
			return DB::table("usuarios")->select("usuario")->where("id",$this->usuario_id)->first()->usuario;
		return "Não possui usuário";
	}

	public function getStatusNomeAttribute(){
		return NotMappedHelper::statusProspeccao($this->status);
	}

	public function getStatusNegociacaoNomeAttribute(){
		return NotMappedHelper::statusNegociacaoProspeccao($this->status_negociacao);
	}

	public function getVendaPerdidaAttribute(){
		if($this->status == 'P'){
			$motivo = ProspecaoVendaPerdida::where("codigo_prospec",$this->codigo)->first();
			if(isset($motivo)){
				$mot = DB::table("motivos_venda_perdida")->where('id',$motivo->motivo_id)->first();
				return ['id' => $motivo->motivo_id,'motivo' => $mot->motivo,"comentario" => $motivo->comentario];
			}
			return ['id' => '','motivo'=>'','comentario'=>''];
		}else
			return [];
	}

	public function getProdutosAttribute(){
		$produtos = [];
		$tipos = DB::table("tipos")->get();
		foreach ($tipos as $tipo){
			$prospec_prodduto = ProspecaoHasProduto::select(["produto_id","config"])->where([["codigo_prospec", $this->codigo],["tipo_id", $tipo->id]])->first();
			if(isset($prospec_prodduto)){
				$produtos[$tipo->slug] = [
					'tipo_id' => $tipo->id,
					'nome' => DB::table('produtos')->find($prospec_prodduto->produto_id)->nome,
					'produto_id' => $prospec_prodduto->produto_id,
					'config' => $prospec_prodduto->config
				];
			}
		}
		$produtos = (object)$produtos;
		return $produtos;
	}

	public function setDataContatoAttribute($value){
		$this->attributes['data_contato'] = (new \DateTime($value))->format('Y-m-d');
	}

	public static function criar($data, $ip)
	{
		$versao = Prospeccao::where("cliente_documento",$data["cliente_documento"])->whereDate("created_at",date("Y-m-d"))->count() + 1;
		if($versao > 99)
			return false;
		if($versao <= 9)
			$versao = '0'.$versao;
		$codigo = $data["cliente_documento"]."_".date("Ymd")."_".$versao;
		$dados_prospec = self::populateAttributes($data,true);
		$model = Prospeccao::firstOrCreate(
			[
				"codigo" => $codigo
			],
			$dados_prospec
		);
		ProspecaoHasProduto::where("codigo_prospec", $model->codigo)->delete();
		if (isset($data['produtos']) && $data['status'] != 'C') {
			foreach ($data['produtos'] as $item) {
				$produto = [
					"codigo_prospec" => $model->codigo,
					"tipo_id" => $item["tipo_id"],
					"produto_id" => $item["produto_id"],
					"config" => isset($item["config"]) ? $item["config"] : null,
				];
				ProspecaoHasProduto::criar($produto, $ip);
			}
		}
		if(isset($model->status) && $model->status == 'P'){
			$motivo = [
				"codigo_prospec" => $model->codigo,
				"motivo_id" => $data["venda_perdida"]["id"],
				"comentario" => isset($data["venda_perdida"]["comentario"]) ? $data["venda_perdida"]["comentario"] : null,
			];
			ProspecaoVendaPerdida::criar($motivo,$ip);
		}
		$model->saveLog($ip, 'insert',$dados_prospec);
		return $model;
	}

	public static function atualizar($data, $ip)
	{
		$old_status = Prospeccao::select('status')->where("codigo",$data['codigo'])->pluck('status')->first();
		$dados_prospec = self::populateAttributes($data);
		$model = Prospeccao::updateOrCreate(
			[
				"codigo" => $data["codigo"]
			],
			$dados_prospec
		);
		ProspecaoHasProduto::where("codigo_prospec", $model->codigo)->delete();
		if (isset($data['produtos']) && $data['status'] != 'C') {
			foreach ($data['produtos'] as $item) {
				$produto = [
					"codigo_prospec" => $model->codigo,
					"tipo_id" => $item["tipo_id"],
					"produto_id" => $item["produto_id"],
					//"config" => isset($item["config"]) ? $item["config"] : null,
				];
				ProspecaoHasProduto::criar($produto, $ip);
			}
		}
		if($old_status != $model->status){
			$change_status = [
				"codigo_prospec" => $model->codigo,
				"change_from" => $old_status,
			];
			ProspecaoChangeStatus::criar($change_status,$ip);
		}
		$model->saveLog($ip, 'update',$dados_prospec);
		return $model;
	}

	public static function show($codigo)
	{
		$prospeccao = Prospeccao::find($codigo);
		if(!isset($prospeccao))
			return null;
		$prospeccao->append(["produtos","venda_perdida","cliente","is_empreendimento"]);
		return $prospeccao;
	}

	public function reject(){
		$this->status = 'P';
		$this->save();
		$this->saveLog();
	}

	private static function populateAttributes($data, $create = false){
		$dados = array(
			"data_contato" => isset($data["data_contato"]) ? $data["data_contato"] : null,
			"status" => isset($data["status"]) ? $data["status"] : null,
			"status_negociacao" => isset($data["status_negociacao"]) ? $data["status_negociacao"] : null,
			"observacoes" => isset($data["observacoes"]) ? $data["observacoes"] : null,
			"usuario_id" => Auth::id(),
			"predio_id" => isset($data["predio_id"]) ? Venda::static_getOnlyNumbers($data["predio_id"]) : null,
		);
		if($create){
			$dados["cliente_documento"] = $data["cliente_documento"];
			$dados["predio_id"] = isset($data["predio_id"]) ? Venda::static_getOnlyNumbers($data["predio_id"]) : null;
			$dados["usuario_id"] = Auth::id();
		}
		return $dados;
	}
}
