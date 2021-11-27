<?php

namespace App\Http\Controllers\Fastpack;


use App\Exports\ProspeccoesExport;
use App\Helpers\AuthHelper;
use App\Helpers\NotMappedHelper;
use App\Helpers\PaginatorHelper;
use App\Http\Requests\Fastpack\Prospeccao\Request;
use App\Http\Requests\Fastpack\Prospeccao\CreateRequest;
use App\Http\Requests\Fastpack\Prospeccao\EditRequest;
use App\Model\Fastpack\Prospeccao;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class ProspeccaoController extends FastpackController
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
		if($filter_id != false)
			$registros = Prospeccao::whereIn('prospeccoes.usuario_id',$filter_id);
		else
			$registros = Prospeccao::whereNotNull('prospeccoes.codigo');
		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('prospeccoes.status', $params['status']);
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
			$q = $params['q'];
			$registros = $registros->search($params['q']);
		}
		if (Schema::hasColumn('prospeccoes', $order_by)){
			if($asc)
				$registros = $registros->orderBy('prospeccoes.'.$order_by)->paginate($limit);
			else
				$registros = $registros->orderByDesc('prospeccoes.'.$order_by)->paginate($limit);
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
		if($filter_id != false)
			$registros = Prospeccao::whereIn('prospeccoes.usuario_id',$filter_id);
		else
			$registros = Prospeccao::whereNotNull('prospeccoes.codigo');
		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('prospeccoes.status', $params['status']);
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
		if (Schema::hasColumn('prospeccoes', $order_by)){
			if($asc)
				$registros = $registros->orderBy('prospeccoes.'.$order_by)->get();
			else
				$registros = $registros->orderByDesc('prospeccoes.'.$order_by)->get();
		}else{
			$registros = $registros->get();
		}

		return Excel::download(new ProspeccoesExport($registros),'prospeccoes.xlsx');
	}

	public function status(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		return response()->json(array_values(NotMappedHelper::$status_prospeccao),200);
	}

	public function statusNegociacao(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		return response()->json(array_values(NotMappedHelper::$status_prospeccao_negociacao),200);
	}

	public function vendaPerdidaMotivos(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		return response()->json(DB::table("motivos_venda_perdida")->get(),200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateRequest|\Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateRequest $request)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$created = Prospeccao::criar($data, $request->ip());
		if($created != false){
			$statusCode = 200;
			$response = [
				'msg' => 'Registro salvo com sucesso',
				'codigo' => $created->codigo
			];
		}else{
			$statusCode = 422;
			$response = [
				'msg' => 'Já foi criado o número máximo de versões para este cliente hoje, tente novamente amanhã.'
			];
		}
		return response()->json($response,$statusCode);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $codigo
	 * @return \Illuminate\Http\Response
	 */
	public function show($codigo)
	{
		$registro = Prospeccao::show($codigo);
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
	 * Update the specified resource in storage.
	 *
	 * @param EditRequest $request
	 * @param  string $codigo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(EditRequest $request, $codigo)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$data['codigo'] = $codigo;
		$prospec = Prospeccao::find($codigo);
		if($prospec != null){
			if(($prospec->status == "V" || $prospec->status == "P") && (!Auth::user()->tokenCan('admin') && !Auth::user()->tokenCan('inteligencia'))){
				$statusCode = 422;
				$response = [
					'msg' => 'Essa prospecção não pode ser alterada'
				];
			}else{
				$data = $request->all();
				$data['codigo'] = $codigo;
				Prospeccao::atualizar($data, $request->ip());
				$statusCode = 200;
				$response = [
					'msg' => 'Registro salvo com sucesso',
				];
			}
		}else{
			$statusCode = 404;
			$response = [
				'msg' => 'Registro não encontrado'
			];
		}
		return response()->json($response,$statusCode);
	}

	/**
	 * @param $codigo
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function reject($codigo){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$prospeccao = Prospeccao::find($codigo);
		if(isset($prospeccao)){
			if(($prospeccao->status == "V" || $prospeccao->status == "P") || (Auth::user()->tokenCan('admin') || Auth::user()->tokenCan('inteligencia'))){
				$status_code = 422;
				$response = [
					'msg' => 'Essa prospecção não pode ser alterada'
				];
			}else{
				$prospeccao->reject();
				$response = ['msg' => "Prospecção perdida"];
				$status_code = 200;
			}
		}else{
			$response = ['msg' => "Prospecção não encontrada"];
			$status_code = 404;
		}
		return response()->json($response, $status_code);
	}
}
