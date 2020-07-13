
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    
    <!--lien CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script> 
   
</head>
<body>
    <header>
         <!--Navbar -->
    <navbar>
    <div class="navbar">
            <ul>
                <li><a href="index.php" title="logo"><img src="img/logo.png" class="logo" alt="logo"></img></a></li>
                <li><a href="index.php" id="accueil" title="accueil">Accueil</a><a href="index.php" title="accueil"><i class="fas fa-home"></i></a></li>
                <li><a href="offres.php" id="offres" title="offres">Offres </a><a href="offres.php" title="offres" ><i class="fas fa-book-reader"></i></a></li>
                <?php if(isset($_SESSION['authentification']['admin']) == 1 && $_SESSION['authentification']['admin']): ?>
                    <li><a href="admin.php" id="admin" title="admin">Admin</a><a href="admin.php" title="admin"><i class="fas fa-crown"></i></a></li>
                    <li><a href="compte.php" id="compte" title="compte">Mon Compte</a><a href="compte.php" title="compte"><i class="fas fa-users"></i></a></li>
                    <li><a href="deconnexion.php" id="deconnexion" title="deconnexion">Se déconnecter</a><a href="deconnexion.php" title="deconnexion"><i class="fas fa-sign-out-alt"></i></a></li>
                    <?php elseif(isset($_SESSION['authentification'])): ?>
                    <li><a href="compte.php" id="compte" title="compte">Mon Compte</a><a href="compte.php" title="compte"><i class="fas fa-users"></i></a></li>
                    <li><a href="deconnexion.php" id="deconnexion" title="deconnexion">Se déconnecter</a><a href="deconnexion.php" title="deconnexion"><i class="fas fa-sign-out-alt"></i></a></li>
                <?php else : ?>
                    <li><a href="connexion.php" id="connexion" title="connexion">Se Connecter</a><a href="connexion.php" title="connexion"><i class="fas fa-sign-in-alt"></i></a></li>
                    <li><a href="inscription.php" id="inscription" title="inscription">S'inscrire</a><a href="inscription.php" title="inscription"><i class="fas fa-user-plus"></i></a></li>
                <?php endif; ?>
                <li><a href="pannier.php" id="pannier" title="pannier">Panier</a><a href="pannier.php" title="pannier"><i class="fas fa-shopping-cart"></i></a></li>
            </ul>
        </div>
        </navbar>
    </header>
    <main>
        <?php include $chemin ?>
    </main>
     <!--Footer-->
    <footer>
        <div class="footer">
            <ul>
                <li><a href="https://www.instagram.com/guidev75/" id="insta" title="Instagram">Instagram</a><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://www.facebook.com/gui.dev.378/" id="fb" title="Facebook">Facebook</a><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                <li><a href="#" id="snap" title="Snapchat">Snapchat</a><a href="#" title="Snapchat"><i class="fab fa-snapchat-square"></i></a></li>
                <li><a href="https://twitter.com/guidev10" id="twitter" title="Twitter">Twitter</a><a href="#" title="Twitter"><i class="fab fa-twitter-square"></i></a></li>
            </ul>
            </div>
        </footer>
     <!--
             Script JS
-->
        
        <script type="text/javascript" src="js/slider.js"></script>
        <script type="text/javascript" src="js/sticky.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/selec.js"></script>
</body>
</html>
