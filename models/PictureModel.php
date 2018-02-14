<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class PictureModel {
	
	public static function getPictures($limit=20, $offset=0) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username FROM mydb.Pictures p
				INNER JOIN Users u ON p.idUser = u.idUser
				ORDER BY p.dateCreation DESC
				LIMIT $limit OFFSET $offset
			");
			$statement->execute();
			return $statement->fetchAll();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function getPicture($picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username  FROM Pictures p
				INNER JOIN Users u ON p.idUser = u.idUser
				WHERE p.idPicture = :idPicture
			");
			$statement->bindParam(':idPicture', $picture_id);
			$statement->execute();
			return $statement->fetch(PDO::FETCH_ASSOC);

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function deletePicture($user_id, $picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	DELETE FROM Pictures
				WHERE idPicture = :idPicture AND idUser = :idUser
			");
			$statement->bindParam('idPicture', $picture_id);
			$statement->bindParam('idUser', $user_id);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getPicturesByUser($id) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT p.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username 
				FROM Pictures p
				INNER JOIN Users u ON p.idUser = u.idUser
				WHERE p.idUser = $id
				ORDER BY p.dateCreation DESC
			");
			$statement->execute();
			return $statement->fetchAll();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function getEmailByPicture($picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT u.email
				FROM Pictures p
				INNER JOIN Users u ON p.idUser = u.idUser
				WHERE p.idPicture = $picture_id
			");
			$statement->bindParam(':idPicture', $picture_id);
			$statement->execute();
			return $statement->fetchColumn();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function postPicture($id_user, $filename) {
		try {
			$statement = DB::getInstance()->prepare(
			"	INSERT INTO `Pictures` (`idPicture`, `idUser`, `dateCreation`, `filename`) 
				VALUES (NULL, :idUser, NOW(), :filename)
			");
			$statement->bindParam(':idUser', $id_user);
			$statement->bindParam(':filename', $filename);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}

?>