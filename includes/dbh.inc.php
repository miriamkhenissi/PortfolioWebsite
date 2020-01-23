<?php

//DEFINE ADMIN SESSION KEYS
define('ADMIN_SESSION_NAME', '__admin-session');
define('SITE_URL', 'http://localhost:8888/PortfolioWebsite/');
define('ADMIN_SITE_URL', 'http://localhost:8888/PortfolioWebsite/admin/');


//database info
$servername = "localhost";
$dBUser = "root";
$dBPassword = "root";
$dBName = "login-system";

//Connect to database
$conn = mysqli_connect($servername, $dBUser, $dBPassword, $dBName);

if(!$conn){
    //display error msg
    die("Connection Failed:" .mysqli_connect_error()); 
}



if(isset($_GET['install']) && $_GET['install'] === 'true') {
	//Create database table users.
	$sql = 'CREATE TABLE users ( ';
	$sql.= 'idUsers int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ';
	$sql.= 'uidUsers varchar(11) NOT NULL, ';
	$sql.= 'emailUsers tinytext NOT NULL, ';
	$sql.= 'pwdUsers longtext ';
	$sql.= 'role tinytext NULL DEFAULT NULL';
	$sql.= ') ENGINE=InnoDB DEFAULT CHARSET=latin1; ';
	mysqli_query($conn, $sql);

	//Create database tables gallery.
	$sql = 'CREATE TABLE gallery ( ';
	$sql.= 'idGallery int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ';
	$sql.= 'titleGallery longtext NOT NULL, ';
	$sql.= 'descGallery longtext NOT NULL, ';
	$sql.= 'imgFullNameGallery longtext NOT NULL, ';
	$sql.= 'orderGallery longtext NOT NULL, ';
	$sql.= 'userGallery int(11) NOT NULL ';
	$sql.= ') ENGINE=InnoDB DEFAULT CHARSET=latin1; ';

	mysqli_query($conn, $sql);

	//Create meta database table.
	$sql = 'CREATE TABLE meta ( ';
	$sql.= 'id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ';
	$sql.= 'picture_id int(11) NOT NULL, ';
	$sql.= 'meta_key longtext, ';
	$sql.= 'meta_value longtext ';
	$sql.= ') ENGINE=InnoDB DEFAULT CHARSET=utf8; ';

	mysqli_query($conn, $sql);

	//Create meta database table.
	$sql = 'CREATE TABLE subscribers ( ';
	$sql.= 'id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ';
	$sql.= 'email longtext ';
	$sql.= ') ENGINE=InnoDB DEFAULT CHARSET=utf8; ';

	mysqli_query($conn, $sql);
}

/*
*This function will return the value of a meta key based on the provided key and the ID.
*/
function get_meta($id,$key) {
	global $conn;
	$sql = "SELECT * FROM meta WHERE meta_key = '$key' AND picture_id = $id";
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)){
		$result = mysqli_fetch_assoc($query);
		if(isset($result['meta_value']) && !empty($result['meta_value'])){
			return $result['meta_value'];
		}
	}

	return false;
}


/*
*This function takes an ID and a key along with a value, 
*it checks if the key based on the ID, if it exists it will 
*update the value, otherwise it will create a row with the provided data
*/
function update_meta($id,$key,$value) {

	global $conn;

	$sql = "SELECT * FROM meta WHERE meta_key = '$key' AND picture_id = $id";
	$query = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($query)){//If there is a row then just update the data.
		$sql = "UPDATE `meta` SET `meta_value` = '$value' WHERE `picture_id` = $id AND `meta_key` = '$key'";
		$query = mysqli_query($conn, $sql);
		return $query;
	}else {//Insert the meta data into the database table.
		$sql = "INSERT INTO `meta` (`picture_id`, `meta_key`, `meta_value`) VALUES ('$id', '$key', '$value');";
		$query = mysqli_query($conn, $sql);
		return $query;
	}
}

