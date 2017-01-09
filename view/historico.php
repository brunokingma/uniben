           <div class="row animated fadeInRight">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content" id="ibox-content">

                        <div id="vertical-timeline" class="vertical-container dark-timeline center-orientation" >
                        <div id="h"></div>

                        </div>
                    </div>
                    
                </div>

                </div>
            </div>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>


            <script>
                            $.ajax({
                              url: "../controller.php?action=lista&model=historico&id="+$("#uid").val()                              
                            }).done(function(data) {
                                $("#h").html("");
                                $("#h").html(data);   
                                 $("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false, modal: true, allow_resize: true, show_title: false});                             
                            }); 

            </script>