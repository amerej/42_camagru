<?php

if (!isset($_SESSION)) {
	session_start();
}

$id_user = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];

if (!(isset($username) && isset($id_user)))
	exit(header('Location: index.php?error=forbidden'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/PictureModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!isset($_POST['image']) && !isset($_POST['filter']))
		exit(header('Location: ../home.php?error=nodata'));
	$image = $_POST['image'];
	$filters = json_decode($_POST['filters']);
	
	$filepath = "pictures" . "/" . $username . "/";
	$filename = $filepath . uniqid() . '.png';
	
	if (!is_dir($filepath))
		mkdir($filepath, 0777, true);
	
	file_put_contents($filename, file_get_contents("data://" . $image));
	
	// Merge image and filter
	$dest = imagecreatefrompng($filename);
	
	foreach ($filters as $filter) {
		$src = imagecreatefrompng($filter);
		imagecopy($dest, $src, 0, 0, 0, 0, 640, 480);
		imagedestroy($src);
	}
	
	imagepng($dest, $filename);
	imagedestroy($dest);

	PictureModel::postPicture($id_user, $filename);
}

$pictures = PictureModel::getPicturesByUser($id_user);

?>
