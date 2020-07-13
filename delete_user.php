<?php
include 'database/database.php';
require 'fonctions/fonctions.php';
session_start();
    /**
        * 
        *  admin delete php verifie si l'admin est connecter et que la session n'est pas vide sinon supprime l'utilisateur
        */
if ($_SESSION['authentification']['admin'] == 0 || empty($_SESSION)){
    header('Location : 404.php');
}
else{
    $sql = 'DELETE FROM users WHERE id = ? AND admin != 1';
    $q=$pdo->prepare($sql);
    $q->execute([$_GET['id']]);
    header('Location: admin.php');
    exit();
var_dump($_GET);
}