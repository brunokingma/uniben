<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros <small> formulário de cadastro de histórico.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="usuario" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="action" value="addalunonivel" />
                                    <input type="hidden" name="update" id="update" value="" />

                                <div class="form-group"><label class="col-sm-2 control-label">Nível</label> 

                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="nivel" id="nivel" required >
                                    <option value="0">Selecione um nível</option>
                                        <option value="1">Básico 1</option>
                                        <option value="2">Básico 2</option>
                                        <option value="3">Básico 3</option>
                                        <option value="4">Intermediário 1</option>
                                        <option value="5">Intermediário 2</option>
                                        <option value="6">Intermediário 3</option>
                                        <option value="7">Avançado 1</option>
                                        <option value="8">Avançado 2</option>
                                        <option value="9">Avançado 3</option>
                                        <option value="10">Especialização</option>
                                    </select>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Aluno</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" name="nome" required />
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>


	                            <div class="form-group"><label class="col-sm-2 control-label">Data</label>
		                             <div class="col-sm-10">
		                                <div class="input-group date">
		                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="matricula"  id="matricula"value="" required />
		                                </div>
		                            </div>
	                            </div>

	                            <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
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


                           <form action="../controller.php" method="post" class="form-horizontal">
                                <div class="input-group">
	                                <input type="text" class="form-control" id="busca"> 
	                                <span class="input-group-btn"> 
	                                <button type="button" class="btn btn-primary bus">Buscar por aluno</button>
	                                </span>
                                </div>
                            </form>
							<div class="hr-line-dashed"></div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Aluno</th>
                                        <th>Data</th>
                                        <th>Nível</th>                                        
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

                                    function buscaalunonivel(id, nivel_id){                        

                             $.ajax({
                              url: "../controller.php?action=listaalunouniconivel&model=usuario&id="+id+"&nivel_id"+nivel_id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');
                                $("#nivel").val( obj[0].nivel );
                                $("#matricula").val(  obj[0].matricula );
                                $("#nome").val(  obj[0].nome );
                                $("#id").val( obj[0].usuario_id );
                                $('#action').val('addalunonivel');
                                $('#update').val('true');

                            });
                    }





                                        function deletealunonivel(id,nome){                      
                        $('.modal-title').html('Excluir nível do usuário');
                        $('.modal-body').html('Deseja realmente excluir o nível para esse usuário <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletealunonivel&model=usuario&id="+id}).done(function(data) { 
                                    console.log(data);
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroHistorico.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){


                    $(".bus").on('click', function(event){
                        event.preventDefault();

                             $.ajax({
                              url: "../controller.php?action=listaalunotabela&model=usuario&aluno="+$("#busca").val()                             
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });

                    });




                    $.ajax({
                              url: "../controller.php?action=listaalunotabelanivel&model=usuario"                              
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
                                        $("#id").val(ui.item.value);
                                    },                                    
                                    focus: function(event, ui) {
                                        event.preventDefault();
                                        $("#nome").val(ui.item.label);
                                    }
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