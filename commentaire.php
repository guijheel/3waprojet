<?php
include 'database/database.php';
require 'fonctions/fonctions.php';
session_start();

$errors = NULL;
        /**
        * 
        *  commentaire php verifie si l'utilisateur est connecté
        */

if (empty($_SESSION))
{
    $errors['alert'] = "vous devez vous connectez pour pouvoir deposer un commentaires";
}

        /**
        * 
        *  commentaire php verifie si le formulaire est remplie 
        */
if ((!empty($_POST['titre']) && !empty($_POST['texte']) && !empty($_SESSION['authentification'])))
{
    $req = $pdo->prepare("INSERT INTO commentaire SET titre = ?,commentaire = ?, pseudo = ?, note =0, date_com=NOW()");
    $req->execute(array($_POST['titre'],$_POST['texte'], $_SESSION['authentification']['pseudo']));
    $id = $pdo->lastInsertId();
    $suces['suces'] = " Votre commentaire à bien était ajouter ! Merci !";
    header("refresh:5;url=index.php");
    
}



$chemin = 'views/commentaire.phtml';
include 'template/template.php';