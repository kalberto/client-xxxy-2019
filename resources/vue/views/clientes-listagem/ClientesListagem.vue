<template lang="pug">
    section#pageClientesListagem
        div.buscar.inputGroup
            httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista", v-on:keyup.enter="searchLista")._60
            httSelect._20(sPlaceholder="Status de verificação", :sOptions="status", sTrack="id", sLabel="nome" @remove="searchSelect('status')" @change="searchSelect('status', $event)" :empty="true")
        
        div.buttons.flex
            router-link(v-if="$root.hasPermission('clientes', 2)", :to="{'name': 'clientes-add'}") 
                httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/adicionar_branco.svg')", buttonText="Adicionar")
            httButton(v-if="$root.hasPermission('clientes', 4)", buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/upload_branco.svg')", 
                buttonText="Importar Planilha", @click="abrirModalUpload()")
            httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
                buttonText="Download Relatorio", @click="$root.createDownload('clientes', parameters)", :buttonDisabled="$root.downloading != null")
        
        div.tabelaListagem
            div.row(v-for="cliente, index in lista", :key="cliente.id")
                httTableColumn(titulo="Nome")
                    p {{ cliente.nome }}
                httTableColumn(titulo="Documento")
                    p {{ cliente.documento }}
                httTableColumn(titulo="Inscrição Estadual")
                    p {{ cliente.inscricao_estadual }}
                httTableColumn(titulo="Prédios")
                    a(href="#verPredios" @click.prevent="verPredios(cliente.documento)") Ver Prédios
                httTableColumn(titulo="Expiração VF")
                    p {{ cliente.data_verificacao ? formatDate(cliente.data_verificacao) : 'Não verificado'}}
                httTableColumn(titulo="Status VF")
                    p {{ cliente.status }}
                httTableColumn.inputGroup.actions
                    router-link(v-if="$root.hasPermission('prospeccoes', 2)", :to="{ name: 'prospeccoes-add' }")
                        httButton(buttonType='button', buttonText="Prosp" :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/prospeccao_branco.svg')", tooltip="Criar Prospecção")
                    router-link(:to="{ name: 'clientes-edit', params: { id: cliente.documento } }")
                        httButton(buttonType='button', buttonText="Edit" :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')", tooltip="Editar Cliente")

        httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
        httModalPredios(:ativo.sync="modalPredios", :predios="predios")
        transition(name="modalFade")
            httModalImport(v-if="modalUpload", :ativoImport.sync="modalUpload", ref="modalUpload", route="clientes")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";
import httModalPredios from '@/vue/components/httModalPredios/HttModalPredios.vue'
import httModalImport from '@/vue/components/httModalImport/HttModalImport.vue'

import Listagem from "@/vue/mixins/Listagem";

export default {
	mixins: [Listagem],
	components: {
		httButton,
		httInput,
		httTableColumn,
		httSelect,
		httPaginacao,
        httModalPredios,
        httModalImport
	},
	mounted() {
		let page = 1;
		this.routeName = "clientes";
        if (localStorage.getItem(`lista-${this.routeName}`) && JSON.parse(localStorage.getItem(`lista-${this.routeName}`)).time > new Date().getTime() )
            page = JSON.parse(localStorage.getItem(`lista-${this.routeName}`))
                .page;
		this.loadLista(page);
	},
    data() {
        return {
            predios: [],
            modalPredios: false,
            modalUpload: false,
            status: [
                {
                    "id": "A",
                    "nome": "Aprovado"
                },
                {
                    "id": "R",
                    "nome": "Reprovado"
                },
                {
                    "id": "N",
                    "nome": "Não verificado"
                },
                {
                    "id": "E",
                    "nome": "Expirado"
                }
            ],
        }
    },
    methods: {
        verPredios(documento){
            this.$axios
				.get(`clientes/${documento}/predios`)
				.then(response => {
					this.predios = response.data;
                    this.modalPredios = true
				})
        },
        abrirModalUpload(){
            this.modalUpload = true
        },
    },
};
</script>

<style lang="stylus" scoped src="./ClientesListagem.styl"></style>
