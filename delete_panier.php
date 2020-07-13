
<?php 
session_start();
    /**
        * 
        *  delete pannier supprime le pannier à la demande de l'utilisateur
        */

unset($_SESSION['panier']);
header('Location: offres.php');
    exit();
$chemin = 'views/index.phtml';
include 'template/template.php';