<?php

if (!(isset($idUser) || isset($filename)))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("INSERT INTO `Pictures` (`idPicture`, `idUser`, `dateCreation`, `filename`) VALUES (NULL, :idUser, NOW(), :filename)");
    $stmt->bindParam(':idUser', $idUser);
    $stmt->bindParam(':filename', $filename);
    $stmt->execute();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>