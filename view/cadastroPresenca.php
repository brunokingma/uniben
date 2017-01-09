<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



<div class="col-lg-12">
 <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Dados do diário</h5>
    </div>
    <div class="ibox-content">
        <form  action="../controller.php" method="post" class="form-inline" id="formupre" >
		
		
			<div class="form-group">
			
					<label for="turma" class="sr-only">Turma</label>
                    <select class="form-control m-b required" name="turma" id="turma" required></select>
                      
					<label for="presenca_data" class="sr-only">Data</label>
					<div class="input-group date" style="margin-top:-15px">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control required" name="presenca_data" id="presenca_data_" value="" required>
                    </div>
            	
           			<label for="presenca_hora" class="sr-only">Hora</label>
	              	<select class="form-control m-b" name="presenca_hora" id="presenca_hora"  disabled="disabled" required>
					<option value="-1">Selecione um horário</option>
					</select> 
					
					<label for="professor_id" class="sr-only">Professor</label>
            	    <select class="form-control m-b" name="professor_id" id="professor_id" required ></select>
                    
					<button class="btn btn-info add " type="button"  disabled="disabled" style="margin-top:-10px"><i class="fa fa-paste"></i> Gerar diário</button>
            
			</div>



            <div class="hr-line-dashed"></div>


            <input type="hidden" name="model" value="presenca" />                                    
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="turma_id" id="turma_id" value="" />
            <input type="hidden" name="presencahora" id="presencahora" value="" />
            <input type="hidden" name="presencadata" id="presencadata" value="" />
            <input type="hidden" name="update" id="update" value="" />


            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="10%">Turma</th>
                            <th width="60%">Aluno</th>
                            <th width="10%">Reposição</th>
                            <th width="10%">Ausente</th>
                            <th width="10%">Presente</th>
                        </tr>
                    </thead>

                    <tbody  id="trs">
                    </tbody>

                </table>

            </div>


      
     </form>
 </div>
</div>

</div>

 
<script src="js/plugins/datapicker/jquery.datetimepicker.full.js"></script>


<script>
 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}



$("#formupre").submit(function (evt) {

    evt.preventDefault();

    var dados = $("#formupre").serialize()+"&presenca_hora="+$("#presenca_hora option:selected").text();
    $.ajax({
      url: "../controller.php?"+dados                           
  }).done(function(data) {

    console.log(data);

    if(data = 1){
      $(".alert-success").removeClass("hide").show();   
      $("html, body").animate({ scrollTop: 0 }, "slow");                        
      $("#update").val("true");
 }else{

     $(".alert-danger").removeClass("hide").show();        
      $("html, body").animate({ scrollTop: 0 }, "slow");                        
  }



});
});


       function deletedia(data, turma, hora){         

      $('#btc').on('click',function(){
              $.ajax({url: "../controller.php?action=deletedia&model=presenca&data="+data+"&turma="+turma+"&hora="+hora}).done(function(data) { 

              $(".alert-success").removeClass("hide").show();
              $('#conteudo').load('cadastroPresenca.php');
          });
      });                     
  }


 $(document).ready(function(){


  $('.modal-title').html('Excluir chamada');
      $('.modal-body').html('Deseja realmente excluir a chamada?');







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


$("#professor_id").on("change",function(){

    if($(this).val() > 0){
        $(".add").prop("disabled", false);    
    }else{
        $(".add").prop("disabled", true);    
    }
    
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