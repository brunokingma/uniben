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

          <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="60%">Aluno</th>
                        <th width="20%">Login</th>
                        <th width="20%" align="center">Resetar Senha</th>
                   </tr>
                </thead>

                <tbody  id="tb">
                </tbody>

            </table>

        </div>

    </div>
</div>

</div>

 
<script src="js/plugins/datapicker/jquery.datetimepicker.full.js"></script>


<script>
 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}



function alterardadosaluno(id, usuario){

   var modal =  '<div class="form-group"><label>Deseja realmente resetar senha do usuario '+usuario+'? </label> </div>';

   $('.modal-title').html('Resetar senha');
   $('.modal-body').html(modal);
   $('#btc').prop("type", "button");
   $('#btc').attr("rel", id);


   $('#btc').on('click',function(){
    var id = $("#btc").attr('rel');
    $.ajax({url: "../controller.php?action=resetsenha&model=usuario&id="+id+""}).done(function(data) { 
      $(".alert-success").removeClass("hide").show();
    });  
   });

}







 $(document).ready(function(){

  $.ajax({
      url: "../controller.php?action=alteraDadosAluno&model=usuario"                              
  }).done(function(data) {
    $("#tb").html("");
    $("#tb").html(data);
});



});

</script>