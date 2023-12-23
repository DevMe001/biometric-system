<?php

// require_once('function/helper.php');
// require_once('function/index.php');



if (isset($_GET['page'])) {
  if ($_GET['page'] == 'dashboard') {
    require('pages/dashboard/index.php');
  }
  elseif ($_GET['page'] == 'attendance') {
    require('pages/attendance/index.php');
  } elseif ($_GET['page'] == 'offline') {
    require('pages/offline/index.php');
  }
  
  else {
    include('index.php');
  }
} else {
  include('index.php');
}
?>