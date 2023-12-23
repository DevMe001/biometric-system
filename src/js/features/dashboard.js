$('.card').on('click', function () {

	let tabIndex = $(this).data('tabindex');

	console.log(tabIndex);

	console.log('are you get or not?');
	location.href = `?page=dashboard`;
	localStorage.setItem('data', JSON.stringify({ id: tabIndex, action: '', message: '' }));
});

const url = new URLSearchParams(window.location.search);

console.log(url.get('msg'));

if (localStorage.getItem('data')) {
	const jsonData = JSON.parse(localStorage.getItem('data'));

	const { id, action, message } = jsonData;

	if (action === 'add') {
		Swal.fire({
			position: 'center',
			icon: 'success',
			title: message,
			showConfirmButton: false,
			timer: 1500,
		});
	}

	if (action === 'update') {
		Swal.fire({
			position: 'center',
			icon: 'success',
			title: message,
			showConfirmButton: false,
			timer: 1500,
		});
	}

	if (action === 'delete') {
		Swal.fire('Deleted!', message, 'success');
	}

	$('#tab0').addClass('hidden');
	// $('#' + id).removeClass('hidden');
	$(id).removeClass('hidden');

	localStorage.removeItem('data');
} else {
	$('#tab0').removeClass('hidden');
}
