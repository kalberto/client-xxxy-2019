export default function () {
	return {
		mode: 'history',
		base: '',
		routes: [{
				path: '/',
				name: 'dashboard',
				display: 'Dashboard',
				icone: 'icone-dashboard.svg',
				component: () => import( /* webpackChunkName: "js/web/dashboard" */ './views/dashboard/Dashboard.vue')
			},
			{
				path: '/login',
				name: 'login',
				component: () => import( /* webpackChunkName: "js/web/login" */ './views/login/Login.vue')
			},
			{
				path: '/predios',
				name: 'predios',
				display: 'Prédios',
				icone: 'predios.svg',
				component: () => import( /* webpackChunkName: "js/web/predios" */ './views/predios/Predios.vue'),
				children: [{
						path: '',
						name: 'predios-lista',
						component: () => import( /* webpackChunkName: "js/web/predios-listagem" */ './views/predios-listagem/PrediosListagem.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prédios'
								},
								{
									name: 'Listagem de Prédios'
								},
							],
							auth:{
								modulo: "predios",
								permissions: [1],
							}
						}
					}, {
						path: 'adicionar',
						name: 'predios-add',
						component: () => import( /* webpackChunkName: "js/web/predio" */ './views/predio/Predio.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prédios'
								},
								{
									name: 'Listagem de Prédios',
									link: 'predios-lista'
								},
								{
									name: 'Adicionar'
								},
							], auth:{
								modulo: "predios",
								permissions: [2],
							}
						}
					},
					{
						path: 'editar/:id',
						name: 'predios-edit',
						component: () => import( /* webpackChunkName: "js/web/predio" */ './views/predio/Predio.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prédios'
								},
								{
									name: 'Listagem de Prédios',
									link: 'predios-lista'
								},
								{
									name: 'Editar'
								}
							], auth:{
								modulo: "predios",
								permissions: [1,3],
							}
						}
					}
				]
			},
			{
				path: '/clientes',
				name: 'clientes',
				display: 'Clientes',
				icone: 'clientes.svg',
				component: () => import( /* webpackChunkName: "js/web/clientes" */ './views/clientes/Clientes.vue'),
				children: [{
						path: '',
						name: 'clientes-lista',
						component: () => import( /* webpackChunkName: "js/web/clientes-listagem" */ './views/clientes-listagem/ClientesListagem.vue'),
						meta: {
							breadcrumb: [{
									name: 'Clientes'
								},
								{
									name: 'Listagem de Clientes'
								},
							], auth:{
								modulo: "clientes",
								permissions: [1],
							}
						}
					}, {
						path: 'adicionar',
						name: 'clientes-add',
						component: () => import( /* webpackChunkName: "js/web/cliente" */ './views/cliente/Cliente.vue'),
						meta: {
							breadcrumb: [{
									name: 'Clientes'
								},
								{
									name: 'Listagem de Clientes',
									link: 'clientes-lista'
								},
								{
									name: 'Adicionar'
								},
							], auth:{
								modulo: "clientes",
								permissions: [2],
							}
						}
					},
					{
						path: 'editar/:id',
						name: 'clientes-edit',
						component: () => import( /* webpackChunkName: "js/web/cliente" */ './views/cliente/Cliente.vue'),
						meta: {
							breadcrumb: [{
									name: 'Clientes'
								},
								{
									name: 'Listagem de Clientes',
									link: 'clientes-lista'
								},
								{
									name: 'Editar'
								}
							], auth:{
								modulo: "clientes",
								permissions: [1,3],
							}
						}
					}
				]
			},
			{
				path: '/prospeccoes',
				name: 'prospeccoes',
				display: 'Prospecções',
				icone: 'prospeccao.svg',
				component: () => import( /* webpackChunkName: "js/web/prospeccoes" */ './views/prospeccoes/Prospeccoes.vue'),
				children: [{
						path: '',
						name: 'prospeccoes-lista',
						component: () => import( /* webpackChunkName: "js/web/prospeccoes-listagem" */ './views/prospeccoes-listagem/ProspeccoesListagem.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prospecções'
								},
								{
									name: 'Listagem de Prospecções'
								},
							], auth:{
								modulo: "prospeccoes",
								permissions: [1],
							}
						}
					}, {
						path: 'adicionar',
						name: 'prospeccoes-add',
						component: () => import( /* webpackChunkName: "js/web/prospeccao" */ './views/prospeccao/Prospeccao.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prospecções'
								},
								{
									name: 'Listagem de Prospecções',
									link: 'prospeccoes-lista'
								},
								{
									name: 'Adicionar'
								},
							], auth:{
								modulo: "prospeccoes",
								permissions: [2],
							}
						}
					},
					{
						path: 'editar/:id',
						name: 'prospeccoes-edit',
						component: () => import( /* webpackChunkName: "js/web/prospeccao" */ './views/prospeccao/Prospeccao.vue'),
						meta: {
							breadcrumb: [{
									name: 'Prospecções'
								},
								{
									name: 'Listagem de Prospecções',
									link: 'prospeccoes-lista'
								},
								{
									name: 'Editar'
								}
							], auth:{
								modulo: "prospeccoes",
								permissions: [1,3],
							}
						}
					}
				]
			},
			{
				path: '/vendas',
				name: 'vendas',
				display: 'Vendas',
				icone: 'vendas_aprovadas.svg',
				component: () => import( /* webpackChunkName: "js/web/vendas" */ './views/vendas/Vendas.vue'),
				children: [{
						path: '',
						name: 'vendas-lista',
						component: () => import( /* webpackChunkName: "js/web/vendas-listagem" */ './views/vendas-listagem/VendasListagem.vue'),
						meta: {
							breadcrumb: [{
									name: 'Vendas'
								},
								{
									name: 'Listagem de Vendas'
								},
							], auth:{
								modulo: "vendas",
								permissions: [1],
							}
						}
					}, {
						path: 'adicionar',
						name: 'vendas-add',
						component: () => import( /* webpackChunkName: "js/web/venda" */ './views/venda/Venda.vue'),
						meta: {
							breadcrumb: [{
									name: 'Vendas'
								},
								{
									name: 'Listagem de Vendas',
									link: 'vendas-lista'
								},
								{
									name: 'Adicionar'
								},
							], auth:{
								modulo: "prospeccoes",
								permissions: [2],
							}
						}
					},
					{
						path: 'editar/:id',
						name: 'vendas-edit',
						component: () => import( /* webpackChunkName: "js/web/venda" */ './views/venda/Venda.vue'),
						meta: {
							breadcrumb: [{
									name: 'Vendas'
								},
								{
									name: 'Listagem de Vendas',
									link: 'vendas-lista'
								},
								{
									name: 'Editar'
								}
							], auth:{
								modulo: "prospeccoes",
								permissions: [1,3],
							}
						}
					}
				]
			},
			{
				path: '/auditorias',
				name: 'auditorias',
				display: 'Auditorias',
				icone: 'auditoria.svg',
				component: () => import( /* webpackChunkName: "js/web/auditorias" */ './views/auditorias/Auditorias.vue'),
				children: [{
						path: '',
						name: 'auditorias-lista',
						component: () => import( /* webpackChunkName: "js/web/auditorias-listagem" */ './views/auditorias-listagem/AuditoriasListagem.vue'),
						meta: {
							breadcrumb: [{
									name: 'Auditorias'
								},
								{
									name: 'Listagem de Auditorias'
								},
							], auth:{
								modulo: "auditorias",
								permissions: [1],
							}
						}
					},
					{
						path: 'auditar/:id',
						name: 'auditorias-edit',
						component: () => import( /* webpackChunkName: "js/web/auditoria" */ './views/auditoria/auditoria.vue'),
						meta: {
							breadcrumb: [{
									name: 'Auditorias'
								},
								{
									name: 'Listagem de Auditorias',
									link: 'auditorias-lista'
								},
								{
									name: 'Auditar'
								}
							], auth:{
								modulo: "auditorias",
								permissions: [1,3],
							}
						}
					}
				]
			},
			{
				path: '/empreendimentos',
				name: 'empreendimentos',
				display: 'Empreendimentos Comerciais',
				icone: 'empreendimentos.svg',
				component: () => import( /* webpackChunkName: "js/web/empreendimentos" */ './views/empreendimentos/Empreendimentos.vue'),
				children: [{
					path: '',
					name: 'empreendimentos-lista',
					component: () => import( /* webpackChunkName: "js/web/empreendimentos-listagem" */ './views/empreendimentos-listagem/EmpreendimentosListagem.vue'),
					meta: {
						breadcrumb: [{
							name: 'Empreendimentos Comerciais'
						},
							{
								name: 'Listagem de Empreendimentos'
							},
						],
						auth:{
							modulo: "empreendimentos-comerciais",
							permissions: [1],
						}
					}
				}, {
					path: 'adicionar',
					name: 'empreendimentos-add',
					component: () => import( /* webpackChunkName: "js/web/empreendimento" */ './views/empreendimento/Empreendimento.vue'),
					meta: {
						breadcrumb: [{
							name: 'Empreendimentos Comerciais'
						},
							{
								name: 'Listagem de Empreendimentos',
								link: 'empreendimentos-lista'
							},
							{
								name: 'Adicionar'
							},
						], auth:{
							modulo: "empreendimentos-comerciais",
							permissions: [2],
						}
					}
				},
					{
						path: 'editar/:id',
						name: 'empreendimentos-edit',
						component: () => import( /* webpackChunkName: "js/web/Empreendimento" */ './views/empreendimento/Empreendimento.vue'),
						meta: {
							breadcrumb: [{
								name: 'Empreendimentos Comerciais'
							},
								{
									name: 'Listagem de Empreendimentos',
									link: 'empreendimentos-lista'
								},
								{
									name: 'Editar'
								}
							], auth:{
								modulo: "empreendimentos-comerciais",
								permissions: [1,3],
							}
						}
					}
				]
			},
		]
	};
};
