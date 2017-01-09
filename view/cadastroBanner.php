<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>


                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastro de banner <small>  Formulário para cadastros do banner informativo da pagina principal.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" enctype="multipart/form-data"  >

                                    <input type="hidden" name="model" value="banner" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="foto_i" id="foto_i" value="" />
                                    <input type="hidden" name="action" value="addbanner" />
                                    <input type="hidden" name="update" id="update" value="" />




                                <div class="form-group"><label class="col-sm-2 control-label">Título</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="titulo" name="titulo"  required>                                    
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

                                    function buscabanner(id){                        

                             $.ajax({
                              url: "../controller.php?action=listabanner&model=banner&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');
                            
                                $("#titulo").val(  obj[0].titulo );
                                $("#id").val( obj[0].banner_id );
                                $("#foto").html( obj[0].banner);
                                $("#foto_i").val( obj[0].banner);
                                $('#action').val('addbanner');
                                $('#update').val('true');

                            });
                    }





                         function deletebanner(id,nome){                      
                        $('.modal-title').html('Excluir banner');
                        $('.modal-body').html('Deseja realmente excluir o banner: <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deletebanner&model=banner&id="+id}).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroBanner.php');
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
                              url: "../controller.php?action=listabannertabela&model=banner"                              
                            }).done(function(data) {
                                $("#trs").html("");
                                $("#trs").html(data);
                            });

		             });

                </script>