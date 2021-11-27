<?php

namespace App\Http\Requests\Fastpack\Predio;


use Illuminate\Validation\Rule;

class CreateRequest extends PredioRequest
{
	protected static $permission = 2;

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData() {
		$data = $this->all();
		$this->custom_rules = $this->rules();
		if(isset($data['uf']['uf']))
			$this->custom_rules['cidade.id'][] = Rule::exists('cidades','id')->where('uf',$data['uf']['uf']);
		return $data;
	}
}
