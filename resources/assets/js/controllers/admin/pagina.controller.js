const app = new Vue({
    el:"#app",
    mixins: [main_mixin,edit_mixin,message_mixin,media_mixin],
    data:{
        registro:{
            secoes:[],
            complementos:[]
        },
        mediaSelector:{
            identifier:'',
            complemento:0,
            secao:0,
            secaoComplemento:0
        },
        secaoEditor:[],
        pagina_selected_media:false,
        secao_selected_media:[],
        complemento_selected_media:[],
        medias:[],
        media_root:'medias',
    },
    methods:{
        editSecao(id){
            if(this.secaoEditor[id])
                Vue.set(this.secaoEditor,id,!this.secaoEditor[id]);
            else{
                Vue.set(this.secaoEditor,id,!this.secaoEditor[id]);
            }
        },
        load(){
            $.ajax({
                url: base_url + "/admin/api/paginas/" + id,
                method: "GET"
            }).done(function (response) {
                app.$data.registro = response.registro;
                app.$data.pagina_selected_media = response.registro.media;
            });
        },
        selectMedia(id,index){
            if(this.mediaSelector.identifier === "pagina"){
                this.registro.media_id = id;
                this.registro.media = this.medias[index];
            }else if(this.mediaSelector.identifier === "secao"){
                this.registro.secoes[this.mediaSelector.secao].media_id = id;
                this.registro.secoes[this.mediaSelector.secao].media = this.medias[index];
            }else if(this.mediaSelector.identifier === "secaoMedias"){
                if(!this.registro.secoes[this.mediaSelector.secao].mediasId.includes(id)){
                    this.registro.secoes[this.mediaSelector.secao].mediasId.push(id);
                    this.registro.secoes[this.mediaSelector.secao].medias.push(this.medias[index]);
                }
            }else if(this.mediaSelector.identifier === "complemento_secao"){
                this.registro.secoes[this.mediaSelector.secao].secoes_complementos[this.mediaSelector.secaoComplemento].media_id = id;
                this.registro.secoes[this.mediaSelector.secao].secoes_complementos[this.mediaSelector.secaoComplemento].media = this.medias[index];
            }else if(this.mediaSelector.identifier === "pagina_complemento"){
                this.registro.complementos[this.mediaSelector.complemento].valor = base_url + '/' + this.medias[index].media_root.path + (this.medias[index].tipo === 1 ? (this.medias[index].file) : (this.medias[index].thumbnail))
            }
        },
        removeMedia(pParams){
            this.mediaSelector = pParams;
            if(this.mediaSelector.identifier === "pagina"){
                this.registro.media_id = '';
                this.registro.media = '';
            }else if(this.mediaSelector.identifier === "secao"){
                this.registro.secoes[this.mediaSelector.secao].media_id = '';
                this.registro.secoes[this.mediaSelector.secao].media = '';
            }else if(this.mediaSelector.identifier === "secaoMedias"){
                this.registro.secoes[this.mediaSelector.secao].mediasId.splice(this.mediaSelector.media,1);
                this.registro.secoes[this.mediaSelector.secao].medias.splice(this.mediaSelector.media,1);
            }else if(this.mediaSelector.identifier === "complemento_secao"){
                this.registro.secoes[this.mediaSelector.secao].secoes_complementos[this.mediaSelector.secaoComplemento].media_id = '';
                this.registro.secoes[this.mediaSelector.secao].secoes_complementos[this.mediaSelector.secaoComplemento].media = '';
            }
        },
        addMetaTag(){
            this.registro.complementos.push({nome:'',tipo:1,valor:''});
        },
        removeMetaTag(index){
            this.registro.complementos.splice(index,1);
        },
        callLoadAssets(pParams){
            this.mediaSelector = pParams;
            if(this.mediaSelector.secao !== undefined && this.registro.secoes[this.mediaSelector.secao].media_root !== undefined){
                this.media_root = this.registro.secoes[this.mediaSelector.secao].media_root;
            }
            else if(this.registro.media_root !== undefined){
                this.media_root = this.registro.media_root;
            }else{
                this.media_root = 'medias';
            }
            this.loadAssets();
        },
        checkSlug(id){
            $.ajax({
                url:base_url + "/admin/api/paginas/" + id + "/check-url",
                method:"POST",
                data:{slug:app.$data.registro.slug !== undefined ? app.$data.registro.slug : ""},
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            }).done(function (response) {
                let mensagens = Object.getOwnPropertyNames(response);
                let form = $("form[name=form-pagina]");
                mensagens.forEach(function (msg) {
                    if(msg !== "field"){
                        let element = form.find("[name=" + msg + "]");
                        insertSuccessOnInput(element,response[msg]);
                    }else{
                        app.$data.registro.slug = response[msg];
                    }
                });
            }).fail(function (response) {
                if(response.responseJSON.errors){
                    let mensagens = Object.getOwnPropertyNames(response.responseJSON.errors);
                    let form = $("form[name=form-pagina]");
                    mensagens.forEach(function (msg) {
                        let element = form.find("[name=" + msg + "]");
                        insertErrorOnInput(element,response.responseJSON.errors[msg]);
                    });
                }

            });
        },
        editPagina(){
            this.edit("/admin/paginas/atualizar/" + id,"form-pagina",true);
        }
    }
});
app.load();