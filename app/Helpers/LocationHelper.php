<?php

namespace App\Helpers;

use App\Model\Bairro;
use App\Model\Cep;
use App\Model\Cidade;
use Illuminate\Support\Str;

class LocationHelper {



	public static function getCidadeId($uf,$cidade, $ip,$create = false){
		$cidades = Cidade::where("slug",Str::slug($cidade.'-'.$uf))->pluck('id');
		if($cidades->count() > 0){
			return $cidades->first();
		}else{
			if($create)
				return Cidade::criar(["nome" => $cidade, "uf" => $uf], $ip)->id;
			else
				return false;
		}
	}

	public static function getBairroId($bairro,$cidade,$ip,$create = true){
		$bairros = Bairro::where([['cidade_id',$cidade],['nome','like',preg_replace("/#$%&()\/\\\/",'',mb_strtoupper($bairro,"UTF-8"))]])->pluck('id');
		if($bairros->count() > 0){
			return $bairros->first();
		}else{
			if($create)
				return Bairro::criar(['nome' => $bairro,'cidade_id'=>$cidade],$ip)->id;
			else
				return false;
		}
	}

	public static function getCepId($cep,$ip, $create = true){
		$ceps = Cep::where('cep',preg_replace("/[^0-9]/",'',$cep))->pluck('id');
		if($ceps->count() > 0){
			return $ceps->first();
		}else{
			if($create)
				return Cep::criar(['cep' => $cep],$ip)->id;
			else
				return false;
		}
	}
}