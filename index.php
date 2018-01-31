<?php

if (!isset($_SESSION))
    session_start();

if (!(isset($_SESSION['user']['id']) && isset($_SESSION['user']['login']))) {
    exit(header('Location: gallery.php'));
}

include('views/index.php');

?>
