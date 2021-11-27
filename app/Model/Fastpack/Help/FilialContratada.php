<?php

namespace App\Model\Fastpack\Help;

use App\Http\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FilialContratada extends Model
{

	public $timestamps = false;
	protected $table = 'contratada_filial';

	public function getEnderecoAttribute($value){
		return json_decode($value);
	}
}
