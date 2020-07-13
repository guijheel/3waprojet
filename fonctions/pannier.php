<?php 

/*

        Fonction qui verifie s'il existe un panier chez lutilisateur sinon il crée un panier

*/
    function panier()
    {
        if(!isset($_SESSION['panier']))
        {
            $_SESSION['panier'] = array();
            $_SESSION['panier']['id_produit'] = array();
            $_SESSION['panier']['quantite'] = array();
            $_SESSION['panier']['prix'] = array();
            $_SESSION['panier']['nom_plat'] = array();
            $_SESSION['panier']['prix_produit'] = array();
            $_SESSION['panier']['prix_total'] = array();
        }
    return true;
    }
/*

        Fonction qui vérifie si l'article envoyer par l'utilisateur existe dans la database

*/

function search_db($id_plat,$nom_plat,$prix_plat)
{
    include 'database/database.php';
    $rech1 = $pdo->prepare("SELECT * FROM catalogue WHERE id_plat LIKE '{$id_plat}'");
    $rech2 = $pdo->prepare("SELECT * FROM catalogue WHERE nom_plat LIKE '{$nom_plat}'");
    $rech3 = $pdo->prepare("SELECT * FROM catalogue WHERE prix_plat LIKE '{$prix_plat}'");
    $rech1->execute(array());
    $rech2->execute(array());
    $rech3->execute(array());
    $nb1 = $rech1->rowCount();
    $nb2 = $rech2->rowCount();
    $nb3 = $rech3->rowCount();
  
    if($nb1 >= 1 && $nb2 >= 1 && $nb3 >= 1)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

/*

        Fonction qui ajoute un article au pannier de l'utilisateur

*/

function add_pannier($id_plat,$nom_plat,$prix_plat)
{
    if(panier())
    {
        $position_produit = array_search($id_plat,$_SESSION['panier']['id_produit']);
        if($position_produit !== false)
        {
            $i = 0;
            $id = $_GET['id_plat'];
            $nbr = count(($_SESSION['panier']['id_produit']));
            while($i < $nbr)
            {
                if($_GET['id_plat'] ==  $_SESSION['panier']['id_produit'][$i])
                {
                  $qte =  $_SESSION['panier']['quantite'][$i] = $_SESSION['panier']['quantite'][$i] + 1;
                  $prix_produit = $_SESSION['panier']['prix'][$i] * $qte;
                  $_SESSION['panier']['prix_produit'][$i] = $prix_produit;
                  $total = total();
                  $_SESSION['panier']['prix_total'] = $total;
                }
                $i++;
            }
        }
        else   
        {
            array_push($_SESSION['panier']['id_produit'],$id_plat);
            array_push($_SESSION['panier']['prix'],$prix_plat);
            array_push($_SESSION['panier']['nom_plat'],$nom_plat);
            array_push($_SESSION['panier']['quantite'],1);
            array_push($_SESSION['panier']['prix_produit'],$prix_plat);
            $total = total();
            $_SESSION['panier']['prix_total'] = $total;
        }
    }
    else
    {
        echo 'errur';
    }

}
/*

        fonction qui compte le total des produit

*/

function total()
{
    $total = 0;
    $count_produit = count($_SESSION['panier']['prix_produit']);
    for($i = 0; $i < $count_produit; $i++)
    {
        $total = $total + $_SESSION['panier']['prix_produit'][$i];
    }
    return($total);
}

/*

        Fonction qui verifie le nombre d'article dans celui de l'utilisateur

*/

function commande($user_id)
{
    include 'database/database.php';
    $req = $pdo->prepare("SELECT COUNT(*) FROM `commande` WHERE`id_user` LIKE '{$user_id}'");
    $req->execute();
    $nbr_count = $req->fetch();

    if($nbr_count >= 1)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}
