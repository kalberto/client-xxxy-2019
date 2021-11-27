let create_mixin = {
    data: function () {
        return {

        }
    },
    methods:{
        create(pRota,pForm,pRedirect){
            app.$data.sending = true;
            app.$data.error = false;
            app.$data.success = false;
            app.$data.sendingMessage = "Enviando...";
            $.ajax({
                url: base_url + pRota,
                method: "POST",
                async: true,
                data: app.$data.registro,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            }).done(function (response) {
                app.$data.sending = false;
                app.$data.successMessage = response.msg;
                app.$data.success = true;
                scrollToTopCorrec();
                setTimeout(function () {
                    app.$data.created = false;
                    if(pRedirect)
                        window.location.replace(base_url + response.url);
                }, 5000);
            }).fail(function (response) {
                app.$data.sending = false;
                app.$data.error = true;
                scrollToTopCorrec();
                if (response.responseJSON.error_validate) {
                    var erros = response.responseJSON.error_validate;
                    insertErrorsOnForm(pForm, erros);
                }
                app.$data.errorMessage = response.responseJSON.msg;

            });
        }
    }
};