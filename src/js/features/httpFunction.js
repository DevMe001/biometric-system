function httpJSONReq(action, data, cb) {
	const xhttp = new XMLHttpRequest();

	xhttp.open('POST', `src/function/controller.php?action=${action}`, true);

	xhttp.onreadystatechange = function () {
		if (this.readyState === 4) {
			if (this.status === 200) {
				let response = JSON.parse(this.responseText);
				cb(response);
			} else {
				cb(response);
			}
		}
	};

	let payload = `data=${JSON.stringify(data)}`;
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhttp.send(payload);
}



	function httpResFormData(url, data, cb) {
		const xhttp = new XMLHttpRequest();

		xhttp.open('POST', `src/function/controller.php?action=${url}`, true);

		xhttp.onreadystatechange = function () {
			if (this.readyState === 4) {
				if (this.status === 200) {
					let response = JSON.parse(this.responseText);

					cb(response);
				} else {
					cb(response);
				}
			}
		};

		xhttp.send(data);
	}


	$('.char-allowed').on('keypress', function (event) {
		let keys = event.charCode || event.which;
		let getCharacter = String.fromCharCode(keys);

		let regExChar = /^[a-zA-Z\s]$/;

		if (!regExChar.test(getCharacter)) {
			event.preventDefault();
		} else {
			return true;
		}
	});

	$('.disabled-key').on('keypress', function (e) {
		if (e.charCode === 101) {
			e.preventDefault();
		}
	});

	$('.limitLength').on('input', function () {
		if (this.value.length > this.maxLength) {
			this.value = this.value.slice(0, this.maxLength);
		}
	});


	$(document).ready(function () {
		$('.selectItem2Lib').select2({
			width: 'resolve',
		});

	});

	function getTimeConverter(timeInput) {
		// Get the time input value
		let time = document.getElementById(timeInput).value;

		// Extract hours and minutes
		let timeArray = time.split(':');
		let hours = parseInt(timeArray[0], 10);
		let minutes = parseInt(timeArray[1], 10);

		// Determine whether it's AM or PM
		let period = hours >= 12 ? 'PM' : 'AM';

		// Adjust hours for PM
		if (hours > 12) {
			hours -= 12;
		}

		// Format the result
		let formattedTime = hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ' ' + period;

		return formattedTime;
	}



	function addIndexDb(data) {
		var req = indexedDB.deleteDatabase('view-record');
		req.onsuccess = function () {
			console.log('Deleted database successfully');
		};
		req.onerror = function () {
			console.log("Couldn't delete database");
		};
		req.onblocked = function () {
			console.log("Couldn't delete database due to the operation being blocked");
		};

		const cache = indexedDB.open('view-record', 1);

		cache.onupgradeneeded = () => {
			let res = cache.result;
			res.createObjectStore('data', { autoIncrement: true });
		};

		cache.onsuccess = () => {
			let res = cache.result;

			let transaction = res.transaction('data', 'readwrite');
			let store = transaction.objectStore('data');

			store.put(data);
		};
	}


	function getIndexDb(database, cb) {
		const idb = indexedDB.open(database, 1);

		idb.onsuccess = () => {
			const tx = idb.result.transaction('data', 'readonly');
			const store = tx.objectStore('data');
			const cursor = store.openCursor();

			console.log(cursor);

			cursor.onsuccess = () => {
				const response = cursor.result;

				cb(response);
			};
		};
	}


	function removeIndexDb(database){
		const DBDeleteRequest = window.indexedDB.deleteDatabase(database);

		DBDeleteRequest.onerror = (event) => {
			console.error('Error deleting database.');
		};

		DBDeleteRequest.onsuccess = (event) => {
			console.log('Database deleted successfully');

			console.log(event.result); // should be undefined
		};
	}