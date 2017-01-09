<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>


                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Cadastro de eventos <small> formulário para cadastros de eventos.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" enctype="multipart/form-data"  >

                                    <input type="hidden" name="model" value="evento" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="action" value="addevento" />
                                    <input type="hidden" name="update" id="update" value="" />




                                <div class="form-group"><label class="col-sm-2 control-label">Data </label>
                                     <div class="col-sm-10">
                                        <div class="input-group date">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="data"  id="data" value="" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Título</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="titulo" name="titulo"  required />                                    
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>



                                  <div class="form-group"><label class="col-sm-6 control-label">Cor TAG</label>
                                     <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"></i></span><input type="text" class="form-control" name="color"  id="color" value=""  required>
                                        </div>
                                    </div>
                                </div>



                                <div class="hr-line-dashed"></div>

                                   <div class="form-group"><label class="col-sm-2 control-label">Descrição</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="descricao" name="descricao"  required ></textarea>
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>



                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-9">
                                        <button class="btn btn-primary a" type="submit"><i class="fa fa-floppy-o"></i>  Salvar</button>
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
                                        <th>Data</th>
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

                                    function buscaevento(id){                        

                             $.ajax({
                              url: "../controller.php?action=listaevento&model=evento&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');

                                $("#titulo").val(  obj[0].titulo );
                                $("#descricao").val(  obj[0].descricao );
                                $("#id").val( obj[0].evento_id );
                                $('#action').val('addevento');
                                $('#update').val('true');
                                $("#data").attr( 'placeholder', obj[0].data );
                                $("#data").removeAttr( 'required' );

                            });
                    }





                         function delete_(id,nome){                      
                        $('.modal-title').html('Excluir evento');
                        $('.modal-body').html('Deseja realmente excluir o evento: <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deleteevento&model=evento&id="+id}).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroEvento.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){

           $('#color').colorpicker();


                    $.ajax({
                              url: "../controller.php?action=listaeventotabela&model=evento"                              
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