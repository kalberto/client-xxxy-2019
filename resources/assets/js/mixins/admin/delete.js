let delete_mixin = {
    data: function () {
        return {
            deleteRoute:"",
            deleteLink:"",
            deletedIndex:0
        }
    },
    methods:{
        clickDelete(id, index){
            app.$data.deleteLink = this.base_url + this.deleteRoute + id;
            app.$data.deletedIndex = index;
            $('#click_for_modal')[0].click();
        },
        confirmDelete(){
            app.$data.carregando = true;
            $.ajax({
                url:app.$data.deleteLink,
                method:'DELETE',
                headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr("content")}
            }).done(function (response) {
                app.$data.success = true;
                scrollToTopCorrec();
                app.$data.successMessage = response.msg;
                app.load();
                setTimeout(function() {
                    app.$data.success = false;
                }, 2000);
            }).fail(function (response) {
                app.$data.error = true;
                scrollToTopCorrec();
                if(response.responseJSON.msg !== undefined)
                    app.$data.errorMessage = response.responseJSON.msg;
                else
                    app.$data.errorMessage = "Ocorreu um erro.Tente novamente mais tarde.";
            });
        }
    }
};