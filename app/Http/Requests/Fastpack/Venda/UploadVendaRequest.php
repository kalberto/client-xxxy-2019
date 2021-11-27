<?php

namespace App\Http\Requests\Fastpack\Venda;

class UploadVendaRequest extends VendaRequest
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
			'file' => 'required|file|mimes:pdf,doc,docx,xlsx,ppt|max:8000',
			'codigo' => 'required|exists:vendas,codigo'
		];
	}
}
