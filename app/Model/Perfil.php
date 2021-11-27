<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
	protected $table = 'perfis';
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nome'
	];

	protected $hidden = [
		'id','updated_at'
	];

	public static function getLoggedPerfil(){
		return [['nome' => Auth::user()->perfil->nome,'id'=>Auth::user()->perfil->id]];
	}

	public static function getAll(){
		return Perfil::whereNotNull('id')->get()->makeVisible('id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|static
	 */
	public function get(){
		return $this;
	}

	public static function getByName($name){
		$perfil = self::where('nome', $name)->limit(1)->first();
		return $perfil;
	}

	public static function getWithModPerm($id){
		 $mod_adm_perm = DB::table('perfil_mod_adm_permissao')
			->select('mod_adm_permissao.id')
			->join('mod_adm_permissao','perfil_mod_adm_permissao.mod_adm_perm_id','=','mod_adm_permissao.id')
			->where([['perfil_id','=',$id]])
			->get();
		$perfil = Perfil::find($id);
		 foreach ($mod_adm_perm as $mod){
			 $perfil->attributes['mod_adm_permissao'][$mod->id] = true;
		 }
		return $perfil;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function mod_permissao(){
		return $this->belongsToMany( 'App\Model\ModPermissao','perfil_mod_permissao','perfil_id','mod_perm_id');
	}

	public function getId($id,$mod_id){
		$perm = DB::table('permissoes')->find($id);
		$array = array();
		if(isset($perm->required_id)){
			$ids = $this->getId($perm->required_id,$mod_id);
			foreach ($ids as $id_db){
				$array[] = $id_db;
			}
		}
		$mod = DB::table('mod_adm_permissao')
		         ->where('mod_adm_id','=',$mod_id)
		         ->where('permissao_id','=',$id)
		         ->value('id');
		$array[] = $mod;
		return $array;
	}

	public function findRequired($id){
		$required = DB::table('mod_adm_permissao')
			->select('b.*','mod_adm_permissao.mod_adm_id')
			->join('permissoes as a','mod_adm_permissao.permissao_id', '=','a.id')
			->join('permissoes as b','a.required_id','=','b.id')
			->where('mod_adm_permissao.id','=',$id)
			->first();
		if(isset($required)){
			return $this->getId($required->id, $required->mod_adm_id);
		}else{
			return array();
		}
	}
}
