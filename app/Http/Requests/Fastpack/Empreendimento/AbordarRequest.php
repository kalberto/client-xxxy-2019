<?php

namespace App\Http\Requests\Fastpack\Empreendimento;


use Illuminate\Support\Facades\Auth;

class AbordarRequest extends EmpreendimentoRequest
{

	public function authorize()
	{
		$count = Auth::user()->perfis()->where('scope','admin')->count();
		if($count > 0)
			return true;
		else
			return false;
	}

	public function rules()
	{
		return [
			'id' => 'required|numeric|exists:predios,id'
		];
	}

	public function messages()
	{
		return
			[
			];
	}

	protected function validationData()
	{
		$data = $this->all();
		$data['id'] = $this->route('id');
		return $data;
	}
}
