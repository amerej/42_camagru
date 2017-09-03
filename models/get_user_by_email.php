<?php

if (!isset($email))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("SELECT * FROM `Users` WHERE `email` = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>
