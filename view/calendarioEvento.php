
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

   <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content animated flipInY">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title"></h4>                                            
                                        </div>
                                        <div class="modal-body">
                                            <p></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                         </div>
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
        

         $.ajax({url: "../controller.php?action=listadatasevento&model=calendario&usuario_id="+$("#uid").val()}).done(function(json) {

         var array = JSON.parse(json);
         var datas = new Array();

            for (var i = 1; i < array.length; i++) {

             var data = array[i].split("|");

             
                         obj =  {
                                    title:data[1] ,
                                    allDay: true,
                                    start: data[0],
                                    end:  data[0],
                                    color:data[3],
                                    description:data[2]
                                }
                        datas.push(obj);

             
         }


         console.log(datas);
          

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
                            eventClick: function(date, jsEvent, view) {

                                 $(".modal-title").html(date.title);                                
                                 $(".modal-body p").html(date.description);
                                 $('#myModal2').modal({ show: 'true' }); 

                            },
                            dayClick: function(date, jsEvent, view) {                                

                               if(view.name == 'month' || view.name == 'basicWeek') {
                                    $('#calendar').fullCalendar('changeView', 'agendaDay');
                                    $('#calendar').fullCalendar('gotoDate', date);      
                                  }  
                            }
                        });

                });
        });
    </script>

