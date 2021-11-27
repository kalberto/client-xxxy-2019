<?php

namespace App\Model;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\PasswordResetN;

class Usuario extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'usuarios';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario','name','email', 'password','ultimo_acesso','manager_id','ativo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function perfis(){
		return $this->belongsToMany( 'App\Model\Perfil','usuario_has_funcao','usuario_id','perfil_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function acessos(){
		return $this->hasMany('App\Model\AcessoUsuario');
	}

	public function get(){
		return $this->with(['perfil','media.media_root']);
	}

	public function getUltimoAcessoAttribute($value){
		return (new \DateTime($value))->format('d/m/Y');
	}

	public function login($request){
		$last_acesso = $this->acessos->last();
		if(isset($last_acesso))
			$this->ultimo_acesso = $last_acesso->data;
		else
			$this->ultimo_acesso = Carbon::now();
		$acesso = new AcessoUsuario();
		$acesso->data = Carbon::now();
		$acesso->ip = $request->ip();
		$acesso->usuario()->associate($this);
		$acesso->save();
		return $this->save();
	}

	public static function findById($id){
		$administrador = Usuario::find($id);
		if($administrador->count() > 0){
			return $administrador;
		}else{
			return false;
		}
	}

	public static function findByEmail($email){
		$usuario = Usuario::where('email', $email)->limit(1)->first();
		return $usuario;
	}

	public static function findByUsuario($usuario){
		$usuario = Usuario::where('usuario', $usuario)->limit(1)->first();
		return $usuario;
	}

	public static function getUsuario($id){
		$administrador = Usuario::find($id);
		return $administrador;
	}

	public static function getByResetToken($token){
		$usuario = DB::table('password_resets')->select('usuarios.*')
			->join('usuarios','password_resets.email','=','usuarios.email')
			->where('password_resets.token','=',$token)->limit(1)->first();
		return $usuario;
	}

	public function sendResetPasswordNotification($token,$nome)
	{
		$this->notify(new PasswordResetN($token,$nome));
	}

	public function updateUser($data){
		$this->name = $data->name;
		$this->email = $data->mail;
		if($data->manager != ""){
			if(!($manager = Usuario::findByUsuario($data->manager))){
				$manager = Usuario::firstOrCreate(
					array(
						'usuario' => $data->manager
					)
				);
			}
			$this->manager_id = $manager->id;
		}
		$this->save();
		if($data->groups && is_array($data->groups)){
			DB::table('usuario_has_funcao')->where([['usuario_id',$this->id]])->delete();
			foreach ($data->groups as $group){
				if($group == "VFP Vendas"){
					if(DB::table('consultores')->where('usuario_id',$this->id)->count() == 0){
						DB::table('consultores')->insert(array(
							'usuario_id' => $this->id
						));
					}
				}elseif ($group == "VFP Gerência"){
					if(DB::table('gerentes')->where('usuario_id',$this->id)->count() == 0){
						DB::table('gerentes')->insert(array(
							'usuario_id' => $this->id
						));
					}
				}
				$id_perfil = Perfil::getByName($group)->id;
				if(DB::table('usuario_has_funcao')->where([['usuario_id',$this->id],['perfil_id',$id_perfil]])->count() == 0){
					DB::table('usuario_has_funcao')->insert(array(
						'usuario_id' => $this->id,
						'perfil_id' => $id_perfil
					));
				}
			}
		}
	}
}
