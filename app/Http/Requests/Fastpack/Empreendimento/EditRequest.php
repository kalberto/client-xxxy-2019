<?php

namespace App\Http\Requests\Fastpack\Empreendimento;

use Illuminate\Validation\Rule;

class EditRequest extends EmpreendimentoRequest
{
	protected static $permission = 3;

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$data = $this->all();
		$data['id'] = $this->id;
		$this->custom_rules = $this->rules();
		if(isset($data['uf']['uf']))
			$this->custom_rules['cidade.id'][] = Rule::exists('cidades','id')->where('uf',$data['uf']['uf']);
		return $data;
	}
}
