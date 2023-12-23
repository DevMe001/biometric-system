<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$userAccounts = $controller->getUsers();
$teactAccount = $controller->getTeachersAccount();
$sections = $controller->getSections();
$subjectList = $controller->getSubjects();
$gradeLevel = $controller->getYearLevel();
$teacherRecord = $controller->getTeacherDetails();
$isRecord = count($teacherRecord) > 0 ? true : false;

?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Teacher</p>
</div>

<div class='w-[90%] mx-auto'>


  <!-- breadcrums  -->



  <!-- wrapper  filter-->
  <div class='w-full mx-auto'>
    <!-- filter search -->

    <div class='w-[80%] flex justify-between items-center gap-5 mx-auto'>
      <!-- sort -->
      <div>
        <?php require_once(__DIR__ . '/widget/widget.php'); ?>
        <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
      </div>
      <!-- search -->
      <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
        <label>
          <input id='teacherSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='teacherPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalteacherToggle' data-modal-target="teacher-modal" data-modal-toggle="teacher-modal"
        class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
      </div>
    </div>

  </div>




  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10 overflow-x-auto'>

    <!-- <div class="absolute bottom-20 right-20">

       <div class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
       </div>
      </div> -->

    <table class="custom-table teacher-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Full name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Course Taken</th>
          <th class='p-2 text-left'>Subjects chosen</th>
          <th colspan="2" class='p-2 text-left'>Action</th>
        
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>


        <?php

          if($isRecord){
          
          
          foreach ($teacherRecord as $key =>  $info) {



            $recordProfile = json_encode(array('id' => $info['teacher_profile_id'], 'name' => $info['fullName'], 'profile' => $info['profile'], 'gender' => $info['gender'], 'age' => $info['age'], 'course_taken' => $info['course_taken'], 'birthdate' => $info['birthdate'], 'address' => $info['address'],'account_id' => $info['account_id'],'subjectChosenId'=>$info['subjectIdLevel']));

            $teacherData = htmlspecialchars(str_replace('\\', '', $recordProfile));

            $typeChooses = '';
            


      
          ?>
          <tr>
            <td class='p-2'>
              <?php echo $key + 1 ?>
            </td>
            <td class='p-2'>
              <?php echo strtoupper($info['fullName'])?>
            </td>

            <td class='p2'>
                  <img class='rounded object-cover' id='cutomStyleImg'
                    src="<?php echo baseUrlImageSrc('uploads/teacher-profile/' . $info['profile']) ?>" alt="profile">
           </td>
            <td class='p-2'>
              <?php echo $info['gender'] ?>
            </td>
            <td class='p-2'>
              <?php echo $info['age'] ?>
            </td>
            <td class='p-2'>
              <?php echo $info['birthdate'] ?>
            </td>
            <td class='p-2'>
              <?php echo $info['address'] ?>
            </td>
            <td class='p-2'>
              <?php echo $info['course_taken'] ?>
            </td>
            <td class='p-2'>
              <?php echo $info['subjectChosen'] ?>
              </td>
                <td onclick='editteacher(<?php echo $teacherData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="create-outline"></ion-icon></td>
            <td onclick='deleteteacher(<?php echo $teacherData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="trash-outline"></ion-icon></td>
          </tr>
               <tr id='teacherNoResult' class='hidden'>
              <td colspan='10' class='text-center text-gray-500'>No match found</td>
    
          <?php }?>
          <?php
          }
          else{
            ?>
              <!-- create center no match found -->
            <tr id='teacherNoResult' class='hidden'>
              <td colspan='10' class='text-center text-gray-500'>No match found</td>
          <?php
          }

        ?>


      
      </tbody>



    </table>

    <!-- printing code -->

    <table class="teacher-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
            <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Full name</th>
          <th class='p-2 text-left'>Profile</th>
          <th class='p-2 text-left'>Gender</th>
          <th class='p-2 text-left'>Age</th>
          <th class='p-2 text-left'>Birthdate</th>
          <th class='p-2 text-left'>Address</th>
          <th class='p-2 text-left'>Course Taken</th>
          <th class='p-2 text-left'>Subjects chosen</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php

        foreach ($teacherRecord as $key => $info) {




          ?>
          <tr>
             <td class='p-2'>
              <?php echo $key + 1 ?>
              </td>
              <td class='p-2'>
                <?php echo strtoupper($info['fullName']) ?>
              </td>
            
              <td class='p2'>
                <img class='rounded object-cover' id='cutomStyleImg'
                  src="<?php echo baseUrlImageSrc('uploads/teacher-profile/' . $info['profile']) ?>" alt="profile">
              </td>
              <td class='p-2'>
                <?php echo $info['gender'] ?>
              </td>
              <td class='p-2'>
                <?php echo $info['age'] ?>
              </td>
              <td class='p-2'>
                <?php echo $info['birthdate'] ?>
              </td>
              <td class='p-2'>
                <?php echo $info['address'] ?>
              </td>
              <td class='p-2'>
                <?php echo $info['course_taken'] ?>
              </td>
              <td class='p-2'>
                <?php echo $info['subjectChosen'] ?>
              </td>
            </tr>
          <?php
          # code...
        }


        ?>

      </tbody>

    </table>

    <!-- end printing code -->

    <hr />
    <div class='flex justify-end gap-2 pr-5 items-center'>

      <span>
        <button onclick='prevBtn(".teacher-table")'
          class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
      <span> |</span>
      <span>
        <button onclick='nextBtn(".teacher-table","teacherNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addteacher" data-modal-toggle="addteacher" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="teacher-modal" data-modal-backdrop='static' tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='teacherCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="teacher-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='teacherTitle'>Create</span> teacher account</h3>
            <form id='teacherForm' class="space-y-6">
               <fieldset class='teacherFieldset'>
                      <input type="hidden" id='teacher_id' name="teacher_id">
                      <input type="hidden" id='oldTeacherProfile' name="oldTeacherProfile">
                  <div class='mb-4'>

               
                          <label for="accountSelection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose account</label>
                           <select style="width:100%;" id="accountSelection" name='accountSelection' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                             
                                foreach ($teactAccount as $user) {
    

                                  ?>
                                      
                                      <option value="<?php echo $user['id'] ?>"> <?php echo $user['username'] ?></option>
                                                  
        
        
        
                                      <?php

                                }


                                ?>
                          </select>
                    </div>

                     <div class="relative z-0 w-full mt-4 group">
                        <label for="teach_fullname"
                        class="mb-1 ">Teacher name</label>
                      <input type="text" name="teach_fullname" id="teach_fullname"
                        class="char-allowed uppercase border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
                    </div>

                                   
                            <!-- end bday -->
                     <div class="relative z-0 w-full mt-4 group">
                        <label for="courseTaken"
                        class="mb-1 ">Course Taken</label>
                      <input type="text" name="courseTaken" id="courseTaken"
                        class="char-allowed uppercase border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
                    </div>


                       <div class="relative z-0 w-full mt-4 group">
                        <label for="teacherAddress"
                        class="mb-1 ">Address</label>
                      <input type="text" name="teacherAddress" id="teacherAddress"
                        class="uppercase border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
                    </div>





                 
                   <div class="flex justify-between items-center mt-5">
                     <button id='teachNextBtn__1'  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                    
                   </div>
                   
                </fieldset>

                 <fieldset class='teacherFieldset'>
              
                   <div class="w-full mx-auto mt-3">
                      
                        <!-- display profileImg -->
                       <label for="teacherProfile" class="cursor-pointer " title="Choose file">
                        
                          <div id='previewTeacherDiv' class='w-[150px] h-[150px] shadow-1 border-1 bg-[#eaeaea] mx-auto px-5 py-10 rounded'>
                         <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-center">
                        <ion-icon name="image-outline" class='default-imgProfile w-[50px] h-[50px] text-[#19397D]'></ion-icon> 
                          <p class='default-imgProfile text-gray-600 text-center text-sm font'>2X2 picture</p> 
                          </div>
                        

                         </div>
                        </label>
                      
                        <input type="file" name="teacherProfile" id="teacherProfile" class="hidden" accept="image/*" required>
                          
                  </div>


                    <div>
                       <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                      <select id="teacherGender" name='teacherGender' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="transgender">Transgender</option>
                           
                      </select>

                

                    <div>
                        <label for="teacherBirthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                        <input type="date" name="teacherBirthday" id="teacherBirthday" class="bday bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>


                    <!-- end bday -->
                      <div id='teacherAgeReveal' class="hidden">
                        <label for="age" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <div id='getTeacheryAge' class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white'>7-25</div>
                        <input type="hidden" id='teacherAge' name="teacherAge">
                    </div>

     

                 

                 
          
                    <div class="flex justify-between items-center mt-5">
                     <button id='teachPrevBtn__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='teachNextBtn__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                   </div>
                </fieldset>
       
              
                <fieldset class=' teacherFieldset'>
                          <legend>Subject Chosen</legend>
                  <div class="subjectContainer">
                      <div  class="subjectItem flex justify-between gap-2 mb-2">

                                <input type="hidden" name="teacherRecordId0" id='teacherRecordId0' class='teach-rec'>
                                        
                                  <div class="w-5/12 flex flex-col gap-2 items-center">
                                            <select id="teacherSubjectChosen0" name='teacherSubjectChosen0' class="subject-list bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            
                                              <option value=""></option>
                                            <?php

                                              
                                                  foreach ($subjectList as $subject) {
                      

                                                    ?>
                                                        
                                                        <option value="<?php echo $subject['id'] ?>"> <?php echo $subject['name'] ?></option>
                                                                    
                          
                          
                          
                                                        <?php

                                                  }


                                                  ?>
                                          </select>
                                      </div>


                                        <div class="w-5/12 flex flex-col gap-2 items-center mb-2">
                                          <select id="teacherYearLevel0" name='teacherYearLevel0' class="level-list bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            
                                              <option value=""></option>
                                            <?php

                                              
                                                  foreach ($gradeLevel as $grade) {
                      

                                                    ?>
                                                        
                                                        <option value="<?php echo $grade['id'] ?>"> <?php echo $grade['name'] ?></option>
                                                                    
                      
                                                <?php

                                                  }


                                                  ?>
                                        </select>
                                      
                                  </div>
                                  
                                      <div id='btnSubjectCont' class="w-2/12 flex flex-col gap-2 items-center button-item">
                                        <label for='teacherYearLevel'><button  type='submit' class="appendSubject btn bg-blue-600 text-white px-5 py-2 rounded">+</button></label>
                                      </div>

                              </div>

                  </div>


            
                   <div id='onreadytoSubmit' class="flex justify-between items-center mt-5 hidden">
                     <button id='teachPrevBtn__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='teachNextBtn__3'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                     </div>
               </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- edit modal -->



  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- <script>
  $("#accountSelection").select2({
  tags: "true",
  placeholder: "Select an option",
  allowClear: true
});
</script> -->

<!-- <script>
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->

<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/teacherFunction.js') ?>'></script>