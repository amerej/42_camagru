<?php

if (!isset($_SESSION))
	session_start();

if (!(isset($_SESSION['user']['username']) && isset($_SESSION['user']['id'])))
	exit(header('Location: index.php?error=forbidden'));

if (!isset($_GET['id'])) {
	exit(header('Location: index.php?error=notfound'));
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/CommentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/Security.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!(isset($_POST['content']) && isset($_POST['user_id']) && isset($_POST['picture_id'])))
		exit(header('Location: index.php?error=nodata'));
	$username = $_SESSION['user']['username'];
	$user_id = Security::filterInput($_POST['user_id']);
	$picture_id = Security::filterInput($_POST['picture_id']);
	$content = Security::filterInput($_POST['content']);
	$email = PictureModel::getEmailByPicture($picture_id);
	$user_email = UserModel::getUserByEmail($email);
	$is_notifications_enabled = UserModel::getNotificationsState($user_email['idUser']);
	if ($is_notifications_enabled) {
		// Send notifications mail
		$picture = PictureModel::getPicture($picture_id);
		$filename = $picture['filename'];
		$subject = "New notification camagru";
		$message = "	<html>
							<body>
								<div>
									<img src=\"http://localhost:8080/camagru/$filename\">
									<p>$content by $username</p>
								</div>
							</body>
						</html>
					";
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		mail($email, $subject, $message, $headers);
	}
	CommentModel::postComment($user_id, $picture_id, $content);
}

$picture_id = Security::filterInput($_GET['id']);
$offset = isset($_GET['offset']) ? Security::filterInput($_GET['offset']) : 0;
$limit = isset($_GET['limit']) ? Security::filterInput($_GET['limit']) : 10;
$comments = CommentModel::getComments($picture_id, $limit, $offset);

?>