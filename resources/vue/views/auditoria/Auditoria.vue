<template lang="pug">
	section#pageAuditoria
		httMensagem(ref="mensagem")
		form(v-on:submit.prevent="sendForm", autocomplete="off")
			div.fieldset(v-if="venda")
				h3 Venda - {{venda.codigo}}
			div.fieldset(v-if="cliente")
				h3 Cliente
				div.campo._50
					p
						strong Documento:
					p
						| {{cliente.documento}}
				div.campo._50
					p
						strong Inscricão Estadual:
					p
						| {{cliente.inscricao_estadual}}
				div.campo._50
					p
						strong Endereço:
					p(v-if="cliente.endereco")
						| {{cliente.endereco.logradouro}}, {{cliente.endereco.numero}} - {{cliente.endereco.bairro}}
						| {{cliente.endereco.complemento ? `- ${cliente.endereco.complemento}` : ''}}
						br
						| {{cliente.endereco.cep}} - {{cliente.endereco.cidade.nome}} - {{cliente.endereco.uf.uf}}
				div.campo._50
					p
						strong Consultor de Venda:
					p
						| {{auditoria.consultor}}
				div.campo._50
					p
						strong Data da Venda:
					p
						| {{ formatDate(venda.created_at) }}
			div.fieldset(v-if="venda && venda.contato_comercial")
				h3 Contato Comercial
				div.campo._50
					p
						strong Nome:
					p
						| {{venda.contato_comercial.nome}}
				div.campo._50
					p
						strong Email:
					p
						| {{venda.contato_comercial.email}}
				div.campo._50
					p
						strong Telefone:
					p
						| {{venda.contato_comercial.telefone}}
				div.campo._50
					p
						strong Celular:
					p
						| {{venda.contato_comercial.celular}}
			div.fieldset(v-if="predio")
				h3 {{ predio.is_empreendimento ? 'Empreendimento' : 'Prédio'}}
				div.campo._50
					p
						strong Identificador:
					p
						| {{predio.id}}
				div.campo._50
					p
						strong Nome:
					p
						| {{predio.nome}}
				div.campo._50
					p
						strong Consultor {{ predio.is_empreendimento ? 'Empreendimento' : 'Prédio'}}:
					p
						| {{predio.consultor.consultor}}
				div.campo._50
					p
						strong Gerente {{ predio.is_empreendimento ? 'Empreendimento' : 'Prédio'}}:
					p
						| {{predio.consultor.gerente}}

			div.fieldset(v-if="venda && cliente")
				h3 Endereço de Instalação
				div.campo._70
					p
						strong Logradouro:
					p
						| {{venda.endereco_predio.logradouro}}
				div.campo._30
					p
						strong Número:
					p
						| {{venda.endereco_predio.numero}}
				div.campo._60
					p
						strong Complemento:
					p
						| {{venda.predio_cliente_complemento}}
				div.campo._40
					p
						strong Bairro:
					p
						| {{venda.endereco_predio.bairro}}
				div.campo._50
					p
						strong Cidade:
					p
						| {{venda.endereco_predio.cidade.nome}}
				div.campo._10
					p
						strong UF:
					p
						| {{venda.endereco_predio.cidade.uf}}
				div.campo._30
					p
						strong CEP:
					p
						| {{venda.endereco_predio.cep}}

			div.fieldset(v-if="venda")
				h3 Produtos
				div.campo._30(v-if="venda.campanha")
					p
						strong Campanha:
					p
						| {{venda.campanha}}
				div.campo._70(v-if="venda.campanha_nome")
					p
						strong Nome da Campanha:
					p
						| {{venda.campanha_nome}}
				div.fieldset(v-if="venda.produtos.pacotes")
					h4 Internet
					div.campo._50
						p
							strong Plano de Internet:
						p
							| {{venda.produtos.pacotes.nome}}
					div.campo._50
						p
							strong Valor:
						p
							| {{venda.produtos.pacotes.config.internet.valor}}
					div.campo._50
						p
							strong Desconto:
						p
							| {{venda.produtos.pacotes.config.internet.desconto ? venda.produtos.pacotes.config.internet.desconto : 'Não se aplica'}}
					div.campo._50
						p
							strong Recorrência do desconto:
						p
							| {{venda.produtos.pacotes.config.internet.quantidade_ciclos}}
					div.campo._100
						p
							strong Valor Total:
						p
							| {{valorTotalPacote}}
				div.fieldset(v-if="venda.produtos.pacotes")
					h4 Voz
					div.campo._50
						p
							strong Plano de Voz:
						p
							| xxxx Voz Fast
					div.campo._50
						p
							strong Consumo Mínimo de Voz:
						p
							| {{venda.produtos.pacotes.config.voz.valor}}
					div.campo._50
						p
							strong Desconto:
						p
							| {{venda.produtos.pacotes.config.voz.desconto ? venda.produtos.pacotes.config.voz.desconto : 'Não se aplica'}}
					div.campo._50
						p
							strong Recorrência do desconto:
						p
							| {{venda.produtos.pacotes.config.voz.quantidade_ciclos}}
					div.campo._100
						p
							strong Valor Total:
						p
							| {{valorTotalVoz}}
					div.campo._50
						p
							strong Tecnologia de Voz:
						p
							| {{venda.produtos.pacotes.config.voz.tecnologia}}
							| {{venda.produtos.pacotes.config.voz.tecnologia_sinalizacao ? `- ${venda.produtos.pacotes.config.voz.tecnologia_sinalizacao}` : ''}}
					div.campo._50
						p
							strong Quantidade de linhas:
						p
							| {{venda.produtos.pacotes.config.voz.quantidade_linhas}}
					div.campo._50(v-if="venda.produtos.pacotes.config.voz.tecnologia == 'SIP' || venda.produtos.pacotes.config.voz.tecnologia == 'Digital'")
						p
							strong Identificação:
						p
							| {{venda.produtos.pacotes.config.voz.faixa_numeracao.identificacao}}
					div.campo._50(v-else)
						p
							strong Identificação:
						p
							|Não se Aplica
					div.campo._50(v-if="venda.produtos.pacotes.config.voz.tecnologia == 'SIP' || venda.produtos.pacotes.config.voz.tecnologia == 'Digital'")
						p
							strong Piloto:
						p
							| {{venda.produtos.pacotes.config.voz.faixa_numeracao.piloto}}
					div.campo._50(v-else)
						p
							strong Piloto:
						p
							|Não se Aplica
					div.campo.faixas._100
						p.faixa
							strong Faixas de numeração:
						p(v-for="listaNumeros in venda.produtos.pacotes.config.voz.faixa_numeracao.lista_numeros")
							strong Inicial:
							|{{listaNumeros.inicial}}
							|-
							strong Final:
							|{{listaNumeros.final}} |
							strong Portado:
							|{{listaNumeros.portado == "sim" ? `${listaNumeros.portado} | ` : listaNumeros.portado}}
							strong(v-if='listaNumeros.portado == "sim"') Operadora Doadora:
							|{{listaNumeros.portado == "sim" ? listaNumeros.operadora_doadora : ''}}
				div.fieldset(v-if="venda.produtos.cloudbackup")
					h4 Cloudbackup
					div.campo._50
						p
							strong Tipo Backup:
						p
							| {{venda.produtos.cloudbackup.nome}}
					div.campo._50
						p
							strong E-mail login:
						p
							| {{venda.produtos.cloudbackup.config.email}}
					div.campo._50
						p
							strong Valor:
						p
							| {{venda.produtos.cloudbackup.config.valor}}
					div.campo._50
						p
							strong Desconto:
						p
							| {{venda.produtos.cloudbackup.config.desconto ? venda.produtos.cloudbackup.config.desconto : 'Não se aplica'}}
					div.campo._50
						p
							strong Recorrência do desconto:
						p
							| {{venda.produtos.cloudbackup.config.quantidade_ciclos}}
					div.campo._100
						p
							strong Valor Total:
						p
							| {{valorTotalCloud}}
				div.fieldset(v-else)
					h4 Cloudbackup
					div.campo._50
						p Não se Aplica
				div.fieldset(v-if="venda.produtos['0800']")
					h4 0800
					div.campo._50
						p
							strong Número do 0800:
						p
							| {{venda.produtos['0800'].config.numero_0800}}
					div.campo._50
						p
							strong Número Encaminhamento:
						p
							| {{venda.produtos['0800'].config.numero_encaminhamento}}
					div.campo._50
						p
							strong Portado:
						p
							| {{venda.produtos['0800'].config.portado}}
					div.campo._50(v-if="venda.produtos['0800'].config.portado == 'sim'")
						p
							strong Operadora Doadora:
						p
							| {{venda.produtos['0800'].config.operadora_doadora}}
					div.campo._50
						p
							strong Valor:
						p
							| {{venda.produtos['0800'].config.valor}}
					div.campo._50
						p
							strong Desconto:
						p
							| {{venda.produtos['0800'].config.desconto ? venda.produtos['0800'].config.desconto : 'Não se aplica'}}
					div.campo._50
						p
							strong Recorrência do desconto:
						p
							| {{venda.produtos['0800'].config.quantidade_ciclos}}
					div.campo._100
						p
							strong Valor Total:
						p
							| {{valorTotal0800}}
				div.fieldset(v-else)
					h4 0800
					div.campo._50
						p Não se Aplica
				div.fieldset(v-if="venda.produtos.smartbox")
					h4 SmartBox
					div.campo._50
						p
							strong Qtd de Ramais:
						p
							| {{venda.produtos.smartbox.config.quantidade_ramais}}
					div.campo._50
						p
							strong Valor por Ramal:
						p
							| {{venda.produtos.smartbox.config.valor}}
					div.campo._50
						p
							strong Desconto:
						p
							| {{venda.produtos.smartbox.config.desconto ? venda.produtos.smartbox.config.desconto : 'Não se aplica'}}
					div.campo._50
						p
							strong Recorrência do desconto:
						p
							| {{venda.produtos.smartbox.config.quantidade_ciclos}}
					div.campo._100
						p
							strong Valor Total:
						p
							| {{valorTotalSmartbox}}
				div.fieldset(v-else)
					h4 Smartbox
					div.campo._50
						p Não se Aplica

			div.fieldset(v-if="venda")
				h3 Faturamento
				div.campo._50
					p
						strong Vencimento:
					p
						| {{venda.vencimento}}
				div.campo._50
					p
						strong E-mail Fatura:
					p
						| {{venda.email_fatura}}
				div.campo._50
					p
						strong Endereço:
					p(v-if="venda.endereco_correspondencia")
						| {{venda.endereco_correspondencia.logradouro}}, {{venda.endereco_correspondencia.numero}} - {{venda.endereco_correspondencia.complemento}} - {{venda.endereco_correspondencia.bairro}}
						br
						| {{venda.endereco_correspondencia.cep}} - {{venda.endereco_correspondencia.cidade.nome}} - {{venda.endereco_correspondencia.uf.uf}}
			div.fieldset(v-if="venda")
				h3 Contratada
				div.campo._50
					p
						strong Razão Social
					p
						| {{venda.contratada.nome}}
				div.campo._50
					p
						strong CNPJ
					p
						| {{venda.contratada_filial.cnpj}}
				div.campo._50
					p
						strong Endereço:
					p(v-if="venda.endereco_correspondencia")
						| {{venda.contratada_filial.endereco.logradouro}}, {{venda.contratada_filial.endereco.numero}}
						|{{venda.contratada_filial.endereco.complemento ? `- ${venda.contratada_filial.endereco.complemento} - ` : '-'}}
						|{{venda.contratada_filial.endereco.bairro}}
						br
						| {{venda.contratada_filial.endereco.cep}} - {{venda.contratada_filial.nome}}
			div.fieldset(v-if="auditoria")
				div.campo._50
					p
						strong Status Auditoria
					p
						| {{auditoria.status_nome}}
				div.campo.text._100
					p.faixa
						strong Observações:
					textarea(placeholder='Observações' v-model='auditoria.observacoes', :disabled="!canSave")

			div.fieldset(v-if="auditoria")
				div.auditoriaTipo.flex
					div.previous(v-if="auditoria.previous")
						router-link(:to="{ name: 'auditorias-edit', params: { id: auditoria.previous.id } }")
							div.bolinha
							p {{auditoria.previous.tipo_nome}}
					div.atual
						div.bolinha
						p {{auditoria.tipo_nome}}
					div.last(v-if="auditoria.last")
						router-link(:to="{ name: 'auditorias-edit', params: { id: auditoria.last.id } }")
							div.bolinha
							p {{auditoria.last.tipo_nome}}

			div.fieldset(v-if="venda && venda.documentos.length > 0")
				h4._100.totalWidth Download Arquivos
				div.arquivos.flex
					div.arquivo(v-for="documento, index in venda.documentos", @click="downloadArquivo(documento.nome)")
						img(:src="require('@/assets/images/web/icones/iconesBranco/file.svg')")
						p {{documento.nome}}

			div.fieldset
				httButton(v-if="$root.hasPermission('auditorias', 3)" buttonType='button', buttonText="Reprovar", @click="sendAuditoria('nogo')", , :buttonDisabled="(auditoria && auditoria.status != 'E') || !canSave", :button-icon="require('@/assets/images/web/icones/iconesBranco/aprovar_branco.svg')")
				httButton(v-if="$root.hasPermission('auditorias', 3)" buttonType='button', buttonText="Aprovar", @click="sendAuditoria('go')", :buttonDisabled="(auditoria && auditoria.status != 'E') || !canSave", :button-icon="require('@/assets/images/web/icones/iconesBranco/save_branco.svg')")
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
			auditoria: null,
			venda: null,
			cliente: null,
			predio: null,
			btnDisabled: false,
			canSave:true,
		}
	},
	created() {
		this.loadContent()
			.then(() => this.loadVenda())
			.then(() => this.loadCliente())
			.then(() => this.loadPredios())
	},
	computed: {
		valorTotalPacote: function () {
			if (!this.venda.produtos.pacotes.config.internet.valor)
				return '';

			if (this.venda.produtos.pacotes.config.internet.desconto) {
				return this.venda.produtos.pacotes.config.internet.is_percent ?
					`${this.venda.produtos.pacotes.config.internet.valor * (100 - this.venda.produtos.pacotes.config.internet.desconto)/100}` :
					`${this.calculateValorTotal(this.venda.produtos.pacotes.config.internet.valor, this.venda.produtos.pacotes.config.internet.desconto)}`
			} else {
				return `${this.venda.produtos.pacotes.config.internet.valor}`
			}
		},
		valorTotalVoz: function () {
			if (!this.venda.produtos.pacotes.config.voz.valor)
				return '';

			if (this.venda.produtos.pacotes.config.voz.valor) {
				return this.venda.produtos.pacotes.config.voz.is_percent ?
					`${this.venda.produtos.pacotes.config.voz.valor * (100 - this.venda.produtos.pacotes.config.voz.desconto)/100}` :
					`${this.calculateValorTotal(this.venda.produtos.pacotes.config.voz.valor,this.venda.produtos.pacotes.config.voz.desconto)}`;
			} else {
				return `${this.venda.produtos.pacotes.config.voz.valor}`
			}
		},
		valorTotalCloud: function () {
			if (!this.venda.produtos.cloudbackup.config.valor)
				return '';

			if (this.venda.produtos.cloudbackup.config.desconto) {
				return this.venda.produtos.cloudbackup.config.is_percent ?
					`${this.venda.produtos.cloudbackup.config.valor * (100 - this.venda.produtos.cloudbackup.config.desconto)/100}` :
					`${this.calculateValorTotal(this.venda.produtos.cloudbackup.config.valor,this.venda.produtos.cloudbackup.config.desconto)}`;
			} else {
				return `${this.venda.produtos.cloudbackup.config.valor}`
			}
		},
		valorTotal0800: function () {
			if (!this.venda.produtos['0800'].config.valor)
				return '';

			if (this.venda.produtos['0800'].config.desconto) {
				return this.venda.produtos['0800'].config.is_percent ?
					`${this.venda.produtos['0800'].config.valor * (100 - this.venda.produtos['0800'].config.desconto)/100}` :
					`${this.calculateValorTotal(this.venda.produtos['0800'].config.valor, this.venda.produtos['0800'].config.desconto)}`;
			} else {
				return `${this.venda.produtos['0800'].config.valor}`
			}
		},
		valorTotalSmartbox: function () {
			if (!this.venda.produtos.smartbox.config.valor && !this.venda.produtos.smartbox.config.quantidade_ramais)
				return '';
			let tempValor = this.venda.produtos.smartbox.config.quantidade_ramais * this.venda.produtos.smartbox.config.valor;
			if (this.venda.produtos.smartbox.config.desconto) {
				return this.venda.produtos.smartbox.config.is_percent ?
					`${tempValor * (100 - this.venda.produtos.smartbox.config.desconto)/100}` :
					`${this.calculateValorTotal(tempValor, this.venda.produtos.smartbox.config.desconto)}`;
			} else {
				return `${tempValor}`
			}
		}
	},
	watch: {
		'$route.params.id': function(){
			this.loadContent()
				.then(() => this.loadVenda())
				.then(() => this.loadCliente())
				.then(() => this.loadPredios())
				.then(() => {
					document.querySelector('.content').scrollTo(0, 0);
				})
		}
	},
	methods: {
		calculateValorTotal : function (valor,desconto) {
			return ((valor * 100 - desconto * 100) / 100).toFixed(2);
		},
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
					a.href = URL.createObjectURL( blob);
					a.download = name;
					a.click()
                })
		},
		loadVenda() {
			return this.$axios
				.get(`vendas/${this.auditoria.codigo}`)
				.then(response => {
					this.venda = response.data;
				})
		},
		loadCliente() {
			return this.$axios
				.get(`clientes/${this.venda.cliente.documento}`)
				.then(response => {
					this.cliente = response.data;
				})
		},
		loadPredios(){
			return this.$axios
				.get(`clientes/${this.venda.cliente.documento}/${this.venda.is_empreendimento ? 'empreendimentos' : 'predios'}/${this.venda.predio_id}`)
				.then(response => {
					this.predio = response.data;
				})
		},
		loadContent() {
			return this.$axios
				.get(`auditorias/${this.$route.params.id}`)
				.then(response => {
					this.auditoria = response.data;
				})
		},
		idNumerico(predioId) {
			let reg = new RegExp(/\d+/, "gi");
			return reg.exec(predioId)[0];
		},
		sendAuditoria(route){
			this.btnDisabled = true;
			this.canSave = false;
			this.$axios
				.post(`auditorias/${this.auditoria.id}/${route}`, this.auditoria)
				.then(response => {
					setTimeout(()=>{
						window.location.reload(true);
					},1500);
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showSucesso(response.data.msg)
				}).catch(error => {
					this.$refs.mensagem.toTop();
					this.$refs.mensagem.showErro(error.response.data.msg);
					if(error.response.status == 422) {
						this.errors = error.response.data.error_validate;
					}
				}).finally(() => {
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

<style lang="stylus" scoped src="./Auditoria.styl"></style>
