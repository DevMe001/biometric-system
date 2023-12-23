
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/fingerprint.css') ?>">


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$yearLevel = $controller->getYearLevel();

$sections = $controller->getSections();
$studentRecord = $controller->getStudentRecords();
$getSchoolYear = $controller->getSchoolYear();

$totalEnroll = count($studentRecord);
// getschoolyear
// $schoolYear = "SY-{$getSchoolYear['start_date']}-{$getSchoolYear['end_date']}";
$startYear = date('Y', strtotime($getSchoolYear['start_date']));
$endYear = date('Y', strtotime($getSchoolYear['end_date']));
$schoolYear = "SY-$startYear-$endYear";

$startDate = $getSchoolYear['start_date'];
$endDate = $getSchoolYear['end_date'];
?>



<div class='flex gap-2 items-center mb-5 p-5 no-print'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Student Record </p>
</div>

<div class='w-[90%] mx-auto'>


  <!-- breadcrums  -->



  <!-- wrapper  filter-->
  <div class='w-full mx-auto'>
    <!-- filter search -->

    <div class='w-[80%] flex justify-between items-center gap-5 mx-auto no-print'>
      <!-- sort -->
      <div>
        <?php require_once(__DIR__ . '/widget/widget.php'); ?>
        <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
      </div>
      <!-- search -->
      <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
        <label>
          <input id='studentRecSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='studentRecPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalStudentRecToggle'  data-modal-target="studentRecord-modal" data-modal-toggle="studentRecord-modal"
        class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
      </div>
    </div>

    
  </div>


  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10 overflow-x-auto'>


     <input type="hidden"  name="schoolYear" id='schoolYear' value=<?php echo $schoolYear ?>>
    <!-- <div class="absolute bottom-20 right-20">

       <div class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
       </div>
      </div> -->

<form method="post" action="" id="myForm">
    <input type="hidden" name="getRecentYear" id="getRecentYear" value="<?php echo date('Y') ?>">
  <!-- Other form elements go here -->
</form>


      <?php

      $getUniqueYear = array();

      foreach ($studentRecord as $key => $value) {
        if (!array_key_exists($value['yearEnrolled'], $getUniqueYear)) {
          $getUniqueYear[$value['yearEnrolled']] = $value['yearEnrolled'];
        }
      }

      ksort($getUniqueYear);

      $distinctYear = array_values($getUniqueYear);

      $getUniqueSection = array();

      
      if(count($distinctYear) > 1){

        ?>
          
       <div id='filterPerYear' class="flex justify-end item-center gap-4 mb-4">
          <label for="getRecYearly" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white uppercase">Year</label>
          <select style='width:200px;' id="getRecYearly"  class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        <?php


                foreach ($distinctYear as $getPerYear) {

                  $getReqYear ='';

                  if(isset($_GET['filteredYear'])){
                    $getReqYear = $_GET['filteredYear'];
                  }

                  $getYearSelected = $getPerYear == $getReqYear ? 'selected' : '';

                  ?>
                  <option value="<?php echo $getPerYear ?>"  <?php  echo $getYearSelected ?> >
                    <?php echo $getPerYear ?>
                  </option>
                  <?php

                }

                ?>
              </select>
          
            </div>
        <?php
      }

      ?>



      

    <table class="custom-table student-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Lrn</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Section</th>
          <th class='p-2 text-left'>Gen.Ave</th>
          <th colspan="3" class='p-2 text-center'>Action</th>
         
       
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
    <?php

    if($totalEnroll > 0){
      ?>
         <tbody>


        <?php

            foreach ($studentRecord as $secKey => $rec) {
                
              $getFilterYEar = isset($_GET['filteredYear']) ? $_GET['filteredYear'] : date('Y');


              $studentsRecord = json_encode($rec);

              $studentRecData = htmlspecialchars(str_replace('\\', '', $studentsRecord));

              if($rec['yearEnrolled'] == $getFilterYEar){
                ?>
                  <tr>
        
                <td class='p-2'>
                  <?php echo $secKey + 1 ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $rec['lrn'] ?>
                          </td>
                          <td class='p-2'>
                            <?php echo strtoupper($rec['fullName']) ?>
                          </td>
                  
                          <td class=''>
                            <img class='rounded object-cover' id='cutomStyleImg'
                              src="<?php echo baseUrlImageSrc('uploads/profile/' . $rec['profile']) ?>" alt="profile">
                          </td>
                          <td class='p-2'>
                            <?php echo strtoupper($rec['gender']) ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $rec['age'] ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $rec['birthdate'] ?>
                          </td>
                          <td class='p-2'>
                            <?php echo strtoupper($rec['currentAddress']) ?>
                          </td>
                          <td class='p-2'>
                            <?php echo strtoupper($rec['sectionName']) ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $rec['gwa'] ?>
                          </td>
                          <td onclick='editStudentRec(<?php echo $studentRecData; ?>)'
                            class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon>
                          </td>
                          <td onclick='deleteStudentRec(<?php echo $studentRecData; ?>)'
                            class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="trash-outline"></ion-icon></td>
                  
                          <td><ion-icon name="eye-outline"></ion-icon></td>
                  
                        </tr>

                <?php
              }


              ?>
          
              <?php
              # code...
            }


            ?>
        
        
            <!-- create center no match found -->
            <tr id='studentRecNoResult' class='hidden'>
              <td colspan='4' class='text-center text-gray-500'>No match found</td>
          </tbody>
 
    <?php
    }else{
  
      ?>
      <tbody>
          <tr id='studentRecNoResult'>
              <td colspan='11' class='text-gray-500 font-semibold'>No match found!</td>
          </tr>
      </tbody>
      
    <?php
    }

