<template lang="pug">
	main#app(:class="{'webkit': webkit}")
		div.container.flex(v-if="$root.authenticated")
			htt-nav(:asideClose='asideClose')
			div.mainContent
				htt-header(@toggleAside="fecharMenu")
				transition(name="modalFade")
					htt-download-relatorio(v-if="$root.downloading", :modulo="$root.downloading")
				div.content.wrapper
					router-view
					// - htt-footer
		div.container.flex(v-else)
			div.mainContent
				div.content.noHeader
					router-view
</template>

<script>
import HttNav from "./components/httNav/HttNav";
import HttHeader from "./components/httHeader/HttHeader";
import HttFooter from "./components/httFooter/HttFooter";
import HttDownloadRelatorio from "./components/httDownloadRelatorio/HttDownloadRelatorio";
import VueCookie from "vue-cookie";

export default {
	components: {
		HttNav,
		HttHeader,
		HttFooter,
		HttDownloadRelatorio
	},
	data() {
		return {
			asideClose: false,
			webkit: null
		};
	},
	methods: {
		fecharMenu($event) {
			this.asideClose = !this.asideClose;
		},
		setAuth() {
			if (this.$cookie.get('xxxxAuth'))
				return {
					token: JSON.parse(this.$cookie.get('xxxxAuth')).token,
					usuario: JSON.parse(this.$cookie.get('xxxxAuth')).usuario,
					name: JSON.parse(this.$cookie.get('xxxxAuth')).name,
					super:JSON.parse(this.$cookie.get('xxxxAuth')).super,
					lastAccess: JSON.parse(this.$cookie.get('xxxxAuth')).ultimo_acesso,
					permissions: JSON.parse(this.$cookie.get('xxxxAuth')).modulos
				}
			return null
		}
	},
	created() {
		let regWebkit = new RegExp(/WebKit/, "gi");
		this.webkit = regWebkit.test(navigator.userAgent);
		this.$root.authenticated = this.setAuth();
		window.addEventListener('downloadedFile', this.$root.removeDownloaded)
	},
	updated() {
		if (!this.$root.authenticated)
			this.$root.authenticated = this.setAuth();
	},
	mounted() {
        if(window.innerWidth < 769){
            this.asideClose = true
        }
    },
};
</script>

<style lang="stylus" scoped>
	#app {
		display: flex;
	}
	.noHeader{
		height 100vh; background #3c3c3c; display flex; width 100%;
		align-items center; justify-content 100%; padding 0 10px
	}
	.mainContent {
		min-width: calc(100% - 300px);
		display: flex;
		flex-flow: row wrap;
	}
	.container{
		width 100%;
	}
	.content {
		width: 100%;
}
</style>
