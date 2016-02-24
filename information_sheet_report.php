
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
        <div class="columns col-lg-12 blog-main">
          <label>Search By Email:
            <input type="text" id="email" class="form-control" placeholder="Email..."/>
          </label>
          <button id="searchEmail" class="btn"> <span class="glyphicon glyphicon-search"></span></button>
        </div>
        <div class="columns col-lg-12 blog-main">
          <div class="table-responsive">
            <?php $users = $model->getAllUsers(); ?>
            <table class="table table-hovered table-striped" id="result">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Middle Name</th>
                  <th>Email</th>
                  <th>Address</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($users as $idx => $u): ?>
                <tr class="preview" data-id="<?= $u['mainId'];?>">
                  <td><?= $u['username'];?></td>
                  <td><?= $u['firstname'];?></td>
                  <td><?= $u['lastname'];?></td>
                  <td><?= $u['middlename'];?></td>
                  <td><?= $u['email'];?></td>
                  <td><?= $u['address'];?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <script type="text/html" id="tpl">
        <tr class="preview" data-id=[ID]>
          <td>[USERNAME]</td>
          <td>[FIRSTNAME]</td>
          <td>[LASTNAME]</td>
          <td>[MIDDLENAME]</td>
          <td>[EMAIL]</td>
          <td>[ADDRESS]</td>
        </tr>
      </script>
     <!--  <div class="row">
        <div class="col-sm-3 blog-main">
          <label>Search By Email:
            <input type="text" id="email" class="form-control" placeholder="Email..."/>
          </label>
          <button id="searchEmail" class="btn"> <span class="glyphicon glyphicon-search"></span></button>
          <br>
          <br>
          <ul id="result" style="margin:0px;padding:0px;font-size:12px;">
            
          </ul>
        </div>
        <div class="col-sm-9 blog-masin" id="pdfPreview" style=" position: relative;height:600px;">
        </div>
      </div> -->

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
    <script type="text/html" id="tplOLD">
      <li>
          <a class="preview" data-filename="information_sheet.pdf"  href="information_sheet_export.php?id=[ID]">[EMAIL]</a>
        <p>[FULLNAME]</p>
        <p>[ADDRESS]</p>
      </li>
    </script>

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
          this.preview();

        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        preview   : function(){
          var getPreview = $(".preview");

          getPreview.on("click", function(e){
            var me      = $(this);
            var href    = "information_sheet_export.php?id=" + me.data("id");

            $.ajax({
              url     : href, 
              type    : 'GET',
              dataType  : 'html',
              success   : function(response){
                $.ajax({
                  url     : href,
                  type    : 'get',
                  dataType  : 'html',
                  success   : function(res){
                    var target = $("#export");

                    target.find(".modal-body").html(res);

                    $("#export").modal("show");
                  },
                  error     : function(){
                    console.log("err");
                  }
                });
              },
              error     : function(){
                console.log("err");
              }
            });

            e.preventDefault();
          });
        },
        __listen : function(){
          var me      = this;
          var search  = $("#searchEmail");

          $("#pdfExport").on("click", function(){
            var html = $(this).parents(".modal").find(".modal-body");
            Popup(html);
          });


          search.on("click", function(e){
            var email = $("#email").val();
            var target = $("#result tbody");

            target.html("");

            $.ajax({
              url   : "backend/process.php",
              data  : {searchEmail:true, email:email},
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                console.log(response);
                for(var i in response){
                  var tpl = $("#tpl").html();

                  tpl = tpl.replace("[USERNAME]", response[i].username).
                        replace("[ID]", response[i].mainId).
                        replace("[FIRSTNAME]", response[i].firstname).
                        replace("[LASTNAME]", response[i].lastname).
                        replace("[MIDDLENAME]", response[i].middlename).
                        replace("[EMAIL]", response[i].email).
                        replace("[ADDRESS]", response[i].address);

                  target.append(tpl);
                }

                me.preview();
              },
              error     : function(){
                console.log("err");
              }
            });

            e.preventDefault();
          });

        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
