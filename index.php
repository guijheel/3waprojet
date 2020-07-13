<?php 
session_start();
include 'database/database.php';
$user = NULL;
$role = NULL;

/**
        * 
        *  index php recupere tout les commentaires de la base de donnée
        */

$req = "SELECT * FROM `commentaire` ORDER BY `id` DESC";
$q=$pdo->prepare($req);
$q->execute();
$avis = $q->fetch();





$chemin = 'views/index.phtml';
include 'template/template.php';