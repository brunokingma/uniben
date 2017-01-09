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
        <input type="hidden" name="action" value="mensalidade" />

                              <div class="form-group">
                                <label for="vencimento" class="sr-only">Data de vencimento</label>
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input type="text" placeholder="Mês de vencimento" name="vencimento" id="vencimento" class="form-control " value="" style="width: 200px;" required>
                                </div>
                              </div>
							  
							  
                       <div class="form-group">
                                <label for="turma" class="sr-only">Turma</label> 
                                <select name="pagamento" id="pagamento" class="form-control" style="width: 200px;" required>
                                  <option value="-1">Status de pagamento</option>
                                  <option value="isnull">Não pagos</option>
                                  <option value="isnotnull">Pagos</option>
                                </select> 
                              </div>


                            </form>							
		
    <div class="hr-line-dashed"></div>

                       <div class="table-responsive">
                        <table class="table table-striped" >
                          <thead>
                            <tr>
                              <th>Aluno</th>
                              <th>Data de vencimento</th>
                              <th>Valor</th>
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