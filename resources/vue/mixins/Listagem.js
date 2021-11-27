import qs from 'qs';
import Format from './Format'

export default {
	mixins: [Format],
	data() {
		return {
			routeName: '',
			lista: [],
			parameters: {
				q: ''
			},
			datas: [],
		}
	},
	methods: {
		loadLista(page = null) {
			this.$axios
				.get(`${this.routeName}?${page ? "page=" + page + "&": ""}${qs.stringify(this.parameters)}`)
				.then(response => this.loadResponse(response));
		},
		searchLista() {
			this.loadLista();
		},
		searchSelect(parametroBusca = null, event = null) {
			if (event)
				this.parameters[parametroBusca] = event.id;
			else
				delete this.parameters[parametroBusca];

			this.loadLista();
		},
		selectPerData() {
			let datasPT = []
			if(this.datas[0]){
				this.datas.forEach(data => {
					datasPT.push(this.formatDate(data))
				})

				this.parameters.start = datasPT[0]
				this.parameters.end = datasPT[1]
			}else{
				delete this.parameters.start
				delete this.parameters.end
			}

			this.loadLista();
		},
		loadResponse(response) {
			this.lista = response.data.registros.data;
			if (this.$refs.pagination)
				this.$refs.pagination.setPaginacao(response, `lista-${this.routeName}`);
		}
	}
}
