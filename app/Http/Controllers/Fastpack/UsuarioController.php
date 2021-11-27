<?php

namespace App\Http\Controllers\Fastpack;

use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\DB;


class UsuarioController extends FastpackController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function consultores(){
		$consultores = DB::table("consultores")->select(["consultores.id as consultor_id","usuarios.usuario as consultor","usuario_gerente.usuario as gerente"])
		                 ->join("usuarios", "consultores.usuario_id", "=", "usuarios.id")
		                 ->join("usuarios as usuario_gerente", "usuarios.manager_id", "=", "usuario_gerente.id")
		                 ->where([['consultores.id','!=',null],['usuarios.ativo','=',true]])
		                 ->get();
		return response()->json($consultores,200);
	}
}
