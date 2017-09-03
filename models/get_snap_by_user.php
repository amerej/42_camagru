<?php

if (!isset($idUser))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("SELECT * FROM `Pictures` WHERE `idUser` = :idUser ORDER BY `dateCreation` DESC");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>