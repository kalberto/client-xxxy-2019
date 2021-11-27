<template lang="pug">
    section#pageEmpreendimento.pageModule
        header.page
            h2 Empreendimentos Comerciais
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

<style lang="stylus" scoped src="./Empreendimentos.styl"></style>
