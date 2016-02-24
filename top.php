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

    <title>E-Church:An Online Information Dessiminating System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">

    <!-- Custom styles for this template -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid">
      <span class="fixed">
        <div class="row header">
        <div class="col-sm-12">
          <h1><span>e</span>Church</h1>
        </div>
      </div>
      <div class="row menu">
        <div class="col-sm-12">
          <ul>
               <li><a class=" <?= ($_GET['a']=='h') ? 'active' : ''; ?>" href="index.php?a=h">Home</a></li>
               <li><a class=" <?= ($_GET['a']=='e') ? 'active' : ''; ?>" href="view_schedule.php?a=e">Events</a></li>
               <li><a class=" <?= ($_GET['a']=='n') ? 'active' : ''; ?>" href="all_news.php?a=n">News</a></li>
               <li><a class=" <?= ($_GET['a']=='se') ? 'active' : ''; ?>" href="services.php?a=se">Services</a></li>
               <li><a class=" <?= ($_GET['a']=='s') ? 'active' : ''; ?>" href="registration.php?a=s">Sign Up</a></li>
               <?php if(isset($_SESSION['user'])): ?>
                 <li><a href="dashboard.php?a=l">Dashboard</a></li>
                 <li><a href="logout.php">logout</a></li>
              <?php else:?>
                 <li><a class=" <?= ($_GET['a']=='l') ? 'active' : ''; ?>" href="login.php?a=l">Login</a></li>
              <?php endif ?>
          </ul>
        </div>
      </div>
      </span>