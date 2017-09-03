<?php

if (!isset($username))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("SELECT * FROM `Users` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>
