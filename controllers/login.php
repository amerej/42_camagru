<?php

if (!isset($_SESSION))
    session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/IO.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = IO::filterInput($_POST['username']);
    $password = IO::filterInput($_POST['password']);

	// Find user by username
	$result = UserModel::getUserByUsername($username);

    if (!$result)
        exit(header('Location: login.php?login=failure&username=notfind'));
    
    if (!password_verify($password, $result['password']))
        exit(header('Location: login.php?login=failure&password=invalid'));
    
    $_SESSION['user']['id'] = $result['idUser'];
    $_SESSION['user']['login'] = $result['username'];

    exit(header('Location: index.php'));
}

?>