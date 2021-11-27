<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthHelper {

	public static function filterIds(){
		if(Auth::user()->tokenCan('list-clientes-all'))
			return false;
		$ids = [];
		if(Auth::user()->tokenCan('list-clientes-vendedor')){
			$ids[] = Auth::id();
		}
		if(Auth::user()->tokenCan('list-clientes-gerente')){
			$ids[] = Auth::id();
			$ids_db = DB::table('usuarios')->select('id')->where('manager_id',Auth::id())->pluck('id')->toArray();
			foreach ($ids_db as $item){
				if(!in_array($item, $ids))
					$ids[] = $item;
			}
		}
		return $ids;
	}

	public static function getConsultorIds($p_ids){
		$ids = DB::table('consultores')->whereIn('usuario_id',$p_ids)->pluck('id')->toArray();
		return $ids;
	}
}