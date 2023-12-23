<?php
namespace Biometric\Helper;


session_start();
if (isset($_SESSION['users']['username']) && isset($_GET['page'])) {
    $page = $_GET['page'];

    if($page === 'login'){
       header('location: index.php?page=dashboard');
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biometric</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo baseUrlImageSrc('logo.png') ?>">


    <link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/bootstrap.css') ?>">
    <script src="<?php echo baseUrlScriptSrc('/js/jquery-3.5.0.min.js') ?>"></script>
    <script src="<?php echo baseUrlScriptSrc('/js/bootstrap.bundle.js') ?>"></script>
    <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- biometric src -->
    <style>

      
    </style>

    <script>
      (function(){
           if(navigator.onLine){
         fetch('https://jsonplaceholder.typicode.com/users')
          .then(response => {
            if (response.ok) {
              console.log('Method 1 - Fetch API: Internet connection is available.');
              // location.href = 'index.php?page=home'
            } else {
              console.log('Method 1 - Fetch API: No internet connection.');
              location.href = 'index.php?page=offline'
            }
          })
          .catch(error => {
            console.log('Method 1 - Fetch API: No internet connection.');
            location.href = 'index.php?page=offline'
          });
      }
      else{
       location.href = 'index.php?page=offline'
      }

      })();

    </script>
</head>
<body>
<div id='wrapper' class='xs:w-[98%] max-w-[90rem] mx-auto'>
  <!-- header -->
 <div class='max-h-screen'>
  <?php include('pages/layout/header.php') ?>

  <div  class='h-[auto] lg:min-h-[60vh]'>
      <?php

      if(isset($_GET['page'])){
        include('pages/layout/content.php');
      }
      else{
        include('pages/contents/index.php');
      }


      ?>
  </div>

  <!-- footer -->
  <div class='h-[10vh] my-5'>
    <?php include('pages/layout/footer.php') ?>
  </div>

  </div>
</div>
</body>
</html>

<script>
  const searchParams = new URLSearchParams(window.location.search);

  if(searchParams.get('page') !== 'home'){
    $('#wrapper').css('background', 'url(<?php echo baseUrlImageSrc('bg-login-stock.svg') ?>) no-repeat');
    $('#wrapper').css('background-position', 'center bottom');
    $('#wrapper').css('background-size', 'contain');

  }

</script>
