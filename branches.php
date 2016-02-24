
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
    <style type="text/css">
    .disabled {
      border: 0px;
      box-shadow: 0px 0px 0px transparent;
      background: white!important;
    }
    </style>
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
        <h1 class="blog-title">Branches</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
           <?php $branch = $model->getAllBranches(); ?>
          <table class="table table-bordered table-hover">
              <thead>
                  <tr>
                      <th>Branch Name</th>
                      <th>Municipality</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($branch as $idx => $b): ?>
                  <tr data-id="<?= $b['id'];?>">
                      <td class="name">
                        <input type="text" readonly class="form-control disabled" value="<?= $b['name'];?>">
                      </td>
                      <td class="municipality">
                        <input type="text" readonly class="form-control disabled" value="<?= $b['municipality'];?>">
                      </td>
                      <td>
                        <button class="edit btn btn-sm"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="cancel hidden btn btn-sm"><span class="glyphicon glyphicon-remove"></span></button>
                        <button class="save btn hidden btn-sm"><span class="glyphicon glyphicon-ok"></span></button>
                      </td>
                  </tr>
                  <?php endforeach ?>
              </tbody>
          </table>
          <br>
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
          var me      = this;
          var edit    = $(".edit");
          var cancel  = $(".cancel");
          var save    = $(".save");

          save.on("click", function(e){
            var tr            = $(this).parents("tr");
            var name          = tr.find(".name input");
            var municipality  = tr.find(".municipality input");

            name.attr("data-current", name.val()).addClass("disabled").attr("readonly", "readonly");
            municipality.attr("data-current", municipality.val()).addClass("disabled").attr("readonly", "readonly");

            tr.find(".edit").removeClass("hidden");
            tr.find(".cancel, .save").addClass("hidden");

            $.ajax({
              url   : "backend/process.php",
              data  : { 
                upadateBranch  : true,
                id            : tr.data("id"),
                name          : name.val(),
                municipality  : municipality.val()
              },
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                console.log(response)
              },
              error     : function(){
                console.log("err");
              }
            });

            e.preventDefault();
          });

          cancel.on("click", function(e){
            var tr            = $(this).parents("tr");
            var name          = tr.find(".name input");
            var municipality  = tr.find(".municipality input");

            name.val(name.data("current")).addClass("disabled").attr("readonly", "readonly");
            municipality.val(municipality.data("current")).addClass("disabled").attr("readonly", "readonly");

            tr.find(".edit").removeClass("hidden");
            tr.find(".cancel, .save").addClass("hidden");

            e.preventDefault();
          });

          edit.on("click", function(e){
            var tr = $(this).parents("tr");
            var name  = tr.find(".name input");
            var municipality = tr.find(".municipality input");

            name.attr("data-current", name.val()).removeClass("disabled").removeAttr("readonly");
            municipality.attr("data-current", municipality.val()).removeClass("disabled").removeAttr("readonly");

            $(this).addClass("hidden");
            tr.find(".cancel, .save").removeClass("hidden");
            e.preventDefault();
          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
