<?php 
session_start();
include 'database/database.php';


    /**
        * 
        *  offres php recupére tout les  plat dans la base de donées
        * des alphanumérique et des __ 8 
        */


$req = "SELECT * FROM `catalogue` ORDER BY `id_plat` DESC";
$q=$pdo->prepare($req);
$q->execute();
$catalogue = $q->fetchAll(PDO::FETCH_ASSOC);


$chemin = 'views/offres.phtml';

include 'template/template.php';