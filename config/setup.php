<?php

if (!isset($_SESSION))
session_start();

if (isset($_SESSION['user']['id'])) {
	unset($_SESSION['user']['login']);
	session_destroy();
}

require_once '../classes/DB.class.php';

try {
	
	$db = DB::getInstance();
	$db->exec('DROP DATABASE IF EXISTS `mydb`');
	$db->exec('CREATE DATABASE `mydb`');
	$db->exec('USE `mydb`');

	$command = "CREATE TABLE IF NOT EXISTS `mydb`.`Users` (
	`idUser` INT NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(45) NULL,
	`email` VARCHAR(255) NULL,
	`password` VARCHAR(255) NULL,
	`token` VARCHAR(255) NULL,
	`isAuthentified` TINYINT DEFAULT 0,
	`isNotificationsEnabled` TINYINT DEFAULT 1,
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
	`content` VARCHAR(255) NULL,
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
	
	$command = "INSERT INTO `mydb`.`Users` (
	`idUser`, `username`, `email`, `password`, `token`, `isAuthentified`, `isNotificationsEnabled`) 
	VALUES (1, 'aditsch', 'aditsch@student.42.fr', '$2y$10\$n1Y6gsB9W/A6gtstvLMl9OrJ3j0UCBBh93t5vcqPO06hx5Mo2wPPO', 'c3e5a63c00c514cf5ad0dab9211268ac2436a2d4345bca7c1d9dcf6eb26c5729', 1, 0);";
	$db->exec($command);

	// $command = "INSERT INTO `mydb`.`Pictures` (`idPicture`, `idUser`, `dateCreation`, `filename`) VALUES
	// (1, 1, '2018-02-10 20:42:37', 'pictures/aditsch/5a7f4b2cb5a2b.png'),
	// (2, 1, '2018-02-10 20:42:39', 'pictures/aditsch/5a7f4b2eacc85.png'),
	// (3, 1, '2018-02-10 20:42:41', 'pictures/aditsch/5a7f4b314b4b4.png'),
	// (4, 1, '2018-02-10 20:42:43', 'pictures/aditsch/5a7f4b332579c.png'),
	// (5, 1, '2018-02-10 20:42:45', 'pictures/aditsch/5a7f4b34d913a.png'),
	// (6, 1, '2018-02-10 20:42:47', 'pictures/aditsch/5a7f4b36f29f2.png'),
	// (7, 1, '2018-02-10 20:42:49', 'pictures/aditsch/5a7f4b393b176.png'),
	// (8, 1, '2018-02-10 20:42:51', 'pictures/aditsch/5a7f4b3aac4a6.png'),
	// (9, 1, '2018-02-10 20:43:01', 'pictures/aditsch/5a7f4b4587340.png'),
	// (10, 1, '2018-02-10 20:43:03', 'pictures/aditsch/5a7f4b4780ed8.png'),
	// (11, 1, '2018-02-10 20:43:06', 'pictures/aditsch/5a7f4b49973ca.png'),
	// (12, 1, '2018-02-10 20:54:53', 'pictures/aditsch/5a7f4e0cf0fff.png'),
	// (13, 1, '2018-02-10 20:54:57', 'pictures/aditsch/5a7f4e10e36e4.png'),
	// (14, 1, '2018-02-10 20:54:59', 'pictures/aditsch/5a7f4e1389830.png'),
	// (15, 1, '2018-02-10 20:55:01', 'pictures/aditsch/5a7f4e15224cf.png'),
	// (16, 1, '2018-02-10 20:55:03', 'pictures/aditsch/5a7f4e171cc6f.png'),
	// (17, 1, '2018-02-10 20:55:06', 'pictures/aditsch/5a7f4e1a72495.png'),
	// (18, 1, '2018-02-10 20:55:09', 'pictures/aditsch/5a7f4e1d04faa.png'),
	// (19, 1, '2018-02-10 20:55:11', 'pictures/aditsch/5a7f4e1ec22e4.png'),
	// (20, 1, '2018-02-10 20:55:35', 'pictures/aditsch/5a7f4e374714f.png'),
	// (21, 1, '2018-02-10 20:55:37', 'pictures/aditsch/5a7f4e394492a.png'),
	// (22, 1, '2018-02-10 20:55:41', 'pictures/aditsch/5a7f4e3cdd2ba.png'),
	// (23, 1, '2018-02-10 20:55:46', 'pictures/aditsch/5a7f4e424f1fc.png'),
	// (24, 1, '2018-02-10 20:55:48', 'pictures/aditsch/5a7f4e4453401.png'),
	// (25, 1, '2018-02-10 20:55:58', 'pictures/aditsch/5a7f4e4e5421a.png'),
	// (26, 1, '2018-02-10 20:56:00', 'pictures/aditsch/5a7f4e500a8c1.png'),
	// (27, 1, '2018-02-10 20:56:03', 'pictures/aditsch/5a7f4e52d5c71.png'),
	// (28, 1, '2018-02-10 20:56:05', 'pictures/aditsch/5a7f4e54bb290.png'),
	// (29, 1, '2018-02-10 20:56:29', 'pictures/aditsch/5a7f4e6d07bb9.png'),
	// (30, 1, '2018-02-10 20:56:31', 'pictures/aditsch/5a7f4e6eec557.png'),
	// (31, 1, '2018-02-10 20:56:33', 'pictures/aditsch/5a7f4e715bf35.png'),
	// (32, 1, '2018-02-10 20:58:49', 'pictures/aditsch/5a7f4ef918917.png'),
	// (33, 1, '2018-02-10 20:58:51', 'pictures/aditsch/5a7f4efb8118f.png'),
	// (34, 1, '2018-02-10 20:58:53', 'pictures/aditsch/5a7f4efd33504.png'),
	// (35, 1, '2018-02-10 20:58:54', 'pictures/aditsch/5a7f4efdb5be7.png'),
	// (36, 1, '2018-02-10 20:58:55', 'pictures/aditsch/5a7f4efeb40c6.png'),
	// (37, 1, '2018-02-10 20:58:58', 'pictures/aditsch/5a7f4f02081f2.png'),
	// (38, 1, '2018-02-10 20:58:59', 'pictures/aditsch/5a7f4f02a84d5.png'),
	// (39, 1, '2018-02-10 20:58:59', 'pictures/aditsch/5a7f4f032f313.png'),
	// (40, 1, '2018-02-10 20:59:04', 'pictures/aditsch/5a7f4f08277cb.png'),
	// (41, 1, '2018-02-10 20:59:05', 'pictures/aditsch/5a7f4f08e0d80.png'),
	// (42, 1, '2018-02-10 20:59:37', 'pictures/aditsch/5a7f4f2998f54.png'),
	// (43, 1, '2018-02-10 20:59:39', 'pictures/aditsch/5a7f4f2b5fa48.png');";
	// $db->exec($command);

	// $command = "INSERT INTO `comments` (`idComment`, `idUser`, `idPicture`, `content`, `dateCreation`) VALUES
	// (10, 1, 11, '5', '2018-02-10 20:45:29'),
	// (9, 1, 11, '4', '2018-02-10 20:45:26'),
	// (8, 1, 11, '3', '2018-02-10 20:45:23'),
	// (7, 1, 11, '2', '2018-02-10 20:45:21'),
	// (6, 1, 11, '1', '2018-02-10 20:45:18'),
	// (11, 1, 11, '6', '2018-02-10 20:45:31'),
	// (12, 1, 11, '7', '2018-02-10 20:45:34'),
	// (13, 1, 11, '8', '2018-02-10 20:45:36'),
	// (14, 1, 11, '9', '2018-02-10 20:45:39'),
	// (15, 1, 11, '10', '2018-02-10 20:45:42'),
	// (16, 1, 11, '11', '2018-02-10 20:45:44'),
	// (17, 1, 11, '12', '2018-02-10 20:45:47'),
	// (18, 1, 11, '13', '2018-02-10 20:45:50'),
	// (19, 1, 11, '14', '2018-02-10 20:45:52'),
	// (20, 1, 11, '15', '2018-02-10 20:45:55'),
	// (21, 1, 11, '16', '2018-02-10 20:45:58'),
	// (22, 1, 11, '17', '2018-02-10 20:46:00'),
	// (23, 1, 11, '18', '2018-02-10 20:46:03'),
	// (24, 1, 11, '19', '2018-02-10 20:46:06'),
	// (25, 1, 11, '20', '2018-02-10 20:46:09');";
	// $db->exec($command);
}
catch(PDOException $e) {
	echo $command . " :" . $e->getMessage();
}

header("Location: ../index.php");

?>
