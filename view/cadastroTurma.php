<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros <small> formulário de cadastro de turmas.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="turma" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="action" value="addturma" />
                                    <input type="hidden" name="update" id="update" value="" />


                                <div class="form-group"><label class="col-sm-5 control-label">Turma</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nome" name="nome"  required>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>
<!--


                                <div class="form-group"><label class="col-sm-3 control-label">Modalidade</label> 

                                <div class="col-sm-7">
                                    <select class="form-control m-b" name="modalidade" id="modalidade" required >                                    
                                    </select>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

-->
	                            <div class="form-group"><label class="col-sm-5 control-label">Mês de início da turma</label>
		                             <div class="col-sm-5">
		                                <div class="input-group date">
		                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" placeholder="" class="form-control" name="inicio"  id="inicio" value=""  required>
		                                </div>
		                            </div>
	                            </div>


                                <div class="hr-line-dashed"></div>


                                <div class="form-group"><label class="col-sm-5 control-label">Mês de término da turma</label>
                                     <div class="col-sm-5">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"  placeholder="" class="form-control" name="fim"  id="fim" value=""  required>
                                        </div>
                                    </div>
                                </div>

	                            <div class="hr-line-dashed"></div>


                                  <div class="form-group"><label class="col-sm-5 control-label">Cor TAG</label>
                                     <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span><input type="text" class="form-control" name="color"  id="color" value=""  required>
                                        </div>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>


                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-8">
                                        <button class="btn btn-primary" type="submit"> Salvar  <i class="fa fa-floppy-o"></i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-7">
                                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Alterar dados</h5>
                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Turma</th>
                                        <th>Data início</th>                                        
                                        <th>Data término</th>                                        
                                        <th>Cor</th>
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


    <!-- Color picker -->
    <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>


                <script>
                 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}

                                    function buscaturma(id, nivel_id){                        

                             $.ajax({
                              url: "../controller.php?action=listaturma&model=turma&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');
                                $("#nome").val(  obj[0].nome );
                                $("#inicio").attr( 'placeholder', obj[0].inicio );
                                $("#fim").attr( 'placeholder',  obj[0].fim );
                                $("#id").val( obj[0].id );
                                $("#color").val( obj[0].color );
                             //   $("#modalidade").val( obj[0].modalidade_id);
                                $('#action').val('addturma');
                                $('#update').val('true');

                                $("#inicio").removeAttr( 'required' );
                                $("#fim").removeAttr( 'required' );

                            });
                    }





                                        function deleteturma(id,nome){                      
                        $('.modal-title').html('Excluir turma');
                        $('.modal-body').html('Deseja realmente excluir a turma <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deleteturma&model=turma&id="+id}).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroTurma.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){

                    $('#color').colorpicker();

/*
                     $.ajax({
                              url: "../controller.php?action=listamodalidadecombo&model=modalidade"                              
                            }).done(function(data) {
                                $("#modalidade").html("");
                                $("#modalidade").html('<option value="0">Selecione uma modalidade</option>'+data);
                            });
*/


                    $.ajax({
                              url: "../controller.php?action=listaturmatabela&model=turma"                              
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });



				        $('.input-group.date').datepicker({
			                todayBtn: "linked",
			                keyboardNavigation: false,
			                forceParse: false,
			                calendarWeeks: true,
			                autoclose: true
		            	});

		             });

                </script>