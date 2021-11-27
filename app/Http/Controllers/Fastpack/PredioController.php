<?php

namespace App\Http\Controllers\Fastpack;

use App\Exports\PrediosExport;
use App\Helpers\AuthHelper;
use App\Helpers\MediaHelper;
use App\Helpers\PaginatorHelper;
use App\Helpers\VariableHelper;
use App\Http\Requests\Fastpack\Predio\AbordarRequest;
use App\Http\Requests\Fastpack\Predio\AtivarRequest;
use App\Http\Requests\Fastpack\Predio\CreateRequest;
use App\Http\Requests\Fastpack\Predio\EditRequest;
use App\Http\Requests\Fastpack\Predio\Request;
use App\Http\Requests\Fastpack\Predio\UploadRequest;
use App\Http\Traits\Activable;
use App\Imports\PrediosImport;
use App\Model\Fastpack\Predio;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;


class PredioController extends FastpackController
{

	use Activable;

	/**
	 * @var string Name and namespace of the model
	 */
	protected $modelName = "App\Model\Fastpack\Predio";

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
			$sub = Predio::whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			if(!isset($params['q']))
				$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}else{
			$sub = Predio::whereNotNull('predios.id');
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

		$registros = Predio::whereIn('predios.id',$registros_ids);
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
			$sub = Predio::whereIn('consultores_has_predios.consultor_id',$consultores_ids);
			if(!isset($params['q']))
				$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		}else{
			$sub = Predio::whereNotNull('predios.id');
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
		$registros = DB::table('predios')->select('predios.id','usuarios.usuario')
		                                                 ->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
		                                                 ->join("consultores","consultores_has_predios.consultor_id","=","consultores.id")
		                                                 ->join("usuarios", "consultores.usuario_id", "=", "usuarios.id")->whereIn('predios.id',$registros_ids);
		if (Schema::hasColumn('predios', $order_by)){
			if($asc)
				$registros->orderBy('predios.'.$order_by)->orderBy('predios.id');
			else
				$registros->orderByDesc('predios.'.$order_by)->orderByDesc('predios.id');
		}
		$registros = $registros->get();
		return Excel::download(new PrediosExport($registros),'predios.xlsx');
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

		$predio = Predio::criar($data,$request->ip());
		$response = [
			'msg' => 'Registro salvo com sucesso',
			'id' => $predio->getOriginal('id')
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
		$registro = Predio::show($id);
		if(isset($registro)){
			$filter_id = AuthHelper::filterIds();
			if($filter_id != false){
				$consultores_ids = AuthHelper::getConsultorIds($filter_id);
				if(!(DB::table('consultores_has_predios')->where('predio_id','=',$id)->whereIn('consultor_id', $consultores_ids)->count()))
					return response()->json(['msg' => 'Você não possui permissão para visualizar esse prédio'],403);
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
				return response()->json(['msg' => 'Você não possui permissão para editar esse prédio'],403);
		}
		Predio::atualizar($data,$request->ip());
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
					return response()->json(['msg' => 'Você não possui permissão para editar esse prédio'],403);
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
	 * Seta o predio como abordado
	 *
	 * @param AbordarRequest $request
	 * @param string $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function abordar(AbordarRequest $request,$id){
		$model = Predio::find(Predio::static_getOnlyNumbers($id));
		if(!isset($model))
			return response()->json(['msg' => 'Prédio não encontrado'], 404);
		$model->abordado = true;
		$model->save();
		return response()->json(['msg' => 'Prédio salvo'], 200);
	}

	public function upload(UploadRequest $request){
		$file = $request->file('file');
		$path = 'upload/using/';
		$file_name = MediaHelper::upload($file,$path,$file->getClientOriginalName());
		$heading = (new HeadingRowImport)->toArray($path.$file_name,'web_site');
		if($this->checkHeader($heading)){
			return response()->stream(function () use ($path,$file_name){
				$this->stream($path,$file_name);
			})->send();
		}else{
			$statusCode = 422;
			$response = ['msg' => 'Por favor, utilize a planilha base como referência.'];
		}
		return response()->json($response,$statusCode);
	}

	public function stream($path,$file_name){
		$error = false;
		$errors = [];
		$excel_sheets = (new PrediosImport())->toArray($path.$file_name,'web_site');
		$ufs = DB::table('ufs')->pluck('uf')->all();
		$size = sizeof($excel_sheets[0]);
		$i = 0;
		foreach ($excel_sheets[0] as $key => $line){
			$line['cidade_slug'] = Str::slug($line["cidade"].'-'.$line["uf"]);
			$test = $this->checkLine($line,$ufs);
			if($test !== true){
				$error = true;
				$errors[] = [
					"linha" => $key + 2,
					"errors"  => $test
				];
			}
			$i++;
			if($i == 50){
				$i=0;
				echo "|=".number_format($key/$size*100,2,'.','');
				ob_flush();
				flush();
			}
		}

		ob_flush();
		flush();
		if($error){
			echo "|CheckingError|";
			echo json_encode($errors);
		}else{
			echo "|CheckingDone|";
			Session::put('current_upload_size',$size);
			Excel::import(new PrediosImport(),$path.$file_name,'web_site');
			echo "|UploadDone|";
			echo json_encode(['msg' => 'Importado com sucesso']);
		}
		MediaHelper::move_file($path,"upload/temp/",$file_name);
	}

	/**
	 * Download the base sheet for the upload
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	public function download(){
		$file= public_path(). "/base-sheets/import_predios_base.xlsx";
		$headers = [
			'Content-Type' => 'application/xlsx',
		];
		return response()->download($file, "import_predios_base.xlsx", $headers);
	}

	public function getForSelect(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$filter_id = AuthHelper::filterIds();
		$sub = Predio::whereNotNull("consultores_has_predios.consultor_id");
		$sub->join('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id');
		if($filter_id != false){
			$consultores_ids = AuthHelper::getConsultorIds($filter_id);
			$sub->whereIn('consultores_has_predios.consultor_id',$consultores_ids);
		}
		$sub->where('ativo',true)->select('predios.id as predio_id');
		$query = DB::table(DB::raw("({$sub->toSql()}) as sub"))->select('predio_id')->mergeBindings($sub->getQuery())->groupBy('predio_id');
		$registros_ids = $query->pluck('predio_id')->toArray();
		$registros = Predio::whereIn('predios.id', $registros_ids)
		             ->join('bairros','predios.bairro','=','bairros.id')
		             ->join('cidades','predios.cidade_id','=','cidades.id')
		             ->join('ceps','predios.cep','=','ceps.id')
		             ->select(["predios.id as predio_id","predios.nome as predio_nome","cidades.uf as cidade_uf","cidades.abr as cidade_abr","cidades.centro_operacao as cidade_centro_operacao",
			             "cidades.id as cidade_id","cidades.nome as cidade_nome","cidades.slug as cidade_slug","predios.logradouro as predio_logradouro","ceps.cep as predio_cep",
			             "predios.complemento as predio_complemento","predios.numero as predio_numero","bairros.nome as predio_bairro","predios.cidade_id as predio_cidade_id"])->orderBy('predios.id')->get();
		$return = [];
		foreach ($registros as $predio){
			$return[] = [
				'predio_id' => $predio->predio_id,
				'nome' => $predio->predio_nome,
				'endereco' => [
					'logradouro' => $predio->predio_logradouro,
					'numero' => $predio->predio_numero,
					'cep' => $predio->predio_cep,
					//'complemento' => $predio->predio_complemento,
					'bairro' => $predio->predio_bairro,
					'cidade_id' => $predio->predio_cidade_id,
					'uf' => [
						'uf' => $predio->cidade_uf
					],
					'cidade' => [
						'abr' => $predio->cidade_abr,
						'centro_operacao' => $predio->cidade_centro_operacao,
						'id' => $predio->cidade_id,
						'nome' => $predio->cidade_nome,
						'slug' => $predio->cidade_slug,
						'uf' => $predio->cidade_uf
					]
				]
			];
		}
		return response()->json($return,200);
	}

	private function checkHeader($heading){
		$expected_header = ["nome","logradouro","numero","complemento","consultor","uf","cidade","regional","cep","bairro","abordado","ativo"];
		if(sizeof($heading) > 0){
			if(sizeof($heading[0]) > 0){
				foreach ($expected_header as $item){
					if(!in_array($item,$heading[0][0]))
						return false;
				}
				return true;
			}
		}
		return false;
	}

	private function checkLine($line,$ufs){
		$consultor_id = DB::table("usuarios")->select("consultores.id")->join("consultores","usuarios.id","consultores.usuario_id")->where("usuarios.usuario",$line["consultor"])->pluck("consultores.id");
		$consultor_id = $consultor_id->count() > 0 ? $consultor_id->first() : null;
		//$consultor_id = null;
		$data = [
			'nome' => $line['nome'],
			'logradouro' => $line['logradouro'],
			'numero' => $line['numero'],
			'complemento' => $line['complemento'],
			'consultor_id' => $consultor_id,
			'uf' => mb_strtoupper($line['uf'],"UTF-8"),
			'cidade' => mb_strtoupper($line['cidade'],"UTF-8"),
			'cidade_slug' => $line['cidade_slug'],
			'regional' => $line['regional'],
			'cep' => $line['cep'],
			'bairro' => $line['bairro'],
		];
		$validator = Validator::make($data,
			[
				'nome' => 'required|max:100',
				'logradouro' => 'required|max:40',
				'numero' => 'required|max:9999999999|numeric',
				'consultor_id' => 'required|numeric',
				'cep' => 'required|max:8|min:8',
				'uf' => 'required|'.Rule::in($ufs),
				'cidade' => 'required',
				'cidade_slug' => 'exists:cidades,slug',
				'bairro' => 'required|max:25',
				'regional' => 'max:45',
				'complemento' => 'required|max:30',
			],
			[
				'consultor_id.required' => "Consultor não encontrado",
				'consultor_id.numeric'  => "Consultor não encontrado",
				'cidade.exists'         => "A cidade não existe",
				'exists' => 'Cidade não cadastrada'
			]);
		if($validator->fails()){
			return $validator->errors()->all();
		}
		return true;
	}
}
