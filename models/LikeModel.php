<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class LikeModel {

	public static function getLikes($picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT COUNT(l.idLike)
				FROM Likes l
				WHERE l.idPicture = :idPicture
			");
			$statement->bindParam(':idPicture', $picture_id);
			$statement->execute();
			return $statement->fetchColumn();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function getLike($user_id, $picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT COUNT(l.idLike)
				FROM Likes l
				WHERE l.idUser = :idUser AND l.idPicture = :idPicture
			");
			$statement->bindParam(':idUser', $user_id);
			$statement->bindParam('idPicture', $picture_id);
			$statement->execute();
			return $statement->fetchColumn();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function postLike($user_id, $picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	INSERT INTO `Likes`(`idLike`, `idUser`, `idPicture`) 
				VALUES (NULL, :idUser, :idPicture)
			");
			$statement->bindParam(':idUser', $user_id);
			$statement->bindParam(':idPicture', $picture_id);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function deleteLike($user_id, $picture_id) {
		try {
			$statement = DB::getInstance()->prepare
			("	DELETE FROM Likes
				WHERE idUser = :idUser AND idPicture = :idPicture
			");
			$statement->bindParam('idUser', $user_id);
			$statement->bindParam('idPicture', $picture_id);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}