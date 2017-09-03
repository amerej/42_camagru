<?php

if (!isset($username))
    exit(header('Location: ../index.php?accessdb=error'));

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/db_connection.php';

try {
    $stmt = $db->prepare("SELECT * FROM `Pictures`");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $db = null;
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>
