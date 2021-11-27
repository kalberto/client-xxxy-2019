const app = new Vue({
    el: "#app",
    mixins: [main_mixin,edit_mixin,message_mixin,media_mixin],
    data: {
        msg_dados:"",
        sending_message_dados:'Enviando..',
        sucess_message_dados:'Editado com sucesso',
        carregando_edit_dados:false,
        saved_dados:false,
        registro:{},
        perfis: [],
    },
    methods: {
        loadAdministrador() {
            $.ajax({
                url: base_url + "/admin/api/administradores/" + id,
                method: "GET",
            }).done(function(response) {
                app.$data.registro = response.administrador;
                app.$data.perfis = response.perfis;
            });
        },
        editAdministrador(){
            this.edit("/admin/administradores/atualizar/" + id,"form-administrador",true);
        },
        atualizarAdministradorDados(id) {
            this.carregando_edit_dados = true;
            app.$data.saved_dados = false;
            $.ajax({
                url: base_url + "/admin/administradores/atualizar/senha/" + id,
                method: "put",
                data: app.$data.registro,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            })
                .done(function(response) {
                    app.$data.carregando_edit_dados = false;
                    app.$data.sucess_message_dados = response.msg_dados;
                    app.$data.saved_dados = true;
                    setTimeout(function() {
                        app.$data.saved = false;
                    }, 5000);
                })
                .fail(function(response) {
                    app.$data.carregando_edit_dados = false;
                    if (response.responseJSON.error_validate) {
                        let erros = response.responseJSON.error_validate;
                        insertErrorsOnForm("form-administrador-dados",erros);
                    } else {
                    }
                });
        },
        callLoadAssets(){
            this.media_root = "administradores";
            this.loadAssets();
        },
        selectMedia(id,index){
            this.registro.media_id = id;
            this.registro.media = this.medias[index];
        },
        removeMedia(){
            this.registro.media_id = "";
            this.registro.media = "";
        }
    }
});
app.loadAdministrador();
