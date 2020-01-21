<?php 
/**
 * Login template
 * @version 1.0.0
 * @author Miriam Habiba Khenissi
 */

require_once('../includes/dbh.inc.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Maya | Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
	<div class="access-container">
		<div class="inner-access-container">
			<div class="logo">
				<svg width="85px" height="85px" viewBox="0 0 85.04 85.04" xml:space="preserve">
					<rect fill="#FFFFFF" width="85" height="85"></rect>
					<path fill="#000000" d="M77.54,77.54H53.67v-0.69h2.06c2.06,0,3.02-1.8,3.02-3.76V42.13l-9.1,35.41h-6.99l-10.27-35.2v25.88 c0,5.35,2.65,8.63,5.13,8.63h2.01v0.69H24.56v-0.69h1.85c2.43,0,5.24-3.02,5.24-8.68V41.44c0-4.13-2.38-5.61-5.13-5.61h-1.43V35.2 h18.68l8.36,29.59l7.67-29.59h17.52v0.64h-2.17c-3.23,0-4.23,0.74-4.23,2.96v35.04c0,2.01,1.32,3.02,3.02,3.02h3.6V77.54z"></path> </svg>
			</div>
			<form action="#" method="POST" autocomplete="off">
				<?php if(is_admin_loggedin()){ ?>
					<div class="errors">
						<p>You already logged in!</p>
					</div>
				<?php } ?>
				<?php if(isset($GLOBALS['__temporary-errors']) && !empty($GLOBALS['__temporary-errors'])){ ?>
					<div class="errors">
						<?php foreach ($GLOBALS['__temporary-errors'] as $error) { ?>
							<p><?= $error; ?></p>
						<?php } ?>
					</div>
				<?php } ?>

				<input type="hidden" name="__admin_login" />

				<div class="field inverse">
					<label for="access-username">Username</label>
					<input id="access-username" type="text" placeholder="username" name="username">
				</div>
				<div class="field inverse">
					<label for="access-password">Password</label>
					<input id="access-password" type="password" placeholder="password" name="password">
				</div>

				<button class="inverse" type="submit">Login</button>

				<div>
					<a href="#" class="back">« Back to home page</a>
				</div>

			</form>

			<footer>
				<center>
					<small>Copyright <?= date("Y"); ?> mayakh.com</small>
				</center>
			</footer>

		</div>
	</div>
</body>
</html>