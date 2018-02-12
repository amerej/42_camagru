<?php

if (!(isset($_GET['email']) && isset($_GET['token']))) {
	exit(header('Location: index.php?error=notfound'));
}



?>