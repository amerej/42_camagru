<?php

if (!isset($_SESSION))
	session_start();

$username = $_SESSION['user']['username'];

if (!isset($username))
	exit(header('Location: index.php?error=forbidden'));

$images = glob("filters/*.png");

?>
