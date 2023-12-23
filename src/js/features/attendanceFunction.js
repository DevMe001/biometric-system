const attendanceTable = '.attendance-table';


const attendanceNoTesult = 'attendanceNoResult';


document.addEventListener('DOMContentLoaded', function () {
	showPage(attendanceTable, attendanceNoResult);
});













// menu
const attendanceMenu = '#attendanceDropdownMenu';
const attendanceDropdownBtn = '#attendanceDropdownBtn';

// filter
const attendanceSearchId = 'attendanceSearchEl';
const attendanceToggle = '#onModalattendanceToggle';

// search

const attendancePrint = 'attendancePrint';
const attendancePageArea = '.attendance-printable';

// getMenu(attendanceMenu, attendanceTable);

// showPage(attendanceTable, attendanceNoTesult);
// tableSorting(attendanceMenu, attendanceTable, attendanceNoTesult);

let attendanceSearchEl = document.getElementById(attendanceSearchId);

attendanceSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(attendanceTable, attendanceNoTesult, searchValue);
});

$('#' + attendancePrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(attendancePageArea).removeClass('hidden');

	$(attendancePageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(attendancePageArea).addClass('hidden');
		}),
	});
});

function editattendance(data) {
	modal = 'edit';

	// console.log(data);

	// $('#yrName').val(data.name);
	// $('#type').val(data.type);
	// $('#yrId').val(data.id);

	// $('[id*="-error"]').hide();
	$(attendanceToggle).click();

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}

function deleteattendance(data) {
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

			xhttp.open('POST', 'src/function/controller.php?action=deleteattendance', true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status === 200) {
						let response = JSON.parse(this.responseText);

						console.log(response, 'get response');

						if (response.success == true) {
							location.href = '?page=dashboard';
							localStorage.setItem('data', JSON.stringify({ id: '#tab3', action: 'delete', message: 'attendance has been deleted' }));
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
