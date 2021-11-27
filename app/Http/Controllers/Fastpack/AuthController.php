<?php

namespace App\Http\Controllers\Fastpack;

use App\Helpers\HTTAPI;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Controllers\FastpackController;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Request;
use App\Model\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AuthController extends FastpackController
{

	/**
	 * Log the user out of the application.
	 *
	 * @param LoginRequest|Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function login(LoginRequest $request){
		$credentials = $request->only('usuario', 'password');
		$credentials['usuario'] = strtolower($credentials['usuario']);
		$result = HTTAPI::login($credentials['usuario'],$credentials['password']);
		if($result['success'] == true){
			$user_api = HTTAPI::getUser($credentials['usuario']);
			$usuario = Usuario::findByUsuario($credentials['usuario'],true);
			if(!isset($usuario)){
				$usuario = Usuario::updateOrCreate(
					array(
						'usuario' => $credentials['usuario']
					),
					array(
						'ativo' => true
					)
				);
			}
			if($user_api['success'] == true){
				$usuario->updateUser($user_api['result']);
			}
			Auth::login($usuario);
			$user = Auth::user();
			$scopes = $user->perfis->pluck('scope')->toArray();
			if($usuario->perfis()->whereNotIn('id',[2,3])->count() > 0)
				$scopes[] = 'list-clientes-all';
			else{
				if(DB::table('consultores')->where('usuario_id',$user->id)->count() > 0)
					$scopes[] = 'list-clientes-vendedor';
				if(DB::table('gerentes')->where('usuario_id',$user->id)->count() > 0)
					$scopes[] = 'list-clientes-gerente';
			}
			$response['token'] =  $user->createToken('Login',$scopes)->accessToken;
			$response['usuario'] = $usuario->usuario;
			$response['super'] = (in_array ('admin',$scopes) || in_array('inteligencia',$scopes)) ? true : false;
			$response['name'] = isset($usuario->name) ? $usuario->name : $usuario->usuario;
			$response['modulos'] = array();
			$modulos = DB::table('modulos')->get();
			$ids_perfil = Auth::user()->perfis->pluck('id')->toArray();
			foreach ($modulos as $modulo){
				$teste = DB::table('perfil_mod_permissao')
				  ->join('mod_permissao','perfil_mod_permissao.mod_perm_id','=','mod_permissao.id')
				  ->whereIn('perfil_id',$ids_perfil)
				  ->where([['mod_permissao.mod_id','=',$modulo->id]])->pluck('permissao_id');
				$response['modulos'][Str::slug($modulo->nome)] = $teste;
			}
			$user->login($request);
			$response['ultimo_acesso'] = isset($usuario->ultimo_acesso) ? $usuario->ultimo_acesso : date('d/m/Y');
			return response()->json([$response], 200);
		}else{
			return response()->json(['message'=>$result["message"]], 422);
		}
	}


	/**
	 * Logout user (Revoke the token)
	 *
	 * @param LogoutRequest|Request $request
	 *
	 * @return \Illuminate\Http\JsonResponse [string] message
	 */
	public function logout(LogoutRequest $request)
	{
		$request->user()->token()->revoke();
		return response()->json(['message' => 'Deslogado com sucesso'],200);
	}
}
