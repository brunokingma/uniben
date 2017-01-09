<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Dados do Alunos<small> formulário de associação de um aluno a aula.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="turma" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="usuario_id" id="usuario_id" value="" />
                                    <input type="hidden" name="action" value="addalunodia" />
                                    <input type="hidden" name="update" id="update" value="" />


                                <div class="form-group"><label class="col-sm-4 control-label">Aluno</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                   </div>
                                </div>
								
								
                                <div class="hr-line-dashed"></div>


                                <div class="form-group"><label class="col-sm-4 control-label">Turma</label> 

                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="turma_id" id="turma_id" required >                                    
                                    </select>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>


                                <div class="form-group"><label class="col-sm-4 control-label">Horário</label> 

                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="horario_id" id="horario_id" disabled required >                                    
                                    </select>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-2 col-sm-offset-10">
                                        <button class="btn btn-primary" type="submit">Salvar</button>
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
                                        <th>Aluno</th>
                                        <th>Dias</th>
                                        <th>Horários</th>
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
                 if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}

                            function buscaalunodia(id){                        

                             $.ajax({
                              url: "../controller.php?action=listadia&model=turma&id="+id                            
                            }).done(function(json) {
								
								
                                $("#horario_id").prop('disabled', false);
								
								

                                var obj = eval("(" + json + ')');
								console.log(obj);

                                $("#usuario_id").val(obj[0].usuario_id);
                                $("#turma_id").val(  obj[0].turma_id );
								
								$.ajax({
										  url: "../controller.php?action=listahorarioaluno&model=turma&turma_id="+obj[0].turma_id                             
										}).done(function(data) {
											$("#horario_id").html("");
											$("#horario_id").html('<option value="0">Selecione um horário</option>'+data);
										});
							
                                $("#nome").val(  obj[0].nome );
                                $("#horario_id").val(obj[0].horario);
                                $("#id").val( obj[0].id );
                                $('#action').val('addalunodia');
                                $('#update').val('true');

                            });
                    }





                                        function deletealunodia(id,nome){                      
                        $('.modal-title').html('Excluir a associação');
                        $('.modal-body').html('Deseja realmente excluir a associação do aluno <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletealunodia&model=turma&id="+id}).done(function(data) { 
                                    console.log(data);
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroTurmaAluno.php');
                            });
                        });                     
                    }

					$("#turma_id").on("change",function(){
						
						$("#horario_id").prop('disabled', false);
	
							$.ajax({
                              url: "../controller.php?action=listahorarioaluno&model=turma&turma_id="+$("#turma_id").val()                              
                            }).done(function(data) {
                                $("#horario_id").html("");
                                $("#horario_id").html('<option value="0">Selecione um horário</option>'+data);
                            });
	
					});
							

                 $(document).ready(function(){
					 
					       $.ajax({
                              url: "../controller.php?action=listaturmacombo&model=turma"                              
                            }).done(function(data) {
                                $("#turma_id").html("");
                                $("#turma_id").html('<option value="0">Turmas</option>'+data);
                              });

                    $.ajax({
                              url: "../controller.php?action=listalunodia&model=turma"                              
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });




                        $( "#nome" ).autocomplete({
                              source: "../controller.php?action=listaalunos&model=usuario&nome="+$("#nome").val(),
                              minLength: 3,
                                       
                               messages: {
                                    noResults: '',
                                    results: function() {}
                                },
                                    select: function(event, ui) {
                                        event.preventDefault();
                                        $("#nome").val(ui.item.label);
                                        $("#usuario_id").val(ui.item.value);
                                    },                                    
                                    focus: function(event, ui) {
                                        event.preventDefault();
                                        $("#nome").val(ui.item.label);
                                    }
                            });
		             });

                </script>