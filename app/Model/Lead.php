<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
	protected $table = 'leads';
	protected $fillable = ['nome','email','telefone','assunto','mensagem','origem','form_origem'];
	protected $hidden = [];

	/**
	 * @param array $data
	 *
	 * @return boolean
	 */
	public static function store($data) {
		$lead = new self;
		$lead->fill($data);
		return $lead->save();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function get(){
		return $this;
	}

	public static function countTotal(){
		return self::count();
	}
}
