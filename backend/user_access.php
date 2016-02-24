  <?php 
    if(isset($_SESSION['user'])){
          //default is admin config
    $config = array(
        "request"     => array(
              "request"         => 1,
              "complaints"      => 1,
              "complaints_list" => 1,
              "request_list"    => 1,
              "add_nature"      => 1,
              "complaint_nature_list"   => 1),
          "user"      => array(
              "add_user"        => 1,
              "users"           => 1,
              "add_applicant"   => 1,
              "applicant"       => 1),
          "schedule"  => array(
              "schedule"        => 1,
              "all_list"        => 1,
              "myschedule"      => 1),
          "setting"   => array(
              "slides"            => 1,
              "slideshow"         => 1,
              "add_announcement"  => 1,
              "announcements"     => 1),
          "report"    => array(
              "report"          => 0));

  switch($_SESSION['user']['type']){
    case "applicant" : 
      $config['user'] = "hidden";
      $config['request'] = "hidden";
      $config['setting'] = "hidden";
      $config['schedule']['all_list']       = 0;
      $config['report']['report']       = 'hidden';
    break;
  }
}

?>