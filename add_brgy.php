
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
        <h1 class="blog-title">Add New Barangay</h1>
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <form id="addBrgy" method="post">
            <input type="hidden" name="addBrgy" value="true">
            <div class="form-group">
              <label>Barangay</label>
              <input type="text" class="form-control" name="brgy" placeholder="Name..."/>
            </div>
            <div class="form-group">
              <label>Municipality</label>
              <select class="select form-control" name="municipality">
                  <option value="boac">Boac</option>
                  <option value="mogpog">Mogpog</option>
                  <option value="gasan">Gasan</option>
                  <option value="stacrus">Sta. Cruz</option>
                  <option value="buenavista">Buenavista</option>
                  <option value="torrijos">Torrijos</option>
              </select>
            </div>
            <div class="form-group">
              <label>Branch</label>
              <?php $branches = $model->getAllBranches();?>
              <select class="form-control" name="branchId">
                <?php foreach($branches as $idx => $b): ?>
                  <option value="<?= $b['id'];?>"><?= $b['name'];?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-md btn-success" value="Add"/>
            </div>
          </form>
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

          $("#addBrgy").on("submit", function(e){
            $.ajax({
              url   : "backend/process.php",
              data  : $(this).serialize(),
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                console.log(response);
                if(response.success != null){
                  $("#errors li").remove();
                  alert("Barangay is sucesfully added.");
                } else {
                    if(response.error.length > 0){
                        me.__error(response.error);
                    }    
                }
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
