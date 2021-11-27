<template lang="pug">
    section#pageProspeccao.pageModule
        header.page
            h2 Prospecções
            httBreadcrumb
        router-view
</template>

<script>
import httBreadcrumb from '@/vue/components/httBreadcrumb/HttBreadcrumb.vue'

export default {
    components: {
        httBreadcrumb
    }
};
</script>

<style lang="stylus" scoped src="./Prospeccoes.styl"></style>
