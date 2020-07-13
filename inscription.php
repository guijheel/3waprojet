<?php 
session_start();
include 'database/database.php';
include 'fonctions/fonctions.php';
$errors = NULL;
$suces = NULL;
/**
        * 
        * inscription php verifie que le formulaire n'est pas vide 
        * verifie que l'email n'est pas deja utilisé 
        */
if(!empty($_POST)){
    $errors = array();  
    if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "Votre adresse e-mail n'est pas correcte";

    }
    else{
        $req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if($user){
            $errors['email'] = 'Cette e-mail est déjà utilisé';
        }
    }
    /**
        * 
        *  inscription php verifie que le pseudo n'est pas déjà utilisé et que le mot de passe contient 
        * des alphanumérique et des __ 8 
        */
    if(empty($_POST['pseudo']) || !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['pseudo']))
    {
        $errors['pseudo'] = "Votre pseudo doit contenir des lettre Alphabétique et  des Chiffres  uniquement ou un charactères spécial _  du 8";
    }
    else{
        $req = $pdo->prepare('SELECT id FROM users WHERE pseudo = ?');
        $req->execute([$_POST['pseudo']]);
        $user = $req->fetch();
        if($user){
            $errors['pseudo']= 'Ce pseudo est déjà utilisé';
        }
    }
        /**
        * 
        *  inscription php verifie que les deux password corresponde bien 
        * 
        */
    if(empty($_POST['password']) || ($_POST['password'] != $_POST['password-confirmation']))
    {
        $errors['password '] = "Vos mot de passe ne corresponde pas";
    }
} 

/*   
        Requete si ya aucune erreur et que le formulaire n'est pas vide
*/
if(empty($errors) && !empty($_POST)){

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Crypte le mot de passe utilisateur dans la base de donées
    $token = str_token(120); // genere un  token de 120 charactéres unique
    $req = $pdo->prepare("INSERT INTO users SET pseudo = ?,password = ? ,email = ?, token = ?, admin = 0"); //prepare l'envoie des données
 
    $req->execute([$_POST['pseudo'], $password, $_POST['email'],$token]); // envoie les informations transmits par l'utilisateur à la base de donées
    $user_id = $pdo->lastInsertId();
    $to = $_POST['email'];
    $subject = "Confirmez votre compte";
    $message = "Afin de validez votre compte merci de cliquez sur ce lien\n\nhttps://guillaumejheelan.com/projet/atable/confirmation.php?id=$user_id&token=$token";
    $headers = 'From: admin@guillaumejheelan.com';
    mail($to,$subject,$message,$headers); // envoie un mail a l'utilisateur
    $suces['compte'] = "Votre compte à bien était crée vous allez recevoir un mail de confirmation..
    Merci de cliquez sur le lien de confirmation..
    Vous allez êtres rediriger dans 5 secondes.";
    header("refresh:15;url=connexion.php");
}



$chemin = 'views/inscription.phtml';
include 'template/template.php';