export default {
	data() {
		return {
			produtos: {
				"0800": null,
				cloudbackup: null,
				pacotes: null,
				smartbox: null,
			},
			produtoSelecionado: {
				"0800": null,
				cloudbackup: null,
				pacotes: null,
				smartbox: null,
			},
			produtoConteudo: {
				"0800": {
					config: {
						numero_0800: null,
						numero_encaminhamento: null,
						portado: null,
						operadora_doadora: null,
						valor: null,
						desconto: null,
						is_percent: false,
						quantidade_ciclos: null
					}
				},
				cloudbackup: {
					config: {
						email: null,
						valor: null,
						desconto: null,
						is_percent: false,
						quantidade_ciclos: null
					}
				},
				pacotes: {
					config: {
						internet: {
							valor: null,
							desconto: null,
							is_percent: false,
							quantidade_ciclos: null
						},
						voz: {
							valor: null,
							desconto: null,
							is_percent: false,
							quantidade_ciclos: null,
							tecnologia: '',
							tecnologia_sinalizacao: null,
							quantidade_linhas: null,
							faixa_numeracao: {
								identificacao:'',
                                lista_numeros: [],
        						piloto:null,
							}
						}
					}
				},
				smartbox: {
					config: {
						quantidade_ramais: null,
						valor: null,
						desconto: null,
						is_percent: false,
						quantidade_ciclos: null
					}
				}
			},
			hideSmartBox:false,
			maxNumberFaixa:5,
		}
	},
	computed: {
		valorTotalPacote: function () {
			if (!this.produtoConteudo.pacotes.config.internet.valor)
				return '';

			if (this.produtoConteudo.pacotes.config.internet.desconto) {
				return this.produtoConteudo.pacotes.config.internet.is_percent ?
					`${this.produtoConteudo.pacotes.config.internet.valor * (100 - this.produtoConteudo.pacotes.config.internet.desconto)/100}` :
					`${this.calculateValorTotal(this.produtoConteudo.pacotes.config.internet.valor,this.produtoConteudo.pacotes.config.internet.desconto)}`
			} else {
				return `${this.produtoConteudo.pacotes.config.internet.valor}`
			}
		},
		valorTotalVoz: function () {
			if (!this.produtoConteudo.pacotes.config.voz.valor)
				return '';

			if (this.produtoConteudo.pacotes.config.voz.desconto) {
				return this.produtoConteudo.pacotes.config.voz.is_percent ?
					`${this.produtoConteudo.pacotes.config.voz.valor * (100 - this.produtoConteudo.pacotes.config.voz.desconto)/100}` :
					`${this.calculateValorTotal(this.produtoConteudo.pacotes.config.voz.valor, this.produtoConteudo.pacotes.config.voz.desconto)}`;
			} else {
				return `${this.produtoConteudo.pacotes.config.voz.valor}`
			}
		},
		valorTotalCloud: function () {
			if (!this.produtoConteudo.cloudbackup.config.valor)
				return '';

			if (this.produtoConteudo.cloudbackup.config.desconto) {
				return this.produtoConteudo.cloudbackup.config.is_percent ?
					`${this.produtoConteudo.cloudbackup.config.valor * (100 - this.produtoConteudo.cloudbackup.config.desconto)/100}` :
					`${this.calculateValorTotal(this.produtoConteudo.cloudbackup.config.valor, this.produtoConteudo.cloudbackup.config.desconto)}`;
			} else {
				return `${this.produtoConteudo.cloudbackup.config.valor}`
			}
		},
		valorTotal0800: function () {
			if (!this.produtoConteudo['0800'].config.valor)
				return '';

			if (this.produtoConteudo['0800'].config.desconto) {
				return this.produtoConteudo['0800'].config.is_percent ?
					`${this.produtoConteudo['0800'].config.valor * (100 - this.produtoConteudo['0800'].config.desconto)/100}` :
					`${this.calculateValorTotal(this.produtoConteudo['0800'].config.valor, this.produtoConteudo['0800'].config.desconto)}`;
			} else {
				return `${this.produtoConteudo['0800'].config.valor}`
			}
		},
		valorTotalSmartbox: function () {
			if (!this.produtoConteudo.smartbox.config.valor && !this.produtoConteudo.smartbox.config.quantidade_ramais)
				return '';
			let tempValor = this.produtoConteudo.smartbox.config.quantidade_ramais * this.produtoConteudo.smartbox.config.valor;
			if (this.produtoConteudo.smartbox.config.desconto) {
				return this.produtoConteudo.smartbox.config.is_percent ?
					`${tempValor * (100 - this.produtoConteudo.smartbox.config.desconto)/100}` :
					`${this.calculateValorTotal(tempValor, this.produtoConteudo.smartbox.config.desconto)}`;
			} else {
				return `${tempValor}`
			}
		}
	},
	watch:{
		'produtoConteudo.pacotes.config.voz.tecnologia' : function (val) {
			if(val !== 'SIP'){
				this.produtoConteudo.smartbox = {
					config: {
						quantidade_ramais: null,
						valor: null,
						desconto: null,
						is_percent: false,
						quantidade_ciclos: null
					}
				};
				this.produtoSelecionado.smartbox = null;
				this.hideSmartBox = true;
			}else{
				this.hideSmartBox = false;
			}
			if(val === 'Analógica'){
				this.maxNumberFaixa = 2;
				if(this.produtoConteudo.pacotes.config.voz.tecnologia.length > 2){
					this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.splice(2,);
				}
			}
			else{
				this.maxNumberFaixa = 5;
			}
		}
	},
	methods: {
		calculateValorTotal : function (valor,desconto) {
			return ((valor * 100 - desconto * 100) / 100).toFixed(2)
		},
		syncProdutosLoad() {
			if (this.venda.produtos.pacotes) {
				// console.log(this.produtoConteudo.pacotes.config.voz, this.venda.produtos.pacotes.config.voz)
				this.produtoSelecionado.pacotes = this.produtos.pacotes.find(produto => produto.produto_id == this.venda.produtos.pacotes.produto_id);
				this.produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao = Object.assign(this.produtoConteudo.pacotes.config.voz.faixa_numeracao.identificacao, this.venda.produtos.pacotes.config.voz.faixa_numeracao.identificacao);
				this.produtoConteudo.pacotes.config.voz.faixa_numeracao = Object.assign(this.produtoConteudo.pacotes.config.voz.faixa_numeracao, this.venda.produtos.pacotes.config.voz.faixa_numeracao);
				this.produtoConteudo.pacotes.config.voz = Object.assign(this.produtoConteudo.pacotes.config.voz, this.venda.produtos.pacotes.config.voz);
				this.produtoConteudo.pacotes.config = Object.assign(this.produtoConteudo.pacotes.config, this.venda.produtos.pacotes.config);
				this.produtoConteudo.pacotes = Object.assign(this.produtoConteudo.pacotes, this.venda.produtos.pacotes);
			}

			if (this.venda.produtos["0800"]) {
				this.produtoSelecionado["0800"] = this.produtos["0800"].find(produto => produto.produto_id == this.venda.produtos["0800"].produto_id);
				this.produtoConteudo["0800"].config = Object.assign(this.produtoConteudo["0800"].config, this.venda.produtos["0800"].config);
				this.produtoConteudo["0800"] = Object.assign(this.produtoConteudo["0800"], this.venda.produtos["0800"]);
			}

			if (this.venda.produtos.cloudbackup) {
				this.produtoSelecionado.cloudbackup = this.produtos.cloudbackup.find(produto => produto.produto_id == this.venda.produtos.cloudbackup.produto_id);
				this.produtoConteudo.cloudbackup.config = Object.assign(this.produtoConteudo.cloudbackup.config, this.venda.produtos.cloudbackup.config);
				this.produtoConteudo.cloudbackup = Object.assign(this.produtoConteudo.cloudbackup, this.venda.produtos.cloudbackup);
			}

			if (this.venda.produtos.smartbox) {
				this.produtoSelecionado.smartbox = this.produtos.smartbox.find(produto => produto.produto_id == this.venda.produtos.smartbox.produto_id);
				this.produtoConteudo.smartbox.config = Object.assign(this.produtoConteudo.smartbox.config, this.venda.produtos.smartbox.config);
				this.produtoConteudo.smartbox = Object.assign(this.produtoConteudo.smartbox, this.venda.produtos.smartbox);
			}

			this.venda.produtos = {};
		},
		syncProdutosSend() {
			if (this.produtoSelecionado.pacotes)
				this.venda.produtos.pacotes = Object.assign({}, this.produtoSelecionado.pacotes, this.produtoConteudo.pacotes);

			if (this.produtoSelecionado["0800"])
				this.venda.produtos["0800"] = Object.assign({}, this.produtoSelecionado["0800"], this.produtoConteudo["0800"]);

			if (this.produtoSelecionado.cloudbackup)
				this.venda.produtos.cloudbackup = Object.assign({}, this.produtoSelecionado.cloudbackup, this.produtoConteudo.cloudbackup);

			if (this.produtoSelecionado.smartbox)
				this.venda.produtos.smartbox = Object.assign({}, this.produtoSelecionado.smartbox, this.produtoConteudo.smartbox);
		},
		createFaixa() {
			this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.push({})
		},
		removeFaixa(index) {
			this.produtoConteudo.pacotes.config.voz.faixa_numeracao.lista_numeros.splice(index, 1)
		},
		loadProdutos() {
			return this.$axios
				.get(`produtos/tipos`)
				.then(response => {
					response.data.forEach((element) => {
						this.produtos[element.slug] = element.produtos
					})
				})
		},
	},
}