/*
*This function will allow you to delete a meta key (the row) from the database 
*by providing a pictrue id and a key.
*/
function delete_meta($id,$key) {

	global $conn;

	$sql = "DELETE FROM `meta` WHERE `picture_id` = $id AND `meta_key` = '$key'";
	$query = mysqli_query($conn, $sql);
	return $query;	
	
}

function get_current_url(){
	return $currenturl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	
}


function add_url_var($url, $key, $value) {	
	$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
	$url = substr($url, 0, -1);
	
	if (strpos($url, '?') === false) {
		return ($url .'?'. $key .'='. $value);
	} else {
		return ($url .'&'. $key .'='. $value);
	}
}

function remove_url_var($url, $key) {
	$url = preg_replace('/(.*)(?|&)'. $key .'=[^&]+?(&)(.*)/i', '$1$2$4', $url .'&');
	$url = substr($url, 0, -1);
	return ($url);
}

function is_admin_loggedin(){
	session_start();
	return isset($_SESSION[ADMIN_SESSION_NAME]) && 
		   isset($_SESSION[ADMIN_SESSION_NAME]['current_user']) &&
		   !empty($_SESSION[ADMIN_SESSION_NAME]['current_user']) ? true : false;
}

function add_post_action($name, $callback){
	if(isset($_POST[$name])){
		$callback();
	}
}


add_post_action('__admin_login',function(){

	//Check if a username and a password been provided.
	$username = false;
	$password = false;
	$errors = [];

	if(isset($_POST['username']) && !empty($_POST['username']))
		$username = $_POST['username'];

	if(isset($_POST['password']) && !empty($_POST['password']))
		$password = $_POST['password'];


	if(!$username || !$password) 
		array_push($errors, 'Error username or password');

	if($errors)
		return $GLOBALS['__temporary-errors'] = $errors;

	//If no error at all process to check if the user exists.
	global $conn;
	$sql = "SELECT * FROM users WHERE uidUsers = '$username' OR emailUsers = '$username' ";
	$query = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($query);

	//If the result is empty then ther is no user, or the fetched result doesn't have an admin role...
	if(empty($result) || 'admin' !== $result['role'])
		array_push($errors, "Email or username doesn't exist.");

	//Check if the password matches
	if(!password_verify($password,$result['pwdUsers'])) 
		array_push($errors, "Error username or password.");	

	if($errors)
		return $GLOBALS['__temporary-errors'] = $errors;

	//If everything went fine save the user session.
	session_start();
	unset($result['pwdUsers']);
	$_SESSION[ADMIN_SESSION_NAME]['current_user'] = $result;

	header("Location: ../admin/?page=dashboard");
});


add_post_action('_removepostaction',function(){

	global $conn;

	header('Access-Control-Allow-Origin: *');
	header("Content-type: application/json; charset=utf-8");

	//This only for admin.
	if(!is_admin_loggedin()) die(json_encode(['status'=> false, 'error'=> 'Something went wrong please try again later.']));

	//If this is an admin then process the request.
	$postID = isset($_POST['postID']) && !empty($_POST['postID']) ? intval($_POST['postID']) : false;


	//Delete post from gallery database.
	$sql = "DELETE FROM gallery WHERE idGallery = $postID ";
	$query = mysqli_query($conn, $sql);

	$response = [
		'status' => $query,
		'post_id' => $postID,
	];

	//Delete all meta data related to this post.
	$sql = "DELETE FROM meta WHERE picture_id = $postID ";
	$query = mysqli_query($conn, $sql);	

	die(json_encode($response));//Kill everything after

});


