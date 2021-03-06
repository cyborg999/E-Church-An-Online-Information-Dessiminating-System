    <?php include_once "d-top.php"; ?>
    <br>
    <br>
    <br>
      <div class="blog-header hidden">
        <h1 class="blog-title">Event Schedule</h1>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-2 blog-main">
          <div id='external-events' style="position:fixed;top:200px;">
            <h4>Events</h4>
            <?php $services = $model->getAllServices(true); ?>

            <?php foreach($services as $idx => $u): ?>
              <?php $requirements = $model->getRequirementsByServiceId($u['id'], true); 
              ?>
              <div data-id="<?= $u['id'];?>" data-list="<?= $requirements;?>" class='fc-event' style="text-align:center;padding:5px;cursor:move;"><?= $u['title'];?></div>
            <?php endforeach ?>
          </div>
        </div>
        <div class="col-sm-9 blog-main">
          <!-- other content goes here -->
            <div id='calendar'></div>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
    <!-- Add event -->
    <div class="modal fade" id="addNew-event">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Event Information</h4>
                   </div>
                   <div class="modal-body">
                        <form class="form-validation" role="form">
                             <div class="form-group">
                                  <label for="eventName">Short Description of chosen event:</label>
                                  <textarea id="eventName" required  rows="10" placeholder="type here..." class="form-control"></textarea>
                             </div>
                             <div class="form-group">
                              <p>Requirements for <i><b>Binyag</b></i></p>
                              <ul id="requirements">
                              </ul>
                            </div>
                             
                             <input type="hidden" id="getStart" />
                             <input type="hidden" id="getEnd" />
                        </form>
                   </div>
                   
                   <div class="modal-footer">
                        <input type="submit" class="btn btn-success btn-lg" id="addEvent" value="Send Request">
                        <button type="button" class="btn btn-default btn-sm" id="cancelEvent" data-dismiss="modal">Cancel</button>
                   </div>
              </div>
         </div>
    </div>
    
    <!-- Modal Resize alert -->
    <div class="modal fade" id="editEvent">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Event</h4>
                   </div>
                   <div class="modal-body">
                        <div id="eventInfo"></div>
                   </div>
                   
                   <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Okay</button>
                        <button type="button" class="btn btn-info btn-sm" id="editCancel" data-dismiss="modal">Cancel</button>
                   </div>
              </div>
         </div>
    </div>
    <script type="text/html" id="lm">
      <option value="[ID]">[NAME]</option>
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script type="text/javascript">
    (function($){
                        // $('#addNew-event').modal('show');   

      var Schedule = {
          id: null,
          __init : function(){
            this.loadCalendar();
          },
          __listen : function(){
             this.loadCalendar();
          },
          loadCalendar : function(){
              var calendar = $("#calendar");
              var me = this;

              $('#external-events .fc-event').each(function() {
                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                  title: $.trim($(this).text()), // use the element's text as the event title
                  stick: true // maintain when user navigates (see docs on the renderEvent method)
                });
                // make the event draggable using jQuery UI
                $(this).draggable({
                  zIndex: 999,
                  revert: true,      // will cause the event to go back to its
                  revertDuration: 0  //  original position after the drag
                });
              });
             
              var lastId = null;

              $.ajax({
                  url     : "backend/process.php",
                  data    : {getEvents: true},
                  type    : 'POST',
                  dataType : 'JSON',
                  success     : function(response){
                   lastId = null;
                    $('#calendar').fullCalendar({
                      header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'agendaWeek'
                      },
                      eventColor: 'red',
                      allDaySlot:false,
                      eventOverlap: false,
                       nextDayThreshold: '00:00:00', // 9am
                      defaultView:"agendaWeek",
                       defaultTimedEventDuration: '00:30:00',
                      forceEventDuration: true,
                      defaultDate: new Date(),
                      selectable: true,

                      timezoneParam:  "UTC",

                      droppable: true, // this allows things to be dropped onto the calendar
                      editable: true,
                      eventLimit: true, // allow "more" link when too many events
                      events : response,
                      eventRender: function(event, element) {
                         // element.append("<p>"+event.categoryname+"</p>");
                         console.log(event);
                        if(event.color == "green"){
                          event.editable = false;
                          event.resizable = false;
                        }
                             // $('#calendar').fullCalendar('removeEvents',event._id);
                        // alert('ren');
                        //   element.append( "<span class='closeon'>X</span>" );
                        //   element.find(".closeon").click(function() {
                        //      $('#calendar').fullCalendar('removeEvents',event._id);
                        //   });
                  
                      },
                       eventResize: function(event, delta, revertFunc) {
                          console.log(event);
                          // alert(event.title + " end is now " + event.end.format());

                          if (!confirm("is this okay?")) {
                              revertFunc();
                          } else {
                            // update record
                            var id = event.id;
                            var endDate = event.end.format();

                            $.ajax({
                                url   : "backend/process.php",
                                data  : {updateEvent:true, id:id,endDate:endDate},
                                type  : 'POST',
                                dataType : 'JSON',
                                success   : function(response){
                                  console.log(response);
                                },
                                error   : function(){
                                  console.log("err");
                                }
                            });
                          }

                      },
                      eventAfterRender: function(event,element,view){
                        lastId = event._id;
                        console.log(event.color); 
                        if( event.color =="blue"){
                          event.resizable = false;
                          event.editable = false;
                        }
                      },
                       eventClick: function(event, element) {
                        if(event.color == "green"){
                          return false;
                        }
                          if (confirm("Are you sure you want to delete this event?")) {
                            $.ajax({
                              url     : "backend/process.php",
                              data    : { 
                                deleteEvent  : true,
                                id : event._id
                              },
                              type    : 'POST',
                              dataType    : 'JSON',
                              success     : function(response){
                                if(response.deleted == true){
                                  $('#calendar').fullCalendar('removeEvents',event._id);
                                } else {
                                  if(response.deleted == "failed"){
                                    alert("This event is fixed.");
                                  } else {
                                    alert("This event does not belongs to you.");
                                  }
                                }
                              },
                              error       : function(){
                                  console.log("err");
                              }
                            });
                            
                          }


                          //for updating event
                          // event.title = "CLICKED!";
                          // $('#calendar').fullCalendar('updateEvent', event);
                      },
                      drop: function(event, delta, revertFunc, jsEvent, ui, view) {
                        var ele = $(this);

                        $.ajax({
                          url     : "backend/process.php",
                          data    : { 
                            addEvent  : true,
                            eventname : ele.data("id"), 
                            start     : event._d, 
                            end       : ''
                          },
                          type    : 'POST',
                          dataType    : 'JSON',
                          success     : function(response){
                              event._id = response.id;
                          $('#calendar').fullCalendar('updateEvent', event,false);

                              console.log(response);

                              console.log(event);
                              // $(element).attr("id","event_id_"+event._id);
                               // calendar.fullCalendar('renderEvent',{
                               //       title: eventName,
                               //       start: start,
                               //       end:  end,
                               //       allDay: true,
                               //  },true ); //Stick the event

                               //  $('#addNew-event form')[0].reset()
                               //  $('#addNew-event').modal('hide');
                          },
                          error       : function(){
                              console.log("err");
                          }
                        });
                        // $('#addNew-event').modal('show');   
                        // $('#addNew-event input:text').val('');
                        // $('#getStart').val(event._d);
                        // $('#getEnd').val('');

                        // console.clear();
                        // console.log(event._d,ele.data('id'));
                        // console.log(x,y);
                        // $("#addEvent").on("click", function(){
                        //   calendar.fullCalendar('removeEvents',lastId);
                        //   ele.remove();
                        // });

                        // $("#cancelEvent").on("click", function(){
                        //   calendar.fullCalendar('removeEvents',lastId);
                        // });
                      }
                    });
                  },
                  error       : function(){
                      console.log("err");
                  }
              });
              
             // // Calendar views
              // $('body').on('click', '.calendar-actions > li > a', function(e){
              //     e.preventDefault();
              //     var dataView = $(this).attr('data-view');
              //     $('#calendar').fullCalendar('changeView', dataView);
                  
              //     //Custom scrollbar
              //     var overflowRegular, overflowInvisible = false;
              //     overflowRegular = $('.overflow').niceScroll();     
              // });                    
              
              $('body').on('click', '#addEvent', function(){
                  var eventName = $('#eventName').val();
                  var start     = $('#getStart').val();
                  var end       = $('#getEnd').val();
                  var lmId      = $("#lineman").val();

                  $.ajax({
                    url     : "backend/process.php",
                    data    : { 
                      addEvent  : true,
                      eventname :eventName, 
                      start     : start, 
                      end       : end
                    },
                    type    : 'POST',
                    dataType    : 'JSON',
                    success     : function(response){
                        console.log(response);
                         calendar.fullCalendar('renderEvent',{
                               title: eventName,
                               start: start,
                               end:  end,
                               allDay: true,
                          },true ); //Stick the event

                          $('#addNew-event form')[0].reset()
                          $('#addNew-event').modal('hide');
                    },
                    error       : function(){
                        console.log("err");
                    }
                  });
              });  
          }
      }

      Schedule.__init();

      })(jQuery);
    </script>
  </body>
</html>
