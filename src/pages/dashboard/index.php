<?php
session_start();
if(!isset($_SESSION['users'])){
    header('location: index.php?page=login');
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo baseUrlImageSrc('logo.png') ?>">
    <title>Biometric</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/style.css') ?>">

       <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
         <script src="https://cdn.tailwindcss.com"></script>

     
   

</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container-wrapper">
      
            <?php include('sidebar.php')  ?>
        <!-- ========================= Main ==================== -->
        <div class="main tab-main">
            <?php include('main.php') ?>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
   <script src="<?php echo baseUrlScriptSrc('/js/main.js') ?>"></script>

    <!-- ======= Charts JS ====== -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script> -->
    <!-- <script src="<?php echo baseUrlScriptSrc('/js/chartsJS.js') ?>"></script>  -->
  -->
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src='<?php echo baseUrlScriptSrc('/js/features/dashboard.js') ?>'></script>

  
    
</body>

</html>


