<?php
include 'database/database.php';
require 'fonctions/fonctions.php';
session_start();
$error = NULL;
$image = NULL;
/**
 * 
 *  admin php verifie si lutilisateur nest pas connecter ou sil nest pas un admin
 */
if ($_SESSION['authentification']['admin'] == 0 || empty($_SESSION)){
    header('Location : 404.php');
}
/**
 * 
 *  admin php verifie si lutilisateur est  connecter
 */

if(isset($_SESSION['authentification']['admin']) == 1){
    if(isset($_FILES['image']) && !empty($_POST['description_plat']) && !empty($_POST['nom_plat']) && !empty($_POST['prix_plat']))
    {
        /**
        * 
        *  admin php requete pour poster une image
        */
        $autorisation = array("image/jpeg", "image/gif", "image/png");
        $description = $_POST['description_plat'];
        $image = $_FILES['image']['type'];
        $plat = $_POST['nom_plat'];
        $prix = $_POST['prix_plat'];
        /**
         * 
         *  admin php si il y a une erreur
         */
        if(!in_array($image, $autorisation)) {
            $error['image'] = "Seulement des images au format jpeg gif et png";
            $error['form'] = "remplir tout le formulaire";
          }
        else
        {
            $path_img = "img/cards/";
            move_uploaded_file($_FILES['image']['tmp_name'], $path_img.$_FILES['image']['name']);
            $image = $_FILES['image']['name'];
            $req = "INSERT INTO catalogue SET image = ? ,nom_plat = ?, description_plat = ?, prix_plat = ?";
            $q=$pdo->prepare($req);
            $q->execute([$image,$plat,$description,$prix]);
            $img_nb = $pdo->lastInsertId();
            $suces["image"] = "image ajouter"; 
        }
    }
        /**
        * 
        *  admin php recupérer les catalogue par id
        */
    $req = "SELECT * FROM `catalogue` ORDER BY `id_plat` DESC";
    $q=$pdo->prepare($req);
    $q->execute();
    $resultat = $q->fetchAll(PDO::FETCH_ASSOC);
        
        /**
        * 
        *  admin php recupérer les commentaire par id
        */
    $req = "SELECT * FROM `commentaire` ORDER BY `id` DESC";
    $q=$pdo->prepare($req);
    $q->execute();
    $commentaire = $q->fetchAll(PDO::FETCH_ASSOC);

         /**
        * 
        *  admin php recupérer les utilisateurs par id
        */

    $req = "SELECT `id`, `email`, `pseudo`, `date_token`  FROM `users` WHERE `admin` != 1";
    $q=$pdo->prepare($req);
    $q->execute();
    $user = $q->fetchAll(PDO::FETCH_ASSOC);
}


$chemin = 'views/admin.phtml';
include 'template/template.php';