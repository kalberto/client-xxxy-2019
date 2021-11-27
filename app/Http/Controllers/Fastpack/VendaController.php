<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 08/08/2019
 * Time: 16:27
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 08/08/2019
 * Time: 16:27
 */

namespace App\Http\Controllers\Fastpack;

use App\Exports\VendasExport;
use App\Helpers\AuthHelper;
use App\Helpers\HTTAPI;
use App\Helpers\MailHelper;
use App\Helpers\MediaHelper;
use App\Helpers\NotMappedHelper;
use App\Helpers\PaginatorHelper;
use App\Http\Controllers\FastpackController;
use App\Http\Requests\Fastpack\Venda\AprovarVendaRequest;
use App\Http\Requests\Fastpack\Venda\GenerateDocumentoVendaRequest;
use App\Http\Requests\Fastpack\Venda\ListVendaRequest;
use App\Http\Requests\Fastpack\Venda\Request;
use App\Http\Requests\Fastpack\Venda\SalvarVendaRequest;
use App\Http\Requests\Fastpack\Venda\UploadVendaRequest;
use App\Http\Requests\Fastpack\Venda\VendaRequest;
use App\Model\Fastpack\Auditoria;
use App\Model\Fastpack\Help\Documento;
use App\Model\Fastpack\Help\FilialContratada;
use App\Model\Fastpack\Prospeccao;
use App\Model\Fastpack\Venda;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PHPJasper\PHPJasper;

class VendaController extends FastpackController {


	/**
	 * Display a listing of the resource.
	 *
	 * @param ListVendaRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(ListVendaRequest $request)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$params = $request->all();
		$limit = (isset($params['limit']) && is_numeric($params['limit']) && $params['limit'] > 0) ? $params['limit'] : 10;
		$order_by = "updated_at";
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
			$registros = Venda::whereIn('vendas.usuario_id',$filter_id);
		else
			$registros = Venda::whereNotNull('vendas.codigo');

		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('vendas.status', $params['status']);
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
		if (Schema::hasColumn('vendas', $order_by)){
			if($asc)
				$registros = $registros->orderBy('vendas.'.$order_by)->paginate($limit);
			else
				$registros = $registros->orderByDesc('vendas.'.$order_by)->paginate($limit);
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
	 * Display a listing of the resource.
	 *
	 * @param ListVendaRequest $request
	 *
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 */
	public function relatorio(ListVendaRequest $request)
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
			$registros = Venda::whereIn('vendas.usuario_id',$filter_id);
		else
			$registros = Venda::whereNotNull('vendas.codigo');
		if(isset($params['status']) && $params['status'] != 'todos'){
			$registros->where('vendas.status', $params['status']);
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
		if (Schema::hasColumn('vendas', $order_by)){
			if($asc)
				$registros = $registros->orderBy('vendas.'.$order_by)->get();
			else
				$registros = $registros->orderByDesc('vendas.'.$order_by)->get();
		}else{
			$registros = $registros->get();
		}
		return Excel::download(new VendasExport($registros),'vendas.xlsx');
	}

