<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>E-Church:An Online Information Dessiminating System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include_once "header.php"; ?>

    <div class="container">
      <div class="blog-header">
        <!-- <h1 class="blog-title">The Bootstrap Blog</h1> -->
      </div>
      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
           <div id="calendar"> </div>
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <!-- Modal Resize alert -->
    <div class="modal fade" id="previewEvent">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Event Preview</h4>
                   </div>
                   <div class="modal-body">
                        <div id="eventInfo"></div>
                   </div>
              </div>
         </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/calendar.min.js"></script> <!-- Calendar -->
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script type="text/javascript">

    (function($){
      var Schedule = {
        __init  : function(){
          this.__listen();
        },
        __listen  : function(){
          $.ajax({
            url   : "backend/process.php",
            data  : {loadMySchedule : true},
            type  : 'POST',
            dataType  : 'JSON',
            success   : function(response){
              console.log(response);
              $('#calendar').fullCalendar({
                header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: new Date(),
                eventLimit: true, // allow "more" link when too many events
                events : response,
                eventClick: function(calEvent, jsEvent, view) {
                  //show preview
                  $.ajax({
                    url   : "complaint_preview.php?id="+calEvent.id,
                    type  : 'GET',
                    dataType  :'html',
                    success   : function(response){
                      $("#eventInfo").html(response);
                      $("#previewEvent").modal("show");
                    },
                    error     : function(){
                      console.log("err");
                    }
                  });                  
                }
              });
            },
            error     : function(){
              console.log("err");
            }
          });
        }
      }

      Schedule.__init();
    })(jQuery);
    </script>
  </body>
</html>
