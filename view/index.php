<?php
 require'../classes/rb.php';
 require'../classes/componente.php';
 $componente = new componente();
 $componente->verificaAutenticacao();
 ?>


<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ultra Modern Dance</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">


    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    
    <link href="css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/datapicker/jquery.datetimepicker.css" rel="stylesheet">

    <link href="css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">




</head>


<body>


    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
							<span>
									<?php
										if($_SESSION['foto'] == ''){echo ' <img alt="image" class="img-circle" width="40" src="perfil/profile_small.png" />';}else{echo '  <img alt="image"  width="60"  class="img-circle" src="perfil/'.$_SESSION['foto'].'" />';}
									?>                            
                             </span>
                             <input type="hidden" id="uid" value="<?=$_SESSION['id']?>" />
                             <input type="hidden" id="uemail" value="<?=$_SESSION['email']?>" />
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?=$_SESSION['usuario']?></strong>
                            </span> <span class="text-muted text-xs block">Perfil de <?=$_SESSION['perfil'] ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="perfil.php" class="carregaPagina">Perfil</a></li>
                                <li class="divider"></li>
                                <li><a href="../controller.php?model=usuario&action=deslogar">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            U+
                        </div>
                    </li>

                 <?php include'menu.php';?>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
           
           <?php include'topo.php';?> 

        </nav>
        </div>
               
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">

                            <div class="alert alert-success alert-dismissable hide" id="t">
                                <button aria-hidden="true"  onclick="$('#t').hide()" class="close" type="button">×</button>
                                Operação realizada com  <a class="alert-link" href="#">SUCESSO</a>.
                            </div>
                            <div class="alert alert-danger alert-dismissable hide" id="f">
                                <button aria-hidden="true"  onclick="$('#f').hide()" class="close" type="button">×</button>
                                Ocorreu um erro ao realizar operação <a class="alert-link" href="#" id="falha">FALHA NA OPERAÇÃO</a>.
                            </div>

                      <div id="conteudo">



                        <div class="row animated fadeInDown" >
                            
                                         
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Ultimos eventos</h5>
                                        </div>
                                        <div class="ibox-content">
                                        <div id="banner"></div>
 
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row animated fadeInRight" > 
                        <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Novidades</h5>
                            <div class="ibox-tools">
                               <a class="collapse-link">
                                 <i class="fa fa-chevron-up"></i>
                               </a>
                            </div>
                        </div>

                        <div id="novidades"></div>



                </div>
                    </div>                           
                                               
                                <div class="col-lg-6">
                                  <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5></h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content ibox-heading">
                                        <h3><i class="fa fa-newspaper-o"></i>  Últimos comunicados</h3>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="feed-activity-list">

                                        <div id="ultimos"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>


                            <div class="modal inmodal fade" id="modal_" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                                            <h4 class="modal-title"></h4>
                                        </div>
                                        <div class="modal-body center">
                                            <p></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                                            <button type="button" class="btn btn-primary" id="btc"  data-dismiss="modal" >Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

            </div>

                <div class="footer">
                    <div class="pull-right">
                         <strong>Copyright</strong> Ultra Modern Dance &copy; 2016-<?= date(Y) ?>
                    </div>
                </div>

        </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot 
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    -->

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
    

    <!-- jQuery mask -->
    <script src="js/jquery.mask.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

    <!-- Full Calendar -->
    <script src="js/plugins/fullcalendar/moment.min.js"></script>

    <script src="js/plugins/fullcalendar/fullcalendar.min.js"></script>

    <!-- Script do sistema -->
    <script src="js/sistema.js"></script>

    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>

   <!-- Data picker -->
   <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

      <!-- Image cropper -->
    <script src="js/plugins/cropper/cropper.min.js"></script>

        <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

  






    <script>

    function buscaComu(id){

         $.ajax({
                              url: "../controller.php?action=novidades&model=comunicado&id="+id                              
                            }).done(function(data) {
                                $("#novidades").html("");
                                $("#novidades").html(data);                                
                            }); 


    }



        $(document).ready(function() {

                            $.ajax({
                              url: "../controller.php?action=alerta&model=mensalidade"                              
                            }).done(function(data) {
                                console.log(data);
                                if(data == '1'){
                                        setTimeout(function() {
                                            toastr.options = {
                                                closeButton: true,
                                                progressBar: true,
                                                showMethod: 'slideDown',
                                                timeOut: 4000
                                            };
                                            toastr.success('Caro aluno sua mensalidade esta para vencer ou já estão vencidas.', 'Aviso de mensalidade');

                                        }, 2300);                                  
                                }
                            }); 




                    $.ajax({
                              url: "../controller.php?action=novidades&model=comunicado"                              
                            }).done(function(data) {
                                $("#novidades").html("");
                                $("#novidades").html(data);
                                if($('iframe[src*="youtube.com"]').length >0 ){                                	
                                		$('iframe[src*="youtube.com"]').css({"width":"100%","height":"393px"});
                                	}
                            }); 

                    $.ajax({
                              url: "../controller.php?action=ultimos&model=comunicado"                              
                            }).done(function(data) {
                                $("#ultimos").html("");
                                $("#ultimos").html(data);
                            });


                    $.ajax({
                              url: "../controller.php?action=banners&model=banner"                              
                            }).done(function(data) {
                                $("#banner").html("");
                                $("#banner").html(data);
                            });



                             if($('iframe[src*="youtube.com"]').length >0 ){
                                alerta(1);
                                    var v = $('iframe[src*="youtube.com"]').attr('data-aspectRatio', this.height / this.width).removeAttr('height').removeAttr('width');
                                            v.width($("#jv").width()).height($("#jv").height() * v.attr('data-aspectRatio'));
                                        }



            });



    
    <?php
    
    if($_GET['retorno'] !=''){

    	echo "$('#conteudo').load('".$_GET['retorno']."');";

    	if($_GET['dados'] =='true'){

            if($_GET['msg'] !=""){

             echo '$("#t").html("<button aria-hidden=\"true\"  onclick=\"$(\'#t\').hide()\" class=\"close\" type=\"button\">×</button>'.$_GET['msg'].'");';   
           
            }else{
                echo '$("#t").html(" <button aria-hidden=\"true\"  onclick=\"$(\'#t\').hide()\" class=\"close\" type=\"button\">×</button>Operação realizada com  <a class=\"alert-link\" href=\"#\">SUCESSO</a>.");';           
                                
            }

            echo' $(".alert-success").removeClass("hide").show(); window.history.pushState("Object", "Sucesso", "/sistema/view/index.php");';

        }else{
            echo' $(".alert-danger").removeClass("hide").show();  window.history.pushState("Object", "Erro", "/sistema/view/index.php");';
            echo' $("#falha").html("'.$_GET['msg'].'")';
        }
    }
    
    ?>


        </script>
</body>
</html>
