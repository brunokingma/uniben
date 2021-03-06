<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>


<div class="col-lg-12">
  <div class="ibox float-e-margins">

  <form id="fm" action="../controller.php" method="post" class="form-inline" >

    <div class="ibox-title" style="height:70px;">
      <h5>Relatórios</h5>
	  <button class="btn btn-primary pull-right" id="bt_" type="submit"><i class="fa fa-check"></i> Gerar relatório</button>
    </div>
    <div class="ibox-content">

        <input type="hidden" name="model" value="relatorio" />
        <input type="hidden" name="action" value="relatoriosChamada" />
	<div class="form-group">
			
					<label for="turma" class="sr-only">Turma</label>
                    <select class="form-control m-b required" name="turma_id" id="turma_id" required></select>
					
					            	
           			<label for="presenca_hora" class="sr-only">Hora</label>
	              	<select class="form-control m-b" name="presenca_hora" id="presenca_hora"  disabled="disabled" required>
					<option value="-1">Selecione um horário</option>
					</select> 
                      
					<label for="presenca_data" class="sr-only">Data</label>
					<div class="input-group date" style="margin-top:-15px">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control required" name="presenca_data" id="presenca_data" value="" required>
                    </div>

				       
            
			</div>
                            </form>							
		
    <div class="hr-line-dashed"></div>

                       <div class="table-responsive">
                        <table class="table table-striped" >
                          <thead>
                            <tr>
                              <th>Aluno</th>
                              <th>Data da chamada</th>
                              <th>Presença</th>
                              <th>Reposição</th>
                            </tr>
                          </thead>

                          <tbody  id="trs">
                          </tbody>
                        </table>
                      </div>						
                      </div>
</div>	

 </div>

                <style>

                  .ui-helper-hidden-accessible { display:none; }

                  .ui-corner-all
                  {
                    -moz-border-radius: 4px 4px 4px 4px;
                  }
                  .ui-widget-content
                  {
                    border: 1px solid #e5e6e7;
                    color: #222222;
                    background-color: white;
                    z-index: 3;
                  }
                  .ui-widget
                  {
                    font-family: Verdana,Arial,sans-serif;
                    font-size: 15px;
                  }
                  .ui-menu
                  {
                    display: block;
                    float: left;
                    list-style: none outside none;
                    margin: 0;
                    padding: 2px;
                  }
                  .ui-autocomplete
                  {
                    cursor: default;
                    position: absolute;
                  }
                  .ui-menu .ui-menu-item
                  {
                    clear: left;
                    float: left;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                  }
                  .ui-menu .ui-menu-item a
                  {
                    display: block;
                    padding: 3px 3px 3px 3px;
                    text-decoration: none;
                    cursor: pointer;

                  }
                  .ui-menu .ui-menu-item a:hover
                  {
                    display: block;
                    padding: 3px 3px 3px 3px;
                    text-decoration: none;
                    color: White;
                    cursor: pointer;
                    background-color: #1ab394;
                  }
                  .ui-widget-content a
                  {
                    color: #222222;
                  }
                </style>


                <script>
				



              $(document).ready(function(){
				  
				  
    $.ajax({
      url: "../controller.php?action=listaturmacombo&model=turma"                              
  }).done(function(data) {
    $("#turma_id").html("");
    $("#turma_id").html('<option value="-1">Selecione uma turma</option>'+data);
});



  $('.date').datepicker({
    startView: 1,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true
});


$("#presenca_data").attr("placeholder", "Selecione uma data");


$("#turma_id").on('change',function(){

	     $.ajax({
      url: "../controller.php?action=listahorariocombo&model=turma&turma_id="+$(this).val()                              
    }).done(function(data) {
    	$("#presenca_hora").prop("disabled", false);
        $("#presenca_hora").html("");
        $("#presenca_hora").html('<option value="0">Selecione um horário</option>'+data);
    });


});

		
				$("#fm").submit(function( event ) {
					event.preventDefault();
					  var dados = $("#fm").serialize();
					  
					   $.ajax({
                                    url: "../controller.php?"+dados                            
                                  }).done(function(data) {
                                    $("#trs").html("");
                                    $("#trs").html(data);    
                                  });
                      
                    
					
					
				})




                              $('.input-group.date').datepicker({
                                format: "mm-yyyy",
								viewMode: "months", 
								minViewMode: "months"
                              });

                            });

            </script>