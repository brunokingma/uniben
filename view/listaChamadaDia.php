<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>

<div class="col-lg-12">

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Buscar diário</h5>
        </div>
        <div class="ibox-content form-inline" >

        
			<div class="form-group">
			        <form  action="../controller.php" method="post" class="form-inline" id="formupre" >

						<label for="turma" class="sr-only">Turma</label>
						<select class="form-control m-b required" name="turma" id="turma" required></select>
						  
						<label for="presenca_data" class="sr-only">Data</label>
						<div class="input-group date" style="margin-top:-15px">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control required" name="presenca_data" id="presenca_data_" value="" required>
						</div>

			
					    <button class="btn btn-primary buscar" type="button" style="margin-top:-10px"><i class="fa fa-search"></i> Buscar diário</button>
					</form>
			</div>

          <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="80%">Turma</th>
                        <th width="20%">Data</th>
                   </tr>
                </thead>

                <tbody  id="trs2">
                </tbody>

            </table>

        </div>

    </div>
</div>

</div>

 
<script src="js/plugins/datapicker/jquery.datetimepicker.full.js"></script>


<script>
 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}



 $('.buscar').on('click', function(event){
    event.preventDefault();

       $.ajax({
          url: "../controller.php?action=relatoriosChamadaDia&model=relatorio&data="+$("#presenca_data_").val()+"&turma=" +$("#turma").val()                           
      }).done(function(data) {
          $("#trs2").html("");
          $("#trs2").html(data);    
      });

  


});


 $(document).ready(function(){



    $.ajax({
      url: "../controller.php?action=listaturmacombo&model=turma"                              
  }).done(function(data) {
    $("#turma").html("");
    $("#turma").html('<option value="0">Selecione uma turma</option>'+data);

    $("#turma_id1").html("");
    $("#turma_id1").html('<option value="-1">Selecione uma turma</option>'+data);
});



  $.ajax({
      url: "../controller.php?action=buscaperfil&model=usuario"                              
  }).done(function(data) {
    $("#professor_id").html("");
    $("#professor_id").html('<option value="0">Selecione um professor</option>'+data);
});



  $('.add').on('click', function(){

     $("#update").val(" ");
     $.ajax({
      url: "../controller.php?action=add&model=presenca&turma_id="+$("#turma").val() +"&presenca_data="+$("#presenca_data_").val()+"&presenca_hora="+$("#presenca_hora option:selected").text()                         
  }).done(function(data) {
    $("#trs").html("");
    $("#trs").html(data);

    $("#turma_id").val($("#turma").val());
    $("#presencahora").val($("#presenca_hora").val());
    $("#presencadata").val($("#presenca_data_").val());

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
});



});




  $('.bdiario').on('click', function(event){
     event.preventDefault();
     $(".btupdate").addClass('hide');
     $.ajax({
      url: "../controller.php?action=presenca&model=presenca&turma_id="+$("#turma").val() +"&presenca_data="+$("#presenca_data_").val()+"&inicio="+$("#presenca_hora").val()                           
  }).done(function(data) {

    $("#turma_id").val($("#turma").val());
    $("#presencadata").val($("#presenca_data_").val());
    $("#update").val("true");

    $("#professor_id").prop("disabled", false);

    $("#trs").html("");
    $("#trs").html(data);
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $("#professor_id").val($("#professor_id2").val());
    $(".btupdate2").removeClass('hide');
});

});



  $('.date').datepicker({
    startView: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true
});


$("#presenca_data_").attr("placeholder", "Selecione uma data");




$("#turma").on('change',function(){

	     $.ajax({
      url: "../controller.php?action=listahorariocombo&model=turma&turma_id="+$(this).val()                              
    }).done(function(data) {
    	$("#presenca_hora").prop("disabled", false);
        $("#presenca_hora").html("");
        $("#presenca_hora").html('<option value="0">Selecione um horário</option>'+data);
    });


});


});

</script>