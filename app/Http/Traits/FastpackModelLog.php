<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 17/06/2019
 * Time: 11:31
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 17/06/2019
 * Time: 11:31
 */

namespace App\Http\Traits;

use App\Model\LogUsuario;
use Illuminate\Support\Facades\Auth;

trait FastpackModelLog {

	protected function getPrimaryKeyForLog(){
		$primary_key = "";
		$name = $this->getKeyName();
		if(is_array($name)){
			foreach($name as $value){
				$primary_key .= $value.":".$this->$value.";";
			}
		}else{
			$primary_key = $this->$name;
		}
		return $primary_key;
	}

	protected function saveLog($ip,$tipo,$dados = null){
		if(Auth::id() !== null){
			$data_log = array(
				'usuario_id' => Auth::id(),
				'registro_id' => $this->getPrimaryKeyForLog(),
				'tabela' => $this->getTable(),
				'tipo' => $tipo,
				'ip' => $ip == false ? '127.0.0.1' : $ip,
				'alteracoes' => isset($dados) ? $dados : ''
			);
			LogUsuario::store($data_log);
		}

	}

	protected function deleteLog($ip){
		if(Auth::id() !== null){
			$data  = array (
				'usuario_id' => Auth::id(),
				'registro_id' => $this->getPrimaryKeyForLog(),
				'tabela' => $this->getTable(),
				'tipo' => 'delete',
				'ip' => $ip == false ? '127.0.0.1' : $ip,
				'alteracoes' => ''
			);
			LogUsuario::store($data);
		}
	}
}