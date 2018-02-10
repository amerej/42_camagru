<?php

if (!isset($_SESSION))
	session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';


$username = $email = $password = '';
$username_error = $email_error = $password_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (empty($_POST['username'])) {
		$username_error = 'Username is required';
	} else {
		$username = Security::filterInput($_POST['username']);
		if (!Security::isValidUsername($username)) {
			$username_error = '4-15 characters with letters and optional digits';
		} else if (UserModel::isUsernameExists($username)) {
			$username_error = 'Username already exists';
		}
	}

	if (empty($_POST['email'])) {
		$email_error = "Email is required";
	} else {
		$email = Security::filterInput($_POST['email']);
		if (!Security::isValidEmail($email)) {
			$email_error = 'Invalid email format';
		} else if (UserModel::isEmailExists($email)) {
			$email_error = 'Email already exists';
		}
	}

	if (empty($_POST['password'])) {
		$password_error = 'Password is required';
	} else {
		$password = Security::filterInput($_POST['password']);
		if (!Security::isValidPassword($password)) {
			$password_error = "Invalid password format";
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
		}
	}

	if (empty($username_error) && empty($email_error) && empty($password_error)) {
		$token = bin2hex(random_bytes(32));
		UserModel::postUser($username, $email, $password, $token);
		
		// Send confirmation mail
		$subject = "Camagru Account Validation";
		$message = "	<html>
							<head>
								<title>Confirmation Camagru</title>
							</head>
							<body>
								<p><a href=\"http://localhost:8080/camagru/login.php?email=$email&token=$token\">Confirm Inscription</a></p>
							</body>
						</html>
					";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail($email, $subject, $message, $headers);
		
		$_SESSION['account']['email'] = $email;
		$_SESSION['account']['username'] = $username;
		exit(header('Location: login.php'));
	}
}

?>
