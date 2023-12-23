const studentRecTable = '.student-table';
const studentRecNoTesult = 'studentRecNoResult';

// menu
const studentMenu = '#studentRecDropdownMenu';
const studentDropdownBtn = '#studentRecDropdownBtn';

// filter
const studentRecSearchId = 'studentRecSearchEl';
const studentRecToggle = '#onModalStudentRecToggle';

// search

const studentRecPrint = 'studentRecPrint';
const studentRecPageArea = '.student-printable';


const studentReciept = 'printReceipt';
const studentReceiptArea = '.receipt-print';


const studentRegReciept = 'printRegReceipt';
const studentRegReceiptArea = '.receipt-print';



// getMenu(studentMenu, studentRecTable);
showPage(studentRecTable, studentRecNoTesult);
// tableSorting(studentMenu, studentRecTable, studentRecNoTesult);

let studentRecSearchEl = document.getElementById(studentRecSearchId);

studentRecSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(studentRecTable, studentRecNoTesult, searchValue);
});

$('#' + studentRecPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(studentRecPageArea).removeClass('hidden');

	$(studentRecPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentRecPageArea).addClass('hidden');
		}),
	});
});



$('#' + studentReciept).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	
	$(studentReceiptArea).removeClass('hidden');
 	// document.querySelector('body > div[modal-backdrop]')?.remove();
	$(studentReceiptArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentReceiptArea).addClass('hidden');
			// After printing, add the 'modal-backdrop' element back
			const newModalBackdrop = document.createElement('div');
			newModalBackdrop.setAttribute('modal-backdrop', '');
			document.body.appendChild(newModalBackdrop);
		}),
	});
});



// filter oer year


$(document).ready(function () {
	var schoolYearInput = $('#getRecentYear');
	var yearDropdown = $('#getRecYearly');


	// Event listener for dropdown change
	yearDropdown.change(function () {
		location.href = `?page=dashboard&filteredYear=${this.value}`;
			localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: ''}));

	});
});

// $('#getRecYearly').on('change',function(){
// 		var schoolYearInput = document.getElementById('getRecentYear');

// 		schoolYearInput.val('2024');

// })




$('#' + studentRegReciept).on('click', (e) => {
	$('.custom-table').addClass('hidden');

	$(studentReceiptArea).removeClass('hidden');
	// document.querySelector('body > div[modal-backdrop]')?.remove();
	$(studentReceiptArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(studentReceiptArea).addClass('hidden');
			// After printing, add the 'modal-backdrop' element back
			const newModalBackdrop = document.createElement('div');
			newModalBackdrop.setAttribute('modal-backdrop', '');
			document.body.appendChild(newModalBackdrop);
		}),
	});
});



function deleteStudentRec(data) {
	const id = data.enrollment_id;

	console.log(data, 'getId');

	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',
	}).then((result) => {
		if (result.isConfirmed) {
			// req

			let xhttp = new XMLHttpRequest();

			xhttp.open('POST', 'src/function/controller.php?action=deleteStudentRec', true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status === 200) {
						let response = JSON.parse(this.responseText);

						console.log(response, 'get response');

						if (response.success == true) {
							location.href = '?page=dashboard';
							localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'delete', message: 'Student has been deleted' }));
						}
					}
				}
			};

			const data = {
				enrollmentId: id,
			};
			// payload
			let payload = `data=${JSON.stringify(data)}`;

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.send(payload);
		}
	});
}



$('#typeStudent').on('change', function () {
	console.log(this.value, 'get value of useer');
	let value = this.value;

	if (value === 'regular') {
		$('#next-button__1').addClass('hidden');
		$('#oldUserModal').click();
	} 
	if(value === 'new'){
			$('#next-button__1').removeClass('hidden');
		
	}
	
	else {
			$('#next-button__1').addClass('hidden');
	}
});



// get type


$('#typeEnroll').on('change', function () {

	 $('#level').find('option').remove();
	// call query
	const data = {
		type: this.value,
	};


	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', 'src/function/controller.php?action=getYrType', true);

	xhttp.onreadystatechange = function () {

		if(this.readyState === 4){
			if(this.status === 200){

			let response = JSON.parse(this.responseText);

					let listitems = '<option value=""></option>';
					response.forEach(item => {
							  listitems += '<option value="' + item.id + '" data-qualify="'+item.qualify_age+'">' + item.name + '</option>';

					});


							console.log(response,'get errror')

							$('#level').append(listitems);

							$('#typeYearLevel').removeClass('hidden');
							
			}
			else{

			}
		}
		
		
	}


	$('#typeYearLevel').on('change', function () {
		$('#newDivSection').removeClass('hidden');
	});




let payload = `data=${JSON.stringify(data)}`;

xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhttp.send(payload)

	


});


$('#level').on('change',function(){
		// const getGrade = $('#studentRecTitle').text($('#level option:selected').text());
	let getSelectedLevel = $('#level option:selected').text();
	$('#studentRecTitle').text(`Registration form ( ${getSelectedLevel} )`);
	
});




