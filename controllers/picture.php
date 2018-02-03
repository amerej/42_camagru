<?php

if (!isset($_SESSION))
	session_start();

$username = $_SESSION['user']['username'];
$id_user = $_SESSION['user']['id'];
	
if (!(isset($username) && isset($id_user))) {
	exit(header('Location: index.php?error=forbidden'));
}

$_SESSION['id_picture'] = $_GET['id'];
$id_picture = $_GET['id'];

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';

$picture = PictureModel::getPicture($id_picture);

?>