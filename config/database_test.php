<?php

const DB_HOST = 'localhost';
const DB_DSN = 'mysql:host='.DB_HOST;
const DB_USER = 'root';
const DB_PASS = 'rootroot';
const DB_OPTIONS = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

?>
