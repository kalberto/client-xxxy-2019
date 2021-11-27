<?php

namespace App\Model\Fastpack\Help;

use App\Helpers\LocationHelper;
use App\Http\Traits\FastpackModelLog;
use App\Model\Bairro;
use App\Model\Cep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Endereco extends Model
{

	use FastpackModelLog;

	public $timestamps = false;
	protected $table = 'enderecos';
	protected $fillable = ['cep','logradouro','numero','complemento','bairro','cidade_id'];

	protected $appends = ['uf', 'cidade'];

	public function setLogradouroAttribute($value)
	{
		$this->attributes['logradouro'] = mb_strtoupper($value, "UTF-8");
	}

	public function setComplementoAttribute($value)
	{
		$this->attributes['complemento'] = mb_strtoupper($value, "UTF-8");
	}

	public function setBairroAttribute($value)
	{
		$this->attributes['bairro'] = mb_strtoupper($value, "UTF-8");
	}

	public function getCepAttribute($value)
	{
		$cep = DB::table("ceps")->find($value);
		if (isset($cep))
			return $cep->cep;
		return "Não possui cep";
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

	public static function salvar($data, $ip){
		if(isset($data['cep'])){
			$is_cep_id = false;
			if(is_integer($data['cep'])){
				$cep = Cep::find($data['cep']);
				if(isset($cep)){
					$is_cep_id = true;
					$data['cep'] = $cep->id;
				}
			}
			if(!$is_cep_id)
				$data['cep'] = LocationHelper::getCepId($data["cep"], $ip);
		}else{
			$data['cep'] = null;
		}
		if(isset($data['cidade']['id']) && isset($data['bairro'])){
			$is_bairro_id = false;
			if(is_integer($data['bairro'])){
				$bairro = Bairro::find($data['bairro']);
				if(isset($bairro)){
					$is_bairro_id = true;
					$data['bairro'] = $bairro->id;
				}
			}
			if(!$is_bairro_id)
				$data['bairro'] = LocationHelper::getBairroId($data["bairro"],$data['cidade']['id'], $ip);
		}else{
			$data['bairro'] = null;
		}
		$dados_endereco = self::populateAttributes($data);
		$model = Endereco::updateOrCreate(
			[
				"id" => isset($data["id"]) ? $data["id"] : null
			],
			$dados_endereco
		);
		$model->saveLog($ip, isset($data["id"]) ? 'update' : 'insert',$dados_endereco);
		return $model;
	}

	private static function populateAttributes($data){
		return array(
			"cep" => $data['cep'],
			"logradouro" => isset($data["logradouro"]) ? $data["logradouro"] : null,
			"numero" => isset($data["numero"]) ? $data["numero"] : null,
			"complemento" => isset($data["complemento"]) ? $data["complemento"] : null,
			"bairro" => $data["bairro"],
			"cidade_id" => isset($data['cidade']['id']) ? $data['cidade']['id'] : null
		);
	}


}
