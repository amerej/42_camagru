<?php

if (!isset($_SESSION))
	session_start();

$username = $_SESSION['user']['username'];
$id_user = $_SESSION['user']['id'];

if (!(isset($username) && isset($id_user)))
	exit(header('Location: index.php?error=forbidden'));

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/CommentModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!(isset($_POST['content']) && isset($_POST['idUserComment']) && isset($_POST['idPicture'])))
		exit(header('Location: ../index.php?error=nodata'));
	$id_user_comment = $_POST['idUserComment'];
	$id_picture = $_POST['idPicture'];
	$content = $_POST['content'];
	CommentModel::postComment($id_user_comment, $id_picture, $content);
	
} else {
	$id_picture = $_SESSION['id_picture'];
	$comments = CommentModel::getComments($id_picture);
}

?>