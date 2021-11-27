<template lang="pug">
	section#pageVendaForm
		httMensagem(ref="mensagem")
		form(v-on:submit.prevent="sendForm", autocomplete="off")
			div.fieldset
				httButton(v-if="showCanEditVenda", buttonType='button', buttonText="Toggle Edição", @click="habilitarEdicao()", :buttonDisabled="btnDisabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')")
			div.fieldset
				h3._100.totalWidth Observações do Auditor
				ul.observacoes._100
					li(v-if="observacao" v-for="observacao in venda.observacoes_auditoria") {{ observacao }}

			div.fieldset
				httInput(inputName="venda.codigo", inputLabel="Código", :inputDisabled='true' inputType="text", :inputValue.sync="venda.codigo", :inputMessage="getError('codigo')", :class="{ 'error': existError('codigo') }")._30
				httInput(inputName="venda.cliente.nome", inputLabel="Nome", :inputDisabled='true' inputType="text", :inputValue.sync="venda.cliente.nome", :inputMessage="getError('cliente.nome')", :class="{ 'error': existError('cliente.nome') }")._45
				httInput(inputName="venda.cliente.documento", inputLabel="Documento", :inputDisabled='true' inputType="text", :inputValue.sync="venda.cliente.documento", :inputMessage="getError('cliente.documento')", :class="{ 'error': existError('cliente.documento') }")._25.totalWidth
				div.fieldset.verifyCliente._100.totalWidth(v-if="!(venda.status == 'V' || venda.status == 'P')", :class="{ 'error': existError('cliente.data_verificacao') || existError('cliente.status') }")
					span.message(v-if="existError('cliente.data_verificacao')") {{ getError('cliente.data_verificacao') }}
					span.message(v-if="!existError('cliente.data_verificacao') && existError('cliente.status')") {{ getError('cliente.status') }}
					httButton(buttonType='button', buttonText="Verificar Cliente", @click="verifyCliente()", :buttonDisabled="clienteVerificacao.disabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/aprovar_branco.svg')")
					div
						p
							strong Status do cliente: 
							| {{ clienteVerificacao.mensagem }}

				httSelect(sPlaceholder="Selecione Contratada", :sOptions="contratadas", sLabel="nome", sTrack="id", :sValue.sync="venda.contratada", :multiple='false', :selectMessage="getError('contratada.id')", :class="{ 'error': existError('contratada.id') }", :disabled="!canSave")._50.totalWidth
				httSelect(v-if="venda.contratada" sPlaceholder='Selecione Filial', :sOptions="venda.contratada.filiais", sLabel="nome", sTrack="id", :sValue.sync="venda.contratada_filial", :multiple='false', :selectMessage="getError('contratada_filial.id')", :class="{ 'error': existError('contratada_filial.id') }", :disabled="!canSave")._50.totalWidth
				textarea(placeholder='Observações' v-model='venda.observacoes')
				httInput(@blur="limparErroCampo('campanha')" inputName="venda.campanha", inputLabel="Campanha", inputType="text", :inputValue.sync="venda.campanha", :inputMessage="getError('campanha')", :class="{ 'error': existError('campanha') }", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('campanha_nome')" inputName="venda.campanha_nome", inputLabel="Nome da Campanha", inputType="text", :inputValue.sync="venda.campanha_nome", :inputMessage="getError('campanha_nome')", :class="{ 'error': existError('campanha_nome') }", :inputDisabled="!canSave")._80
				

			div.fieldset
				h3._100.totalWidth Contato Comercial
				httSelect(sPlaceholder='Selecionar Contato', :sOptions="venda.cliente.contato", sLabel="nome", :sValue.sync="venda.contato_comercial", :multiple='false', :disabled="!canSave")._100
				httInput(@blur="limparErroCampo('contato_comercial.nome')" inputName="venda.contato_comercial.nome", inputLabel="Nome", inputType="text", :inputValue.sync="contatoComercial.nome", :inputMessage="getError('contato_comercial.nome')", :class="{ 'error': existError('contato_comercial.nome') }", :inputDisabled="!canSave")._50
				httInput(@blur="limparErroCampo('contato_comercial.email')" inputName="venda.contato_comercial.email", inputLabel="Email", inputType="text", :inputValue.sync="contatoComercial.email", :inputMessage="getError('contato_comercial.email')", :class="{ 'error': existError('contato_comercial.email') }", :inputDisabled="!canSave")._50
				httInput(@blur="limparErroCampo('contato_comercial.telefone')" inputName="venda.contato_comercial.telefone", inputLabel="Telefone", inputType="text", :inputValue.sync="contatoComercial.telefone", :inputMessage="getError('contato_comercial.telefone')", :class="{ 'error': existError('contato_comercial.telefone') }", :inputMask="btnDisabled ? '##########' : '(##) ####-####'", :inputDisabled="!canSave")._50
				httInput(@blur="limparErroCampo('contato_comercial.celular')" inputName="venda.contato_comercial.celular", inputLabel="Celular", inputType="text", :inputValue.sync="contatoComercial.celular", :inputMessage="getError('contato_comercial.celular')", :class="{ 'error': existError('contato_comercial.celular') }", :inputMask="btnDisabled ? '###########' : '(##) #####-####'", :inputDisabled="!canSave")._50

			div.fieldset
				h3._100.totalWidth Endereço {{ venda.is_empreendimento ? "Empreendimento" : "Prédio" }}
				httInput(:inputDisabled="true" inputName="venda.endereco_predio.cep", inputLabel="CEP", inputType="text", :inputValue.sync="venda.endereco_predio.cep", :inputMask="btnDisabled ? '##########' : '#####-###'")._20
				httInput(:inputDisabled="true" inputName="venda.endereco_predio.logradouro", inputLabel="Logradouro", inputType="text", :inputValue.sync="venda.endereco_predio.logradouro")._40
				httInput(:inputDisabled="true" inputName="venda.endereco_predio.numero", inputLabel="Número", inputType="text", :inputValue.sync="venda.endereco_predio.numero", :inputMask="'#######'")._20
				httInput(:inputDisabled="true" inputName="venda.endereco_predio.complemento", inputLabel="Complemento", inputType="text", :inputValue.sync="venda.endereco_predio.complemento")._20
				httInput(:inputDisabled="true" inputName="venda.endereco_predio.bairro", inputLabel="Bairro", inputType="text", :inputValue.sync="venda.endereco_predio.bairro")._30
				httSelect(:disabled="true", :sOptions="ufs", sLabel="uf", sTrack="uf", :sValue.sync="venda.endereco_predio.uf")._10
				httSelect(:disabled="true", :sOptions="cidades", sLabel="nome", sTrack="nome", :sValue.sync="venda.endereco_predio.cidade")._30
				httInput(inputName="venda.predio_cliente_complemento", inputLabel="Complemento do cliente", inputType="text", :inputValue.sync="venda.predio_cliente_complemento", :inputMessage="getError('predio_cliente_complemento')", :class="{ 'error': existError('predio_cliente_complemento') }", :inputDisabled="!canSave")._30

			div.fieldset
				h3._100.totalWidth Endereço de Correspondencia
				httInput(@blur="limparErroCampo('endereco_correspondencia.cep')" inputName="venda.endereco_correspondencia.cep", inputLabel="CEP", inputType="text", :inputValue.sync="venda.endereco_correspondencia.cep", :inputMessage="getError('endereco_correspondencia.cep')", :class="{ 'error': existError('endereco_correspondencia.cep') }", :inputMask="btnDisabled ? '##########' : '#####-###'", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('endereco_correspondencia.logradouro')" inputName="venda.endereco_correspondencia.logradouro", inputLabel="Logradouro", inputType="text", :inputValue.sync="venda.endereco_correspondencia.logradouro", :inputMessage="getError('endereco_correspondencia.logradouro')", :class="{ 'error': existError('endereco_correspondencia.logradouro') }", :inputDisabled="!canSave")._40
				httInput(@blur="limparErroCampo('endereco_correspondencia.numero')" inputName="venda.endereco_correspondencia.numero", inputLabel="Número", inputType="text", :inputValue.sync="venda.endereco_correspondencia.numero", :inputMessage="getError('endereco_correspondencia.numero')", :class="{ 'error': existError('endereco_correspondencia.numero') }", :inputMask="'#######'", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('endereco_correspondencia.complemento')" inputName="venda.endereco_correspondencia.complemento", inputLabel="Complemento", inputType="text", :inputValue.sync="venda.endereco_correspondencia.complemento", :inputMessage="getError('endereco_correspondencia.complemento')", :class="{ 'error': existError('endereco_correspondencia.complemento') }", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('endereco_correspondencia.bairro')" inputName="venda.endereco_correspondencia.bairro", inputLabel="Bairro", inputType="text", :inputValue.sync="venda.endereco_correspondencia.bairro", :inputMessage="getError('endereco_correspondencia.bairro')", :class="{ 'error': existError('endereco_correspondencia.bairro') }", :inputDisabled="!canSave")._30
				httSelect(sPlaceholder="Selecione Estado", :sOptions="ufs", sLabel="uf", sTrack="uf", :sValue.sync="venda.endereco_correspondencia.uf", :selectMessage="getError('endereco_correspondencia.uf')", :class="{ 'error': existError('endereco_correspondencia.uf') }", :disabled="!canSave")._10
				httSelect(sPlaceholder="Selecione Cidade", :sOptions="endCorrespondenciaCidades", sLabel="nome", sTrack="nome", :sValue.sync="venda.endereco_correspondencia.cidade", :selectMessage="getError('endereco_correspondencia.cidade')", :class="{ 'error': existError('endereco_correspondencia.cidade') }", :disabled="!canSave")._30

			div.fieldset
				h3._100.totalWidth Fatura
				httSelect(:sOptions="vencimentos", :sValue.sync="venda.vencimento", :multiple='false', :inputMessage="getError('vencimento')", :class="{ 'error': existError('vencimento') }", :disabled="!canSave")._20
				httInput(@blur="limparErroCampo('email_fatura')"  inputName="venda.email_fatura", inputLabel="E-mail Fatura", inputType="text", :inputValue.sync="venda.email_fatura", :inputMessage="getError('email_fatura')", :class="{ 'error': existError('email_fatura') }", :inputDisabled="!canSave")._50
				
			div.fieldset(v-if="produtoSelecionado.pacotes")
				h3._100.totalWidth Produtos
				div.fieldset
					h4._100.totalWidth Pacote Internet
					httSelect(:sOptions="produtos.pacotes", sLabel="nome", sTrack="produto_id", :sValue.sync="produtoSelecionado.pacotes", :multiple='false', :disabled="!canSave")._30
					div.fieldset.produtos(v-if="produtoSelecionado.pacotes")
						httInput(@blur="limparErroCampo('produtos.pacotes.config.internet.valor')" inputName="produtoConteudo.pacotes.config.internet.valor", inputLabel="Valor", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.internet.valor", :inputMessage="getError('produtos.pacotes.config.internet.valor')", :class="{ 'error': existError('produtos.pacotes.config.internet.valor') }", :inputMoney="money", :inputDisabled="!canSave")._25
						httInput(@blur="limparErroCampo('produtos.pacotes.config.internet.desconto')" inputName="produtoConteudo.pacotes.config.internet.desconto", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.internet.desconto", :inputMessage="getError('produtos.pacotes.config.internet.desconto')", :class="{ 'error': existError('produtos.pacotes.config.internet.desconto') }", :inputMask="'###'", :inputDisabled="!canSave", :inputShow="produtoConteudo.pacotes.config.internet.is_percent")._25
						httInput(@blur="limparErroCampo('produtos.pacotes.config.internet.desconto')" inputName="produtoConteudo.pacotes.config.internet.desconto", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.internet.desconto", :inputMessage="getError('produtos.pacotes.config.internet.desconto')", :class="{ 'error': existError('produtos.pacotes.config.internet.desconto') }", :inputMoney="money", :inputDisabled="!canSave", :inputShow="!produtoConteudo.pacotes.config.internet.is_percent")._25
						httInput(:inputDisabled="true" inputName="valorTotalPacote", inputLabel="Valor Total", inputType="text", :inputValue.sync="valorTotalPacote")._15
						httCheckAtivo(nomeCheckbox="Porcentagem", :checkboxValue.sync="produtoConteudo.pacotes.config.internet.is_percent", :disabledCheckbox="!canSave")._10
						httSelect(sPlaceholder="Ciclos", :empty="true", :sOptions="ciclos", :sValue.sync="produtoConteudo.pacotes.config.internet.quantidade_ciclos", :multiple='false', :selectMessage="getError('produtos.pacotes.config.internet.quantidade_ciclos')", :class="{ 'error': existError('produtos.pacotes.config.internet.quantidade_ciclos') }", :disabled="!canSave")._25

				div.fieldset
					h4._100.totalWidth Pacote Voz
					div.fieldset.produtos(v-if="produtoSelecionado.pacotes")
						httInput(inputName="produtoConteudo.pacotes.config.voz.valor", :inputMoney="money" inputLabel="Valor", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.voz.valor", :inputMessage="getError('produtos.pacotes.config.voz.valor')", :class="{ 'error': existError('produtos.pacotes.config.voz.valor') }", @blur="limparErroCampo('produtos.pacotes.config.voz.valor')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo.pacotes.config.voz.desconto", :inputMoney="money", :inputShow="!produtoConteudo.pacotes.config.voz.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.voz.desconto", :inputMessage="getError('produtos.pacotes.config.voz.desconto')", :class="{ 'error': existError('produtos.pacotes.config.voz.desconto') }", @blur="limparErroCampo('produtos.pacotes.config.voz.desconto')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo.pacotes.config.voz.desconto", :inputMask="'###'", :inputShow="produtoConteudo.pacotes.config.voz.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.voz.desconto", :inputMessage="getError('produtos.pacotes.config.voz.desconto')", :class="{ 'error': existError('produtos.pacotes.config.voz.desconto') }", @blur="limparErroCampo('produtos.pacotes.config.voz.desconto')", :inputDisabled="!canSave")._25
						httInput(:inputDisabled="true" inputName="valorTotalVoz", inputLabel="Valor Total", inputType="text", :inputValue.sync="valorTotalVoz")._15
						httCheckAtivo(nomeCheckbox="Porcentagem", :checkboxValue.sync="produtoConteudo.pacotes.config.voz.is_percent", :disabledCheckbox="!canSave")._10
						httSelect(sPlaceholder="Ciclos", :empty="true", :sOptions="ciclos", :sValue.sync="produtoConteudo.pacotes.config.voz.quantidade_ciclos", :multiple='false', :selectMessage="getError('produtos.pacotes.config.voz.quantidade_ciclos')", :class="{ 'error': existError('produtos.pacotes.config.voz.quantidade_ciclos') }", :disabled="!canSave")._25
						httSelect(:empty="true", @change="clear(['produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao', 'produtoConteudo.pacotes.config.voz.faixa_numeracao.piloto'])" sPlaceholder="Tecnologia", :sOptions="tecnologia", :sValue.sync="produtoConteudo.pacotes.config.voz.tecnologia", :multiple='false', :selectMessage="getError('produtos.pacotes.config.voz.tecnologia')", :class="{ 'error': existError('produtos.pacotes.config.voz.tecnologia') }", :disabled="!canSave")._50
						httSelect(:empty="true" v-if="produtoConteudo.pacotes.config.voz.tecnologia == 'Digital'", sPlaceholder="Tecnologia de Sinalização", :sOptions="tecnologia_sinalizacao", :sValue.sync="produtoConteudo.pacotes.config.voz.tecnologia_sinalizacao", :multiple='false', :selectMessage="getError('produtos.pacotes.config.voz.tecnologia_sinalizacao')", :class="{ 'error': existError('produtos.pacotes.config.voz.tecnologia_sinalizacao') }", :disabled="!canSave")._50
						httInput(inputName="produtoConteudo.pacotes.config.voz.quantidade_linhas", :inputMask="'#####'", inputLabel="Quantidade de Linhas", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.voz.quantidade_linhas", :inputMessage="getError('produtos.pacotes.config.voz.quantidade_linhas')", :class="{ 'error': existError('produtos.pacotes.config.voz.quantidade_linhas') }", @blur="limparErroCampo('produtos.pacotes.config.voz.quantidade_linhas')", :inputDisabled="!canSave")._50
						httSelect(:empty="true" v-if="produtoConteudo.pacotes.config.voz.tecnologia != 'Analógica'", sPlaceholder="Identificação", :sOptions="identificacoes", :sValue.sync="produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao", :multiple='false', :selectMessage="getError('produtos.pacotes.config.voz.faixa_numeracao.identificacao')", :class="{ 'error': existError('produtos.pacotes.config.voz.faixa_numeracao.identificacao') }", @blur="limparErroCampo('produtos.pacotes.config.voz.faixa_numeracao.identificacao')", :disabled="!canSave")._50
						httInput(v-if="produtoConteudo.pacotes.config.voz.tecnologia != 'Analógica'" inputName="produtoConteudo.pacotes.config.voz.faixa_numeracao.piloto", :inputMask="btnDisabled ? '##########' : '(##) ####-####'" inputLabel="Piloto", inputType="text", :inputValue.sync="produtoConteudo.pacotes.config.voz.faixa_numeracao.piloto", :inputMessage="getError('produtos.pacotes.config.voz.faixa_numeracao.piloto')", :class="{ 'error': existError('produtos.pacotes.config.voz.faixa_numeracao.piloto') }", @blur="limparErroCampo('produtos.pacotes.config.voz.faixa_numeracao.piloto')", :inputDisabled="!canSave")._50
						div.faixas._100.fieldset
							span.message.error(v-if="existError('produtos.pacotes.config.voz.faixa_numeracao.lista_numeros')") {{ getError('produtos.pacotes.config.voz.faixa_numeracao.lista_numeros') }}
							div.faixa(v-for="numeroLista, index in produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros")._100
								h4._100 Faixa 
								httInput(:inputName="`inicial-${index}`", :inputMask="btnDisabled ? '##########' : '(##) ####-####'", inputLabel="Inicial", inputType="text", :inputValue.sync="numeroLista.inicial", :inputMessage="getError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.inicial`)", :class="{ 'error': existError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.inicial`) }",  @blur="limparErroCampo(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.inicial`)", :inputDisabled="!canSave")._25
								httInput(:inputName="`final-${index}`", :inputMask="btnDisabled ? '##########' : '(##) ####-####'", inputLabel="Final", inputType="text", :inputValue.sync="numeroLista.final", :inputMessage="getError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.final`)", :class="{ 'error': existError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.final`) }", @blur="limparErroCampo(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.final`)", :inputDisabled="!canSave")._25
								httSelect(sPlaceholder="Portado", :sOptions="portado", :sValue.sync="numeroLista.portado", :multiple='false', :selectMessage="getError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.portado`)", :class="{ 'error': existError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.portado`) }",  @blur="limparErroCampo(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.portado`)", :disabled="!canSave")._25
								httInput(v-if="numeroLista.portado == 'sim'", :inputName="`operadora_doadora-${index}`", inputLabel="Operadora Doadora", inputType="text", :inputValue.sync="numeroLista.operadora_doadora", :inputMessage="getError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.operadora_doadora`)", :class="{ 'error': existError(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.operadora_doadora`) }", @blur="limparErroCampo(`produtos.pacotes.config.voz.faixa_numeracao.lista_numeros.${index}.operadora_doadora`)", :inputDisabled="!canSave")._25
								httButton(buttonType='button', buttonText="Remover", @click="removeFaixa(index)", :buttonDisabled="!canSave")._25
							httButton(v-if="maxNumberFaixa > produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.length" buttonType='button', buttonText="Adicionar nova faixa", @click="createFaixa()", :buttonDisabled="!canSave")._30

				div.fieldset
					h4._100.totalWidth Cloud Backup
					httSelect(:sOptions="produtos.cloudbackup", sLabel="nome", sTrack="produto_id", :sValue.sync="produtoSelecionado.cloudbackup", :multiple='false', v-if="produtos.cloudbackup", :empty="true", :disabled="!canSave")._30
					div.fieldset.produtos(v-if="produtoSelecionado.cloudbackup")
						httInput(inputName="produtoConteudo.cloudbackup.config.email", inputLabel="Email", inputType="text", :inputValue.sync="produtoConteudo.cloudbackup.config.email", :inputMessage="getError('produtos.cloudbackup.config.email')", :class="{ 'error': existError('produtos.cloudbackup.config.email') }", @blur="limparErroCampo('produtos.cloudbackup.config.email')", :inputDisabled="!canSave")._35
						httInput(inputName="produtoConteudo.cloudbackup.config.valor", :inputMoney="money", inputLabel="Valor", inputType="text", :inputValue.sync="produtoConteudo.cloudbackup.config.valor", :inputMessage="getError('produtos.cloudbackup.config.valor')", :class="{ 'error': existError('produtos.cloudbackup.config.valor') }", @blur="limparErroCampo('produtos.cloudbackup.config.valor')", :inputDisabled="!canSave")._20
						httInput(inputName="produtoConteudo.cloudbackup.config.desconto", :inputMoney="money", :inputShow="!produtoConteudo.cloudbackup.config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.cloudbackup.config.desconto", :inputMessage="getError('produtos.cloudbackup.config.desconto')", :class="{ 'error': existError('produtos.cloudbackup.config.desconto') }", @blur="limparErroCampo('produtos.cloudbackup.config.desconto')", :inputDisabled="!canSave")._20
						httInput(inputName="produtoConteudo.cloudbackup.config.desconto", :inputMask="'###'", :inputShow="produtoConteudo.cloudbackup.config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.cloudbackup.config.desconto", :inputMessage="getError('produtos.cloudbackup.config.desconto')", :class="{ 'error': existError('produtos.cloudbackup.config.desconto') }", @blur="limparErroCampo('produtos.cloudbackup.config.desconto')", :inputDisabled="!canSave")._20
						httInput(:inputDisabled="true" inputName="valorTotalCloud", inputLabel="Valor Total", inputType="text", :inputValue.sync="valorTotalCloud")._15
						httCheckAtivo(nomeCheckbox="Porcentagem", :checkboxValue.sync="produtoConteudo.cloudbackup.config.is_percent", :disabledCheckbox="!canSave")._10
						httSelect(sPlaceholder="Ciclos", :empty="true", :sOptions="ciclos", :sValue.sync="produtoConteudo.cloudbackup.config.quantidade_ciclos", :multiple='false', :selectMessage="getError(`produtos.cloudbackup.config.quantidade_ciclos`)", :class="{ 'error': existError(`produtos.cloudbackup.config.quantidade_ciclos`) }", :disabled="!canSave")._25

				div.fieldset
					h4._100.totalWidth 0800
					httSelect(:sOptions="produtos['0800']", sLabel="nome", sTrack="produto_id", :sValue.sync="produtoSelecionado['0800']", :multiple='false', :empty="true", :disabled="!canSave")._30
					div.fieldset.produtos(v-if="produtoSelecionado['0800']")
						httInput(inputName="produtoConteudo['0800'].config.numero_0800", :inputMask="btnDisabled ? '800#######' : '800-###-####'",inputLabel="Numero 0800", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.numero_0800", :inputMessage="getError('produtos.0800.config.numero_0800')", :class="{ 'error': existError('produtos.0800.config.numero_0800') }", @blur="limparErroCampo('produtos.0800.config.numero_0800')", :inputDisabled="!canSave")._30
						httInput(inputName="produtoConteudo['0800'].config.numero_encaminhamento", :inputMask="btnDisabled ? '##########' : '(##) ####-####'", inputLabel="Numero Encaminhado", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.numero_encaminhamento", :inputMessage="getError('produtos.0800.config.numero_encaminhamento')", :class="{ 'error': existError('produtos.0800.config.numero_encaminhamento') }", @blur="limparErroCampo('produtos.0800.config.numero_encaminhamento')", :inputDisabled="!canSave")._30
						httSelect(sPlaceholder="Portado", :sOptions="portado", :sValue.sync="produtoConteudo['0800'].config.portado", :multiple='false', :selectMessage="getError('produtos.0800.config.portado')", :class="{ 'error': existError('produtos.0800.config.portado') }" , :disabled="!canSave")._15
						httInput(v-if="produtoConteudo['0800'].config.portado == 'sim'" inputName="produtoConteudo['0800'].config.operadora_doadora", inputLabel="Operadora Doadora", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.operadora_doadora", :inputMessage="getError('produtos.0800.config.operadora_doadora')", :class="{ 'error': existError('produtos.0800.config.operadora_doadora') }", @blur="limparErroCampo('produtos.0800.config.operadora_doadora')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo['0800'].config.valor", :inputMoney="money", inputLabel="Valor", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.valor", :inputMessage="getError('produtos.0800.config.valor')", :class="{ 'error': existError('produtos.0800.config.valor') }", @blur="limparErroCampo('produtos.0800.config.valor')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo['0800'].config.desconto", :inputMoney="money", :inputShow="!produtoConteudo['0800'].config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.desconto", :inputMessage="getError('produtos.0800.config.desconto')", :class="{ 'error': existError('produtos.0800.config.desconto') }", @blur="limparErroCampo('produtos.0800.config.desconto')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo['0800'].config.desconto", :inputMask="'###'", :inputShow="produtoConteudo['0800'].config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo['0800'].config.desconto", :inputMessage="getError('produtos.0800.config.desconto')", :class="{ 'error': existError('produtos.0800.config.desconto') }", @blur="limparErroCampo('produtos.0800.config.desconto')", :inputDisabled="!canSave")._25
						httInput(:inputDisabled="true" inputName="valorTotal0800", inputLabel="Valor Total", inputType="text", :inputValue.sync="valorTotal0800")._15
						httCheckAtivo(nomeCheckbox="Porcentagem", :checkboxValue.sync="produtoConteudo['0800'].config.is_percent", :disabledCheckbox="!canSave")._10
						httSelect(sPlaceholder="Ciclos", :empty="true", :sOptions="ciclos", :sValue.sync="produtoConteudo['0800'].config.quantidade_ciclos", :multiple='false', :selectMessage="getError('produtos.0800.config.quantidade_ciclos')", :class="{ 'error': existError('produtos.0800.config.quantidade_ciclos') }", :disabled="!canSave")._25
					

				div.fieldset(v-if="!hideSmartBox")
					h4._100.totalWidth SmartBox
					httSelect(:sOptions="produtos.smartbox", sLabel="nome", sTrack="produto_id", :sValue.sync="produtoSelecionado.smartbox", :multiple='false', :empty="true", :disabled="!canSave")._30
					span.message.error(v-if="existError('produtos.smartbox')") {{ getError('produtos.smartbox') }}
					div.fieldset.produtos(v-if="produtoSelecionado.smartbox")
						httInput(inputName="produtoConteudo.smartbox.config.quantidade_ramais", :inputMask="'####'" inputLabel="Quantidade de ramais", inputType="text", :inputValue.sync="produtoConteudo.smartbox.config.quantidade_ramais", :inputMessage="getError('produtos.smartbox.config.quantidade_ramais')", :class="{ 'error': existError('produtos.smartbox.config.quantidade_ramais') }", @blur="limparErroCampo('produtos.smartbox.config.quantidade_ramais')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo.smartbox.config.valor", :inputMoney="money", inputLabel="Valor por Ramal", inputType="text", :inputValue.sync="produtoConteudo.smartbox.config.valor", :inputMessage="getError('produtos.smartbox.config.valor')", :class="{ 'error': existError('produtos.smartbox.config.valor') }", @blur="limparErroCampo('produtos.smartbox.config.valor')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo.smartbox.config.desconto", :inputMoney="money", :inputShow="!produtoConteudo.smartbox.config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.smartbox.config.desconto", :inputMessage="getError('produtos.smartbox.config.desconto')", :class="{ 'error': existError('produtos.smartbox.config.desconto') }", @blur="limparErroCampo('produtos.smartbox.config.desconto')", :inputDisabled="!canSave")._25
						httInput(inputName="produtoConteudo.smartbox.config.desconto", :inputMask="'###'", :inputShow="produtoConteudo.smartbox.config.is_percent", inputLabel="Desconto", inputType="text", :inputValue.sync="produtoConteudo.smartbox.config.desconto", :inputMessage="getError('produtos.smartbox.config.desconto')", :class="{ 'error': existError('produtos.smartbox.config.desconto') }", @blur="limparErroCampo('produtos.smartbox.config.desconto')", :inputDisabled="!canSave")._25
						httInput(:inputDisabled="true" inputName="valorTotalSmartbox", inputLabel="Valor Total", inputType="text", :inputValue.sync="valorTotalSmartbox")._15
						httCheckAtivo(nomeCheckbox="Porcentagem", :checkboxValue.sync="produtoConteudo.smartbox.config.is_percent", :disabledCheckbox="!canSave")._10
						httSelect(sPlaceholder="Ciclos", :empty="true", :sOptions="ciclos", :sValue.sync="produtoConteudo.smartbox.config.quantidade_ciclos", :multiple='false', :selectMessage="getError(`produtos.smartbox.config.quantidade_ciclos`)", :class="{ 'error': existError(`produtos.smartbox.config.quantidade_ciclos`) }", :disabled="!canSave")._25
			
			div.fieldset
				h4._100.totalWidth Download Arquivos
				div.arquivos.flex
					div.arquivo(v-for="documento, index in venda.documentos", @click="downloadArquivo(documento.nome)")
						img(:src="require('@/assets/images/web/icones/iconesLaranja/download_laranja.svg')").download
						img(:src="require('@/assets/images/web/icones/iconesBranco/file.svg')")
						p {{documento.nome}}

			div.fieldset(v-if="showCanGenerateContract")
				h4._20.totalWidth Gerar Contrato com data
				div.fieldset
					httInput(inputName="dataContratoCustom", :inputMask="'##/##/#### ##:##:##'", inputLabel="Data de Emissão", inputType="text", :inputValue.sync="dataContratoCustom", :inputMessage="getError('dataContratoCustom')", :class="{ 'error': existError('dataContratoCustom') }", @blur="limparErroCampo('dataContratoCustom')")._25
				httButton(buttonType='button', buttonText="Gerar Contrato Venda com Data", @click="createContratoCustom()", :buttonDisabled="btnDisabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/file.svg')")

			div.fieldset
				h4._20.totalWidth Upload Arquivos
				httButton(buttonType='button', buttonText="Gerar Contrato Venda", @click="createContrato()", :buttonDisabled="btnDisabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/file.svg')")
				httButton(buttonType='button', buttonText="Gerar Checklist Venda", @click="createChecklist()", :buttonDisabled="btnDisabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/file.svg')")
				httButton(v-if="isSuperUser", buttonType='button', buttonText="Contrato com data", @click="habiltarCTRData()", :buttonDisabled="btnDisabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/file.svg')")
				div.import
					label(for="import")
						input(id="import", @change="importFile", type="file", ref="inputImport", :disabled="btnDisabled")
						span(v-if="!sucesso")
							|Clique aqui e selecione seu arquivo
							img(:src="require('@/assets/images/web/icones/iconesBranco/file.svg')")
						span.sucesso(v-else)
							img(:src="require('@/assets/images/web/icones/iconesPreto/success.svg')")
							| Arquivo carregado com sucesso!
					div(v-if="messagemErro")
						p {{messagemErro}}

			div.fieldset
				httButton(v-if="$root.hasPermission('vendas', 3) || $root.hasPermission('vendas', 2)", buttonType='button', buttonText="Salvar Venda", @click="sendForm()", :buttonDisabled="btnDisabled  || !canSave", :button-icon="require('@/assets/images/web/icones/iconesBranco/save_branco.svg')")
				httButton(v-if="$root.hasPermission('vendas', 3) || $root.hasPermission('vendas', 2)", buttonType='button', buttonText="Auditoria", @click="sendForm(true)", , :buttonDisabled="btnDisabled  || !canSave", :button-icon="require('@/assets/images/web/icones/iconesBranco/aprovar_branco.svg')")
</template>

<script>
import axios from 'axios';
import httButton from '@/vue/components/httButton/HttButton.vue'
import httInput from '@/vue/components/httInput/HttInput.vue'
import httSelect from '@/vue/components/httSelect/HttSelect.vue'
import httCheckAtivo from '@/vue/components/httCheckAtivo/HttCheckAtivo.vue'
import httTableColumn from '@/vue/components/httTableColumn/HttTableColumn.vue'
import httMensagem from '@/vue/components/httMensagem/HttMensagem.vue'
import _ from 'lodash';

import Localizacao from '@/vue/mixins/Localizacao';
import Validacao from '@/vue/mixins/Validacao';
import ProdutosVenda from '@/vue/mixins/ProdutosVenda';

export default {
	mixins: [
		Localizacao,
		Validacao,
		ProdutosVenda
	],
	components: {
		httButton,
		httInput,
		httSelect,
		httCheckAtivo,
		httTableColumn,
		httMensagem
	},
	computed: {
		contatoComercial: function(){
			if(this.venda.contato_comercial.nome){
				return this.venda.contato_comercial
			}else{
				return {
					nome: '',
					email: "",
					telefone: "",
					celular: ""
				}
			}
		},
		isSuperUser: function () {
			return !!(this.$root.authenticated && this.$root.authenticated.usuario && this.$root.authenticated.super === true);
		}
	},
	data() {
		return {
			money:{
				decimal: '.',
				thousands: '',
				prefix: '',
				suffix: '',
				precision: 2,
				masked: false
			},
			venda: {
				contato_comercial: {},
				produtos: {},
				predio_id: "",
				cliente: {}, 
				endereco_correspondencia: {},
				endereco_predio: {},
				vencimento: "",
				email_fatura: "",
			},
			clienteVerificacao: {
				mensagem: "Pendente de verificação",
				disabled: false
			},
			identificacoes: ['ramal','piloto'],
			tecnologia: ['Analógica','Digital','SIP'],
			tecnologia_sinalizacao: ['R2','ISDN'],
			portado: ["sim", "não"],
			vencimentos: [],
			btnDisabled: false,
			showCanEditVenda:false,
			showCanGenerateContract:false,
			canSave:true,
			contratadas: [],
			ciclos: [],
			endCorrespondenciaCidades: [],
            sucesso: false,
			messagemErro: '',
			dataContratoCustom:''
		}
	},
	created() {
		axios
			.all([this.loadProdutos(), this.loadContratada(), this.loadVencimento(), this.loadCiclos()])
			.then(() => {
				if (this.$route.params.id) {
					this.loadContent()
						.then(() => {
							this.configureStatusCliente(this.venda.cliente.status);
						});
				}
			})
	},
	watch: {
		'venda.endereco_correspondencia.uf': function() {
			this.loadCidades(this.venda.endereco_correspondencia.uf, true).then((data) => {
				this.endCorrespondenciaCidades = data
			})
		},
		'venda.endereco_predio.uf': function() {
			this.loadCidades(this.venda.endereco_predio.uf)
		},
		'venda.contratada': function(){
			if(this.venda.contratada_filial && this.venda.contratada && this.venda.contratada.filiais && !this.venda.contratada.filiais.find(filial => filial.cnpj == this.venda.contratada_filial.cnpj))
				this.venda.contratada_filial = null
		}
	},
	methods: {
		downloadArquivo(nome){
			this.$axios
				.get(`vendas/${this.venda.codigo}/documentos/${nome}`, {
                    responseType: 'arraybuffer'
                }).then(response => {
                    let contentDisposition = response.headers['content-disposition'];
                    let name = contentDisposition.split('filename=', contentDisposition.length)[1];
                    let blob = new Blob([response.data], { type: '' })
                    this.ready = true;
					let a = document.createElement('a');
					a.setAttribute("type", "hidden");
					a.href = URL.createObjectURL( blob);
					a.download = name;
					document.body.appendChild(a)
					a.click()
					a.remove()
                })
		},
		createContratoCustom(){
			this.$root.downloading = {
				modulo:'contrato', parameters:{tipo:'generate',codigo:this.venda.codigo,data:this.dataContratoCustom},'documentos':this.venda.documentos
			}
		},
		createContrato() {
			this.$root.downloading = {
				modulo:'contrato', parameters:{tipo:'generate',codigo:this.venda.codigo},'documentos':this.venda.documentos
			}
		},
		createChecklist(){
			this.$root.downloading = {
				modulo:'contrato', parameters:{tipo:'checklist',codigo:this.venda.codigo},'documentos':this.venda.documentos
			}
		},
		importFile(event) {
            let form = new FormData()
            form.append('file', event.target.files[0]);
            this.btnDisabled = true;
            this.$axios
				.post(`vendas/${this.venda.codigo}/upload`, form, {
                    'Content-Type': 'multipart/form-data',
                })
				.then(response => {
					this.sucesso = true
					this.venda.documentos.push(response.data.documento)
				}).catch(error => {
                    if(error.response.status == 500){
                        this.messagemErro = 'Erro ao enviar planilha'
                    }else{
                        this.messagemErro = error.response.data.error_validate.file[0]
                    }
                    this.sucesso = false;
                }).finally(() => {
                    setTimeout(() => {
						this.$refs.inputImport.value = null
                        this.btnDisabled = false;
						this.sucesso = false;
                    }, 4500)
                })
		},
		clear(campos) {
			campos.forEach(campo => {
				if(_.get(this.$data, campo)){
					_.unset(this.$data, campo)
				}
			})
		},
		configureStatusCliente(validacao) {
			switch (validacao) {
				case 'A': this.clienteVerificacao.mensagem = "Aprovado"; break;
				case 'E': this.clienteVerificacao.mensagem = "Expirado"; break;
				case 'R': this.clienteVerificacao.mensagem = "Reprovado"; break;
				default: this.clienteVerificacao.mensagem = "Não verificado";
			}
		},
		verifyCliente() {
			this.clienteVerificacao.disabled = true
			this.$axios
				.get(`clientes/${this.venda.cliente.documento}/verify`)
				.then(response => {
					
					if (response.data.approved)
						this.configureStatusCliente('A')
					else
						this.configureStatusCliente('R')
				})
				.catch(error => {
					this.clienteVerificacao.disabled = false
					if (error.response.data.success != undefined)
						this.clienteVerificacao.mensagem = "Ocorreu um erro ao validar";
					else
						this.clienteVerificacao.mensagem = error.response.data.msg;
				});
		},
		loadVencimento() {
			return this.$axios
				.get('vendas/vencimentos')
				.then(response => {
					this.vencimentos = response.data;
				})
		},
		loadCiclos() {
			return this.$axios
				.get('vendas/ciclos')
				.then(response => {
					this.ciclos = response.data;
				})
		},
		loadContratada() {
			return this.$axios
				.get('vendas/contratadas')
				.then(response => {
					this.contratadas = response.data;
				})
		},
		loadContent() {
			return this.$axios
				.get(`vendas/${this.$route.params.id}`)
				.then(response => {
					this.venda = response.data;
					this.syncProdutosLoad();
					if(this.venda.contratada && this.venda.contratada.id)
						this.venda.contratada = this.contratadas.find(contratada => contratada.id = this.venda.contratada.id)

					if (this.venda.status != "E" && this.venda.status != "A") {
						this.$refs.mensagem.showAviso('Esta venda não pode ser alterada!');
						this.canSave = false;
						if(this.$root.authenticated && this.$root.authenticated.usuario && this.$root.authenticated.super === true)
							this.showCanEditVenda = true;
					}
				})
		},
		idNumerico(predioId) {
			let reg = new RegExp(/\d+/, "gi");
			return reg.exec(predioId)[0];
		},
		sendForm(aprovacao = false) {
			this.venda.contato_comercial = this.contatoComercial
			
			this.btnDisabled = true;
			this.canSave = false;
			this.syncProdutosSend();
			this.$axios
				.post(`vendas/${ this.venda.codigo }${ aprovacao ? '/aprovar' : '' }`, this.venda)
				.then(response => {
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showSucesso(response.data.msg);
				})
				.catch(error => {
					this.$refs.mensagem.toTop();
					if(error.response.status == 422) {
						this.$refs.mensagem.showErro(error.response.data.msg);
						this.errors = error.response.data.error_validate ? error.response.data.error_validate : {};
					}
				})
				.finally(() => {
					this.btnDisabled = false;
					this.venda.produtos = {};
					setTimeout(() => {
						this.canSave = true;
						this.$refs.mensagem.hide();
					}, 3500);
				})
		},
		habilitarEdicao(){
			this.$refs.mensagem.hide();
			this.canSave = !this.canSave;
			setTimeout(() => {
				if(this.canSave)
					this.$refs.mensagem.showAviso('Esta venda pode, mas não deve ser alterada!');
				else
					this.$refs.mensagem.showAviso('Esta venda não pode ser alterada!');
			}, 1000);

		},
		habiltarCTRData(){
			this.showCanGenerateContract = !this.showCanGenerateContract;
		}
	},
};
</script>

<style lang="stylus" scoped src="./Venda.styl"></style>
