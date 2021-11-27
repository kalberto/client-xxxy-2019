<template lang="pug">
    div.paginacao.flex
        div.total
            p Exibindo {{ inicioLista }} a {{ finalLista }} de {{ totalLista }} registros

        div.paginas
            button(type="button", :disabled="primeira", @click="$emit('togglePage', 'first')") &laquo;
            button(type="button", :disabled="primeira", @click="$emit('togglePage', 'previous')") &lsaquo;
            span.numeroPagina {{ pagina }}
            button(type="button", :disabled="ultima", @click="$emit('togglePage', 'next')") &rsaquo;
            button(type="button", :disabled="ultima", @click="$emit('togglePage', 'last')") &raquo;
</template>

<script>
export default {
	props: {},
	data() {
		return {
			inicioLista: 1,
			finalLista: 1,
			totalLista: 1,
			pagina: 1,
			paginaUltima: 1,
			ultima: false,
			primeira: false
		};
	},
	methods: {
		setPaginacao(response, listName = "lista") {
			this.pagina = response.data.registros.current_page;
			this.paginaUltima = response.data.registros.last_page;
			this.inicioLista = response.data.registros.from;
			this.finalLista = response.data.registros.to;
			this.totalLista = response.data.registros.total;
			if (this.pagina < this.paginaUltima) this.ultima = false;
			else this.ultima = true;

			if (this.pagina > 1) this.primeira = false;
			else this.primeira = true;

			let tempo = new Date()

			localStorage.setItem(
				listName,
				JSON.stringify({ 
					page: this.pagina,
					time: tempo.setHours(tempo.getHours() + 3),
				})
			);
		},
		doPaginacao($event, callback) {
			switch ($event) {
				case "first":
					callback(1);
					break;
				case "previous":
					if (this.pagina > 1) callback(this.pagina - 1);
					else callback(1);
					break;
				case "next":
					if (this.pagina < this.paginaUltima)
						callback(this.pagina + 1);
					else callback(this.paginaUltima);
					break;
				case "last":
					callback(this.paginaUltima);
					break;
				default:
					callback(1);
			}
		}
	}
};
</script>

<style lang="stylus" scoped src="./HttPaginacao.styl"></style>
