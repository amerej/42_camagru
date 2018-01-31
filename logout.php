<?php
if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['user']['id'])) {
	unset($_SESSION['user']['login']);
    session_destroy();
}
exit(header('Location: gallery.php'));
?>
