<?php

namespace App\Http\Requests\Fastpack\Cliente;

use Illuminate\Validation\Rule;


class CreateRequest extends ClienteRequest
{
	protected static $permission = 2;

	public function rules(){
		$rules = parent::rules();
		$rules['documento'][] = Rule::unique('clientes');
		return $rules;
	}

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$data = $this->all();
		if(isset($data['documento']) && strlen($data['documento']) == 11)
			$data['inscricao_estadual'] = "ISENTO";
		return $data;
	}
}
