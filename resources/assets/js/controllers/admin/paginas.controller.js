const app = new Vue({
    el:"#app",
    mixins: [main_mixin,message_mixin,listing_mixin],
    data: {
        route: "/admin/api/paginas",
    },
    methods:{
        init(){
            this.setSortPagination("-created_at");
            this.load();
        }
    }
});
app.init();