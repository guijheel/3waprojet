<?php
session_start();
include 'fonctions/pannier.php';
$id = $_GET['id'];
$search = array_search($id,$_SESSION['panier']['id_produit']);
        /**
        * 
        *  ajout_pannier php recherche si le produit n'est pas dans le pannier
        */
if($search !== false)
{
    $_SESSION['panier']['quantite'][$search]++;
    $_SESSION['panier']['prix_produit'][$search] = $_SESSION['panier']['prix_produit'][$search] + $_SESSION['panier']['prix'][$search];
    $total = total();
    $_SESSION['panier']['prix_total'] = $total;
    header('Location: pannier.php');
}
else
{
    header('Location: pannier.php');
    exit();
}