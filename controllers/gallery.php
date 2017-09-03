<?php

if (!isset($_SESSION))
    session_start();

$username = $_SESSION['user']['login'];

if (!isset($username))
    exit(header('Location: index.php?error=forbidden'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/get_pictures.php';

?>
