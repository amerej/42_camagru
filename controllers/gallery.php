<?php

if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['user']['login']) && isset($_SESSION['user']['id'])) {
    $username = $_SESSION['user']['login'];
    $id_user = $_SESSION['user']['id'];
}

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';

$pictures = PictureModel::getPictures();

?>
