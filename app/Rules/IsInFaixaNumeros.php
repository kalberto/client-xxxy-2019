<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsInFaixaNumeros implements Rule
{

	private $lista_numeros;

	public function __construct($p_lista) {
		$this->lista_numeros = $p_lista;
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
    	if(is_array($this->lista_numeros)){
    		foreach ($this->lista_numeros as $numero){
    			if(isset($numero['inicial']) && isset($numero['final']) && is_numeric($numero['inicial']) && is_numeric($numero['final'])){
    				if($value >= $numero['inicial'] && $value <= $numero['final'])
    					return true;
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
        return 'O número deve estar inserido na faixa de numeração';
    }
}