// $('#credentialType').on('change', function () {
// 	let credential = this.value;

// 	console.log(credential, 'get value');

// 	switch (credential) {
// 		case 'local':
// 			$('#local').removeClass('hidden');
// 			$('#foreign').addClass('hidden');

// 			// Uncheck all foreign checkboxes
// 			$('.foreign:checked').each(function () {
// 				$(this).prop('checked', 1);
// 			});

// 			break;
// 		case 'foreign':
// 			$('#local').addClass('hidden');
// 			$('#foreign').removeClass('hidden');

// 			// Uncheck all local checkboxes
// 			$('.local:checked').each(function () {
// 				$(this).prop('checked', 1);
// 			});
// 			break;
// 		default:
// 			$('#local').addClass('hidden');
// 			$('#foreign').addClass('hidden');
// 			$('.local').each(function () {
// 				$(this).prop('checked', false);
// 			});
// 			$('.foreign').each(function () {
// 				$(this).prop('checked', false);
// 			});
// 			break;
// 	}
// });

$('#credentialType').on('change', function () {
  let credential = this.value;

  console.log(credential, 'get value');

  switch (credential) {
    case 'local':
      $('#local').removeClass('hidden');
      $('#foreign').addClass('hidden');

      // Uncheck all foreign checkboxes
      $('.foreign:checked').each(function () {
        $(this).prop('checked', false);
      });

      break;
    case 'foreign':
      $('#local').addClass('hidden');
      $('#foreign').removeClass('hidden');

      // Uncheck all local checkboxes
      $('.local:checked').each(function () {
        $(this).prop('checked', false);
      });
      break;
    default:
      $('#local').addClass('hidden');
      $('#foreign').addClass('hidden');
      $('.local').each(function () {
        $(this).prop('checked', false);
      });
      $('.foreign').each(function () {
        $(this).prop('checked', false);
      });
      break;
  }
});




$('#profile').on('change',function(e){

	let file  = e.target.files[0];

		filePreviHandler('#previewImgDiv',file,'.default-img');

	

	});
	

	function filePreviHandler(id,file,defaultHide){

		if(file.size > 1048576){
			Swal.fire({
			icon:'error',
			title:'File is not supported',
			text:'File size is less than 1Mb',
			footer:null
		});
		}
		else{
			if (file.type.startsWith('image')) {
				console.log('ok begin uploads');
				faceDetector(id, file, defaultHide);

			}
			else{
				Swal.fire({
					icon: 'error',
					title: 'File is not supported',
					text: 'Only images allowed',
					footer: null,
				});
			}
		
	
	}
}

let sendFile;



function faceDetector(id, file, defaultHide) {
	const imageFile = file;
	const img = new Image();
	const canvas = document.createElement('canvas');
	const ctx = canvas.getContext('2d');
	const ctv = URL.createObjectURL(imageFile);

	img.src = ctv;

	img.onload = async () => {
		canvas.width = img.width;
		canvas.height = img.height;
		ctx.drawImage(img, 0, 0, img.width, img.height);

		const MODEL_URL = 'src/js/weights';
		// Load the face-api.js models
		await faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL);
		await faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL);
		await faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL);

		const faceDetectionOptions = new faceapi.TinyFaceDetectorOptions();
		const detections = await faceapi.detectAllFaces(canvas, faceDetectionOptions).withFaceLandmarks().withFaceDescriptors();


			let previewImgId = $(id);
		// Handle Blob URL errors
		img.onerror = () => {
			displayErrorOnScreen(previewImgId, defaultHide,'Failed to load image.');
		};

	

		// Set the background-image and background-size CSS properties
		$(defaultHide).addClass('hidden');

		previewImgId.addClass('border-2 rounded');
		previewImgId.css('background', `url('src/images/loader.gif') no-repeat`);
		previewImgId.css('background-size', 'contain');
		previewImgId.css('background-position', 'center center');
		previewImgId.css('object-fit', 'contain');

		console.log(detections.length, 'get detection');

		if (detections.length > 0) {
			setTimeout(() => {
				const ctvUrl = URL.createObjectURL(file);

				// Set the background-image and background-size CSS properties
				$(defaultHide).addClass('hidden');

				previewImgId.addClass('border-2 rounded');
				previewImgId.css('background', `url('${ctvUrl}') no-repeat`);
				previewImgId.css('background-size', 'contain');
				previewImgId.css('background-position', 'center center');
				previewImgId.css('object-fit', 'contain');



				sendFile = file;


	

				// Revoke the object URL when the image is loaded
				img.onload = () => {
					URL.revokeObjectURL(ctvUrl);
				};
			}, 3000);
		} else {
			// Handle the case where no faces are detected
			displayErrorOnScreen(previewImgId, defaultHide,'Upload consise,clear face image');
		}
	};
}



