<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros <small> formulário de cadastro de tipos de Planos.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="modalidade" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="action" value="addmodalidade" />
                                    <input type="hidden" name="update" id="update" value="" />


                                <div class="form-group"><label class="col-sm-6 control-label">Nome do plano</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="nome" name="nome"  required>
                                    </div>
                                </div>

<!--
                                <div class="hr-line-dashed"></div>



                                <div class="form-group">
                                <label class="col-sm-4 control-label">Dias da semana</label>
                                     <div class="col-sm-8">
                                        <div class="input-group">
                                            <select data-placeholder="Selecione os dias" class="chosen-select"  multiple style="width:300px;" tabindex="4" name="dias[]" id="dias" required>
                                                <option value="0">Selecione os dias</option>
                                                <option value="Monday">Segunda</option>
                                                <option value="Tuesday">Terça</option>
                                                <option value="Wednesday">Quarta</option>
                                                <option value="Thursday">Quinta</option>
                                                <option value="Friday">Sexta</option>
                                                <option value="Saturday">Sabado</option>
                                                <option value="Sunday">Domingo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-6 control-label">Início</label> 

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="inicio" name="inicio"  required>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-6 control-label">Término</label> 

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="termino" name="termino"  required>
                                    </div>
                                </div>


-->
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-6 control-label">Valor</label> 

                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="valor" name="valor"  required>
                                    </div>
                                </div>

<!--
                                <div class="hr-line-dashed"></div>


                                  <div class="form-group"><label class="col-sm-6 control-label">Cor TAG</label>
                                     <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span><input type="text" class="form-control" name="color"  id="color" value=""  required>
                                        </div>
                                    </div>
                                </div>

-->
                                <div class="hr-line-dashed"></div>




                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-9">
                                        <button class="btn btn-primary" type="submit"> Salvar <i class="fa fa-floppy-o"></i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Alterar dados</h5>
                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive">
                                <table class="table table-striped"> 
                                    <thead>
                                    <tr>
                                        <th>Nome do plano</th>
 <!--                                   <th>Dias</th>
                                        <th>Inicío</th>
                                        <th>Termino</th> -->
                                        <th>Valor</th>
                                     <!--   <th>Cor</th> -->
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody  id="trs">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

 
   <script src="js/plugins/datapicker/jquery.datetimepicker.full.js"></script>

    <!-- Color picker -->
    <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

                <script>
                 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}

                                    function buscamodalidade(id, nivel_id, ids,i,t){                        

                             $.ajax({
                              url: "../controller.php?action=listamodalidade&model=modalidade&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');

                                $("#nome").val(  obj[0].nome );
                                $("#valor").val(  obj[0].valor );
                                $("#id").val( obj[0].id );
                                $('#action').val('addturno');
                                $('#update').val('true');
                                $('#dias').val(ids.split("|"));
                                $('#dias').trigger("chosen:updated");
                                $('#inicio').val(i);
                                $('#termino').val(t);

                            });
                    }



                              



                                 function deletemodalidade(id,nome){                      
                        		$('.modal-title').html('Excluir modalidade');
                        		$('.modal-body').html('Deseja realmente excluir a modalidade <b>'+nome+'</b>?');

                        		$('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletemodalidade&model=modalidade&id="+id}).done(function(data) { 
                                    console.log(data);
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroModalidade.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){

                      $('#color').colorpicker();

                                                    $('#inicio, #termino').datetimepicker({
                                                              datepicker:false,
                                                              format:'H:i',
                                                              step: 30
                                                            });
                    
                       $('#valor').mask("#.##0,00", {reverse: true});


                    $.ajax({
                              url: "../controller.php?action=listamodalidadetabela&model=modalidade"                              
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });



		            var config = {
		                '.chosen-select'           : {},
		                '.chosen-select-deselect'  : {allow_single_deselect:true},
		                '.chosen-select-no-single' : {disable_search_threshold:10},
		                '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		                '.chosen-select-width'     : {width:"95%"}
		            }
		            for (var selector in config) {
		                $(selector).chosen(config[selector]);
		                 }


				        $('.input-group.date').datepicker({
			                todayBtn: "linked",
			                keyboardNavigation: false,
			                forceParse: false,
			                calendarWeeks: true,
			                autoclose: true
		            	});


		             });

                </script>