	/**
	 * Display a listing of the contratadas and filiais.
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function contratadas(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);

		$contratadas = DB::table('contratadas')->get();
		foreach ($contratadas as $contratada){
			$contratada->filiais = FilialContratada::select(["id","cnpj","nome","endereco"])->where('contratada_id',$contratada->id)->get();
		}

		return response()->json($contratadas,200);
	}

	/**
	 * Display a listing of the possibles vencimentos
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function vencimentos(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$vencimentos = NotMappedHelper::$vencimentos;
		return response()->json($vencimentos ,200);
	}

	/**
	 * Display a listing of the possibles ciclos
	 *
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ciclos(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$ciclos = NotMappedHelper::$ciclos;
		return response()->json($ciclos ,200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param VendaRequest|Request $request
	 * @param $codigo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(VendaRequest $request, $codigo)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$prospeccao = Prospeccao::find($codigo);
		if(!isset($prospeccao ))
			return response()->json(['msg' => 'Essa prospecção não existe'],404);
		if($prospeccao->status != 'V')
			return response()->json(['msg' => 'Prospecção não passível de conversão'],422);
		if(Venda::find($codigo) != null)
			return response()->json(['msg' => 'Já existe uma venda cadastrada para essa prospecção.'],422);

		Venda::criar($codigo,$request->ip());
		return response()->json(['msg' => 'Registro salvo com sucesso'],200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $codigo
	 * @return \Illuminate\Http\Response
	 */
	public function show($codigo)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$registro = Venda::show($codigo);
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
	 * @param SalvarVendaRequest|Request $request
	 * @param  string $codigo
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(SalvarVendaRequest $request, $codigo)
	{
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$data['codigo'] = $codigo;
		$venda = Venda::find($codigo);
		if($venda != null){
			if(($venda->status == 'E' || $venda->status == 'A') || (Auth::user()->tokenCan('admin') || Auth::user()->tokenCan('inteligencia'))){
				Venda::atualizar($data,$request->ip());
				$statusCode = 200;
				$response = [
					'msg' => 'Registro salvo com sucesso'
				];
			}else{
				$statusCode = 422;
				$response = [
					'msg' => 'Essa venda não pode ser alterada'
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
	 * Upload documentos for the venda
	 *
	 * @param UploadVendaRequest $request
	 * @param $codigo
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function uploadDocumento(UploadVendaRequest $request, $codigo){
		$file = $request->file('file');
		$path = storage_path('app').'/vendas/'.$codigo.'/';
		$file_name = MediaHelper::upload($file,$path,$file->getClientOriginalName());
		$data_db = array(
			'codigo'    => $codigo,
			'nome'      => $file_name,
		);
		$documento = Documento::salvar($data_db,$request->ip());
		$statusCode = 200;
		$response = [
			'msg' => 'Upload feito com sucesso.',
			'documento' => [
				'nome' => $documento->nome,
				'created_at' => $documento->created_at,
				'usuario' => Auth::user()->usuario
			]
		];
		return response()->json($response,$statusCode);
	}

	public function downloadDocumento($codigo, $nome){
		$documentos = Documento::where([['codigo',$codigo],['nome',$nome]])->count();
		$path = storage_path('app').'/vendas/'.$codigo.'/';
		$strings = explode('.',$nome);
		$ext = isset($strings[sizeof($strings) - 1]) ? $strings[sizeof($strings) - 1] : '';
		if($documentos > 0 && file_exists($path.$nome)){
			$headers = [
				'Content-Type' => 'application/'.$ext,
			];
			return response()->download($path.$nome, $nome, $headers);
		}else
			return response()->json(['msg' => 'Arquivo não encontrado'],404);
	}

	public function conclude(AprovarVendaRequest $request, $codigo){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$data = $request->all();
		$data['codigo'] = $codigo;
		$data['status'] = 'V';
		$venda = Venda::find($codigo);
		if($venda != null){
			if($venda->status == 'E' || $venda->status == 'A'){
				$dados_venda = $venda->getDadosVenda();
				$result = HTTAPI::notifyAudit($dados_venda);
				if(!$result['success']){
					return response()->json(['msg' => 'Não foi possível enviar a venda. Tente novamente mais tarde. Se o problema persistir, procure um administrador'],422);
				}
				$correcao = $venda->status == "A";
				if($correcao)
					MailHelper::vendaCorrigida(Venda::getNomeCliente($codigo),url("/vendas/editar/$codigo"),$codigo);
				else
					MailHelper::vendaConcluida(Venda::getNomeCliente($codigo),url("/vendas/editar/$codigo"),$codigo);
				Venda::atualizar($data,$request->ip());
				$venda->status = 'U';
				$venda->save();
				Auditoria::criar(['codigo'=>$codigo],$request->ip());
				$statusCode = 200;
				$response = [
					'msg' => 'Venda pronta para ser validada'
				];
			}else{
				$statusCode = 422;
				$response = [
					'msg' => 'Essa venda não pode ser alterada'
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
	 * @param Request $request
	 * @param $codigo
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function reject(Request $request,$codigo){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$venda = Venda::find($codigo);
		if(isset($venda)){
			$venda->reject();
			$response = ['msg' => "Venda cancelada"];
			$status_code = 200;
		}else{
			$response = ['msg' => "Venda não encontrada"];
			$status_code = 404;
		}
		return response()->json($response, $status_code);
	}


	public function getDadosVenda($codigo){
		$venda = Venda::find($codigo);
		$dados = $venda->getDadosVenda();
		$response = response()->json($dados);
		$response->header('charset', 'utf-8');
		return $response;
	}

	public function generateContrato(GenerateDocumentoVendaRequest $request, $codigo){
		$venda = Venda::find($codigo);
		if(isset($venda)){
			$dados_venda = $venda->getDadosContrato();
			if(isset($request->data))
				$dados_venda['data'] = $request->data;
			$file_name = 'contrato-venda-'.$codigo.'-'.date('d-m-y-his').'-'.Str::random(4);
			Storage::put("$file_name.json",json_encode(["venda" => $dados_venda]));
			$input = base_path("resources/reports/contrato/htt-contrato_venda.jrxml");
			$output = storage_path("app/vendas/$codigo/$file_name");

			$data_file = storage_path("app/$file_name.json");
			$options = [
				'format' => ['pdf'],
				'params' => [
					'img_xxxx' => base_path('resources/reports/logo-longa.png'),
					'img_fastpack' => base_path('resources/reports/logo-fastpack.png'),
					'cliente_report' => base_path("resources/reports/contrato/subreports/cliente_sub_report.jasper"),
					'contato_comercial' => base_path("resources/reports/contrato/subreports/contato_comercial.jasper"),
					'end_instalacao' => base_path("resources/reports/contrato/subreports/end_instalacao.jasper"),
					'fatura' => base_path("resources/reports/contrato/subreports/fatura.jasper"),
					'filiais' => base_path("resources/reports/contrato/subreports/filiais.jasper"),
					'pacotes' => base_path("resources/reports/contrato/subreports/pacotes.jasper"),
					'numeracao' => base_path("resources/reports/contrato/subreports/numeracao.jasper")
				],
				'locale' => 'en',
				'db_connection' => [
					'driver' => 'json',
					'data_file' => "\"$data_file\"",
				]
			];

			$jasper = new PHPJasper;

			if(!file_exists(storage_path("app/vendas/$codigo")))
				mkdir(storage_path("app/vendas/$codigo"),0755,true);

			$jasper->process(
				$input,
				$output,
				$options
			)->execute();

			Storage::delete("$file_name.json");

			$data_db = array(
				'codigo'    => $codigo,
				'nome'      => "$file_name.pdf",
			);
			$documento = Documento::salvar($data_db,$request->ip());
			$statusCode = 200;
			$response = [
				'msg' => 'Geração feito com sucesso.',
				'documento' => [
					'nome' => $documento->nome,
					'created_at' => $documento->created_at,
					'usuario' => Auth::user()->usuario
				]
			];
			return response()->json($response,$statusCode);
		}else{
			return response()->json(['msg' => "Venda não encontrada"],404);
		}
	}

	public function generateChecklist(GenerateDocumentoVendaRequest $request, $codigo){
		$venda = Venda::find($codigo);
		if(isset($venda)){
			$dados_venda = $venda->getDadosChecklist();
			if($dados_venda != false){
				$file_name = 'checklist-venda-'.$codigo.'-'.date('d-m-y-his').'-'.Str::random(4);
				Storage::put("$file_name.json",json_encode(["venda" => $dados_venda]));
				$input = base_path("resources/reports/check-list/check_list.jasper");
				$output = storage_path("app/vendas/$codigo/$file_name");

				$data_file = storage_path("app/$file_name.json");
				$options = [
					'format' => ['pdf'],
					'params' => [
						'img_xxxx' => base_path('resources/reports/logo-longa.png'),
						'img_fastpack' => base_path('resources/reports/logo-fastpack.png'),
					],
					'locale' => 'en',
					'db_connection' => [
						'driver' => 'json',
						'data_file' => "\"$data_file\"",
					]
				];

				$jasper = new PHPJasper;

				$jasper->process(
					$input,
					$output,
					$options
				)->execute();

				Storage::delete("$file_name.json");

				$data_db = array(
					'codigo'    => $codigo,
					'nome'      => "$file_name.pdf",
				);
				$documento = Documento::salvar($data_db,$request->ip());

				$statusCode = 200;
				$response = [
					'msg' => 'Geração feito com sucesso.',
					'documento' => [
						'nome' => $documento->nome,
						'created_at' => $documento->created_at,
						'usuario' => Auth::user()->usuario
					]
				];
				return response()->json($response,$statusCode);
			}else{
				return response()->json(['msg' => "Venda não possui smartbox e/ou 0800"],422);
			}
		}else{
			return response()->json(['msg' => "Venda não encontrada"],404);
		}
	}
}
