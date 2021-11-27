<?php

namespace App\Model;

use App\Http\Traits\FastpackModelLog;
use Illuminate\Database\Eloquent\Model;

class Cep extends Model
{
	use FastpackModelLog;

	public $timestamps = false;

	protected $table = 'ceps';
	protected $fillable = ['cep'];

	public function setCepAttribute( $value ) {
		$this->attributes['cep'] = preg_replace("/[^0-9]/",'',$value);
	}

	public static function criar($data, $ip){
		$dados_cep = self::populateAttributes($data);
		$model = Cep::firstOrCreate(
			$dados_cep
		);
		$model->saveLog($ip,'insert',$dados_cep);
		return $model;
	}

	public static function atualizar($data,$ip){
		$dados_cep = self::populateAttributes($data);
		$model = Cep::updateOrCreate(
			$dados_cep
		);
		$model->saveLog($ip,'update',$dados_cep);
		return $model;
	}

	private static function populateAttributes($data){
		return array(
			"cep" => $data["cep"]
		);
	}
}
