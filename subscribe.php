<?php require('header.php'); ?>

	<?php
		$message = "Something went wrong please try again later. 😱";
		if(isset($_POST['email']) && !empty($_POST['email'])) {

			$email = $_POST['email'];
			$error = false;
			//Check if email is valid.
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = 'Invalid email address! 😒';
			}

			//Check if email exists at the database.
			$result = $conn->query("SELECT * FROM subscribers WHERE email = '$email'");
			if(mysqli_num_rows($result)) {
				$error = "The email address $email already subscribed! 🙄";
			}else {//Insert email into the database.
				$result = $conn->query("INSERT INTO `subscribers` (`email`) VALUES ('$email');");
				if($result){
					$message = "Your email $email been added to our subscribers list 🙌";
				}
			}

			if($error){//Display error, template.
				$message = $error;
			}

		}
	?>

	<div class="container">
		<div class="subscription-notification">
			<div>
				<h1><?= $message ?></h1>
				<div><a href="index.php">Go back to home page</a></div>
			</div>
		</div>
	</div>
<?php require('footer.php'); ?>