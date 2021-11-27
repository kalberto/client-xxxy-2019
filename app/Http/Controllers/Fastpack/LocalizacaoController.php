<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 08/08/2019
 * Time: 10:48
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 08/08/2019
 * Time: 10:48
 */

namespace App\Http\Controllers\Fastpack;

use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\DB;

class LocalizacaoController extends FastpackController {


	/**
	 * Display a listing of the ufs.
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ufs(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		return response()->json(DB::table("ufs")->where("ativo",true)->get(),200);
	}

	/**
	 * Display a listing of the cidades.
	 *
	 *
	 * @param string $uf
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function cidades($uf){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		return response()->json(DB::table("cidades")->where('uf',strtoupper($uf))->get(),200);
	}
}