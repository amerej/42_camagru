<?php
if (!isset($_SESSION))
	session_start();

if (isset($_SESSION['user']['id']) && isset($_SESSION['user']['username'])) {
	unset($_SESSION['user']);
	session_destroy();
}
exit(header('Location: gallery.php'));
?>
