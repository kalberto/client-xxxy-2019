<?php

namespace App\Http\Requests\Fastpack\Auditoria;

class EditRequest extends Request
{

	protected static $permission = 3;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id' => ['required','exists:auditorias,id'],
			'observacoes' => 'nullable|max:1000',
		];
	}

	public function messages()
	{
		return
			[
				'id.exists' => 'Essa auditoria não existe',
				'observacoes.max' => 'Máximo de :max caracteres',
			];
	}
}
