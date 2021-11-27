import _ from 'lodash';

export default {
	data() {
		return {
			errors: {},
		}
	},
	methods: {
		getError(key) {
			let tempkey = key.replace('.', '\\.');
			let reg = new RegExp(`^${tempkey}$`, 'gim');
			if (this.existError(key)) {
				return Object.entries(this.errors).find(error => reg.test(error[0]))[1][0];
			} else {
				return '';
			}
		},
		existError(key) {
			let tempkey = key.replace('.', '\\.');
			let reg = new RegExp(`^${tempkey}$`, 'gim');
			return Object.keys(this.errors).some(keyObj => reg.test(keyObj));
		},
		limparErroCampo(key) {
			_.unset(this.errors, key)
			this.$forceUpdate()
		},
		getErrorContatos(key) {
			let tempkey = key.replace('.', '\\.');
			let reg = new RegExp(`^${tempkey}`, 'gim');
			if (this.existErrorContatos(key)) {
				return Object.entries(this.errors).find(error => reg.test(error[0]))[1][0];
			} else {
				return '';
			}
		},
		existErrorContatos(key) {
			let tempkey = key.replace('.', '\\.');
			let reg = new RegExp(`^${tempkey}`, 'gim');
			return Object.keys(this.errors).some(keyObj => reg.test(keyObj));
		},
	},
}
