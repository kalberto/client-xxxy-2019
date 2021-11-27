<template lang="pug">
    router-link(:to='$props.linkCard')
        div.card
            h3 {{ $props.nomeCard }}
            div.img
                img(:src="$props.imgCard")
            span {{ $props.valorCard }}
</template>

<script>
export default {
    props:{
        linkCard:{
            type: Object,
            required: true,
        },
        nomeCard: {
            type: String,
            required: true,
        },
        imgCard: {
            type: String,
            required: true,
        },
        valorCard: {
            type: Number,
            required: true,
        }
    }
};
</script>

<style lang="stylus" scoped src="./HttDashboardCard.styl"></style>
