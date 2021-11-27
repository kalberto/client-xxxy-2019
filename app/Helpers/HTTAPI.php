<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 02/09/2019
 * Time: 08:51
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 02/09/2019
 * Time: 08:51
 */

namespace App\Helpers;


class HTTAPI {
	/**
	 * Tenta autenticar o usuário na api da HTT
	 *
	 * @param string $username
	 * @param string $password
	 *
	 * @return array
	 */
	public static function login(string $username,string $password){
		$params = array('password' => $password,'username'=>$username);
		$result = Connection::call('auth.check_user',$params);
		if($result['success'] == false){
			if($result['result']->code == -10000)
				return ['success' => false,'message' => 'Usuário e/ou senha incorretos'];
			else
				return ['success' => false, 'message' => 'Serviço indisponível'];
		}
		return ['success' => true];
	}

	/**
	 * Retorna as informações de um usuário
	 *
	 * @param string $username
	 *
	 * @return array
	 */
	public static function getUser(string $username){
		$params = array('username'=>$username);
		$result = Connection::call('auth.get_user_data',$params);
		if($result['success'] == false){
			if($result['result']->code == -10000)
				return ['success' => false,'message' => 'Usuário não encontrado'];
			else
				return ['success' => false,'message' => 'Serviço indisponível'];
		}
		return $result;
	}

	/**
	 * Retorna os grupos associados ao sistema de vendas FastPack
	 *
	 * @return array
	 */
	public static function getGroups(){

		$result = Connection::call('auth.get_groups',array());
		if($result['success'] == false)
			return ['success' => false,'message' => 'Serviço indisponível'];
		return $result;
	}

	/**
	 * Retorna os membros de um grupo
	 *
	 * @param string $group
	 *
	 * @return array
	 */
	public static function getGroupMembers(string $group){
		$params = array('group'=>$group);
		$result = Connection::call('auth.get_group_members',$params);
		if($result['success'] == false){
			if($result['result']->code == -10000)
				return ['success' => false,'message' => 'Grupo não encontrado'];
			else
				return ['success' => false,'message' => 'Serviço indisponível'];
		}
		return $result;
	}

	/**
	 * Retorna todos os usuários com acesso ao sistema
	 *
	 * @return array
	 */
	public static function getUsers(){
		$result = Connection::call('auth.get_users',array());
		if($result['success'] == false)
			return ['success' => false,'message' => 'Serviço indisponível'];
		return $result;
	}

	/**
	 * Notifica o ambiente da HTT que uma venda foi concluída
	 *
	 * @param array $dados_venda
	 *
	 * @return array
	 */
	public static function notifyConcluded(array $dados_venda){
		$result = Connection::call('sales.notify_concluded',$dados_venda);
		if($result['success'] == false)
			return ['success' => false,'message' => 'Serviço indisponível'];
		return $result;
	}

	/**
	 * Notifica o ambiente da HTT que uma venda foi para auditoria
	 *
	 * @param array $dados_venda
	 *
	 * @return array
	 */
	public static function notifyAudit(array $dados_venda){
		$result = Connection::call('sales.notify_audit',$dados_venda);
		if($result['success'] == false)
			return ['success' => false,'message' => 'Serviço indisponível'];
		return $result;
	}

	/**
	 *  Requisita uma Viabilidade Financeira.
	 *
	 * @param string $documento
	 *
	 * @return array
	 */
	public static function requestVF(string $documento){
		$size = strlen($documento);
		$tipo_cliente = 'PJ';
		if($size == 11)
			$tipo_cliente = 'PF';
		$params = array(
			'documento' => $documento,
			'tipo_cliente' => $tipo_cliente
		);
		$result = Connection::call('sales.request_vf',$params);
		if($result['success'] == false)
			return array('success' => false,'message' => 'Serviço indisponível');
		return $result;
	}

	/**
	 * Retorna todos as localidades atendidas pela xxxx
	 *
	 * @return array
	 */
	public static function getLocations(){
		$result = Connection::call('sales.get_locations',array());
		if($result['success'] == false)
			return ['success' => false,'message' => 'Serviço indisponível'];
		return $result;
	}
}
