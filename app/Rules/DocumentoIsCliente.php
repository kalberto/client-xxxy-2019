<?php

namespace App\Rules;

use App\Http\Traits\NumbersOnly;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentoIsCliente implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
	    $clientes = 0;
	    if(Auth::user()->tokenCan('list-clientes-all')){
		    $clientes = DB::table("clientes")->where("documento",$value)->count();
	    }else{
	    	if(Auth::user()->tokenCan('list-clientes-vendedor')){
			    $clientes += DB::table('clientes')
			                   ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
			                   ->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
			                   ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
			                   ->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
			                   ->leftJoin('consultores','consultores_has_predios.consultor_id','=','consultores.id')
			                   ->leftJoin('consultores_has_predios as consultores_has_empr','empreendimentos.id','=','consultores_has_empr.predio_id')
			                   ->leftJoin('consultores as consultores_emp','consultores_has_empr.consultor_id','=','consultores_emp.id')
			                   ->where('clientes.documento',$value)
			                   ->where(function($query){
				                   $query->where('consultores.usuario_id',Auth::id())
					                   ->orWhere('consultores_emp.usuario_id',Auth::id());
			                   })->count();
		    }
		    if(Auth::user()->tokenCan('list-clientes-gerente')){
	    		$clientes += DB::table('clientes')
			                   ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
			                   ->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
			                   ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
			                   ->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
							   ->leftJoin('consultores','consultores_has_predios.consultor_id','=','consultores.id')
							   ->leftJoin('consultores_has_predios as consultores_has_empr','empreendimentos.id','=','consultores_has_empr.predio_id')
							   ->leftJoin('consultores as consultores_emp','consultores_has_empr.consultor_id','=','consultores_emp.id')
			                   ->leftJoin('usuarios','consultores.usuario_id','=','usuarios.id')
			                   ->leftJoin('usuarios as usuarios_emp','consultores_emp.usuario_id','=','usuarios_emp.id')
			                   ->where('clientes.documento',$value)
			                   ->where(function($query){
					                 $query->where('usuarios.manager_id',Auth::id())
					                       ->orWhere('usuarios_emp.manager_id',Auth::id());
			                   })->count();
		    }
	    }
	    return $clientes > 0;



    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Documento não disponível para o usuário logado.';
    }
}
