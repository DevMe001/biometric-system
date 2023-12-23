
// !!!!!!!!!!!!!!MODAL !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!








// END MODAL






// !!!!!!!!!!!!!!!!!!!!!! TABLE  ////////////////////////////



  // want to create li loop through the th
function getMenu(dropdown,table) {
	let thead = document.querySelectorAll(`${table} thead tr th`);
	let menuItem = document.querySelector(`${dropdown} ul`);

	thead.forEach((th, index) => {
		let indexLast = thead.length - 2;

		if (index < indexLast) {
			menuItem.innerHTML += `<li class='p-2 hover:bg-gray-100 cursor-pointer' data-index='${index}'>${th.innerText}</li>`;
		}
	});
}



	function sortRecent(table){
			let index = e.target.dataset.index;
			let tbody = document.querySelector(`${table} tbody`);
			let tbodyRow = tbody.querySelectorAll('tr:not(#' + noResult + ')');
			let trArray = Array.from(tbodyRow);


				trArray.sort((a, b) => {
					let tdA = a.querySelectorAll('td')[index].innerText;
					let tdB = b.querySelectorAll('td')[index].innerText;

					if (tdA < tdB) {
						return -1;
					} else if (tdA > tdB) {
						return 1;
					} else {
						return 0;
					}
				});




	}


// !!!!!!!!!!!!!!!!!!!!!! sorting!!!!!!!!!!!!!!!!!!!!!! 
function tableSorting(dropdown,table, noResult) {
	// menuitem
	let menuItems = document.querySelectorAll(`${dropdown} ul li`);
	let menuItemsArray = Array.from(menuItems);

	menuItemsArray.forEach((item) => {
		item.addEventListener('click', (e) => {
			let index = e.target.dataset.index;
			let tbody = document.querySelector(`${table} tbody`);
			let tbodyRow = tbody.querySelectorAll('tr:not(#' + noResult + ')');
			let tbodyRowArray = Array.from(tbodyRow);

			tbodyRowArray.sort((a, b) => {
				let tdA = a.querySelectorAll('td')[1].innerText;
				let tdB = b.querySelectorAll('td')[1].innerText;

				if (tdA < tdB) {
					return -1;
				} else if (tdA > tdB) {
					return 1;
				} else {
					return 0;
				}
			});

			tbodyRowArray.forEach((item) => {
				tbody.appendChild(item);
			});
		});
	});
}



// !!!!!!!!!!!!!!!!!!!!!! search !!!!!!!!!!!!!!!!!!!!!! 

		
	//inclldes the no result row

	function filterTable(table,noResult, searchValue) {
		let found = false;

			let tbody = document.querySelector(table);
			let tableRow = tbody.querySelectorAll('tbody tr:not(#' + noResult + ')');

			let notFound = document.getElementById(noResult);
	


		if (searchValue !== '') {
			tableRow.forEach((row, index) => {
				let rowText = row.innerText.toLowerCase();
				if (rowText.includes(searchValue)) {
					row.style.display = '';
					found = true;
				} else {
					row.style.display = 'none';
				}
			});

			if (found) {
				notFound.classList.add('hidden');
			} else {
				notFound.classList.remove('hidden');
			}
		} else {
			showPage(table);
		}
	}


// end search filter
// create prev and next pagination for table

// prev and next button for tbody tr td list
  // let prev = document.querySelector('.prev');
  // let next = document.querySelector('.next');

// !!!!!!!!!!!!!!!!!!!!!! previous !!!!!!!!!!!!!!!!!!!!!! 

	  var current = 1;
		var row = 5;

 function prevBtn(table) {
			current--;
			if (current < 1) {
				current = 1;
			}
		showPage(table);
 }

// !!!!!!!!!!!!!!!!!!!!!! next !!!!!!!!!!!!!!!!!!!!!! 

function nextBtn(table, noResult) {
	const tbody = document.querySelector(`${table} tbody`);
	const tbodyRow = tbody.querySelectorAll('tbody tr:not(#' + noResult + ')');
	const tbodyRowArray = Array.from(tbodyRow);

	let pages = Math.ceil(tbodyRowArray.length / row);

	current++;
	if (current > pages) {
		current = pages;
	}
	showPage(table);
}

// end next button



// pages by row limit

  function showPage(table, noResult) {
		const tbody = document.querySelector(`${table} tbody`);

		const tbodyRow = tbody.querySelectorAll('tbody tr:not(#' + noResult + ')');

		const tbodyRowArray = Array.from(tbodyRow);
		let notFound = document.getElementById(noResult);


		console.log(notFound,'not found')

		let found = false;
		tbodyRowArray.forEach((item, index) => {
			if (index >= current * row - row && index < current * row) {
				item.style.display = '';
				found = true;
			} else {
				item.style.display = 'none';
			}
		});

		if (found) {
			notFound.classList.add('hidden');
		} else {
			notFound.classList.remove('hidden');
		}
	}




// end pagination




// !!!!!!!!!!!!!!! PRINT ////////////////////////////

  // print




// END TABLE