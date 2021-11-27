<template lang="pug">
	header#mainHeader
		div.wrapper.flex
			button.menu(@click.prevent="emitToggle")
				i.material-icons menu
			div.nav.flex
				div.user(@click="dropdownActive = !dropdownActive")
					div.info
						p.nomeUser {{ $root.authenticated.name }}
						p.ultimoAcesso Último acesso:
							time {{ $root.authenticated.lastAccess }}
					button
						i.material-icons keyboard_arrow_down
				div.dropdownUser(v-show="dropdownActive")
					ul
						li
							a(href="#logout", @click.prevent="doLogout()")
								i.material-icons exit_to_app
								span Sair
</template>

<script>
import Format from '../../mixins/Format'
export default {
	mixins: [Format],
	data() {
		return {
			dropdownActive: false
		};
	},
	methods: {
		emitToggle() {
			this.$emit("toggleAside");
		},
		doLogout() {
			this.$axios
				.get("auth/logout")
				.then(response => {})
				.catch(error => {})
				.finally(() => {
					this.$cookie.delete('xxxxAuth')
					this.$axios.defaults.headers['Authorization'] = `Bearer`;
					setTimeout(() => {
						this.$root.authenticated = null;
						this.$router.push({ name: 'login' })
					}, 250)
				});
		}
	}
};
</script>

<style lang="stylus" scoped src="./HttHeader.styl"></style>
