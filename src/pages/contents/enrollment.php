<style>
  .border-custom {
    border-bottom: 1px solid #eaeaea !important;
  }


</style>

<link rel="stylesheet" href="<?php echo baseUrlScriptSrc('/css/global.css') ?>">
<form id='findLrn'>
<fieldset class='my-4 bg-white max-w-md mx-auto'>
  <legend class='text-center font-semibold text-3xl'>Enrollment Form</legend>
  
<div class='border border-gray-200 rounded-lg shadow mt-5 p-8'>
  <div class="relative z-0 w-full mb-6 group">
      <label for="lrn"
        class="font-medium peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 duration-300 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Learner Reference Number </label>

    <input  maxlength="12" type="number" name="lrn" id="lrn"
      class="border-custom limitLength disabled-key text-center block py-2.5 px-0 font-semibold w-full text-md text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
    </div>
 <div class='flex justify-end'>
   <button id='btnSearch' type="button"
    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>

 </div>
 </div>
</fieldset>
</form>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>

<script>
  $(document).ready(function() {
    // Set up validation rules
    $("#findLrn").validate({
      rules: {
        lrn: {
          required: true,
        }
      },
      messages: {
        lrn: {
          required: "Please enter the Learner Reference Number.",
        }
      },
    });

    // Attach a click event to the search button
    $("#btnSearch").on("click", function(e) {
      e.preventDefault();
      
      // Manually trigger the validation for the Learner Reference Number input
      if ($("#lrn").valid()) {
     
        // Get the form data
        var formData = document.getElementById('findLrn').elements;


        // Send the form data to the server

        console.log(formData,'lrn')

      	const getResponse = {
          lrn: formData[1].value,
        };


        httpJSONReq("getEnrollmentRec",getResponse, function(response) {
          // Check if the response is successful
          if (response.success) {

           
            addIndexDb(response.studentRecord);


           setTimeout(() => {
             window.location.href = '?page=viewrecord';
           }, 2000);

            

          } else {
            // Display the error message
              Swal.fire({
                icon:'error',
                title:'Forbidden request',
                text:response.message,
                footer:null
              });
          }
        });



      } else {
        // Validation failed, display errors
        console.log("Please fix the errors before searching.");
      }
    });
  });
</script>