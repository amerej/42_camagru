<?php

if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {

	require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/UserModel.php';

    // Check password robustness and if username or/and email already exists
    ////////////////////////////////////////////////////////////////////////

    // Password must be at least 8 characters length, include at least one number and include at least one letter
    $password = filter_input(INPUT_GET, 'password');
    $isPasswordWeak = TRUE;
    if (strlen($password) >= 8 && preg_match("#[0-9]+#", $password) && preg_match("#[a-zA-Z]+#", $password)) {
        $isPasswordWeak = FALSE;
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    
    // Check if username already exists 
    $username = filter_input(INPUT_GET, 'username');
    $isUsernameExists = FALSE;
    
	// Find user by username
	$result = UserModel::getUserByUsername($username);
    require 'models/get_user_by_username.php';
    if ($result)
        $isUsernameExists = TRUE;
    
    // Check if email already exists 
    $email = filter_input(INPUT_GET, 'email');
    $isEmailExists = FALSE;
    $isEmailValid = FALSE; // Todo: Implement check if email is valid
    
    // Find user by email
    $result = UserModel::getUserByEmail($email);
    if ($result) 
        $isEmailExists = TRUE;

    // If username or email not exists and password robust, insert them in the db and redirect user to login.php else redirect to signin.php
    if ($isUsernameExists || $isEmailExists || $isPasswordWeak) {
        $params = "";
        if ($isUsernameExists) {
            $params .= "username=exists";
        }
        if ($isEmailExists) {
            $params .= ($isUsernameExists) ? "&email=exists" : "email=exists";
        }
        if ($isPasswordWeak) {
            $params .= ($isUsernameExists || $isEmailExists) ? "&password=weak" : "password=weak"; // Todo: Bug when password error and email or username exists, only show password warning
        }
        exit(header("Location: signin.php?" . $params));
    }
    
    // Add user to database
    UserModel::postUser($username, $email, $password);

    // Send confirmation mail
    /*
    $message = "Signin succesful !\r\n";
    mail($email, 'Welcome to camagru', $message); 
    */

    exit(header('Location: login.php'));
}

?>
