$(document).ready(function() {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#formUsuario").validate({
        rules: {
            perfil: {
                required: true,

            },
            username: {
                required: true,
            },
            email: {
                required: true,
            },

            status: {
                required: true,
            },
            password: {
                required: true,
            },
           
        },
        messages: {
            perfil: "Este campo é obrigatório!",
            username: "Este campo é obrigatório!",
            email: "Este campo é obrigatório!",
            status: "Este campo é obrigatório!",
            password: "Este campo é obrigatório!",
        },

        submitHandler: function(form) {
            form.submit();
        }

    });
});