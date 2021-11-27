<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Configuracao extends Model
{
	protected $table = 'configuracoes';
	protected $fillable = ['nome_app'];
	protected $hidden = [];
	public $timestamps = false;
}
