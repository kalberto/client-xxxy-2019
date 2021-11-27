<?php

namespace App\Http\Requests\Fastpack\Auditoria;

use App\Http\Requests\Request as BaseRequest;

class Request extends BaseRequest
{

    protected static $modulo = 7;
	protected static $permission = 1;

	public function rules() {
		return [
			'start' => 'nullable|date_format:d/m/Y',
			'end' => 'nullable|date_format:d/m/Y|after_or_equal:start',
		];
	}
}
