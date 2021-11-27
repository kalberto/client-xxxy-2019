<template lang="pug">
    section#pageDashboard
        h2 Dashboard
        div.cards
            HttDashboardCard(:link-card="{name: 'predios-lista', query: { parametroBusca: 'abordado', value: 1 }}", nome-card="Prédios Abordados", :img-card="require('../../../assets/images/web/icones/iconesLaranja/predios_laranja.svg')", :valor-card="cards.predio_abordados")
            HttDashboardCard(:link-card="{name: 'predios-lista', query: { parametroBusca: 'abordado', value: 0 }}", nome-card="Prédios Não Abordados", :img-card="require('../../../assets/images/web/icones/iconesLaranja/predios_nao_abordados_laranja.svg')", :valor-card="cards.predio_n_abordados")
            HttDashboardCard(:link-card="{name: 'clientes-lista'}", nome-card="Clientes", :img-card="require('../../../assets/images/web/icones/iconesLaranja/clientes_laranja.svg')", :valor-card="cards.clientes")
            HttDashboardCard(:link-card="{name: 'prospeccoes-lista'}", nome-card="Prospecções", :img-card="require('../../../assets/images/web/icones/iconesLaranja/prospeccao_laranja.svg')", :valor-card="cards.prospeccoes")
            HttDashboardCard(:link-card="{name: 'prospeccoes-lista', query: { parametroBusca: 'status', value: 'P' }}", nome-card="Prospecções perdidas", :img-card="require('../../../assets/images/web/icones/iconesLaranja/prospeccoes_perdidas_laranja.svg')", :valor-card="cards.prospeccoes_perdidas")
            HttDashboardCard(:link-card="{name: 'auditorias-lista'}", nome-card="Auditorias", :img-card="require('../../../assets/images/web/icones/iconesLaranja/auditoria_laranja.svg')", :valor-card="cards.auditorias")
            HttDashboardCard(:link-card="{name: 'vendas-lista', query: { parametroBusca: 'status', value: 'F' }}", nome-card="Vendas Aprovadas", :img-card="require('../../../assets/images/web/icones/iconesLaranja/vendas_aprovadas_laranja.svg')", :valor-card="cards.vendas_aprovadas")
            HttDashboardCard(:link-card="{name: 'vendas-lista', query: { parametroBusca: 'status', value: 'C' }}", nome-card="Vendas Perdidas", :img-card="require('../../../assets/images/web/icones/iconesLaranja/vendas_perdidas_laranja.svg')", :valor-card="cards.vendas_perdidas")
            HttDashboardCard(:link-card="{name: 'empreendimentos-lista'}", nome-card="Empreendimentos", :img-card="require('../../../assets/images/web/icones/iconesLaranja/predios_laranja.svg')", :valor-card="cards.empreendimentos")
</template>

<script>
import HttDashboardCard from "../../components/httDashboardCard/HttDashboardCard";

export default {
	components: {
		HttDashboardCard
	},
	created() {
		this.loadContent()
	},
	data() {
		return {
			cards: {
				predio_abordados: 0,
				predio_n_abordados: 0,
				clientes: 0,
				prospeccoes: 0,
				prospeccoes_perdidas: 0,
				auditorias: 0,
				vendas_aprovadas: 0,
				vendas_perdidas: 0,
				empreendimentos: 0
			}
		};
	},
	methods: {
		loadContent() {
			this.$axios
				.get(`dashboard`)
				.then(response => this.cards = response.data)
		}
	},
};
</script>

<style lang="stylus" scoped src="./Dashboard.styl"></style>
