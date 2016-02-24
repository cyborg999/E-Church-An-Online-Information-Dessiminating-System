<?php include_once "backend/process.php"; ?>
<?php include_once "backend/user_access.php"; 
if(! isset($_SESSION['user'])){
    Header("Location:index.php");
  } 
?>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
            <a href="index.php" class=" blog-nav-item">Homepage</a>
          <li class="this"><a class="blog-nav-item <?= (isset($_GET['active'])) ? (($_GET['active'] == "dashboard") ? "active" : "" ): ""?>" href="dashboard.php?active=dashboard">Dashboard</a></li>
          <?php if($config['request'] !="hidden"): ?>
          <li class="this "><a href="all_services.php?active=services"class="blog-nav-item <?= (isset($_GET['active'])) ? (($_GET['active'] == "services")  ? "active" : ""): ""?>" >Services </a>
          </li>
          <?php endif ?>
          <?php if($config['user'] !="hidden"): ?>
          <li class="this "><a class="blog-nav-item <?= (isset($_GET['active'])) ? (($_GET['active'] == "user")  ? "active" : ""): ""?>" >Users <span class="caret"></span></a>
            <ol>
              <?php if($config['user']['add_user'] == 1): ?>
              <li><a href="add_user.php?active=user">Add System User</a></li>
              <?php endif ?>
              <?php if($config['user']['users'] == 1): ?>
              <li><a href="users.php?active=user">System Users</a></li>
              <?php endif ?>
              <?php if($config['user']['applicant'] == 1): ?>
              <li><a href="applicant.php?active=user">Customer</a></li>
              <?php endif ?>
            </ol>
          </li>
          <?php endif ?>
          <?php if($config['schedule'] !="hidden"): ?>
          <li class="this "><a class="blog-nav-item <?= (isset($_GET['active'])) ? (($_GET['active'] == "schedule")  ? "active" : ""): ""?>" >Schedule <span class="caret"></span></a>
            <ol>
              <li><a href="schedule.php?active=schedule">Schedule</a></li>
              <?php if($config['schedule']['all_list'] !=0): ?>
                <li><a href="all_schedule.php?active=schedule">Schedule List</a></li>
              <?php endif ?>

            </ol>
          </li>
          <?php endif ?>
          
          <?php if($config['setting'] !="hidden"): ?>
          <li class="this "><a class="blog-nav-item <?= (isset($_GET['active'])) ? (($_GET['active'] == "system")  ? "active" : ""): ""?>" >System Setting <span class="caret"></span></a>
            <ol>
              <?php if($config['setting']['slides'] == 1): ?>
              <li><a href="slides.php?active=system">Add Slideshow</a></li>
              <?php endif ?>
              <?php if($config['setting']['slideshow'] == 1): ?>
              <li><a href="slideshow.php?active=system">All Slideshow</a></li>
              <?php endif ?>
              <?php if($config['setting']['add_announcement'] == 1): ?>
              <li><a href="add_announcement.php?active=system">Add Announcement</a></li>
              <?php endif ?>
              <?php if($config['setting']['announcements'] == 1): ?>
              <li><a href="announcements.php?active=system">All Announcement</a></li>
              <?php endif ?>
              <li><a href="setting.php?active=system">Setting</a></li>
            </ol>
          </li>
          <?php endif ?>
            <a href="logout.php" class="pull-right blog-nav-item">logout</a>
        </nav>
      </div>
    </div>