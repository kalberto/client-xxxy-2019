<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AcessoUsuario extends Model
{
	protected $table = 'log_acessos_usuario';
    public $timestamps  = false;

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'ip','data','usuario_id'
	];
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = ['id'];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function usuario(){
		return $this->belongsTo('App\Model\Usuario');
    }

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function get(){
		return $this->with('usuarios');
	}

    /**
	 * @param array $data
	 *
	 * @return boolean
	 */
	public static function store($data){
		$acesso = new self;
		$acesso->fill($data);
		if(isset($data['usuario_id']) && ($usuario = Usuario::find($data['usuario_id'])) != null && $acesso->save()){
			$usuario->acessos()->associate($acesso);
			$usuario->save();
			return $acesso->save();
		}
		return false;
	}
}
