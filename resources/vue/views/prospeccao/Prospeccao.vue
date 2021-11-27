<template lang="pug">
	section#pageClienteForm
		httMensagem(ref="mensagem")
		form(v-on:submit.prevent="sendForm", autocomplete="off")
			div.fieldset
				span Prédio
				httCheckAtivo(nomeCheckbox="", :checkboxValue.sync="prospeccao.is_empreendimento", :disabledCheckbox="($route.params.id ? true : false) || !canSave")._10
				span Empreendimento
			div.fieldset
				httSelect(sPlaceholder="Selecione um cliente", :disabled="($route.params.id ? true : false) || !canSave", :sOptions="clientes", sLabel="nome", sTrack="documento", :sValue.sync="cliente", :multiple='false', :selectMessage="getError('cliente_documento')", :class="{ 'error': existError('cliente_documento') }")._50
				httSelect(v-if="!prospeccao.is_empreendimento " sPlaceholder="Selecione um prédio", :disabled="($route.params.id ? true : false) || !canSave", :sOptions="predios", sLabel="nome", sTrack="predio_id", :sValue.sync="predio", :multiple='false', :selectMessage="getError('predio_id')", :class="{ 'error': existError('predio_id') }")._50
				httSelect(v-if="prospeccao.is_empreendimento " sPlaceholder="Selecione um Empreendimento", :disabled="($route.params.id ? true : false) || !canSave", :sOptions="empreendimentos", sLabel="nome", sTrack="predio_id", :sValue.sync="empreendimento", :multiple='false', :selectMessage="getError('predio_id')", :class="{ 'error': existError('predio_id') }")._50
				httInput(inputName="data_contato", :inputMask="'##-##-####'" inputLabel="Data Contato", inputType="text", :inputValue.sync="prospeccao.data_contato", :inputMessage="getError('data_contato')", :class="{ 'error': existError('data_contato') }", @blur="limparErroCampo('data_contato')", :inputDisabled="!canSave")._50
				httSelect(sPlaceholder="Selecione um status", :sOptions="status", sLabel="nome", sTrack="id", :sValue.sync="statusId", :multiple='false', :selectMessage="getError('status')", :class="{ 'error': existError('status') }", :disabled="!canSave")._50
				div.fieldset.verifyCliente._100.totalWidth(v-if="(cliente && cliente.documento && statusId && statusId.id == 'V')", :class="{ 'error': existError('cliente.data_verificacao') || existError('cliente.status') }", style="margin-bottom:15px")
					span.message(v-if="existError('cliente.data_verificacao')") {{ getError('cliente.data_verificacao') }}
					span.message(v-if="!existError('cliente.data_verificacao') && existError('cliente.status')") {{ getError('cliente.status') }}
					httButton(buttonType='button', buttonText="Verificar Cliente", @click="verifyCliente()", :buttonDisabled="clienteVerificacao.disabled", :button-icon="require('@/assets/images/web/icones/iconesBranco/aprovar_branco.svg')")
					div
						p
							strong Status do cliente:
							| {{ clienteVerificacao.mensagem }}
				textarea(placeholder='Observações' v-model='prospeccao.observacoes', :disabled="!canSave")
			
			div.fieldset(v-if="statusId && statusId.id == 'N'")
				h3._100 Status de Negociação
				httSelect(sPlaceholder="Selecione um status de Negociação", :sOptions="statusNegociacao", sLabel="nome", sTrack="id", :sValue.sync="statusNegociacaoId", :multiple='false', :selectMessage="getError('status_negociacao')", :class="{ 'error': existError('status_negociacao') }", :empty="true", :disabled="!canSave")._50
			div.fieldset(v-if="statusId && statusId.id == 'P'")
				h3._100 Motivos
				httSelect(sPlaceholder="Selecione um motivo", :sOptions="motivosVendaPerdida", sLabel="motivo", sTrack="id", :sValue.sync="vendaPerdidaId", :multiple='false', :selectMessage="getError('venda_perdida')", :class="{ 'error': existError('venda_perdida') }", :disabled="!canSave")._50
				httInput(v-if="vendaPerdidaId && vendaPerdidaId.motivo == 'Outros'", inputName="comentario", inputLabel="Comentário", inputType="text", :inputValue.sync="vendaPerdidaId.comentario", :inputMessage="getError('venda_perdida.comentario')", :class="{ 'error': existError('venda_perdida.comentario') }", @blur="limparErroCampo('venda_perdida.comentario')", :inputDisabled="!canSave")._50

			div.fieldset(v-if="statusId && statusId.id != 'C' && statusId.id != 'P'")
				h3._100 Itens
				httSelect(sPlaceholder="Selecione um Pacote", :sOptions="produtos.pacotes", sLabel="nome", sTrack="produto_id", :sValue.sync="pacotes", :multiple='false', :empty="true", :selectMessage="getError('produtos.pacotes')", :class="{ 'error': existError('produtos.pacotes') }", :disabled="!canSave")._50
				httSelect(sPlaceholder="Selecione um Cloudbackup", :sOptions="produtos.cloudbackup", sLabel="nome", sTrack="produto_id", :sValue.sync="cloudbackup", :multiple='false', :empty="true", :selectMessage="getError('produtos.cloudbackup')", :class="{ 'error': existError('produtos.cloudbackup') }", :disabled="!canSave")._50
				httSelect(sPlaceholder="Selecione um Smartbox", :sOptions="produtos.smartbox", sLabel="nome", sTrack="produto_id", :sValue.sync="smartbox", :multiple='false', :empty="true", :selectMessage="getError('produtos.smartbox')", :class="{ 'error': existError('produtos.smartbox') }", :disabled="!canSave")._50
				httSelect(sPlaceholder="Selecione um 0800", :sOptions="produtos['0800']", sLabel="nome", sTrack="produto_id", :sValue.sync="$data['0800']", :multiple='false', :empty="true", :selectMessage="getError('produtos.0800')", :class="{ 'error': existError('produtos.0800') }", :disabled="!canSave")._50

			div.fieldset
				httButton(v-if="$root.hasPermission('prospeccoes', 3) || $root.hasPermission('prospeccoes', 2)" buttonType='button', buttonText="Salvar Prospecção", @click="sendForm", :buttonDisabled="btnDisabled || !canSave", :button-icon="require('@/assets/images/web/icones/iconesBranco/save_branco.svg')")
