<?php

namespace App\Model;

use App\Http\Traits\FastpackModelLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bairro extends Model
{
	use FastpackModelLog;

	public $timestamps = false;

	protected $table = 'bairros';
	protected $fillable = ['nome','cidade_id'];

	public function setNomeAttribute( $value ) {
		$this->attributes['nome'] = preg_replace('/#$%&()\/\\\/','',mb_strtoupper($value,"UTF-8"));
	}

	public static function criar($data, $ip){
		$dados_bairro = self::populateAttributes($data);
		$model = Bairro::firstOrCreate(
			$dados_bairro
		);
		$model->saveLog($ip,'insert',$dados_bairro);
		return $model;
	}

	public static function atualizar($data,$ip){
		$dados_bairro = self::populateAttributes($data);
		$model = Bairro::updateOrCreate(
			$dados_bairro
		);
		$model->saveLog($ip,'update',$dados_bairro);
		return $model;
	}

	private static function populateAttributes($data){
		return array(
			"nome" => $data["nome"],
			"cidade_id" => $data['cidade_id']
		);
	}
}
