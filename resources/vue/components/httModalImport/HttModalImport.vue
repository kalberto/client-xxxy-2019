<template lang="pug">
    aside#modalImport
        div.import
            a.fechar(href="#", @click.prevent="fecharAside()", v-if="!buttonDisabled")
                img(:src="require('@/assets/images/web/icones/iconesPreto/fechar.svg')")
            label(for="import")
                input(id="import", type="file", ref="inputImport", @change="getFile", :disabled="buttonDisabled")
                span(v-if="!file && !sucesso") Clique aqui e selecione seu arquivo
                span(v-if="file && !sucesso") 
                    img(:src="require('@/assets/images/web/icones/iconesBranco/file.svg')")
                    |{{file.name}}
                span.sucesso(v-if="sucesso")
                    img(:src="require('@/assets/images/web/icones/iconesPreto/success.svg')")
                    | Arquivo carregado com sucesso!

            span(v-if="buttonDisabled") Checando
            div.checkingProgress(v-if="buttonDisabled")
                div(ref="checkingProgress")
            span(v-if="buttonDisabled") Uploading
            div.uploadProgress(v-if="buttonDisabled")
                div(ref="uploadProgress")
            div.botoes.flex
                httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/upload_branco.svg')", 
                    buttonText="Importar Planilha", @click="importFile()", :buttonDisabled="buttonDisabled")
                a(:href="`${$base}api/${$props.route}/download`", download)
                    httButton(buttonType='button', :button-icon="require('@/assets/images/web/icones/iconesBranco/download-icon_branco.svg')", 
                        buttonText="Download planilha base")
                span(v-if="messagemErro") {{messagemErro}}
            div.errors(v-if="errorMessages.length > 0")
                ul
                    li(v-for="error in errorMessages")
                        |Linha {{ error.linha }}: {{ error.errors.join(', ') }}
</template>

<script>
import httButton from "@/vue/components/httButton/HttButton.vue";

export default {
    props: {
        ativoImport: Boolean,
        route: String,
    },
    components: {
        httButton,
    },
    data(){
        return {
            file: null,
            buttonDisabled: false,
            errorMessages: [],
            messagemErro: '',
            sucesso: false
        }
    },
    created() {
        window.onbeforeunload = function(e) {
            e.preventDefault();
            return "Certeza que deseja sair? Se você sair sera interrompido o upload do arquivo"
        }
    },
    beforeDestroy() {
        window.onbeforeunload = null;
    },
    methods: {
        getFile(event){
           this.file = event.target.files[0]
        },
        importFile() {
            let form = new FormData()
            form.append('file', this.file);
            this.buttonDisabled = true;
            this.$axios
				.post(`${this.$props.route}/upload`, form, {
                    responseType: 'stream',
                    'Content-Type': 'multipart/form-data',
                    onDownloadProgress: progressEvent => {
                        let regexPercent = new RegExp(/\d{1,2}\.\d{2}$/, 'g')
                        let checkingValidator = new RegExp(/(CheckingDone|CheckingError)/, 'gi')
                        let uploadValidator = new RegExp(/(UploadDone)/, 'gi')
                        let percent = regexPercent.exec(progressEvent.currentTarget.response)
                        let checking = checkingValidator.exec(progressEvent.currentTarget.response)
                        let uploading = uploadValidator.exec(progressEvent.currentTarget.response)
                        if(checking){
                            this.$refs.checkingProgress.style.width = '100%'
                            this.$refs.uploadProgress.style.width = `${percent}%`
                        }else
                            this.$refs.checkingProgress.style.width = `${percent}%`
                        if(uploading)
                            this.$refs.uploadProgress.style.width = `100%`
                    }
                })
				.then(response => {
                    let checkingValidator = new RegExp(/CheckingError/, 'gi')
                    let checking = checkingValidator.exec(response.data)
                    let messageError = new RegExp(/\[.*\]$/, 'gi');
                    if(checking){
                        let message = messageError.exec(response.data)
                        this.errorMessages = JSON.parse(message[0])
                        this.sucesso = false;
                    } else {
                        this.sucesso = true;
                    }
				}).catch(error => {
                    if(error.response.status == 500){
                        this.messagemErro = 'Erro ao enviar planilha'
                    }else{
                        this.messagemErro = error.response.data.msg
                    }
                    this.sucesso = false;
                }).finally(() => {
                    this.file = null;
                    setTimeout(() => {
                        this.buttonDisabled = false;
                    }, 4500)
                })
        },
        fecharAside() {
            this.$emit('update:ativoImport', false)
        }
    },
};
</script>

<style lang="stylus" scoped src="./HttModalImport.styl"></style>
