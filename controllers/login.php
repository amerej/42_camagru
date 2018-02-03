<?php

if (!isset($_SESSION))
	session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

$account_email = $account_username = '';
$username_error = $password_error = '';
$account_validate = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$username = Security::filterInput($_POST['username']);
	$password = Security::filterInput($_POST['password']);

	// Find user by username
	$user = UserModel::getUserByUsername($username);

	if (!$user) {
		$username_error = 'Username not find';
	} else if (!password_verify($password, $user['password'])) {
		$password_error = 'Password error';
	} else {
		if ($user['isAuthentified'] == 0) {
			$account_email = $user['email'];
			$account_username = $user['username'];

		} else {
			$_SESSION['user']['id'] = $user['idUser'];
			$_SESSION['user']['username'] = $user['username'];
			exit(header('Location: index.php'));
		}
	}
}

if (isset($_GET['email']) && isset($_GET['token'])) {
	$email = Security::filterInput($_GET['email']);
	$token = Security::filterInput($_GET['token']);
	$user_token = UserModel::getUserTokenByEmail($email);
	if ($user['token'] == $user_token) {
		UserModel::updateUserIsAuthentified($email);
		$account_validate = 'Your account is validate... Good job!';
		unset($_SESSION['account']);
		$account_email = $account_username = '';
		echo 	'<script type="text/javascript">',
				'var clean_uri = location.protocol + "//" + location.host + location.pathname;',
				'window.history.replaceState({}, document.title, clean_uri);',
				'</script>';

	} else {
		$account_validate = 'You\'re entering a world of pain!';
	}

}
if (isset($_SESSION['account']['email']) && isset($_SESSION['account']['username'])) {
	$account_email = $_SESSION['account']['email'];
	$account_username = $_SESSION['account']['username'];
}

?>