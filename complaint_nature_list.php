
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
        <h1 class="blog-title">NATURE OF COMPLAINTS/REQUEST</h1>
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
            <?php $nature = $model->getNature(); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Emergency Level</th>
                        <th>Requirements</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($nature as $idx => $n): ?>
                        <tr>
                            <td><?= $n['name'];?></td>
                            <td><?= $n['type'];?></td>
                            <td><?= $n['emergency_level'];?></td>
                            <td><?= $n['requirements'];?></td>
                            <td>
                                <a href="" data-id="<?= $n['id'];?>" class="btn delete-nature">
                                  <button class="btn"><span class="glyphicon glyphicon-remove"></span></button>
                                </a>
                                <a href="edit_nature.php?active=services&id=<?= $n['id'];?>" data-id="<?= $n['id'];?>" class="btn ">
                                  <button class="btn"><span class="glyphicon glyphicon-pencil"></span></button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
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

        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
