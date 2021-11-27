<template lang="pug">
    section#pageProspeccoesListagem
        div.buscar.inputGroup
            httInput(inputName="search", inputLabel="Busca", inputType="search", :inputValue.sync="parameters.q", @doSearch="searchLista" v-on:keyup.enter="searchLista")._60
            httSelect._20(sPlaceholder="Status", :sOptions="status", sTrack="id", sLabel="nome", :sValue.sync="filtro.status", @remove="searchSelect('status')", @change="searchSelect('status', $event)", :empty="true")
            date-picker(v-model="datas" type="date" format="DD-MM-YYYY", lang="pt", range, clear, confirm, placeholder="Selecione a data", @change="selectPerData()")
        
        div.buttons.flex
            router-link(v-if="$root.hasPermission('clientes', 2)" :to="{'name': 'prospeccoes-add'}") 
                httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/adicionar_branco.svg')", buttonText="Adicionar")
            httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
                buttonText="Download Relatorio", @click="$root.createDownload('prospeccoes', parameters)", :buttonDisabled="$root.downloading != null")
        
        div.tabelaListagem
            div.row(v-for="prospeccao, index in lista", :key="prospeccao.codigo")
                httTableColumn(titulo="Identificador")
                    p {{ prospeccao.codigo }}
                httTableColumn(titulo="Nome Cliente")
                    p {{ prospeccao.cliente_nome }}
                httTableColumn(titulo="Status")
                    p {{ prospeccao.status_nome }}
                httTableColumn(titulo="Data de criação")
                    p {{ formatDate(prospeccao.created_at) }}
                httTableColumn(titulo="Usuário")
                    p {{ prospeccao.usuario }}
                httTableColumn.inputGroup.actions
                    httButton(@click="criarVenda(prospeccao.codigo)", :buttonDisabled="prospeccao.status != 'V' || prospeccao.has_venda" buttonType='button', buttonText="Venda" :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/vendas_aprovadas_branco.svg')")
                    router-link(:to="{ name: 'prospeccoes-edit', params: { id: prospeccao.codigo } }")
                        httButton(buttonType='button', buttonText="Edit" :buttonAction='true', :button-icon="require('@/assets/images/web/icones/iconesBranco/edit_branco.svg')")

        httPaginacao(ref="pagination", @togglePage="$refs.pagination.doPaginacao($event, loadLista)")
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";
import httInput from "@/vue/components/httInput/HttInput.vue";
import httSelect from "@/vue/components/httSelect/HttSelect.vue";
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";
import httPaginacao from "@/vue/components/httPaginacao/HttPaginacao.vue";

import DatePicker from 'vue2-datepicker'

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
            status: [
                {
                    "id": "C",
                    "nome": "Contato"
                },
                {
                    "id": "N",
                    "nome": "Negociação"
                },
                {
                    "id": "V",
                    "nome": "Venda concluída"
                },
                {
                    "id": "P",
                    "nome": "Venda perdida"
                }
            ],
            filtro: {
                status: null
            }
        }
    },
	mounted() {
		let page = 1;
		this.routeName = "prospeccoes";
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
        criarVenda(codigo) {
            this.$axios
                .post(`vendas/${codigo}/converter`)
                .then(response => {
                    this.$router.push({ name: 'vendas-edit', params: { id: codigo } })
                })
        }
    },
};
</script>

<style lang="stylus" scoped src="./ProspeccoesListagem.styl"></style>
