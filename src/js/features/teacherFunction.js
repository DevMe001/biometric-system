const teacherTable = '.teacher-table';
const teacherNoTesult = 'teacherNoResult';

// menu
const teacherMenu = '#teacherDropdownMenu';
const teacherDropdownBtn = '#teacherDropdownBtn';

// filter
const teacherSearchId = 'teacherSearchEl';
const teacherToggle = '#onModalteacherToggle';

// search

const teacherPrint = 'teacherPrint';
const teacherPageArea = '.teacher-printable';

// getMenu(teacherMenu, teacherTable);
showPage(teacherTable, teacherNoTesult);
// tableSorting(teacherMenu, teacherTable, teacherNoTesult);

let teacherSearchEl = document.getElementById(teacherSearchId);

teacherSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(teacherTable, teacherNoTesult, searchValue);
});

$('#' + teacherPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(teacherPageArea).removeClass('hidden');

	$(teacherPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(teacherPageArea).addClass('hidden');
		}),
	});
});

function editteacher(data) {
	modal = 'edit';



	console.log(data,'get data');
	// console.log(data);
	$('#teacher_id').val(data.id);

	$('#accountSelection').val(data.account_id).trigger('change');
	$('#teach_fullname').val(data.name);
	$('#courseTaken').val(data.course_taken);
	$('#teacherAddress').val(data.address);
	$('#teacherAddress').val(data.address);
	$('#teacherGender').val(data.gender);
	$('#teacherBirthday').val(data.birthdate);
	$('#getTeacheryAge').removeClass('hiddden');
	$('#teacherAge').val(data.age);
	$('#oldTeacherProfile').val(data.profile);
	
	let previewImgId = $('#previewTeacherDiv');


	// Set the background-image and background-size CSS properties
	$('.default-imgProfile').addClass('hidden');

	previewImgId.addClass('border-2 rounded');
	previewImgId.css('background', `url('src/images/uploads/teacher-profile/${data.profile}') no-repeat`);
	previewImgId.css('background-size', 'contain');
	previewImgId.css('background-position', 'center center');
	previewImgId.css('object-fit', 'contain');

	let subjectContainer = $('.subjectContainer');


	const resultWithDoubleQuotes = data.subjectChosenId.replace(/'/g, '"');

	// Parse the string into a JavaScript array of objects
	const parsedResult = JSON.parse(resultWithDoubleQuotes);



	$('#teacherSubjectChosen0').val(parsedResult[0].subject);
	$('#teacherYearLevel0').val(parsedResult[0].level);
	$('#teacherRecordId0').val(parsedResult[0].id);


	console.log(parsedResult.length)

	if(parsedResult.length === 5){
			$('.appendSubject').prop('disabled', true);
	}

	parsedResult.shift();

	parsedResult.forEach((el, i) => {

		console.log(el,'get indexes')

		let subjectItem = subjectContainer.find('.subjectItem:first').clone(true);

		console.log(subjectItem.find('.teach-rec'),'get id input');


		console.log(el, i);
		subjectItem.attr('id', 'subjectItem' + (i + 1));
		subjectItem.find('.teach-rec').attr('id', 'teacherRecordId' + (i + 1));
		subjectItem.find('.teach-rec').attr('name', 'teacherRecordId' + (i + 1));
		subjectItem.find('.teach-rec').val(el.id);
		
		subjectItem.find('.subject-list').attr('id', 'teacherSubjectChosen' + (i + 1));
		subjectItem.find('.subject-list').attr('name', 'teacherSubjectChosen' + (i + 1));
		subjectItem.find('.subject-list').val(el.subject);

		subjectItem.find('.level-list').attr('id', 'teacherYearLevel' + (i + 1));
		subjectItem.find('.level-list').attr('name', 'teacherYearLevel' + (i + 1));
		subjectItem.find('.level-list').val(el.level);


		
	
			subjectItem.find('.appendSubject').addClass('hidden');
		
		let subjectBtn = subjectItem.find('.button-item');

	 let removeButton = $('<label for="teacherYearLevel"><button   type="button" class="removeSubject btn bg-blue-600 text-white px-5 py-2 rounded">-</button></label>');

		subjectBtn.append(removeButton);
		// Add a "Remove" button to the initial subjectItem
	
		// Append the cloned item to the container
		subjectContainer.append(subjectItem);
	});


	$('#onreadytoSubmit').removeClass('hidden');



	// $('[id*="-error"]').hide();
	$(teacherToggle).click();

	localStorage.setItem('modify',JSON.stringify(true));

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}



// Use event delegation to handle the click event for dynamically added elements
$('.subjectContainer').on('click', '.removeSubject', function () {
	// Handle the click event for the remove button
	$(this).closest('.subjectItem').remove();
});

	

function deleteteacher(data) {

	console.log(data,'get data')


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


			const dataRes={
				teacher_id:data.id
			}
			// req
			httpJSONReq('deleteTeacher', dataRes, (res) => {
				console.log(res, 'get res');
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab2', action: 'delete', message: res.message }));
				}
			});
		
		}
	});
}