add_post_action('_updatePost',function(){
	global $conn;

	header('Access-Control-Allow-Origin: *');
	header("Content-type: application/json; charset=utf-8");

	//This only for admin.
	if(!is_admin_loggedin()) die(json_encode(['status'=> false, 'error'=> 'Something went wrong please try again later.']));


	//Check if every field been submitted
	$postID = isset($_POST['post-id']) && !empty($_POST['post-id']) ? $_POST['post-id'] : false;//This is the most important data key at this process without post ID the script won't be able to identify the post.

	if(!$postID) die(json_encode(['status'=> false, 'error'=> 'Something went wrong please try again later.']));

	//If all fine proceed with the rest of the fields.
	$postTitle = isset($_POST['post-title']) && !empty($_POST['post-title']) ? $_POST['post-title'] : false;
	$postDesc = isset($_POST['post-description']) && !empty($_POST['post-description']) ? $_POST['post-description'] : false;
	$postVisibility = isset($_POST['post-visibility']) && !empty($_POST['post-visibility']) ? intval($_POST['post-visibility']) : 0;

	//Update post title description and visibility....
	$sql = "UPDATE `gallery` SET `titleGallery` = '$postTitle', `descGallery` = '$postDesc'  WHERE `idGallery` = $postID ";
	$query = mysqli_query($conn, $sql);

	//Update the post meta...
	update_meta($postID,'visibility',$postVisibility);
	sleep(3); //simulate a real usage scenario (low data provider)

	//Check if the post have changes related to the picture...
	//If the value of post-image is empty it means there is a possible change to the image file...
	if(isset($_POST['post-image']) && !empty($_POST['post-image'])){
		die(json_encode(['status'=> true]));//Kill everything after
	}else {//This means the admin removed the current image and maybe uploaded an image to replace the current one with...

		//If there is no file at all submitted then completely ignore the request and 
		//concider it as a mistake from the admin, Keep the image as is...
		if(!isset($_FILES['post-file']['tmp_name']) || empty($_FILES['post-file']['tmp_name'])) die(json_encode(['status'=> true]));//Kill everything after

		//Check if there is a file...
		if(isset($_FILES['post-file'])) {//If there is a field called post-filed then admin have filled the image field...
			//Check if enough data been provided such as type, size....
			$name =  isset($_FILES['post-file']['name']) ? $_FILES['post-file']['name'] : false;
			$type =  isset($_FILES['post-file']['type']) ? $_FILES['post-file']['type'] : false;
			$location = isset($_FILES['post-file']['tmp_name']) ? $_FILES['post-file']['tmp_name'] : false;
			$size = isset($_FILES['post-file']['size']) ? $_FILES['post-file']['size'] : false;


			$allowedTypes = ['image/jpeg','image/jpg','image/png'];

			//If the type isn't allowed then kill the script.
			if(!in_array($type, $allowedTypes)) die(json_encode(['status'=> false, 'error' => 'Unsupported file format...', 'file' => $_FILES]));
			//If there is no file location then kill the script.
			if(!$location) die(json_encode(['status'=> false, 'error' => 'Something is wrong with the provided file...']));
			//If some how the file doesn't have a name... rare case...
			if(!$name) die(json_encode(['status'=> false, 'error' => 'Something is wrong with the provided file...']));
			//If the size is above the limit then kill the script.
			if($size > 2000000) die(json_encode(['status'=> false, 'error' => 'Only 2MB file size is allowed.']));

			//If all conditions been met then process with moving the file and giving it a name.
			$extensionName = strtolower(pathinfo("$name", PATHINFO_EXTENSION)); //Never user the predefined function explode to separate the dot from the name somefiles can be tricky so use the PHP path info instead...
			$newFileName = join('.',[uniqid().'-'.uniqid().'-'.uniqid(),$extensionName]); // this will contain a long file name and infinitly unique...

			$fileDestination = "../img/gallery/" . $newFileName;

			sleep(3); //simulate a real usage scenario (low data provider)

			if(!move_uploaded_file($location, $fileDestination)) die(json_encode(['status'=> false, 'error' => 'Something is wrong with the provided file...']));

			//If the file moved and all is fine then update column image at the table row...
			$sql = "UPDATE `gallery` SET `imgFullNameGallery` = '$newFileName'  WHERE `idGallery` = $postID ";
			$query = mysqli_query($conn, $sql);

			die(json_encode(['status'=> true, 'filename' => $newFileName]));//Kill everything after

		}

		die(json_encode($_FILES['post-file']));//Kill everything after
	}

});



// // session_start();
// // session_unset();
// // session_destroy();


