<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CanBePresent implements Rule
{

	private $tecnologia;

	public function __construct($p_tecnologia) {
		$this->tecnologia = $p_tecnologia;
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
    	if($this->tecnologia == 'SIP')
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
        return 'SmartBox só pode estar presente na tecnologia SIP';
    }
}
