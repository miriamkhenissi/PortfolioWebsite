if(document.getElementById("close-main-menu")){

	function __toggleMainMenu(){
		var mainMenu = document.getElementById("main-menu");
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
			var postId = elem.target.getAttribute('id');
			elem.target.parentElement.parentElement.remove()			
		}
	})
})