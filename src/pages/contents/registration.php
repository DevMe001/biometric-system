<style>
  .border-custom{
    border:1px solid #eaeaea !important;
  }

   [id*="-error"] {
   color:#ff3333  !important;
   text-transform: none !important;
}


</style>



<fieldset class='my-4 bg-white max-w-md mx-auto'>
  
<form id='regForm' class='border border-gray-200 rounded-lg shadow mt-5 p-10'>
  <legend class='font-semibold text2xl mb-3'>Signup to our platform</legend>

  <div class="relative z-0 w-full mb-6 group">
    <input type="email" name="floating_email" id="floating_email"
      class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
    <label for="floating_email"
      class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:top-1  pl-1  peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
      address</label>
  </div>
 <div class="relative z-0 w-full mb-6 group">
    <input type="text" name="username" id="username"
      class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
    <label for="username"
      class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:top-1  pl-1  peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
  </div>
  <div class="relative z-0 w-full mb-6 group">
    <input type="password" name="floating_password" id="floating_password"
      class="border-custom block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:border focus:outline-none focus:ring-0 focus:border-blue-600 peer"
      placeholder=" " required />
    <label for="floating_password"
      class="peer-focus:top-1  pl-1 peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>

    <p class='text-xs font-medium text-right text-indigo-500 mt-2'><a href='?page=login'>Already have an account?</a></p>

    </div>


  <div class="relative z-0 w-full">
    <div class='flex flex-1 justify-center'>
       <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register</button>

    </div>
  </div>
  </div>
 
</form>
</fieldset>



<!-- Modal toggle -->
<button style="visibility:hidden" id='onEnroll' data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button">
  
</button>

<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-md p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
           <div class="px-6 py-6 lg:px-8">
            <iframe id='frameSrc' class="w-full h-full mx-auto" src="?page=fingerprint" title="Biometric scan"></iframe>
          </div>
            <!-- <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div> -->
        </div>
    </div>
</div> 




<script>


$.validator.addMethod('email_restrict', function (value) {
    const reg = /^[\w.+\-]+@gmail\.com$/;
    return reg.test(value);
});

$.validator.addMethod('password_restrict', function (value) {
      const reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
      return reg.test(value);
  });

$('#regForm').validate({
  // rules
  rules:{
     floating_email:{
      required:true,
      email_restrict:true
      },
      floating_password:{
        required:true,
        password_restrict:true
      },
      username:{
        required:true
      }
  },
  messages: {
      floating_email: {
    required: "Email cannot be empty..",
    email_restrict:"Email is not valid."
    },
    username:'Username cannot be empty.',
      floating_password:{
        required: "Password  cannot be empty.",
        password_restrict: "Password must be (1 uppercase, 1 number, 1 special character, 8 character limit.",
      }
  },
  // message

   submitHandler:function(){


    var form = document.getElementById("regForm");
    var formData = new FormData(form);
  
    var data = {};

    for (var pair of formData.entries()) {
    data[pair[0]] = pair[1];
    }
                
   

  var req = indexedDB.deleteDatabase('user_forms');
  req.onsuccess = function () {
      console.log("Deleted database successfully");
  };
  req.onerror = function () {
      console.log("Couldn't delete database");
  };
  req.onblocked = function () {
      console.log("Couldn't delete database due to the operation being blocked");
  };


    
   const cache = indexedDB.open('user_forms',1);

   cache.onupgradeneeded =()=>{
    let res = cache.result;
    res.createObjectStore('data',{autoIncrement:true})
   }


   cache.onsuccess =()=>{
    let res = cache.result;

    let transaction = res.transaction('data','readwrite');
    let store =transaction.objectStore('data');

    store.put(data);

    
    $('#onEnroll').click();
   }
 



 



   

   }
  // submitHandler
})



</script>


  

 <script>
        // Function to change the class of the iframe
        function changeIframeClass(newClasses) {
            const iframe = document.getElementById('frameSrc');
            iframe.className = newClasses.join(' ');
        }


        function showMessage(msg,type){

          if(type === 'error'){
          Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: `Something went wrong!,${msg}`,
                  footer: ''
            })
          }else{
             Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msg, 
                    showConfirmButton: false,
                    timer: 1500
           });
          }
            
        }


        // Listen for messages from the iframe content
        window.addEventListener('message', function(event) {
            if (event.origin !== window.location.origin) {
                return;
            }

            if (event.data.action === 'changeIframeClass') {
                changeIframeClass(event.data.newClasses);
            }
            if (event.data.action === 'showAlertMsg') {
                const data = event.data;
               showMessage(data.message,data.type);
            }
        });


    
        
</script>
