<?php

if (!isset($_SESSION)) {
	session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

if (!(isset($_SESSION['user']['username']) && isset($_SESSION['user']['id']))) {
	exit(header('Location: ../index.php?error=forbidden'));
}

$data = [];

$notifs_state = UserModel::getNotificationsState($_SESSION['user']['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	if (!empty($_POST['username'])) {
		$username = Security::filterInput($_POST['username']);
		if (!Security::isValidUsername($username)) {
			$data['invalid_username'] = true;
		} else if (UserModel::isUsernameExists($username)) {
			$data['exists_username'] = true;
		} else {
			UserModel::updateUsername($_SESSION['user']['id'], $username);
			$_SESSION['user']['username'] = $username;
			$data['new_username'] = $username;
			$data['updated_username'] = true;
		}
	}

	if (!empty($_POST['email'])) {
		$email = Security::filterInput($_POST['email']);
		if (!Security::isValidEmail($email)) {
			$data['invalid_email'] = true;
		} else if (UserModel::isEmailExists($email)) {
			$data['exists_email'] = true;
		} else {
			UserModel::updateEmail($_SESSION['user']['id'], $email);
			$data['updated_email'] = true;
		}
	}

	if (!empty($_POST['password'])) {
		$password = Security::filterInput($_POST['password']);
		if (!Security::isValidPassword($password)) {
			$data['invalid_password'] = true;
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
			UserModel::updatePassword($_SESSION['user']['id'], $password);
			$data['updated_password'] = true;
		}
	}

	if (!empty($_POST['switch_notifs'])) {
		UserModel::updateNotifications($_SESSION['user']['id'], 1);
		$data['notifs_enabled'] = true;
	} else {
		UserModel::updateNotifications($_SESSION['user']['id'], 0);
		$data['notifs_enabled'] = false;
	}

	echo json_encode($data);
}

?>