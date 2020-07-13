<?php
include 'database/database.php';
require 'fonctions/pannier.php';
session_start();
$current_user = NULL;
$user = NULL;
$suces = NULL;
        /**
        * 
        *  compte php verifie si le formulaire est remplie et que les deux mot de passe corresponde 
        * et change le mot de pas utilisateur
        */
    if(!empty($_POST)){
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password-confirmation']){
          $errors['change-mdp-false'] = "Les mots de passes ne correspondent pas";
        }
        else{
            $user = $_SESSION['authentification']['id'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $req = $pdo->prepare('UPDATE `users` SET `id`=?,`password`=?');
            $req->execute([$user, $password]);
            $suces['change-mdp-true'] =  "Votre mot de passe à bien éte changer";
            $to = $_SESSION['authentification']['email'];
            $subject = "Mot de passe changé !";
            $message = "Votre mot de passe viens d'étres changer , si ce n'est pas vous veuillez nous contactez !";
            mail($to,$subject,$message);
        }
    }
    $current_user = $_SESSION['authentification']['pseudo'];
    $user_id = $_SESSION['authentification']['id'];
        /***
        * 
        *  compte php affiche les commande utilisateur
        */
   if(commande($user_id < 1))
   {
        $req = "SELECT `id_commande` , `id_produit` , `quantite`,`date` ,`id_user`, `nom_plat`
        FROM commande
        INNER JOIN catalogue
        ON commande.id_produit=catalogue.id_plat
        WHERE`id_user` LIKE '{$user_id}'";
        $q=$pdo->prepare($req);
        $q->execute();
        $commande = $q->fetchAll(PDO::FETCH_ASSOC);
   }
   else
   {
       $errors['panier'] = "Vous n'avez aucune commande";
   }

$chemin = 'views/compte.phtml';
include 'template/template.php';