<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 23/07/2019
 * Time: 17:30
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 23/07/2019
 * Time: 17:30
 *
 * references:https://laravel.com/docs/5.8/eloquent#query-scopes , https://github.com/nicolaslopezj/searchable
 *
 */



namespace App\Http\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/**
 * Trait SearchModel
 * @package App\Http\Traits
 * @property array $searchable
 * @method string getTable()
 */
trait SearchModel {

	protected $fieldsSearch = array();

	/**
	 *  All the accents to be replaced
	 */
	protected $replaceAccentTable = array(
		'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
		'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
		'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
		'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
		'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
		'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
		'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y',
		'Ŕ'=>'R', 'ŕ'=>'r',
	);


	/**
	 *
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $search
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeSearch($query, $search){

		$query->select($this->getTable() . '.*');

		$this->makeJoins($query);
		$search = strtr(mb_strtoupper(trim($search),'UTF-8'),$this->replaceAccentTable);
		$columns = $this->getColumns();
		$first_time = true;
		foreach ($columns as $key => $item){
			$column = '';
			$needle = '';
			if(!is_int($key)){
				if(function_exists($item)){
					$column = $key;
					$needle = $item($search);
				}else{
					if(method_exists($this,$item)){
						$column = $key;
						$needle = $this->$item($search);
					}
				}
			}else{
				$column = $item;
				$needle = $search;
			}
			if($needle != ''){
				if($this->getDatabaseDriver() == 'pgsql')
					$toBeSearched =  DB::raw('upper(unaccent(cast('.$column.' as text)))');
				else
					$toBeSearched =  DB::raw('upper('.$column.')');
				if($first_time == true){
					$query->where($toBeSearched, 'like','%'.$needle.'%');
					$first_time = false;
				}else
					$query->orWhere($toBeSearched, 'like','%'.$needle.'%');
			}
		}
		return $query;
	}


	/**
	 * @return array
	 */
	protected function getColumns()
	{
		return Arr::get($this->searchable, 'columns', []);
	}

	/**
	 * @return array
	 */
	protected function getJoins()
	{
		return Arr::get($this->searchable, 'joins', []);
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 */
	protected function makeJoins(Builder $query)
	{
		foreach ($this->getJoins() as $table => $keys) {
			$query->leftJoin($table, function ($join) use ($keys) {
				$join->on($keys[0], '=', $keys[1]);
			});
		}
	}

	/**
	 * Returns database driver Ex: mysql, pgsql, sqlite.
	 *
	 * @return array
	 */
	protected function getDatabaseDriver() {
		$key = $this->connection ?: Config::get('database.default');
		return Config::get('database.connections.' . $key . '.driver');
	}
}