$(document).ready(function () {
	$('#teacherForm').validate({
		rules: {},
		messages: {},
		errorPlacement: function (error, element) {
			// Customize the error placement as needed
			error.insertAfter(element); // Example: Place errors after the input fields
		},
		
	});



	 // Show the second fieldset)

	$('.teacherFieldset').hide(); // Hide all fieldsets
	$('.teacherFieldset:first').show(); // Show the second fieldset


		const prevIndex = [1, 2, 3];
		const nextIndex = [1, 2, 3];

		prevIndex.forEach((id) => {
			prevFieldsetTeach(`#teachPrevBtn__${id}`);
		});

		nextIndex.forEach((id) => {
			nextFieldSetTeach(`#teachNextBtn__${id}`);
		});

		let submitReq = false;

		$('#teachNextBtn__3').on('click',function(){
				if($('#teacherForm').valid()){
					submitReq =true;
				}
		});

	$('#teacherForm').submit(function (e) {
		e.preventDefault();

		let valid = $('#teacherForm').valid();
		let form = document.getElementById('teacherForm');

		if (valid === true && submitReq == true) {
			let formData = new FormData(form);
			let data = {};

			for (let pair of formData.entries()) {
				data[pair[0]] = pair[1];
			}

			console.log(data)

			const subjectlevelList = [
				{
					subject: data.teacherSubjectChosen0,
					level: data.teacherYearLevel0,
					id: data.teacherRecordId0,
				},
				{
					subject: data.teacherSubjectChosen1,
					level: data.teacherYearLevel1,
					id: data.teacherRecordId1,
				},
				{
					subject: data.teacherSubjectChosen2,
					level: data.teacherYearLevel2,
					id: data.teacherRecordId2,
				},
				{
					subject: data.teacherSubjectChosen3,
					level: data.teacherYearLevel3,
					id: data.teacherRecordId3,
				},
				{
					subject: data.teacherSubjectChosen4,
					level: data.teacherYearLevel4,
					id: data.teacherRecordId4,
				},
			];

			let uniqueArray = subjectlevelList.filter((obj, index, self) => {
				if (Object.keys(obj).length > 0) {
					return index === self.findIndex((o) => o.subject === obj.subject && o.level === obj.level);
				}
				return true; // Include empty objects
			});

			// Convert the array to a JSON string
			let uniqueArrayString = JSON.stringify(uniqueArray);

			// Append the JSON string to FormData
			formData.append('subject', uniqueArrayString);

			// Send the FormData in your HTTP request
			if (localStorage.getItem('modify') === 'true') {
				httpResFormData('editTeacher', formData, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab2', action: 'update', message: res.message }));
					}
				});
			} else {
				httpResFormData('addTeacher', formData, (res) => {
					localStorage.removeItem('modify');
					if (res.success) {
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab2', action: 'add', message: res.message }));
					}
					else{
						Swal.fire({
							icon:'error',
							'text':res.message,
							'title':'Forbidden request',
							footer:null
						})
					}
				});
			}
		} else {
			console.log('forbidden response');
		}
	});
});



	function prevFieldsetTeach(id) {
		$(id).click(function () {
			if ($('#teacherForm').valid()) {
				let currentFieldset = $('.teacherFieldset:visible');
				let prevFieldset = currentFieldset.prev('.teacherFieldset');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSetTeach(id) {
		$(id).click(function () {
			if ($('#teacherForm').valid()) {
				let currentFieldset = $('.teacherFieldset:visible');
				let nextFieldset = currentFieldset.next('.teacherFieldset');

				if (nextFieldset.length > 0) {
					currentFieldset.hide();
					nextFieldset.show();
				}
			}
		});
	}


	


$('#teacherProfile').on('change', function (e) {
	let file = e.target.files[0];

	filePreviHandlerTeacherMode('#previewTeacherDiv', file, '.default-imgProfile');
});

function filePreviHandlerTeacherMode(id, file, defaultHide) {
	if (file.size > 1048576) {
		Swal.fire({
			icon: 'error',
			title: 'File is not supported',
			text: 'File size is less than 1Mb',
			footer: null,
		});
	} else {
		if (file.type.startsWith('image')) {
			console.log('ok begin uploads');
			faceDetectorTeacherMode(id, file, defaultHide);
		} else {
			Swal.fire({
				icon: 'error',
				title: 'File is not supported',
				text: 'Only images allowed',
				footer: null,
			});
		}
	}
}

let getTeacherFile;

function faceDetectorTeacherMode(id, file, defaultHide) {
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
			displayErrorOnScreen(previewImgId, defaultHide, 'Failed to load image.');
		};

		// Set the background-image and background-size CSS properties
		$(defaultHide).addClass('hidden');

		previewImgId.addClass('border-2 rounded');
		previewImgId.css('background', `url('src/images/loader.gif') no-repeat`);
		previewImgId.css('background-size', 'contain');
		previewImgId.css('background-position', 'center center');
		previewImgId.css('object-fit', 'contain');

		console.log(detections, 'get detection');

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

				getTeacherFile = file;

				// Revoke the object URL when the image is loaded
				img.onload = () => {
					URL.revokeObjectURL(ctvUrl);
				};
			}, 3000);
		} else {
			// Handle the case where no faces are detected
			displayErrorOnScreen(previewImgId, defaultHide, 'Upload consise,clear face image');
		}
	};
}

