<?php

namespace App\Http\Requests\Fastpack\Cliente;

use App\Rules\DocumentoValid;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteRequest extends Request
{

	protected static $modulo = 3;	

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'documento' => ['required', 'min:11', 'max:14', new DocumentoValid()],
			'nome' => 'required|max:50',
			'inscricao_estadual' => 'required|max:45',
			"contato" => 'nullable|array',
			'contato.*.nome' =>'required|max:50',
			'contato.*.email' =>'required|max:50|email|regex:/^\S*$/u',
			'contato.*.telefone' =>'required|digits:10',
			'contato.*.celular' =>'required|digits:11',
			'predios' => 'nullable|array',
			'predios.*.predio_id' => 'required|exists:predios,id',
			'predios.*.complemento' => 'nullable|max:30',
			'endereco' => 'required|array',
			'endereco.cep' =>'required|digits:8',
			'endereco.logradouro' =>'required|max:40',
			'endereco.numero' =>'required|max:9999999999|numeric',
			'endereco.complemento' =>'nullable|max:30',
			'endereco.bairro' =>'required|max:25',
			'endereco.cidade.id' =>'required|integer|exists:cidades,id',
			'endereco.uf.uf' =>'required|exists:ufs,uf',
		];
	}

	public function messages()
	{
		return
			[
				'predios.*.predio_id.required' => 'O prédio é obrigatório',
				'predios.*.predio_id.exists' => 'O prédio é inválido',
				'predios.*.complemento.max' => 'O complemento não deve ter mais que 255 caracteres.',
				'inscricao_estadual' => 'O campo é obrigatório',
				'documento.required' => 'O documento é obrigatório.',
				'documento.min' => 'O documento deve conter no mínimo :min',
				'documento.max' => 'O documento deve conter no máximo :max',
				'documento.unique' => 'Documento já cadastrado',
				'contato.*.nome.required' => 'O nome do contato é obrigatório',
				'contato.*.nome.max' => 'O nome do contato tem um máximo de 50 caracteres',
				'contato.*.email.required' => 'O email do contato é obrigatório',
				'contato.*.email.email' => 'O email do contato deve ser um email válido',
				'contato.*.email.regex' => 'Não é permitido espaço em branco',
				'contato.*.telefone.required' => 'O telefone do contato é obrigatório',
				'contato.*.telefone.digits' => 'O telefone do contato deve ter :digits caracteres',
				'contato.*.celular.required' => 'O celular do contato é obrigatório',
				'contato.*.celular.digits' => 'O celular do contato deve ter :digits caracteres',
			];
	}
}
