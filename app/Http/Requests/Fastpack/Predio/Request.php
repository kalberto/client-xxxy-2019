<?php

namespace App\Http\Requests\Fastpack\Predio;

use App\Http\Requests\Request as BaseRequest;

class Request extends BaseRequest
{

    protected static $modulo = 2;
	protected static $permission = 1;
}
