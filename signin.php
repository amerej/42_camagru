<?php

if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {

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
    require 'models/get_user_by_username.php';
    if ($result)
        $isUsernameExists = TRUE;
    
    // Check if email already exists 
    $email = filter_input(INPUT_GET, 'email');
    $isEmailExists = FALSE;
    $isEmailValid = FALSE; // Todo: Implement check if email is valid
    
    // Find user by email
    require 'models/get_user_by_email.php';
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
            $cond = ($isUsernameExists || $isEmailExists);
            $params .= $cond ? "&password=weak" : "password=weak"; // Todo: Bug when password error and email or username exists, only show password warning
        }
        exit(header("Location: signin.php?" . $params));
    }
    
    // Add user to database
    require 'models/post_user.php';

    // Send confirmation mail
    /*
    $message = "Signin succesful !\r\n";
    mail($email, 'Welcome to camagru', $message); 
    */

    exit(header('Location: index.php'));
}

include('views/signin.php');

?>