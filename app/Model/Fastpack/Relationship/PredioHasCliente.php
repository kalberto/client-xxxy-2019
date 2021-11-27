<?php

namespace App\Model\Fastpack\Relationship;

use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\HasCompositePrimaryKey;
use App\Http\Traits\NumbersOnly;
use Illuminate\Database\Eloquent\Model;

class PredioHasCliente extends Model
{
	use FastpackModelLog, HasCompositePrimaryKey, NumbersOnly;

	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = ['predio_id','cliente_documento'];
	protected $table = 'predios_has_clientes';
	protected $fillable = ['predio_id','cliente_documento','complemento'];

	public function setComplementoAttribute($value)
	{
		$this->attributes['complemento'] = mb_strtoupper($value, "UTF-8");
	}

	public static function criar($data, $ip){
		$dados = [
			"complemento" => isset($data["complemento"]) ? $data["complemento"] : ''
		];
		$model = PredioHasCliente::updateOrCreate(
			[
				"predio_id" => PredioHasCliente::static_getOnlyNumbers($data["predio_id"]),"cliente_documento" => $data["cliente_documento"]
			],
			$dados
		);
		$model->saveLog($ip, 'insert',$dados);
		return $model;
	}

	public static function atualizar($data,$ip){
		$dados = [
			"complemento" => isset($data["complemento"]) ? $data["complemento"] : ''
		];
		$model = PredioHasCliente::updateOrCreate(
			[
				"predio_id" => PredioHasCliente::static_getOnlyNumbers($data["predio_id"]),"cliente_documento" => $data["cliente_documento"]
			],
			$dados
		);
		$model->saveLog($ip, 'update',$dados);
		return $model;
	}
}
