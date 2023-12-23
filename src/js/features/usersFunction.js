const usersable = '.users-table';
const usersNoTesult = 'usersNoResult';

// menu
const usersMenu = '#usersDropdownMenu';
const usersDropdownBtn = '#usersDropdownBtn';

// filter
const usersSearchId = 'usersSearchEl';
const userToggle = '#onModalusersToggle';

// search

const usersPrint = 'usersPrint';
const usersPageArea = '.users-printable';

// getMenu(usersMenu, usersable);
showPage(usersable, usersNoTesult);
// tableSorting(usersMenu, usersable, usersNoTesult);

let usersSearchEl = document.getElementById(usersSearchId);

usersSearchEl.addEventListener('keyup', (e) => {
	let searchValue = e.target.value.toLowerCase();

	console.log(searchValue, 'get value');

	filterTable(usersable, usersNoTesult, searchValue);
});

$('#' + usersPrint).on('click', (e) => {
	$('.custom-table').addClass('hidden');
	$(usersPageArea).removeClass('hidden');

	$(usersPageArea).print({
		addGlobalStyles: true,
		stylesheet: null,
		rejectWindow: true,
		noPrintSelector: '.no-print',
		iframe: true,
		append: null,
		prepend: null,
		deferred: $.Deferred().done(function () {
			$('.custom-table').removeClass('hidden');
			$(usersPageArea).addClass('hidden');
		}),
	});
});

$('#usersCloseModal').on('click', function () {
	localStorage.removeItem('modify');
	$('#usersForm')[0].reset();
	$('#userTitle').text('Create account');
	$('#submitUserCredentials').text('Create');
});

function editUser(data) {
	modal = 'edit';

	console.log(data, 'get data');
	$('#credential_id').val(data.id);
	$('#userTitle').text('Update');
	$('#submitUserCredentials').text('Update');
	$('#usernameAccount').val(data.username);
	$('#editPassLabel').text('Type new password');
  $('#roleAccount').val(data.role);

	localStorage.setItem('modify',JSON.stringify(true));
	// $('#yrName').val(data.name);
	// $('#type').val(data.type);
	// $('#yrId').val(data.id);

	// $('[id*="-error"]').hide();
	$(userToggle).click();

	// $('#yrId').attr('data-editable', true);
	// $('#yrTitle').text('Update');
	// $('#yrBtn').text('Update');
}

function deleteUser(data) {
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
			const getData = {
				credential_id: data.id,
			};

			httpJSONReq('deleteUserCredentials', getData, (res) => {
				if (res.success) {
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab3', action: 'delete', message: 'Account has been deleted' }));
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


$(document).ready(function(){

	$.validator.addMethod('password_restrict', function (value) {
		const reg = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
		return reg.test(value);
	});


  $('#usersForm').validate({
		rules: {
			userNameAccount: {
				required: true,
			},
			passwordAccount: {
				required: function (element) {
					return !localStorage.getItem('modify');
				},
				password_restrict: true,
			},
			roleAccount: {
				required: true,
			},
		},
		messages: {
			userNameAccount: {
				required: 'Field is not empty',
			},
			passwordAccount: {
				required: 'Field is not empty',
				password_restrict: 'Password must be (1 uppercase, 1 number, 1 special character, 8 character limit.',
			},
			roleAccount: {
				required: 'Field is not empty',
			},
		},
	});



  $('#usersForm').submit(function(e){
    e.preventDefault();
    
    let valid = $('#usersForm').valid()
    let form = document.getElementById('usersForm');

    if(valid === true){
        let formData = new FormData(form);
				let data = {};

				for (let pair of formData.entries()) {
					data[pair[0]] = pair[1];
				}


		if (localStorage.getItem('modify') === 'true') {
			httpJSONReq('modifyUserCredentials', data, (res) => {
				if (res.success) {
						localStorage.removeItem('modify');
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab8', action: 'update', message: res.message }));
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
		else{

			httpJSONReq('addUserCredentials', data, (res) => {
				if (res.success) {
						localStorage.removeItem('modify');
					location.href = '?page=dashboard';
					localStorage.setItem('data', JSON.stringify({ id: '#tab8', action: 'add', message: res.message }));
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
      console.log('forbidden response')
    }



  });


})