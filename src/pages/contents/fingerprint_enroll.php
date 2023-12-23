<!-- check the device -->
<?php

require_once('src/core/helpers/url.php');

?>

<head>
   
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" />
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">


   <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
      <script src="http://localhost/FingerPrint/src/js/es6-shim.js"></script>
    <script src="http://localhost/FingerPrint/src/js/websdk.client.bundle.min.js"></script>
    <script src="http://localhost/FingerPrint/src/js/fingerprint.sdk.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>

html,body{
  overflow: hidden;
}

    .fingerprint-container{
        position: relative;
        width: 400px;
        height: 500px;
        margin:0 auto;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
    .fingerprint-scanner{
        background: url("<?php echo baseUrlImageSrc('persona.png') ?>") no-repeat; 
        background-size: cover;
        background-position: center bottom;
      
    }
     .scan .fingerprint-scanner::before{
        content: ' ';
        position: absolute;
        left: 34%;
        top: 38%;
       
        background:rgba(240, 14, 14, 0.5); 
        width: 130px;
        height: 190px;
        border-radius: 100px;
        animation: scanner-color 2s ease-in-out infinite;
       
    }

   .scan .fingerprint-scanner::after{
        content: '';
        color: #ffffff;
      
        text-align: center;
        position: absolute;
        left: 35%;
        top: 57%;
       
        background:rgba(237, 122, 14, 1); 
        width: 120px;
        height: 2px;
        border-radius: 20px;
        opacity: 0.4;

        animation: scanning 2s ease-in-out infinite;
       
    }

    @keyframes scanner-color{
        0%,100%{
        background:rgba(237, 122, 14, 0.5); 


        }
        50%{
         background:rgba(3, 58, 240, 0.5); 

        }
    }

    @keyframes scanning{
        0%,100%{
            top:45%;
             background:rgba(237, 122, 14, 1); 


        }
        50%{
            top:75%;
         background:rgba(3, 58, 240, 1); 

        }
    }
    
</style>
</head>

<div id='checkDevice'  class='max-w-auto bg-white mx-auto h-auto'>
   
  <di class='flex flex-col justify-center items-center h-full'>
      <div id='loader' class='mb-5 hidden' role="status">
          <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
          </svg>
          <span class="sr-only">Loading...</span>
      </div>
        <button onclick='validateConnection()' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Check the device</button>
  </div>

</div>




<!-- enroll fingerprint -->

<div id='beginEnroll' class='hidden max-w-full bg-white mx-auto h-full'>
    <h1 class='text-center font-semibold text-gray-600 my-2'>Biometric scan</h1>
      <p class='text-base font-semibold'>Steps:</p>
   
      <ul class="list-disc">
        <li>
               1.) <span class='text-xs font-medium'>Mak sure you scan you fingerprint accurately</span>
      
        </li>
        <li>
              2.) <span id='getScan' class='text-xs font-medium'>Scan <span id='counter' class='font-bold'>4</span> times to get accurate image</span>

        </li>
      </ul>
  <di class='flex flex-col justify-start items-center h-[80%]'>

    <div class="flex flex-col justify-start items-center h-full">
         <div id="fingerscanner" class="fingerprint-container">
         <div class="fingerprint-scanner flex justify-center items-center h-full ">
         </div>
     
      </div>
    
     </div>
     
  </div>

</div>


<!-- fill up given information -->
<div id='enrollNow' class='max-w-full bg-white mx-auto h-full'>
   
  <di class='flex flex-col justify-center items-center h-full'>
      <div id='loader' class='mb-5 hidden' role="status">
          <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
          </svg>
          <span class="sr-only">Loading...</span>
      </div>
        <button id='btnEnroll' onclick='beginEnroll()' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'>Enroll</button>
  </div>

</div>



<!-- script for fingerprint -->


<script>


let currentFormat = Fingerprint.SampleFormat.Intermediate;

console.log(Fingerprint)

