<?php

namespace App\Http\Controllers\Fastpack;

use App\Helpers\AuthHelper;
use App\Http\Controllers\FastpackController;
use App\Http\Requests\Fastpack\Dashboard\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends FastpackController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function dashboard(Request $request){
		$filter_id = AuthHelper::filterIds();
		$predio_abordados = DB::table('predios')->leftjoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
		                                        ->where([['abordado',true],['is_empreendimento',false]]);
		$predio_n_abordados = DB::table('predios')->leftjoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
		                                          ->where([['abordado',false],['is_empreendimento',false]]);
		$empreendimentos = DB::table("predios")->leftjoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
		                                       ->where('is_empreendimento',true);
		$clientes = DB::table('clientes');
		$prospeccoes = DB::table('prospeccoes');
		$prospeccoes_perdidas = DB::table('prospeccoes')->where('status','P');
		$auditorias = DB::table('auditorias');
		$vendas_aprovadas = DB::table('vendas')->where('status','F');
		$vendas_perdidas = DB::table('vendas')->where('status','C');

		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			$predio_abordados->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			$predio_n_abordados->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			$empreendimentos->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			$clientes->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
			         ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
			         ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
			         ->leftJoin('consultores','predios.consultor_id','=','consultores.id')
			         ->leftJoin('consultores as consultores_emp','empreendimentos.consultor_id','=','consultores_emp.id')
			         ->whereIn('predios.consultor_id',$consultores_ids)->orWhereIn('empreendimentos.consultor_id',$consultores_ids);
			$prospeccoes->whereIn('prospeccoes.usuario_id',$filter_id);
			$prospeccoes_perdidas->whereIn('prospeccoes.usuario_id',$filter_id);
			$auditorias->join('vendas','auditorias.codigo','=','vendas.codigo')->whereIn('vendas.usuario_id',$filter_id);
			$vendas_aprovadas->whereIn('usuario_id',$filter_id);
			$vendas_perdidas->whereIn('usuario_id',$filter_id);
			$predio_abordados = $predio_abordados->groupBy('predio_id')->pluck('predio_id');
			$predio_n_abordados = $predio_n_abordados->groupBy('predio_id')->pluck('predio_id');
			$empreendimentos = $empreendimentos->groupBy('predio_id')->pluck('predio_id');
		}
		$response = array(
			'predio_abordados'      => $predio_abordados->count(),
			'predio_n_abordados'    => $predio_n_abordados->count(),
			'clientes'              => $clientes->count(),
			'prospeccoes'           => $prospeccoes->count(),
			'prospeccoes_perdidas'  => $prospeccoes_perdidas->count(),
			'auditorias'            => $auditorias->count(),
			'vendas_aprovadas'      => $vendas_aprovadas->count(),
			'vendas_perdidas'       => $vendas_perdidas->count(),
			'empreendimentos'       => $empreendimentos->count(),
		);
		return response()->json($response,200);
	}
}
