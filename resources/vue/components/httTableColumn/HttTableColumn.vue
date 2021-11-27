<template lang="pug">
    div.column
        span.columnName(v-if="$props.titulo") {{ $props.titulo }}
        slot
</template>

<script>
export default {
    props: {
        titulo: {
            type: String,
            required: false
        }
    }
};
</script>

<style lang="stylus" scoped src="./HttTableColumn.styl"></style>
