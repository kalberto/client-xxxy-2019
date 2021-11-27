<?php

namespace App\Http\Requests\Fastpack\Venda;

use App\Helpers\NotMappedHelper;
use App\Rules\CanBePresent;
use App\Rules\CheckNumbers;
use App\Rules\InsertNumbers;
use App\Rules\IsInFaixaNumeros;
use App\Rules\MaxNumbers;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AprovarVendaRequest extends Request
{
	/**
	 * Get data to be validated from the request.
	 *
	 * @return array
	 */
	protected function validationData() {
		$data = $this->all();
		$cliente = DB::table('prospeccoes')->select("clientes.*")->join('clientes','prospeccoes.cliente_documento','=','clientes.documento')->where("codigo",$data['codigo'])->first();
		$data['cliente']['status'] = $cliente->status;
		$data['cliente']['data_verificacao'] = $cliente->data_verificacao;
		$this->custom_rules = $this->rules();
		if(isset($data['produtos'])){
			foreach ($data['produtos'] as $key => $produto){
				if(isset($produto["tipo_id"]) && is_numeric($produto['tipo_id']))
					$this->custom_rules['produtos.'.$key.'.produto_id'] = "required|".Rule::in(DB::table('produtos')->where("tipo_id",$produto["tipo_id"])->pluck('id')->all());
			}
		}
		if(isset($data['produtos']['cloudbackup']['config'])){
			$this->checkForValue($data['produtos']['cloudbackup']['config'],'produtos.cloudbackup.config.desconto','lte:produtos.cloudbackup.config.valor');
		}
		if(isset($data['produtos']['pacotes']['config']['internet'])){
			$this->checkForValue($data['produtos']['pacotes']['config']['internet'],'produtos.pacotes.config.internet.desconto','lte:produtos.pacotes.config.internet.valor');
		}
		$produto_0800 = false;
		if(isset($data['produtos']['0800'])){
			$produto_0800 = true;
			if(isset($data['produtos']['0800']['config']))
				$this->checkForValue($data['produtos']['0800']['config'],'produtos.0800.config.desconto','lte:produtos.0800.config.valor');
		}
		$produto_voz = null;
		if(isset($data['produtos']['pacotes']['config']['voz'])){
			$produto_voz = $data['produtos']['pacotes']['config']['voz'];
			$this->checkForValue($produto_voz,'produtos.pacotes.config.voz.desconto','lte:produtos.pacotes.config.voz.valor');
		}
		$tecnologia = isset($produto_voz['tecnologia']) ? $produto_voz['tecnologia'] : false;

		if($tecnologia != false){
			if($tecnologia != 'Analógica'){
				$this->custom_rules['produtos.pacotes.config.voz.quantidade_linhas'] .= '|in:1,2,3,4,5,10,15,20,25,30';
				$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.lista_numeros'][] = 'max:5';
			}else{
				$quantidade = isset($produto_voz['quantidade_linhas']) ? $produto_voz['quantidade_linhas'] : false;
				$max_quantidade_linhas = 2;
				$this->custom_rules['produtos.pacotes.config.voz.quantidade_linhas'] .= '|max:'.$max_quantidade_linhas;
				if($quantidade != false && $quantidade <= $max_quantidade_linhas){
					$current_rule = 'size:'.$quantidade;
				}else{
					$current_rule = 'max:'.$max_quantidade_linhas;
				}
				$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.lista_numeros'][] = $current_rule;
			}
		}
		$this->custom_rules['produtos.smartbox'] = [new CanBePresent($tecnologia)];
		if(isset($data['produtos']['smartbox']) && $tecnologia == 'SIP'){
			$this->custom_rules['produtos.smartbox.config.valor'] = ['required_unless:produtos.smartbox,','numeric','min:0'];
			$this->custom_rules['produtos.smartbox.config.desconto'] = ['nullable','numeric','min:0'];
			$this->custom_rules['produtos.smartbox.config.quantidade_ramais'] = 'required_unless:produtos.smartbox,|numeric|max:10';
			$this->custom_rules['produtos.smartbox.config.is_percent'] = 'nullable|boolean';
			$this->custom_rules['produtos.smartbox.config.quantidade_ciclos'] = 'nullable|required_unless:produtos.smartbox.config.desconto,|'.Rule::in(NotMappedHelper::$ciclos);
			if(isset($data['produtos']['smartbox']['config']) && isset($data['produtos']['smartbox']['config']['valor']) && isset($data['produtos']['smartbox']['config']['quantidade_ramais'])){
				$valor_total = $data['produtos']['smartbox']['config']['valor']*$data['produtos']['smartbox']['config']['quantidade_ramais'];
				$data['produtos']['smartbox']['config']['total'] = number_format($valor_total,2,'.','');
				$this->checkForValue($data['produtos']['smartbox']['config'],'produtos.smartbox.config.desconto','lte:produtos.smartbox.config.total');
			}
			if(isset($data['produtos']['smartbox']['config']['desconto'])){
				if(isset($data['produtos']['smartbox']['config']['is_percent']) && $data['produtos']['smartbox']['config']['is_percent']){
					$this->custom_rules['produtos.smartbox.config.desconto'][] = 'max:100';
				}
			}
			if(isset($data['produtos']['smartbox']['config']['quantidade_ramais'])){
				$max_ramais = $data['produtos']['smartbox']['config']['quantidade_ramais'] < 10 ? $data['produtos']['smartbox']['config']['quantidade_ramais'] : 10;
				$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.lista_numeros'][] = new MaxNumbers($max_ramais);
			}
		}
		if(isset($produto_voz['faixa_numeracao']['lista_numeros']) && is_array($produto_voz['faixa_numeracao']['lista_numeros'])){
			$lista_numeros = $produto_voz['faixa_numeracao']['lista_numeros'];
			$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.piloto'][] = new IsInFaixaNumeros($lista_numeros);
			if($produto_0800)
				$this->custom_rules['produtos.0800.config.numero_encaminhamento'][] = new IsInFaixaNumeros($lista_numeros);
			if($tecnologia == "Analógica")
				$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final'][] = 'same:produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.inicial';
			else
				foreach ($lista_numeros as $key => $numero){
					if(isset($numero['inicial']) && is_numeric($numero['inicial']))
						$this->custom_rules['produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.'.$key.'.final'][] = new InsertNumbers($numero['inicial']);
				}
		}
		if(isset($data['predio_id'])){
			$data['predio_id'] = preg_replace("/[^0-9]/",'',$data['predio_id']);
		}
		return $data;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		if($this->custom_rules !== null)
			return $this->custom_rules;
		return [
			'cliente.status' => 'required|in:A',
			'cliente.data_verificacao' => 'required|date|after:-12 hours',
			'predio_cliente_complemento' => 'required|max:30',
			'campanha' => 'nullable|size:7',
			'campanha_nome' => 'nullable|max:150',
			'contato_comercial' => 'required|array',
			'contato_comercial.nome' =>'required|max:50',
			'contato_comercial.email' =>'required|max:50|email|regex:/^\S*$/u',
			'contato_comercial.telefone' =>'required|max:10',
			'contato_comercial.celular' =>'required|max:11',
			'predio_id' => 'required|exists:predios,id',
			'endereco_correspondencia' => 'required|array',
			'endereco_correspondencia.cep' =>'required|digits:8',
			'endereco_correspondencia.logradouro' =>'required|max:40',
			'endereco_correspondencia.numero' =>'required|max:9999999999|numeric',
			'endereco_correspondencia.complemento' =>'required|max:30',
			'endereco_correspondencia.bairro' =>'required|max:25',
			'endereco_correspondencia.cidade.id' =>'required|integer|exists:cidades,id',
			'endereco_correspondencia.uf.uf' =>'required|exists:ufs,uf',
			'vencimento' => 'required|'.Rule::in(NotMappedHelper::$vencimentos),
			'email_fatura' => 'required|email|regex:/^\S*$/u|max:50',
			'contratada.id' => 'required|integer|exists:contratadas,id',
			'contratada_filial.id' => 'required|integer|exists:contratada_filial,id',
			'produtos.pacotes' =>'required|array',
			'produtos.pacotes.tipo_id' => 'required|'.Rule::in([1]),
			'produtos.pacotes.config.internet.valor' => ['required','numeric','min:0'],
			'produtos.pacotes.config.internet.desconto' => ['nullable','numeric','min:0'],
			'produtos.pacotes.config.internet.is_percent' => 'nullable|boolean',
			'produtos.pacotes.config.internet.quantidade_ciclos' => 'nullable|required_unless:produtos.pacotes.config.internet.desconto,|'.Rule::in(NotMappedHelper::$ciclos),
			'produtos.pacotes.config.voz.valor' => ['required','numeric','min:0'],
			'produtos.pacotes.config.voz.desconto' => ['nullable','numeric','min:0'],
			'produtos.pacotes.config.voz.is_percent' => 'nullable|boolean',
			'produtos.pacotes.config.voz.quantidade_ciclos' => 'nullable|required_unless:produtos.pacotes.config.voz.desconto,|'.Rule::in(NotMappedHelper::$ciclos),
			'produtos.pacotes.config.voz.tecnologia' => 'required|'.Rule::in(['Analógica','Digital','SIP']),
			'produtos.pacotes.config.voz.tecnologia_sinalizacao' => 'required_if:produtos.pacotes.config.voz.tecnologia,Digital|nullable|'.Rule::in(['R2','ISDN']),
			'produtos.pacotes.config.voz.quantidade_linhas' => 'required|numeric',
			'produtos.pacotes.config.voz.faixa_numeracao.identificacao' => 'required_if:produtos.pacotes.config.voz.tecnologia,Digital,SIP|nullable|'.Rule::in(['ramal','piloto']),
			'produtos.pacotes.config.voz.faixa_numeracao.piloto' => ['required_if:produtos.pacotes.config.voz.tecnologia,Digital,SIP','nullable','numeric'],
			'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros' => ['required','array',new CheckNumbers],
			'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.inicial' => 'required|numeric|digits:10',
			'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final' => ['required','numeric','digits:10'],
			'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.portado' => 'required|'.Rule::in(['sim','não']),
			'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.operadora_doadora' => 'required_if:produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.portado,sim|max:10',
			'produtos.cloudbackup' => 'nullable',
			'produtos.cloudbackup.config.email' => 'required_unless:produtos.cloudbackup,|max:50|email|regex:/^\S*$/u',
			'produtos.cloudbackup.config.valor' => ['required_unless:produtos.cloudbackup,','numeric','min:0'],
			'produtos.cloudbackup.config.desconto' => ['nullable','numeric','min:0'],
			'produtos.cloudbackup.config.is_percent' => 'nullable|boolean',
			'produtos.cloudbackup.config.quantidade_ciclos' => 'nullable|required_unless:produtos.cloudbackup.config.desconto,|'.Rule::in(NotMappedHelper::$ciclos),
			'produtos.0800.config.numero_0800' => 'required_unless:produtos.0800,|numeric|digits:10|starts_with:800',
			'produtos.0800.config.numero_encaminhamento' => ['required_unless:produtos.0800,','numeric','digits:10'],
			'produtos.0800.config.portado' => 'required_unless:produtos.0800,|'.Rule::in(['sim','não']),
			'produtos.0800.config.operadora_doadora' => 'required_if:produtos.0800.config.portado,sim|max:10',
			'produtos.0800.config.valor' => ['required_unless:produtos.0800,','numeric','min:0'],
			'produtos.0800.config.desconto' => ['nullable','numeric','min:0'],
			'produtos.0800.config.is_percent' => 'nullable|boolean',
			'produtos.0800.config.quantidade_ciclos' => 'nullable|required_unless:produtos.0800.config.desconto,|'.Rule::in(NotMappedHelper::$ciclos),
			'produtos.*.tipo_id' => 'required_unless:produtos.*,|distinct|exists:tipos,id',
			'produtos.*.config' => 'required_unless:produtos.*,|array',
			'observacoes' => 'nullable|max:1000',
		];
	}
}
