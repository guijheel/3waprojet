<?php 
// Variable de connexion
$host = 'localhost@MariaDB:3307';
$dbname  = 'atable';
$username = 'root';
$password = '';

// connexion a la base de donée
$pdo = new PDO('mysql:dbname=atable;host=localhost;port=3307;charset=utf8', 'root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

