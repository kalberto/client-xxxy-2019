<?php

namespace App\Helpers;

class NotMappedHelper {

	public static $vencimentos = ['02','08','16','22'];

	public static $ciclos = [1,2,3,4,5,6,7,8,9,10,11,12,'indeterminado'];

	public static $status_prospeccao = [
		'C' => ["id" => "C","nome" => "Contato"],
		'N' => ["id" => "N","nome" => "Negociação"],
		'V' => ["id" => "V","nome" => "Venda concluída"],
		'P' => ["id" => "P","nome" => "Venda perdida"]
	];

	public static $status_prospeccao_negociacao = [
		'P' => ["id" => "P","nome" => "Prospecção"],
		'A' => ["id" => "A","nome" => "Análise"],
		'F' => ["id" => "F","nome" => "Fechamento até 60 dias"],
		'C' => ["id" => "C","nome" => "Fechamento mês corrente"]
	];

	public static $status_venda = [
		'F' => ["id" => "F","nome" => "Finalizada"],
		'A' => ["id" => "A","nome" => "A corrigir"],
		'E' => ["id" => "E","nome" => "Em configuração"],
		'C' => ["id" => "C","nome" => "Cancelada"],
		'V' => ["id" => "V","nome" => "Validação"],
		'U' => ["id" => "U","nome" => "Auditoria"]
	];


	public static $status_auditoria = [
		'E' => ["id" => "E","nome" => "Em auditoria"],
		'R' => ["id" => "R","nome" => "Recusada"],
		'A' => ["id" => "A","nome" => "Aprovada"],
	];

	public static $tipos_auditoria = [
		'V' => ["id" => "V","nome" => "Validação"],
		'W' => ["id" => "W","nome" => "Welcome call"],
		'A' => ["id" => "A","nome" => "Auditoria de dados"],
	];

	public static function statusProspeccao($value){
		if(isset(NotMappedHelper::$status_prospeccao[$value]))
			return NotMappedHelper::$status_prospeccao[$value]['nome'];
		return "Não cadastrado";
	}

	public static function statusNegociacaoProspeccao($value){
		if(isset(NotMappedHelper::$status_prospeccao_negociacao[$value]))
			return NotMappedHelper::$status_prospeccao_negociacao[$value]['nome'];
		return "Não cadastrado";
	}

	public static function statusVenda($value){
		if(isset(NotMappedHelper::$status_venda[$value]))
			return NotMappedHelper::$status_venda[$value]['nome'];
		return "Não cadastrado";
	}

	public static function statusAuditoria($value){
		if(isset(self::$status_auditoria[$value]))
			return self::$status_auditoria[$value]['nome'];
		return "Não cadastrado";
	}

	public static function tipoAuditoria($value){
		if(isset(self::$tipos_auditoria[$value]))
			return self::$tipos_auditoria[$value]['nome'];
		return "Não cadastrado";
	}
}