<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class UserModel {

	public static function getUserByUsername($username) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT * FROM Users u 
				WHERE u.username = :username
			");
			$statement->bindParam(':username', $username);
			$statement->execute();
			return $statement->fetch();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getUserByEmail($email) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT * FROM `Users` 
				WHERE `email` = :email
			");
			$statement->bindParam(':email', $email);
			$statement->execute();
			return $statement->fetch();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getNotificationsState($userId) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT u.isNotificationsEnabled FROM Users u 
				WHERE u.idUser = :idUser
			");
			$statement->bindParam(':idUser', $userId);
			$statement->execute();
			return $statement->fetchColumn(0);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function postUser($username, $email, $password, $token) {
		try {
			$statement = DB::getInstance()->prepare
			("	INSERT INTO `Users` (`idUser`, `username`, `email`, `password`, `token`) 
				VALUES (NULL, :username, :email, :password, :token)
			");
			$statement->bindParam(':username', $username);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':password', $password);
			$statement->bindParam(':token', $token);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function isEmailExists($email) {
		$exists = FALSE;
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT u.email FROM `Users` u 
				WHERE u.email = :email
			");
			$statement->bindParam(':email', $email);
			$statement->execute();
			if (!empty($statement->fetch())) {
				$exists = TRUE;
			}
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
		return $exists;
	}

	public static function isUsernameExists($username) {
		$exists = FALSE;
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT u.username FROM `Users` u 
				WHERE u.username = :username
			");
			$statement->bindParam(':username', $username);
			$statement->execute();
			if (!empty($statement->fetch())) {
				$exists = TRUE;
			}
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
		return $exists;
	}

	public static function getUserTokenByEmail($email) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT u.token FROM Users u 
				WHERE u.email = :email
			");
			$statement->bindParam(':email', $email);
			$statement->execute();
			return $statement->fetchColumn(0);

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}


	public static function updateUserIsAuthentified($email) {
		try {
			$statement = DB::getInstance()->prepare
			("	UPDATE Users u 
				SET u.isAuthentified = 1
				WHERE u.email = :email
			");
			$statement->bindParam(':email', $email);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function updateUsername($userId, $newUsername) {
		try {
			$statement = DB::getInstance()->prepare
			("	UPDATE Users u
				SET u.username = :username
				WHERE u.idUser = :idUser
			");
			$statement->bindParam(':username', $newUsername);
			$statement->bindParam(':idUser', $userId);
			$statement->execute();
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function updateEmail($userId, $newEmail) {
		try {
			$statement = DB::getInstance()->prepare
			("	UPDATE Users u
				SET u.email = :email
				WHERE u.idUser = :idUser
			");
			$statement->bindParam(':email', $newEmail);
			$statement->bindParam(':idUser', $userId);
			$statement->execute();
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function updatePassword($userId, $newPassword) {
		try {
			$statement = DB::getInstance()->prepare
			("	UPDATE Users u
				SET u.password = :password
				WHERE u.idUser = :idUser
			");
			$statement->bindParam(':password', $newPassword);
			$statement->bindParam(':idUser', $userId);
			$statement->execute();
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function updateNotifications($userId, $state) {
		try {
			$statement = DB::getInstance()->prepare
			("	UPDATE Users u
				SET u.isNotificationsEnabled = :state
				WHERE u.idUser = :idUser
			");
			$statement->bindParam(':state', $state);
			$statement->bindParam(':idUser', $userId);
			$statement->execute();
		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}
