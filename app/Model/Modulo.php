<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modulo extends Model
{
	public $timestamps = false;

    protected $table = 'modulos';
	protected $fillable = ['nome','icone','url','obrigatorio','order'];
    protected $hidden = [];

	public static function getAll(){
		return Modulo::query()->orderBy('order')->get();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function mod_permissao(){
		return $this->hasMany( 'App\Model\ModPermissao','mod_id');
	}
}
