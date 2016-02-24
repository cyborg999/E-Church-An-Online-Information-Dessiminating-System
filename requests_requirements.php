<?php include_once "backend/process.php"; ?>

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

    <div class="blog-masthead">
      <div class="container">

        <nav class="blog-nav">
           <li class="this"><a href="" class="blog-nav-item ">Supply Monitoring and Repair Management System</a></li>
           <li class="this"><a class="blog-nav-item pull-right" href="login.php">Login</a></li>
           <li class="this"><a class="blog-nav-item pull-right" href="registration.php">Application for Membership</a></li>
           <li class="this"><a class="blog-nav-item pull-right active" href="registration.php">Services</a>
            <ol class="pull-right" style="left:280px;">
              <li><a href="complaints_requirements.php">Complaints</a></li>
              <li><a href="requests_requirements.php">Requests</a></li>
            </ol>
           </li>
            
           <li class="this "><a class="blog-nav-item pull-right " href="index.php">Home</a></li>
        </nav>
      </div>
    </div>
  
    <div class="container">
    <br>      
    <br>      
    <?php $services = $model->getNatureByTypeAndPriority("request"); ?>
     <div class="row">
        <div class="col-sm-3 blog-sidebar">
          <div class="sidebar-module">
            <h4>High Priority</h4>
            <ol class="list-unstyled">
              <?php foreach($services['High'] as $idx => $s) :?>
                <li><a class="getContent" data-id="<?= $s['id'];?>" href="#"><?= $s['name'];?></a></li>
              <?php endforeach ?>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Medium Priority</h4>
            <ol class="list-unstyled">
                <?php foreach($services['Medium'] as $idx => $s) :?>
                <li><a class="getContent" data-id="<?= $s['id'];?>" href="#"><?= $s['name'];?></a></li>
              <?php endforeach ?>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Low Priority</h4>
            <ol class="list-unstyled">
              <?php foreach($services['Low'] as $idx => $s) :?>
                <li><a class="getContent" data-id="<?= $s['id'];?>" href="#"><?= $s['name'];?></a></li>
              <?php endforeach ?>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

        <div class="col-sm-8 col-sm-offset-1 blog-main">
            <?php if(isset($services['High'][0])): ?>
            <div class="blog-post">
              <h2 class="blog-post-title"><?= $services['High'][0]['name'];?></h2>
              <br>
              <p class="blog-post-meta">Requirements:</p>
              <?php $req = explode(",", $services['High'][0]['requirements']); ?>
              <ol>
                <?php foreach($req as $idx => $r): ?>
                  <li><?= $r;?></li>
                <?php endforeach ?>
              </ol>
            </div>
            <?php endif ?>
        </div>
        
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
          __listen : function(){
            $(".getContent").on("click", function(e){
              var id = $(this).data("id");
              var target = $(".blog-main");

              target.html("");

              $.ajax({
                url   : "ajax-content.php?id="+id,
                type  : 'GET',
                dataType  :"html",
                success   : function(response){
                  target.html(response);
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
