<?php

namespace App\Http\Requests\Fastpack\Predio;


use Illuminate\Support\Facades\Auth;

class AbordarRequest extends PredioRequest
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
