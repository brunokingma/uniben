

            <div class="col-lg-12 animated fadeInRight">
            <div class="mail-box-header">

                <h2>
                    Contato
                </h2>
            </div>
                <div class="mail-box">


                <div class="mail-body">

                    <form class="form-horizontal">
                        <input type="hidden" name="model" value="email" />
                        <input type="hidden" name="action" value="enviaemail" />

                        <div class="form-group"><label class="col-sm-2 control-label">To:</label>
                            <div class="col-sm-10"><input type="email" class="form-control" id="nome" name="nome" required></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Assunto:</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="assunto" id="assunto" value="" required></div>
                        </div>                      

                </div>

                    <div class="mail-text h-200">
                    <textarea id="msg" name="msg" class="form-control" style="height:200px; border: none;" required></textarea>
                            <div class="clearfix"></div>
                    </div>

                    <div class="mail-body text-right">
                        <input type="submit" class="btn btn-sm btn-primary send" />
                    </div>

                    <div class="clearfix"></div>

                    </form>

                </div>
            </div>
    
    <!-- SUMMERNOTE -->
    <script src="js/plugins/summernote/summernote.min.js"></script> 

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
            z-index: 9999999999999999;
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
        $(document).ready(function(){


                            $('.send').on('click', function(event){
                                event.preventDefault();
                                $.ajax({url: "../controller.php?action=enviaemail&model=mail&uemail="+$('#uemail').val()).done(function(data) { 
                                $(".alert-success").removeClass("hide").show();
                                $("#t").html("Email enviado com sucesso.");                          
                            });


       

                            $( "#nome" ).autocomplete({
                              source: "../controller.php?action=listaalunosemail&model=usuario&nome="+$("#nome").val(),
                              minLength: 3,
                                       
                               messages: {
                                    noResults: '',
                                    results: function() {}
                                },
                                    select: function(event, ui) {
                                        console.log($("#nome").val(ui.item.value)); 
                                        event.preventDefault();
                                        $("#nome").val(ui.item.value);
                                    },                                    
                                    focus: function(event, ui) {
                                        event.preventDefault();
                                        $("#nome").val(ui.item.value);
                                    }
                            });
        });

        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };

        var save = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
            $('.click2edit').destroy();

        };

    </script>


