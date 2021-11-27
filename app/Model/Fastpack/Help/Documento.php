<?php

namespace App\Model\Fastpack\Help;

use App\Http\Traits\FastpackModelLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Documento extends Model
{

	use FastpackModelLog, SoftDeletes;

	protected $table = 'documentos';
	protected $fillable = ['nome','codigo','usuario_id'];

	public function getCreatedAtAttribute($value){
		return (new \DateTime($value))->format('d-m-Y H:i');
	}

	public static function salvar($data, $ip){
		$dados_documento = [
			"nome" => $data['nome'],
			"codigo" => $data["codigo"],
			"usuario_id"    => Auth::id(),
		];
		$model = Documento::updateOrCreate(
			[
				"id" => isset($data["id"]) ? $data["id"] : null
			],$dados_documento

		);
		$model->saveLog($ip, 'insert',$dados_documento);
		return $model;
	}
}
