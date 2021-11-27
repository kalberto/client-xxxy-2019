<template lang="pug">
    aside#asideNav(:class='{asideClose: $props.asideClose}')
        div.logo
            h1 xxxx Telecom
            include ../../../assets/images/web/logo/logo-longa.svg
        nav
            ul
                li(v-for="item of menu")
                    router-link(:to="{'name': item.name}")
                        div.icone
                            img(:src="`${$base}images/web/icones/iconesLaranja/${item.icone}`", :alt="item.display")
                        span {{ item.display }}
</template>

<script>
import routes from "../../routes";

export default {
    props:{
        asideClose: {
            type: Boolean,
            default: false,
        }
    },
	data() {
		return {
			menu: []
		};
	},
	created() {
		this.menu = routes().routes.filter(route => route.display);
        this.menu.forEach((route) => {
            if (route.children) {
                let tempRoute = route;
                tempRoute = route.children.find(child => child.path == '' ? true : false);
                route.name = tempRoute.name;
            }
        })
    },
};
</script>

<style lang="stylus" scoped src="./HttNav.styl"></style>
