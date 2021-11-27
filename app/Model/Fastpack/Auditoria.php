<?php

namespace App\Model\Fastpack;

use App\Helpers\HTTAPI;
use App\Helpers\MailHelper;
use App\Helpers\NotMappedHelper;
use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Http\Traits\SearchModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Auditoria extends Model
{
	use FastpackModelLog, SearchModel, NumbersOnly;

	public $incrementing = true;
	protected $table = 'auditorias';
	protected $fillable = ['codigo','usuario_id','observacoes','status','tipo','auditoria_anterior'];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['cliente_nome','consultor','auditor','status_nome','tipo_nome'];

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = array(
		/**
		 * Columns and their priority in search results.
		 * Columns with higher values are more important.
		 * Columns with equal values have equal importance.
		 *
		 * @var array
		 */
		'columns' => array(
			'auditorias.codigo',
			'clientes.documento' => 'getOnlyNumbers',
			'clientes.nome',
			'auditor.usuario',
			'consultor.usuario',
		),
		'joins' => [
			'vendas' => ['auditorias.codigo','vendas.codigo'],
			'prospeccoes' => ['auditorias.codigo','prospeccoes.codigo'],
			'clientes' => ['prospeccoes.cliente_documento','clientes.documento'],
			'usuarios as auditor' => ['auditorias.usuario_id','auditor.id'],
			'usuarios as consultor' => ['vendas.usuario_id','consultor.id'],
		]
	);

	public function getClienteNomeAttribute()
	{
		return DB::table('prospeccoes')->select("nome")->join('clientes','prospeccoes.cliente_documento','=','clientes.documento')->where("codigo",$this->codigo)->first()->nome;
	}

	public function getConsultorAttribute(){
		$consultor = DB::table('vendas')->select("usuario")->join('usuarios','vendas.usuario_id','=','usuarios.id')->where("codigo",$this->codigo)->first();
		if(isset($consultor->usuario))
			return $consultor->usuario;
		return "Não possui consultor";
	}

	public function getAuditorAttribute(){
		$auditor = DB::table('usuarios')->select("usuario")->where("id",$this->usuario_id)->first();
		if(isset($auditor->usuario))
			return $auditor->usuario;
		return "Não possui consultor";
	}

	public function getPreviousAttribute(){
		$auditoria = DB::table('auditorias')->select('id','tipo')->where('id',$this->auditoria_anterior)->first();
		if(isset($auditoria))
			return [
				'id' => $auditoria->id,
				'tipo_nome' => NotMappedHelper::tipoAuditoria($auditoria->tipo)
			];
		else
			return null;
	}

	public function getLastAttribute(){
		$auditoria = DB::table('auditorias')->select('id','tipo')->where('codigo',$this->codigo)->orderBy('created_at','desc')->first();
		if(isset($auditoria) && $auditoria->id != $this->id)
			return [
				'id' => $auditoria->id,
				'tipo_nome' => NotMappedHelper::tipoAuditoria($auditoria->tipo)
			];
		else
			return null;
	}

	public function getStatusNomeAttribute(){
		return NotMappedHelper::statusAuditoria($this->status);
	}

	public function getTipoNomeAttribute(){
		return NotMappedHelper::tipoAuditoria($this->tipo);
	}

	public static function criar($data,$ip){
		$dados_auditoria = [
			"codigo"        => $data["codigo"],
			"status"        => isset($data["status"]) ? $data["status"] :"E",
			"tipo"          => isset($data["tipo"]) ? $data["tipo"] : "V",
			"usuario_id"    => Auth::id(),
			"auditoria_anterior" => isset($data["auditoria_anterior"]) ? $data["auditoria_anterior"] : null,
			"observacoes" => ''
		];
		$model = Auditoria::firstOrCreate(
			[
				'id' => isset($data['id']) ? $data['id'] : null,
			],
			$dados_auditoria
		);
		$model->saveLog($ip, 'insert',$dados_auditoria);
		return $model;
	}

	public static function show($id){
		$auditoria = Auditoria::find($id);
		if(!isset($auditoria))
			return null;
		$auditoria->append(['previous','last']);
		return $auditoria;
	}

	public function go($data, $ip){
		if($this->usuario_id != null)
			$this->usuario_id = Auth::id();
		if($this->tipo == "V"){
			if(self::where([["codigo",$this->codigo],["tipo","V"],["status","R"]])->count() > 0)
				MailHelper::validacaoCorrigida(url("/vendas/editar/".$this->codigo),$this->codigo);
			else
				MailHelper::validacaoAprovada(url("/vendas/editar/".$this->codigo),$this->codigo);
			self::criar(array(
				"codigo"                => $this->codigo,
				"tipo"                  => "W",
				"auditoria_anterior"    => $this->id
			),$ip);
		}elseif ($this->tipo == "W"){
			self::criar(array(
				"codigo"                => $this->codigo,
				"tipo"                  => "A",
				"auditoria_anterior"    => $this->id
			),$ip);
		}elseif ($this->tipo == "A"){
			$venda = Venda::find($this->codigo);
			$dados_venda = $venda->getDadosVenda();
			$result = HTTAPI::notifyConcluded($dados_venda);
			if($result['success']){
				MailHelper::auditoriaAprovada($this->codigo);
				$venda->aprovar($result['result']->service_id,$ip);
			}else{
				$this->observacoes = isset($data["observacoes"]) ? $data["observacoes"]: "";
				$this->save();
				$this->saveLog($ip, 'update',['observacoes' => $data["observacoes"]]);
				return false;
			}
		}
		$dados_auditoria = array(
			"closed"        => Carbon::now(),
			"status"        => "A",
			"observacoes"   => isset($data["observacoes"]) ? $data["observacoes"]: ""
		);
		$this->fill($dados_auditoria);
		$this->save();
		$this->saveLog($ip, 'update',$dados_auditoria);
		return true;
	}

	public function noGo($data, $ip){
		if($this->tipo == "V"){
			$venda = Venda::find($this->codigo);
			$venda->rejeitar($ip);
			MailHelper::validacaoDevolvido(url("/vendas/editar/".$this->codigo),$this->codigo);
		}elseif ($this->tipo == "W"){
			self::criar(array(
				"codigo"                => $this->codigo,
				"tipo"                  => "V",
				"auditoria_anterior"    => $this->id
			),$ip);
		}elseif ($this->tipo == "A"){
			self::criar(array(
				"codigo"                => $this->codigo,
				"tipo"                  => "V",
				"auditoria_anterior"    => $this->id
			),$ip);
			$venda = Venda::find($this->codigo);
			MailHelper::auditoriaDevolucao($venda->cliente_nome,url("/vendas/editar/".$this->codigo),$this->codigo);
		}
		$dados_auditoria = array(
			"closed"        => Carbon::now(),
			"status"        => "R",
			"observacoes"   => isset($data["observacoes"]) ? $data["observacoes"]: ""
		);
		$this->fill($dados_auditoria);
		if($this->usuario_id != null)
			$this->usuario_id = Auth::id();
		$this->save();
		$this->saveLog($ip, 'update',$dados_auditoria);
	}
}