</template>

<script>
import axios from 'axios';

import httButton from '@/vue/components/httButton/HttButton.vue'
import httInput from '@/vue/components/httInput/HttInput.vue'
import httSelect from '@/vue/components/httSelect/HttSelect.vue'
import httCheckAtivo from '@/vue/components/httCheckAtivo/HttCheckAtivo.vue'
import httTableColumn from '@/vue/components/httTableColumn/HttTableColumn.vue'
import httMensagem from '@/vue/components/httMensagem/HttMensagem.vue'

import Localizacao from '@/vue/mixins/Localizacao';
import Validacao from '@/vue/mixins/Validacao';
import Format from '@/vue/mixins/Format'

export default {
	mixins: [
		Localizacao,
		Validacao,
		Format
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
			btnDisabled: false,
			canSave:true,
			prospeccao: {
				predio_id: "",
				data_contato: "",
				observacoes: "",
				produtos: {},
				venda_perdida: {},
				cliente_documento: "",
				is_empreendimento :false,
			},
			clienteVerificacao: {
				mensagem: "Pendente de verificação",
				disabled: false
			},
			produtos: {
				pacotes: [],
				cloudbackup: [],
				smartbox: [],
				"0800": [],
			},
			cliente: null,
			clientes:[],
			predio: null,
			predios: [],
			empreendimento:null,
			empreendimentos:[],
			status: [],
			statusId: null,
			statusNegociacao: [],
			statusNegociacaoId: null,
			motivosVendaPerdida: [],
			vendaPerdidaId: null,
			pacotes: null,
			cloudbackup: null,
			smartbox: null,
			"0800": null,
		}
	},
	created() {
		axios.all([this.loadProdutos(), this.loadClientes(), this.loadStatus(), this.loadStatusNegociacao(), this.loadMotivosVendaPerdida()])
			.then(() => this.$route.params.id ? this.loadContent().then(() => Promise.resolve(true)) : Promise.resolve(false))
			.then(hasContent => {
				if (hasContent) Promise.resolve()
				this.configureProspeccao();
			})
	},
	watch: {
		'cliente': function(oldValue, newValue){
			if(oldValue != newValue){
				this.predio = null;
				this.empreendimento = null;
				this.loadPredios(this.cliente.documento).then(() => {
					if(this.prospeccao.predio_id)
						this.predio = this.predios.find((element) => element.predio_id == this.prospeccao.predio_id)
				});
				this.loadEmpreendimentos(this.cliente.documento).then(() => {
					if(this.prospeccao.predio_id)
						this.empreendimento = this.empreendimentos.find((element) => element.predio_id == this.prospeccao.predio_id)
				});
				this.clienteVerificacao.mensagem = "Pendente de verificação";
				this.clienteVerificacao.disabled = false;
			}
		},
		'is_empreendimento' : function () {
			this.predio = null;
			this.empreendimento = null;
		}
	},
	methods: {
		configureProspeccao() {
			if(this.prospeccao.cliente_documento)
				this.cliente = this.clientes.find((element) => element.documento == this.prospeccao.cliente_documento)

			if(this.prospeccao.status)
				this.statusId = this.status.find((element) => element.id == this.prospeccao.status)	

			if(this.prospeccao.status_negociacao)
				this.statusNegociacaoId = this.statusNegociacao.find((element) => element.id == this.prospeccao.status_negociacao)

			if (this.prospeccao.venda_perdida && this.prospeccao.venda_perdida.id)
				this.vendaPerdidaId = this.prospeccao.venda_perdida;

			if(this.prospeccao.produtos){
				this.pacotes = this.prospeccao.produtos.pacotes || null
				this.cloudbackup = this.prospeccao.produtos.cloudbackup || null
				this.smartbox = this.prospeccao.produtos.smartbox || null
				this.$data['0800'] = this.prospeccao.produtos['0800'] || null
				this.prospeccao.produtos = {};
			}

			if (this.prospeccao.status == "V" || this.prospeccao.status == "P") {
				this.$refs.mensagem.showAviso('Esta prospecção não pode ser alterada!')
				this.btnDisabled = true;
			}
		},
		loadMotivosVendaPerdida() {
			return this.$axios
				.get(`prospeccoes/venda-perdida/motivos`)
				.then(response => {
					this.motivosVendaPerdida = response.data;
				})
		},
		loadClientes() {
			return this.$axios
				.get(`clientes/select`)
				.then(response => {
					this.clientes = response.data;
				})
		},
		loadPredios(documento) {
			return this.$axios
				.get(`clientes/${documento}/predios`)
				.then(response => {
					this.predios = response.data;
				});
		},
		loadEmpreendimentos(documento){
			return this.$axios
				.get(`clientes/${documento}/empreendimentos`)
				.then(response => {
					this.empreendimentos = response.data;
				});
		},
		loadProdutos() {
			return this.$axios
				.get(`produtos/tipos`)
				.then(response => {
					response.data.forEach((element) => {
						this.produtos[element.slug] = element.produtos
					})
				})
		},
		loadStatus() {
			return this.$axios
				.get(`prospeccoes/status`)
				.then(response => {
					this.status = response.data;
				})
		},
		loadStatusNegociacao() {
			return this.$axios
				.get(`prospeccoes/status-negociacao`)
				.then(response => {
					this.statusNegociacao = response.data;
				})
		},
		loadContent() {
			return this.$axios
				.get(`prospeccoes/${this.$route.params.id}`)
				.then(response => {
					this.prospeccao = response.data;
				})
		},
		idNumerico(predioId) {
			let reg = new RegExp(/\d+/, "gi");
			return reg.exec(predioId)[0];
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
				.get(`clientes/${this.cliente.documento}/verify`)
				.then(response => {
					if (response.data.approved)
						this.configureStatusCliente('A');
					else
						this.configureStatusCliente('R');
				})
				.catch(error => {
					this.clienteVerificacao.disabled = false
					if (error.response.data.success != undefined)
						this.clienteVerificacao.mensagem = "Ocorreu um erro ao validar";
					else
						this.clienteVerificacao.mensagem = error.response.data.msg;
				});
		},
		sendForm() {
			let id = this.$route.params.id || null;
			if (this.cliente)
				this.prospeccao.cliente_documento = this.cliente.documento;

			if(this.prospeccao.is_empreendimento){
				if (this.empreendimento)
					this.prospeccao.predio_id = this.empreendimento.predio_id;
			}else{
				if (this.predio)
					this.prospeccao.predio_id = this.predio.predio_id;
			}

			if (this.vendaPerdidaId)
				this.prospeccao.venda_perdida = this.vendaPerdidaId;

			if (this.statusId) {
				this.prospeccao.status = this.statusId.id;
				if (this.statusId.id == "N" && this.statusNegociacaoId)
					this.prospeccao.status_negociacao = this.statusNegociacaoId.id
			}

			if (this.pacotes)
				this.prospeccao.produtos.pacotes = this.pacotes

			if (this.cloudbackup)
				this.prospeccao.produtos.cloudbackup = this.cloudbackup

			if (this.smartbox)
				this.prospeccao.produtos.smartbox = this.smartbox

			if (this.$data['0800'])
				this.prospeccao.produtos['0800'] = this.$data['0800']

			this.btnDisabled = true;
			this.canSave = false;
			this.$axios
				.post(`prospeccoes${ id ? '/' + id : '' }`, this.prospeccao)
				.then(response => {
					if (!this.$route.params.id) {
						setTimeout(() => {
							this.$router.push({name:"prospeccoes-edit",params: { id: response.data.codigo }});
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
					if(error.response.status == 422) 
						if(error.response.data.error_validate) {
							this.errors = error.response.data.error_validate;
							this.$refs.mensagem.showErro();
						} else {
							this.$refs.mensagem.showErro(error.response.data.msg)
						}
					else
						this.$refs.mensagem.showErro();
				})
				.finally(() => {
					this.btnDisabled = false;
					setTimeout(() => {
						this.canSave = true;
						this.$refs.mensagem.hide();
					}, 3500);
				})
		},
	},
};
</script>

<style lang="stylus" scoped src="./Prospeccao.styl"></style>
