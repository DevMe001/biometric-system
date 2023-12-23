

    <div id='record-enroll' class="relative grid grid-cols-2 gap-2 mx-auto bg-white w-[50rem] content-center h-[50vh] p-5 drop-shadow-lg my-5 no-print">
    
        <label  for="lrn"><span class='font-medium text-xl mr-2'>Lrn#:</span> <span class='text-base font-medium' id='lrn'></span></label>
        <label  for="section"><span class='font-medium text-xl mr-2'>Section:</span> <span class='text-base font-medium' id='section'></span></label>
        <label  for="fullname"><span class='font-medium text-xl mr-2'>Name:</span><span class='text-base font-medium' id='fullname'></span></label>
        <label  for="dateEnrolled"><span class='font-medium text-xl mr-2'>Date enrolled</span><span class='text-base font-medium' id='dateEnrolled'></span></label>
        
        <div class='self-center col-span-2 text-center'>
            <button id='printEnrollReceipt' class='btn bg-blue-800 rounded px-5 py-2 shadow-1 text-white mt-5'>PRINT YOUR RECORD</button>
        </div>


       <div class='absolute top-0 translate-x-[-50%] left-1/2 my-5 text-3xl font-semibold'>Student's Enrollment Record</div>
       <button id='onBack' class='absolute top-0 pl-5 my-5 text-sm font-medium text-blue-600 cursor-pointer hover:outline-none hover:border-transparent'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
      </svg>

       </button>

    </div>


    
                 <div  class="receipt-print hidden border-2 p-5">
                        <legend class='text-center font-semibold text-xl'>Enrollment Fee<span id='typeAvail'></span></legend>
                   
                 <div class="flex gap-2 justify-center">

                  <div class="w-[50%] my-2">
                    <p class='text-left'><span class="font-medium" is='syYearPrint'>SY:2022-2023</span> <span clas='font-medium' id='typeFeePrint'>(INTERMIDIATE)</span></p>
                    <p class='text-left'><span class="font-medium">Name:</span> <span clas='font-medium' id='fLNamePrint'>Ronaldo Marzo</span></p>
                  </div>
                  <div class="w-4/12 my-2">
                    <p class='text-left'><span class="font-medium">Section</span> <span clas='font-medium'id='getSelectedSectionPrint'> Grade 7C</span></p>
                    <p class='text-left'><span class="font-medium">Issued Date:</span> <span clas='font-medium' id='getDateIssuedPrint'>11-03-2023</span></p>
                  </div> 
                
                 </div>


                <div class="flex gap-2 justify-center items-center">

                  <div class="w-[50%] my-2">
                  <div class="flex flex-col justify-between gap-2 items-start">
                    <div class="grid grid-cols-2 gap-4">
                   <p class="font-medium">Miscellanious fee</p> 
                   <p clas='font-medium' id='miscPrint'>₱10,045.00</p>
                   <p class="font-medium">Books and Modules</p> 
                   <p clas='font-medium' id='booksPrint'>₱5,905.00</p>
                   <p class="font-medium" >Tuition fee</p> 
                   <p style="border-bottom: 1px solid #000;" clas='font-medium' id='tuitionPrint'>₱15,000.00</p>
                   <p class="font-medium">Total</p> 
                   <p clas='font-medium' id='totalPrint'>₱30,950</p>  
                    </div>
                  </div>
                   <div class="mt-4">
                     <p class='text-left'><span class="font-medium">Full cash payment</span> <span clas='font-medium' id='fullPrint'>₱29,450</span></p>
                   </div>

                    <div class="mt-2">
                     <p class='text-left text-sm italic'><span class="font-medium">Note:</span> Show this receipt to registrar for confirmation</p>
                   </div>
                  </div>
                  <div class="w-[50%] mx-auto my-2">
                    <div class="flex flex-col justify-between items-center py-5">
                    <p class="text-center font-bold">Discount granted</p>
                    <p class='text-left'><span class="font-medium">1st with highest honor</span> <span clas='font-medium'> 25%</span></p>
                    <p class='text-left'><span class="font-medium">2st with highest honor</span> <span clas='font-medium'> 15%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    <p class='text-left'><span class="font-medium">3rd with highest honor</span> <span clas='font-medium'> 5%</span></p>
                    </div>
                  </div> 
                
                 </div>

                  
             </div>       







<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
  integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src='<?php echo baseUrlScriptSrc('/js/features/httpFunction.js') ?>'></script>



<script>
  getIndexDb('view-record',function(response){
    console.log(response,'response')

    if(response !== null){

      
        const {fullName,lrn,date_enrolled,sectionName,typeFee,miscellanious,bookModules,tuitionFee,totalFee,fullCashPayment} = response.value;


     
        $('#fullname').text(fullName)
        $('#lrn').text(lrn)
        $('#dateEnrolled').text(date_enrolled)
        $('#section').text(sectionName)
    

        const syear = new Date(date_enrolled).getFullYear();


        	$('#syYearPrint').text(syear);
					$('#fLNamePrint').text(fullName);
					$('#typeFeePrint').text(`(${typeFee})`);
					$('#getSelectedSectionPrint').text(sectionName);
					$('#getDateIssuedPrint').text(new Date().toLocaleDateString());
					$('#miscPrint').text(miscellanious);
					$('#booksPrint').text(bookModules);
					$('#tuitionPrint').text(tuitionFee);
					$('#totalPrint').text(totalFee);
					$('#fullPrint').text(fullCashPayment);
     
    }
    else{
      window.location.href = '?page=enrollment'
    }


  })


  $('#onBack').on('click',function(){
    onBack()
  })



  function onBack() {

    removeIndexDb('view-record');
    window.location.href = '?page=enrollment'
    
  }



  $('#printEnrollReceipt').on('click', (e) => {
	$('#record-enroll').addClass('hidden');
	$('.receipt-print').removeClass('hidden');

	$('.receipt-print').print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('#record-enroll').removeClass('hidden');
			$('.receipt-print').addClass('hidden');
		}),
	});
});

</script>