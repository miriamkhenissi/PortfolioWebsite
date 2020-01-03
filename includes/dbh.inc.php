<?php
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

