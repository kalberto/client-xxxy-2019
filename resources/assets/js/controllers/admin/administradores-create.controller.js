const app = new Vue({
    el: "#app",
    mixins: [main_mixin,create_mixin,message_mixin,media_mixin],
    data: {
        registro: {
            perfil_id: "",
            ativo: "",
            media:"",
            media_id:""
        },
        perfis: [],
    },
    methods: {
        loadPerfis() {
            $.ajax({
                url: base_url + "/admin/api/perfis/all",
                method: "GET",
            }).done(function(response) {
                app.$data.perfis = response.perfis;
            });
        },
        createAdministrador() {
            this.create("/admin/administradores/salvar","form-administrador",true);
        },
        callLoadAssets(){
          this.media_root = "administradores";
          this.loadAssets();
        },
        selectMedia(id,index){
            app.$data.registro.media_id = id;
            app.$data.registro.media = this.medias[index];
        },
        removeMedia(){
            app.$data.registro.media_id = '';
            app.$data.registro.media = '';
        }
    }
});
app.loadPerfis();