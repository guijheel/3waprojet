<?php 
/**
        * 
        *  connexion php verifie si le formulaire est remplie et verifie 
        * si les donnée recue correspond a un utilisateur
        */
include 'database/database.php';

    if (!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['password'])){

        $req = $pdo->prepare('SELECT * FROM users WHERE (pseudo =:pseudo OR email = :pseudo) AND date_token IS NOT NULL');
        $req->execute(['pseudo' => $_POST['pseudo']]);
        $user = $req->fetch();
       if(password_verify($_POST['password'], $user['password']))
       {
           session_start();
           $_SESSION['authentification'] = $user;
           $true['connexiontrue'] = "Identifiant correct ! redirection dans 5 secondes sur votre Compte.";
           header("refresh:5;url=compte.php");
       }else{
          
           $false['connexionfalse'] = "Nom de compte ou mot de passe incorect ... ! ";
       }
    }

$chemin = 'views/connexion.phtml';
include 'template/template.php';