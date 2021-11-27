<?php

namespace App\Model\Fastpack;

use App\Http\Traits\FastpackModelLog;
use App\Http\Traits\NumbersOnly;
use App\Model\Fastpack\Relationship\PredioHasCliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Nicolaslopezj\Searchable\SearchableTrait;

class Produto extends Model
{
	use  SearchableTrait;

	protected $table = 'produtos';
	public $timestamps = false;

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = ['tipo'];

	public function getTipoAttribute()
	{
		return DB::table("tipos")->where("id",$this->tipo_id)->pluck("nome")->first();
	}

	/**
	 * Searchable rules.
	 *
	 * @var array
	 */
	protected $searchable = array(
		/**
		 * Columns and their priority in search results.
		 * Columns with higher values are more important.
		 * Columns with equal values have equal importance.
		 *
		 * @var array
		 */
		'columns' => array(
			'produtos.nome',
			'tipos.nome',
		),
		'joins' => [
			'tipos' => ['produtos.tipo_id', 'tipos.id']
		]
	);
}
