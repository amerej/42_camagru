<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (!empty($_POST['password'])) {
		$password = Security::filterInput($_POST['password']);
		if (!Security::isValidPassword($password)) {
			$data['invalid_password'] = true;
		} else {
			if (!(empty($_POST['email']) && empty($_POST['token']))) {
				$token = Security::filterInput($_POST['token']);
				$email = Security::filterInput($_POST['email']);
				$user_token = UserModel::getUserTokenByEmail($email);
				if ($user_token == $token) {
					$password = password_hash($password, PASSWORD_DEFAULT);
					UserModel::updatePasswordEmail($email, $password);
					$data['updated_password'] = true;
				} else {
					$data['bad_token'] = true;
				}
			}
		}
	}
	echo json_encode($data);
}

?>