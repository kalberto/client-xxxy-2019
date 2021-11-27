<?php

namespace App\Model\Fastpack;

use App\Helpers\LocationHelper;
use App\Model\Fastpack\Abstracts\Local;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Empreendimento extends Local
{

	protected $appends = ['consultor','consultores', 'uf', 'cidade','cliente'];

	public function newQuery()
	{
		$query = parent::newQuery();
		$query->where('is_empreendimento','=',1);
		return $query;
	}

	public function getIdAttribute($value)
	{
		return "EMPREENDIMENTO " . $value;
	}

	public function getClienteAttribute(){
		return DB::table("clientes")->select("documento","nome")->where('documento',$this->cliente_documento)->first();
	}

	public static function criar($data, $ip){
		$dados_predios = self::populateAttributes($data, $ip);
		return parent::criar($dados_predios,$ip);
	}

	public static function atualizar($data, $ip){
		$dados_predios = self::populateAttributes($data, $ip);
		return parent::atualizar($dados_predios,$ip);
	}

	protected static function populateAttributes($data, $ip)
	{
		if(Auth::user() == null || (Auth::user() != null && Auth::user()->perfis()->whereIn('id',[1,4])->count() > 0)){
			return array(
				"id" => isset($data['id']) ? $data['id'] : null,
				"nome" => $data["nome"],
				"logradouro" => $data["logradouro"],
				"numero" => $data["numero"],
				"complemento" => isset($data["complemento"]) ? $data["complemento"] : null,
				"consultor_id" => $data["consultor"]["consultor_id"],
				"consultores" => isset($data["consultores"]) ? $data["consultores"] : [],
				"cidade_id" => $data["cidade"]['id'] ,
				"regional" => isset($data["regional"]) ? $data["regional"] : null,
				"contato" => isset($data["contato"]) ? $data["contato"] : [],
				"cep" => LocationHelper::getCepId($data["cep"], $ip),
				"bairro" => LocationHelper::getBairroId($data["bairro"], $data["cidade"]['id'], $ip),
				"ativo" => isset($data["ativo"]) ? $data["ativo"] : false,
				'is_empreendimento' => true,
				'cliente_documento' => $data['cliente_documento']
			);
		}else{
			return array(
				"id" => isset($data['id']) ? $data['id'] : null,
				'contato' => isset($data["contato"]) ? $data["contato"] : [],
				'consultores' => false
			);
		}
	}
}
