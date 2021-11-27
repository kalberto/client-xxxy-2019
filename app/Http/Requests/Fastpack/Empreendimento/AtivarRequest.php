<?php

namespace App\Http\Requests\Fastpack\Empreendimento;


class AtivarRequest extends EmpreendimentoRequest
{
	protected static $modulo = 8;
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