?>


    </table>

    <!-- printing code -->


    <table class="student-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Lrn</th>
          <th class='p-2 text-left'>Name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Section</th>
          <th class='p-2 text-left'>Gen.Ave</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($studentRecord as $key => $rec) {




          ?>
          <tr>
              <td class='p-2'>
              <?php echo $key + 1 ?>
                </td>
                <td class='p-2'>
                  <?php echo $rec['lrn'] ?>
                </td>
               <td class='p-2'>
                  <?php echo $rec['fullName'] ?>
                </td>
                  <td class=''>
                    <img class='rounded-full object-cover'  id='customStyleImgPrint' src="<?php echo baseUrlImageSrc('uploads/profile/' . $rec['profile']) ?>" alt="profile">
                  </td>
                  <td class='p-2'>
                  <?php echo $rec['gender'] ?>
                </td>
                <td class='p-2'>
                  <?php echo $rec['age'] ?>
                </td>
                <td class='p-2'>
                  <?php echo $rec['birthdate'] ?>
                </td>
                <td class='p-2'>
                  <?php echo $rec['currentAddress'] ?>
                </td>
                 <td class='p-2'>
                  <?php echo $rec['sectionName'] ?>
                  </td>
                  <td class='p-2'>
                  <?php echo $rec['gwa'] ?>
                </td>
                <td
              </tr>
          <?php
          # code...
        }


        ?>

      </tbody>

    </table>



<?php

if ($totalEnroll > 0) {
  ?>
  <hr />
  <div class='flex justify-end gap-2 pr-5 items-center no-print'>

    <span>
      <button onclick='prevBtn(".student-table")' class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
    </span>
    <span> |</span>
    <span>
      <button onclick='nextBtn(".student-table","studentRecNoResult")'
        class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
    </span>
    </dv>
  </div>
  <?php
}


