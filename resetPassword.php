<?php

require 'functions.php';
	if (isset($_GET['email']) && isset($_GET['token'])) {
		$conn = new mysqli('localhost', 'usr', 'pwd', 'drive_time');

		$email = $conn->real_escape_string($_GET['email']);
		$token = $conn->real_escape_string($_GET['token']);

		$sql = $conn->query("SELECT id FROM drivers WHERE
			email='$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()
		");

		if ($sql->num_rows > 0 ) {
			$newPassword = generateNewString();
			$newPasswordEncrypted = password_hash($newPassword, PASSWORD_DEFAULT);
			$conn->query("UPDATE drivers SET token='', password = '$newPasswordEncrypted'
				WHERE email='$email'");

		echo "<h1>Your New Password Is $newPassword <br><a href='login.php'></br> Click Here To Log In</a></h1>";

		} else
		redirectToLoginPage();
	} else {
		redirectToLoginPage();
	}
  
?>
