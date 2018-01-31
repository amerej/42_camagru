<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class PictureModel {
	
	public static function getPictures() {
		try {
			$db = DB::getInstance();
			$db->exec('use mydb');
			$statement = $db->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username 
				FROM mydb.Pictures p
				INNER JOIN Users u
				ON p.idUser = u.idUser
				ORDER BY p.dateCreation DESC");
			
			$statement->execute();
			
			return $statement->fetchAll();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getPicture($id) {
		try {
			$db = DB::getInstance();
			$db->exec('use mydb');
			$statement = $db->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username 
            	FROM Pictures p
            	INNER JOIN Users u
            	ON p.idUser = u.idUser
            	WHERE p.idPicture = $id");
			
			$statement->execute();
			
			return $statement->fetchAll();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getPicturesByUser($id) {
		try {
			$db = DB::getInstance();
			$db->exec('use mydb');
			$statement = $db->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username 
				FROM Pictures p
				INNER JOIN Users u
				ON p.idUser = u.idUser
				WHERE p.idUser = $id
				ORDER BY p.dateCreation DESC");
			
			$statement->execute();
			
			return $statement->fetchAll();
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function postPicture($id_user, $filename) {
		try {
			$db = DB::getInstance();
			$db->exec('use mydb');
			$statement = $db->prepare
			("	INSERT INTO `Pictures` (`idPicture`, `idUser`, `dateCreation`, `filename`) 
				VALUES (NULL, :idUser, NOW(), :filename)");

			$statement->bindParam(':idUser', $id_user);
			$statement->bindParam(':filename', $filename);
			$statement->execute();
		}
		catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}

?>