function displayErrorOnScreen(previewImgId, defaultHide, errorMessage) {
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





		$('#teacherBirthday').on('change', function () {
	

			const birthdate = new Date(this.value);
			const currDate = new Date();

			const bdayYear = birthdate.getFullYear();
			const currDateYear = currDate.getFullYear();

			let age = currDateYear - bdayYear;

			if (currDate.getMonth() < birthdate.getMonth() || (currDate.getMonth() === birthdate.getMonth() && currDate.getDate < birthdate.getDate())) {
				age--;
			}

			if (age >= 20 && age<= 65) {
				$('#teacherAgeReveal').removeClass('hidden');
				$('#getTeacheryAge').text(age);
				$('#teacherAge').val(age);
			}
			else{

				this.value='';

				Swal.fire({
					icon:'error',
					text:'Age restricted to 20 upto 65 years old',
					title:'Age not valid',
					footer:null
				})

			$('#teacherAgeReveal').addClass('hidden');
			$('#getTeacheryAge').text('');
			$('#teacherAge').val('');
			}
		});

		
// $(document).ready(function () {
// 	let maxDivs = 5; // Maximum number of divs
// 	let divCount = 1; // Initial div count (assuming you have one initially)

// 	$('.appendSubject').on('click', function () {
// 		if (divCount < maxDivs) {
// 			let $subjectContainer = $('.subjectContainer');
// 			let $subjectItem = $subjectContainer.find('.subjectItem:first').clone(true);

// 			// Reset the values of select elements if needed
// 			$subjectItem.find('select').val('');

// 			$subjectContainer.append($subjectItem);
// 			divCount++;

// 			// Disable the button when the maximum limit is reached
// 			if (divCount === maxDivs) {
// 				$(this).prop('disabled', true);
// 			}
// 		}
// 	});
// });

$(document).ready(function () {
	let maxDivs = 5; // Maximum number of divs
	let divCount = 1; // Initial div count (assuming you have one initially)

	// Function to add a "Remove" button to a subjectItem
	function addRemoveButton($subjectItem) {
		let $removeButton = $('<div><label for="teacherYearLevel"><button  type="button" class="removeSubject btn bg-blue-600 text-white px-5 py-2 rounded">-</button></label></div>');
		
		if(divCount > 1){
				$removeButton.on('click', function () {
					$subjectItem.remove();
					divCount--;

					// Re-enable the "Add Input" button
					$('.appendSubject').prop('disabled', false);
				});
				$subjectItem.append($removeButton);
		}
	}

	// Add a "Remove" button to the initial subjectItem
	addRemoveButton($('.subjectItem'));

	$('.appendSubject').on('click', function () {

		let subList = $('.subjectContainer .subjectItem').length;

		let subjectValue = '';
		let levelValue = '';
		if(subList === 1){
			subjectValue = $('#teacherSubjectChosen0').val();
			levelValue = $('#teacherYearLevel0').val();
		}
		else{
			subjectValue = $('#teacherSubjectChosen' + divCount).val();
			levelValue = $('#teacherYearLevel' + divCount).val();
			
		}


	console.log(divCount,'get divcount');


			$('#onreadytoSubmit').removeClass('hidden');

		


		if (divCount < maxDivs && subList < 5 && subjectValue != '' && levelValue !== '') {
				
		

			let $subjectContainer = $('.subjectContainer');
			let $subjectItem = $subjectContainer.find('.subjectItem:first').clone(true);

			$subjectItem.attr('id', 'subjectItem-' + divCount);


			$subjectItem.find('.teach-rec').attr('id', 'teacherRecordId' + divCount);
			$subjectItem.find('.teach-rec').attr('name', 'teacherRecordId' + divCount);
			$subjectItem.find('.subject-list').attr('id', 'teacherSubjectChosen' + divCount);
			$subjectItem.find('.subject-list').attr('name', 'teacherSubjectChosen' + divCount);
			$subjectItem.find('.subject-list').attr('required', true);

			$subjectItem.find('.level-list').attr('id', 'teacherYearLevel' + divCount);
			$subjectItem.find('.level-list').attr('name', 'teacherYearLevel' + divCount);
			$subjectItem.find('.level-list').attr('required', true);

			// Reset the values of select elements if needed
			$subjectItem.find('select').val('');

			$subjectContainer.append($subjectItem);
			divCount++;

			// Add a "Remove" button to the newly appended subjectItem
			addRemoveButton($subjectItem);

			// Disable the "Add Input" button when the maximum limit is reached
			if (divCount === maxDivs) {
				$(this).prop('disabled', true);
			}
		}
	});
});

$('#teacherYearLevel').on('change',function(){
	$('#onreadytoSubmit').removeClass('hidden');
});



 $('.subject-list,.level-list').on('change',function(){
		$('.subject-list').forEach();
 })


$('#teacherCloseModal').on('click', function () {
	localStorage.removeItem('modify');
	 $('#teacherForm')[0].reset();
});


