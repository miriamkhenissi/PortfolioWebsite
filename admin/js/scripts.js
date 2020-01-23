const AJAXURL = "index.php";
const XMLHTTP_parsedata = (data = null) => {
	//Parse any paramater
	if(!data) return false;

	if(typeof data !== 'object') return false;

	var dataFields = [];

	Object.keys(data).map(i => {
		dataFields.push(`${i}=${encodeURIComponent(data[i])}`);
	});

	if(dataFields) return dataFields.join("&");

	return false;	
}

const imageReader = new FileReader();

if(document.getElementById("close-main-menu")){

	function __toggleMainMenu(){
		const mainMenu = document.getElementById("main-menu");
		if(mainMenu.classList.contains('active')){
			return mainMenu.classList.remove('active')
		}

		return mainMenu.classList.add('active');		
	}

	document.getElementById("close-main-menu").addEventListener('click',()=>{
		if(document.getElementById("main-menu")){
			__toggleMainMenu();
		}
	});

	document.getElementById("open-main-menu").addEventListener('click',()=>{
		if(document.getElementById("main-menu")){
			__toggleMainMenu();
		}
	});

}


document.querySelectorAll('.dashboard-page .edit-btn').forEach( element => {
	element.addEventListener('click', elem => {
		elem.preventDefault();
		const id = elem.target.getAttribute('id');
		//Remove any other active class from anyother edit-form
		document.querySelectorAll('.dashboard-page .table-content .edit-form').forEach( row => row.classList.remove('active'))
		document.getElementById(`edit-form-${id}`).classList.add('active');
	});
});


document.querySelectorAll('.dashboard-page .close-edit-form').forEach( element => {
	element.addEventListener('click', elem => {
		elem.preventDefault();
		const id = elem.target.getAttribute('href');
		//Remove any other active class from anyother edit-form
		document.getElementById(`edit-form-${id}`).classList.remove('active');
	});
});


document.querySelectorAll('.dashboard-page .remove-btn').forEach( element => {
	element.addEventListener('click', elem => {
		elem.preventDefault();
		if(confirm("Are you sure you want to remove this post?")){
			const postId = elem.target.getAttribute('id');
			elem.target.parentElement.parentElement.remove();
			document.getElementById(`edit-form-${postId}`).remove();

			const XMLHTTP = new XMLHttpRequest();
			XMLHTTP.open("POST", AJAXURL);
			XMLHTTP.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			XMLHTTP.send(XMLHTTP_parsedata({
					_removepostaction: 1,
					postID: postId,
			}));

			XMLHTTP.onreadystatechange = response => {

				if( XMLHTTP.readyState === 4 && XMLHTTP.status === 200 ){
					try {
						const response = JSON.parse(XMLHTTP.responseText);
						if(!response.status){
							alert(response.error)
						}
					}catch(e) {
						console.warn(e);
					}
				}

			}

		}
	})
});


const removePictureForm =  elem => {
	elem.preventDefault();
	const selectedElement = elem;
	selectedElement.target.parentElement.parentElement.parentElement.parentElement.querySelector('.post-image').value = ""; //Remove the file name from the hidden input to indicate that the image file been changed.
	selectedElement.target.parentElement.parentElement.parentElement.parentElement.querySelector('.upload-image input[type="file"]').value = ""; // Reset the file input what so ever to keep the dom area clean.
	selectedElement.target.parentElement.parentElement.parentElement.querySelector('.upload-image').classList.add('active');
	selectedElement.target.parentElement.parentElement.remove();
}


document.querySelectorAll('.picture .remove-picture button').forEach( element => {
	element.addEventListener('click', elem => {
		return removePictureForm(elem)
	});
});


document.querySelectorAll('.edit-form .upload-image input[type=file]').forEach( element => {
	element.addEventListener('change', elem => {
		const selectedElement = elem;
		if(typeof selectedElement.target.files !== undefined && typeof selectedElement.target.files[0] !== undefined){
			//Check if the image type is allowed.
			const file = selectedElement.target.files[0];
			const allowedTypes = ['image/jpeg','image/jpg','image/png'];
			let errors = [];

			if(file === undefined || file.type === undefined) return false;

			if(!allowedTypes.includes(file.type)) {
				errors.push('Only JPG or PNG allowed');
			}

			if(file.size > 2000000) {
				errors.push('Only 2MB files allowed');
			}

			if(errors.length){
				//Return the errors and kill the script..
				return alert(errors.join("\n\n"));
			}

			if(!errors.length) {
				imageReader.readAsDataURL(file);
				imageReader.onload = res => {

					const image = res.target.result;
					selectedElement.target.parentElement.classList.remove('active');

					let _pictureWrapper = document.createElement("div");				
					_pictureWrapper.classList.add('picture');
					_pictureWrapper.style.backgroundImage = `url(${image})`;

					let _deleteButtonWrap = document.createElement("div");
					_deleteButtonWrap.classList.add('remove-picture');

					let _deleteButton = document.createElement("button");
					_deleteButton.classList.add('btn');
					_deleteButton.classList.add('btn-danger');
					_deleteButton.classList.add('btn-sm');
					_deleteButton.innerHTML = `<svg fill="#FFF" viewBox="0 0 8 8"><path d="M1.406 0l-1.406 1.406.688.719 1.781 1.781-1.781 1.781-.688.719 1.406 1.406.719-.688 1.781-1.781 1.781 1.781.719.688 1.406-1.406-.688-.719-1.781-1.781 1.781-1.781.688-.719-1.406-1.406-.719.688-1.781 1.781-1.781-1.781-.719-.688z"></path></svg>Remove`;
					_deleteButton.setAttribute('type','button');
					_deleteButton.addEventListener( 'click',  elem => removePictureForm(elem))

					_deleteButtonWrap.appendChild(_deleteButton);
					_pictureWrapper.appendChild(_deleteButtonWrap);
					selectedElement.target.parentElement.parentElement.appendChild(_pictureWrapper);
				}
			}

		}
	});
});


document.querySelectorAll('.edit-form-row form').forEach( element => {
	element.addEventListener('submit', elem => {
		elem.preventDefault();
		const selectedElement = elem;
		selectedElement.target.parentElement.querySelector('.update-spinned').classList.add('visible');
		const formData = new FormData(element);
		formData.append('_updatePost',1);

			const XMLHTTP = new XMLHttpRequest();
			XMLHTTP.open("POST", AJAXURL);
			XMLHTTP.send(formData);

			XMLHTTP.onreadystatechange = response => {

				if( XMLHTTP.readyState === 4 && XMLHTTP.status === 200 ){
					try {
						const response = JSON.parse(XMLHTTP.responseText);
						if(!response.status){
							alert(response.error)
						}

						if(response.filename !== undefined && response.filename) {//The media file been updated then update the post-image field.
							selectedElement.target.parentElement.parentElement.querySelector('.post-image').value = response.filename;
						}

						//Stop the spinned.
						selectedElement.target.parentElement.querySelector('.update-spinned').classList.remove('visible');
					}catch(e) {
						console.warn(e);
					}
				}

			}


	})
});















