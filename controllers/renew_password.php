<?php

if (!isset($_SESSION)) {
	session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

if (!(isset($_GET['email']) && isset($_GET['token']))) {
	exit(header('Location: index.php?error=notfound'));
}

$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (!empty($_POST['password'])) {
		$password = Security::filterInput($_POST['password']);
		$token = Security::filterInput($_GET['token']);
		if (!Security::isValidPassword($password)) {
			$data['invalid_password'] = true;
		} else {
			$user_token = UserModel::getUserTokenByEmail($email);
			if ($user_token == $token) {
				$email = Security::filterInput($_GET['email']);
				$password = password_hash($password, PASSWORD_DEFAULT);
				UserModel::updatePasswordEmail($email, $password);
				$data['updated_password'] = true;

			} else {
				$data['bad_token'] = true;
			}
			echo 	'<script type="text/javascript">',
					'var clean_uri = location.protocol + "//" + location.host + location.pathname;',
					'window.history.replaceState({}, document.title, clean_uri);',
					'</script>';
		}
	}
	echo json_encode($data);
}

?>