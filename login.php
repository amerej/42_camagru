<?php

if (!isset($_SESSION))
    session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/classes/AutoLoader.php';
AutoLoader::register();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = IO::filterInput($_POST['username']);
    $password = IO::filterInput($_POST['password']);

    // Find user by username
    require 'models/get_user_by_username.php';

    if (!$result)
        exit(header('Location: index.php?login=failure&username=notfind'));
    
    if (!password_verify($password, $result['password']))
        exit(header('Location: index.php?login=failure&password=invalid'));
    
    $_SESSION['user']['id'] = $result['idUser'];
    $_SESSION['user']['login'] = $result['username'];

    exit(header('Location: index.php?login=success'));
}

/* if (isset($_GET['username']) && isset($_GET['password'])) {
    
    // TODO
    // Check if username exists
    $username = filter_input(INPUT_GET, 'username');
    
    // Find user by username
    require 'models/get_user_by_username.php';

    if (!$result)
        exit(header('Location: index.php?login=failure&username=notfind'));

    // Check if password correspond and if yes redirect to index.php
    $password = filter_input(INPUT_GET, 'password');
    if (!password_verify($password, $result['password']))
        exit(header('Location: index.php?login=failure&password=invalid'));

    $_SESSION['idUser'] = $result['idUser'];
    $_SESSION['username'] = $result['username'];


    exit(header('Location: index.php?login=success'));
} */

require_once 'views/login.php';

?>
