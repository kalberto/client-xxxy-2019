<?php

namespace App\Helpers;

use App\Mail\Venda\VendaMail;
use App\Model\Fastpack\Venda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailHelper {

	private static function getDebugUsers(){
		return [(object)[
			'email' => 'alberto.almeida@xxxx',
			'name' => "Alberto"
		]];
	}

	public static function vendaConcluida($cliente_nome,$link_venda,$codigo_venda){
		$message = "A venda do cliente ".$cliente_nome." foi concluída. Enviado para Validação";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$users = self::getUserValidacao($codigo_venda);
		}
		self::send($users, new VendaMail("Venda Concluída",$message,$link_venda,$codigo_venda));
	}

	public static function vendaCorrigida($cliente_nome,$link_venda,$codigo_venda){
		$message = "A venda do cliente ".$cliente_nome." foi corrigida. Enviado para Validação";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$users = self::getUserValidacao($codigo_venda);
		}
		self::send($users, new VendaMail("Venda Corrigida",$message,$link_venda,$codigo_venda));
	}

	public static function validacaoDevolvido($link_venda,$codigo_venda){
		$message = "Validação possui problemas e foi devolvido para sua fase";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$ids = self::getConsultorGerenteId($codigo_venda);
			$users = DB::table('usuarios')->select(['name','email'])
			                              ->whereIn('id',$ids)->whereNotNull('name')
			                                                  ->whereNotNull('email')->get()->toArray();
		}
		self::send($users, new VendaMail("Validação Devolvido",$message,$link_venda,$codigo_venda));
	}

	public static function validacaoAprovada($link_venda,$codigo_venda){
		$message = "Validação Ok. Em fase de auditoria";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$ids = self::getConsultorGerenteId($codigo_venda);
			$users = DB::table('usuarios')->select(['name','email'])
			                              ->whereIn('id',$ids)->whereNotNull('name')
			                                                  ->whereNotNull('email')->get()->toArray();
		}
		self::send($users, new VendaMail("Validação Aprovado",$message,$link_venda,$codigo_venda));
	}

	public static function validacaoCorrigida($link_venda,$codigo_venda){
		$message = "Validação corrigida. Em fase de auditoria";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$ids = self::getConsultorGerenteId($codigo_venda);
			$users = DB::table('usuarios')->select(['name','email'])
			                              ->whereIn('id',$ids)->whereNotNull('name')
			                                                  ->whereNotNull('email')->get()->toArray();
		}
		self::send($users, new VendaMail("Validação Corrigida",$message,$link_venda,$codigo_venda));
	}

	public static function auditoriaDevolucao($nome_cliente,$link_venda,$codigo_venda){
		$message = "Auditoria devolveu a venda do cliente ".$nome_cliente.". Favor verificar";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$users = self::getUserValidacao($codigo_venda);
		}
		self::send($users, new VendaMail("Auditoria Devolução",$message,$link_venda,$codigo_venda));
	}

	public static function auditoriaAprovada($codigo_venda){
		$message = "Auditoria aprovada, inciado o fluxo de ativação";
		if(getenv('APP_ENV') == "local"){
			$users = self::getDebugUsers();
		}else{
			$users = self::getUserValidacao($codigo_venda);
		}
		self::send($users, new VendaMail("Auditoria Aprovada",$message));
	}

	public static function send($users, VendaMail $mail){
		try{
			Mail::to($users)->send($mail);
		}
		catch (\Exception $exception){
			Log::error($exception->getMessage());
		}
	}

	private static function getUserValidacao($codigo_venda){
		$validacao_id = DB::table('perfis')->select('id')->where('nome','VFP Validação')->limit(1)->pluck('id')->first();
		$ids = self::getConsultorGerenteId($codigo_venda);
		$users = DB::table('usuarios')->select(['name','email'])->whereNotNull('name')
		           ->whereNotNull('email')
		           ->where(function($query) use ($ids,$validacao_id){
			           $query->whereIn('id',$ids)
			                 ->orWhereExists(function ($query) use ($validacao_id){
				                 $query->from('usuario_has_funcao')
				                       ->whereRaw('usuario_has_funcao.usuario_id = usuarios.id')
				                       ->where('perfil_id',$validacao_id);
			                 });
		           })->get()->toArray();
		return $users;
	}

	private static function getConsultorGerenteId($codigo_venda){
		$venda = Venda::find($codigo_venda);
		$ids = [];
		if($venda->usuario_id){
			$ids[] = $venda->usuario_id;
			$manager_id = DB::table('usuarios')->select('manager_id')->where('id',$venda->usuario_id)->limit(1)->pluck('manager_id')->first();
			if($manager_id)
				$ids[] = $manager_id;
		}
		return $ids;
	}
}
