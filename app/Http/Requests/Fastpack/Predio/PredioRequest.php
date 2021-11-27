<?php

namespace App\Http\Requests\Fastpack\Predio;

use App\Http\Requests\Request;
use App\Rules\CheckColumnNumberdExist;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PredioRequest extends Request
{

	protected static $modulo = 2;
	protected $custom_rules = null;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		if($this->custom_rules !== null)
			return $this->custom_rules;
		return [
			'id' => ['sometimes','required',new CheckColumnNumberdExist('predios','id')],
			'nome' => 'required|max:100',
			'logradouro' => 'required|max:40',
			'numero' => 'required|max:9999999999|numeric',
			"contato" => 'nullable|array',
			"consultores" => 'required',
			'consultores.*.consultor_id' => 'required|' . Rule::in(DB::table('consultores')->pluck('id')->all()),
			'cep' => 'required|digits:8',
			'uf.uf' => 'required|exists:ufs,uf',
			'cidade.id' => ['required','integer'],
			'bairro' => 'required|max:25',
			'complemento' => 'nullable|max:30',
			'contato.*.nome' =>'required|max:50',
			'contato.*.email' =>'required|max:50|email|regex:/^\S*$/u',
			'contato.*.telefone' =>'required|digits:10',
			'contato.*.celular' =>'required|digits:11',
		];
	}

	public function messages()
	{
		return [
				'id.exists' => 'Esse prédio não existe',
				'uf.uf.required' => 'Campo obrigatório',
				'uf.uf.exists' => 'Campo inválido',
				'cidade.id.required' => 'Campo obrigatório',
				'cidade.id.integer' => 'A cidade é inválida',
				'cidade.id.exists' => 'Cidade não cadastrada para essa UF',
				'consultores.required' => 'Selecione pelo menos um consultor',
				'consultores.*.consultor_id.required' => 'O consultor é obrigatório',
				'consultores.*.consultor_id.in' => 'Consultor inválido',
				'contato.*.*.required' => 'O campo é obrigatório',
				'contato.*.*.max' => 'O campo não deve ter mais que :max caracteres',
				'contato.*.email.email' => 'O campo deve ser um e-mail',
				'contato.*.email.regex' => 'Não é permitido espaço em branco',
			];
	}
}
