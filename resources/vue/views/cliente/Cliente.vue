<template lang="pug">
	section#pageClienteForm
		httMensagem(ref="mensagem")
		form(v-on:submit.prevent="sendForm", autocomplete="off")
			div.fieldset
				httInput(@blur="limparErroCampo('documento')", inputName="documento", inputLabel="Documento", inputType="text", :inputValue.sync="cliente.documento", :inputMessage="getError('documento')", :class="{ 'error': existError('documento') }", :inputDisabled="($route.params.id ? true : false) || !canSave", :inputMask="btnDisabled ? ['###########', '##############'] : ['###.###.###-##', '##.###.###/####-##']")._25
				httInput(@blur="limparErroCampo('inscricao_estadual')", inputName="inscricao_estadual", inputLabel="Inscrição Estadual", inputType="text", :inputValue.sync="cliente.inscricao_estadual", :inputMessage="getError('inscricao_estadual')", :class="{ 'error': existError('inscricao_estadual') }", :inputDisabled="!canSave")._25
				httInput(@blur="limparErroCampo('nome')", inputName="nome", inputLabel="Nome", inputType="text", :inputValue.sync="cliente.nome", :inputMessage="getError('nome')", :class="{ 'error': existError('nome') }", :inputDisabled="!canSave")._50
			
			div.fieldset
				h3 Prédios
				httSelect(sPlaceholder="Selecione um ou mais prédios" :sOptions="predios", sLabel="nome", sTrack="predio_id", :sValue.sync="cliente.predios", :multiple='true', :selectMessage="getError('predios')", :class="{ 'error': existError('predios') }", :disabled="!canSave")._100
			
			div.fieldset
				h3 Endereço do Cliente
				httInput(@blur="limparErroCampo('endereco.logradouro')", inputName="logradouro", inputLabel="Logradouro", inputType="text", :inputValue.sync="cliente.endereco.logradouro", :inputMessage="getError('endereco.logradouro')", :class="{ 'error': existError('endereco.logradouro') }", :inputDisabled="!canSave")._30
				httInput(@blur="limparErroCampo('endereco.numero')", inputName="numero", inputLabel="Número", inputType="tel", :inputValue.sync="cliente.endereco.numero", :inputMessage="getError('endereco.numero')", :class="{ 'error': existError('endereco.numero') }", :inputMask="'########'", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('endereco.complemento')", inputName="complemento", inputLabel="Complemento", inputType="text", :inputValue.sync="cliente.endereco.complemento", :inputMessage="getError('endereco.complemento')", :class="{ 'error': existError('endereco.complemento') }", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('endereco.bairro')", inputName="bairro", inputLabel="Bairro", inputType="text", :inputValue.sync="cliente.endereco.bairro", :inputMessage="getError('endereco.bairro')", :class="{ 'error': existError('endereco.bairro') }", :inputDisabled="!canSave")._30

				httInput(@blur="limparErroCampo('endereco.cep')", inputName="cep", inputLabel="CEP", inputType="tel", :inputValue.sync="cliente.endereco.cep", :inputMessage="getError('endereco.cep')", :class="{ 'error': existError('endereco.cep') }" :inputMask="btnDisabled ? '########' : '##.###-###'", :inputDisabled="!canSave")._20
				httSelect(sPlaceholder="Selecione um Estado" :sOptions="ufs", sLabel="uf", sTrack="uf", :sValue.sync="cliente.endereco.uf", :selectMessage="getError('endereco.uf.uf')", :class="{ 'error': existError('endereco.uf.uf') }", :disabled="!canSave")._30
				httSelect(sPlaceholder="Selecione uma Cidade" :sOptions="cidades", sLabel="nome", sTrack="nome", :sValue.sync="cliente.endereco.cidade", :selectMessage="getError('endereco.cidade.id')", :class="{ 'error': existError('endereco.cidade.id') }", :disabled="!canSave")._35
			
			div.fieldset.novoContato
				h3._50 Contatos do Cliente
				httButton(buttonType='button', buttonText="Adicionar novo contato", @click="createContato()")._50
				div.tabelaListagem
					div.row(v-for="pessoa, index in cliente.contato", :key="`${pessoa.email}-${index}`", :class="{ 'error': existErrorContatos(`contato.${index}`) }")
						httTableColumn(titulo="Nome")
							p {{ pessoa.nome }}
						httTableColumn(titulo="E-mail")
							p {{ pessoa.email }}
						httTableColumn(titulo="Telefones")
							p {{ `${pessoa.telefone} | ${pessoa.celular}` }}
						httTableColumn.actions
							httButton(buttonType='button', buttonText="Edit", @click="createContato(index)")
							httButton(buttonType='button', buttonText="Delete", @click="deleteContato(index)")
						span.errorMessage(:class="{ 'ativo': existErrorContatos(`contato.${index}`) }", v-html="getErrorContatos(`contato.${index}`)")
				div.form(v-if="formContato.ativo")
					h3._100 {{ formContato.title }}
					httInput(inputName="contatoNome", inputLabel="Nome", inputType="text", :inputValue.sync="contato.nome", :inputMessage="getError('contato.'+formContato.index+'.nome')", :class="{ 'error': existError('contato.'+formContato.index+'.nome') }", :inputDisabled="!canSave")._100
					httInput(inputName="contatoTelefone", inputLabel="Telefone", inputType="tel", :inputValue.sync="contato.telefone" :inputMask="btnDisabled ? '##########' : '(##) ####-####'", :inputMessage="getError('contato.'+formContato.index+'.telefone')", :class="{ 'error': existError('contato.'+formContato.index+'.telefone') }", :inputDisabled="!canSave")._25
					httInput(inputName="contatoCelular", inputLabel="Celular", inputType="tel", :inputValue.sync="contato.celular"  :inputMask="btnDisabled ? '###########' : '(##) #####-####'", :inputMessage="getError('contato.'+formContato.index+'.celular')", :class="{ 'error': existError('contato.'+formContato.index+'.celular') }", :inputDisabled="!canSave")._25
					httInput(inputName="contatoEmail", inputLabel="Email", inputType="text", :inputValue.sync="contato.email", :inputMessage="getError('contato.'+formContato.index+'.email')", :class="{ 'error': existError('contato.'+formContato.index+'.email') }", :inputDisabled="!canSave")._50
					httButton(buttonType='button', buttonText="Salvar contato", @click="saveContato")._50

			div.fieldset
				httButton(v-if="$root.hasPermission('clientes', 3) || $root.hasPermission('clientes', 2)" buttonType='button', buttonText="Salvar Cliente", @click="sendForm", :buttonDisabled="btnDisabled || !canSave")
