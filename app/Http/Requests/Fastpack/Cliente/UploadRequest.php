<?php

namespace App\Http\Requests\Fastpack\Cliente;

class UploadRequest extends Request
{
	protected static $permission = 4;

	public function rules()
	{
		return [
			'file' => 'required'
		];
	}

	public function messages()
	{
		return
			[
			];
	}
}