?>



    <!-- end printing code -->





    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addSubject" data-modal-toggle="addSubject" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="studentRecord-modal" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full" data-modal-backdrop="static">
      <div id='modal-container' class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='studentRecCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="studentRecord-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8 no-print">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='studentRecTitle'>Registration form</span>
              </h3>
            <form id='studentRecordForm' class="space-y-6" enctype='multipart/form-data no-print' >
                    <input type="hidden" name='studentId'  id='studentId'>
                    <input type="hidden" name='receiptId'  id='receiptId'>
                    <input type="hidden" name='submitId'  id='submitId'>
                    <input type="hidden" name='oldProfile'  id='oldProfile'>
           



        <!-- type of enrollment -->
          <fieldset>
                    <div class='editHidden'>
                          <label for="typeStudent" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student type</label>
                          <select id="typeStudent" name='typeStudent' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose type</option>
                            <option value="new">New</option>
                            <option value="regular">Old</option>
                          </select>
                    </div>

                       <div class="flex justify-between items-center mt-5">
                     <button id='next-button__1'  class="hidden w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                    
                   </div>
          </fieldset>

        



                <fieldset>
                    <div id='chooseTypeEnroll'>
                         
                          <label for="typeEnroll" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose type</label>
                          <select id="typeEnroll" name='typeEnroll' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                           $getUniqueType = array();

                           foreach ($yearLevel as $studentType) {

                             if (!array_key_exists($studentType['type'], $getUniqueType)) {
                               $getUniqueType[$studentType['type']] = $studentType['type'];
                             }


                           }

                          // Sort the unique records numerically in ascending order
                          ksort($getUniqueType);

                           $getTypeUnique = array_values($getUniqueType);

                            foreach($getUniqueType as $type){

                                $getType = '';

                        
                             if ($type == 1) {
                               $getType = 'Elementary';
                             } elseif ($type == 2) {
                               $getType = 'Junior HighSchool';
                             }  elseif ($type == 3) {
                               $getType = 'Senior HighSchool';
                             }


                             ?>
                              
                            <option value="<?php echo $type ?>"> <?php echo $getType ?></option>
                        



                            <?php

                            }


                          ?>
                          </select>

                    </div>

      <!-- grade-->

                   <div id='typeYearLevel' class='hidden'>
                          <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose grade level</label>
                          <select id="level" name='level' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                          </select>

                    </div>


                      
                   <div id='newDivSection' class='hidden'>
                          <label for="newSection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose grade level</label>
                          <select style='width:100%' id="newSection" name='newSection' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <?php

                        foreach ($sections as $section) {

                          ?>
                                <option value="<?php echo $section['id'] ?>">
                                  <?php echo $section['name'] ?>
                                </option>
                                <?php

                        }

                        ?>
                          </select>

                    </div>

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </fieldset>

    <!-- end grade -->

        <!-- end typeof enrollment -->

                <fieldset>        
                    <div id='personal-form'>
                      
                    <legend>Applicant Personal Details</legend>
        <!-- profile -->

                     <div class="w-full mx-auto mt-3">
                      
                        <!-- display profileImg -->
                       <label for="profile" class="cursor-pointer " title="Choose file">
                        
                          <div id='previewImgDiv' class='w-[150px] h-[150px] shadow-1 border-1 bg-[#eaeaea] mx-auto px-5 py-10 rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-img w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-img text-gray-600 text-center text-sm font'>2X2 picture</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="profile" id="profile" class="hidden" accept="image/*" required>
                            <label id="profile-error" class="error hidden" for="profile">This field is required.</label>
                 
                      </div>

        <!-- end profile -->
                    <!-- lrn -->
                    <div>
                        <label for="lrn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LRN</label>
                        <input type="number" name="lrn" id="lrn" maxlength="12" class="limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                    <div class="mb-2">
                        <label for="gwa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous Grade</label>
                        <input type="number" name="gwa" id="gwa" maxlength="2" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                    <!-- end lrn -->

                    <legend>Legal Name</legend>
                    <!-- fulname -->
                    <div>
                        <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Family name</label>
                        <input type="text" name="lname" id="lname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                    <div>
                        <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Given Name</label>
                        <input type="text" name="fname" id="fname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>


                      <div>
                        <label for="mname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middle Name</label>
                        <input type="text" name="mname" id="mname" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                

                    </div>

                    <!-- other information needed -->
                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__3'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </fieldset>

           <fieldset>
              <legend>Applicant Personal Details</legend>
                 <div>
                       <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                      <select id="gender" name='gender' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="transgender">Transgender</option>
                           
                      </select>

                

                    </div>
                   

                    <!-- end gender -->

                    <!-- age -->
                  

                    <!-- end age -->

                    <!-- bday -->

                    <div>
                        <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                        <input type="date" name="birthdate" id="birthdate" class="bday bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>


                    <!-- end bday -->
                      <div id='ageReveal' class="hidden">
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <div id='guestmyAge' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white'>7-25</div>
                        <input type="hidden" id='age' name="age">
                    </div>


            

                   

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__4'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </fieldset>

                
           <fieldset>
                  <legend>Applicant Personal Details</legend>
              <div>

                  <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Address</label>
                        <input type="text" name="address" id="address" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>
                  <!-- plaec of birth -->
                  <div>
                        <label for="pbirth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Place of birth</label>
                        <input type="text" name="pbirth" id="pbirth" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>
                    <!-- end placeofbirth -->

                    <!-- nationality -->
                      

                    <!-- end nationality -->
                   <div>
                        <label for="nationality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                  </div>

                   <div>
                        <label for="studentNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Contact Number</label>
                        <input type="number" name="studentNumber" id="studentNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                       
                   </div>

                  

                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__5' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__5'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </div>



           </fieldset>


           <fieldset>
                  <legend>Application personal details</legend>

            <div class="mt-2">
       
              
                        <label for="fatherName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Name</label>
                        <input type="text" name="fatherName" id="fatherName" class="uppercase char-allowed bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            
            <div>
                        <label for="fatherOccupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Occupation</label>
                        <input type="text" name="fatherOccupation" id="fatherOccupation" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
            <div>
                        <label for="fatherNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Father's Contact Number</label>
                            <input type="number" name="fatherNumber" id="fatherNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>

            </div>

           
             <div>
                        <label for="motherName" class="char-allowed block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Name</label>
                        <input type="text" name="motherName" id="motherName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            
              <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__6' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__6'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
             </div>
        
  
            
      
           </fieldset>

           <fieldset>
                  <legend>Application personal details</legend>

          <div class='mt-2'>

             <div>
                        <label for="motherOccupation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother's Occupation</label>
                        <input type="text" name="motherOccupation" id="motherOccupation" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
            <div>
                        <label for="motherNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mother Contact Number</label>
                        <input type="number" name="motherNumber" id="motherNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>

        
            <div>
                        <label for="guardiansName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gurdian Contact(Mr.Ms/Mrs.)</label>
                        <input type="text" name="guardiansName" id="guardiansName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>                
            
            <div>
                        <label for="guardianContactNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guardian Contact Number</label>
                        <input type="number" name="guardianContactNumber" id="guardianContactNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
            </div>
           

          
             <div>
                        <label for="guardianAddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="guardianAddress" id="guardianAddress" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
             </div>


                  <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__7' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__7' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
           </div>

             
              
           </fieldset>
              
             <fieldset>
                <legend>Emergency contact information</legend>
                 <div id='other-form'>
                      
    
                       
                    <div>
                        <label for="contactName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fullname</label>
                        <input type="text" name="contactName" id="contactName" class="char-allowed uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  >
                    </div>

                    <!-- end fullname -->


                   <!-- gender -->
                    <div>
                       <label for="relationship" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Relationship</label>
                      <select id="relationship" name='relationship' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600  dark:text-white" >
                            <option  value='' selected></option>
                        
                            <option value="sister">Siblings</option>
                            <option value="parents">Parents</option>
                            <option value="wife">Spouse</option>
                            <option value="friend">Friend</option>
                            <option value="nephew">Nephew</option>
                            <option value="aunt">Aunt</option>
                            <option value="uncle">Uncle</option>
                            <option value="guardians">Guardians</option>
                            <option value="cousin">Cousins</option>


                           
                      </select>

                    </div>
                   

                    <!-- end gender -->

                    <!-- age -->
                    <div>
                        <label for="contactNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number of relative</label>
                        <input type="number" name="contactNumber" id="contactNumber" minlength="11" maxlength="11" class="limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    
                    </div>

                    <!-- end age -->

                    <!-- bday -->

                 


                    <!-- end previous grade -->


                     <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__8' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__8'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </div>

                 

              
       </fieldset>
                
                    <!-- end other information -->


            <!-- type of submitted form -->
                 <fieldset>
                          <legend>Student's Credentials</legend>

                  
               <div>
                       <label for="credentialType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credential's type</label>
                      <select id="credentialType" name='credentialType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="local">LOCAL</option>
                            <option value="foreign">FOREIGN</option>  
                      </select>


                      <div id='local' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="report_card" id="report_card" class='local'><label class='ml-4' for="report_card">Report Card</label>
                      </div>
                      <div>
                        <input type="checkbox" name="formsf10" id="formsf10" class='local'><label class='ml-4' for="formsf10">Form 137 /SF10</label>
                      </div>

                      <div>
                        <input type="checkbox" name="birtcertificate" id="birtcertificate" class='local'><label class='ml-4' for="birtcertificate">Birth Certificate</label>
                      </div>


                      <div>
                        <input type="checkbox" name="cert_gmoral" id="cert_gmoral" class='local'><label class='ml-4' for="cert_gmoral">Certificate of good moral</label>
                      </div>

                      <div>
                        <input type="checkbox" name="med_cert" id="med_cert" class='local'><label class='ml-4' for="med_cert">Medical Certificate</label>
                      </div>

                      <div>
                        <input type="checkbox" name="let_rec" id="let_rec" class='local'><label class='ml-4' for="let_rec">Letter of Recommendation</label>
                      </div>

                      </div>

                      <div id='foreign' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="study_permit" id="study_permit" class='foreign'><label class='ml-4' for="study_permit">Study Permit</label>
                      </div>
                      <div>
                        <input type="checkbox" name="alien_card" id="alien_card" class='foreign'><label class='ml-4' for="alien_card">Alien Cerfication of REG,ACR,CARD</label>
                      </div>

                      <div>
                        <input type="checkbox" name="passport" id="passport" class='foreign'><label class='ml-4' for="passport">Passport copy</label>
                      </div>


                      <div>
                        <input type="checkbox" name="auth_rec" id="auth_rec" class='foreign'><label class=' ml-4' for="auth_rec">Authenticated School Records</label>
                      </div>

                     

                    
                    </div>

                   <div class="flex justify-between items-center mt-5">
                     <button id='prev-button__9' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__9' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </fieldset>

          

     <fieldset id='bimetricScan' class="hidden skipFieldset">
               <div class="p-5"> 
                  <div id='checkDevice' class='max-w-auto bg-white mx-auto h-auto'>

                            <di class='flex flex-col justify-center items-center h-full'>
                              <div id='loader' class='mb-5 hidden' role="status">
                                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                  viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                  <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                              </div>
                              <button onclick='validateConnection()'
                                class='text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Check
                                the device</button>
                          </div>

                 </div> 

                 <legend>Biometric scan (thumb finger)</legend> 



                   <div id='beginEnroll' class='hidden'>
                   <div id='getFingerImage' class='flex flex-row justify-center gap-2 items-center h-full my-3'></div>

                    <div id="fingerscanner" class="fingerprint-container">
                      <div class="fingerprint-scanner flex justify-center items-center h-full ">
                      </div>

                    </div>

               

                   </div>
                     <div id='biometricDone' class="flex justify-between items-center mt-5 hidden">
                     <button id='prev-button__10' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__10'  data='last_record' type="submit" class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

      </fieldset>
            <!-- end type of submitted form -->

             <fieldset id='enrollReceipt' class='proceedFieldset'>
                        <legend class='text-center font-semibold text-xl' >Enrollment Fee<span id='typeAvail'></span></legend>
                       <div class='flex justify-end items-center '>
                         <p id='printReceipt' class="cursor-pointer text-indigo my-2 btn outline outline-offset-2 outline-1 hover:bg-blue-700 hover:text-white p-2 text-indigo-500">Print receipt</p>
                       </div>
                 <div class="flex gap-2 justify-center">

                  <div class="w-7/12 my-2">
                    <p class='text-left'><span id='syYear' class="font-medium">SY:2022-2023</span> <span id='typeFee' clas='font-medium'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <spa id='fLName'n clas='font-medium'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Level:</span> <span id='getSelectedSection' clas='font-medium'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='getDateIssued'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center">

                  <div class="w-6/12 my-2">
                  <div>
                       <p class='text-left mb-1'><span class="font-medium" >Miscellanious fee</span> <span id='misc' clas='font-medium'>₱10,045.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Books and Modules</span> <span id='books' clas='font-medium'>₱5,905.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Tuition fee</span> <span id='tuition' clas='font-medium'>₱15,000.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Total</span> <span id='total' clas='font-medium'>₱30,950</span></p>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium" >Full cash payment</span> <span id='full' clas='font-medium'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-6/12 mx-auto my-2">
                    <div class="flex flex-col justify-between items-center shadow-md py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                   <div class="flex justify-end items-center gap-2 mt-5">
                     <button id='prev-button__11' type="button" class="hidden w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='next-button__11' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                   </div>
             </fieldset>       

            </form>

           

          </div>
        </div>
      </div>
    </div>

    <!-- edit modal -->

    <!-- print receipt -->



                 <div  class="receipt-print hidden border-2 p-5">
                        <legend class='text-center font-semibold text-xl'>Enrollment Fee<span id='typeAvail'></span></legend>
                   
                 <div class="flex gap-2 justify-center">

                  <div class="w-[50%] my-2">
                    <p class='text-left'><span class="font-medium" is='syYearPrint'>SY:2022-2023</span> <span clas='font-medium' id='typeFeePrint'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <span clas='font-medium' id='fLNamePrint'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Section</span> <span clas='font-medium'id='getSelectedSectionPrint'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='getDateIssuedPrint'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center items-center">

                  <div class="w-[50%] my-2">
                  <div class="flex flex-col justify-between gap-2 items-start">
                    <div class="grid grid-cols-2 gap-4">
                   <p class="font-medium">Miscellanious fee</p> 
                   <p clas='font-medium' id='miscPrint'>₱10,045.00</p>
                   <p class="font-medium">Books and Modules</p> 
                   <p clas='font-medium' id='booksPrint'>₱5,905.00</p>
                   <p class="font-medium" >Tuition fee</p> 
                   <p style="border-bottom: 1px solid #000;" clas='font-medium' id='tuitionPrint'>₱15,000.00</p>
                   <p class="font-medium">Total</p> 
                   <p clas='font-medium' id='totalPrint'>₱30,950</p>  
                    </div>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium">Full cash payment</span> <span clas='font-medium' id='fullPrint'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-[50%] mx-auto my-2">
                    <div class="flex flex-col justify-between items-center py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                  
             </div>       


