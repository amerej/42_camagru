<?php

if (!isset($_SESSION))
	session_start();


if (isset($_SESSION['user']['username']) && isset($_SESSION['user']['id'])) {
	$username = $_SESSION['user']['username'];
	$id_user = $_SESSION['user']['id'];
}

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

$offset = isset($_GET['offset']) ? Security::filterInput($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? Security::filterInput($_GET['limit']) : 20;
$pictures = PictureModel::getPictures($limit, $offset);

?>