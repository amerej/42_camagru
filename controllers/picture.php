<?php

if (!isset($_SESSION))
	session_start();
	
if (!(isset($_SESSION['user']['username']) && isset($_SESSION['user']['id']))) {
	exit(header('Location: index.php?error=forbidden'));
}

if (!isset($_GET['id'])) {
	exit(header('Location: index.php?error=notfound'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';

$picture_id = Security::filterInput($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	PictureModel::deletePicture($_SESSION['user']['id'], $picture_id);
}

$picture = PictureModel::getPicture($picture_id);
if (!$picture) {
	exit(header('Location: gallery.php?error=notfound'));
}

$filename = urlencode($picture['filename']);
$user_id = $_SESSION['user']['id']

?>