<?php

class Security {

	public static function filterInput($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	public static function filterOutput($output) {
		return htmlentities($output);
	}

	// 4-15 characters with letters & optional digits
	public static function isValidUsername($username) {
		return preg_match("/^(?=.*[a-z])[0-9a-zA-Z]{4,15}$/", $username);
	}

	public static function isValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	// 8-12 characters with letters & uppercase & digits
	public static function isValidPassword($password) {
		return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,12}$/", $password);
	}
}

?>