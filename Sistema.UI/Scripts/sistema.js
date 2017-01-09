
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

    $(elemento).toggleClass(function () {
        if ($(this).is('.fa fa-chevron-down')) {
            return '.fa fa-chevron-up';
        } else {
            return '.fa fa-chevron-down';
        }
    })

    return false;

}


$("document").ready(function () {


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


