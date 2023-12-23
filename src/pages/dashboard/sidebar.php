<?php

$teacherDashboard = '';

if(isset($_SESSION['users'])){
  $roles = $_SESSION['users']['role'];

  if($roles == 1){
    $teacherDashboard = 'navigation';
  }else{
    $teacherDashboard = 'navigation navigationChange';
  }
}

?>


<div class="<?php echo $teacherDashboard ?>">
  <ul>
  <?php

  if(isset($_SESSION['users'])){
    $roles = $_SESSION['users']['role'];

    
    if($roles == 1){
      ?>

        <li>

      <a>

        <span class="">
          <img src='<?php echo baseUrlImageSrc('logo.png') ?>' width="40" height="40" />
                </span>
                <span class="logo-text text-sm mt-2 px-[0.2rem] text-center font-semibold">Harvesters’ Missions International
                  School</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">Dashboard</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Students Record</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="person-outline"></ion-icon>
                </span>
                <span class="title">Teachers Record</span>
              </a>
            </li>
        
        
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="subway-outline"></ion-icon>
                </span>
                <span class="title">Section</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="lock-closed-outline"></ion-icon>
                </span>
                <span class="title">Subject</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="speedometer-outline"></ion-icon>
                </span>
                <span class="title">Classes</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="school-outline"></ion-icon>
                </span>
                <span class="title">Year Level</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="folder-open-outline"></ion-icon>
                </span>
                <span class="title">School Year</span>
              </a>
            </li>
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="people-circle-outline"></ion-icon>
                </span>
                <span class="title">Users</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="finger-print-outline"></ion-icon>
                </span>
                <span class="title">Attendance</span>
              </a>
            </li>

      <?php
    }else{
      ?>
        <li>

      <a>
        <span class="">
          <img src='<?php echo baseUrlImageSrc('logo.png') ?>' width="40" height="40" />
                </span>
                <span class="logo-text text-sm mt-2 px-[0.2rem] text-center font-semibold">Harvesters’ Missions International
                  School</span>
              </a>
        </li>
          <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="title">Dashboard</span>
              </a>
            </li>
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Student's Record</span>
              </a>
            </li>
            
        
            <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="finger-print-outline"></ion-icon>
                </span>
                <span class="title">Attendance</span>
              </a>
            </li>

               <li class='tab-item'>
              <a>
                <span class="icon">
                  <ion-icon name="people-outline"></ion-icon>
                </span>
                <span class="title">Account</span>
              </a>
            </li>
        

      <?php
    }
  }

  ?>


    <li>
      <a onclick="onSignout()" href="#">
        <span class="icon">
          <ion-icon name="log-out-outline"></ion-icon>
        </span>
        <span class="title">Sign out</span>
      </a>
    </li>
  </ul>
</div>

<script>


let tabIndex = document.querySelectorAll('.navigation > ul > .tab-item');
let selectedIndex = 0;

let tabArray = Array.from(tabIndex);



console.log(tabArray,'get tabArray')


tabArray.forEach((item,i) => {





  item.onclick = function() {
  let tabList=  document.querySelectorAll('.tab-main .tab');



 
   let getids = Array.from(tabList);


   console.log(getids);
 
    getids.forEach((item,k) => {

    


      if(i !== k){
         item.classList.add('hidden');
         
          // console.log(item,'not');
      }
      else{
           console.log(item,'get tablist')
           console.log(k,'get tablist')

      const initialUrl = 'http://localhost/biometric-system/index.php?page=dashboard';

        // console.log(location.href,'location.href')

            console.log(item.id,'id')
            console.log(k,'id')

   
        if(location.href !== initialUrl){
          
          let id = `#tab${k}`;

      
         	location.href = '?page=dashboard';


			    localStorage.setItem('data', JSON.stringify({ id: id, action: ''}));

         
        }

        


        item.classList.remove('hidden');

          // console.log(item,'equal');
      }
    })
     
    


   
   


  }
});









</script>

<script>

function onSignout(){
  
   location.href = '?page=login&logout=true';
}


</script>