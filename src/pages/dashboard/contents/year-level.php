<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">




<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$yearLvl = $controller->getYearLevel();



?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Year Level</p>
</div>

<div class='w-[90%] mx-auto'>


<!-- breadcrums  -->


  
  <!-- wrapper  filter-->
  <div class='w-full mx-auto over'>
      <!-- filter search -->

  <div class='w-[80%] flex justify-between items-center gap-5 mx-auto'>
    <!-- sort -->
    <div>
     <button id="yearDropdownBtn" data-dropdown-toggle="yearDropdownMenu"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      type="button">Sort by <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
        fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
      </svg>
    </button>

    <!-- Dropdown menu -->
    <div id="yearDropdownMenu" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
      <ul  class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">

      </ul>
    </div>


     <!-- <p class='text-md text-gray-500 font-bold'>Sort <span class='btn btn-blue-500 p-2'>▼</span></p> -->
    </div>
     <!-- search -->
   <div class="search focus:outline focus:outline-offset-2 focus:outline-1 focus:outline-blue-500 focus:rounded">
                    <label>
                        <input id='yearSearch' type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
   </div>
    <!-- print -->
     <div>
      <button id='print' class='btn outline outline-offset-2 outline-1  hover:bg-blue-500 hover:text-white px-5 py-2 text-indigo-400 rounded'>Print</button>
    </div>

     <div id='onModalYearToggle' data-modal-target="addYearLevel-modal" data-modal-toggle="addYearLevel-modal" class="rounded-full bg-[#19397D] text-white w-[50px] h-[50px] text-center align-middle">
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

  <table class="custom-table year-table w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 w-full">
  <thead class='bg-[#19397D] text-white mx-auto'>
    <tr>
      <th class='p-2 text-left'>Id</th>
      <th class='p-2 text-left'>Name</th>
      <th class='p-2 text-left'>Level</th>
      <th class='p-2 text-left'>Qualified age</th>
       <th colspan="2" class='p-2 text-left'>Action</th>
      <!-- <th class='p-2 text-left'>Date created</th> -->
    </tr>
  </thead>
  <tbody>
   
     <?php

      foreach ($yearLvl as $key => $year) {

       $getLevel = '';

       if ($getLevel == 1) {
         $getType = 'Elementary';
       } elseif ($type == 2) {
         $getType = 'Junior HighSchool';
       } elseif ($type == 3) {
         $getType = 'Senior HighSchool';
       }

       $record =  json_encode(array('id' => $year['id'],'name' => $year['name'],'type' => $year['type'],'qualifyAge' => $year['qualify_age']));

       $objectData = htmlspecialchars(str_replace('\\', '', $record));

       ?>
         <tr>
        <td class='p-2'><?php echo $key + 1 ?></td>
          <td class='p-2'><?php echo $year['name'] ?></td>
       
         <td class='p-2'><?php echo $getLevel ?>
          <td class='p-2'><?php echo $year['qualify_age'] ?>
          </td> 
          <td onclick="editYrlLevel(<?php echo $objectData; ?>)" class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="create-outline"></ion-icon></td>
            <td onclick="deleteYrlLevel(<?php echo $objectData; ?>)" class='p-2 cursor-pointer hover:bg-bg-white hover:text-indigo-600'><ion-icon name="trash-outline"></ion-icon></td>
             </tr>
      <?php
        # code...
      }


      ?>
   
  
   <!-- create center no match found -->
    <tr id='yrNoResult' class='hidden'>
      <td colspan='4' class='text-center text-gray-500'>No match found</td>
  </tbody>

 

</table>

<!-- printing code -->

  <table class="year-printable printable w-auto md:min-w-[37.5rem] lg:min-w-[40rem] mx-auto mb-2 hidden">
  <thead class='bg-[#19397D] text-white mx-auto'>
    <tr>
      <th class='p-2 text-left'>Id</th>
      <th class='p-2 text-left'>Name</th>
      <th class='p-2 text-left'>Level</th>
      <!-- <th class='p-2 text-left'>Date created</th> -->
    </tr>
  </thead>
  <tbody>
   
     <?php

      foreach ($yearLvl as $key => $year) {

       $getLevel = '';
       if ($year['type'] == 1) {
         $getLevel = 'Elementary';
       } elseif ($year['type'] == 2) {
         $getLevel = 'Junior HighSchool';
       } elseif ($year['type'] == 3) {
         $getLevel = 'Senior HighSchool';
       }


       ?>
        <tr>
          <td class='p-2'>
            <?php echo $key ?>
          <td class='p-2'>
            <?php echo $year['name'] ?>
          </td>
          </td>
          <td class='p-2'>
            <?php echo $getLevel ?>
          </td>
          <!-- <td class='p-2'><?php echo $year['date_created'] ?></td> -->
        </tr>
        <?php
        # code...
      }


      ?>
 
    </tbody>
  
  </table>

  <!-- end printing code -->

