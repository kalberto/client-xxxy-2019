import Vue from 'vue';
import App from './App.vue';
import Router from 'vue-router'
import VueCookie from 'vue-cookie';
import routes from './routes';
import Axios from 'axios';
import money from 'v-money';

Vue.use(money);

Vue.use(VueCookie);

Vue.use(Router);
let router = new Router(routes());
router.beforeEach((to, from, next) => {
	let cookie = JSON.parse(Vue.cookie.get("xxxxAuth"))
	if (!cookie && !(to.name.search('login') >= 0)) return next('/login')
	if (cookie && to.path.search('login') >= 0 && !(to.name.search('dashboard') >= 0)) return next('/')
	if(to.meta && to.meta.auth){
		let hasPermissions = to.meta.auth.permissions.find(permissao => cookie.modulos[to.meta.auth.modulo].includes(permissao))

		if (cookie && !hasPermissions){
			alert('Você não tem permissão para acessar essa página!')
			return next('/')
		}
	}


	return next()
})

Vue.prototype.$base = document.getElementById('base_url').getAttribute('data-base');
Vue.prototype.$axios = Axios.create({
	baseURL: `${document.getElementById('base_url').getAttribute('data-base')}api/`,
	headers: {
		'Authorization': `Bearer ${Vue.cookie.get('xxxxAuth') ? JSON.parse(Vue.cookie.get('xxxxAuth')).token : '' }`
	}
})

Vue.prototype.$axios.interceptors.response.use(config => config, error => {
	if (error.response.status == 401) {
		Vue.cookie.delete('xxxxAuth');
		window.location.reload(true);
		// setTimeout(() => {
		// 	router.push({
		// 		name: 'login'
		// 	})
		// }, 250);
	}
	if (error.response.status == 403) {
		alert("Você não possuí permissão para executar esta ação.")
	}
	return Promise.reject(error);
})

new Vue({
	router,
	data() {
		return {
			authenticated: null,
			downloading: null
		}
	},
	methods: {
		removeDownloading() {
			this.$root.downloading = null
		},
		createDownload(modulo, parameters) {
			this.$root.downloading = {
				modulo, parameters
			}
		},
		hasPermission(chave, valor) {
			return this.$root.authenticated.permissions[chave].includes(valor)
		},
	},
	render: h => h(App)
}).$mount('#app')
