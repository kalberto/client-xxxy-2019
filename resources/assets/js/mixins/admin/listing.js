let listing_mixin = {
    data: function () {
        return {
            route:"",
            carregando:false,
            registros:{
                data:[]
            },
            pagination:{
                page: 1,
                limit: 10,
                total: 0,
                q: "",
                sort: "-created_at",
                fields: ""
            },
            paginator:false,
        }
    },
    methods:{
        resetMessages(){
            app.$data.warning = false;
            app.$data.error = false;
        },
        setSortPagination(pSort){
            this.pagination.sort = pSort;
        },
        setPagePagination(pPage){
          this.pagination.page = pPage;
        },
        load(){
            this.resetMessages();
            this.carregando = true;
            $.ajax({
                url: this.base_url + this.route + "?page=" + this.pagination.page + "&limit=" + this.pagination.limit + "&q=" + this.pagination.q + "&sort=" + this.pagination.sort + "&fields=" + this.pagination.fields,
                method:"GET"
            }).done(function (response) {
                app.$data.carregando = false;
                app.$data.registros = response.registros;
                app.$data.paginator = response.pagination;
                if(app.$data.registros.length <= 0){
                    app.$data.warning = true;
                    app.$data.warningMessage = response.msg;
                }
            }).fail(function (response) {
                app.$data.carregando = false;
                app.$data.warning = true;
                if(response.msg){
                    app.$data.warningMessage = response.msg;
                }else{
                    app.$data.warningMessage = "Ocorreu um erro, tente novamente mais tarde.";
                }
                if(response.responseJSON.registros !== undefined && response.responseJSON.registros !== undefined){
                    app.$data.registros = response.responseJSON.registros;
                    app.$data.paginator = response.responseJSON.pagination;
                }else{
                    app.$data.registros = [];
                    app.$data.paginator = false;
                }
            });
        },
        search(pEvent){
            pEvent.preventDefault();
            this.pagination.page = 1;
            this.load();
        },
        goToPage(pPage){
            this.setPagePagination(pPage);
            this.load();
        }
    }
};