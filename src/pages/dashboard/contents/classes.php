<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$subjects = $controller->getSubjects();

$teactAccount = $controller->getTeachersAccount();
$teacherRecord = $controller->getTeacherDetails();

$sections = $controller->getSections();
$subjectList = $controller->getSubjects();
$gradeLevel = $controller->getYearLevel();

$getClassRec = $controller->getClassRecords();


?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Classes</p>
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
          <input id='classesSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='classesPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalclassesToggle' data-modal-target="classes-modal" data-modal-toggle="classes-modal" class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
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

    <table class="custom-table classes-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2 w-full">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Class name</th>
          <th class='p-2 text-left'>Section</th>
          <th class='p-2 text-left'>Subject</th>
          <th class='p-2 text-left'>Teacher</th>
          <th class='p-2 text-left'>Class limit</th>
          <th class='p-2 text-left'>Room #</th>
          <th class='p-2 text-left'>Scheduled</th>
          <th class='p-2 text-left'>Year level</th>
          <th colspan="3" class='p-2 text-left'>Action</th>

          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>


        <?php

        if(count($getClassRec) > 0){

        foreach ($getClassRec as $keyClass => $class) {



          $classRecDb = json_encode(array('id' => $class['class_id'], 'name' => $class['class_name'],'room_number' => $class['room_number'],'teacherId' => $class['teacher_id'],'section_id' => $class['sectionId'],'subjectId' => $class['subjectId'],'yearId' => $class['yearId'],'timeofDay' => $class['timeofDay'],'schedule' => $class['scheduled_time']));

          $classRecData = htmlspecialchars(str_replace('\\', '', $classRecDb));

          ?>
          
          <tr>
        
            <td class='p-2'>
              <?php echo $keyClass + 1 ?>
            </td>
             <td class='p-2'>
              <?php echo strtoupper($class['class_name']) ?>
              </td>
      
                  <td class='p-2'>
                    <?php echo $class['sectionName'] ?>
                  </td>

                      <td class='p-2'>
                        <?php echo strtoupper($class['subjectName']) ?>
                      </td>
                          <td class='p-2'>
                            <?php echo strtoupper($class['teacherName']) ?>
                          </td>
                     
                <td class='p-2'>
                  <?php echo $class['class_limit'] ?>
                </td>
                <td class='p-2'>
                <?php echo $class['room_number'] ?>
                  </td>
                    <td class='p-2'>
                <?php echo $class['scheduled_time']?>
                      </td>
                       <td class='p-2'>
                <?php echo $class['yearName'] ?>
                        </td>
                <td onclick='editClass(<?php echo $classRecData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="create-outline"></ion-icon></td>
            <td onclick='deleteClass(<?php echo $classRecData; ?>)'
              class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon
                name="trash-outline"></ion-icon></td>
          </tr>

            <!-- create center no match found -->
            <tr id='classesNoResult' class='hidden'>
              <td colspan='10' class='text-center text-gray-500'>No match found</td>

          <?php
        }
          # code...
        }
        else{
          ?>
          
        <!-- create center no match found -->
        <tr id='classesNoResult' class='hidden'>
          <td colspan='10' class='text-center text-gray-500'>No match found</td>
        <?php
        }


        ?>


      </tbody>



    </table>

    <!-- printing code -->

    <table class="classes-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
         <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Subject Name</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>

        <?php


        foreach ($getClassRec as $keyClass => $class) {



          $classRecDb = json_encode(array('id' => $class['class_id'], 'name' => $class['class_name']));

          $classRecData = htmlspecialchars(str_replace('\\', '', $classRecDb));

          ?>
          
            <tr>
        
              <td class='p-2'>
                <?php echo $keyClass + 1 ?>
              </td>
               <td class='p-2'>
                <?php echo $class['name'] ?>
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
        <button onclick='prevBtn(".classes-table")'
          class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
      <span> |</span>
      <span>
        <button onclick='nextBtn(".classes-table","classesNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addclasses" data-modal-toggle="addclasses" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="classes-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-lg max-h-full" data-modal-backdrop="static">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='classesCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="classes-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='studentTitle'>Create</span> new class</h3>
            <form id='classesForm' class="space-y-6">
               
        <fieldset class='fieldset-class'>
     
                <input type="hidden" name="classId" id='classId'>

              <div class="relative z-0 w-full mt-4 group">
                        <label for="className"
                        class="mb-1 ">Class name </label>
                      <input type="text" name="classesName" id="classesName"
                        class="char-allowed uppercase border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
             </div> 

             <div class="relative z-0 w-full mt-4 group">
                        <label for="className"
                        class="mb-1 ">Room #</label>
                      <input type="number" name="roomNumber" id="roomNumber" maxlength="2"
                        class="limitLength disabled-key border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
             </div> 






             <div class='mb-4'>

               
                          <label for="teacherClassItem" class="w-full block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher name</label>
                           <select style="width: 100%;" id="teacherClassItem" name='teacherClassItem' class="selectItem2Lib py-2 px-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                             
                                foreach ($teacherRecord as $teacher) {
    

                                  ?>
                                      
                                      <option value="<?php echo $teacher['teacher_profile_id'] ?>"> <?php echo $teacher['fullName'] ?></option>
                                                  
        
        
        
                                      <?php

                                }


                                ?>
                          </select>
               </div>


                   <div class='mb-4'>

               
                          <label for="classSectionName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class section</label>
                           <select style="width:100%;" id="classSectionName" name='classSectionName' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                          <?php

                             
                                foreach ($sections as $section) {
    

                                  ?>
                                      
                                      <option value="<?php echo $section['id'] ?>"> <?php echo $section['name'] ?></option>
                                                  
        
        
        
                                      <?php

                                }


                                ?>
                          </select>
               </div>


      
        

                  <div  class="flex justify-between items-center mt-5 ">
                  

                      <button id='classNextBtn__1'  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                    
                   </div>


        </fieldset>


        <fieldset class='fieldset-class'>



        

                   <div class='mb-4'>

               
                          <label for="classSubjectName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject name</label>
                           <select style="width:100%;" id="classSubjectName" name='classSubjectName' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          classSubjectName
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




          
                   <div class='mb-4'>

               
                          <label for="classYearLevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade level</label>
                           <select style="width:100%;" id="classYearLevel" name='classYearLevel' class="selectItem2Lib px-5 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
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


               
          
           


                   <div  class="flex justify-between items-center mt-5 ">
                     <button id='classPrevBtn__2' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='classNextBtn__2'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Next</button>
                     </div>




        </fieldset>

        <fielset class="fieldset-class">



                                
       


    

                <div class='mb-4'>

               
                          <label for="timeofDay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time of Day</label>
                           <select id="timeofDay" name='timeofDay' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                          
                            <option value=""></option>
                            <option value="morning">MORNING</option>
                            <option value="afternoon">AFTERNOON</option>
                            <option value="night">NIGHT</option>
                          
                          </select>


                          
                    
               </div>


             <div class="flex gap-2 justify-between">
                    <div class="relative z-0 w-full mt-4 group">
                        <label for="className"
                        class="mb-1 ">Start class</label>
                      <input type="time" name="startTime" id="startTime" 
                        class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
                    </div> 
                      <div class="relative z-0 w-full mt-4 group">
                        <label for="className"
                        class="mb-1 ">End class</label>
                      <input type="time" name="endTime" id="endTime" 
                        class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                    
                    </div> 
             </div>

             
          
                     <div  class="flex justify-between items-center mt-5 ">
                     <button id='classPrevBtn__3' type="button" class="w-[10rem] text-white bg-cyan-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Previous</button>
                     <button id='classNextBtn__3'  class="w-[10rem] text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                     </div>


        </fielset>

      
               
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
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->
<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/classesFunction.js') ?>'></script>