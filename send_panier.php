<?php
session_start();
include 'fonctions/pannier.php';
include 'database/database.php';
/**
        * 
        *  send_pannier php verifie que le post recue nest pas vide et que la session nest pas vide
        * 
        */
if(!empty($_POST) && !empty($_SESSION['authentification']))
{
   $nbr = count(($_SESSION['panier']['id_produit'])) - 1;
   $req = $pdo->prepare("SELECT MAX(id_commande) FROM `commande`");
   $req->execute();
   $nbr_prod = $req->fetch();
   $nbr_prod[0]++;
    while($nbr >= 0)
    {
        $req = $pdo->prepare("INSERT INTO commande SET id_commande = ?, id_produit = ?, id_user = ?,  quantite = ?, date=NOW()");
        $req->execute(array($nbr_prod[0],$_SESSION['panier']['id_produit'][$nbr],$_SESSION['authentification']['id'],$_SESSION['panier']['quantite'][$nbr]));
        $id = $pdo->lastInsertId();
        $nbr--;
    }
    $suces['suces'] = " Votres commande à bien était valider, Merci !
                    Nous vous avons envoyer un mail sur votre commande";
    $to = $_SESSION['authentification']['email'];
    $subject = "Confirmation de votre commande";
    $message = "Nous avons bien prix en compte votre commande, vous recevrez sous peu  un mail concernant votre livraison";
    $headers = 'From: admin@guillaumejheelan.com';
    mail($to,$subject,$message,$headers);
    unset($_SESSION['panier']);
    header("refresh:3;url=commentaire.php");
}
else
{
    unset($_SESSION['panier']);
    header('Location: 404.php');
}



$chemin = 'views/confirm_panier.phtml';
include 'template/template.php';