let FingerPrintReader = (function () {
    function FingerPrintReader() {
        let _instance = this;
        this.operationToRestart = null;
        this.acquisitionStarted = false;
        // instantiating the fingerprint sdk here


        this.sdk = new Fingerprint.WebApi;
        this.sdk.onDeviceConnected = function (e) {
            // Detects if the device is connected for which acquisition started
            console.log("Scan Appropriate Finger on the Reader", "success");
        };
        this.sdk.onDeviceDisconnected = function (e) {
            // Detects if device gets disconnected - provides deviceUid of disconnected device
            console.log("Device is Disconnected. Please Connect Back");
        };
        this.sdk.onCommunicationFailed = function (e) {
            // Detects if there is a failure in communicating with U.R.U web SDK
            console.log("Communication Failed. Please Reconnect Device")
        };
        this.sdk.onSamplesAcquired = function (sample) {
            // Sample acquired event triggers this function
        
            storeSample(sample)
         
   
            

        };
        this.sdk.onQualityReported = function (e) {
            // Quality of sample acquired - Function triggered on every sample acquired
            //document.getElementById("qualityInputBox").value = Fingerprint.QualityCode[(e.quality)];
        }
    }

    // this is were finger print capture takes place
    FingerPrintReader.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        let _instance = this;
        console.log("");
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat, "").then(function () {
            _instance.acquisitionStarted = true;

            //Disabling start once started
            //disableEnableStartStop();

        }, function (error) {
            console.log(error.message);
        });
    };
    
    FingerPrintReader.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        let _instance = this;
        console.log("");
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;

            //Disabling stop once stopped
            //disableEnableStartStop();

        }, function (error) {
            console.log(error.message);
        });
    };

    FingerPrintReader.prototype.getInfo = function () {
        let _instance = this;
        return this.sdk.enumerateDevices();
    };

    FingerPrintReader.prototype.getDeviceInfoWithID = function (uid) {
        let _instance = this;
        return  this.sdk.getDeviceInfo(uid);
    };
    
    return FingerPrintReader;
})();


let getSampleFormat = [];
let searchParams = new URLSearchParams(window.parent.location.search);


if(searchParams.get('page') === 'login'){
    const scan =document.getElementById('getScan');
    const btnEnroll =document.getElementById('btnEnroll');


    btnEnroll.textContent ='Verify your identity'
    scan.textContent = 'Identifying your account';
}

function storeSample(sample){
     const scanningLoader =  document.getElementById('fingerscanner');
    const beginEnroll =document.getElementById('beginEnroll');
  
    const enrollNow =document.getElementById('enrollNow');
    const attempt =document.getElementById('counter');


    
         scanningLoader.classList.add('scan');


         setTimeout(() => {
            scanningLoader.classList.remove('scan');

            let counter = JSON.parse(localStorage.getItem('left')) ?? 4;
          
            console.log(counter, 'get counter');

            counter--; // Increment the counter


           if(searchParams.get('page') === 'create'){
             attempt.textContent = counter;
           }
        

       
            localStorage.setItem('left', JSON.stringify(counter));

         


            let samples = JSON.parse(sample.samples);
            let sampleData = samples[0].Data;

            getSampleFormat.push(sampleData);

            if((searchParams.get('page') === 'create' && counter === 0) || (searchParams.get('page') === 'login' && counter === 3)){
           

            sendChangeIframeClassMessage(['w-full', 'h-full','mx-auto']);

            
             beginEnroll.classList.add('hidden')

             


            enrollNow.classList.remove('hidden')
            localStorage.removeItem('left');

                
            }
        }, 3000);
            
}

function sendChangeIframeClassMessage(newClasses) {
    window.parent.postMessage({
        action: 'changeIframeClass',
        newClasses: newClasses
    }, '*');
}

function showMsgAlert(message,type){
      window.parent.postMessage({ action: 'showAlertMsg', message, type }, '*');
}

