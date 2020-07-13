<?php 
session_start();
include 'database/database.php';
        /**
        * 
        *  deconnexion php supprime le pannier utilisateur ainsi que la session
        */
unset($_SESSION['authentification']);
unset($_SESSION['panier']);
header('Location: connexion.php');
    exit();

$chemin = 'views/index.phtml';
include 'template/template.php';