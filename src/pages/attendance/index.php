<?php
namespace Biometric\Helper;
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <script src="<?php echo baseUrlScriptSrc('/js/tailwindcss.js') ?>"></script>

  <style>
    .custom-border {
      border: 1px solid;
      border-image: linear-gradient(to left, rgba(25, 57, 125, 0.4), rgba(234, 234, 234, 0.68));
      border-image-slice: 1;
    }

     .default-box{
       position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
    }


    .overlay-box{
       position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
     animation: scanning 2s ease-in-out infinite;
    }


    .overlay-box::before{
      content: '';
      position: absolute;
      top: 5px;
      left: 4px;
      width: 82px;
      height: 2px;
      animation: lineScanner 2s linear  infinite;
    }


    @keyframes lineScanner {
      0% {
       background: linear-gradient(to right, rgba(237, 122, 14, 0), rgba(237, 122, 14, 1), rgba(237, 122, 14, 0));
        transform: translateY(0px);
         opacity: 1;
      }

      100% {
         width: 80px;
       background: linear-gradient(to right, rgba(3, 58, 240, 0), rgba(3, 58, 240, 1), rgba(3, 58, 240, 0));
        transform: translateY(125px);
         opacity: 1;

      }
    }


    @keyframes scanning {
      0% {
     
        background:rgba(237, 122, 14, 0.6); 


      }

      100% {
        
         background:rgba(3, 58, 240, 0.6); 
        
      }
    }

  </style>
</head>

<body>
  <div class="attendance  bg-[url(<?php echo baseUrlImageSrc('bg.png') ?>)] bg-no-repeat bg-cover  w-screen h-screen mx-auto relative ">
    <div class="attendance__border   max-w-[44rem] h-[80vh] max-h-[32.5rem] gap-20 mx-auto">
      <div class="flex flex-col justify-center items-center h-[100vh]">
        <div
          class="custom-border flex flex-col justify-center items-center h-[32.5rem] gap-20 shadow-1 p-20 bg-[rgba(6,0,0,0.13)]">
          <h1 class="text-6xl text-center text-white font-bold max-w-[15ch] leading-70 z-10">HMIS Attendance System</h1>
          <div class='relative p-5 z-20 w-[150px] h-full relative flex justify-center align-center'>
               <img class="max-w-[16rem] max-h-[16rem] relative z-10 relative" src="<?php echo baseUrlImageSrc('biometric.png') ?>" alt="">
                <div id='biometric__scanner' class='overlay-box absolute w-[88px] h-[135px] rounded-full z-30 bg-[rgba(0,0,0,0.13)]'></div>
          </div>
        </div>

      </div>
    </div>
    <div class="attendance_logo absolute bottom-0 left:0 ml-5 mb-5 z-10">

      <img class="max-w-[16rem] max-h-[16rem]" src="<?php echo baseUrlImageSrc('logo_att.png') ?>" alt="">

    </div>
    <div
      class="attendance_instruction absolute bottom-0 right-0 mr-5 mb-5 bg-white rounded-md p-5 max-h-[18rem] max-w-[14rem] z-10">
      <div class="flex flex-col justify-center items-center gap-3">
        <p class="text-center font-bold text-[#19397D]">Instruction</p>
        <img src="<?php echo baseUrlImageSrc('scan.png') ?>" class="max-w-[10rem] max-h-[9rem]">
        <p class="text-center text-sm font-semibold text-[#19397D] max-w-[24ch] leading-5">Place your finger properly for
          identification</p>
      </div>
    </div>

    <div class="attendance__overlay absolute top-0 left-0 right-0 bottom-0 bg-[rgba(0,0,0,0.6)] z-1">

    </div>
  </div>
</body>

</html>
  <script src='<?php echo baseUrlScriptSrc('/js/es6-shim.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/websdk.client.bundle.min.js') ?>'></script>
  <script src='<?php echo baseUrlScriptSrc('/js/fingerprint.sdk.min.js') ?>'></script>

<script src='<?php echo baseUrlScriptSrc('/js/features/attendanceReader.js') ?>'></script>