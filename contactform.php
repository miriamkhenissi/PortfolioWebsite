<?php

if (isset($_POST['submit'])) {
	require_once "./includes/Mail.php";


	$to = '<miriamkhenissi@gmail.com>';
	$name = $_POST['name'];
	$subject = $_POST['subject'];
	$mailFrom = $_POST['mail'];
	$message = $_POST['txtMsg'];
	$body = "You have received an email from $name ($mailFrom).\n\n".$message;


	$headers = [
		'From' => $mailFrom,
		'To' => $to,
		'Subject' => $subject
	];

	$smtp = Mail::factory('smtp',[
		'host' => 'ssl://smtp.gmail.com',
		'port' => 465,
		'auth' => true,
		'username' => 'mkh007c00@gmail.com',
		'password' => 'boy@007C00'
	]);

	$mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
      echo("<p>" . $mail->getMessage() . "</p>");
    } else {
      echo("<p>Message successfully sent!</p>");
    }

	header("Location: contact.php?mailsend");
}

