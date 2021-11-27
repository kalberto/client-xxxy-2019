<?php

namespace App\Http\Controllers\Fastpack;

use App\Exports\EmpreendimentosExport;
use App\Exports\PrediosExport;
use App\Helpers\AuthHelper;
use App\Helpers\PaginatorHelper;
use App\Helpers\VariableHelper;
use App\Http\Requests\Fastpack\Empreendimento\AbordarRequest;
use App\Http\Requests\Fastpack\Empreendimento\AtivarRequest;
use App\Http\Requests\Fastpack\Empreendimento\CreateRequest;
use App\Http\Requests\Fastpack\Empreendimento\EditRequest;
use App\Http\Requests\Fastpack\Empreendimento\Request;
use App\Http\Traits\Activable;
use App\Model\Fastpack\Empreendimento;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;


class EmpreendimentoController extends FastpackController
{

	use Activable;

	/**
	 * @var string Name and namespace of the model
	 */
	protected $modelName = "App\Model\Fastpack\Empreendimento";

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
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
			$sub = Empreendimento::whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			if(!isset($params['q']))
				$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}else{
			$sub = Empreendimento::whereNotNull('predios.id');
		}

		if(isset($params['abordado']) && $params['abordado'] != 'todos'){
			VariableHelper::convert_string_bool($params['abordado']);
			$sub->where('predios.abordado', $params['abordado']);
		}
		if(isset($params['cidade_id']) && $params['cidade_id'] != 'todos'){
			$sub->where('predios.cidade_id', $params['cidade_id']);
		}
		if(isset($params['q'])){
			$q = $params['q'];
			$sub->search($params['q']);
		}
		$sub->select('predios.id as predio_id');
		$query = DB::table(DB::raw("({$sub->toSql()}) as sub"))->select('predio_id')->mergeBindings($sub->getQuery())->groupBy('predio_id');
		$registros_ids = $query->pluck('predio_id')->toArray();
		$registros = Empreendimento::whereIn('predios.id',$registros_ids);
		if (Schema::hasColumn('predios', $order_by)){
			if($asc)
				$registros = $registros->orderBy('predios.'.$order_by)->orderBy('predios.id')->paginate($limit);
			else
				$registros = $registros->orderByDesc('predios.'.$order_by)->orderByDesc('predios.id')->paginate($limit);
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
	 * Generates a listing of the resource.
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
			$sub = Empreendimento::whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			if(!isset($params['q']))
				$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}else{
			$sub = Empreendimento::whereNotNull('predios.id');
		}
		if(isset($params['abordado']) && $params['abordado'] != 'todos'){
			VariableHelper::convert_string_bool($params['abordado']);
			$sub->where('predios.abordado', $params['abordado']);
		}
		if(isset($params['cidade_id']) && $params['cidade_id'] != 'todos'){
			$sub->where('predios.cidade_id', $params['cidade_id']);
		}
		if(isset($params['q'])){
			$sub->search($params['q']);
		}
		$sub->select('predios.id as predio_id');
		$query = DB::table(DB::raw("({$sub->toSql()}) as sub"))->select('predio_id')->mergeBindings($sub->getQuery())->groupBy('predio_id');
		$registros_ids = $query->pluck('predio_id')->toArray();
		$registros = Empreendimento::whereIn('predios.id',$registros_ids);
		if (Schema::hasColumn('predios', $order_by)){
			if($asc)
				$registros->orderBy('predios.'.$order_by)->orderBy('predios.id');
			else
				$registros->orderByDesc('predios.'.$order_by)->orderByDesc('predios.id');
		}
		$registros = $registros->get();
		return Excel::download(new EmpreendimentosExport($registros),'empreendimentos.xlsx');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateRequest|Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(CreateRequest $request)
	{
		$data = $request->all();

		$registro = Empreendimento::criar($data,$request->ip());
		$response = [
			'msg' => 'Registro salvo com sucesso',
			'id' => $registro->getOriginal('id')
		];
		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$registro = Empreendimento::show($id);
		if(isset($registro)){
			$filter_id = AuthHelper::filterIds();
			if($filter_id != false){
				$consultores_ids = AuthHelper::getConsultorIds($filter_id);
				if(!(DB::table('consultores_has_predios')->where('predio_id','=',$id)->whereIn('consultor_id',$consultores_ids)->count()))
					return response()->json(['msg' => 'Você não possui permissão para visualizar esse empreendimento'],403);
			}
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
	 * @param EditRequest|Request $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(EditRequest $request, $id)
	{
		$data = $request->all();
		$data['id'] = $id;
		$filter_id = AuthHelper::filterIds();
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			if(!(DB::table('consultores_has_predios')->where('predio_id','=',$id)->whereIn('consultor_id',$consultores_ids)->count()))
				return response()->json(['msg' => 'Você não possui permissão para editar esse empreendimento'],403);
		}
		Empreendimento::atualizar($data,$request->ip());
		$response = [
			'msg' => 'Registro salvo com sucesso'
		];
		return response()->json($response);
	}

	/**
	 * Toggle the ativo on the specified resource on storage
	 *
	 * @param AtivarRequest $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function active(AtivarRequest $request, $id){
		$class = $this->modelName;
		$registro = $class::find($id);
		if(isset($registro)){
			$filter_id = AuthHelper::filterIds();
			if($filter_id != false){
				$consultores_ids = AuthHelper::getConsultorIds($filter_id);
				if(!(DB::table('consultores_has_predios')->where('predio_id','=',$id)->whereIn('consultor_id',$consultores_ids)->count()))
					return response()->json(['msg' => 'Você não possui permissão para editar esse empreendimento'],403);
			}
			$registro->ativo = !$registro->ativo;
			if($registro->ativo == true){
				$msg = "Ativado com sucesso";
			}else
				$msg = "Desativado com sucesso";
			$registro->save();
			$statusCode = 200;
			$response = [
				'msg' => $msg
			];
		}else{
			$statusCode = 404;
			$response = [
				'msg' => 'Não foi possível encontrar esse registro.'
			];
		}
		return response()->json($response,$statusCode);
	}

	/**
	 * Seta o empreendimento como abordado
	 *
	 * @param AbordarRequest $request
	 * @param string $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function abordar(AbordarRequest $request,$id){
		$model = Empreendimento::find(Empreendimento::static_getOnlyNumbers($id));
		if(!isset($model))
			return response()->json(['msg' => 'Empreendimento não encontrado'], 404);
		$model->abordado = true;
		$model->save();
		return response()->json(['msg' => 'Empreendimento salvo'], 200);
	}

	public function getForSelect(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$filter_id = AuthHelper::filterIds();

		$sub = Empreendimento::whereNotNull("consultores_has_predios.consultor_id");
		$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			$sub->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
		}
		$sub->where('ativo',true)->select('predios.id as predio_id');
		$query = DB::table(DB::raw("({$sub->toSql()}) as sub"))->select('predio_id')->mergeBindings($sub->getQuery())->groupBy('predio_id');
		$registros_ids = $query->pluck('predio_id')->toArray();
		$registros = Empreendimento::whereIn('predios.id', $registros_ids)
		             ->join('bairros','predios.bairro','=','bairros.id')
		             ->join('cidades','predios.cidade_id','=','cidades.id')
		             ->join('ceps','predios.cep','=','ceps.id')
		             ->groupBy('predios.id')
		             ->select(["predios.id as predio_id","predios.nome as predio_nome","cidades.uf as cidade_uf","cidades.abr as cidade_abr","cidades.centro_operacao as cidade_centro_operacao",
			             "cidades.id as cidade_id","cidades.nome as cidade_nome","cidades.slug as cidade_slug","predios.logradouro as predio_logradouro","ceps.cep as predio_cep",
			             "predios.complemento as predio_complemento","predios.numero as predio_numero","bairros.nome as predio_bairro","predios.cidade_id as predio_cidade_id"])->orderBy('predios.id')->get();
		$return = [];
		foreach ($registros as $registro){
			$return[] = [
				'predio_id' => $registro->predio_id,
				'nome' => $registro->predio_nome,
				'endereco' => [
					'logradouro' => $registro->predio_logradouro,
					'numero' => $registro->predio_numero,
					'cep' => $registro->predio_cep,
					'bairro' => $registro->predio_bairro,
					'cidade_id' => $registro->predio_cidade_id,
					'uf' => [
						'uf' => $registro->cidade_uf
					],
					'cidade' => [
						'abr' => $registro->cidade_abr,
						'centro_operacao' => $registro->cidade_centro_operacao,
						'id' => $registro->cidade_id,
						'nome' => $registro->cidade_nome,
						'slug' => $registro->cidade_slug,
						'uf' => $registro->cidade_uf
					]
				]
			];
		}
		return response()->json($return,200);
	}
}
