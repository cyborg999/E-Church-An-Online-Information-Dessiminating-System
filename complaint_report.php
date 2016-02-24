
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
    <style type="text/css">
    tr {
      cursor: pointer;
    }
    </style>
  </head>

  <body>
    <?php include_once "header.php"; ?>
    <div class="container">
      <br>
      <div class="row">
       <!--  <div class="columns col-lg-12 blog-main">
          <label>Search By Email:
            <input type="text" id="email" class="form-control" placeholder="Email..."/>
          </label>
          <button id="searchEmail" class="btn"> <span class="glyphicon glyphicon-search"></span></button>
        </div> -->
        <div class="columns col-lg-12 blog-main">
          <div class="table-responsive">
            <?php $list = $model->getComplaintExport(); ?>
            <table class="table table-hovered table-striped" id="result">
              <thead>
                 <tr>
                  <th>Name of Consumer</th>
                  <th>Address</th>
                  <th>Contact Number</th>
                  <th>Nature of Complaint</th>
                  <th>Date & Time Receipt of Complaints</th>
                  <th>Action Desired</th>
                  <th>Action Taken</th>
                  <th>Date & Time of Action</th>
                  <th>Accomplished By</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($list as $idx => $u): ?>
                <tr>
                  <td><?= $u['consumer_name'];?></td>
                  <td><?= $u['address'];?></td>
                  <td><?= $u['contact_number'];?></td>
                  <td><?= $u['complaint_nature'];?></td>
                  <td><?= $u['complaint_datetime'];?></td>
                  <td><?= $u['action_desired'];?></td>
                  <td><?= $u['action_taken'];?></td>
                  <td><?= $u['action_datetime'];?></td>
                  <td><?= $u['firstname'].' '. $u['lastname'];?></td>
                </tr>
                <?php endforeach ?>
                <tr>
                  <td colspan="9">
                    <input type="submit" class="btn btn-primary"  id="preview" value="Preview PDF"/> 
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.container -->
   
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <div class="modal fade" id="export">
      <div class="modal-dialog" style="width:800px;">
        <div class="modal-content" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">PDF Preview</h4>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="pdfExport">Export As PDF</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      function Popup(data) { //$("html")
         var style = '<style>  </style>';
         var mywindow = window.open('', 'my div', '');
         window.innerWidth =2000;
         mywindow.document.write('<html>');
         mywindow.document.write('<head>');
         mywindow.document.write('</head>');
         mywindow.document.write('<body>');
         mywindow.document.write(data.html());
         mywindow.document.write('</body>');
         mywindow.document.write('</html>');
         mywindow.document.close(); // necessary for IE >= 10
         mywindow.focus(); // necessary for IE >= 10

         mywindow.print();
         mywindow.close();

         return true;
      }
      var Page = {
        __init : function(){
          this.__listen();
        },
        __listen : function(){
          var me      = this;

          $("#pdfExport").on("click", function(){
            var html = $(this).parents(".modal").find(".modal-body");
            Popup(html);
          });

          $("#preview").on("click", function(){
             $.ajax({
              url     : "complaint_export.php", 
              type    : 'GET',
              dataType  : 'html',
              success   : function(res){
                console.log(res)
                var target = $("#export");
                target.find(".modal-body").html(res);

                $("#export").modal("show");
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
