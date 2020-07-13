<?php
session_start();
include 'fonctions/pannier.php';
$id = $_GET['id'];
$search = array_search($id,$_SESSION['panier']['id_produit']);
/**
        * 
        *  suppr pannier php 
        * 1. verifie si la quantité est supérieur a 1  
        * 2. supprime le produit en question
        * 3. si la quantité de produit dans le pannier est inférieure a 0 on supprime le pannier
        * 4. remanie le tableau par ordre numérique 
        * 5. si le pannier est totalement vide on me supprime
        * :)
*/
if($search !== false)
{
    if($_SESSION['panier']['quantite'][$search] > 1)
    {
        $_SESSION['panier']['quantite'][$search]--;
        $_SESSION['panier']['prix_produit'][$search] = $_SESSION['panier']['prix_produit'][$search] - $_SESSION['panier']['prix'][$search];
        $total = total();
        $_SESSION['panier']['prix_total'] = $total;
        header('Location: pannier.php');
    }
    else
    {
        $qte = $_SESSION['panier']['prix_total'] = $_SESSION['panier']['prix_total'] - $_SESSION['panier']['prix'][$search];
        unset($_SESSION['panier']['quantite'][$search]);
        unset($_SESSION['panier']['prix'][$search]);
        unset($_SESSION['panier']['nom_plat'][$search]);
        unset($_SESSION['panier']['prix_produit'][$search]);
        unset($_SESSION['panier']['id_produit'][$search]);
        if(($count_panier = count($_SESSION['panier']['id_produit'])) < 0)
        {
            unset($_SESSION['panier']);
            unset($_SESSION['panier']['prix_total']);
            header('Location: pannier.php');
        }
        else
        {
            $_SESSION['panier']['id_produit'] = array_values($_SESSION['panier']['id_produit']);
            $_SESSION['panier']['quantite'] = array_values($_SESSION['panier']['quantite']);
            $_SESSION['panier']['prix'] = array_values($_SESSION['panier']['prix']);
            $_SESSION['panier']['nom_plat'] = array_values($_SESSION['panier']['nom_plat']);
            $_SESSION['panier']['prix_produit'] = array_values($_SESSION['panier']['prix_produit']);
            if(($count_panier = count($_SESSION['panier']['id_produit'])) <= 0)
            {
            unset($_SESSION['panier']);
            unset($_SESSION['panier']['prix_total']);
            header('Location: pannier.php');
            }
        }
header('Location: pannier.php');
    }
}
else
{
    header('Location: pannier.php');
    exit();
}
