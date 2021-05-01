$(document).ready(function() {
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#formPatrimonios").validate({
        rules: {
            denominacao: {
                required: true,

            },
            classificacao: {
                required: true,
            },
            usoAtual: {
                required: true,
            },

            propriedade: {
                required: true,
            },
            resolucaoTombamento: {
                required: true,
            },
            resolucaoCondephaat: {
                required: true,
            },
            resolucaoIphan: {
                required: true,
            },
            tipo: {
                required: true,
            },
            titulo: {
                required: true,
            },
            logradouro: {
                required: true,
            },
            numeroEndereco: {
                required: true,
            },
            distrito: {
                required: true,
            },
            prefeituraRegional: {
                required: true,
            },
            setor: {
                required: true,
            },
            quadra: {
                required: true,
            },
            lote: {
                required: true,
            },
            dataConstrucao: {
                required: true,
            },
            estiloArquitetonico: {
                required: true,
            },
            tecnicaConstrutiva: {
                required: true,
            },
            numeroPavimentos: {
                required: true,
            },
            grauAlteracao: {
                required: true,
            },
            dadosHistoricos: {
                required: true,
            },
            dadosArquitetonicos: {
                required: true,
            },
            dadosAmbiencia: {
                required: true,
            },
            fontesBibliograficas: {
                required: true
            }
        },
        messages: {
            denominacao: "Este campo é obrigatório!",
            classificacao: "Este campo é obrigatório!",
            usoAtual: "Este campo é obrigatório!",
            propriedade: "Este campo é obrigatório!",
            resolucaoTombamento: "Este campo é obrigatório!",
            resolucaoCondephaat: "Este campo é obrigatório!",
            resolucaoIphan: "Este campo é obrigatório!",
            tipo: "Este campo é obrigatório!",
            titulo: "Este campo é obrigatório!",
            logradouro: "Este campo é obrigatório!",
            numeroEndereco: "Este campo é obrigatório!",
            distrito: "Este campo é obrigatório!",
            prefeituraRegional: "Este campo é obrigatório!",
            setor: "Este campo é obrigatório!",
            quadra: "Este campo é obrigatório!",
            lote: "Este campo é obrigatório!",
            dataConstrucao: "Este campo é obrigatório!",
            estiloArquitetonico: "Este campo é obrigatório!",
            tecnicaConstrutiva: "Este campo é obrigatório!",
            numeroPavimentos: "Este campo é obrigatório!",
            grauAlteracao: "Este campo é obrigatório!",
            dadosHistoricos: "Este campo é obrigatório!",
            dadosArquitetonicos: "Este campo é obrigatório!",
            dadosAmbiencia: "Este campo é obrigatório!",
            fontesBibliograficas: "Este campo é obrigatório!",
        },

        submitHandler: function(form) {
            form.submit();
        }

    });
});