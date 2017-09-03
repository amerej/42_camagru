<?php

if (!isset($_SESSION))
    session_start();

$idUser = $_SESSION['user']['id'];

if (!isset($idUser))
    exit(header('Location: index.php?error=forbidden'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/get_snap_by_user.php';

?>
