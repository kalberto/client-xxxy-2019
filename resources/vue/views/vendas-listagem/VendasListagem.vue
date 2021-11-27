<template lang="pug">
    section#pageVendasListagem
        div.buscar.inputGroup
            httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista", v-on:keyup.enter="searchLista")._60
            httSelect._20(sPlaceholder="Status", :sOptions="status", sTrack="id", sLabel="nome" @remove="searchSelect('status')" @change="searchSelect('status', $event)" :empty="true")
            date-picker(v-model="datas" type="date" format="DD-MM-YYYY", lang="pt", range, clear, confirm, placeholder="Selecione a data", @change="selectPerData()")

        div.buttons.flex
            httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
                buttonText="Download Relatorio", @click="$root.createDownload('vendas', parameters)", :buttonDisabled="$root.downloading != null")
        
        div.tabelaListagem
            div.row(v-for="venda, index in lista", :key="venda.codigo")
                httTableColumn(titulo="Identificador")
                    p {{ venda.codigo }}
                httTableColumn(titulo="Nome Cliente")
                    p {{ venda.cliente_nome }}
                httTableColumn(titulo="Status")
                    p {{ venda.status_nome }}
                httTableColumn(titulo="Data de criação")
                    p {{ formatDate(venda.created_at) }}
                httTableColumn(titulo="Usuário")
                    p {{ venda.usuario }}
                httTableColumn.inputGroup.actions
                    router-link(:to="{ name: 'vendas-edit', params: { id: venda.codigo } }")
                        httButton(buttonType='button', buttonText="Edit", :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')", tooltip="Editar Venda")
                    httButton(@click="auditar(venda.codigo)", :buttonDisabled="venda.status != 'V'" buttonType='button', buttonText="Edit", :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/auditoria_branco.svg')", tooltip="Enviar para auditoria")

        httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";

import DatePicker from 'vue2-datepicker';

import Listagem from "@/vue/mixins/Listagem";

export default {
	mixins: [Listagem],
	components: {
		httButton,
		httInput,
		httTableColumn,
		httSelect,
		httPaginacao,
        DatePicker
	},
    data() {
        return {
            status:[
                {
                    id: 'F', 
                    nome: 'Finalizada'
                },
                {
                    id: 'A',
                    nome: "A corrigir"
                },
                {
                    id: 'E',
                    nome: "Em configuração"
                },   
                {
                    id: 'C', 
                    nome: "Cancelada"
                },
                {
                    id: 'V', 
                    nome: "Validação"
                },
                {
                    id: 'U',  
                    nome: "Auditoria"
                }
            ],
            filtro: {
                status: null
            }
        }
    },
	mounted() {
		let page = 1;
		this.routeName = "vendas";
		if (localStorage.getItem(`lista-${this.routeName}`))
			page = JSON.parse(localStorage.getItem(`lista-${this.routeName}`))
				.page;
		
        if (this.$route.query.parametroBusca) {
			this.filtro.status = this.status.find(status => this.$route.query.value == status.id)
			this.searchSelect(this.$route.query.parametroBusca, this.filtro.status);
		}
		else {
			this.loadLista(page);
		}
	},
    methods: {
        auditar(codigo) {
            this.$axios
                .post(`vendas/${codigo}/auditar`)
                .then(response => {
                    this.$router.push({ name: 'auditorias-lista'})
                })
        }
    },
};
</script>

<style lang="stylus" scoped src="./VendasListagem.styl"></style>
