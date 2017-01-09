
		<div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Calendário de aulas</h5>
                 </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
		
<script src='js/plugins/fullcalendar/lang-all.js'></script>

 <script>
        $(document).ready(function() {

            /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var tipo = <?=$_GET['tipo']?>

         $.ajax({url: "../controller.php?tipo="+tipo+"&action=listadatas&model=calendario&usuario_id="+$("#uid").val()}).done(function(json) {

         var array = JSON.parse(json);
         var datas = new Array();
            for (var i = 1; i < array.length; i++) {

             var data = array[i].split("|");
             
                         obj =  {
                                    title:data[2] ,
                                    allDay: false,
                                    start: data[0],
                                    end: data[1],
                                    color:data[3],
									description:data[4]
                                }
                        datas.push(obj);

             
         }

          

                        $('#calendar').fullCalendar({
                             lang: 'pt-br',                           
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            duration: '01:00:00',
                            slotDuration: '00:30:00',
                            editable: false,
                            droppable: false, // this allows things to be dropped onto the calendar
                            drop: function() {
                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove();
                                }
                            },
                            events: datas,
                            timeFormat: ' ',
                            dayClick: function(date, jsEvent, view) {                             
                               if(view.name == 'month' || view.name == 'basicWeek') {
                                    $('#calendar').fullCalendar('changeView', 'agendaDay');
                                    $('#calendar').fullCalendar('gotoDate', date);      
                                  }                      
                            },
							    eventRender: function(event, element, view) {
									if(view.name == "agendaDay"){
										  element.find('.fc-title').append("<br/>" + event.description); 
									}
										
									} 
                        });

                });
        });
    </script>

