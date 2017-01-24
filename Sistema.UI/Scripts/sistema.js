
$('.formAjax').submit(function (e) {

    e.preventDefault();

    var dados = $(this).serialize(); 

    var metodo = $(this).attr("action");

    $("#modal").modal('show');

    $("#botaoSalvar").on("click", function () {
        $("#modal").modal('hide');
        $.ajax({
            type: "POST",
            url: metodo,
            data: dados,
            success: function (data, textStatus, jqXHR) {
                
                if (data.status) {
                    $('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'+dados.msg+'</div>').insertAfter(".breadcrumb");
                } else {
                    $('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Ocorreu um erro:</b>' + dados.error + '</div>').insertAfter(".breadcrumb");
                }               

            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><b>Ocorreu um erro: </b>' + errorThrown + '</div>').insertAfter(".breadcrumb");
            }

        });
    });

});



function toogle(elemento) {

    $(elemento.parentElement.parentElement.childNodes[6]).slideToggle("slow");

    $(elemento).toggleClass('fa-chevron-up fa-chevron-down')
        
    return false;

}




function carregaDados(obj, tipo) {

    if (typeof obj !== 'object') {
        obj = search(obj);
    }

    if (tipo == 'visualizar') {
        $("#myModalLabel").html("Visualizar dados cadastrais");
        $("#btConfirmar").hide();

    } else {
        $("#myModalLabel").html("Atualizar dados cadastrais");
        $("#btConfirmar").show();
    }

    var elemento = "";
    var input = "";

    $.each(obj, function (index, value) {
        if (value != null) {
            if (typeof value === 'object') {
                $.each(value, function (i, v) {
                    $.each(Object.keys(v), function (i2, v2) {
                        input = $("#" + v2);
                        input.val(v[v2]);
                    });
                });
            }
            if (typeof value !== 'object') {
                $("#" + index).val(value);
            }
        }

    });

    $("#modal").modal().show();


}



function search(id) {
    var items = $("#jsGrid").jsGrid("option", "data");
    for (var i = 0; i < items.length; i++) {
        if (items[i].EmpresaId === id) {
            return items[i];
        }
    }
}

function submitDados(entidade, acao) {

    $('#btConfirmar').on('click', function () {

        $('#btConfirmar').html("<i class=\"fa fa-cog fa-spin fa-1x fa-fw\"></i> Carregando...");
        $('#btConfirmar').attr("disabled", "disabled");
        $.ajax({
            method: "POST",
            url: "/" + entidade + "/" + acao + "",
            data: $('#formulario').serialize(),
            dataType: "json",
            success: function (r) {
                var r = JSON.parse(r);
                $('#btConfirmar').html("Salvar");

                if (r.retorno == 'true') {
                    var sucesso = '<div class="alert alert-success"><i class="fa fa-floppy-o fa-3x" aria-hidden="true"></i> <h4>Cadastro realizado com sucesso.</h4></div>';
                    $('#modal .modal-body').html(sucesso);
                    $('#formulario')[0].reset();
                } else {
                    var erro = '<div class="alert alert-danger"><i class="fa fa-floppy-o fa-3x" aria-hidden="true"></i> <h4>Ocorreu um erro ao realizar o cadastro.</h4></div>';
                    $('#modal .modal-body').html(erro);
                }

            }
        });
    });
}


$("document").ready(function () {




    $('#formulario').submit(function (event) {
        event.preventDefault();
        $('#btConfirmar').prop("disabled", false);
        $('#btConfirmar').html("Salvar")
        $('#modal .modal-body').html("Deseja realmente realizar a operação?")
        $('#modal').modal();
    });



    $('#CNPJ').keyup(function () {

        var cnpj = $(this).val().replace(/[^a-z0-9]/gmi, "");

        if (cnpj.length == 14) {
            $.ajax({
                method: "GET",
                url: "/Empresa/RetornaCnpj/" + cnpj,
                success: function (r) {

                    var retorno = JSON.parse(r);

                    if (retorno.status == "OK") {

                        var cep = retorno.cep;
                        cep = cep.replace(/[^a-z0-9]/gmi, "");

                        $("#logradouro").val(retorno.logradouro);
                        $("#bairro").val(retorno.bairro);
                        $("#cidade").val(retorno.municipio);
                        $("#estado").val(retorno.uf);
                        $("#complemento").val(retorno.complemento);
                        $("#NomeFantasia").val(retorno.fantasia);
                        $("#numero").val(retorno.numero);
                        $("#cep").val(cep);
                        $("#Abertura").val(retorno.abertura);
                        if (retorno.situacao == "ATIVA") { $("select#Situacao").prop('selectedIndex', 0); } else { $("select#Situacao").prop('selectedIndex', 1); }
                        $("#Telefone").val(retorno.telefone);
                        $("#Email").val(retorno.email);
                        $("#Nome").val(retorno.nome);
                        $("#NaturezaJuridica").val(retorno.natureza_juridica);
                        $("#AtividadePrincipal").val(retorno.atividade_principal[0].text);
                        $("#Codigo").val(retorno.atividade_principal[0].code);

                    }
                }
            });
        }

    });


    $(".data").mask("99/99/9999", { placeholder: "dd/mm/yyyy" });
    $(".telefone").mask("(99) 9999-9999");
    $(".cep").mask("99999-999");
    $(".cnpj").mask("99.999.999/9999-99");


    /**
    *Controle dos paineis
    *
    *
    */



    $('a').tooltip({ placement: 'top' });



    /**
    * barra de ferramentas
    *
    */



    $('.selected-rows').parent().css('display', 'none')

    $("#modal").draggable({
        handle: ".modal-header"
    });




});


