<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class UserModel extends DB {

	public static function getUserByUsername($username) {
		try {
			$statement = parent::getInstance()->prepare
			("	SELECT * 
				FROM `Users` 
				WHERE `username` = :username");
			
			$statement->bindParam(':username', $username);
			$statement->execute();
			return $statement->fetch();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getUserByEmail($email) {
		try {
			$statement = parent::getInstance()->prepare
			("	SELECT * 
				FROM `Users` 
				WHERE `email` = :email");
			
			$statement->bindParam(':email', $email);
			$statement->execute();
			return $statement->fetch();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function postUser($username, $email, $password) {
		try {
			$statement = parent::getInstance()->prepare
			("	INSERT INTO `Users` (`idUser`, `username`, `email`, `password`) 
				VALUES (NULL, :username, :email, :password)");
			
			$statement->bindParam(':username', $username);
    		$statement->bindParam(':email', $email);
    		$statement->bindParam(':password', $password);
			$statement->execute();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}
