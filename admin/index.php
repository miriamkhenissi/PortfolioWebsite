<?php
/**
 * Admin index template
 * @version 1.0.0
 * @author Miriam Habiba Khenissi
 */
	require_once('../includes/dbh.inc.php');
	//Check if the usser is logged in.
	if(!is_admin_loggedin())
		return require_once('login.php');

	$page = 'dashboard'; //Default template route

	if(isset($_GET['page']) && !empty($_GET['page']))
		$page = $_GET['page'];


	//Check if the page file exists.
	$requested_template = sprintf("%s/routers/%s.php",dirname(__FILE__),$page);

	if(!file_exists($requested_template)){
		$template = '404.php';
	}else {
		$template = $requested_template;
	}

	
?>


<?php require_once("header.php"); ?>
<?php require_once($template); ?>
<?php require_once("footer.php"); ?>