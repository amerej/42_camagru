<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/DB.class.php';

class CommentModel {

	public static function getComments($id_picture) {
		try {
			$statement = DB::getInstance()->prepare
			("	SELECT c.*, DATE_FORMAT(dateCreation, '%d/%m/%Y') AS date, u.username FROM Comments c 
				INNER JOIN Users u ON c.idUser = u.idUser 
				WHERE c.idPicture = $id_picture 
				ORDER BY c.dateCreation DES
			");
			$statement->execute();
			return $statement->fetchAll();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}

	public static function postComment($id_user_comment, $id_picture, $content) {
		try {
			$statement = DB::getInstance()->prepare
			("	INSERT INTO `Comments`(`idComment`, `idUser`, `idPicture`, `content`, `dateCreation`) 
				VALUES (NULL, :idUser, :idPicture, :content, NOW())
			");
			$statement->bindParam(':idUser', $id_user_comment);
			$statement->bindParam(':idPicture', $id_picture);
			$statement->bindParam(':content', $content);
			$statement->execute();

		} catch(PDOException $e) {
			echo $e->getMessage(); 
		}
	}
}