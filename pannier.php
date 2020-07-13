<?php 
include 'database/database.php';
include 'fonctions/pannier.php';
session_start();
    /**
        * 
        *  pannier php verifie que le pannier nest pas vide  et que le get recupérer nest pas vide
        * 
        */
if(isset($_GET) || !empty($_SESSION['panier']))
{
    if(!empty($_GET))
    {    /**
        * 
        *  pannier php verifie dans la db si le get transmi correcpond bien a la db du plat 
        */
        if(search_db($_GET['id_plat'],$_GET['nom_plat'],$_GET['prix']) == 1)
        {
            // ajoute au pannier
            add_pannier($_GET['id_plat'],$_GET['nom_plat'],$_GET['prix']);
        }
        else
        {
            echo '<p class="alert">petit malin</p>';  
        }
    }
}
else
{
    echo 'transmision false';
}

$chemin = 'views/pannier.phtml';
include 'template/template.php';