<!--

    Page de confirmation du token envoyer par email

--->
<?php 

include 'database/database.php';

$user_id = $_GET['id'];
$token = $_GET['token'];
$false = NULL;
$true = NULL;
        /**
        * 
        *  confirmation php verifie si le token ajouter lors de linscription et le meme que entrer par lutilisateur
        */
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();
if($user && $user['token'] == $token)
{
    $pdo->prepare('UPDATE users SET token = NULL, date_token = NOW() WHERE id =?')->execute([$user_id]);
    $true['tokentrue'] = "Félicitations votre compte à bien était valider, vous allez êtres rediriger dans 5 secondes vers la page de connexion";
    header("refresh:3;url=connexion.php");
}
else{
    $false['tokenfalse'] = "Ce lien n'est plus valide. Merci de contacter un administrateur.";

}
$chemin = 'views/connexion.phtml';
include 'template/template.php';
?> 