function validateConnection(){


  const reader = new FingerPrintReader();

  const getDeviceConnected = reader.getInfo();

    const loader =document.getElementById('loader');
    const checkDevice =document.getElementById('checkDevice');
    const beginEnroll =document.getElementById('beginEnroll');
  
      loader.classList.remove('hidden')


  setTimeout(() => {

 
   getDeviceConnected.then(res =>{


      
    console.log(res,'get res')
    if(res.length > 0){

   loader.textContent='Device Connected'
      checkDevice.classList.add('hidden')
      beginEnroll.classList.remove('hidden')
      reader.startCapture();

    
      sendChangeIframeClassMessage(['w-[300px]', 'h-[600px]','mx-auto']);

    //    setTimeout(() => {
    //     const frameSrc = document.getElementById('frameSrc');

    //     frameSrc.classList.remove('w-full' ,'h-full');
    //     frameSrc.classList.add('w-[300px]' ,'h-[600px]');
    //     }, 5000);
  
    }
    else{
   loader.innerHTML='<span class="text-red-500 font-bold">Device is Disconnected , Please check your device</span>'

    }
  })


  }, 3000);

  
}




function beginEnroll(){
   console.log(getSampleFormat,'get sample format')


   const idb = indexedDB.open('user_forms', 1);


	idb.onsuccess = () => {
            	const tx = idb.result.transaction('data', 'readonly');
	const store = tx.objectStore('data');
	const cursor = store.openCursor();
	
	cursor.onsuccess = () => {
		const response = cursor.result;
        
             
        if(searchParams.get('page') === 'create'){
         readyToSubmit(response.value,getSampleFormat,'src/core/enroll.php','User  enrolled successfully','register');

        }
        if(searchParams.get('page') === 'login'){
         readyToSubmit(response.value,getSampleFormat,'src/core/verify.php','User identified successfully','login');

        }




		
		}
	};


}



function readyToSubmit(input,sample,url,msg,type){


    // const formData = new FormData();
  
    // // send array data
    // for (const value of sample) {
    // formData.append('sample', value);
    // }

    // formData.append('email',input.floating_email)
    // formData.append('username',input.username)
    // formData.append('floating_password',input.floating_password)


    // let data={}

    // for(let list of formData.entries()){
    //     data[list[0]] = list[1]
    // }

    // console.log(data,'get formdata')


    const data = {
        input,
        sample
    }


    let successMessage = "Enrollment Successful!";
    let failedMessage = "Enrollment Failed!";
    let payload = `data=${JSON.stringify(data)}`;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState === 4 && this.status === 200){


         if(type === 'register'){

            // if not existed and success

            if(this.responseText !== 'existed' && this.response === 'success'){
                     showMsgAlert(msg,'success');

                 console.log(`${this.responseText}`);
            }
            else{
                let msgErr = this.responseText == 'existed' ? 'Duplicated fingerprint is forbidden' : 'Please contact your administrator'

                 showMsgAlert(msgErr,'error');

                 console.log(`${this.responseText}`);


                     const beginEnroll =document.getElementById('beginEnroll');
  
                      const enrollNow =document.getElementById('enrollNow');

                      beginEnroll.classList.remove('hidden');
                      enrollNow.classList.add('hidden');
                       sendChangeIframeClassMessage(['w-[300px]', 'h-[600px]','mx-auto']);
                const attempt =document.getElementById('counter');


                localStorage.setItem('left', JSON.stringify(4));
                attempt.textContent=4;
                 getSampleFormat =[];

            }

            
         }
         if(type === 'login'){
            
            let response = JSON.parse(this.responseText);
            if(response !== "failed" && response !== null){
                     showMsgAlert(JSON.stringify(response,null,2),'success');
            }
            else{
               
                 showMsgAlert(response,'error');

                 console.log(`${response}`);


                  
                      const beginEnroll =document.getElementById('beginEnroll');
  
                      const enrollNow =document.getElementById('enrollNow');

                      beginEnroll.classList.remove('hidden');
                      enrollNow.classList.add('hidden');
                       sendChangeIframeClassMessage(['w-[300px]', 'h-[600px]','mx-auto']);

                getSampleFormat =[];

            }
         }


          
        }
    };

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(payload);



}

</script>


