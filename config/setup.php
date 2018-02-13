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
	VALUES (1, 'mhammerc', 'mhammerc@student.42.fr', '$2y$10\$n1Y6gsB9W/A6gtstvLMl9OrJ3j0UCBBh93t5vcqPO06hx5Mo2wPPO', 'c3e5a63c00c514cf5ad0dab9211268ac2436a2d4345bca7c1d9dcf6eb26c5729', 1, 0);";
	$db->exec($command);

	$command = "INSERT INTO `mydb`.`Pictures` (`idPicture`, `idUser`, `dateCreation`, `filename`) VALUES
	(1, 1, '2018-02-13 17:02:16', 'pictures/mhammerc/5a830c082c17e.png'),
	(2, 1, '2018-02-13 17:02:20', 'pictures/mhammerc/5a830c0ca22eb.png'),
	(3, 1, '2018-02-13 17:02:24', 'pictures/mhammerc/5a830c0fe9040.png'),
	(4, 1, '2018-02-13 17:02:27', 'pictures/mhammerc/5a830c12ebb10.png'),
	(5, 1, '2018-02-13 17:02:35', 'pictures/mhammerc/5a830c1b0295f.png'),
	(6, 1, '2018-02-13 17:02:40', 'pictures/mhammerc/5a830c201b2ff.png'),
	(7, 1, '2018-02-13 17:02:43', 'pictures/mhammerc/5a830c235e0a4.png'),
	(8, 1, '2018-02-13 17:02:53', 'pictures/mhammerc/5a830c2d37e01.png'),
	(9, 1, '2018-02-13 17:02:57', 'pictures/mhammerc/5a830c31bad4e.png'),
	(10, 1, '2018-02-13 17:03:08', 'pictures/mhammerc/5a830c3c183ac.png'),
	(11, 1, '2018-02-13 17:03:40', 'pictures/mhammerc/5a830c5c36d7a.png'),
	(12, 1, '2018-02-13 17:03:43', 'pictures/mhammerc/5a830c5f37837.png'),
	(13, 1, '2018-02-13 17:03:45', 'pictures/mhammerc/5a830c60e7125.png'),
	(14, 1, '2018-02-13 17:03:47', 'pictures/mhammerc/5a830c6308f5e.png'),
	(15, 1, '2018-02-13 17:03:50', 'pictures/mhammerc/5a830c65c7c07.png'),
	(16, 1, '2018-02-13 17:03:51', 'pictures/mhammerc/5a830c6777580.png'),
	(17, 1, '2018-02-13 17:03:53', 'pictures/mhammerc/5a830c6962e15.png'),
	(18, 1, '2018-02-13 17:03:56', 'pictures/mhammerc/5a830c6c680b9.png'),
	(19, 1, '2018-02-13 17:03:59', 'pictures/mhammerc/5a830c6fbf3b2.png'),
	(20, 1, '2018-02-13 17:04:02', 'pictures/mhammerc/5a830c724da51.png'),
	(21, 1, '2018-02-13 17:05:03', 'pictures/mhammerc/5a830caf55a22.png'),
	(22, 1, '2018-02-13 17:05:05', 'pictures/mhammerc/5a830cb13ab6c.png'),
	(23, 1, '2018-02-13 17:05:07', 'pictures/mhammerc/5a830cb2c6342.png'),
	(24, 1, '2018-02-13 17:05:08', 'pictures/mhammerc/5a830cb493bcf.png'),
	(25, 1, '2018-02-13 17:05:10', 'pictures/mhammerc/5a830cb66ba0a.png'),
	(26, 1, '2018-02-13 17:05:12', 'pictures/mhammerc/5a830cb7ecc04.png'),
	(27, 1, '2018-02-13 17:05:13', 'pictures/mhammerc/5a830cb990815.png'),
	(28, 1, '2018-02-13 17:05:16', 'pictures/mhammerc/5a830cbc84e7d.png'),
	(29, 1, '2018-02-13 17:05:18', 'pictures/mhammerc/5a830cbe9aad4.png'),
	(30, 1, '2018-02-13 17:05:21', 'pictures/mhammerc/5a830cc0ce604.png'),
	(31, 1, '2018-02-13 17:05:23', 'pictures/mhammerc/5a830cc39b65f.png'),
	(32, 1, '2018-02-13 17:05:25', 'pictures/mhammerc/5a830cc564671.png'),
	(33, 1, '2018-02-13 17:05:27', 'pictures/mhammerc/5a830cc7182d8.png'),
	(34, 1, '2018-02-13 17:05:29', 'pictures/mhammerc/5a830cc8e3f75.png'),
	(35, 1, '2018-02-13 17:05:30', 'pictures/mhammerc/5a830ccaad4e8.png'),
	(36, 1, '2018-02-13 17:05:32', 'pictures/mhammerc/5a830ccc82fea.png'),
	(37, 1, '2018-02-13 17:05:34', 'pictures/mhammerc/5a830cce6876d.png'),
	(38, 1, '2018-02-13 17:05:36', 'pictures/mhammerc/5a830cd04407e.png'),
	(39, 1, '2018-02-13 17:05:38', 'pictures/mhammerc/5a830cd21ba91.png'),
	(40, 1, '2018-02-13 17:05:40', 'pictures/mhammerc/5a830cd4601f7.png'),
	(41, 1, '2018-02-13 17:10:33', 'pictures/mhammerc/5a830df9c81fb.png'),
	(42, 1, '2018-02-13 17:10:36', 'pictures/mhammerc/5a830dfbd95bf.png'),
	(43, 1, '2018-02-13 17:10:37', 'pictures/mhammerc/5a830dfd99460.png'),
	(44, 1, '2018-02-13 17:10:39', 'pictures/mhammerc/5a830dff10ad9.png'),
	(45, 1, '2018-02-13 17:10:40', 'pictures/mhammerc/5a830e008e5dc.png'),
	(46, 1, '2018-02-13 17:10:42', 'pictures/mhammerc/5a830e0251f4e.png'),
	(47, 1, '2018-02-13 17:10:44', 'pictures/mhammerc/5a830e043177f.png'),
	(48, 1, '2018-02-13 17:10:46', 'pictures/mhammerc/5a830e06cc090.png'),
	(49, 1, '2018-02-13 17:10:48', 'pictures/mhammerc/5a830e08a18c9.png'),
	(50, 1, '2018-02-13 17:10:51', 'pictures/mhammerc/5a830e0acbd37.png'),
	(51, 1, '2018-02-13 17:10:55', 'pictures/mhammerc/5a830e0f74d93.png'),
	(52, 1, '2018-02-13 17:10:57', 'pictures/mhammerc/5a830e113fbaf.png'),
	(53, 1, '2018-02-13 17:10:59', 'pictures/mhammerc/5a830e12cd65f.png'),
	(54, 1, '2018-02-13 17:11:00', 'pictures/mhammerc/5a830e14b0eb8.png'),
	(55, 1, '2018-02-13 17:11:02', 'pictures/mhammerc/5a830e1654556.png'),
	(56, 1, '2018-02-13 17:11:04', 'pictures/mhammerc/5a830e17c5be6.png'),
	(57, 1, '2018-02-13 17:11:05', 'pictures/mhammerc/5a830e19a034c.png'),
	(58, 1, '2018-02-13 17:11:07', 'pictures/mhammerc/5a830e1b2564b.png'),
	(59, 1, '2018-02-13 17:11:09', 'pictures/mhammerc/5a830e1cc0a34.png'),
	(60, 1, '2018-02-13 17:11:11', 'pictures/mhammerc/5a830e1ee08f8.png');";
	$db->exec($command);

	$command = "INSERT INTO `mydb`.`Comments` (`idComment`, `idUser`, `idPicture`, `content`, `dateCreation`) VALUES
	(1, 1, 60, '1', '2018-02-13 17:15:47'),
	(2, 1, 60, '2', '2018-02-13 17:15:51'),
	(3, 1, 60, '3', '2018-02-13 17:15:54'),
	(4, 1, 60, '4', '2018-02-13 17:15:57'),
	(5, 1, 60, '5', '2018-02-13 17:16:00'),
	(6, 1, 60, '6', '2018-02-13 17:16:02'),
	(7, 1, 60, '7', '2018-02-13 17:16:05'),
	(8, 1, 60, '8', '2018-02-13 17:16:09'),
	(9, 1, 60, '9', '2018-02-13 17:16:12'),
	(10, 1, 60, '10', '2018-02-13 17:16:15'),
	(11, 1, 60, '11', '2018-02-13 17:16:54'),
	(12, 1, 60, '12', '2018-02-13 17:16:56'),
	(13, 1, 60, '13', '2018-02-13 17:17:00'),
	(14, 1, 60, '14', '2018-02-13 17:17:03'),
	(15, 1, 60, '15', '2018-02-13 17:17:05'),
	(16, 1, 60, '16', '2018-02-13 17:17:08'),
	(17, 1, 60, '17', '2018-02-13 17:17:11'),
	(18, 1, 60, '18', '2018-02-13 17:17:14'),
	(19, 1, 60, '19', '2018-02-13 17:17:18'),
	(20, 1, 60, '20', '2018-02-13 17:17:21'),
	(21, 1, 60, '21', '2018-02-13 17:17:40'),
	(22, 1, 60, '22', '2018-02-13 17:17:43'),
	(23, 1, 60, '23', '2018-02-13 17:17:46'),
	(24, 1, 60, '24', '2018-02-13 17:17:49'),
	(25, 1, 60, '25', '2018-02-13 17:17:52'),
	(26, 1, 60, '26', '2018-02-13 17:17:56'),
	(27, 1, 60, '27', '2018-02-13 17:17:59'),
	(28, 1, 60, '28', '2018-02-13 17:18:02'),
	(29, 1, 60, '29', '2018-02-13 17:18:04'),
	(30, 1, 60, '30', '2018-02-13 17:18:07');";
	$db->exec($command);
}
catch(PDOException $e) {
	echo $command . " :" . $e->getMessage();
}

header("Location: ../index.php");

?>
