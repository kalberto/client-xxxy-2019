<?php

namespace App\Http\Controllers\Fastpack;

use App\Exports\AuditoriasExport;
use App\Helpers\AuthHelper;
use App\Helpers\PaginatorHelper;
use App\Http\Requests\Fastpack\Auditoria\CreateRequest;
use App\Http\Requests\Fastpack\Auditoria\EditRequest;
use App\Http\Requests\Fastpack\Auditoria\Request;
use App\Model\Fastpack\Auditoria;
use App\Model\Fastpack\Venda;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class AuditoriaController extends FastpackController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$params = $request->all();
		$limit = (isset($params['limit']) && is_numeric($params['limit']) && $params['limit'] > 0) ? $params['limit'] : 10;
		$order_by = "created_at";
		$asc = false;
		$q = '';
		if(isset($params['sort'])){
			$order_by = $params['sort'];
			if(substr($order_by,0,1) == '-'){
				$asc = false;
				$order_by = substr($order_by,1);
			}
		}
		$filter_id = AuthHelper::filterIds();
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			if(!isset($params['q']))
				$registros  = Auditoria::join('vendas','auditorias.codigo','=','vendas.codigo')->whereIn('vendas.usuario_id',$filter_id);
			else
				$registros = Auditoria::whereIn('vendas.usuario_id',$filter_id);
		}else{
			$registros = Auditoria::whereNotNull('auditorias.codigo');
		}
		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('auditorias.status', $params['status']);
		}
		if(isset($params['tipo']) && $params['tipo'] != 'todos'){
			$registros->where('auditorias.tipo', $params['tipo']);
		}
		if(isset($params['start'])){
			$start_date = (\DateTime::createFromFormat('d/m/Y',$params['start']))->format('Y-m-d 00:00:00');
			$registros->where('auditorias.created_at','>=',$start_date);
		}
		if(isset($params['end'])){
			$end_date = (\DateTime::createFromFormat('d/m/Y',$params['end']))->format('Y-m-d 23:59:59');
			$registros->where('auditorias.created_at','<=',$end_date);
		}
		if(isset($params['q'])){
			$q = $params['q'];
			$registros = $registros->search($params['q']);
		}
		if (Schema::hasColumn('auditorias', 'auditorias.'.$order_by)){
			if($asc)
				$registros = $registros->orderBy('auditorias.'.$order_by)->paginate($limit);
			else
				$registros = $registros->orderByDesc('auditorias.'.$order_by)->paginate($limit);
		}else{
			$registros = $registros->paginate($limit);
		}
		if($registros->total() > 0){
			$statusCode = 200;
			$response = [
				'pagination' => PaginatorHelper::paginate($registros->lastPage(),$registros->currentPage()),
				'registros' => $registros->appends($params),
				'msg' => $registros->total().' registro(s) encontrado(s)'.($q!='' ? ' para '.$q.'!' : '!')
			];
		}else{
			$statusCode = 200;
			$response = [
				'pagination' => false,
				'registros' => [],
				'msg' => 'Nenhum registro encontrado'.($q!='' ? ' para '.$q.'!' : '!')
			];
		}

		return response()->json($response,$statusCode);
	}

	/**
	 * Generate a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	public function relatorio(Request $request)
	{
		$params = $request->all();
		$order_by = "created_at";
		$asc = false;
		if(isset($params['sort'])){
			$order_by = $params['sort'];
			if(substr($order_by,0,1) == '-'){
				$asc = false;
				$order_by = substr($order_by,1);
			}
		}

		$filter_id = AuthHelper::filterIds();
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			if(!isset($params['q']))
				$registros  = Auditoria::join('vendas','auditorias.codigo','=','vendas.codigo')->whereIn('vendas.usuario_id',$consultores_ids);
			else
				$registros = Auditoria::whereIn('vendas.usuario_id',$consultores_ids);
		}else{
			$registros = Auditoria::whereNotNull('auditorias.codigo');
		}

		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('auditorias.status', $params['status']);
		}
		if(isset($params['tipo']) && $params['tipo'] != 'todos'){
			$registros->where('auditorias.tipo', $params['tipo']);
		}
		if(isset($params['start'])){
			$start_date = (\DateTime::createFromFormat('d/m/Y',$params['start']))->format('Y-m-d 00:00:00');
			$registros->where('created_at','>=',$start_date);
		}
		if(isset($params['end'])){
			$end_date = (\DateTime::createFromFormat('d/m/Y',$params['end']))->format('Y-m-d 23:59:59');
			$registros->where('created_at','<=',$end_date);
		}
		if(isset($params['q'])){
			$registros = $registros->search($params['q']);
		}
		if (Schema::hasColumn('auditorias', $order_by)){
			if($asc)
				$registros = $registros->orderBy('auditorias.'.$order_by)->get();
			else
				$registros = $registros->orderByDesc('auditorias.'.$order_by)->get();
		}else{
			$registros = $registros->get();
		}

		return Excel::download(new AuditoriasExport($registros),'auditorias.xlsx');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateRequest $request
	 * @param $codigo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateRequest $request, $codigo)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$venda = Venda::find($codigo);
		if(!isset($venda ))
			return response()->json(['msg' => 'Essa venda não existe'],404);
		if($venda->status != 'V')
			return response()->json(['msg' => 'Venda não passível de ser auditada'],422);
		if($venda->status == 'U')
			return response()->json(['msg' => 'Já existe uma auditoria em progresso para essa venda.'],422);
		$venda->status = 'U';
		$venda->save();
		$auditoria = Auditoria::criar(['codigo'=>$codigo],$request->ip());
		return response()->json(['msg' => 'Registro salvo com sucesso','id' => $auditoria->id],200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$registro = Auditoria::show($id);
		if(isset($registro)){
			$statusCode = 200;
			$response = $registro;
		}else{
			$statusCode = 404;
			$response = [
				'msg' => 'Não foi possível achar esse registro.'
			];
		}
		return response()->json($response,$statusCode);
	}

	/**
	 * Manda a auditoria para a próxima etapa
	 *
	 * @param EditRequest $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function go(EditRequest $request, $id){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$auditoria = Auditoria::find($id);
		if($auditoria->status == "E"){
			$result = $auditoria->go($data,$request->ip());
			if($result){
				$status_code = 200;
				$response = [
					'msg' => 'Registro editado com sucesso'
				];
			}else{
				$status_code = 422;
				$response = [
					'msg' => 'Registro salvo, mas a venda não foi enviada. Tente novamente mais tarde. Se o problema persistir, procure um administrador'
				];
			}
		}else{
			$status_code = 422;
			$response = [
				'msg' => 'Essa auditoria não pode ser alterada'
			];
		}
		return response()->json($response,$status_code);
	}

	/**
	 * Retorna a auditoria para a etapa anterior
	 *
	 * @param EditRequest $request
	 * @param $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function noGo(EditRequest $request, $id){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$auditoria = Auditoria::find($id);
		if($auditoria->status == "E"){
			$auditoria->noGo($data,$request->ip());
			$status_code = 200;
			$response = [
				'msg' => 'Registro editado com sucesso'
			];
		}else{
			$status_code = 422;
			$response = [
				'msg' => 'Essa auditoria não pode ser alterada'
			];
		}
		return response()->json($response,$status_code);
	}
}
