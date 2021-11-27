<?php

namespace App\Model\Fastpack\Help;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProspecaoChangeStatus extends Model
{

	public $timestamps = false;
	protected $table = 'prospeccao_change_status';
	protected $fillable = ['codigo_prospec','data_mudanca','usuario_id','change_from'];

	public static function criar($data, $ip){
		$model = new ProspecaoChangeStatus();
		$dados = [
			"codigo_prospec" => $data["codigo_prospec"],
			"data_mudanca" => date('Y-m-d H:i:s'),
			"usuario_id" => Auth::id(),
			"change_from" => $data['change_from'],
		];
		$model->fill($dados);
		$model->save();
		return $model;
	}
}
