<?php
require'../classes/componente.php';
$componente = new componente();
$componente->verificaAutenticacao();
?>


<div class="col-lg-12">
  <div class="ibox float-e-margins">

  <form id="fm" action="../controller.php" method="post" class="form-inline" >

    <div class="ibox-title" style="height:70px;">
      <h5>Cadastros <small> formulário de cadastro de mensalidades.</small></h5>
	  <button class="btn btn-primary pull-right" id="bt_" type="submit"><i class="fa fa-check"></i> Gerar mensalidades</button>
    </div>
    <div class="ibox-content">



        <input type="hidden" name="model" value="mensalidade" />
        <input type="hidden" name="id" value="" id="" />
        <input type="hidden" name="usuario_id" value="" id="usuario_id" />
        <input type="hidden" name="action" value="addmensalidade" />
        <input type="hidden" name="update" id="update" value="" />

                               

                               <div class="form-group">
                                <label for="nome" class="sr-only">Aluno</label>
                                <input type="text" placeholder="Nome do aluno" name="nome" id="nome" class="form-control" required>
                              </div>


                              <div class="form-group">
                                <label for="turma" class="sr-only">Turma</label> 
                                <select name="turma" id="turma" class="form-control" style="width: 120px;" required>
                                  <option value="-1">Turma</option>
                                </select> 
                              </div>


                              <div class="form-group">
                                <label for="modalidade_id" class="sr-only">Plano</label> 
                                <select name="modalidade_id" id="modalidade_id" class="form-control" style="width: 200px;" disabled="true" required>
                                  <option value="-1">Planos</option>
                                </select> 
                              </div>


                              <div class="form-group">
                                <label for="desconto" class="sr-only">Valor de desconto</label> 
                                <input type="text" name="desconto" placeholder="Desconto" id="desconto" class="form-control desc" style="width: 90px;">
                              </div>


                              <div class="form-group">
                                <label for="desconto" class="sr-only">Valor extra</label> 
                                <input type="text" name="extra" placeholder="Extra" id="extra" class="form-control desc" style="width: 90px;">
                              </div>



                              <div class="form-group">
                                <label for="matricula" class="sr-only">Data da matrícula</label>
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input  type="text" placeholder="Matrícula" name="matricula" id="matricula" class="form-control " value="" style="width: 100px;" required>
                                </div>
                              </div>


                              <div class="form-group">
                                <label for="vencimento" class="sr-only">Data de vencimento</label>
                                <div class="input-group date">
                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  <input type="text" placeholder="Vencimento" name="vencimento" id="vencimento" class="form-control " value="" style="width: 110px;" required>
                                </div>
                              </div>

                            </form>							
							
                          </div>
					  
                        </div>					
                      </div>

                      <div class="col-lg-12">
                       <div class="ibox float-e-margins">
                        <div class="ibox-title">
                          <h5>Mensalidades</h5>
                        </div>
                        <div class="ibox-content">

                         <form  action="../controller.php" method="post" class="form-horizontal" >
                          <div class="input-group">
                            <input type="text" class="form-control" id="busca" name="busca" required> 
                            <span class="input-group-btn"> 
                              <button type="submit" class="btn btn-primary" id="btbusca"><i class="fa fa-search"></i> Buscar mensalidades </button>
                            </span>
                          </div>
                        </form>


                        <div style="height: 35px; margin-top: 20px; display: none;" id="box_excluir_bt">
                         <button type="button" class="btn btn-w-m btn-danger" style="float:right;" id="excluir_mensalidades" data-toggle="modal" data-target="#modal_"><i class="fa fa-times"></i> Excluir mensalidades</button>
                       </div>            


                       <div class="hr-line-dashed"></div>

                       <div class="table-responsive">
                        <table class="table table-striped" >
                          <thead>
                            <tr>
                              <th style="text-align: center;">Parcela</th>
                              <th>Vencimento</th>
                              <th>Valor</th>
                              <th>Desconto</th>
                              <th>Multa</th>
                              <th>Valor pago</th>                                                                               
                              <th>Data pagamento</th>  
                              <th  style="text-align: center;">Estorno</th>                                                                              
                              <th  style="text-align: center;">Ações <input type="checkbox" id="checkAll" style="position: relative;vertical-align: middle;  bottom: 3px; left:8px;" /></th>
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
				
				$("#fm").submit(function( event ) {
					event.preventDefault();
					var dados = $("#fm").serialize();
					  $.ajax({url: "../controller.php?"+dados}).done(function(data) { 
                      $("html, body").animate({ scrollTop: 0 }, "slow");
                      $(".alert-success").removeClass("hide").show();      

					   $.ajax({
                                    url: "../controller.php?action=listamensalidadestabela&model=mensalidade&usuario_id="+$("#usuario_id").val()                            
                                  }).done(function(data) {
                                    $("#trs").html("");
                                    $("#trs").html(data);    
                                    $("#box_excluir_bt").fadeIn();                               
                                  });
                      
                    });
					
					
				})

                  $("#checkAll").click(function(){
                    $('input:checkbox').not(this).prop('checked', this.checked);
                  });

                  $("#excluir_mensalidades").click(function(){
					  
					  
if($('input[type=checkbox]:checked').length > 0){
                    var modal = 'Deseja realmente excluir as mensalidades selecionadas abaixo?';
                    $('.modal-title').html('Excluir mensalidades');
                    $('.modal-body').html(modal);



                    $('#btc').removeClass('estorno');
                    $('#btc').removeClass('baixa');
                    $('#btc').removeClass('update');
                    $('#btc').addClass('excluir_mensalidades'); 
                    $('#btc').prop("type", "button");



                    $('.excluir_mensalidades').on("click", function(){
                    
                    var ids ="";
                    $("input[name=apagar]").each(function() { 

                      if($(this).is(':checked')) {
                        ids = ids+"|"+$(this).val();
                      }
                    });

                      $.ajax({url: "../controller.php?action=excluirmensalidades&model=mensalidade&data="+ids.substr(1)}).done(function(data) { 
                      $(".alert-success").removeClass("hide").show();  
                      console.log(data);
                      var nome = $('#busca').val().replace(" ", "");
                                if( nome != ""){
                                 $.ajax({
                                  url: "../controller.php?action=listamensalidadestabela&model=mensalidade&usuario_id="+$("#usuario_id").val()                            
                                }).done(function(data) {
                                  $("#trs").html("");
                                  $("#trs").html(data);    
                                });

                              }
                    });


                    
                  });
				}else{
					
					  var modal = 'Para excluir uma mensalidade marque ao menos um checkbox. ';
                    $('.modal-title').html('Excluir mensalidades');
                    $('.modal-body').html(modal);
					
				}
                  });





                  if(!window.jQuery){location.href = "http://www.ultramoderndance.com.br/sistema/view/";}

                  function updatemensalidade(id,pagamento_data, valor, desconto, multa, valor_pago, usuario_id){ 

                   var modal = '<div class="form-group"><label>Data de pagamento</label> <form  action="../controller.php" method="post" class="form-horizontal"required ><input type="text" value="'+pagamento_data+'" id="pagamento_data_"  class="form-control"  placeholder="" required></div>'
                   +'<div class="form-group"><label>Desconto</label> <input type="text" id="desconto_" value="'+desconto+'"  class="form-control"  placeholder=""></div>'
                   +'<div class="form-group"><label>Multa</label> <input type="text"  id="multa_" value="'+multa+'"  class="form-control"  placeholder=""></div>'
                   +'<div class="form-group"><label>Valor</label> <input type="text" id="total_"   value="'+valor+'" disabled   class="form-control"  placeholder="" required></div>'
                   +'<div class="form-group"><label>Valor Total</label> <input type="text"  id="valor_" value="'+valor_pago+'"    class="form-control"  placeholder="" required></div>'

                   $('.modal-title').html('Atualizar parcela');
                   $('.modal-body').html(modal);

                   $('#pagamento_data_').mask('00/00/0000');
                   $('#desconto_').mask("#.##0,00", {reverse: true});
                   $('#valor_').mask("#.##0,00", {reverse: true});
                   $('#multa_').mask("#.##0,00", {reverse: true});

                   $('#desconto_').keyup(function() {
                    var desc = parseFloat(document.getElementById('total_').value) - parseFloat(document.getElementById('desconto_').value) + parseFloat(document.getElementById('multa_').value );
                    $('#valor_').val(desc);
                  });

                   $('#multa_').keyup(function() {
                     var mult = parseFloat(document.getElementById('total_').value) + parseFloat(document.getElementById('multa_').value ) - parseFloat(document.getElementById('desconto_').value);
                     $('#valor_').val(mult);
                   });

                   $('#btc').removeClass('estorno');
                   $('#btc').removeClass('excluir_mensalidades');
                   $('#btc').removeClass('baixa');
                   $('#btc').addClass('update'); 
                   $('#btc').prop("type", "submit");



                   $('.update').on('click',function(){


                    if($(this)[0].className == "btn btn-primary update"){

                     var pagamento_data = $("#pagamento_data_").val();
                     var multa = $("#multa_").val();
                     var valor = $("#valor_").val();
                     var desconto  = $("#desconto_").val(); 

                     $.ajax({url: "../controller.php?action=baixapagamento&model=mensalidade&usuario_id="+usuario_id+"&id="+id+"&valor="+valor+"&desconto="+desconto+"&multa="+multa+"&pagamento_data="+pagamento_data}).done(function(data) { 
                      $("html, body").animate({ scrollTop: 0 }, "slow");
                      $(".alert-success").removeClass("hide").show();                                
                      $("#trs").html("");
                      $("#trs").html(data);
                    });

                   }
                 });       

                 }

                 function view(texto, data){

                   var modal =  '<div class="form-group"><label>Data do estorno</label> <input type="text" id="estorno_data" disabled value="'+data+'" class="form-control"  placeholder=""></div>'
                   +'<div class="form-group"><label>Motivo do estorno</label> <textarea type="text"  id="estorno" disabled  class="form-control" >'+texto+'</textarea></div>';

                   $('.modal-title').html('Estorno');
                   $('.modal-body').html(modal);
                   $('#btc').prop("type", "button");
                 }


                 function comboturmaaluno(usuario_id){

                  $.ajax({
                    url: "../controller.php?action=listamodalidadecombo&model=modalidade"                              
                  }).done(function(data) {
                    $("#modalidade_id").removeAttr("disabled");
                    $("#modalidade_id option").html("");
                    $("#modalidade_id").html(data);
                  });

                }



                function estorno(id,usuario_id){     

                 var modal =  '<div class="form-group"><label>Data do estorno</label> <form  action="../controller.php" method="post" class="form-horizontal" > <input type="text" id="estorno_data"  class="form-control"  placeholder="" required></div>'
                 +'<div class="form-group"><label>Motivo do estorno</label> <textarea type="text"  id="estorno"  class="form-control" required ></textarea></div></form>'
                 
                 $('.modal-title').html('Estorno');
                 $('.modal-body').html(modal);

                 $('#estorno_data').mask('00/00/0000');   

                 $('#btc').removeClass('baixa'); 
                 $('#btc').removeClass('update');
                 $('#btc').removeClass('excluir_mensalidades');
                 $('#btc').addClass('estorno'); 
                 $('#btc').prop("type", "submit");


                 $('.estorno').on('click',function(){
                  if($(this)[0].className != "btn btn-primary baixa"){

                    var estorno_data =   $('#estorno_data').val();
                    var estorno =   $('#estorno').val();  

                    $.ajax({url: "../controller.php?action=estorno&usuario_id="+usuario_id+"&model=mensalidade&id="+id+"&estorno="+estorno+"&estorno_data="+estorno_data}).done(function(data) { 
                      console.log(data);
                      $(".alert-success").removeClass("hide").show();
                      $("#trs").html("");
                      $("#trs").html(data);

                    });

                  }
                });                     
               }


               function baixa(mensalidade_id, usuario_id, valor, descontos){   

                valordesconto = valor - descontos;
                
                if (valordesconto) {
                  valordesconto = valordesconto;
                }else{
                  valordesconto = valor;
                }  

                var modal = '<div class="form-group"><label>Data de pagamento</label> <input type="text" id="pagamento_data_"  class="form-control"  placeholder=""></div>'
                +'<div class="form-group"><label>Desconto</label> <input type="text" id="desconto_"  class="form-control"  placeholder=""></div>'
                +'<div class="form-group"><label>Multa</label> <input type="text"  id="multa_"  class="form-control"  placeholder=""></div>'
                +'<div class="form-group"><label>Valor</label> <input type="text" id="total_"   value="'+valor+'" disabled   class="form-control"  placeholder=""></div>'
                +'<div class="form-group"><label>Valor Total</label> <input type="text"  id="valor_" value="'+valordesconto+'"    class="form-control"  placeholder=""></div>'

                $('.modal-title').html('Baixar parcela');
                $('.modal-body').html(modal);

                $('#pagamento_data_').mask('00/00/0000');
                $('#desconto_').mask("#.##0,00", {reverse: true});
                $('#valor_').mask("#.##0,00", {reverse: true});
                $('#multa_').mask("#.##0,00", {reverse: true});

                $('#desconto_').val(descontos)




                $('#desconto_').keyup(function() {
                 var desconto =   parseFloat(document.getElementById('desconto_').value);
                 var total = parseFloat(document.getElementById('total_').value);
                 var multa = parseFloat(document.getElementById('multa_').value );


                 if(multa == NaN){
                  multa = 0;
                }


                if(total ==NaN){
                  total = 0;
                }


                if(desconto == NaN){
                  desconto = 0;
                }
                var desc =  total + multa - desconto ;
                $('#valor_').val(desc);
              });

                $('#multa_').keyup(function() {
                 var desconto =   parseFloat(document.getElementById('desconto_').value);
                 var total = parseFloat(document.getElementById('total_').value);
                 var multa = parseFloat(document.getElementById('multa_').value );


                 if(isNaN(multa)){
                  multa = 0;
                }


                if(isNaN(total)){
                  total = 0;
                }


                if(isNaN(desconto)){
                  desconto = 0;
                }
                var mult = total - desconto + multa;
                $('#valor_').val(mult);
              });

                $('#btc').removeClass('estorno');
                 $('#btc').removeClass('excluir_mensalidades');
                $('#btc').removeClass('update');
                $('#btc').addClass('baixa'); 


                $('.baixa').on('click',function(){


                  if($(this)[0].className != "btn btn-primary estorno"){

                   var pagamento_data = $("#pagamento_data_").val();
                   var multa = $("#multa_").val();
                   var valor = $("#valor_").val();
                   var desconto  = $("#desconto_").val(); 

                   $.ajax({url: "../controller.php?action=baixapagamento&model=mensalidade&usuario_id="+usuario_id+"&id="+mensalidade_id+"&valor="+valor+"&desconto="+desconto+"&multa="+multa+"&pagamento_data="+pagamento_data}).done(function(data) { 

                    $(".alert-success").removeClass("hide").show();                                
                    $("#trs").html("");
                    $("#trs").html(data);
                  });

                 }
               });                     
              }





              $(document).ready(function(){

                $('#desconto').mask("#.##0,00", {reverse: true});
				$('#extra').mask("#.##0,00", {reverse: true});


                    $.ajax({
                              url: "../controller.php?action=listaturmacombo&model=turma"                              
                            }).done(function(data) {
                                $("#turma").html("");
                                $("#turma").html('<option value="0">Turmas</option>'+data);
                              });


                              $('#btbusca').on('click', function(event){
                                event.preventDefault();

                                if($("#usuario_id").val() != ""){

                                  var nome = $('#busca').val().replace(" ", "");
                                  
                                  if( nome != ""){
                                   $.ajax({
                                    url: "../controller.php?action=listamensalidadestabela&model=mensalidade&usuario_id="+$("#usuario_id").val()                            
                                  }).done(function(data) {
                                    $("#trs").html("");
                                    $("#trs").html(data);    
                                    $("#box_excluir_bt").fadeIn();                               
                                  });

                                  }

                              }


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
                                  comboturmaaluno(ui.item.value);
                                },                                    
                                focus: function(event, ui) {
                                  event.preventDefault();
                                  $("#nome").val(ui.item.label);
                                }
                              });



                              $( "#busca" ).autocomplete({
                                source: "../controller.php?action=listaalunos&model=usuario&nome="+$("#busca").val(),
                                minLength: 3,

                                messages: {
                                  noResults: '',
                                  results: function() {}
                                },
                                select: function(event, ui) {
                                  event.preventDefault();
                                  $("#busca").val(ui.item.label);
                                  $("#usuario_id").val(ui.item.value);
                                },                                    
                                focus: function(event, ui) {
                                  event.preventDefault();
                                  $("#busca").val(ui.item.label);
                                }
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