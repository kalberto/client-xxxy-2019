<?php

namespace App\Model;

use App\Http\Traits\FastpackModelLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Uf extends Model
{
	use FastpackModelLog;

	public $incrementing = false;
	public $timestamps = false;

	protected $primaryKey = 'uf';
	protected $table = 'ufs';
	protected $fillable = ['uf','ativo'];

	public function setUfAttribute( $value ) {
		$this->attributes['uf'] = preg_replace("/[^A-Z]/",'',mb_strtoupper($value,"UTF-8"));
	}

	public static function criar($data, $ip){
		$model = Uf::firstOrCreate(
			[
				"uf" => $data["uf"]
			],
			[
				"ativo" => isset($data["ativo"]) ? $data["ativo"] : false
			]
		);
		$model->saveLog($ip,'insert');
		return $model;
	}

	public static function atualizar($data,$ip){
		$model = Uf::updateOrCreate(
			[
				"uf" => $data["uf"]
			],
			[
				"ativo" => isset($data["ativo"]) ? $data["ativo"] : false
			]
		);
		$model->saveLog($ip,'update');
		return $model;
	}
}
