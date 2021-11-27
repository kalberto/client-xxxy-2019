export default {
	methods: {
		formatDate(date, locale = 'pt-BR') {
			return new Date(date)
				.toLocaleDateString(locale)
		}
	}
}
