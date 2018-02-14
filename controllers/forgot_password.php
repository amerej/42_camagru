<?php

if (!isset($_SESSION))
	session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

$email_error = '';
$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	if (empty($_POST['email'])) {
		$data['invalid_email'] = true;
	} else {
		$email = Security::filterInput($_POST['email']);
		$user = UserModel::getUserByEmail($email);
		$data['email_sent'] = true;
		$data['email_account'] = $email;
		if (!$user) {
			$data['notfound_email'] = true;
		}
	}

	if ($data['email_sent']) {
		$token = UserModel::getUserTokenByEmail($email);
		$subject = "Camagru renew password";
		$message = "	<html>
							<head>
								<title>Renew password</title>
							</head>
							<body>
								<p><a href=\"http://localhost:8080/camagru/renew_password.php?email=$email&token=$token\">Renew password</a></p>
							</body>
						</html>
					";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail($email, $subject, $message, $headers);
	}

	echo json_encode($data);
}

?>