<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/camagru/config/database.php';

// Connect to database
//////////////////////
try { 
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OPTIONS);
}
catch(PDOException $e) { 
    echo "Connection failed: " . $e->getMessage(); 
}

// Use database
///////////////
try {
    $stmt = "use mydb";
    $db->exec($stmt);
}
catch(PDOException $e) { 
    echo $stmt . "<br>" . $e->getMessage(); 
}

?>
