
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
        <h1 class="blog-title">All Material Requisition</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Requesting Department</th>
                      <th>Purpose</th>
                      <th>Date</th>
                      <th>Work Order Ref Number</th>
                      <th>Requested By</th>
                      <th>Approve By</th>
                      <th>MUV Number</th>
                      <th>Edit</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($model->getAllSupply() as $idx => $supply) : ?>
                      <tr>
                          <td><?= $supply['requesting_dept']; ?></td>
                          <td><?= $supply['purpose']; ?></td>
                          <td><?= $supply['date']; ?></td>
                          <td><?= $supply['work_order_ref_no']; ?></td>
                          <td><?= $supply['requested_by']; ?></td>
                          <td><?= $supply['approved_by']; ?></td>
                          <td><?= $supply['muv_no']; ?></td>
                          <td> <a href="edit_requisition.php?id=<?= $supply['id'];?>"><button class="btn"><span class="glyphicon glyphicon-pencil"></span></button> </a></td>
                      </tr>
                  <?php endforeach ?>
              </tbody>
          </table>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
   
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


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
          var me = this;

        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
