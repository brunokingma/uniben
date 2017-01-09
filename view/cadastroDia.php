<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>




                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros <small> formulário de cadastro de aulas.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="dia" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="action" value="adddia" />
                                    <input type="hidden" name="update" id="update" value="" />


                                <div class="form-group">
                                <label class="col-sm-4 control-label">Dia da semana</label>
                                     <div class="col-sm-8">
                                            <select class="form-control m-b" name="dia" id="dia" required>
                                                <option value="0">Selecione o dia</option>
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
								
								<div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-4 control-label">Turma</label> 

                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="turma_id" id="turma_id">
                                    
                                    </select>
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
                                        <th>Dia</th>
                                        <th>Inicío</th>
                                        <th>Termino</th> 
                                        <th>Turma</th> 
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

                                    function buscadia(id, turma_id, inicio,termino){                        

                          

                              
                                $("#id").val( id );
                                $('#action').val('adddia');
                                $('#update').val('true');
                                $('#dia').val(id);
                                $('#inicio').val(inicio);
                                $('#turma_id').val(turma_id);
                                $('#termino').val(termino);

                    }



                              



                                 function deletedia(id,nome){                      
                        		$('.modal-title').html('Excluir dia');
                        		$('.modal-body').html('Deseja realmente excluir o dia <b>'+nome+'</b>?');

                        		$('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletedia&model=dia&id="+id}).done(function(data) { 
                                    console.log(data);
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroDia.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){


                                                    $('#inicio, #termino').datetimepicker({
                                                              datepicker:false,
                                                              format:'H:i',
                                                              step: 30
                                                            });
                    
					   
					   
                               $.ajax({
                              url: "../controller.php?action=listaturmacombo&model=turma"                              
                            }).done(function(data) {
                                $("#turma_id").html("");
                                $("#turma_id").html('<option value="0">Selecione uma turma</option>'+data);
                            });


                    $.ajax({
                              url: "../controller.php?action=listadiatabela&model=dia"                              
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