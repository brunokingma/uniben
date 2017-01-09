        <?php
        require'../classes/componente.php';
        $componente = new componente();
        $componente->verificaAutenticacao();
        ?>

   
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title  back-change">
                        <h5>Perfil</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-crop">
                                    <?php
                                        if($_SESSION['foto'] == ''){echo ' <img src="perfil/default-user-image.png">';}else{echo ' <img src="perfil/'.$_SESSION['foto'].'">';}
                                    ?>                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                             <form enctype="multipart/form-data" class="form-horizontal" action="../controller.php" method="post">
                                <h4>Preview da imagem</h4>
                                <div class="img-preview img-preview-sm"></div>
                                <h4></h4>
                                <div class="btn-group">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="inputImage" id="inputImage" class="hide">
                                        Enviar nova imagem
                                    </label>
                                </div>

                            <div class="ibox-content" style="margin-top:15px;">
                           
                                <input type="hidden" name="model" value="usuario" />
                                <input type="hidden" name="action" value="atualizaperfil" />
                                <input type="hidden" name="id" value="<?=$_SESSION['id']?>" />
                                <input type="hidden" id="formato" name="formato" value="" />
                                <div class="form-group"><label class="col-lg-2 control-label">Nome</label>
                                    <div class="col-lg-10"><input type="text" name="nome" value="<?=$_SESSION['usuario']?>" class="form-control"></div>
                                </div>
                                 <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10"><input type="email"  value="<?=$_SESSION['email'] ?>" name="email" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Login</label>
                                    <div class="col-lg-10"><input type="text" disabled value="<?=$_SESSION['login']?>" name="login" class="form-control"></div>
                                </div>
                                <div class="form-group"><label class="col-lg-2 control-label">Data de nascimento</label>
                                    <div class="col-lg-10"><input type="text" value="<?=$_SESSION['datanascimento']?>" id="datanascimento" name="datanascimento" class="form-control"></div>
                                </div>

                                <div class="form-group"><label class="col-lg-2 control-label">Senha</label>
                                    <div class="col-lg-10"><input type="password" placeholder="Password" name="password" class="form-control"></div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button class="btn btn-primary" type="submit">Alterar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    <script>
        $(document).ready(function(){

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1/1,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                    $('#formato').val(JSON.stringify(data));
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function(event) {
                    var tmppath = URL.createObjectURL(event.target.files[0]);
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                          //  $inputImage.val(""); 
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Por favor escolha uma nova imagem.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

        });

                    $('#datanascimento').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
    </script>
