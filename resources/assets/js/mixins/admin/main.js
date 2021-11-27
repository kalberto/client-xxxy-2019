let main_mixin = {
	data: function () {
		return {
			base_url: base_url,
		}
	},
	created: function () {
		window.addEventListener('load', this.main_load)
	},
	methods: {
		formatDate: function (date) {
			if (date === null || date === undefined)
				return "-";
			return Vue.moment(date).format('DD/MM/YYYY');
		},
		initDatepickers: function (inputDate, callback) {
			inputDate = inputDate || '#published_at';
			$.datetimepicker.setLocale('pt-BR');
			$(inputDate).datetimepicker({
				format: 'd/m/Y H:i',
				step: 1,
				todayButton: true,
				validateOnBlur: true,
				mask: "39/19/9999 29:59",
				lazyInit: true,
				onChangeDateTime: function (dp, $input) {
					if (typeof callback === 'function') {
						callback($input.val());
					} else {
						app.$data.registro.published_at = $input.val();
					}
				}
			});
		},
		main_load: function () {
			this.initDatepickers();
		}
	}
};
