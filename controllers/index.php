<?php

if (!isset($_SESSION))
	session_start();

if (!(isset($_SESSION['user']['id']) && isset($_SESSION['user']['username']))) {
	exit(header('Location: gallery.php'));
}

?>