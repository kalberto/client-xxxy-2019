<template lang="pug">
    section#pageAuditorias.pageModule
        header.page
            h2 Auditorias
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

<style lang="stylus" scoped src="./Auditorias.styl"></style>
