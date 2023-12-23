$('#getSchoolYear').submit(function(e){

  e.preventDefault();
  

	const form = document.getElementById('getSchoolYear');

	const formData = new FormData(form);
  
    let data={};

    for(let pair of formData.entries()){
      data[pair[0]] = pair[1];
    }


    httpJSONReq('updateSchoolYear',data,(res)=>{
     
      	if (res.success === true) {
					location.href = `?page=dashboard`;
					localStorage.setItem('data', JSON.stringify({ id: '#tab7', action: 'add', message: res.message }));
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