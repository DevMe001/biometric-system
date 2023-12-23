<!-- top main -->
 <div class="topbar no-print">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <!-- <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label> -->
                </div>

                <!-- <div class="user">
                  I
                    <img src="<?php echo baseUrlImageSrc('logo.png') ?>" alt="">
  </div> -->
</div>

<div>
  <!-- table pages -->
<?php

  if(isset($_SESSION['users'])){
    $role = $_SESSION['users']['role'];

    if($role == 1){
      ?>
    <div id='tab0' class='tab hidden no-print'>
       <?php
          require_once(__DIR__ . '/contents/main.php');
          ?>
        </div>
    
        <div id='tab1' class='tab hidden '>
          <?php
          require_once(__DIR__ . '/contents/students-records.php');
          ?>
        </div>
    
    
        <div id='tab2' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/teacher-records.php');
          ?>
        </div>
    
    
        <div id='tab3' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/sections.php');
          ?>
        </div>
    
        <div id='tab4' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/subject.php');
          ?>
        </div>
    
        <div id='tab5' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/classes.php');
          ?>
        </div>
    
    
        <div id='tab6' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/year-level.php');
          ?>
        </div>
    
    
        <div id='tab7' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/school-year.php');
          ?>
        </div>
        <div id='tab8' class='tab hidden'>
    
          <?php
          require_once(__DIR__ . '/contents/user-credentials.php');
          ?>
    
        </div>
    
        <div id='tab9' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/view-attendance.php');
          ?>
        </div>
      <?php
    }
    else{
        ?>
        <div id='tab0' class='tab hidden no-print'>
         <?php
            require_once(__DIR__ . '/contents/main.php');
          ?>
        </div>
    
  
    
        <div id='tab1' class='tab hidden'>
          <?php
          require_once(__DIR__ . '/contents/teacher-class.php');
          ?>
        </div>
    
  
        <div id='tab2' class='tab hidden'>
          <?php
              require_once(__DIR__ . '/contents/view-attendance.php');
          ?>
        </div>

           <div id='tab3' class='tab hidden'>
          <?php
              require_once(__DIR__ . '/contents/user-credentials.php');

              ?>
              </div>
      <?php
    }
  }

?>

</div>







<!-- bottom main -->