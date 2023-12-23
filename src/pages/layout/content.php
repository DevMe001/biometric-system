<?php
// Get the URL path and split it into components
if(isset($_GET['page'])){
  $page = $_GET['page'];




  // Use a switch-case to handle different pages
  switch ($page) {
    case 'mission':
      include(__DIR__ . '/../contents/mission.php');

      break;
    case 'create':
      include(__DIR__ . '/../contents/registration.php');
      break;
    // case 'dashboard':
    //   include(__DIR__ . '/../contents/admin/index.php');

      // break;
    case 'contact-us':
      include(__DIR__ . '/../contents/contact.php');
      break;
    // case 'fingerprint':
    //   include(__DIR__ . '/../contents/fingerprint_enroll.php');
    //   break;
    case 'enrollment':
      include(__DIR__ . '/../contents/enrollment.php');
      break;
    case 'viewrecord':
      include(__DIR__ . '/../contents/view-records.php');
      break;
    
    case 'login':
      include(__DIR__ . '/../contents/login.php');
      break;
    case 'home':
      include(__DIR__ . '/../contents/index.php');


      break;
    default:
      // Handle the case when the requested content-page doesn't exist
     echo 'Page not Found';
      break;
  }
}
else{
  echo 'Page not Found';
}


?>
