<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CheckColumnNumberdExist implements Rule
{

	private $table = null;
	private $column = null;

	public function __construct($table,$column) {
		$this->table = $table;
		$this->column = $column;
	}

	/**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    	try{
		    return DB::table($this->table)->where($this->column,preg_replace("/[^0-9]/",'',$value))->count() > 0;
	    }catch (QueryException $exception){
    		return false;
	    }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Esse registro não existe';
    }
}
