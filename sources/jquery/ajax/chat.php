<?php
session_start();
//Connexion a la base de données

$pdo = new PDO('mysql:dbname=test_ajax;host=localhost', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET CHARACTER SET utf8");

extract($_POST);
$_SESSION['name'] = $name;

//Insertion de l'information
$insert = $pdo->prepare('INSERT INTO chat(name, msg) VALUES (:name, :message)');
$insert->bindParam(':name', $name);
$insert->bindParam(':message', $msg);
$insert->execute();

