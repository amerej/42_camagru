<?php

if (!isset($_SESSION))
session_start();

if (isset($_SESSION['user']['id'])) {
	unset($_SESSION['user']['login']);
	session_destroy();
}

require_once '../classes/DB.class.php';

// Construct DB
try {
	
	$db = DB::getInstance();
	$db->exec('drop database if exists mydb');
	$db->exec('create database mydb');
	$db->exec('use mydb');

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
	`idUser` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(45) NULL,
	`email` VARCHAR(255) NULL,
	`password` VARCHAR(255) NULL,
	PRIMARY KEY (`idUser`))
	ENGINE = MyISAM";
	$db->exec($command);

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Pictures` (
	`idPicture` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`dateCreation` DATETIME NULL,
	`filename` VARCHAR(255) NULL,
	PRIMARY KEY (`idPicture`))
	ENGINE = MyISAM";
	$db->exec($command);

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Filter` (
	`idFilter` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45) NULL,
	`filename` VARCHAR(255) NULL,
	PRIMARY KEY (`idFilter`))
	ENGINE = MyISAM";
	$db->exec($command);

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Comments` (
	`idComment` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`idPicture` INT NULL,
	`content` VARCHAR(45) NULL,
	`dateCreation` DATETIME NULL,
	PRIMARY KEY (`idComment`))
	ENGINE = MyISAM";
	$db->exec($command);

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Likes` (
	`idLike` INT NOT NULL AUTO_INCREMENT,
	`idUser` INT NULL,
	`idPicture` INT NULL,
	PRIMARY KEY (`idLike`))
	ENGINE = MyISAM";
	$db->exec($command);
}
catch(PDOException $e) {
	echo $command . " :" . $e->getMessage();
}

header("Location: ../index.php");

?>
