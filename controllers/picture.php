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
$picture = PictureModel::getPicture($picture_id);

?>