<nav class="blog-nav">
   <li class="this"><a href="" class="blog-nav-item ">E-Church:An Online Information Dessiminating System</a></li>
	<?php if(isset($_SESSION['user'])): ?>
	   <li class="this"><a class="blog-nav-item pull-right" href="logout.php">logout</a></li>
	   <li class="this"><a class="blog-nav-item pull-right" href="dashboard.php?a=l">Dashboard</a></li>
	<?php else:?>
	   <li class="this"><a class="blog-nav-item pull-right <?= ($_GET['a']=='l') ? 'active' : ''; ?>" href="login.php?a=l">Login</a></li>
	<?php endif ?>
   <li class="this"><a class="blog-nav-item pull-right <?= ($_GET['a']=='s') ? 'active' : ''; ?>" href="registration.php?a=s">Sign Up</a></li>
   <li class="this"><a class="blog-nav-item pull-right <?= ($_GET['a']=='se') ? 'active' : ''; ?>" href="services.php?a=se">Services</a></li>
   <li class="this"><a class="blog-nav-item pull-right <?= ($_GET['a']=='e') ? 'active' : ''; ?>" href="view_schedule.php?a=e">Events</a></li>
   <li class="this "><a class="blog-nav-item pull-right <?= ($_GET['a']=='h') ? 'active' : ''; ?>" href="index.php?a=h">Home</a></li>
</nav>