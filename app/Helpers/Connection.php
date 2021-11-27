<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 29/08/2019
 * Time: 10:55
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 29/08/2019
 * Time: 10:55
 */

namespace App\Helpers;

class Connection {

	public static $instance;
	private $ch,$url, $username, $password ;
	private $auth, $has_error, $error;
	private $id = "GPAC Test";

	private function __construct() {
		$this->url = env("API_HTT_URL");
		$this->username = env("API_HTT_LOGIN");
		$this->password = env("API_HTT_PASS");
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_URL, $this->url);
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
	}

	private static function getInstance(){
		if(!isset(self::$instance)){
			self::$instance = new Connection();
		}
		self::$instance->authenticate();
		return self::$instance;
	}

	private function authenticate(){
		if(!isset($this->auth) || $this->auth == ''){
			$request = array(
				"id"        => self::$instance->id,
				"jsonrpc"   => "2.0",
				"method"    => "auth",
				"params"    => (object)array(
					"username" => $this->username,
					"password" => $this->password
				)
			);
			$response = $this->callAPI($request);
			if(!$this->has_error){
				$this->auth = $response['result']->auth;
			}
		}
		$this->has_error = false;
	}

	/**
	 * Chama um método da API da HTT
	 *
	 * @param string $method
	 * @param array $params
	 *
	 * @return array
	 */
	public static function call($method,$params){
		$api = self::getInstance();
		if($api->has_error)
			return [
				'success'   => false,
				'result'    => $api->error
		];
		$request = array(
			"id"        => $api->id,
			"jsonrpc"   => "2.0",
			"auth"      => $api->auth,
			"method"    => $method,
			"params"    => (object)$params
		);
		return $api->callAPI($request);
	}

	private function callAPI($request){
		$response = array(
			'success' => true,
			'result' => array()
		);
		curl_setopt($this->ch,CURLOPT_POSTFIELDS,json_encode($request));
		if(!$result = curl_exec($this->ch)){
			$this->has_error = true;
			$this->error = curl_error($this->ch);
			$response['sucess'] = false;
			$response['result'] = $this->error;
			return $response;
		}
		if(curl_getinfo($this->ch, CURLINFO_HTTP_CODE) == 200){
			$result = json_decode($result);
			if(isset($result->result)){
				$this->has_error = false;
				$response['result'] = $result->result;
			}
			else{
				$this->has_error = true;
				$this->error = $result->error;
				$response['success'] = false;
				$response['result'] = $this->error;
			}
		}else{
			$this->has_error = true;
			$this->error = "Failed to call API";
			$response['success'] = false;
			$response['result'] = $this->error;
		}
		return $response;
	}
}