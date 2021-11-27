const app = new Vue({
	el: "#app",
	data: {
		msg: "",
		registros: {
			data: []
		},
		totalLeads: 0,
		porcentagemLeads: 0,
		totalTalentos: 0,
		porcentagemTalentos: 0,
		warning: false,
		warning_message: "",
		carregando: true,
		total: '',
	},
	methods: {
		init: function () {
			this.getLeads();
		},
		getLeads: function () {
			$.ajax({
				url: base_url + "/admin/api/total/leads"
			}).done(function (response) {
				app.$data.totalLeads = response.total;
				app.$data.porcentagemLeads = 100
			});
		}
	}
});
app.$data.base_url = base_url;
app.init();
