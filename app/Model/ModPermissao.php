<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ModPermissao extends Model
{
	protected $table = 'mod_permissao';

	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'mod_id','permissao_id'
	];

	public function permissao(){
		return $this->belongsTo('App\Model\Permissao');
	}

	public function modulo(){
		return $this->belongsTo( 'App\Model\Modulo','mod_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function perfis(){
		return $this->belongsToMany('App\Model\Perfil','perfil_mod_permissao','mod_perm_id','perfil_id');
	}

	public static function getAll(){
		return Modulo::with('mod_permissao.permissao')->get();
	}
}