</template>

<script>
import httButton from '@/vue/components/httButton/HttButton.vue'
import httInput from '@/vue/components/httInput/HttInput.vue'
import httSelect from '@/vue/components/httSelect/HttSelect.vue'
import httCheckAtivo from '@/vue/components/httCheckAtivo/HttCheckAtivo.vue'
import httTableColumn from '@/vue/components/httTableColumn/HttTableColumn.vue'
import httMensagem from '@/vue/components/httMensagem/HttMensagem.vue'

import Localizacao from '@/vue/mixins/Localizacao';
import Validacao from '@/vue/mixins/Validacao';

export default {
	mixins: [
		Localizacao,
		Validacao
	],
	components: {
		httButton,
		httInput,
		httSelect,
		httCheckAtivo,
		httTableColumn,
		httMensagem
	},
	data() {
		return {
			cliente: {
				contato: [],
				id: '',
				nome: '',
				documento: '',
				inscricao_estadual: '',
				endereco: {},
			},
			contato: {
				nome: '',
				telefone: '',
				celular: '',
				email: ''
			},
			formContato: {
				ativo: false,
				index: null,
				title: ""
			},
			btnDisabled: false,
			canSave:true,
			predios: [],
		}
	},
	created() {
		if (this.$route.params.id) {
			this.loadContent();
		}
		this.loadPredios();
	},
	watch: {
		'cliente.endereco.uf': function() {
			this.loadCidades(this.cliente.endereco.uf)
		},
		'cliente.predios': function () {
			if(this.cliente.predios.length > 0 && this.cliente.predios[this.cliente.predios.length - 1].endereco)
				this.cliente.endereco = this.cliente.predios[this.cliente.predios.length - 1].endereco;
			/*if(this.cliente.endereco)
				this.cliente.endereco.complemento = ''*/
		}
	},
	methods: {
		loadPredios() {
			this.$axios
				.get(`predios/select`)
				.then(response => {
					this.predios = response.data;
				})
		},
		loadContent() {
			this.$axios
				.get(`clientes/${this.$route.params.id}`)
				.then(response => {
					this.cliente = response.data;
				})
				.catch(error => {
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showErro(error.response.data.msg);
				});
		},
		createContato(index = null) {
			this.formContato.ativo = true;
			if (index != null) {
				this.contato = {
					nome: this.cliente.contato[index].nome,
					telefone: this.cliente.contato[index].telefone,
					celular: this.cliente.contato[index].celular,
					email: this.cliente.contato[index].email
				}
				this.formContato.index = index;
				this.formContato.title = "Editar contato"
			} else {
				this.contato = {
					nome: '',
					telefone: '',
					celular: '',
					email: ''
				}
				this.formContato.index = null;
				this.formContato.title = "Novo contato"
			}

			setTimeout(() => {
				document.querySelector('.content').scrollTo(0, document.querySelector('.pageModule').scrollHeight);
			}, 250)
		},
		deleteContato(index) {
			if (this.cliente.contato[index])
				this.cliente.contato.splice(index, 1);
		},
		saveContato() {
			let contato = {
					nome: this.contato.nome,
					email: this.contato.email,
					telefone: this.contato.telefone.replace(/\D/gi, ''),
					celular: this.contato.celular.replace(/\D/gi, ''),
				}
			if (this.formContato.index != null)
				this.cliente.contato[this.formContato.index] = contato;
			else
				this.cliente.contato.push(contato);
			this.formContato.ativo = false;
		},
		sendForm() {
			let id = null;
			if (this.$route.params.id) {
				id = this.$route.params.id;
			}

			this.btnDisabled = true;
			this.canSave = false;
			this.$axios
				.post(`clientes${ id ? '/' + id : '' }`, this.cliente)
				.then(response => {
					if (!this.$route.params.id) {
						setTimeout(() => {
							this.$router.push({name:"clientes-edit",params: { id: response.data.documento }});
							setTimeout(()=>{
								window.location.reload(true);
							},1500);
						},1000);
					}
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showSucesso(response.data.msg);
				})
				.catch(error => {
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showErro(error.response.data.msg);
					if(error.response.status == 422) {
						this.errors = error.response.data.error_validate;
					}
				})
				.finally(() => {
					this.btnDisabled = false;
					setTimeout(() => {
						this.canSave = true;
						this.$refs.mensagem.hide();
					}, 3500);
				})
		}
	},
};
</script>

<style lang="stylus" scoped src="./Cliente.styl"></style>
