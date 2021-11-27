<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LogUsuario extends Model
{
    protected $table = 'log_acoes_usuario';

    	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'registro_id','tabela','tipo','ip','usuario_id','alteracoes'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [];


	public function setAlteracoesAttribute($value)
	{
		$this->attributes['alteracoes'] = json_encode($value);
	}

	/**
	 * @param array $data
	 *
	 * @return boolean
	 */
	public static function store($data){
		$log = new self;
		$log->fill($data);
		return $log->save();
	}
}
