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


document.querySelectorAll('.dashboard-page .remove-btn').forEach( element => {
	element.addEventListener('click', elem => {
		elem.preventDefault();
		if(confirm("Are you sure you want to remove this post?")){
			const postId = elem.target.getAttribute('id');
			elem.target.parentElement.parentElement.remove();


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




















