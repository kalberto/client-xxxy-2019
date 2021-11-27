<template lang="pug">
	section#pagePrediosListagem
		div.buscar.inputGroup
			httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista", v-on:keyup.enter="searchLista")._60
			httSelect._20(sPlaceholder="Abordagem", :sOptions="abordagens", sTrack="id", sLabel="nome", :sValue.sync="filtro.abordagem", @remove="searchSelect('abordado')", @change="searchSelect('abordado', $event)", :empty="true")
		
		div.buttons.flex
			router-link(:to="{'name': 'predios-add'}") 
				httButton(v-if="$root.hasPermission('predios', 2)", buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/adicionar_branco.svg')", buttonText="Adicionar")
			httButton(v-if="$root.hasPermission('predios', 4)", buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/upload_branco.svg')", 
				buttonText="Importar Planilha",  @click="abrirModalUpload()")
			httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
				buttonText="Download Relatorio", @click="$root.createDownload('predios', parameters)", :buttonDisabled="$root.downloading != null")
		
		div.tabelaListagem
			div.row(v-for="predio, index in lista", :key="predio.id")
				httTableColumn(titulo="Identificador")
					p {{ predio.id }}
				httTableColumn(titulo="Nome")
					p {{ predio.nome }}
				httTableColumn(titulo="CEP")
					p {{ predio.cep }}
				httTableColumn(titulo="Endereço")
					p {{ `${predio.logradouro}, ${predio.numero}`  }}
				httTableColumn(titulo="Cidade")
					p {{ predio.cidade.nome }}
				httTableColumn(titulo="UF")
					p {{ predio.uf.uf }}
				httTableColumn.inputGroup.actions
					httCheckAtivo(nomeCheckbox="Ativo", :checkboxValue.sync="predio.ativo", @change="toggleAtivo(index, idNumerico(predio.id))", :disabledCheckbox="!($root.hasPermission('predios', 2) && $root.hasPermission('predios', 3))")._35
					router-link(:to="{ name: 'predios-edit', params: { id: idNumerico(predio.id) } }")
						httButton(buttonType='button', :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')", buttonText="Edit", tooltip="Editar prédio")

		httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
		transition(name="modalFade")
			httModalImport(v-if="modalUpload", :ativoImport.sync="modalUpload",ref="modalUpload", route="predios")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httCheckAtivo from "@/vue/components/httCheckAtivo/HttCheckAtivo.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";
import httModalImport from '@/vue/components/httModalImport/HttModalImport.vue';

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
		httModalImport
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
		this.routeName = "predios";
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
		idNumerico(predioId) {
			let reg = new RegExp(/\d+/, "gi");
			return reg.exec(predioId)[0];
		},
		abrirModalUpload(){
			this.modalUpload = true
		}
	}
};
</script>

<style lang="stylus" scoped src="./PrediosListagem.styl"></style>
