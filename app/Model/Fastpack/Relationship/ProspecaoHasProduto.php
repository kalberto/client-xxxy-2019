<?php

namespace App\Model\Fastpack\Relationship;

use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProspecaoHasProduto extends Model
{
	use FastpackModelLog,HasCompositePrimaryKey;

	public $incrementing = false;
	public $timestamps = false;
	protected $primaryKey = ['codigo_prospec','tipo_id','produto_id'];
	protected $table = 'prospeccao_has_produto';
	protected $fillable = ['codigo_prospec','tipo_id','produto_id','config'];

	public function setConfigAttribute($value)
	{
		$this->attributes['config'] = json_encode($value);
	}

	public function getConfigAttribute($value){
		return json_decode($value);
	}

	public static function criar($data, $ip){
		$tipo = DB::table("tipos")->where("id",$data["tipo_id"])->limit(1)->first();
		if($tipo->slug == \Illuminate\Support\Str::slug("Pacotes"))
			$config = (object)[
				'internet' => (object)[
					'valor' => '',
					'desconto' => '',
					'is_percent' => false,
					'quantidade_ciclos' => ''
				],
				'voz' => (object)[
					'faixa_numeracao' => (object)[
						'identificacao' => '',
						'lista_numeros' => [],
						'piloto'=>''
					],
					'valor' => '',
					'desconto' => '',
					'is_percent' => false,
					'quantidade_ciclos' => '',
					'tecnologia' => '',
					'tecnologia_sinalizacao' => '',
				]
			];
		else
			$config = (object)[
				'valor' => '',
				'desconto' => '',
				'is_percent' => false,
				'quantidade_ciclos' => ''
			];
		$dados_produto = [
			"produto_id" => $data["produto_id"],
			"config" => isset($data["config"]) ? $data["config"] : $config
		];
		$model = ProspecaoHasProduto::updateOrCreate(
			[
				"codigo_prospec" => $data["codigo_prospec"],"tipo_id" => $data["tipo_id"]
			],
			$dados_produto
		);
		$model->saveLog($ip, 'insert',$dados_produto);
		return $model;
	}
}
