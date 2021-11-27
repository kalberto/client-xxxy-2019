<?php

namespace App\Http\Requests\Fastpack\Cliente;

class EditRequest extends ClienteRequest
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
		$data['documento'] = $this->route('documento');
		if(isset($data['documento']) && strlen($data['documento']) == 11)
			$data['inscricao_estadual'] = "ISENTO";
		return $data;
	}
}
