<template lang="pug">
	section#pageEmpreendimentosListagem
		div.buscar.inputGroup
			httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista", v-on:keyup.enter="searchLista")._60
			httSelect._20(sPlaceholder="Abordagem", :sOptions="abordagens", sTrack="id", sLabel="nome", :sValue.sync="filtro.abordagem", @remove="searchSelect('abordado')", @change="searchSelect('abordado', $event)", :empty="true")
		
		div.buttons.flex
			router-link(:to="{'name': 'empreendimentos-add'}")
				httButton(v-if="$root.hasPermission('empreendimentos-comerciais', 2)", buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/adicionar_branco.svg')", buttonText="Adicionar")
			httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
				buttonText="Download Relatorio", @click="$root.createDownload('empreendimentos', parameters)", :buttonDisabled="$root.downloading != null")
		
		div.tabelaListagem
			div.row(v-for="empreendimento, index in lista", :key="empreendimento.id")
				httTableColumn(titulo="Identificador")
					p {{ empreendimento.id }}
				httTableColumn(titulo="Nome")
					p {{ empreendimento.nome }}
				httTableColumn(titulo="Cliente")
					p {{ empreendimento.cliente.nome }}
				httTableColumn(titulo="CEP")
					p {{ empreendimento.cep }}
				httTableColumn(titulo="Endereço")
					p {{ `${empreendimento.logradouro}, ${empreendimento.numero}`  }}
				httTableColumn(titulo="Cidade")
					p {{ empreendimento.cidade.nome }}
				httTableColumn(titulo="UF")
					p {{ empreendimento.uf.uf }}
				httTableColumn.inputGroup.actions
					httCheckAtivo(nomeCheckbox="Ativo", :checkboxValue.sync="empreendimento.ativo", @change="toggleAtivo(index, idNumerico(empreendimento.id))", :disabledCheckbox="!($root.hasPermission('empreendimentos-comerciais', 2) && $root.hasPermission('empreendimentos-comerciais', 3))")._35
					router-link(:to="{ name: 'empreendimentos-edit', params: { id: idNumerico(empreendimento.id) } }")
						httButton(buttonType='button', :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')", buttonText="Edit", tooltip="Editar Empredimento")

		httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httCheckAtivo from "@/vue/components/httCheckAtivo/HttCheckAtivo.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";

import Listagem from "@/vue/mixins/Listagem";

export default {
	mixins: [Listagem],
	components: {
		httButton,
		httInput,
		httTableColumn,
		httSelect,
		httCheckAtivo,
		httPaginacao,
	},
	data() {
		return {
			modalUpload: false,
			abordagens: [
				{
					id: true,
					nome: "Abordado"
				},
				{
					id: false,
					nome: "Não abordado"
				}
			],
			filtro: {
				abordagem: null
			}
		}
	},
	mounted() {
		let page = 1;
		this.routeName = "empreendimentos";
		if (localStorage.getItem(`lista-${this.routeName}`))
			page = JSON.parse(localStorage.getItem(`lista-${this.routeName}`))
				.page;

		if (this.$route.query.parametroBusca) {
			this.filtro.abordagem = this.abordagens.find(abordagem => this.$route.query.value == abordagem.id)
			this.searchSelect(this.$route.query.parametroBusca, this.filtro.abordagem);
		}
		else {
			this.loadLista(page);
		}
	},
	methods: {
		toggleAtivo(index, id) {
			this.$axios.get(`${this.routeName}/${id}/ativo`);
		},
		idNumerico(empreendimentoId) {
			let reg = new RegExp(/\d+/, "gi");
			return reg.exec(empreendimentoId)[0];
		},
		abrirModalUpload(){
			this.modalUpload = true
		}
	}
};
</script>

<style lang="stylus" scoped src="./EmpreendimentosListagem.styl"></style>
