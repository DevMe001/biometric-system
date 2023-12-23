<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">


<?php
use Biometric\Controller\ControllerManager;

$controller = new ControllerManager();


$getSchoolYear = $controller->getSchoolYear();

$schoolId = $getSchoolYear['id'];
$startDate = $getSchoolYear['start_date'];
$endDate = $getSchoolYear['end_date'];

?>



<div class='flex gap-2 items-center mb-5 p-5'>
  <ion-icon name="home-outline"></ion-icon>
  <p class='text-gray-500'>Dashboard /</p>
  <p class='text-indigo-500 '>Schoo Year</p>
</div>

<div class='w-[90%] mx-auto'>


<form id='getSchoolYear'>
  <input type="hidden" name="schoolId" value="<?php echo $schoolId ?>">
  <div class="mb-6">
    <label for="startDate" class="block mb-2 text-md font-semibold text-gray-900 dark:text-white">School Year Started</label>
    <input type="date" id="startDate" name='startDate' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $startDate ?>" />
  </div>
  <div class="mb-6">
    <label for="endDate" class="block mb-2 text-md font-semibold text-gray-900 dark:text-white">School Year Ended</label>
    <input type="date" id="endDate" min="<?php echo date('Y-01-01', strtotime('+1 year')); ?>" name='endDate' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $endDate ?>">
  </div>
 
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
</form>




</div>
</div>
<script>
  const datePicker = document.getElementById('endDate');
  const currentDate = new Date();

  datePicker.addEventListener('input', function () {
    const selectedDate = new Date(datePicker.value);
    if (selectedDate <= currentDate) {
      alert('Please select a date in the next year.');
      datePicker.value = ''; // Clear the input field
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-form@4.3.0/dist/jquery.form.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/schoolYear.js') ?>'></script>