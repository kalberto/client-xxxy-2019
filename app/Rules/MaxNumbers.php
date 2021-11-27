<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxNumbers implements Rule
{

	private $max_number;

	public function __construct($p_max_number) {
		$this->max_number = $p_max_number;
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
	    if(is_array($value)) {
		    foreach ( $value as $numero ) {
			    if(isset($numero['inicial']) && isset($numero['final']) && is_numeric($numero['inicial']) && is_numeric($numero['final'])){
				    if($numero['inicial'] <= $numero['final'])
				    	$size += ($numero['final'] - $numero['inicial']) + 1;
			    }
		    }
	    }
	    if($size == $this->max_number)
    		return true;
	    return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Deve ser informado '.$this->max_number.' números';
    }
}
