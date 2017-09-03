<?php

if (!isset($_SESSION))
    session_start();

$idUser = $_SESSION['user']['id'];
$username = $_SESSION['user']['login'];

if (!(isset($username) && isset($idUser)))
    exit(header('Location: index.php?error=forbidden'));

if (!isset($_POST['image']) && !isset($_POST['filter']))
    exit(header('Location: ../home.php?error=nodata'));

$image = $_POST['image'];
$filter = $_POST['filter'];
$filepath = "pictures" . "/" . $username . "/";
$filename = $filepath . uniqid() . '.png';

if (!is_dir("../" . $filepath))
    mkdir("../" . $filepath, 0777, true);

file_put_contents('../' . $filename, file_get_contents("data://" . $image));

// Merge image and filter
$dest = imagecreatefrompng('../' . $filename);
$src = imagecreatefrompng($filter);

imagecopy($dest, $src, 0, 0, 0, 0, 640, 480);
imagepng($dest, '../' . $filename);

imagedestroy($src);
imagedestroy($dest);

// Save new image
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/post_pictures.php';

?>
