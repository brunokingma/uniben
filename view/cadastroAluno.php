<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros de alunos <small> formulário de cadastro e alteração de dados.</small></h5>
                        </div>
                        <div class="ibox-content">

                            <form action="../controller.php" method="post" class="form-horizontal">

                            	    <input type="hidden" name="model" value="usuario" />
                            	    <input type="hidden" name="id" id="id" value="" />
                            	    <input type="hidden" name="telefone_id" id="telefone_id" value="" />
                            	    <input type="hidden" name="endereco_id" id="endereco_id" value="" />
                                    <input type="hidden" name="action" id="action" value="addaluno" />

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Nome</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="nome"  id="nome" required></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Data de nascimento </label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="nascimento" id="nascimento" required></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Email</label>
	                                    <div class="col-sm-8"><input  type="email" class="form-control" name="email"  id="email" required></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Telefone</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="telefone" id="telefone" required></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">CEP</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="cep" id="cep"></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Endereço</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="rua" id="rua"></div>
	                                </div>
	                                
	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Número</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="numero" id="numero"></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Complemento</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="complemento" id="complemento"></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Bairro</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="bairro" id="bairro"></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Cidade</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="cidade" id="cidade"></div>
	                                </div>

	                                <div class="form-group">
	                                	<label class="col-sm-4 control-label">Estado</label>
	                                    <div class="col-sm-8"><input type="text" class="form-control" name="estado" id="estado"></div>
	                                </div>


                              
 								<div class="hr-line-dashed"></div>

                                <div class="form-group">

                                <label class="col-sm-4 control-label"></label>
                                <div class="col-sm-8">
                                  <button class="btn btn-primary" type="submit"> Salvar cadastro <i class="fa fa-floppy-o"></i></button>
                                </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                                     <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Informações do aluno e alteração de dados</h5>
                        </div>
                        <div class="ibox-content">


                           <form action="../controller.php" method="post" class="form-horizontal">
                                <div class="input-group">
	                                <input type="text" class="form-control" id="busca" required /> 
	                                <span class="input-group-btn"> 
	                                <button type="button" class="btn btn-primary bus">Buscar por aluno <i class="fa fa-search"></i></button>
	                                </span>
                                </div>
                            </form>
							<div class="hr-line-dashed"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Aluno</th>
                                        <th>Data Matrícula</th>
                                        <th style="text-align:center;">Detalhes</th>
                                        <th style="text-align:center;">Status</th>
                                        <th style="text-align:center;">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody id="trs">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <script>
                
                 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}


                 function status(id, status){

                 	  $.ajax({
							  url: "../controller.php?action=updatestatus&model=usuario&id="+id+"&status="+status						  
							}).done(function(data) {
								$("#trs").html("");
							 	$("#trs").html(data);
							});


                 }

                	function buscaaluno(id,endereco_id,telefone_id){                		

                 		     $.ajax({
							  url: "../controller.php?action=listaalunounico&model=usuario&id="+id							  
							}).done(function(json) {

								
								var obj = eval("(" + json + ')');

								console.log(obj);

								$('#action').val('updatealuno');

							    $("#cep").val( obj[0].cep );
					            $("#estado").val(  obj[0].estado );
					            $("#cidade").val(  obj[0].cidade );
					            $("#bairro").val(  obj[0].bairro );
					            $("#rua").val(  obj[0].rua );
					            $("#nome").val(  obj[0].nome );
					            $("#nascimento").val(  obj[0].nascimento );
					            $("#complemento").val(  obj[0].complemento );
					            $("#numero").val(  obj[0].numero );
					            $("#email").val(  obj[0].email );
					            $("#telefone").val( obj[0].tel );
					            $("#id").val( id );
					            $("#telefone_id").val( telefone_id );
					            $("#endereco_id").val( endereco_id );
					            

							});
                 	}
                 	
                 	function deletealuno(id,nome){                		
                 		$('.modal-title').html('Excluir usuário');
                 		$('.modal-body').html('Deseja realmente excluir o usuário <b>'+nome+'</b>?');

                 		$('#btc').show(); 	

                 		$('#btc').on('click',function(){
                 				$.ajax({url: "../controller.php?action=deletealuno&model=usuario&id="+id}).done(function(data) { 
	                 			$(".alert-success").removeClass("hide").show();
	                 			$('#conteudo').load('cadastroAluno.php');
	                 		});
                 		});	         		    
                 	}



                 	function detalhes(id){                		
                 		$('.modal-title').html('Detalhes');


                 		 $.ajax({
							  url: "../controller.php?action=listaalunounico&model=usuario&id="+id							  
							}).done(function(json) {
								
								var obj = eval("(" + json + ')');


								$('.modal-body').html(
									'<b>Nome:</b> ' +obj[0].nome+'<br/><div class="hr-line-dashed"></div>'+
									'<b>Data de nascimento:</b> ' +obj[0].nascimento+'<br/><div class="hr-line-dashed"></div>'+
									'<b>Telefone:</b> ' +obj[0].tel+'<br/><div class="hr-line-dashed"></div>'+
									'<b>Email:</b> ' +obj[0].email+'<br/><div class="hr-line-dashed"></div>'+
									'<b>Endereço:</b> ' +obj[0].rua +' '+ obj[0].complemento+' - '+obj[0].bairro+' - '+obj[0].cidade+' - '+obj[0].estado+'<br/><div class="hr-line-dashed"></div>'+
									'<b>CEP:</b> ' +obj[0].cep
									);
							});
                 		

                 		$('#btc').hide(); 		    
                 	}


                 $(document).ready(function(){

					$('#telefone').mask("(99)99999.9999");
					$('#nascimento').mask("99/99/9999");

                 	$(".bus").on('click', function(event){
                 		event.preventDefault();

                 		     $.ajax({
							  url: "../controller.php?action=listaalunotabela&model=usuario&aluno="+$("#busca").val()							  
							}).done(function(data) {
								$("#trs").html("");
							 	$("#trs").html(data);
							});

                 	});



					jQuery(function($){
					   $("#cep").change(function(){
					      var cep_code = $(this).val();
					      if( cep_code.length <= 0 ) return;
					      $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
					         function(result){
					            if( result.status!=1 ){
					                $(".alert-danger").removeClass("hide").show(); 
             						$("#falha").html("Cep não encontrado! O CEP deve conter apenas numeros!")
					               return;
					            }
					            $("#cep").val( result.code );
					            $("#estado").val( result.state );
					            $("#cidade").val( result.city );
					            $("#bairro").val( result.district );
					            $("#rua").val( result.address );
					            $("#estado").val( result.state );
					         });
					   });
					});


                 

                 	$.ajax({
							  url: "../controller.php?action=listaalunotabela&model=usuario"							  
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

		            	          $('#nascimento').datepicker({
					                todayBtn: "linked",
					                keyboardNavigation: false,
					                forceParse: false,
					                calendarWeeks: true,
					                autoclose: true
					            });

		             });

                </script>