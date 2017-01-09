<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>


                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastro de fotos <small> formulário para cadastros das fotos de acordo com cada nível.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" enctype="multipart/form-data"  >

                                    <input type="hidden" name="model" value="foto" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="fotonivel_id" id="fotonivel_id" value="" />
                                    <input type="hidden" name="foto_i" id="foto_i" value="" />
                                    <input type="hidden" name="action" value="addfoto" />
                                    <input type="hidden" name="update" id="update" value="" />


                               
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

                                <div class="form-group"><label class="col-sm-2 control-label">Título</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="titulo" name="titulo"  required>                                    
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                   <div class="form-group"><label class="col-sm-2 control-label">Descrição</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="descricao" name="descricao"  required></textarea>
                                    </div>
                                </div>

                                 <div class="hr-line-dashed"></div>


                                
                                <div class="form-group">
                                    <div class="col-sm-12"> 
                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" accept="image/*" name="inputImage" id="inputImage" class="hide" required>
                                         <i class="fa  fa-file-image-o"></i> Selecionar uma imagem
                                        </label>                                   
                                    </div>
                                </div>

                                <span id="foto"></span>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-9">
                                        <button class="btn btn-primary a" type="submit"><i class="fa fa-cloud-upload"></i>  Salvar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="progress progress-striped active hide">
                                <div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="75" role="progressbar" class="progress-bar progress-bar-danger">
                                    <span class="sr-only">100% Complete (success)</span>
                                </div>
                            </div>
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
                                        <th>Título</th>
                                        <th>Imagem</th>
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

                                    function buscafoto(id){                        

                             $.ajax({
                              url: "../controller.php?action=listafoto&model=foto&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');

                                $("#nivel").val(obj[0].nivel_id);
                                $("#titulo").val(  obj[0].titulo );
                                $("#descricao").val(  obj[0].descricao );
                                $("#id").val( obj[0].foto_id );
                                $("#fotonivel_id").val( obj[0].fotonivel_id );
                                $("#foto").html( obj[0].foto);
                                $("#foto_i").val( obj[0].foto);
                                $('#action').val('addfoto');
                                $('#update').val('true');

                            });
                    }





                         function deletefoto(id,id2,nome){                      
                        $('.modal-title').html('Excluir foto');
                        $('.modal-body').html('Deseja realmente excluir a foto: <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletefoto&model=foto&id="+id+"&id2="+id2}).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastraFotos.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){



                     $("#inputImage").change(function (){
                           $("#foto").html($(this).val());
                         });


                    $('.a').on('click',function(){                                
                                $(".active").removeClass("hide").fadeIn();                             
                        }); 


                   $('#inputImage').on('click',function(){                                
                                $("#foto").html(" ");                             
                        }); 


                    $.ajax({
                              url: "../controller.php?action=listafototabela&model=foto"                              
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });


                               $.ajax({
                              url: "../controller.php?action=listaperfilcombo&model=perfil"                              
                            }).done(function(data) {
                                $("#perfil_id").html("");
                                $("#perfil_id").html('<option value="0">Selecione um perfil</option>'+data);
                            });


		             });

                </script>