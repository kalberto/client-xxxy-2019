<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 30/07/2019
 * Time: 14:41
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 30/07/2019
 * Time: 14:41
 */

namespace App\Http\Traits;

/**
 * Trait Activable
 * @package App\Http\Traits
 * @property string $modelName
 */
trait Activable {

	/**
	 * Toggle the ativo on the specified resource on storage
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function active( $id){
		$class = $this->modelName;
		$registro = $class::find($id);
		if(isset($registro)){
			$registro->ativo = !$registro->ativo;
			if($registro->ativo == true){
				$msg = "Ativado com sucesso";
			}else
				$msg = "Desativado com sucesso";
			$registro->save();
			$statusCode = 200;
			$response = [
				'msg' => $msg
			];
		}else{
			$statusCode = 404;
			$response = [
				'msg' => 'Não foi possível encontrar esse registro.'
			];
		}
		return response()->json($response,$statusCode);
	}
}