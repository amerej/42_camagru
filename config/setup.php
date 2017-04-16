<?php
include 'database.php';

// Connect to DB
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OPTIONS);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

try {
	$sql = "DROP DATABASE IF EXISTS db_camagru";
	$db->exec($sql);
	$sql = "CREATE DATABASE db_camagru";
	$db->exec($sql);
	$sql = "use db_camagru";
	$db->exec($sql);

	$sql = "CREATE TABLE `Users` (
		`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
		`username` TEXT NOT NULL ,
		`email` TEXT NOT NULL ,
		`passwd` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM";
	$db->exec($sql);
}
catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}
$db = null;
header("Location: index.php");
?>
