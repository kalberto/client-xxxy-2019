<template lang="pug">
    aside#modalPredios(ref='asidePredios', :class="{ativo: $props.ativo}")
        div.predios
            a.fechar(href="#", @click.prevent="fecharAside()")
                img(:src="require('@/assets/images/web/icones/iconesPreto/fechar.svg')")
            div.tabelaListagem
                div.row.table(v-for="predio, index in predios", :key="predio.id")
                    httTableColumn(titulo="Identificador")._20
                        p {{predio.predio_id}}
                    httTableColumn(titulo="Nome")._30
                        p {{predio.nome}}
                    httTableColumn(titulo="Endereço")._50
                        p {{predio.endereco}}
</template>

<script>
import httTableColumn from "@/vue/components/httTableColumn/HttTableColumn.vue";

export default {
    components: {
        httTableColumn,
    },
    props: {
        predios: Array,
        ativo: Boolean
    },
    methods: {
        fecharAside() {
            this.$emit('update:ativo', false)
        }
    },
};
</script>

<style lang="stylus" scoped src="./HttModalPredios.styl"></style>
