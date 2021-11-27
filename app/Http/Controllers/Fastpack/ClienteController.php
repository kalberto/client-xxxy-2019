<?php

namespace App\Http\Controllers\Fastpack;

use App\Exports\ClientesExport;
use App\Helpers\AuthHelper;
use App\Helpers\MediaHelper;
use App\Helpers\PaginatorHelper;
use App\Http\Requests\Fastpack\Cliente\ClienteRequest;
use App\Http\Requests\Fastpack\Cliente\CreateRequest;
use App\Http\Requests\Fastpack\Cliente\EditRequest;
use App\Http\Requests\Fastpack\Cliente\Request;
use App\Http\Requests\Fastpack\Cliente\UploadRequest;
use App\Imports\ClientesImport;
use App\Model\Fastpack\Cliente;
use App\Model\Fastpack\Empreendimento;
use App\Model\Fastpack\Predio;
use App\Model\Fastpack\Relationship\PredioHasCliente;
use App\Rules\DocumentoValid;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;


class ClienteController extends FastpackController
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
		$q = null;
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
				$registros  = Cliente::select(['clientes.*'])
					->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
					->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
					->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
					->leftJoin('consultores_has_predios as cpp','predios_has_clientes.predio_id','=','cpp.predio_id')
					->leftJoin('consultores','cpp.consultor_id','=','consultores.id')
					->leftJoin('consultores_has_predios as cpe','empreendimentos.id','=','cpe.predio_id')
					->leftJoin('consultores as consultores_emp','cpe.consultor_id','=','consultores_emp.id')
					->whereIn('cpp.consultor_id',$consultores_ids)->orWhereIn('cpe.consultor_id',$consultores_ids);
			else
				$registros = Cliente::leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
									->leftJoin('consultores_has_predios as cpe','empreendimentos.id','=','cpe.predio_id')
									->leftJoin('consultores_has_predios as cpp','predios_has_clientes.predio_id','=','cpp.predio_id')
									->whereIn('cpp.consultor_id',$consultores_ids)->orWhereIn('cpe.consultor_id',$consultores_ids);
		}else{
			$registros = Cliente::whereNotNull('clientes.documento');
		}
		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('clientes.status', $params['status']);
		}
		if(isset($params['q'])){
			$q = $params['q'];
			$registros = $registros->search($params['q']);
		}
		$registros->groupBy('clientes.documento');
		if (Schema::hasColumn('clientes', $order_by)){
			if($asc)
				$registros = $registros->orderBy('clientes.'.$order_by)->orderBy('clientes.nome')->paginate($limit);
			else
				$registros = $registros->orderByDesc('clientes.'.$order_by)->orderByDesc('clientes.nome')->paginate($limit);
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
				$registros  = Cliente::leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
				                     ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
				                     ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
				                     ->leftJoin('consultores_has_predios as cpp','predios_has_clientes.predio_id','=','cpp.predio_id')
				                     ->leftJoin('consultores','cpp.consultor_id','=','consultores.id')
				                     ->leftJoin('consultores_has_predios as cpe','empreendimentos.id','=','cpe.predio_id')
				                     ->leftJoin('consultores as consultores_emp','cpe.consultor_id','=','consultores_emp.id')
				                     ->whereIn('cpp.consultor_id',$consultores_ids)->orWhereIn('cpe.consultor_id',$consultores_ids);
			else
				$registros = Cliente::leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
				                    ->leftJoin('consultores_has_predios as cpe','empreendimentos.id','=','cpe.predio_id')
				                    ->leftJoin('consultores_has_predios as cpp','predios_has_clientes.predio_id','=','cpp.predio_id')
				                    ->whereIn('cpp.consultor_id',$consultores_ids)->orWhereIn('cpe.consultor_id',$consultores_ids);
		}else{
			$registros = Cliente::whereNotNull('clientes.documento');
		}
		$registros->select('clientes.*');

		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('clientes.status', $params['status']);
		}
		if(isset($params['q'])){
			$registros = $registros->search($params['q']);
		}
		$registros->groupBy('clientes.documento');
		if (Schema::hasColumn('clientes', $order_by)){
			if($asc)
				$registros = $registros->orderBy('clientes.'.$order_by)->orderBy('clientes.nome')->get();
			else
				$registros = $registros->orderByDesc('clientes.'.$order_by)->orderByDesc('clientes.nome')->get();
		}else{
			$registros = $registros->get();
		}
		return Excel::download(new ClientesExport($registros),'clientes.xlsx');
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
		$cliente = Cliente::criar($data, $request->ip());
		$response = [
			'msg' => 'Registro salvo com sucesso',
			'documento' => $cliente->documento
		];
		return response()->json($response);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $documento
	 * @return \Illuminate\Http\Response
	 */
	public function show($documento)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$registro = Cliente::show($documento);
		if(isset($registro)){
			$filter_id = AuthHelper::filterIds();
			if($filter_id != false){
				$consultores_ids = AuthHelper::getConsultorIds($filter_id);
				$count = DB::table("predios")->leftJoin('predios_has_clientes','predios.id','=','predios_has_clientes.predio_id')
				                             ->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
				                             ->whereIn('consultores_has_predios.consultor_id',$consultores_ids)
				                             ->where(function($query) use ($registro){
				                             	$query->where('predios.cliente_documento',$registro->documento)->orWhere('predios_has_clientes.cliente_documento',$registro->documento);
				                             })->count();
				if($count <= 0)
					return response()->json(['msg' => 'Você não possui permissão para visualizar esse cliente'],403);
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
	 * Get the predios for the specific cliente
	 *
	 * @param string $documento
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function predios($documento){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$predios = Cliente::predios($documento);
		return response()->json($predios,200);
	}

	/**
	 * Get the empreendimentos for the specific cliente
	 *
	 * @param string $documento
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function empreendimentos($documento){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$registros = Cliente::empreendimentos($documento);
		return response()->json($registros,200);
	}

	/**
	 * Get the predio for the specific cliente
	 *
	 * @param string $documento
	 * @param string $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function predio($documento,$id){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$id = Predio::static_getOnlyNumbers($id);
		$predio_has_cliente = PredioHasCliente::where([['predio_id',$id],['cliente_documento',$documento]])->first();
		$status_code = 404;
		$response = "Não encontrado";
		if(isset($predio_has_cliente)){
			$predio = Predio::find($id);
			if(isset($predio)){
				if(isset($predio_has_cliente->complemento) && $predio_has_cliente->complemento != '')
					$predio->complemento = $predio->complemento . ' - ' . $predio_has_cliente->complemento;
				$status_code = 200;
				$response = $predio;
			}
		}
		return response()->json($response,$status_code);
	}

	/**
	 * Get the empreendimento for the specific cliente
	 *
	 * @param string $documento
	 * @param string $id
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function empreendimento($documento,$id){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$id = Empreendimento::static_getOnlyNumbers($id);
		$status_code = 404;
		$response = "Não encontrado";
		$predio = Empreendimento::find($id);
		if(isset($predio)){
			$status_code = 200;
			$response = $predio;
		}
		return response()->json($response,$status_code);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param EditRequest|Request $request
	 * @param  string $documento
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(EditRequest $request, $documento)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$data['creating'] = false;
		$data['documento'] = $documento;
		if(($cliente = Cliente::find($documento)) != null){
			$filter_id = AuthHelper::filterIds();
			if($filter_id != false){
				$consultores_ids = AuthHelper::getConsultorIds($filter_id);
				$count = DB::table("predios")->leftJoin('predios_has_clientes','predios.id','=','predios_has_clientes.predio_id')
				                             ->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
				                             ->whereIn('consultores_has_predios.consultor_id',$consultores_ids)
				                             ->where(function($query) use ($documento){
				                             	$query->where('predios.cliente_documento',$documento)->orWhere('predios_has_clientes.cliente_documento',$documento);
				                             })->count();
				if($count <= 0)
					return response()->json(['msg' => 'Você não possui permissão para editar esse cliente'],403);
			}
			Cliente::atualizar($data,$request->ip());
			$statusCode = 200;
			$response = [
				'msg' => 'Registro salvo com sucesso'
			];
		}else{
			$statusCode = 404;
			$response = [
				'msg' => 'Registro não encontrado'
			];
		}
		return response()->json($response,$statusCode);
	}


	/**
	 * Verify if the current cliente is available
	 *
	 * @param string $documento
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function verify($documento){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$cliente = Cliente::find($documento);
		if(isset($cliente)){
			$result = $cliente->requestVf();
			if($result['success'] == false)
				return response()->json($result,422);
			return response()->json($result,200);
		}else{
			return response()->json(['msg' => "Cliente não encontrado"],422);
		}
	}

	/**
	 * Download the base sheet for the upload
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	public function download(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$file= public_path(). "/base-sheets/import_clientes_base.xlsx";
		$headers = [
			'Content-Type' => 'application/xlsx',
		];
		return response()->download($file, "import_clientes_base.xlsx", $headers);
	}


	public function getForSelect(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		if(Auth::user()->tokenCan('list-clientes-all')){
			$clientes = DB::table("clientes")->select("documento","nome")->get();
		}else{
			$clientes = array();
			$documentos = array();
			if(Auth::user()->tokenCan('list-clientes-vendedor')){
				$clientes_db = DB::table('clientes')->select(["clientes.documento","clientes.nome"])
				                ->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
				                ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
				                ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
				                ->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
				                ->leftJoin('consultores','consultores_has_predios.consultor_id','=','consultores.id')
				                ->leftJoin('consultores as consultores_emp','empreendimentos.consultor_id','=','consultores_emp.id')
				                ->where('consultores.usuario_id',Auth::id())->orWhere('consultores_emp.usuario_id',Auth::id())->get();
				foreach ($clientes_db as $item){
					if(!in_array($item->documento,$documentos)){
						$clientes[] = $item;
						$documentos[] = $item->documento;
					}
				}
			}
			if(Auth::user()->tokenCan('list-clientes-gerente')){
				$clientes_db = DB::table('clientes')->select(["clientes.documento","clientes.nome"])
				                ->leftJoin('predios as empreendimentos','clientes.documento','=','empreendimentos.cliente_documento')
				                ->leftJoin('predios_has_clientes','clientes.documento','=','predios_has_clientes.cliente_documento')
				                ->leftJoin('predios','predios_has_clientes.predio_id','=','predios.id')
								->leftJoin('consultores_has_predios','predios.id','=','consultores_has_predios.predio_id')
				                ->leftJoin('consultores','consultores_has_predios.consultor_id','=','consultores.id')
								->leftJoin('consultores as consultores_emp','empreendimentos.consultor_id','=','consultores_emp.id')
				                ->leftJoin('usuarios','consultores.usuario_id','=','usuarios.id')
				                ->leftJoin('usuarios as usuarios_emp','consultores_emp.usuario_id','=','usuarios_emp.id')
				                ->where('usuarios.manager_id',Auth::id())->orWhere('usuarios_emp.manager_id',Auth::id())->get();
				foreach ($clientes_db as $item){
					if(!in_array($item->documento,$documentos)){
						$clientes[] = $item;
						$documentos[] = $item->documento;
					}
				}
			}
		}
		return response()->json($clientes,200);
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
		$excel_sheets = (new ClientesImport())->toArray($path.$file_name,'web_site');
		$documentos = DB::table("clientes")->pluck("documento")->all();
		$ufs = DB::table('ufs')->pluck('uf')->all();
		$predios = DB::table('predios')->pluck('id')->all();
		$size = sizeof($excel_sheets[0]);
		$i = 0;
		foreach ($excel_sheets[0] as $key => $line){
			$line['cidade_slug'] = Str::slug($line["cidade"].'-'.$line["uf"]);
			$test = $this->checkLine($line,$documentos,$predios,$ufs);
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
			Excel::import(new ClientesImport(),$path.$file_name,'web_site');
			echo "|UploadDone|";
			echo json_encode(['msg' => 'Importado com sucesso']);
		}
		MediaHelper::move_file($path,"upload/temp/",$file_name);
	}

	private function checkHeader($heading){
		$expected_header = ["documento","nome","contato","inscricao_estadual","predios"];
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

	private function checkLine($line,&$documentos,$predios,$ufs){
		$data = [
			'documento' => $line['documento'],
			'nome' => $line['nome'],
			'inscricao_estadual' => $line['inscricao_estadual'],
			'contato' => $line['contato'],
			'predios' => explode(',',preg_replace("/[^0-9,]/",'',$line['predios'])),
			'cep' => $line['cep'],
			'uf' => mb_strtoupper($line['uf'],"UTF-8"),
			'cidade' => mb_strtoupper($line['cidade'],"UTF-8"),
			'cidade_slug' => $line['cidade_slug'],
			'bairro' => $line['bairro'],
			'logradouro' => $line['logradouro'],
			'numero' => $line['numero'],
			'complemento' => $line['complemento'],

		];
		$validator = Validator::make($data,
			[
				'documento' => ['required', 'min:11', 'max:14', new DocumentoValid(), Rule::notIn($documentos)],
				'nome' => 'required|max:50',
				'inscricao_estadual' => 'nullable|max:45',
				'predios' => 'array',
				'predios.*' =>  Rule::in($predios),
				'numero' => 'required|max:10',
				'cep' => 'required|max:8|min:8',
				'uf' => 'required|'.Rule::in($ufs),
				'cidade' => 'required',
				'cidade_slug' => 'exists:cidades,slug',
				'logradouro' => 'required|max:40',
				'bairro' => 'required|max:25',
				'complemento' => 'required|max:30',
			],
			[
				'in' => 'O Predio :input é inválido.',
				'not_in' => "O documento já existe ou está duplicado na planilha.",
				'exists' => 'Cidade não cadastrada'
			]
		);
		$documentos[] = $line['documento'];
		if($validator->fails()){
			return $validator->errors()->all();
		}
		return true;
	}
}
