<?php

if (!isset($_SESSION))
	session_start();

if (!(isset($_SESSION['user']['username']) && isset($_SESSION['user']['id'])))
	exit(header('Location: index.php?error=forbidden'));

if (!isset($_GET['id'])) {
	exit(header('Location: index.php?error=notfound'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/LikeModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!(isset($_POST['user_id']) && isset($_POST['picture_id'])))
		exit(header('Location: index.php?error=nodata'));
	$user_id = $_POST['user_id'];
	$picture_id = $_POST['picture_id'];

	$is_like = LikeModel::getLike($user_id, $picture_id);
	if ($is_like == 0) {
		LikeModel::postLike($user_id, $picture_id);
	}
	else {
		LikeModel::deleteLike($user_id, $picture_id);
	}
}

$picture_id = Security::filterInput($_GET['id']);
$likes = LikeModel::getLikes($picture_id);

?>