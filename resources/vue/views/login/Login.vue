<template lang="pug">
	section#pageLogin.flex
		div.logo
			h1 xxxx Telecom
			img(:src="`${$base}images/web/logo/logo-longa.svg`", alt="xxxx Telecom")
		form(@submit.prevent="sendLogin", autocomplete="off", v-if="!sending")
			httInput(@blur="error = ''" inputName="login_user", inputLabel="Usuário", inputType="text", :inputValue.sync="formulario.usuario", :inputMessage="error", :class="{ 'error': error }")._100
			httInput(@blur="error = ''" inputName="login_pass", inputLabel="Senha", inputType="password", :inputValue.sync="formulario.password", :class="{ 'error': error }")._100
			httButton(buttonType='submit', :buttonIcon="require('@/assets/images/web/icones/iconesBranco/enviar_branco.svg')", :buttonDisabled="btnDisabled")
		div.loader(v-if="sending")
			div.load
</template>

<script>
import HttInput from "../../components/httInput/HttInput";
import HttButton from "../../components/httButton/HttButton";
import qs from 'qs';

export default {
	components: {
		HttInput,
		HttButton,
	},
	data() {
		return {
			formulario: {
				usuario: '',
				password: ''
			},
			sending: false,
			error: '',
			btnDisabled: false
		};
	},
	beforeCreated() {
		this.$root.authenticated = null;
		this.$axios.defaults.headers['Authorization'] = `Bearer`
	},
	methods: {
		sendLogin() {
			this.btnDisabled = true;
			this.sending = true;
			this.error = '';
			this.$axios
				.post("auth/login", qs.stringify(this.formulario))
				.then(response => {
					this.$cookie.set('xxxxAuth', JSON.stringify(response.data[0]))
					this.$axios.defaults.headers['Authorization'] = `Bearer ${response.data[0].token}`

					setTimeout(() => {
						this.$router.push({ name: 'dashboard' })
					}, 250)
				})
				.catch(error => {
					console.log(error)
					if(error.response.status == 422) {
						this.error = "Usuário ou senha invalidos"
					}
				})
				.finally(() => {
					setTimeout(() => {
						this.btnDisabled = false;
						this.sending = false;
					}, 250)
				});
		}
	}
};
</script>

<style lang="stylus" scoped src="./Login.styl"></style>
