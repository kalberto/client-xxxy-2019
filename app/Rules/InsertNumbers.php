<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class InsertNumbers implements Rule
{

	private $inicio;

	public function __construct($p_inicio) {
		$this->inicio = $p_inicio;
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
    	if($this->inicio != '' && $this->inicio != null){
    		if(strlen($this->inicio) == 10 && strlen($value) == 10){
    			if(substr($this->inicio,0,6) == substr($value,0,6)){
    				if(substr($this->inicio,6,10) <= substr($value,6,10)){
    					return true;
				    }
			    }
		    }
	    }
	    return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Final inválido';
    }
}
