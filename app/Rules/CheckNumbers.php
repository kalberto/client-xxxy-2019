<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNumbers implements Rule
{

	public function __construct() {

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
    	$size = 0;
    	$numeros = [];
	    if(is_array($value)) {
		    foreach ( $value as $numero ) {
			    if(isset($numero['inicial']) && isset($numero['final']) && is_numeric($numero['inicial']) && is_numeric($numero['final'])){
				    if($numero['inicial'] <= $numero['final']){
					    $size = ($numero['final'] - $numero['inicial']);
					    for ($i = 0; $i <= $size; $i++){
					    	if(in_array($numero['inicial'] + $i,$numeros)){
					    		return false;
						    }else{
					    		$numeros[] = $numero['inicial'] + $i;
						    }
					    }
				    }


			    }
		    }
	    }
	    return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Existem números repetidos entre as linhas';
    }
}
