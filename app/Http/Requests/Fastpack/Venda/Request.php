<?php
/**
 * Created by Alberto de Almeida Guilherme.
 * Date: 06/09/2019
 * Time: 15:17
 *
 * Last edited by Alberto de Almeida Guilherme
 * Date: 06/09/2019
 * Time: 15:17
 */

namespace App\Http\Requests\Fastpack\Venda;


class Request extends VendaRequest {

	protected static $modulo = 6;
	protected static $permission = 3;
	protected $custom_rules = null;

	public function messages()
	{
		return
			[
				'lte' => 'O desconto deve ser menor ou igual o valor',
				'cliente.status.required' => 'O cliente deve ser validado',
				'cliente.status.in' => 'O cliente deve ser aprovado',
				'cliente.data_verificacao.required' => 'O cliente deve ser aprovado',
				'predio_cliente_complemento.required' => 'Campo obrigatório',
				'predio_cliente_complemento.max' => 'O campo não deve ter mais que :max caracteres',
				'contato_comercial.*.required' => 'O campo é obrigatório',
				'contato_comercial.*.max' => 'O campo não deve ter mais que :max caracteres',
				'contato_comercial.email.email' => 'O campo deve ser um e-mail',
				'contato_comercial.email.regex' => 'Não é permitido espaço em branco',
				'predio_id.required' => 'Por favor selecionar o predio',
				'predio_id.exists' => 'Prédio inválido',
				'endereco_predio.*.required' => 'O campo é obrigatório',
				'endereco_predio.*.max' => 'O campo não deve ter mais que :max caracteres',
				'endereco_correspondencia.cidade.id.required' => 'Campo obrigatório',
				'endereco_correspondencia.cidade.id.integer' => 'A cidade é inválida',
				'endereco_correspondencia.cidade.id.exists' => 'Cidade não cadastrada',
				'endereco_correspondencia.uf.uf.required' => 'Campo obrigatório',
				'endereco_correspondencia.uf.uf.exists' => 'Campo inválido',
				'endereco_correspondencia.*.required' => 'O campo é obrigatório',
				'endereco_correspondencia.*.max' => 'O campo não deve ter mais que :max caracteres',
				'contratada_filial.id.required' => 'A filial é obrigatória',
				'contratada_filial.id.exists' => 'Essa filial não existe',
				//PRODUTOS
				//INTERNET
				'produtos.pacotes.config.internet.valor.required' => 'O valor da internet é obrigatório',
				'produtos.pacotes.config.internet.valor.numeric' => 'O valor da internet deve ser um número',
				'produtos.pacotes.config.internet.desconto.numeric' => 'O desconto da internet deve ser um número',
				'produtos.pacotes.config.internet.desconto.max' => 'O campo deve ser máximo :max',
				'produtos.pacotes.config.internet.is_percent.boolean' => 'Informe se o desconto é em porcentagem ou não',
				'produtos.pacotes.config.internet.quantidade_ciclos.required_unless' => 'A quantidade de ciclos é obrigatória.',
				'produtos.pacotes.config.internet.quantidade_ciclos.in' => 'Selecione um valor válido',
				//VOZ
				'produtos.pacotes.config.voz.valor.required' => 'O valor da voz é obrigatório',
				'produtos.pacotes.config.voz.valor.numeric' => 'O valor da voz deve ser um número',
				'produtos.pacotes.config.voz.desconto.numeric' => 'O desconto da voz  deve ser um número',
				'produtos.pacotes.config.voz.desconto.max' => 'O campo deve ser máximo :max',
				'produtos.pacotes.config.voz.is_percent.boolean' => 'Informe se o desconto é em porcentagem ou não',
				'produtos.pacotes.config.voz.quantidade_ciclos.required_unless' => 'A quantidade de ciclos é obrigatória.',
				'produtos.pacotes.config.voz.quantidade_ciclos.in' => 'Selecione um valor válido',
				'produtos.pacotes.config.voz.tecnologia.required' => 'Selecione a tecnologia',
				'produtos.pacotes.config.voz.tecnologia.in' => 'Selecione um valor válido',
				'produtos.pacotes.config.voz.tecnologia_sinalizacao.required_if' => 'Selecione o tipo da tecnologia',
				'produtos.pacotes.config.voz.tecnologia_sinalizacao.in' => 'Selecione um valor válido',
				'produtos.pacotes.config.voz.quantidade_linhas.required' => 'Informe a quantidade de linhas',
				'produtos.pacotes.config.voz.quantidade_linhas.numeric' => 'A quantidade de linhas deve ser um número',
				'produtos.pacotes.config.voz.quantidade_linhas.max' => 'A quantidade de linhas não deve ser maior que :max',
				'produtos.pacotes.config.voz.quantidade_linhas.in' => 'A quantidade de linhas deve ser 1,2,3,4,5,10,15,20,25 ou 30',
				'produtos.pacotes.config.voz.faixa_numeracao.identificacao.required_if' => 'A identificação é obrigatório quando a tecnologia é :value',
				'produtos.pacotes.config.voz.faixa_numeracao.identificacao.in' => 'A identificação deve ser ramal ou piloto',
				'produtos.pacotes.config.voz.faixa_numeracao.piloto.required_if' => 'O piloto é obrigatório quando a tecnologia é :value',
				'produtos.pacotes.config.voz.faixa_numeracao.piloto.numeric' => 'O piloto deve ser um número',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.required' => 'Os números são obrigatórios',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.max' => 'O número máximo de linhas é :max',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.size' => 'Deve ser informado :size linhas',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.inicial.required' => 'Campo obrigatório',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.inicial.numeric' => 'O campo deve ser um número',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.inicial.digits' => 'O campo deve ter :digits números',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final.required' => 'Campo obrigatório',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final.numeric' => 'O campo deve ser um número',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final.digits' => 'O campo deve ter :digits números',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.final.same' => 'Só é permitido um número por faixa',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.portado.required' => 'Informe se o número é portado ou não',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.portado.in' => 'O campo deve ser sim ou não',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.operadora_doadora.required_if' => 'A operadora doadora é obrigatório',
				'produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.*.operadora_doadora.max' => 'Máximo de :max caracteres',
				//BACKUP cloudbackup
				'produtos.cloudbackup.config.email.required_unless' => 'O e-mail é obrigatório',
				'produtos.cloudbackup.config.email.email' => 'O campo deve ser um e-mail',
				'produtos.cloudbackup.config.email.regex' => 'Não é permitido espaço em branco',
				'produtos.cloudbackup.config.email.max' => 'Máximo de :max caracteres',
				//SMARTBOX
				'produtos.*.config.quantidade_ramais.required_unless' => 'O campo é obrigatório',
				'produtos.*.config.quantidade_ramais.numeric' => 'O campo é deve ser um número',
				'produtos.*.config.quantidade_ramais.max' => 'O máximo é :max',
        'produtos.*.config.quantidade_ramais.min' => 'O mínimo é :min',
				'produtos.*.config.valor.required_unless' => 'O valor é obrigatório',
				'produtos.*.config.valor.numeric' => 'O valor é deve ser um número',
				'produtos.*.config.desconto.numeric' => 'O desconto é deve ser um número',
				'produtos.*.config.desconto.max' => 'O campo deve ser máximo :max.',
				'produtos.*.config.is_percent.boolean' => 'Informe se o desconto é em porcentagem ou não',
				'produtos.*.config.quantidade_ciclos.required_unless' => 'A quantidade de ciclos é obrigatória',
				'produtos.*.config.quantidade_ciclos.in' => 'A quantidade de ciclos é inválida',
				'produtos.*.tipo_id.required' => "O tipo é obrigatório",
				'produtos.*.tipo_id.required_unless' => "O tipo é obrigatório",
				'produtos.*.config.required_unless' => "A configuração do produto é obrigatória",
				'produtos.*.tipo_id.in' => "Tipo inválido",
				'produtos.*.config.max' => "Máximo de :max carácteres",
				'produtos.*.produto_id.required' => "O produto é obrigatório",
				'produtos.*.produto_id.in' => "Produto inválido",
				'produtos.pacotes.required' => 'O pacote é obrigatório',
				'produtos.pacotes.tipo_id.required' => 'Por favor, informe o tipo',
				'produtos.pacotes.tipo_id.in' => 'O tipo deve ser um pacote',
				'produtos.pacotes.produto_id' => 'O produto é obrigatório',
				'observacoes.max' => 'Máximo de :max caracteres',
				//0800
				'produtos.0800.config.*.required_unless' => 'O campo é obrigatório',
				'produtos.0800.config.*.required_if' => 'O campo é obrigatório',
				'produtos.0800.config.*.numeric' => 'O campo deve ser um número',
				'produtos.0800.config.*.digits' => 'O campo deve ter no máximo :digits digitos',
				'produtos.0800.config.*.max' => [
					'numeric' => 'O campo deve ser máximo :max.',
					'file'    => ':attribute deve ter no mínimo :min kilobytes.',
					'string'  => 'O campo deve ter no máximo :max caracteres',
				],
				'produtos.0800.config.*.starts_with' => 'O campo deve começar com :values',
				'produtos.0800.config.portado.in' => 'Informe se o número é portado ou não',
			];
	}

	protected function checkForValue($var,$string_error,$rule_value){
		if(isset($var['desconto'])){
			if(isset($var['is_percent']) && $var['is_percent']){
				$this->custom_rules[$string_error][] = 'max:100';
			}else{
				$this->custom_rules[$string_error][] = $rule_value;
			}
		}
	}
}
