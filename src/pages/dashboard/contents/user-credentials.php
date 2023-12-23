<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$users = $controller->getUsers();



?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Users</p>
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
          <input id='usersSearchEl' type="text" placeholder="Search here">
          <ion-icon name="search-outline"></ion-icon>
        </label>
      </div>
      <!-- print -->
      <div>
        <button id='usersPrint'
          class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
      </div>

      <div id='onModalusersToggle' data-modal-target="users-modal" data-modal-toggle="users-modal"
        class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
        <button class='text-center py-3 font-bold text-md'>+</button>
      </div>
    </div>

  </div>




  <!-- wrapper for table  need to use grid-->
  <div class='w-full mx-auto bg-white-500 shadow rounded mt-10'>

     <table class="custom-table users-table w-auto md:min-w-[37.5rem] lg:min-w-[100%] mx-auto mb-2">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Username</th>
          <th class='p-2 text-left'>Password</th>
          <th class='p-2 text-left'>Role</th>
          <th colspan="2" class='p-2 text-left'>Action</th>
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>


        <?php

        foreach ($users as $keyUser => $user) {



          $usersRec = json_encode(array('id' => $user['id'], 'username' => $user['username'], 'role' => $user['role']));

          $userRecord = htmlspecialchars(str_replace('\\', '', $usersRec));


          if($_SESSION['users']){
            $role = $_SESSION['users']['role'];

            if($role == 1){
              ?>
               <tr>

            <td class='p-2'>
              <?php echo $keyUser + 1 ?>
                      </td>
                      <td class='p-2'>
                        <?php echo $user['username'] ?>
                      </td>
                      <td class='p-2'>
                        <?php echo $user['password'] ?>
                      </td>
                      <td class='p-2 w-3'>
                        <?php echo $user['role'] == 1 ? 'ADMIN' : 'TEACHER' ?>
                      </td>
                      <td onclick='editUser(<?php echo $userRecord; ?>)' class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
                        <ion-icon name="create-outline"></ion-icon>
                      </td>
                      <td onclick='deleteUser(<?php echo $userRecord; ?>)'
                        class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
                        <ion-icon name="trash-outline"></ion-icon>
                      </td>
                    </tr>
              <?php
            ?>

              
              <?php
            }
            else{
             if($user['username'] == $_SESSION['users']['username'] && $user['role'] == $_SESSION['users']['role']){?>
              <tr>

            <td class='p-2'>
              <?php echo $keyUser + 1 ?>
                  </td>
                  <td class='p-2'>
                    <?php echo $user['username'] ?>
                  </td>
                  <td class='p-2'>
                    <?php echo $user['password'] ?>
                  </td>
                  <td class='p-2 w-3'>
                    <?php echo $user['role'] == 1 ? 'ADMIN' : 'TEACHER' ?>
                  </td>
                  <td onclick='editUser(<?php echo $userRecord; ?>)' class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
                    <ion-icon name="create-outline"></ion-icon>
                  </td>
                  <!-- <td onclick='deleteUser(<?php echo $userRecord; ?>)'
                    class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
                    <ion-icon name="trash-outline"></ion-icon>
                  </td> -->
                </tr>

           <?php }?>



            <?php
          }

           ?>
           
           <?php
          }

          ?>

        
          <?php
          # code...
        }


        ?>


        <!-- create center no match found -->
        <tr id='usersNoResult' class='hidden'>
          <td colspan='4' class='text-center text-gray-500'>No match found</td>
      </tbody>



    </table>
`

    <!-- printing code -->
      <table class="users-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
      <thead class='bg-[#19397D] text-white mx-auto'>
        <tr>
          <th class='p-2 text-left'>#</th>
          <th class='p-2 text-left'>Username</th>
          <th class='p-2 text-left'>Password</th>
          <th class='p-2 text-left'>Role</th>
       
          <!-- <th class='p-2 text-left'>Date created</th> -->
        </tr>
      </thead>
      <tbody>


        <?php

                foreach ($users as $keyUser => $user) {



                  $usersRec = json_encode(array('id' => $user['id'], 'username' => $user['username'], 'role' => $user['role']));

                  $userRecord = htmlspecialchars(str_replace('\\', '', $usersRec));


                  if ($_SESSION['users']) {
                    $role = $_SESSION['users']['role'];

                    if ($role == 1) {
                      ?>
                      <tr>
            
                        <td class='p-2'>
                          <?php echo $keyUser + 1 ?>
                        </td>
                        <td class='p-2'>
                          <?php echo $user['username'] ?>
                        </td>
                        <td class='p-2'>
                          <?php echo $user['password'] ?>
                        </td>
                        <td class='p-2 w-3'>
                          <?php echo $user['role'] == 1 ? 'ADMIN' : 'TEACHER' ?>
                        </td>
                      
                      </tr>
                      <?php
                      ?>
            
            
                      <?php
                    } else {
                      if ($user['username'] == $_SESSION['users']['username'] && $user['role'] == $_SESSION['users']['role']) { ?>
                        <tr>
            
                          <td class='p-2'>
                            <?php echo $keyUser + 1 ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $user['username'] ?>
                          </td>
                          <td class='p-2'>
                            <?php echo $user['password'] ?>
                          </td>
                          <td class='p-2 w-3'>
                            <?php echo $user['role'] == 1 ? 'ADMIN' : 'TEACHER' ?>
                          </td>
                         
                          <!-- <td onclick='deleteUser(<?php echo $userRecord; ?>)'
                                class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'>
                                <ion-icon name="trash-outline"></ion-icon>
                              </td> -->
                        </tr>
            
                      <?php } ?>
            
            
            
                      <?php
                    }

                    ?>
            
                    <?php
                  }

                  ?>
            
            
                  <?php
                  # code...
                }


                ?>
            
            
                <!-- create center no match found -->
                <tr id='usersNoResult' class='hidden'>
                  <td colspan='4' class='text-center text-gray-500'>No match found</td>
              </tbody>
            
            
            
            </table>

    <!-- end printing code -->

    <hr />
    <div class='flex justify-end gap-2 pr-5 items-center'>

      <span>
        <button onclick='prevBtn(".users-table")'
          class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
      <span> |</span>
      <span>
        <button onclick='nextBtn(".users-table","usersNoResult")'
          class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
      </dv>
    </div>



    <!-- modal for add edit -->

    <!-- Modal toggle -->
    <!-- <button data-modal-target="addusers" data-modal-toggle="addusers" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

    <!-- Main modal -->
    <div id="users-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-lg max-h-full" data-modal-backdrop="static">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button id='usersCloseModal' type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
            data-modal-hide="users-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='userTitle'>Create</span> account</h3>
            <form id='usersForm' class="space-y-6">
              <input type="hidden" name="credential_id" id='credential_id'>
               <fieldset>

                   <div class="relative z-0 w-full mb-6 mt-2 group">
                      <input type="text" name="usernameAccount" id="usernameAccount"
                        class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                      <label for="usernameAccount"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:top-1  pl-1  peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                    </div>

                    <div class="relative z-0 w-full mb-6 mt-2 group">
                      <input type="password" name="passwordAccount" id="passwordAccount"
                        class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />
                      <label id='editPassLabel' for="passwordAccount"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:top-1  pl-1  peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>

                    <div>
                          <select id="roleAccount" name='roleAccount' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Choose role</option>
                            <option value="1">Admin</option>
                            <option value="2">Teacher</option>
                          </select>
                    </div>
                 
                 
                   <div class="flex justify-between items-center mt-5">
                     <button id='submitUserCredentials'  class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                    
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
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script> -->
<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/usersFunction.js') ?>'></script>