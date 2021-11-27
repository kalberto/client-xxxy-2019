<template lang="pug">
    nav.breadcrumb
        ul.flex
            li(v-for="item, index in breadcrumb", :key="index")
                router-link(:to="{ name: item.link }", v-if="item.link")
                    p {{ item.name }}
                p(v-else) {{ item.name }}
</template>

<script>
export default {
    data(){
        return {
            breadcrumb: []
        }
    },
    mounted() {
        this.breadcrumb = this.$route.meta.breadcrumb;
    },
    watch: {
        '$route': function() {
            this.breadcrumb = this.$route.meta.breadcrumb;
        }
    }
};
</script>

<style lang="stylus" scoped src="./HttBreadcrumb.styl"></style>