function displayErrorOnScreen(previewImgId, defaultHide,errorMessage) {
	previewImgId.css('background', 'transparent');
	$(defaultHide).removeClass('hidden');

	setTimeout(() => {
		Swal.fire({
			icon: 'error',
			text: 'Face verification denied',
			title: errorMessage,
			footer: null,
		});
	}, 2000);
}




		$('#profile-error').removeClass('hidden');

	// end multiple form

	// retrict users inputs

		


		$('#birthdate').on('change',function(){


			const qualifyAge = $('#level option:selected').data('qualify');
			const qualifyLevel = $('#level option:selected').text();
		

			console.log(qualifyAge);


			const birthdate =  new Date(this.value);
			const currDate =  new Date();

			const bdayYear = birthdate.getFullYear();
			const currDateYear = currDate.getFullYear();

			let age =  currDateYear - bdayYear;

			if(currDate.getMonth() < birthdate.getMonth() || (currDate.getMonth() === birthdate.getMonth() && currDate.getDate < birthdate.getDate())){
				age--; 
			}





		if (age >= qualifyAge) {
			$('#ageReveal').removeClass('hidden');
			$('#guestmyAge').text(age);
			$('#age').val(age);
		} else {
			this.value = '';
			Swal.fire({
				icon: 'error',
				text: `Age ${age} doesn't qualify to  ${qualifyLevel} level at least age ${qualifyAge} required`,
				title: 'Age not allowed',
				footer: null,
			});

			$('#ageReveal').addClass('hidden');
			$('#guestmyAge').text('');
			$('#guestmyAge').val('');
		}

			


	})




	function editStudentRec(data) {
	
	
		$('fieldset').hide(); // Hide all fieldsets
	
		$('fieldset:eq(1)').show(); // Show the second fieldset

		// get all form values
		$('#typeEnroll').val(data.yearType);


		
		console.log(data)
	

		// call query
		const formData = {
			type: data.yearType,
		};

		httpJSONReq('getYrType', formData, (response) => {
		
			let listitems = '<option value=""></option>';
			response.forEach((item) => {
				listitems += '<option selected="' + data.yearLevelId + '" value="' + item.id + '" data-qualify="' + item.qualify_age + '">' + item.name + '</option>';
			});

			console.log(response, 'get errror');

			$('#level').append(listitems);

			$('#typeYearLevel').removeClass('hidden');
		});

		let previewImgId = $('#previewImgDiv');

		// Set the background-image and background-size CSS properties
		$('.default-img').addClass('hidden');

		previewImgId.addClass('border-2 rounded');
		previewImgId.css('background', `url('src/images/uploads/profile/${data.profile}') no-repeat`);
		previewImgId.css('background-size', 'contain');
		previewImgId.css('background-position', 'center center');
		previewImgId.css('object-fit', 'contain');

		$('#studentId').val(data.student_id);
		$('#receiptId').val(data.receipt_id);
		$('#submitId').val(data.submit_id);
		$('#oldProfile').val(data.profile)
		$('#lrn').val(data.lrn);
		$('#gwa').val(data.gwa);
		$('#lname').val(data.lastName);
		$('#fname').val(data.firstName);
		$('#mname').val(data.middleName);
		$('#gender').val(data.gender);
		$('#birthdate').val(data.birthdate);
		$('#ageReveal').removeClass('hidden');
		$('#guestmyAge').text(data.age);
		$('#age').val(data.age);
		
		$('#address').val(data.currentAddress);
		$('#pbirth').val(data.pbirth);
		$('#nationality').val(data.nationality);
		$('#studentNumber').val(data.studentNumber);

		$('#fatherName').val(data.fatherName);
		$('#fatherOccupation').val(data.fatherOccupation);
		$('#fatherNumber').val(data.fatherNumber);

		$('#motherName').val(data.motherName);
		$('#motherOccupation').val(data.motherOccupation);
		$('#motherNumber').val(data.motherNumber);

		$('#guardiansName').val(data.guardianName);
		$('#guardianContactNumber').val(data.guardianNumber);
		$('#guardianAddress').val(data.guardianAddress);

		$('#contactName').val(data.contactName);
		$('#relationship').val(data.relationship);
		$('#contactNumber').val(data.phone);
		
		
		$('#newDivSection').removeClass('hidden');
		$('#newSection').val(data.sectionId).trigger('change');

		// local
		$('#credentialType').val(data.type);
		// foreign

		if (data.type === 'foreign') {
			$('#local').addClass('hidden');
			$('#foreign').removeClass('hidden');

			const studPermit = data.study_permit == 1 ? true : false;
			const alientCert = data.alien_regcard == 1 ? true : false;
			const passport = data.passport_copy == 1 ? true : false;
			const auth_rec = data.auth_school_record == 1 ? true : false;

			$('#study_permit').prop('checked', studPermit);
			$('#alien_card').prop('checked', alientCert);
			$('#birtcertificate').prop('checked', passport);
			$('#passport').prop('checked', passport);
			$('#auth_rec').prop('checked', auth_rec);
		} else {
			$('#local').removeClass('hidden');
			$('#foreign').addClass('hidden');

			const reportCard = data.report_card == 1 ? true : false;
			const formsf10 = data.formSf10 == 1 ? true : false;
			const b_cert = data.birthCertificate == 1 ? true : false;
			const gmoral = data.good_moral == 1 ? true : false;
			const med_Cert = data.medical_cert == 1 ? true : false;
			const rec_letter = data.rec_letter == 1 ? true : false;

			$('#report_card').prop('checked', reportCard);
			$('#formsf10').prop('checked', formsf10);
			$('#birtcertificate').prop('checked', b_cert);
			$('#cert_gmoral').prop('checked', gmoral);
			$('#med_cert').prop('checked', med_Cert);
			$('#let_rec').prop('checked', rec_letter);
		}

		const dateEnrolled = new Date(data.date_enrolled);
		const getDateString = dateEnrolled.toISOString().split('T')[0];
		let getDefaultSchooYear = $('#schoolYear').val();

		const presentYear = new Date().getFullYear();
		const nextYear = new Date().getFullYear() + 1;

		const syear = getDefaultSchooYear ?? `SY:${presentYear}-${nextYear}`;

		// printing rec
		$('#syYear').text(syear);
		$('#fLName').text(data.fullName);
		$('#typeFee').text(`${data.typeFee}`);
		$('#getSelectedSection').text(data.yearLevel);
		$('#getDateIssued').text(getDateString);
		$('#misc').text('₱' + data.miscellanious);
		$('#books').text('₱' + data.bookModules);
		$('#tuition').text('₱' + data.tuitionFee);
		$('#total').text('₱' + data.totalFee);
		$('#full').text('₱' + data.fullCashPayment);
		// $('#typeAvail').text('(New)');

		// print

		$('#syYearPrint').text(syear);
		$('#fLNamePrint').text(data.fullName);
		$('#typeFeePrint').text(`${data.typeFee}`);
		$('#getSelectedSectionPrint').text(data.yearLevel);
		$('#getDateIssuedPrint').text(getDateString);
		$('#miscPrint').text('₱' + data.miscellanious);
		$('#booksPrint').text('₱' + data.bookModules);
		$('#tuitionPrint').text('₱' + data.tuitionFee);
		$('#totalPrint').text('₱' + data.totalFee);
		$('#fullPrint').text('₱' + data.fullCashPayment);

		$('#studentRecTitle').text('Update  form');

		$('#enrollReceipt').removeClass('hidden');

		localStorage.setItem('modify', JSON.stringify(true));
		$(studentRecToggle).click();
	}


	$(document).ready(function() {


    // jQuery.validator.addMethod(
		// 	'validPlus639Number',
		// 	function (value, element) {
		// 		return this.optional(element) || /^\639\d{11}$/.test(value);
		// 	},
		// 	"Phone number must start with '+639' and have a length of 13 characters",
		// );

		// Custom validation method for '09' numbers
		jQuery.validator.addMethod(
			'phNumber',
			function (value, element) {
				return this.optional(element) || /^09\d{9}$/.test(value);
			},
			"Phone number must start with '09' and have a length of 11 digit",
		);


		// create  form validation
		$('#studentRecordForm').validate({
			rules: {
				// type of enroll
				typeEnroll: {
					required: true,
				},
				level: {
					required: true,
				},
				gwa: {
					required: true,
					number: true,
					range: [75, 100],
				},
				profile: {
					required: true,
					accept: 'image/*',
				},
				studentNumber: {
					required: true,
					// validPlus639Number: function (element) {
					// 	// Only apply this rule if the input starts with '+639'
					// 	return /^(\639)/.test($(element).val());
					// },
					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},
				fatherName: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				fatherNumber: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},

					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},
				fatherOccupation: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				motherName: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				motherOccupation: {
					required: function (element) {
						return $('#guardiansName').val() === '' || ($('#guardianContactNumber').val() === '' && $('#guardianAddress').val() === '');
					},
				},
				motherNumber: {
					required: true,

					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},

				guardiansName: {
					required: function (element) {
						return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
					},
				},
				guardianContactNumber: {
					required: function (element) {
						return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
					},

					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},
				guardianAddress: {
					required: function (element) {
						return $('#motherNumber').val() === '' && $('#fatherNumber').val() === '';
					},
				},
				contactNumber: {
					required: true,

					phNumber: function (element) {
						// Only apply this rule if the input starts with '09'
						return /^(09)/.test($(element).val());
					},
				},

				// end fiRST FORM
				// personal information
				// emergency
				// birth cerificate
				// biometric
			},
			messages: {
				// type of enroll
				typeEnroll: {
					required: 'Field cannot empty.',
				},
				level: {
					required: 'Field cannot empty.',
				},

				profile: {
					required: 'Please upload a valid file.',
					accept: 'Only image and PDF files are allowed.',
				},
				gwa: {
					required: 'This field is required',
					number: 'Please enter a valid number',
					range: 'Please enter a number between 75 and 100',
				},
				studentNumber: {
					required: 'Phone number is required',
				},
				fatherName: {
					required: 'Field is required if guardian is empty put not applicable if not related',
				},
				fatherOccupation: {
					required: 'Field is required required if guardian is empty',
				},
				fatherNumber: {
					required: 'Phone number is required',
				},
				motherName: {
					required: 'Field is required  if guardian is empty put not applicable if not related',
				},
				motherOccupation: {
					required: 'Field is required  if guardian is empty Not put not applicable if not related',
				},
				motherNumber: {
					required: 'Phone number is required',
				},
				guardiansName: {
					required: 'Phone number is required',
				},
				guardianContactNumber: {
					required: 'Phone number is required',
				},
				guardianAddress: {
					required: 'Field is required when mother and father is empty put not applicable if not related',
				},
				contactNumber: {
					required: 'Phone number is required',
				},

				// end fiRST FORM
				// personal information
				// emergency
				// birth cerificate
				// biometric
			},
			errorPlacement: function (error, element) {
				// Display the error message in a separate div with the ID "profile-error"
				if (element.attr('name') === 'profile') {
					error.appendTo('#profile-error');
				} else {
					error.insertAfter(element);
				}
			},
		});

	

		
			$('fieldset:first').show();



		


		// end restriction

		// show

			let currentStep = 0;
			// nextFieldSet(`#next-button__1`);
				const prevIndex = [1, 2, 3, 4, 5, 6, 7, 8,9,10,11];
				const nextIndex = [1,2, 3, 4, 5, 6, 7,8,9,10,11];

				prevIndex.forEach((id) => {
					prevFieldset(`#prev-button__${id}`);
				
				});

				nextIndex.forEach((id) => {
					nextFieldSet(`#next-button__${id}`);


					
					

				});


				let submitForm =false;

			
				


				$('#next-button__9').on('click', function () {
					// get the level,name
					$('#modal-container').addClass('max-w-[650px]');


		
				
				
					let getDefaultSchooYear = $('#schoolYear').val();

					const presentYear = new Date().getFullYear();
					const nextYear = new Date().getFullYear() + 1;

					const syear = getDefaultSchooYear ?? `SY:${presentYear}-${nextYear}`;

					let getSelectedLevel = $('#level option:selected').text();

					const preSchool = ['nursery', 'kinder'];
					const grade1 = ['grade 1'];
					const primary = ['grade 2', 'grade 3'];
					const intermidiate = ['grade 4', 'grade 5', 'grade 6'];
					const jrHigh = ['grade 7', 'grade 8', 'grade 9', 'grade 10'];
					const srHigh = ['grade 11', 'grade 12'];

					let selectedLevel = '';
					let miscelanious = '';
					let booksModule = '';
					let tuitionFee = '';
					let total = '';
					let fullPayment = '';

					if (preSchool.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱10,045.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱15,000.00';
						total = '₱30,950.00';
						fullPayment = '₱29,450.00';
					}
					if (grade1.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRESCHOOL';
						miscelanious = '₱14,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱30,105.00';
						fullPayment = '₱29,170.00';
					}
					if (primary.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'PRIMARY';
						miscelanious = '₱12,850.00';
						booksModule = '₱5,905.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,105.00';
						fullPayment = '27,170.00';
					}

					if (intermidiate.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'INTERMIDIATE';
						miscelanious = '₱12,850.00';
						booksModule = '₱6,750.00';
						tuitionFee = '₱9,350.00';
						total = '₱28,950.00';
						fullPayment = '₱28,015.00';
					}
					if (jrHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'JR HIGH SCHOOL';
						miscelanious = '₱13,050.00';
						booksModule = '₱8,325.00';
						tuitionFee = '₱10,450.00';
						total = '₱31,925.00';
						fullPayment = '₱30,880.00';
					}
					if (srHigh.includes(getSelectedLevel.toLowerCase())) {
						selectedLevel = 'SENIOR HIGH SCHOOL';
						miscelanious = '₱7,670.00';
						booksModule = '0.00';
						tuitionFee = '17,500.00';
						total = '25,170.00';
						fullPayment = '25,170.00';
					}

					let fname = $('#fname').val();
					let lname = $('#lname').val();
					let fullName = `${fname} ${lname}`;
					let getDateString = new Date().toLocaleDateString();

			
			if (localStorage.getItem('modify') !== 'true') {
					$('#syYear').text(syear);
					$('#fLName').text(fullName);
					$('#typeFee').text(`(${selectedLevel})`);
					$('#getSelectedSection').text(getSelectedLevel);
					$('#getDateIssued').text(getDateString);
					$('#misc').text(miscelanious);
					$('#books').text(booksModule);
					$('#tuition').text(tuitionFee);
					$('#total').text(total);
					$('#full').text(fullPayment);
					$('#typeAvail').text('(New)');
					// print
					$('#syYearPrint').text(syear);
					$('#fLNamePrint').text(fullName);
					$('#typeFeePrint').text(`(${selectedLevel})`);
					$('#getSelectedSectionPrint').text(getSelectedLevel);
					$('#getDateIssuedPrint').text(getDateString);
					$('#miscPrint').text(miscelanious);
					$('#booksPrint').text(booksModule);
					$('#tuitionPrint').text(tuitionFee);
					$('#totalPrint').text(total);
					$('#fullPrint').text(fullPayment);
			}
			else{
							$('.skipFieldset').hide();
							$('.proceedFieldset').show();
			}

				
				});
			
				$('#next-button__11').on('click', function () {
						let valid = $('#studentRecordForm').valid();

						console.log(valid,'get valid')
						if(valid){
							submitForm=true;
						}
				});

	
	

		$('#studentRecordForm').submit(function (event) {

				event.preventDefault();
	

			let hidden = $('fieldset:hidden');
	
			console.log(hidden, 'get hidden');

				console.log(currentStep,'current steps');
			console.log($('fieldset:hidden').length, 'get hidden');
			console.log($('#studentRecordForm').valid());
		  const res = retrieveFiles();
			const getProfile = renameAndUploadFile('profile',sendFile);
			// const getFingerPrint = renameAndUploadFile('fingerprint',sendFile);




					
			const typeFee = $('#typeFee').text().replace('₱','');
			const misc = $('#misc').text().replace('₱', '');
			const book = $('#books').text().replace('₱', '');
			const tuition = $('#tuition').text().replace('₱', '');
			const total = $('#total').text().replace('₱', '');
			const full = $('#full').text().replace('₱', '');
			const year = new Date().getFullYear();
					
						
					
					
	


			let getlength = $('fieldset:hidden').length;
			let valid = $('#studentRecordForm').valid();

		

			

			if (valid === true && submitForm) {
				console.log('Form submitted successfully!');

				const form = document.getElementById('studentRecordForm');

				const formData = new FormData(form);
				formData.append('fingerprint', res);
				// formData.append('fingerprint', getFingerPrint);
				formData.append('renameProfile', getProfile);
				formData.append('typeFee', typeFee);
				formData.append('miscellanious', misc);
				formData.append('bookModules', book);
				formData.append('tuitionFee', tuition);
				formData.append('totalFee', total);
				formData.append('fullCashPayment', full);
				formData.append('yearIssued', year);

		

				const data = {};

				for (let pair of formData.entries()) {
					data[pair[0]] = pair[1];
				}

			

					if (localStorage.getItem('modify') === 'true') {
							httpResFormData('reEvaluteStudent', formData, (res) => {
								console.log(res, 'get response');
								if (res.success) {
									localStorage.removeItem('counter');
									localStorage.removeItem('modify');
									
									location.href = `?page=dashboard`;
									localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
								} else {
									$('#prev-button__10').removeClass('hidden');

									Swal.fire({
										icon: 'error',
										title: 'Forbidden Request',
										text: res.message,
										footer: null,
									});
								}
							});
						
					}
					else{
						
					httpResFormData('enrollStudent', formData, (res) => {
						console.log(res, 'get response');
						if (res.success) {
							localStorage.removeItem('counter');

							location.href = `?page=dashboard`;
							localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
						} else {
							$('#prev-button__10').removeClass('hidden');

							Swal.fire({
								icon: 'error',
								title: 'Forbidden Request',
								text: res.message,
								footer: null,
							});
						}
						});
					}

			} else {
				console.log('Form submission prevented.');
				event.preventDefault();
			}
		});
	});



	

  function renameAndUploadFile(fileName,file) {
		const lrn = $('#lrn').val();


	

		if (file) {
				const ext = file.name.split('.')[1];

				const newFileName = `${fileName}${lrn}.${ext}`;

			const renamedFile = new File([file], newFileName, { type: file.type });

			return renamedFile;
		} else {
			return 'Please select a file and enter a new file name.';
		}
	}


	function prevFieldset(id) {
		$(id).click(function () {
			if ($('#studentRecordForm').valid()) {
				let currentFieldset = $('fieldset:visible');
				let prevFieldset = currentFieldset.prev('fieldset');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSet(id) {


		


		$(id).click(function () {


			if ($('#studentRecordForm').valid()) {
				let currentFieldset = $('fieldset:visible');
				let nextFieldset = currentFieldset.next('fieldset');

				if (nextFieldset.length > 0) {
					currentFieldset.hide();
					nextFieldset.show();
				}
			}
		});
	}






$('#regCredentialType').on('change', function () {
	let credential = this.value;

	console.log(credential, 'get value');

	switch (credential) {
		case 'local':
			$('#regularLocal').removeClass('hidden');
			$('#regularForeign').addClass('hidden');

			// Uncheck all foreign checkboxes
			$('.regForeign:checked').each(function () {
				$(this).prop('checked', false);
			});

			break;
		case 'foreign':
			$('#regularLocal').addClass('hidden');
			$('#regularForeign').removeClass('hidden');

			// Uncheck all local checkboxes
			$('.regLocal:checked').each(function () {
				$(this).prop('checked', false);
			});
			break;
		default:
			$('#regularLocal').addClass('hidden');
			$('#regularForeign').addClass('hidden');
			$('.regLocal:checked').each(function () {
				$(this).prop('checked', false);
			});
			$('.regForeign:checked').each(function () {
				$(this).prop('checked', false);
			});
			break;
	}
});





$('#searchBtn').on('click', function () {
	const getLrn = $('#searchLrn').val();

	console.log(getLrn,'my lrn value');

	const data = {
		lrn: getLrn,
	};

console.log(data,'get data')

	
	httpJSONReq('findUserLrn', data, (res) => {

			console.log(res,'get message');
		if (res.success === true) {
			console.log(res);
			$('#userRegularId').val(res.userId);
			$('#enrollmentId').val(res.enrollmentId);
			$('#enrollType').val(res.yearType);
			$('#enrollType').val(res.yearType);
			$('#regFullName').val(res.fullName);
			 $('#enrollType').find('option:not(:selected)').prop('disabled', true);

			  var selectElement = $('#regLevel');

				// Create a new option element
				var newOption = $('<option>', {
					value: res.yearId,
					text: res.yearLevel, // You can change the text to whatever you want
				});

				// Append the new option to the select element
				selectElement.append(newOption);

				const getSchoolYear = `SY-${res.start} - ${res.end}`;

				$('#reg_syYear').text(getSchoolYear);



			$('#searchFilterLrn').addClass('hidden');
			// Show the second fieldset initially
				// $('fieldset:eq(1)').show();
					$('.my-fieldset:first').show();
		} else {
			Swal.fire({
				icon: 'error',
				title: 'Forbidden Request',
				text: res.message,
				footer: null,
			});
		}
	});
});



$(document).ready(function () {
	// Create form validation
	$('#studentRegularForm').validate({
		rules: {
			enrollType: {
				required: true,
			},
			regLevel: {
				required: true,
			},
			gwa: {
				required: true,
				number: true,
				range: [75, 100],
			},
		},
		messages: {
			enrollType: {
				required: 'Field cannot be empty.',
			},
			regLevel: {
				required: 'Field cannot be empty.',
			},
			gwa: {
				required: 'This field is required',
				number: 'Please enter a valid number',
				range: 'Please enter a number between 75 and 100',
			},
		},
	});

	$('.my-fieldset').hide();


	// Bind the click events for previous and next buttons
	prevFieldsetReg('#prvBtn__1');
	nextFieldSetReg('#nxtBtn__1');
	prevFieldsetReg('#prvBtn__2');
	nextFieldSetReg('#nxtBtn__2');
	prevFieldsetReg('#prvBtn__3');
	nextFieldSetReg('#nxtBtn__3');
	prevFieldsetReg('#prvBtn__4');
	nextFieldSetReg('#nxtBtn__4');
	prevFieldsetReg('#prvBtn__5');
	nextFieldSetReg('#nxtBtn__5');



			$('#nxtBtn__4').on('click', function () {
				// get the level,name
				$('#modal_reg-container').addClass('max-w-[650px]');

				const presentYear = new Date().getFullYear();
				const prevYear = new Date().getFullYear() - 1;

				const syear = `SY:${prevYear}-${presentYear}`;

				let getSelectedLevel = $('#regLevel option:selected').text();

				console.log(getSelectedLevel, 'getSelected');

				const preSchool = ['nursery', 'kinder'];
				const grade1 = ['grade 1'];
				const primary = ['grade 2', 'grade 3'];
				const intermidiate = ['grade 4', 'grade 5', 'grade 6'];
				const jrHigh = ['grade 7', 'grade 8', 'grade 9', 'grade 10'];
				const srHigh = ['grade 11', 'grade 12'];

				let selectedLevel = '';
				let miscelanious = '';
				let booksModule = '';
				let tuitionFee = '';
				let total = '';
				let fullPayment = '';

				if (preSchool.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'PRESCHOOL';
					miscelanious = '₱10,045.00';
					booksModule = '₱5,905.00';
					tuitionFee = '₱15,000.00';
					total = '₱30,950.00';
					fullPayment = '₱29,450.00';
				}
				if (grade1.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'PRESCHOOL';
					miscelanious = '₱14,850.00';
					booksModule = '₱5,905.00';
					tuitionFee = '₱9,350.00';
					total = '₱30,105.00';
					fullPayment = '₱29,170.00';
				}
				if (primary.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'PRIMARY';
					miscelanious = '₱12,850.00';
					booksModule = '₱5,905.00';
					tuitionFee = '₱9,350.00';
					total = '₱28,105.00';
					fullPayment = '27,170.00';
				}

				if (intermidiate.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'INTERMIDIATE';
					miscelanious = '₱12,850.00';
					booksModule = '₱6,750.00';
					tuitionFee = '₱9,350.00';
					total = '₱28,950.00';
					fullPayment = '₱28,015.00';
				}
				if (jrHigh.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'JR HIGH SCHOOL';
					miscelanious = '₱13,050.00';
					booksModule = '₱8,325.00';
					tuitionFee = '₱10,450.00';
					total = '₱31,925.00';
					fullPayment = '₱30,880.00';
				}
				if (srHigh.includes(getSelectedLevel.toLowerCase())) {
					selectedLevel = 'SENIOR HIGH SCHOOL';
					miscelanious = '₱7,670.00';
					booksModule = '0.00';
					tuitionFee = '17,500.00';
					total = '25,170.00';
					fullPayment = '25,170.00';
				}

			
				let fullName = $('#regFullName').val().toUpperCase();
				let getDateString = new Date().toLocaleDateString();

		
				$('#reg_fLName').text(fullName);
				$('#reg_typeFee').text(`(${selectedLevel})`);
				$('#reg_getSelectedSection').text(getSelectedLevel);
				$('#reg_getDateIssued').text(getDateString);
				$('#reg_misc').text(miscelanious);
				$('#reg_books').text(booksModule);
				$('#reg_tuition').text(tuitionFee);
				$('#reg_total').text(total);
				$('#reg_full').text(fullPayment);

				// print

				$('#syYearPrint').text(syear);
				$('#fLNamePrint').text(fullName);
				$('#typeFeePrint').text(`(${selectedLevel})`);
				$('#getSelectedSectionPrint').text(getSelectedLevel);
				$('#getDateIssuedPrint').text(getDateString);
				$('#miscPrint').text(miscelanious);
				$('#booksPrint').text(booksModule);
				$('#tuitionPrint').text(tuitionFee);
				$('#totalPrint').text(total);
				$('#fullPrint').text(fullPayment);
				$('#typeAvail').text('(Regular)');

			});

		let submitForm = false;
		$('#nxtBtn__5').on('click', function () {

			
			let valid = $('#studentRegularForm').valid();

			console.log(valid, 'get valid');
			if (valid) {
				submitForm = true;
			}
		});

			

	$('#studentRegularForm').submit(function(e){
	
	
			let valid = $('#studentRegularForm').valid();


			if (valid === true && submitForm) {
				e.preventDefault();
				const form = document.getElementById('studentRegularForm');

				const typeFee = $('#reg_typeFee').text().replace('₱', '');
				const misc = $('#reg_misc').text().replace('₱', '');
				const book = $('#reg_books').text().replace('₱', '');
				const tuition = $('#reg_tuition').text().replace('₱', '');
				const total = $('#reg_total').text().replace('₱', '');
				const full = $('#reg_full').text().replace('₱', '');
				const year = new Date().getFullYear();

				const formData = new FormData(form);
				formData.append('reg_typeFee', typeFee);
				formData.append('reg_miscellanious', misc);
				formData.append('reg_bookModules', book);
				formData.append('reg_tuitionFee', tuition);
				formData.append('reg_totalFee', total);
				formData.append('reg_fullCashPayment', full);
				formData.append('reg_yearIssued', year);

				const data = {};

				for (let pair of formData.entries()) {
					data[pair[0]] = pair[1];
				}

				httpJSONReq('enrollRegularStudents', data, (res) => {
					console.log(res, 'get message');
					if (res.success === true) {
						
						location.href = `?page=dashboard`;
						localStorage.setItem('data', JSON.stringify({ id: '#tab1', action: 'add', message: res.message }));
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Forbidden Request',
							text: res.message,
							footer: null,
						});
					}
				});

				console.log(data);
			} else {
				console.log('Form submission prevented.');
				e.preventDefault();
			}

	})

});


$('#studentRecCloseModal').on('click', function () {
	localStorage.removeItem('modify');
	$('#studentRecordForm')[0].reset();
	$('#studentRegularForm')[0].reset();

	$('fieldset').hide(); // Hide all fieldsets
	$('fieldset:first').show();
	$('#studentRecTitle').text('Registration form');

 // Show the second fieldset
});


	function prevFieldsetReg(id) {
	 $(id).click(function () {
			if ($('#studentRegularForm').valid()) {
				let currentFieldset = $('.my-fieldset:visible');
				let prevFieldset = currentFieldset.prev('.my-fieldset');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSetReg(id) {
 		$(id).click(function () {
		if ($('#studentRegularForm').valid()) {
			let currentFieldset = $('.my-fieldset:visible');
			let nextFieldset = currentFieldset.next('.my-fieldset');

			if (nextFieldset.length > 0) {
				currentFieldset.hide();
				nextFieldset.show();
			}
		}
		});
	}



function httpJSONReq(action,data,cb) {
	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', `src/function/controller.php?action=${action}`, true);

	xhttp.onreadystatechange = function() {

		if(this.readyState === 4){
			 if(this.status === 200){
					let response = JSON.parse(this.responseText);
					cb(response);
			 }
			 else{
				cb(response);
			 }
		}
		
	}

let payload = `data=${JSON.stringify(data)}`;
xhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

xhttp.send(payload);

}





