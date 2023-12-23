<?php
  if(isset($_GET['logout'])){
   session_destroy();

  }


?>


<style>
  .border-custom {
    border: 1px solid #eaeaea !important;
  }

  [id*="-error"] {
    color: #ff3333 !important;
    text-transform: none !important;
  }

</style>


<fieldset class='my-4 bg-white max-w-md mx-auto'>
<form id='loginForm' class='border border-gray-200 rounded-lg shadow mt-5 p-10'>
  <legend class='font-semibold text2xl mb-4'>Sign in to our platform</legend>

   <div class="relative z-0 w-full mb-2 mt-2 group">
     <label for="usernameAccount"
      class="font-medium peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 duration-300 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>

    <input type="text" name="usernameAccount" id="usernameAccount"
      class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
     </div>

  <div class="relative z-0 w-full mb-6 mt-2 group">
   <label id='editPassLabel' for="passwordAccount"
      class="font-medium peer-focus:font-medium text-sm text-gray-500 dark:text-gray-400 duration-300 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>

    <input type="password" name="passwordAccount" id="passwordAccount"
      class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
   </div>

  <div class="relative z-0 w-full">
    <div class='flex flex-1 justify-center'>
       <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>

    </div>
  </div>
  </div>
 
</form>


</fieldset>



<script>



$.validator.addMethod('password_restrict', function (value) {
      const reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
      return reg.test(value);
  });

$('#loginForm').validate({
  // rules
  rules:{
     usernameAccount:{
      required:true
    
      },
      passwordAccount:{
        required:true,
        password_restrict:true
      }, 
  },
  messages: {
      usernameAccount: {
     required: "Username cannot be empty.."
     },
      passwordAccount:{
        required: "Password  cannot be empty.",
        password_restrict: "Password must be (1 uppercase, 1 number, 1 special character, 8 character limit.",
      }
  },
  // message

   submitHandler:function(){


    var form = document.getElementById("loginForm");
    var formData = new FormData(form);
  
    var data = {};

    for (var pair of formData.entries()) {
    data[pair[0]] = pair[1];
    }
          
    
         // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();

    // Define the HTTP method, URL, and set asynchronous to true
    xhttp.open("POST", "src/function/controller.php?action=login", true);

    // Set the request header, if needed
    // xhttp.setRequestHeader("Content-Type", "application/json");

    // Define the function to handle the response
    xhttp.onreadystatechange = function () {

   

        let response = JSON.parse(this.responseText);

        if (this.readyState === 4) {
            if (this.status === 200) {
                // Handle the response
            

            if(response.success === true){
              location.href='?page=dashboard'
            }
            else {

               
                console.log(response,'get res')
                // Handle the error
                 Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Invalid credentials',
                  footer: ''
            })

                console.error("Request failed with status: " + this.status);
            }

            } 
        }
    };

    // Convert the data to a JSON string
   let payload = `data=${JSON.stringify(data)}`;


    // chech type
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Send the request with the payload
    xhttp.send(payload);
 

    //    $.ajax({
    //             url: 'src/function/controller.php',
    //                 type: "POST",
    //                 data: formData,
    //                 processData: false,
    //                 contentType: false,
    //                 async: false,
    //                 cache: false,
    //                 dataType: 'json',
    //             success: function (response) {
                 
    //               console.log(response,'GET SPONSE')
               
            
    //             },
    //             error: function (response) {
    //               console.log("Failed");
    //             }
            
    //  });
 



   

   }
  // submitHandler
})



</script>


