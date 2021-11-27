<?php

namespace App\Model\Fastpack\Help;

use App\Http\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ProspecaoVendaPerdida extends Model
{

	use HasCompositePrimaryKey;

	public $incrementing = false;
	public $timestamps = false;
	protected $table = 'prospeccao_venda_perdida';
	protected $fillable = ['codigo_prospec','motivo_id','comentario'];

	public static function criar($data, $ip){
		$model = ProspecaoVendaPerdida::updateOrCreate(
			[
				"codigo_prospec" => $data["codigo_prospec"]
			],
			[
				"motivo_id" => $data["motivo_id"],
				"comentario" => isset($data["comentario"]) ? $data["comentario"] : null
			]
		);
		return $model;
	}
}
