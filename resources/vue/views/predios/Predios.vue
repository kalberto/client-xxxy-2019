<template lang="pug">
    section#pagePredios.pageModule
        header.page
            h2 Prédios
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

<style lang="stylus" scoped src="./Predios.styl"></style>
