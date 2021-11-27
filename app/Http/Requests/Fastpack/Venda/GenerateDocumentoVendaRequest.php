<?php

namespace App\Http\Requests\Fastpack\Venda;

class GenerateDocumentoVendaRequest extends VendaRequest
{
	protected static $permission = 1;

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$data = $this->all();
		$data['codigo'] = $this->route('codigo');
		return $data;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'codigo' => 'required|exists:vendas,codigo'
		];
	}
}
