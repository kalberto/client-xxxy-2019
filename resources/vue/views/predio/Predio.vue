<template lang="pug">
	section#pagePredioForm
		httMensagem(ref="mensagem")
		form(v-on:submit.prevent="sendForm", autocomplete="off")
			div.fieldset
				httInput(inputName="identificador", inputLabel="Código identificador", inputType="text", :inputValue.sync="predio.id", :inputDisabled="true")._30
				httInput(@blur="limparErroCampo('nome')", inputName="nome", inputLabel="Nome do Prédio", inputType="text", :inputValue.sync="predio.nome", :inputMessage="getError('nome')", :class="{ 'error': existError('nome') }", :inputDisabled="!canSave")._60
				httCheckAtivo(nomeCheckbox="Prédio ativo", :checkboxValue.sync="predio.ativo", :disabledCheckbox="!($root.hasPermission('predios', 2) && $root.hasPermission('predios', 3))")._10

			div.fieldset
				h3 Consultores
				httSelect(@blur="limparErroCampo('consultores')" sPlaceholder="Selecione um ou mais consultores" :sOptions="consultores", sLabel="consultor", sTrack="consultor_id", :sValue.sync="predio.consultores", :multiple='true', :selectMessage="getError('consultores')", :class="{ 'error': existError('consultores') }", :empty="true", :disabled="!canSave")._100
				httInput(v-if="predio.consultores" inputName="gerentes", inputLabel="Gerentes", inputType="text", :inputValue.sync="gerentes", :inputDisabled="true")._100

			div.fieldset
				h3 Localização
				httInput(@blur="limparErroCampo('logradouro')", inputName="logradouro", inputLabel="Logradouro", inputType="text", :inputValue.sync="predio.logradouro", :inputMessage="getError('logradouro')", :class="{ 'error': existError('logradouro') }", :inputDisabled="!canSave")._30
				httInput(@blur="limparErroCampo('numero')", inputName="numero", inputLabel="Número", inputType="tel", :inputValue.sync="predio.numero", :inputMessage="getError('numero')", :class="{ 'error': existError('numero') }", :inputMask="'#######'", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('complemento')", inputName="complemento", inputLabel="Complemento", inputType="text", :inputValue.sync="predio.complemento", :inputMessage="getError('complemento')", :class="{ 'error': existError('complemento') }", :inputDisabled="!canSave")._20
				httInput(@blur="limparErroCampo('bairro')", inputName="bairro", inputLabel="Bairro", inputType="text", :inputValue.sync="predio.bairro", :inputMessage="getError('bairro')", :class="{ 'error': existError('bairro') }", :inputDisabled="!canSave")._30

				httInput(@blur="limparErroCampo('cep')", inputName="cep", inputLabel="CEP", inputType="tel", :inputValue.sync="predio.cep", :inputMessage="getError('cep')", :class="{ 'error': existError('cep') }" :inputMask="btnDisabled ? '########' : '##.###-###'", :inputDisabled="!canSave")._20
				httSelect(sPlaceholder="Selecione um Estado" :sOptions="ufs", sLabel="uf", sTrack="uf", :sValue.sync="predio.uf", :selectMessage="getError('uf.uf')", :class="{ 'error': existError('uf.uf') }", :disabled="!canSave")._30
				httSelect(sPlaceholder="Selecione uma Cidade" :sOptions="cidades", sLabel="nome", sTrack="nome", :sValue.sync="predio.cidade", :selectMessage="getError('cidade.id')", :class="{ 'error': existError('cidade.id') }", :disabled="!canSave")._35
				httCheckAtivo(nomeCheckbox="Prédio abordado", :checkboxValue.sync="predio.abordado", :disabledCheckbox="true")._15

			div.fieldset.novoContato
				h3._50 Contatos do Prédio
				httButton(buttonType='button', buttonText="Adicionar novo contato", @click="createContato()")._50
				div.tabelaListagem
					div.row(v-for="pessoa, index in predio.contato", :key="pessoa.email", :class="{ 'error': existErrorContatos(`contato.${index}`) }")
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
					httInput(inputName="contatoEmail", inputLabel="Email", inputType="text", :inputValue.sync="contato.email", :inputMessage="getError('contato.'+formContato.index+'.nome')", :class="{ 'error': existError('contato.'+formContato.index+'.email') }", :inputDisabled="!canSave")._50
					httInput(inputName="contatoTelefone", inputLabel="Telefone", inputType="tel", :inputValue.sync="contato.telefone" :inputMask="'(##) ####-####'", :inputMessage="getError('contato.'+formContato.index+'.telefone')", :class="{ 'error': existError('contato.'+formContato.index+'.telefone') }", :inputDisabled="!canSave")._25
					httInput(inputName="contatoCelular", inputLabel="Celular", inputType="tel", :inputValue.sync="contato.celular" :inputMask="'(##) #####-####'", :inputMessage="getError('contato.'+formContato.index+'.celular')", :class="{ 'error': existError('contato.'+formContato.index+'.celular') }", :inputDisabled="!canSave")._25
					httButton(buttonType='button', buttonText="Salvar contato", @click="saveContato", :buttonDisabled="btnDisabled")._25

			div.fieldset
				httButton(v-if="$root.hasPermission('predios', 3) || $root.hasPermission('predios', 2)" buttonType='button', buttonText="Salvar Prédio", @click="sendForm", :buttonDisabled="btnDisabled || !canSave")
		
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
			predio: {
				abordado: false,
				ativo: false,
				bairro: '',
				cep: '',
				cidade: null,
				complemento: '',
				consultor: null,
				contato: [],
				logradouro: '',
				nome: '',
				numero: '',
				regional: '',
				uf: null,
                consultores: []
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
			consultores: []
		}
	},
	watch: {
		'predio.uf': function() {
			this.loadCidades(this.predio.uf)
		}
	},
	computed: {
	    'gerentes': function () {
	        let name = "";
	        this.predio.consultores.forEach(function (current,index) {
		       if(index !== 0 )
		           name += ", ";
		       name += current.gerente;
            });
	        return name;
        }
	},
	created() {
		if (this.$route.params.id) {
			this.loadContent();
		}
		this.loadConsultores();
	},
	methods: {
		loadContent() {
			this.$axios
				.get(`predios/${this.$route.params.id}`)
				.then(response => {
					this.predio = response.data;
				})
				.catch(error => {
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showErro(error.response.data.msg);
				});
		},
		loadConsultores(){
			this.$axios
				.get("usuarios/consultores")
				.then(response => {
					this.consultores = response.data;
				})
		},
		createContato(index = null) {
			this.formContato.ativo = true;
			if (index != null) {
				this.contato = {
					nome: this.predio.contato[index].nome,
					telefone: this.predio.contato[index].telefone,
					celular: this.predio.contato[index].celular,
					email: this.predio.contato[index].email
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
			if (this.predio.contato[index])
				this.predio.contato.splice(index, 1);
		},
		saveContato() {
			let contato = {
					nome: this.contato.nome,
					email: this.contato.email,
					telefone: this.contato.telefone.replace(/\D/gi, ''),
					celular: this.contato.celular.replace(/\D/gi, ''),
				}
			if (this.formContato.index != null)
				this.predio.contato[this.formContato.index] = contato;
			else
				this.predio.contato.push(contato);
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
				.post(`predios${ id ? '/' + id : '' }`, this.predio)
				.then(response => {
					if (!this.$route.params.id) {
						setTimeout(() => {
							this.$router.push({name:"predios-edit",params: { id: response.data.id }});
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

<style lang="stylus" scoped src="./Predio.styl"></style>
