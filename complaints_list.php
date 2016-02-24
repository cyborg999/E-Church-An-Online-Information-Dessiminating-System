
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Marelco</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

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
        <h1 class="blog-title">Consumer Complaints List</h1>
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <style type="text/css">
          table {
            font-size: 14px;
          }
          </style>
          <div class="table-responsive overflow">
            <table id="complaint_list" class=" table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name of Consumer</th>
                        <th>Address</th>
                        <th>Contact #</th>
                        <th>Nature of Complaint</th>
                        <th>Date/Time of Complaint</th>
                        <th>Action Desired</th>
                        <th>Action Taken</th>
                        <th>Date/Time of Action</th>
                        <th>Accomplished By</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
   
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <script type="text/html" id="complaint">
        <tr>
            <td>[CONSUMER_NAME]</td>
            <td>[ADDRESS]</td>
            <td>[CONTACT]</td>
            <td>[COMPLAINT_NATURE]</td>
            <td>[COMPLAINT_DATE]</td>
            <td>[ACTION_DESIRED]</td>
            <td>[ACTION_TAKEN]</td>
            <td>[ACTION_DATE]</td>
            <td>[ACCOMPLISHED_BY]</td>
        </tr>
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      var Page = {
        __init : function(){
          this.__listen();
        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          this.loadComplaints();
        },
        loadComplaints  : function(){
            $.ajax({
                url     : "backend/process.php",
                data        : { loadComplaints:true, type:"complaint"},
                type        : 'POST',
                dataType    : 'JSON',
                success     : function(response){
                    var target = $("#complaint_list tbody");

                    for(var i in response){
                        console.log(response[i]);
                        var complaint = $("#complaint").html();

                        complaint = complaint.replace("[CONSUMER_NAME]", response[i].consumer_name).
                            replace("[ADDRESS]", response[i].address).
                            replace("[CONTACT]", response[i].contact_number).
                            replace("[COMPLAINT_NATURE]", response[i].complaint_nature).
                            replace("[COMPLAINT_DATE]", response[i].address).
                            replace("[ACTION_DESIRED]", response[i].action_desired).
                            replace("[ACTION_TAKEN]", response[i].action_taken).
                            replace("[ACTION_DATE]", response[i].action_datetime).
                            replace("[ACCOMPLISHED_BY]", response[i].user_id);

                            target.append(complaint);
                    }
                },
                error       : function(){
                    alert("err");
                    console.log("error");
                }
            });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
