<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=proj","root",""
	,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
} catch (Exception $error) {
    die("ERROR: Couldn't connect. {$error->getMessage()}");
}

$url = 'http://' . $_SERVER['SERVER_NAME'] . '/proj/';