<!-- end print receipt -->



<!-- modal for old user-->


<!-- Modal toggle -->
<button id='oldUserModal' data-modal-target="old-user-modal" data-modal-toggle="old-user-modal" class="invisible block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">

</button>

<!-- Main modal -->
<div id="old-user-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div id='modal_reg-container' class="relative w-full max-w-md max-h-full" data-modal-backdrop="static">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="old-user-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Enroll regular students</h3>

                <!-- search lrn exist -->
              


                <form id='studentRegularForm' class="space-y-6" action="#">
                  <input type="hidden" name="userStudentId" id='userRegularId'>
                   <input type="hidden" name="enrollmentId" id='enrollmentId'>
                  <input type="hidden" name="regFullName" id='regFullName'>
                  <input type="hidden" name="endSchoolYear" value='<?php echo $endDate ?>'>
                   <input type="hidden" name="startSchoolYear" value='<?php echo $startDate ?>'>
               
                  

                   <div id="searchFilterLrn">
                     <div>
                        <label for="searchLrn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Learning Referrence Number</label>
                        <input type="number" name="searchLrn" id="searchLrn" maxlength="12" class="text-center my-5 limitLength disabled-key uppercase bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="LRN" required>
                      
                    </div>
                    
                    <button id='searchBtn' type="button" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                  
                   </div>
             
                 <fieldset class="my-fieldset">
                    <div class="mb-2">
                        <label for="gwa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Previous Grade</label>
                        <input type="number" name="gwa" id="gwaPrev" maxlength="2" class="text-center limitLength disabled-key bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>

                      <div class="flex justify-end items-center gap-2 mt-5">
                     <button id='prvBtn__1' type="button" class="hidden w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__1' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                 </fieldset>

                      <fieldset class="my-fieldset">
                    <div id='chooseTypeEnroll'>
                         
                          <label for="enrollType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student type</label>
                          <select id="enrollType" name='enrollType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                           $getUniqueType = array();

                           foreach ($yearLevel as $studentType) {

                             if (!array_key_exists($studentType['type'], $getUniqueType)) {
                               $getUniqueType[$studentType['type']] = $studentType['type'];
                             }


                           }

                          // Sort the unique records numerically in ascending order
                          ksort($getUniqueType);

                           $getTypeUnique = array_values($getUniqueType);

                            foreach($getUniqueType as $type){

                                $getType = '';

                        
                             if ($type == 1) {
                               $getType = 'Elementary';
                             } elseif ($type == 2) {
                               $getType = 'Junior HighSchool';
                             }  elseif ($type == 3) {
                               $getType = 'Senior HighSchool';
                             }


                             ?>
                              
                            <option value="<?php echo $type ?>"> <?php echo $getType ?></option>
                        



                            <?php

                            }


                          ?>
                          </select>

                    </div>

      <!-- grade-->

              
                     <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>

                </fieldset>
                <fieldset class="my-fieldset">
                     <div id='regGradeLevel'>
                          <label for="regLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your next grade level</label>
                          <select id="regLevel" name='regLevel' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                          </select>

                    </div>

                     <div id='newRegDivSection'>
                          <label for="newRegSection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose grade level</label>
                          <select style='width:100%' id="newRegSection" name='newRegSection' class="selectItem2Lib bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <?php

                        foreach ($sections as $section) {

                          ?>
                                <option value="<?php echo $section['id'] ?>">
                                  <?php echo $section['name'] ?>
                                </option>
                                <?php

                        }

                        ?>
                          </select>

                    </div>

                     <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__3'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                
                </fieldset>
                  <fieldset class="my-fieldset">
                          <legend>Student's Credentials</legend>

                  
              
                       <label for="regCredentialType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credential's type</label>
                      <select id="regCredentialType" name='regCredentialType' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="local">LOCAL</option>
                            <option value="foreign">FOREIGN</option>  
                      </select>


                      <div id='regularLocal' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="reg_report_card" id="reg_report_card" class='regLocal'><label class='ml-4' for="reg_report_card">Report Card</label>
                      </div>
                      <div>
                        <input type="checkbox" name="reg_formsf10" id="reg_formsf10" class='regLocal'><label class='ml-4' for="reg_formsf10">Form 137 /SF10</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_birthcert" id="reg_birthcert" class='regLocal'><label class='ml-4' for="reg_birthcert">Birth Certificate</label>
                      </div>


                      <div>
                        <input type="checkbox" name="reg_cert_gmoral" id="reg_cert_gmoral" class='regLocal'><label class='ml-4' for="reg_cert_gmoral">Certificate of good moral</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_med_cert" id="reg_med_cert" class='regLocal'><label class='ml-4' for="reg_med_cert">Medical Certificate</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_let_rec" id="reg_let_rec" class='regLocal'><label class='ml-4' for="reg_let_rec">Letter of Recommendation</label>
                      </div>

                      </div>

                      <div id='regularForeign' class='hidden'>

                      <div class="mt-4">
                        <input type="checkbox" name="reg_study_permit" id="reg_study_permit" class='regForeign'><label class='ml-4' for="reg_study_permit">Study Permit</label>
                      </div>
                      <div>
                        <input type="checkbox" name="reg_alien_card" id="reg_alien_card" class='regForeign'><label class='ml-4' for="reg_alien_card">Alien Cerfication of REG,ACR,CARD</label>
                      </div>

                      <div>
                        <input type="checkbox" name="reg_passport" id="reg_passport" class='regForeign'><label class='ml-4' for="reg_passport">Passport copy</label>
                      </div>


                      <div>
                        <input type="checkbox" name="reg_auth_rec" id="reg_auth_rec" class='regForeign'><label class=' ml-4' for="reg_auth_rec">Authenticated School Records</label>
                      </div>

                     

                    
                    </div>

                   <div class="flex justify-between items-center mt-5">
                     <button id='prvBtn__4' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__4' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </fieldset>

                <fieldset class="my-fieldset">
                        <legend class='text-center font-semibold text-xl'>Enrollment Fee(Regular)</legend>
                       <div class='flex justify-end items-center '>
                         <p id='printRegReceipt' class="cursor-pointer text-indigo my-2 btn outline outline-offset-2 outline-1 hover:bg-blue-700 hover:text-white p-2 text-indigo-500">Print receipt</p>
                       </div>
                 <div class="flex gap-2 justify-center">

                  <div class="w-7/12 my-2">
                    <p class='text-left'><span id='reg_syYear' class="font-medium">SY:2022-2023</span> <span id='typeFee' clas='font-medium'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <spa id='reg_fLName'n clas='font-medium'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Level:</span> <span id='reg_getSelectedSection' clas='font-medium'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='reg_getDateIssued'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center">

                  <div class="w-6/12 my-2">
                  <div>
                       <p class='text-left mb-1'><span class="font-medium" >Miscellanious fee</span> <span id='reg_misc' clas='font-medium'>₱10,045.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Books and Modules</span> <span id='reg_books' clas='font-medium'>₱5,905.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Tuition fee</span> <span id='reg_tuition' clas='font-medium'>₱15,000.00</span></p>
                    <p class='text-left mb-1'><span class="font-medium" >Total</span> <span id='reg_total' clas='font-medium'>₱30,950</span></p>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium" >Full cash payment</span> <span id='reg_full' clas='font-medium'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-6/12 mx-auto my-2">
                    <div class="flex flex-col justify-between items-center shadow-md py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                   <div class="flex justify-end items-center gap-2 mt-5">
                     <button id='prvBtn__5' type="button" class="hidden w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='nxtBtn__5' data-end='last_record' class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                   </div>
             </fieldset>       

            </form>

                </form>
            </div>
        </div>
    </div>
</div> 





  </div>
</div>

               


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<!-- <script>
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->
  <!-- <script src="http://localhost/biometric-system/src/js/es6-shim.js"></script>
  <script src="http://localhost/biometric-system/src/js/websdk.client.bundle.min.js"></script>
  <script src="http://localhost/biometric-system/src/js/fingerprint.sdk.min.js"></script> -->

  <script src='<?php echo baseUrlScriptSrc('/js/es6-shim.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/websdk.client.bundle.min.js') ?>'></script>
   <script src='<?php echo baseUrlScriptSrc('/js/fingerprint.sdk.min.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/fingerprint.js') ?>'></script>
<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/studentRecFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/face-api.min.js') ?>'></script>