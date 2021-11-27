<?php

namespace App\Http\Requests\Fastpack\Prospeccao;

use App\Helpers\VariableHelper;
use App\Rules\DocumentoIsCliente;
use Illuminate\Support\Facades\DB;
use App\Rules\ProductValid;
use Illuminate\Validation\Rule;

class ProspeccaoRequest extends Request
{

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
			'cliente_documento' => ['required', 'min:8', 'max:14','exists:clientes,documento',new DocumentoIsCliente()],
			'data_contato' => 'required|date_format:d-m-Y',
			'observacoes' => 'nullable|max:500',
			'status' => 'required|'.Rule::in(['C','N','V','P']),
			'status_negociacao' => 'nullable|required_if:status,N|'.Rule::in(['P','A','F','C']),
			'produtos' => 'nullable|array',
			'venda_perdida' => 'required_if:status,P',
			'venda_perdida.id' => 'required_if:status,P|exists:motivos_venda_perdida,id',
			'venda_perdida.comentario' => 'required_if:venda_perdida.id,'.DB::table('motivos_venda_perdida')->where("motivo","Outros")->pluck('id')->first(),
			'produtos.*.tipo_id' => ['required','exists:tipos,id'],
			'produtos.pacotes.tipo_id' => [Rule::in([1])],
			'predio_id' => ['required']
		];
	}

	public function messages()
	{
		return
			[
				'cliente_documento.in' => "Documento não cadastrado",
				'status_negociacao.required_if' => 'O status da negociação é obrigatório.',
				'status_negociacao.in' => 'Selecione um valor válido',
				'produtos.*.tipo_id.required' => "O tipo é obrigatório",
				'produtos.*.tipo_id.required_with' => "O tipo é obrigatório",
				'produtos.*.tipo_id.exists' => "Tipo inválido",
				'produtos.*.produto_id.required' => "O produto é obrigatório",
				'produtos.*.produto_id.in' => "Produto inválido",
				'produtos.pacotes.required' => 'O pacote é obrigatório',
				'produtos.pacotes.tipo_id.required' => 'Por favor, informe o tipo',
				'produtos.pacotes.tipo_id.in' => 'O tipo deve ser um pacote',
				'produtos.pacotes.produto_id' => 'O produto é obrigatório',
				'venda_perdida.required_if' => 'Motivo obrigatório',
				'venda_perdida.id.required_if' => 'Motivo obrigatório',
				'venda_perdida.id.in' => 'Motivo invalido',
				'venda_perdida.comentario.required_if' => 'O comentário é obrigatório quando o motivo é Outros'
			];
	}

	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData()
	{
		$data = $this->all();
		$this->custom_rules = $this->rules();
		$predio_set = false;
		if(isset($data['is_empreendimento'])){
			$is_empreendimento = $data['is_empreendimento'];
			VariableHelper::convert_string_bool($is_empreendimento);
			if($is_empreendimento){
				$this->custom_rules['predio_id'][] = Rule::exists('predios','id')->where(function($query){
					$query->where("cliente_documento",$this->cliente_documento);
				});
				$predio_set = true;
			}
		}
		if(!$predio_set){
			$this->custom_rules['predio_id'][] = Rule::exists('predios_has_clientes','predio_id')->where(function($query){
				$query->where("cliente_documento",$this->cliente_documento);
			});
		}
		if(isset($data['produtos'])){
			foreach ($data['produtos'] as $key => $produto){
				if(isset($produto['tipo_id']))
					$this->custom_rules['produtos.'.$key.'.produto_id'] = [new ProductValid($produto['tipo_id'])];
				if(isset($data['status']) && ($data['status'] == 'N' || $data['status'] == 'V'))
					$this->custom_rules['produtos.'.$key.'.produto_id'][] = 'required';
			}
		}
		if(isset($data['status']) && ($data['status'] == 'N' || $data['status'] == 'V')){
			$this->custom_rules['produtos.pacotes'] = ['required','array'];
			$this->custom_rules['produtos.pacotes.tipo_id'][] = 'required_with:produtos.pacotes';
			$this->custom_rules['produtos.*.tipo_id'] ='required';
		}
		return $data;
	}
}
