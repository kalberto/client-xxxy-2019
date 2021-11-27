<template lang="pug">
    section#pageVendas.pageModule
        header.page
            h2 Vendas
            httBreadcrumb
        router-view
</template>

<script>
import httBreadcrumb from "@/vue/components/httBreadcrumb/HttBreadcrumb.vue";

export default {
	components: {
		httBreadcrumb
	}
};
</script>

<style lang="stylus" scoped src="./Vendas.styl"></style>
