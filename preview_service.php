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

    <title>E-Church:An Online Information Dessiminating System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style type="text/css">
      body {
        padding-top: 0px;
      }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<?php include_once "backend/process.php"; ?>
<?php include_once "backend/user_access.php"; ?>
    <div class="container" id="iframe-content">
      <div class="row">
        <div class="col-sm-12 blog-main">
          <?php $service = $model->getServiceById($_GET['id']);
            $requirements = $model->getRequirementsByServiceId($_GET['id']);
          ?>
          <table class="table" id="editService" data-id="<?= $_GET['id'];?>">
            <tbody>
              <tr>
                <td>
                  <label>Title</label>
                </td>
                <td>
                  <p><?= $service['title'];?></p>
                </td>
              </tr>
               <tr>
                <td>
                  <label>Description</label>
                </td>
                <td>
                  <p><?= $service['description'];?></p>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Requirements</label>
                </td>
                <td>
                  <ul id="requirement" class="clearfix">
                    <?php foreach($requirements as $idx => $req) { ?>
                      <li><i><?= $req['title']; ?></i></li>
                      <?php }?>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Preview</label>
                </td>
                <td> 
                    <?php $images = $model->getPreviewByServiceId($_GET['id']); 
                    ?>
                    <?php foreach($images as $img){ ?>

                    <div class='img-container' style="width:200px;margin:5px 0px 5px;position:relative;background:orange;min-height:50px;float:left;">
                        <img width="200" src="<?= $img['filename'];?>">
                    </div>
                    <?php  } ?>
                    <div class="clearfix">
                    </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </body>
</html>
