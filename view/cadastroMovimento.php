<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastros <small> formulário de cadastro de movimentos.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" enctype="multipart/form-data" >

                                    <input type="hidden" name="model" value="movimento" />
                                    <input type="hidden" name="id" value="" />
                                    <input type="hidden" name="action" value="addmovimento" />
                                    <input type="hidden" name="foto_i" id="foto_i" value="" />

                                <div class="form-group"><label class="col-sm-2 control-label">Nível</label> 

                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="nivel" id="nivel"  required>
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

                                <div class="form-group"><label class="col-sm-2 control-label">Nome</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                    <input type="hidden" class="form-control" id="id" name="id"  required>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-12"> 
                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" accept="image/*" name="inputImage" id="inputImage" class="hide" >
                                         <i class="fa  fa-file-image-o"></i> Selecionar uma imagem
                                        </label>                                   
                                    </div>
                                </div>

                                <span id="foto"></span>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Descrição</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="descricao" name="descricao"  required></textarea>                                
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

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Nível</th>                                        
                                        <th>Foto</th>                                        
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






                <script>
                if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}


                                    function buscamovimento(id, nivel_id){                        

                             $.ajax({
                              url: "../controller.php?action=listamovimento&model=movimento&id="+id+"&nivel_id"+nivel_id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');
                                $("#nivel").val( obj[0].nivel_id );
                                $("#nome").val(  obj[0].movimento_nome );
                                $("#foto").html( obj[0].foto);
                                $("#foto_i").val( obj[0].foto);
                                $("#descricao").val(  obj[0].descricao );
                                $("#id").val( obj[0].movimento_id );
                                $('#action').val('addmovimento');

                            });
                    }





                                        function deletemovimento(id,nome){                      
                        $('.modal-title').html('Excluir nível do usuário');
                        $('.modal-body').html('Deseja realmente excluir o nível para esse usuário <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletemovimento&model=movimento&id="+id}).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroMovimento.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){

                    $('#inputImage').on('click',function(){                                
                                $("#foto").html(" ");                             
                        }); 

                    $.ajax({
                              url: "../controller.php?action=listamovimentotabela&model=movimento"                              
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