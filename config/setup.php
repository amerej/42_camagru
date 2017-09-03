<?php
require_once 'database.php';

// Connect to DB
try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PASS, $DB_OPTIONS);
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

try {
	$sql = "DROP DATABASE IF EXISTS mydb";
	$db->exec($sql);
	$sql = "CREATE DATABASE mydb";
	$db->exec($sql);
	$sql = "use mydb";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
	`idUser` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(45) NULL,
	`email` VARCHAR(255) NULL,
	`password` VARCHAR(255) NULL,
	PRIMARY KEY (`idUser`))
	ENGINE = MyISAM";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Pictures` (
	`idPicture` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`dateCreation` DATETIME NULL,
	`filename` VARCHAR(255) NULL,
	PRIMARY KEY (`idPicture`))
	ENGINE = MyISAM";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Filter` (
	`idFilter` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NULL,
	`filename` VARCHAR(255) NULL,
	PRIMARY KEY (`idFilter`))
	ENGINE = MyISAM";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Comments` (
	`idComment` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`idPicture` INT NULL,
	`content` VARCHAR(45) NULL,
	`dateCreation` DATETIME NULL,
	PRIMARY KEY (`idComment`))
	ENGINE = MyISAM";
	$db->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS `mydb`.`Likes` (
	`idLike` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`idPicture` INT NULL,
	PRIMARY KEY (`idLike`))
	ENGINE = MyISAM";
	$db->exec($sql);
}
catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}
$db = null;
header("Location: ../index.php");
?>
