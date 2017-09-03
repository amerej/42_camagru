<?php

if (!(isset($username) && isset($email) && isset($password)))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("INSERT INTO `Users` (`idUser`, `username`, `email`, `password`) VALUES (NULL, :username, :email, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>
