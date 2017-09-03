<?php

if (!isset($_SESSION))
    session_start();

$idUser = $_SESSION['user']['id'];
$username = $_SESSION['user']['login'];

if (!(isset($username) && isset($idUser)))
    exit(header('Location: index.php?error=forbidden'));

if (empty($_FILES['file']))
    exit(header('Location: index.php?error=emptyfile'));

if ($_FILES['file']['error'] !== 0)
    exit(header('Location: index.php?error=errfile'));

$filepath = "pictures" . "/" . $username . "/";
$fileInfo = new SplFileInfo($_FILES['file']['name']);
$fileExtension = $fileInfo->getExtension();
$filename = $filepath . uniqid() . "." . $fileExtension;

if (!($fileExtension === "jpg" || $fileExtension === "png" || $fileExtension === "gif"))
    exit(header('Location: home.php?error=badfile'));

if (!is_dir("../" . $filepath)) {
    mkdir("../" . $filepath, 0777, true);
}

move_uploaded_file($_FILES['file']['tmp_name'], "../" . $filename);

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/post_pictures.php';

?>
