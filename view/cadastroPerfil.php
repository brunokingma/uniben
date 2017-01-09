<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>



                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Associação de perfil <small> formulário de associação de perfil a um usuário.</small></h5>
                        </div>
                        <div class="ibox-content">
                            <form  action="../controller.php" method="post" class="form-horizontal" >

                                    <input type="hidden" name="model" value="perfil" />
                                    <input type="hidden" name="id" id="id" value="" />
                                    <input type="hidden" name="usuario_id" id="usuario_id" value="" />
                                    <input type="hidden" name="action" value="addperfil" />
                                    <input type="hidden" name="update" id="update" value="" />


                                <div class="form-group"><label class="col-sm-4 control-label">Aluno</label>

                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                   </div>
                                </div>

	                            <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-4 control-label">Perfil</label> 

                                <div class="col-sm-8">
                                    <select class="form-control m-b" name="perfil_id" id="perfil_id" required>
                                    
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
                                        <th>Perfil</th>
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

                                    function buscaperfil(id){                        

                             $.ajax({
                              url: "../controller.php?action=listaperfil&model=perfil&id="+id                            
                            }).done(function(json) {
                                
                                var obj = eval("(" + json + ')');

                                console.log(obj);
                                $("#usuario_id").val(obj[0].usuario_id);
                                $("#perfil_id").val(  obj[0].perfil_id );
                                $("#nome").val(  obj[0].nome );
                                $("#id").val( obj[0].id );
                                $('#action').val('addperfil');
                                $('#update').val('true');

                            });
                    }





                                        function deleteperfil(id,nome){                      
                        $('.modal-title').html('Excluir a associação do perfil');
                        $('.modal-body').html('Deseja realmente excluir a associação do usuário <b>'+nome+'</b>?');

                        $('#btc').on('click',function(){
                                $.ajax({url: "../controller.php?action=deleteperfil&model=perfil&id="+id}).done(function(data) { 
                                    console.log(data);
                                $(".alert-success").removeClass("hide").show();
                                $('#conteudo').load('cadastroPerfil.php');
                            });
                        });                     
                    }




                 $(document).ready(function(){


                    $.ajax({
                              url: "../controller.php?action=listaperfiltabela&model=perfil"                              
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