<hr/>
<div class='flex justify-end gap-2 pr-5 items-center'>
  
      <span>
        <button  onclick='prevBtn(".year-table")' class='prev btn btn-blue-500 p-2 text-gray-500 rounded'>Prev</button>
      </span>
     <span> |</span>
      <span>
        <button onclick='nextBtn(".year-table","yrNoResult")' class='next btn btn-blue-500 p-2 text-gray-500 rounded'>Next</button>
      </span>
  </dv>
</div>


<!-- modal for add edit -->

<!-- Modal toggle -->
<!-- <button data-modal-target="addYearLevel" data-modal-toggle="addYearLevel" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
  Toggle modal
</button> -->

<!-- Main modal -->
<div id="addYearLevel-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id='closeModalYr' type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addYearLevel-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white"><span id='yrTitle'>Create</span> new year level</h3>
                <form id='yearLevelForm' class="space-y-6" >
                  <input type="hidden" name='yrId'  id='yrId' data-editable=''>
                    <div>
                        <label for="yrName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year Name</label>
                        <input type="text" name="yrName" id="yrName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>
                    <div>
                     
                          <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose level</label>
                          <select id="type" name='type' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option  value='' selected>Year Level</option>
                            <option value="1">Elementary</option>
                            <option value="2">Junior Highschool</option>
                            <option value="3">Senior Highschool</option>
                          </select>

                    </div>

                     <div>
                        <label for="qualifyAge" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualify age</label>
                        <input type="number" name="qualifyAge" id="qualifyAge" maxlength="2" class="limitLength disabled-keybg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="" required>
                    </div>
                   
                    <button id='yrBtn' type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                   
                </form>
            </div>
        </div>
    </div>
</div> 

<!-- edit modal -->



</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    


<!-- <script>

  $('#yearLevelForm').validate({
	rules: {
		yrName: {
			required: true,
			minlength: 3,
		},
		type: {
			required: true,
		},
	},
	messages: {
		yrName: {
			required: 'Please enter year level name',
			minlength: 'Please enter at least 3 characters',
		},
		type: {
			required: 'Please select year level',
		},
	},
	submitHandler: function (e) {

    e.preventDefault();
  
		
		
		const form = document.getElementById('yearLevelForm');

		const formData = new FormData(form);


		const data = {};

		for (let pair of formData.entries()) {
			data[pair[0]] = pair[1];
		}


		console.log(data,'get data')

		// //     // xhttp
		// let xhttp = new XMLHttpRequest();

		// let url = '';
		// let action = '';

		// const editable = $('#yrId').data('editable');

		// if (editable == true) {
		// 	url = 'src/function/controller.php?action=updateYrLevel';
		// 	action = 'update';
		// } else {
		// 	url = 'src/function/controller.php?action=addYrLevel';
		// 	action = 'add';
		// }

		// xhttp.open('POST', url, true);

		// xhttp.onreadystatechange = function () {
		// 	if (this.readyState == 4) {
		// 		if (this.status === 200) {
		// 			let response = JSON.parse(this.responseText);

		// 			if (response.success == true) {
		// 				console.log(response.success);

		// 				location.href = `?page=dashboard&action=tab5&${action}=true&msg=${response.message}`;
		// 			}
		// 		} else {
		// 			console.log(this.responseText);

		// 			//    Swal.fire({
		// 			//   icon: 'error',
		// 			//   title: 'Oops...',
		// 			//   text: `Please complete all requirement`,
		// 			//   footer: ''
		// 			// })
		// 		}
		// 	}
		// };

		// // payload
		// let payload = `data=${JSON.stringify(data)}`;

		// xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		// xhttp.send(payload);
	}
});

</script> -->

<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script>
  var scriptElement = document.querySelector("script[src='']");
  if (!scriptElement) {
    var newScript = document.createElement('script');
    newScript.src = '<?php echo baseUrlScriptSrc('/js/features/tableFunction.js') ?>';
    document.head.appendChild(newScript);
  }
</script>
<script src='<?php echo baseUrlScriptSrc('/js/features/yearLvlFunction.js') ?>'></script>


