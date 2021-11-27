<?php

namespace App\Model;

use App\Http\Traits\FastpackModelLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cidade extends Model
{
	use FastpackModelLog;

	public $timestamps = false;

	protected $table = 'cidades';
	protected $fillable = ['nome','uf','slug','abr','centro_operacao'];


	public function setNomeAttribute( $value ) {
		$this->attributes['nome'] = preg_replace('/#$%&()\/\\\/','',mb_strtoupper($value,"UTF-8"));
	}
	public function setUfAttribute( $value ) {
		$this->attributes['uf'] = preg_replace("/[^A-Z]/",'',mb_strtoupper($value,"UTF-8"));
	}
	public function setSlugAttribute( $value ) {
		$this->attributes['slug'] = Str::slug($value);
	}
	public static function criar($data, $ip){
		$dados_cidade = self::populateAttributes($data);
		$model = Cidade::firstOrCreate(
			[
				"slug" => Str::slug($data["nome"].'-'.$data["uf"])
			],
			$dados_cidade
		);
		$model->saveLog($ip,'insert',$dados_cidade);
		return $model;
	}

	public static function atualizar($data,$ip){
		$dados_cidade = self::populateAttributes($data);
		$model = Cidade::updateOrCreate(
			[
				"slug" => Str::slug($data["nome"].'-'.$data["uf"])
			],
			$dados_cidade
		);
		$model->saveLog($ip,'update',$dados_cidade);
		return $model;
	}

	private static function populateAttributes($data){
		return array(
			"nome" => $data["nome"],
			"uf" => $data["uf"],
			"abr" => isset($data["abr"]) ? $data["abr"] : '',
			"centro_operacao" => isset($data["centro_operacao"]) ? $data["centro_operacao"] : ''
		);
	}
}
