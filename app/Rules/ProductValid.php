<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ProductValid implements Rule
{

	private $tipo_id = null;

	public function __construct($tipo_id = null) {
		$this->tipo_id = is_numeric($tipo_id) ? $tipo_id : null;
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
    	if(isset($this->tipo_id) && is_numeric($value))
    		return DB::table('produtos')->where([['tipo_id',$this->tipo_id],['id',$value]])->count() > 0;
	    return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O produto informado é inválido';
    }
}
