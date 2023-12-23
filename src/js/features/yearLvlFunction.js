
const yrTable = '.year-table';
const yrNoTesult = 'yrNoResult';
const yrMenu = '#yearDropdownMenu'
const yearDropdownBtn = '#yearDropdownBtn';


getMenu(yrMenu, yrTable);
showPage(yrTable, yrNoTesult);
tableSorting(yrMenu,yrTable, yrNoTesult);


let searchTerms = document.getElementById('yearSearch');





	// dropdown menu
	let dropdown = document.getElementById('yrMenu');
	let dropdownButton = document.getElementById('yearDropdownBtn');

	dropdownButton.addEventListener('click', () => {
		dropdown.classList.toggle('hidden');
	});

	// dropdown menu
	let dropdownLi = document.querySelectorAll(`${yrMenu} ul li`);






searchTerms.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable('.year-table','yrNoResult', searchValue);
});



// close modal
$('#closeModalYr').click((e) => {
	//  $('#addYearLevel').hide();
	$('#yrId').attr('data-editable', false);
	$('#yrTitle').text('Create');
	$('#yrBtn').text('Save');
	$('#yrName').val('');
	$('#type').val('');
  $('#yearLevelForm')[0].reset();

});

$('#onModalYearToggle').on('click', function () {
	console.log(modal, 'get type');
	if (modal !== 'edit') {
		$('#yrName').val('');
		$('#type').val('');

		$('[id*="-error"]').hide();
		$('#yrId').attr('data-editable', false);

		$('#yrTitle').text('Create');
		$('#yrBtn').text('Save');
	}
});





// end YEAR LEVEL

let modal = '';

// cta call to action

function deleteYrlLevel(data) {
	const id = data.id;

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

			xhttp.open('POST', 'src/function/controller.php?action=deleteYrLevel', true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status === 200) {
						let response = JSON.parse(this.responseText);

						console.log(response, 'get response');

						if (response.success == true) {
							location.href = '?page=dashboard';
							localStorage.setItem('data', JSON.stringify({ id: '#tab6',action:'delete' ,message:'Year has been deleted'}));
						}
					}
				}
			};

			const data = {
				yrId: id,
			};
			// payload
			let payload = `data=${JSON.stringify(data)}`;

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.send(payload);
		}
	});
}

function editYrlLevel(data) {
	modal = 'edit';

	console.log(data);

	$('#yrName').val(data.name);
	$('#type').val(data.type);
	$('#yrId').val(data.id);
	$('#qualifyAge').val(data.qualifyAge);

	$('[id*="-error"]').hide();
	$('#onModalYearToggle').click();

	$('#yrId').attr('data-editable', true);
	$('#yrTitle').text('Update');
	$('#yrBtn').text('Update');

	
}

// !!!!!!!!!!!!!!!!!!!!!!!!   YEAR LEVEL FORM !!!!!!!!!!!!!!///////

// create a submitHandler
$('#yearLevelForm').validate({
	rules: {
		yrName: {
			required: true,
			minlength: 3,
		},
		type: {
			required: true,
		},
		qualifyAge: {
			required: true,
			number: true,
			range: [2, 50],
		},
	},
	messages: {
		yrName: {
			required: 'Please enter year level name',
			minlength: 'Please enter at least 3 characters',
		},
		type: {
			required: 'Please select year level',
		},
		qualifyAge: {
			required: 'Field is required.',
			number: 'Make surenumber is valid',
			range: 'Please enter a number between 2 and 50.',
		},
	},
	submitHandler: function () {
		const form = document.getElementById('yearLevelForm');

		const formData = new FormData(form);

		const data = {};

		for (let pair of formData.entries()) {
			data[pair[0]] = pair[1];
		}

		console.log('data');

		//     // xhttp
		let xhttp = new XMLHttpRequest();

		let url = '';
		let action = '';

		const editable = $('#yrId').data('editable');

		if (editable == true) {
			url = 'src/function/controller.php?action=updateYrLevel';
			action = 'update';
		} else {
			url = 'src/function/controller.php?action=addYrLevel';
			action = 'add';
		}

		xhttp.open('POST', url, true);

		xhttp.onreadystatechange = function () {
			if (this.readyState == 4) {
				if (this.status === 200) {
					let response = JSON.parse(this.responseText);

					if (response.success == true) {
						console.log(response.success);

						location.href = `?page=dashboard`;
						localStorage.setItem('data', JSON.stringify({ id: '#tab6', action: action, message: response.message }));
					}
				} else {
					console.log(this.responseText);

					//    Swal.fire({
					//   icon: 'error',
					//   title: 'Oops...',
					//   text: `Please complete all requirement`,
					//   footer: ''
					// })
				}
			}
		};

		// payload
		let payload = `data=${JSON.stringify(data)}`;

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.send(payload);
	},
});

// print

$('#print').on('click',(e) => {
	$('.custom-table').addClass('hidden');
	$('.year-printable').removeClass('hidden');

	$('.year-printable').print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$('.year-printable').addClass('hidden');
		}),
	});
});

