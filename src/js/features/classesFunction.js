const classesTable = '.classes-table';
const classesNoTesult = 'classesNoResult';

// menu
const classesMenu = '#classesDropdownMenu';
const classesDropdownBtn = '#classesDropdownBtn';

// filter
const classesSearchId = 'classesSearchEl';
const classesToggle = '#onModalclassesToggle';

// search

const classesPrint = 'classesPrint';
const classesPageArea = '.classes-printable';

// getMenu(classesMenu, classesTable);
showPage(classesTable, classesNoTesult);
// tableSorting(classesMenu, classesTable, classesNoTesult);

let classesSearchEl = document.getElementById(classesSearchId);

classesSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(classesTable, classesNoTesult, searchValue);
});

$('#' + classesPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(classesPageArea).removeClass('hidden');

	$(classesPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(classesPageArea).addClass('hidden');
		}),
	});
});

$('#classesCloseModal').on('click', function () {
	$('#classesName').val('');

	localStorage.removeItem('modify');
	$('#classesForm')[0].reset();
});

function editClass(data) {
	modal = 'edit';

	console.log(data);

	$('#classId').val(data.id);

	$('#classesName').val(data.name);
	$('#roomNumber').val(data.room_number);

	$('#teacherClassItem').val(data.teacherId).trigger('change');

	$('#classSectionName').val(data.section_id).trigger('change');
	$('#classSubjectName').val(data.subjectId).trigger('change');
	$('#classYearLevel').val(data.yearId).trigger('change');
	$('#timeofDay').val(data.timeofDay);

	let timeSched = data.schedule.split('-');

	// Assuming timeSched[0] and timeSched[1] are in the format "HH:mm AM/PM"
	let start = timeSched[0].trim();
	let end = timeSched[1].trim();


	console.log(timeSched);
	console.log(start);
	console.log(end)

	// Split the start and end times
	let startTime = start.split(' ')[0];
	let endTime = end.split(' ')[0];

	console.log(startTime);
	console.log(endTime);

	// Set the default values for time inputs
	$('#startTime').val(startTime);
	$('#endTime').val(endTime);

	$(classesToggle).click();

	localStorage.setItem('modify', JSON.stringify(true));
}

function deleteClass(data) {
	const id = data.id;

	console.log(data)

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

			const dataReq = {
				class_id: data.id,
			};

			httpJSONReq('deleteClass', dataReq, (res) => {
				console.log(res, 'get res');
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: 'delete', message: res.message }));
				}
			});
		}
	});
}




$(document).ready(function(){

  $('#classesForm').validate({
    rules:{

    },
    messages:{

    }
  
  });


		const prevIndex = [1, 2, 3];
		const nextIndex = [1, 2, 3];

		prevIndex.forEach((id) => {
			prevFieldsetClass(`#classPrevBtn__${id}`);
		});

		nextIndex.forEach((id) => {
			nextFieldSetClass(`#classNextBtn__${id}`);
		});



	$('.fieldset-class').hide();
	$('.fieldset-class:first').show();

	let submitForms = false;

	$('#classNextBtn__3').on('click',function(){
			if($('#classesForm').valid){
				submitForms= true;
			}
	});


  $('#classesForm').submit(function(e){
    e.preventDefault();
    
    let valid = $('#classesForm').valid()
    let form = document.getElementById('classesForm');

    if (valid === true && submitForms == true) {
			let formData = new FormData(form);

			formData.append('startClass', getTimeConverter('startTime'));
			formData.append('endClass', getTimeConverter('endTime'));

			let data = {};

			for (let pair of formData.entries()) {
				data[pair[0]] = pair[1];
			}

			if (localStorage.getItem('modify')) {
				httpJSONReq('editClass', data, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: 'update', message: res.message }));
					} else {
						Swal.fire({
							icon: 'error',
							text: res.message,
							title: 'Forbiddem request',
							footer: null,
						});
					}
				});
			} else {
				httpJSONReq('addClass', data, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab5', action: 'add', message: res.message }));
					} else {
						Swal.fire({
							icon: 'error',
							text: res.message,
							title: 'Forbiddem request',
							footer: null,
						});
					}
				});
			}
		} else {
			console.log('forbidden response');
		}



  });


})


	function prevFieldsetClass(id) {
		$(id).click(function () {
			if ($('#classesForm').valid()) {
				let currentFieldset = $('.fieldset-class:visible');
				let prevFieldset = currentFieldset.prev('.fieldset-class');

				if (prevFieldset.length > 0) {
					currentFieldset.hide();
					prevFieldset.show();
				}
			}
		});
	}

	// Function to navigate to the next fieldset
	function nextFieldSetClass(id) {
		$(id).click(function () {
			if ($('#classesForm').valid()) {
				let currentFieldset = $('.fieldset-class:visible');
				let nextFieldset = currentFieldset.next('.fieldset-class');

				if (nextFieldset.length > 0) {
					currentFieldset.hide();
					nextFieldset.show();
				}
			}
		});
	}

