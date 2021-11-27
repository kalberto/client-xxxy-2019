<?php

namespace App\Model\Fastpack\Abstracts;

use App\Helpers\LocationHelper;
use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Http\Traits\SearchModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

abstract class Local extends Model
{
	use FastpackModelLog, SearchModel, NumbersOnly;

	protected $table = 'predios';
	protected $fillable = ['nome', 'logradouro', 'numero', 'complemento', 'consultor_id', 'cidade_id', 'regional', 'contato', 'cep', 'bairro', 'abordado', 'ativo','is_empreendimento','cliente_documento'];

	protected $casts = [
		'contato' => 'array'
	];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['consultor', 'uf', 'cidade','consultores'];

	public function setNomeAttribute($value)
	{
		$this->attributes['nome'] = mb_strtoupper($value, "UTF-8");
	}

	public function setContatoAttribute($value)
	{
		$this->attributes['contato'] = json_encode($value);
	}

	public function setLogradouroAttribute($value)
	{
		$this->attributes['logradouro'] = mb_strtoupper($value, "UTF-8");
	}

	public function setNumeroAttribute($value)
	{
		$this->attributes['numero'] = preg_replace("/[^0-9]/", '', $value);
	}

	public function setComplementoAttribute($value)
	{
		$this->attributes['complemento'] = mb_strtoupper($value, "UTF-8");
	}

	public function setRegionalAttribute($value)
	{
		$this->attributes['regional'] = mb_strtoupper($value, "UTF-8");
	}

	public function setCepAttribute($value)
	{
		if (is_int($value))
			$this->attributes['cep'] = $value;
		else
			$this->attributes['cep'] = LocationHelper::getCepId($value, false);
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
			'predios.id' => 'getOnlyNumbers',
			'predios.nome',
			'ceps.cep' => 'getOnlyNumbers',
			'predios.logradouro',
			'predios.numero' => 'getOnlyNumbers',
			'cidades.nome',
			'cidades.uf',
			'bairros.nome',
			'c_usuarios.usuario',
			'g_usuarios.usuario',
			'clientes.nome'
		),
		'joins' => [
			'ceps' => ['predios.cep', 'ceps.id'],
			'bairros' => ['predios.bairro', 'bairros.id'],
			'cidades' => ['predios.cidade_id', 'cidades.id'],
			'consultores_has_predios' => ['predios.id','consultores_has_predios.predio_id'],
			'consultores' => ['consultores_has_predios.consultor_id', 'consultores.id'],
			'usuarios as c_usuarios' => ['consultores.usuario_id', 'c_usuarios.id'],
			'usuarios as g_usuarios' => ['c_usuarios.manager_id', 'g_usuarios.id'],
			'clientes' => ['predios.cliente_documento', 'clientes.documento'],
		]
	);

	abstract public function getIdAttribute($value);

	public function getCepAttribute($value)
	{
		$cep = DB::table("ceps")->find($value);
		if (isset($cep))
			return $cep->cep;
		return "Não possui cep";
	}

	public function getContatoAttribute($value)
	{
		if (isset($value))
			return json_decode($value);
		return [];
	}

	public function getBairroAttribute($value)
	{
		$bairro = DB::table("bairros")->find($value);
		if (isset($bairro))
			return $bairro->nome;
		return "Não possui bairro";
	}

	public function getUfAttribute()
	{
		$cidade = DB::table("cidades")->find($this->cidade_id);
		if (isset($cidade))
			return ['uf' => $cidade->uf];
		return ['uf' => ''];
	}

	public function getCidadeAttribute()
	{
		$cidade = DB::table("cidades")->find($this->cidade_id);
		if (isset($cidade))
			return $cidade;
		return ['id' => '','nome' => '','slug' => '','uf' => ''];
	}

	public function getConsultorAttribute()
	{
		$usuario = DB::table("consultores")->select(["usuarios.usuario","ug.usuario as gerente"])
			->where("consultores.id", $this->consultor_id)
			->join("usuarios", "consultores.usuario_id", "=", "usuarios.id")
			->join("usuarios as ug", "usuarios.manager_id", "=", "ug.id")
			->first();
		if (isset($usuario)){
			return ['consultor_id' => $this->consultor_id,'consultor' => $usuario->usuario, 'gerente' => $usuario->gerente];
		}
		return ['consultor_id' => '','consultor' => '', 'gerente' => ''];
	}

	public function getConsultoresAttribute()
	{
		$consultores = DB::table("consultores_has_predios")->select(["usuarios.usuario as consultor","ug.usuario as gerente","consultores_has_predios.consultor_id as consultor_id"])
		                                               ->join("consultores","consultores_has_predios.consultor_id","=","consultores.id")
		                                               ->join("usuarios", "consultores.usuario_id", "=", "usuarios.id")
		                                               ->join("usuarios as ug", "usuarios.manager_id", "=", "ug.id")
		                                               ->where([["consultores_has_predios.predio_id", $this->getOriginal('id') ]])->get();
		if (isset($consultores))
			return $consultores;
		return [];
	}

	public static function criar($data, $ip)
	{
		$model = self::firstOrCreate(
			array('id' => isset($data['id']) ? self::static_getOnlyNumbers($data['id']) : null),
			$data
		);
		if(isset($data['consultores'])){
			foreach ($data['consultores'] as $consultor){
				DB::table('consultores_has_predios')->insert(['predio_id' => $model->getOriginal('id'), 'consultor_id' => $consultor['consultor_id']]);
			}
		}
		$model->saveLog($ip, 'insert',$data);
		return $model;
	}

	public static function show($id)
	{
		return self::find(self::static_getOnlyNumbers($id));
	}

	public static function atualizar($data, $ip)
	{
		$model = self::updateOrCreate(
			array(
				"id" => self::static_getOnlyNumbers($data["id"])
			),
			$data
		);
		if(isset($data['consultores']) && $data['consultores'] !== false){
			DB::table('consultores_has_predios')->where('predio_id','=',$model->getOriginal('id'))->delete();
			if(isset($data['consultores'])){
				foreach ($data['consultores'] as $consultor){
					DB::table('consultores_has_predios')->insert(['predio_id' => $model->getOriginal('id'), 'consultor_id' => $consultor['consultor_id']]);
				}
			}
		}
		$model->saveLog($ip, 'update',$data);
		return $model;
	}
}
