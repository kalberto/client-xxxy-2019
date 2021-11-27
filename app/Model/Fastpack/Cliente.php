<?php

namespace App\Model\Fastpack;

use App\Helpers\AuthHelper;
use App\Helpers\HTTAPI;
use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Http\Traits\SearchModel;
use App\Model\Fastpack\Help\Endereco;
use App\Model\Fastpack\Relationship\PredioHasCliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
	use FastpackModelLog, SearchModel, NumbersOnly;

	public $incrementing = false;

	protected $primaryKey = 'documento';
	protected $table = 'clientes';
	protected $fillable = ['documento','nome','contato','inscricao_estadual','data_verificacao','endereco'];

	protected $hidden = ["endereco"];

	protected $casts = [
		// 'contato' => 'json'
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['predios_index'];

	public function setNomeAttribute($value)
	{
		$this->attributes['nome'] = mb_strtoupper($value, "UTF-8");
	}

	public function setInscricaoEstadualAttribute($value)
	{
		if(!isset($value) || $value == '')
			$this->attributes['inscricao_estadual'] = "ISENTO";
		else
			$this->attributes['inscricao_estadual'] = mb_strtoupper($value, "UTF-8");
	}

	public function setContatoAttribute($value)
	{
		$this->attributes['contato'] = json_encode($value);
	}

	public function getContatoAttribute($value)
	{
		if (isset($value))
			return json_decode($value);
		return [];
	}

	public function getPrediosIndexAttribute()
	{
		$predios = DB::table("predios_has_clientes")->select(DB::RAW("concat('PREDIO ',predios.id) as nome"))
			->join("predios", "predios_has_clientes.predio_id", "predios.id")
			->where([["predios_has_clientes.cliente_documento", $this->documento]])->get();
		if (isset($predios))
			return $predios;
		return [];
	}

	public function getPrediosAttribute()
	{
		$predios = DB::table("predios_has_clientes")->select("predios_has_clientes.predio_id as predio_id", "predios.nome", "predios_has_clientes.complemento")
			->join("predios", "predios_has_clientes.predio_id", "predios.id")
			->where([["predios_has_clientes.cliente_documento", $this->documento]])->get();
		if (isset($predios))
			return $predios;
		return [];
	}

	public function getEnderecoAttribute($value){
		return Endereco::find($value);
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
			'clientes.documento' => 'getOnlyNumbers',
			'clientes.nome',
			'predios.id' => 'getOnlyNumbers',
		),
		'joins' => [
			'predios_has_clientes' => ['clientes.documento', 'predios_has_clientes.cliente_documento'],
			'predios' => ['predios.id', 'predios_has_clientes.predio_id'],
		]
	);

	public static function criar($data, $ip)
	{
		$dados_cliente = self::populateAttributes($data,$ip);
		$model = Cliente::firstOrCreate(
			[
				"documento" => $data["documento"]
			],
			$dados_cliente
		);
		if (isset($data['predios'])) {
			PredioHasCliente::where("cliente_documento", $model->documento)->delete();
			foreach ($data['predios'] as $predio) {
				$predio['cliente_documento'] = $model->documento;
				PredioHasCliente::criar($predio, $ip);
			}}
		$model->saveLog($ip, 'insert',$dados_cliente);
		return $model;
	}

	public static function atualizar($data, $ip)
	{
		$dados_cliente = self::populateAttributes($data,$ip);
		$model = Cliente::updateOrCreate(
			[
				"documento" => $data["documento"]
			],
			$dados_cliente
		);
		PredioHasCliente::where("cliente_documento", $model->documento)->delete();
		if (isset($data['predios'])) {
			PredioHasCliente::where("cliente_documento", $model->documento)->delete();
			foreach ($data['predios'] as $predio) {
				$predio['cliente_documento'] = $model->documento;
				PredioHasCliente::criar($predio, $ip);
			}
		}
		$model->saveLog($ip, 'update',$dados_cliente);
		return $model;
	}

	public static function show($documento)
	{
		$cliente = Cliente::find($documento);
		if(!isset($cliente))
			return null;
		$cliente->makeHidden("predios_index");
		$cliente->makeVisible("endereco");
		$cliente->append("predios");
		return $cliente;
	}

	public static function predios($documento)
	{
		$registros = DB::table("predios_has_clientes")->select("predios_has_clientes.predio_id as predio_id", "predios.nome",DB::raw("CONCAT(logradouro,', ',numero, ' - ', bairros.nome,', ', cidades.nome, ' - ',cidades.uf) as endereco"))
		    ->join("predios", "predios_has_clientes.predio_id", "predios.id")
			->join('bairros','predios.bairro','=','bairros.id')
			->join('cidades','predios.cidade_id','=','cidades.id')
		    ->where([["predios_has_clientes.cliente_documento", $documento],['ativo',true]]);
		$filter_id = AuthHelper::filterIds();
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			$registros->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			$registros->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}
		return $registros->get();
	}

	public static function empreendimentos($documento){
		$registros = DB::table("predios")->select("predios.id as predio_id", "predios.nome",DB::raw("CONCAT(logradouro,', ',numero, ' - ', bairros.nome,', ', cidades.nome, ' - ',cidades.uf) as endereco"))
		             ->join('bairros','predios.bairro','=','bairros.id')
		             ->join('cidades','predios.cidade_id','=','cidades.id')
		             ->where([["predios.cliente_documento", $documento],['ativo',true],['is_empreendimento',true]]);
		$filter_id = AuthHelper::filterIds();
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			$registros->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			$registros->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}
		return $registros->get();
	}

	public function requestVf(){
		if(getenv('APP_ENV') != "prod"){
			$result = [
				'success' => true,
				'result' =>(object)['vf_approved' => true]
			];
		}else
			$result = HTTAPI::requestVF($this->documento);
		if($result['success'] == false)
			return $result;
		$this->data_verificacao = date('Y-m-d H:i:s');
		$this->status = ($result['result']->vf_approved ? 'A' : 'R');
		$this->save();
		return array('success' => true,'approved' => $result['result']->vf_approved);
	}


	private static function populateAttributes($data, $ip){
		return array(
			"nome" => $data["nome"],
			"endereco" => Endereco::salvar($data['endereco'],$ip)->id,
			"inscricao_estadual" => isset($data["inscricao_estadual"]) ? $data["inscricao_estadual"] : null,
			"contato" => isset($data["contato"]) ? $data["contato"] : null
		);
	}
}
