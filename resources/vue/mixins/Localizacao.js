export default {
	data() {
		return {
			ufs: [],
			cidades: []
		}
	},
	created() {
		this.loadUfs();
	},
	methods: {
		loadUfs() {
			this.$axios
				.get(`localizacao/ufs`)
				.then(response => {
					this.ufs = response.data;
				})
		},
		loadCidades(uf, objetoCidade = null) {
			return this.$axios
				.get(`localizacao/ufs/${uf.uf}/cidades`)
				.then(response => {
					if(objetoCidade){
						return response.data;
					} else {
						this.cidades = response.data
					}
				})
		}
	},
}
