<template lang="pug">
    section#pageAuditoriasListagem
        div.buscar.inputGroup
            httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista", v-on:keyup.enter="searchLista")._60
            httSelect._20(sPlaceholder="Status", :sOptions="status", sTrack="id", sLabel="nome", :sValue="filtro.status", @remove="searchSelect('status')" @change="searchSelect('status', $event)" :empty="true")
            httSelect._20(sPlaceholder="Tipo", :sOptions="tipo", sTrack="id", sLabel="nome" @remove="searchSelect('tipo')" @change="searchSelect('tipo', $event)" :empty="true")
        
        div.buttons.flex
            httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
                buttonText="Download Relatorio", @click="$root.createDownload('auditorias', parameters)", :buttonDisabled="$root.downloading != null")

        div.tabelaListagem
            div.row(v-for="auditoria, index in lista", :key="`${auditoria.codigo}_${auditoria.tipo}_${auditoria.status}_${index}`")
                httTableColumn(titulo="Identificador")
                    p {{ auditoria.codigo }}
                httTableColumn(titulo="Nome do Cliente")
                    p {{ auditoria.cliente_nome }}
                httTableColumn(titulo="Status")
                    p {{ auditoria.status_nome }}
                httTableColumn(titulo="Tipo")
                    p {{ auditoria.tipo_nome }}
                httTableColumn(titulo="Data de criação")
                    p {{ formatDate(auditoria.created_at) }}
                httTableColumn(titulo="Usuário")
                    p {{ auditoria.consultor }}
                httTableColumn.inputGroup.actions
                    router-link(:to="{ name: 'auditorias-edit', params: { id: auditoria.id } }")
                        httButton(buttonType='button', :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')" tooltip="Visualizar")

        httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";

import Listagem from "@/vue/mixins/Listagem";

export default {
	mixins: [Listagem],
    data() {
        return {
            filtro: {
                status: {
                    "id": "E",
                    "nome": "Em auditoria"
                }
            },
            status: [
                {
                    "id": "E",
                    "nome": "Em auditoria"
                },
                {
                    "id": "R",
                    "nome": "Recusada"
                },
                {
                    "id": "A",
                    "nome": "Aprovada"
                },
            ],
            tipo: [
                {
                    "id": "V",
                    "nome": "Validação"
                },
                {
                    "id": "W",
                    "nome": "Welcome Call"
                },
                {
                    "id": "A",
                    "nome": "Auditoria de dados"
                },
            ]
        }
    },
	components: {
		httButton,
		httInput,
		httTableColumn,
		httSelect,
		httPaginacao
	},
	mounted() {
		let page = 1;
		this.routeName = "auditorias";

        this.searchSelect('status', this.filtro.status);
	}
};
</script>

<style lang="stylus" scoped src="./AuditoriasListagem.styl"></style>
