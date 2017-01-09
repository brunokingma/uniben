<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ultra Modern Dance</title>

    <link href="view/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="view/css/animate.css" rel="stylesheet">
    <link href="view/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">U+</h1>

            </div>
            <h3>Bem vindo</h3>
            <p>Área restrita ao profissional e alunos da Ultra Modern Dance </p>
            
            <form class="m-t" role="form" action="controller.php" method="post" id="flogin">
                <input type="hidden" name="model" value="usuario" />
                <input type="hidden" name="action" value="logar" />
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Usuário" name="login" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Senha" name="senha" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>    
                <a href="#" id="senha_"><small>Esqueci minha senha</small></a>           
            </form>


            <form class="m-t" role="form" action="controller.php" style="display:none;" method="post" id="reset">
                <input type="hidden" name="model" value="usuario" />
                <input type="hidden" name="action" value="esqueciminhasenha" />
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Resetar senha</button>    
            </form>

            <?php
            if(isset($_GET['erro'])){echo'<div class="alert alert-danger"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> Senha ou usuário inválidos  </div>';}
            ?>

            <div class="alert alert-success re" style="margin-top:15px; display:none;">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
             <span class="msg_">Uma nova senha foi enviada para o seu email.</span>
             </div>

            <p class="m-t"> <small>Ultra Modern Dance &copy; 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="view/js/jquery-2.1.1.js"></script>
    <script src="view/js/bootstrap.min.js"></script>

    <script>

    $("#senha_").on("click",function(){
        $("#flogin").fadeOut("slow", function() {
            $("#reset").fadeIn();
        });
    });

    $("#reset").submit(function(event) {         
          
          event.preventDefault();
          
          var dados = $("#reset").serialize();
          
                $.ajax({
                  method: "POST",
                  url: "controller.php",
                  data: dados
                })
                .done(function( msg ) {

                     $("#reset").fadeOut("slow", function() {
                                $("#flogin").fadeIn();
                                $(".re").fadeIn();
                     });

                    if(msg=="0"){
                        $(".msg_").html("Email não encontrado!"); 
                    }else{                       
                        $(".msg_").html("Uma nova senha foi enviada para o email <b>"+msg+"</b>");
                    }
                  
                  });

        });
    </script>

</body>

</html>
