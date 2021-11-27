<?php

namespace App\Http\Requests\Fastpack\Predio;


class AtivarRequest extends PredioRequest
{
	protected static $modulo = 2;
	protected static $permission = 1;


	public function rules()
	{
		return [
		];
	}

	public function messages()
	{
		return
			[
			];
	}

}
