        <div class="row animated fadeInRight" >  
        <div id="h"></div> 

         </div>     

                     <script>
                            $.ajax({
                              url: "../controller.php?action=listamovimentoview&model=movimento&id="+$("#uid").val()                              
                            }).done(function(data) {
                                $("#h").html("");
                                $("#h").html(data);  
                            }); 

            </script>