<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 06/09/2019
 * Time: 15:17
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 06/09/2019
 * Time: 15:17
 */

namespace App\Http\Requests\Fastpack\Venda;

use App\Http\Requests\Request as BaseRequest;

class VendaRequest extends BaseRequest{

	protected static $modulo = 6;
	protected static $permission = 2;
}