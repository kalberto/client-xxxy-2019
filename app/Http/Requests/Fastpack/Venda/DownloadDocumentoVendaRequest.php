<?php

namespace App\Http\Requests\Fastpack\Venda;

class DownloadDocumentoVendaRequest extends VendaRequest
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
		$data['codigo'] = $this->route('codigo');
		$data['name'] = $this->route('name');
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
			'name' => 'required|exists:documentos,name',
			'codigo' => 'required|exists:vendas,codigo'
		];
	}
}
