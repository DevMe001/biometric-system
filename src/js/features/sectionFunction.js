
const sectionTable = '.section-table';
const sectionNoTesult = 'sectionNoResult';

// menu
const secMenu = '#secDropdownMenu';
const secDropdownBtn = '#secDropdownBtn';

// filter
const sectionSearchId = 'sectionSearchEl';
const sectionToggle='#onModalSectionToggle';

// search

const sectionPrint = '#sectionPrint';
const sectionPageArea = '.section-printable';


// getMenu(secMenu, sectionTable);
showPage(sectionTable, sectionNoTesult);
// tableSorting(secMenu, sectionTable, sectionNoTesult);



let sectionSearchEl = document.getElementById(sectionSearchId);









sectionSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(sectionTable, sectionNoTesult, searchValue);
});






$(sectionPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(sectionPageArea).removeClass('hidden');

	$(sectionPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(sectionPageArea).addClass('hidden');
		}),
	});
});


$('#sectionCloseModal').on('click',function(){
		$('#sectionBtn').text('Submit');
			$('#sectionTitle').text('Create new section');
		localStorage.removeItem('modify');
		 $('#sectionForm')[0].reset();

});

function editSection(data) {
	modal = 'edit';

	$('#sectionBtn').text('Update');
	$('#sectionTitle').text('Update section');
	$('#section_id').val(data.id);
	$('#secName').val(data.name);
	// $('#secLimit').val(data.limit);
	// $('#secMin').val(data.min_grade);
	// $('#secMax').val(data.max_grade)

localStorage.setItem('modify',JSON.stringify(true));

	// $('#yrName').val(data.name);
	// $('#type').val(data.type);
	// $('#yrId').val(data.id);

	// $('[id*="-error"]').hide();
	$(sectionToggle).click();

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}



function deleteSection(data) {
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
						const data = {
							section_id: id,
						};
			
				httpJSONReq('deleteSection', data, (res) => {
					if (res.success) {
					
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab3', action: 'delete', message: 'Section has been deleted' }));
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Forbidden Request',
							text: res.message,
							footer: null,
						});
					}
				});

		
		}
	});
}


$(document).ready(function() {
	// Define a custom validation method for comparing min and max grades
	$.validator.addMethod(
		'minMaxCheck',
		function (value, element) {
			var minGrade = parseFloat($('#secMin').val());
			var maxGrade = parseFloat($('#secMax').val());

			return minGrade <= maxGrade;
		},
		'Minimum grade cannot be greater than the maximum grade.',
	);

	$('#sectionForm').validate({
		rules: {
			secName: {
				required: true,
			}
			// secLimit: {
			// 	required: true,
			// 	number: true,
			// 	range: [20, 40],
			// },
			// secMin: {
			// 	required: true,
			// 	number: true,
			// 	range: [75, 100],
			// },
			// secMax: {
			// 	required: true,
			// 	number: true,
			// 	range: [75, 100],
			// 	minMaxCheck: true, // Use the custom validation method
			// },
		},
		messages: {
			secName: {
				required: 'Field is not empty.',
			},
			// secLimit: {
			// 	required: 'This field is required.',
			// 	number: 'Please enter a valid number.',
			// 	range: 'At least 20 up to 30 limits.',
			// },
			// secMin: {
			// 	required: 'Field is not empty.',
			// 	number: 'Please enter a valid number.',
			// 	range: 'Please enter a number between 75 and 100.',
			// },
			// secMax: {
			// 	required: 'Field is not empty.',
			// 	number: 'Please enter a valid number.',
			// 	range: 'Please enter a number between 75 and 100.',
			// 	minMaxCheck: 'Minimum grade cannot be greater than the maximum grade.',
			// },
		},
	});


	$('#sectionForm').submit(function(e){

			e.preventDefault();

		let valid = $('#sectionForm').valid();

		if(valid === true){
			let formId = document.getElementById('sectionForm');
			const formData = new FormData(formId);
			const data={};

			for(let pair of formData.entries()){
				data[pair[0]] = pair[1];
			}

			if(localStorage.getItem('modify') === 'true'){
				httpJSONReq('modifySection', data, (res) => {
					if (res.success) {
						localStorage.removeItem('modify');
						location.href = '?page=dashboard';
						localStorage.setItem('data', JSON.stringify({ id: '#tab3', action: 'add', message: res.message }));
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Forbidden Request',
							text: res.message,
							footer: null,
						});
					}
				});
			}else{
				httpJSONReq('addSection',data,(res)=>{
						if (res.success) {
						localStorage.removeItem('modify');
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab3', action: 'add', message: res.message }));
				} else {
					Swal.fire({
						icon: 'error',
						title: 'Forbidden Request',
						text: res.message,
						footer: null,
					});
				}	
			});
			}
			
			
		}
		else{
			console.log('form prevented')
		}

	});
})