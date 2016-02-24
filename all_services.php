<?php include_once "d-top.php"; ?>
  
      <div class="blog-header">
        <h1 class="blog-title">All Services</h1>
      </div>
      <?php $services = $model->getAllServices();
      ?>
      <div class="row">
        <div class="col-sm-12 blog-main">
          <table id="servicesTbl" class="table table-hovered table-bordered">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th width="50"><a data-toggle="modal" data-target="#addServices" class="btn btn-success addservice btn-sm"><span class="glyphicon glyphicon-plus"></span></a></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($services as $idx => $s){ ?>
               <tr data-id="<?= $s['id'];?>">
                <td><a href="edit_service.php?active=services&id=<?= $s['id'];?>" ><?= $s['title'];?></a></td>
                <td><?= $s['description'];?></td>
                <td>
                  <a href="" class="delete-service btn btn-default btn-sm "> <span class="glyphicon glyphicon-remove"></span></a>
                 </td>
              </tr>
              <?php } ?>
             
            </tbody>
          </table>
          <br>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
    <div class="modal fade" id="addServices">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Service</h4>
                   </div>
                    <form id="frmAddService">
                      <div class="modal-body">
                      <input type="hidden" name="addService" value="true"/>
                      <div class="form-group">
                        <label class="label">Title
                        </label>
                        <input type="text" class="form-control" name="title" placeholder="Title..." required/>
                      </div>
                      <div class="form-group">
                        <label class="label">Description
                        </label>
                        <textarea class="form-control" name="description" required placeholder="Description..."></textarea>
                      </div>
                      <div class="form-group">
                        <label class="label" for="special">Special:
                        </label>
                          <br>
                          <input type="checkbox" id="special" name="special" value="1">
                          <input type="hidden" name="start" id="start">
                          <input type="hidden" name="end" id="end">
                          <br>
                          <div id="calendar"></div>
                      </div>

                     </div>
                     <div class="modal-footer">
                      <input type="submit" class="btn btn-success" value="Add"/>
                     </div>
                    </form>
              </div>
         </div>
    </div>
    <script type="text/html" id="tpl">
      <tr data-id="[ID]">
        <td><a href="edit_service.php?active=services&id=[ID]" >[TITLE]</a></td>
        <td>[DESCRIPTION]</td>
        <td>
          <a href="" class="delete-service btn btn-default btn-sm"> <span class="glyphicon glyphicon-remove"></span></a>
        </td>
      </tr>
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script type="text/javascript">
    (function($){
      var Page = {
        allowed : true,
        __init : function(){
          this.__listen();
          this.__defaultListener();
          this.__loadCalendar();
          $("#addServices").modal("show");
        },
        __loadCalendar : function(){
          var me = $(this);
          var special = $("#special");

          $("#calendar").fadeOut();

          special.on("click", function()  {
            var checked = $(this).is(":checked");

            if(checked == true){
              $("#calendar").fadeIn();
            }  else {
              $("#calendar").fadeOut();
            }

          });

            $.ajax({
                url     : "backend/process.php",
                data    : {getEvents: true},
                type    : 'POST',
                dataType : 'JSON',
                success : function(response){
                  $('#calendar').fullCalendar({
                    allDaySlot:false,
                    defaultView:"agendaWeek",
                    eventOverlap: false,
                    defaultTimedEventDuration: '00:30:00',
                    forceEventDuration: true,
                    defaultDate: new Date(),
                    selectable: true,
                    timezoneParam:  "UTC",
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events : response,
                    // select : function(start,end,allDay){
                    //   console.log(start);
                    //   console.log(end);
                    //   console.log(allDay);
                    // },
                   viewRender: function(view) { 
                      $("#calendar .fc-next-button").hide();
                      $("#calendar .fc-prev-button").hide();
                    },
                    dayClick: function(date, allDay, jsEvent, view) {
                      console.log(me.allowed);
                      if(me.allowed === false){
                        alert("Please delete the previously selected event slot first.");
                      } else {
                        $("#start").val(date._d);
                        $("#calendar").fullCalendar('renderEvent', { id:0,title: '[SELECTED TIME FOR THIS EVENT]', start: date, allDay: false } );
                      }
                    },    
                     eventResize: function(event, delta, revertFunc) {
                      // function isOverlapping(event){
                      //       var array = $("#calendar").fullCalendar('clientEvents');

                      //       console.log(array);
                      //       // for(i in array){
                      //       //   // console.log(array[i].id);
                      //       //     // if(array[i].id != event.id){
                      //       //         if(!(Date(array[i].start) >= Date(event.end) || Date(array[i].end) <= Date(event.start))){
                      //       //             return true;
                      //       //         }
                      //       //     // }
                      //       // }
                      //       return false;
                      //   }
                        $("#end").val(event.end._d);
                    },
                    eventAfterRender: function(event,element,view){
                      lastId = event._id;

                      if(event._id != 0){
                        event.editable = false;
                        event.resizable = false;  
                      } else {
                        me.allowed=false;
                      }
                       $("#calendar .fc-buttont").hide();

                    },
                     eventClick: function(event, element) {
                      console.log(event._id);
                      if(event._id == 0){
                        if (confirm("Are you sure you want to delete this event?")) {
                          $('#calendar').fullCalendar('removeEvents',event._id);
                          me.allowed = true;
                        }
                      } else {
                        alert("Slot already taken");
                      }
                        
                    }
                  });
                },
                error : function(){
                  console.log("err");
                }
              });
            
        },
        __defaultListener : function(){
          $(".delete-service").off().on("click", function(e){
            e.preventDefault();
            var target = $(this).parents("tr");
            var id = target.data("id");

            $.ajax({
              url   : "backend/process.php",
              data  : {id:id,deleteService:true},
              type  : "POST",
              dataType  : "JSON",
              success   : function(response){
                console.log(response);
                target.remove();
              },
              error     : function(){
                console.log("err");
              }
            });

          });

        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          var me = this;

          $(".addservice").on("click", function(){
            me.__loadCalendar();
          });

          $("#frmAddService").on("submit", function(e){
            e.preventDefault();
            var target = $("#servicesTbl tbody");
            $.ajax({
              url   : "backend/process.php",
              data  : $(this).serialize(),
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                var tpl = $("#tpl").html();
                console.log(response);
                tpl = tpl.replace("[ID]", response.id).
                  replace("[ID]", response.id).
                  replace("[TITLE]", response.title).
                  replace("[DESCRIPTION]", response.description);

                target.append(tpl);
                me.__defaultListener();

                $("#addServices").modal("hide");
              },
              error     : function(){
                console.log("err");
              }
            });
          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
