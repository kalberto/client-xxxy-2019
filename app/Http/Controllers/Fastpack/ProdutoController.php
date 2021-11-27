<?php

namespace App\Http\Controllers\Fastpack;

use App\Helpers\PaginatorHelper;
use App\Http\Requests\Fastpack\Produto\Request;
use App\Http\Traits\Activable;
use App\Model\Fastpack\Produto;
use App\Model\Fastpack\Tipo;
use App\Http\Controllers\FastpackController;
use Illuminate\Support\Facades\Schema;


class ProdutoController extends FastpackController
{

	use Activable;

	/**
	 * @var string Name and namespace of the model
	 */
	protected $modelName = "App\Model\Fastpack\Produto";

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
		$order_by = "id";
		$asc = false;
		$q = '';
		if(isset($params['sort'])){
			$order_by = $params['sort'];
			if(substr($order_by,0,1) == '-'){
				$asc = false;
				$order_by = substr($order_by,1);
			}
		}
		$registros = Produto::whereNotNull('nome');
		if(isset($params['q'])){
			$q = $params['q'];
			$registros = $registros->search($params['q']);
		}
		if (Schema::hasColumn('produtos', $order_by)){
			if($asc)
				$registros = $registros->orderBy($order_by)->paginate($limit);
			else
				$registros = $registros->orderByDesc($order_by)->paginate($limit);
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


	public function tipos(){
		if(!$this->hasPermission())
			return response()->json(['error' => 'Unauthorized.'], 403);
		$tipos = Tipo::all();
		return response()->json($tipos,200);
	}
}
