<template lang="pug">
    section#pageClientes.pageModule
        header.page
            h2 Clientes
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

<style lang="stylus" scoped src="./Clientes.styl"></style>
