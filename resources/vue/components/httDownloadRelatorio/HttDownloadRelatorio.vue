<template lang="pug">
    aside#downloadRelatorio
        a.fechar(href="#", @click.prevent="closeModal()")
            img(:src="require('@/assets/images/web/icones/iconesPreto/fechar.svg')")
        div.mensagem(v-if="!ready")
            p Seu arquivo está sendo preparado!
        div.mensagem(v-else)
            p(v-if="reportSuccess") Seu arquivo "{{ file.name }}" está pronto!
            p(v-else) {{msgError}}

        
        div.loader(v-if="!ready")
            div.load
                i
                i
                i
        
        div.botao(v-if="ready && reportSuccess")
            a(:href="file.url", :download="file.name", @click="closeModal()")
                img(:src="require('@/assets/images/web/icones/iconesLaranja/download_laranja.svg')").baixar 
                | Baixar Documento
</template>

<script>
import qs from 'qs';

export default {

    data() {
        return {
            ready: false,
	        reportSuccess:false,
            file: {
                name: 'relatorio.xlsx',
                blob: null,
                url: null
            },
	        msgError:"Ocorreu um erro com a geração do arquivo."
        }
    },
    beforeDestroy() {
        window.onbeforeunload = null;
    },
    created() {
        if (this.$root.downloading.modulo) {
        	if(this.$root.downloading.modulo === 'contrato'){
        		this.generateContrato();
	        }else{
		        this.getDownloadFile(this.$root.downloading.modulo);
		        window.onbeforeunload = function(e) {
			        e.preventDefault();
			        return "Certeza que deseja sair? Se você sair, não conseguirá baixar o arquivo."
		        }
	        }
        }
    },
    methods: {
    	convertFile(response){
		    let contentDisposition = response.headers['content-disposition'];
		    this.file.name = contentDisposition.split('filename=', contentDisposition.length)[1];
		    this.file.blob = new Blob([response.data], { type: '' })
		    this.file.url = URL.createObjectURL(this.file.blob);
		    this.ready = true;
		    this.reportSuccess = true;
	    },
        getDownloadFile(modulo) {
	        this.msgError = "Ocorreu um erro com a geração do arquivo.";
            this.$axios
                .get(`${modulo}/relatorio?${this.$root.downloading.parameters ? qs.stringify(this.$root.downloading.parameters) : ''}`, {
                    responseType: 'arraybuffer'
                })
                .then(response => {
                    this.convertFile(response);
                }).catch(error => {
                	this.ready = true;
                	this.reportSuccess = false;
                })
        },
	    generateContrato(){
        	if(this.$root.downloading.parameters.tipo && this.$root.downloading.parameters.codigo){
		        this.$axios.get(`vendas/${this.$root.downloading.parameters.codigo}/${this.$root.downloading.parameters.tipo}${this.$root.downloading.parameters.data ? "?data=" + this.$root.downloading.parameters.data : ""}`
		        ).then(response => {
			        this.$root.downloading.documentos.unshift(response.data.documento);
			        this.$axios
				        .get(`vendas/${this.$root.downloading.parameters.codigo}/documentos/${response.data.documento.nome}`, {
					        responseType: 'arraybuffer'
				        }).then(response => {
				        	this.convertFile(response);
			            })
		        }).catch(error => {
		        	if(error.response.data && error.response.data.msg)
		        		this.msgError = error.response.data.msg;
			        this.ready = true;
			        this.reportSuccess = false;
		        })
	        }
	    },
        closeModal() {
            setTimeout(() => {
                this.$root.downloading = null;
            }, 500);
        }
    },
};
</script>

<style lang="stylus" scoped src="./HttDownloadRelatorio.styl"></style>
