<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boutique</title>
    <!-- Liens css -->
    <link rel="stylesheet" href="./inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="./inc/css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#monmenu">
                    <span class="sr-only">Naviguer</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand " href="index.php">Accueil</a>
                </div>
                <div class="collapse navbar-collapse" id="monmenu">
                    <ul class="nav navbar-nav">
                        <?php
                         
                            if( estConnecteEtAdmin() ){

                                echo '<li><a class="" href="admin/gestion_boutique.php">Gestion Boutique</a></li>';
                                echo '<li><a href="admin/gestion_membre.php">Gestion Membres</a></li>';
                                echo '<li><a href="admin/gestion_commande.php">Gestion Commandes</a></li>';

                            }
                            if( estConnecte() ){
                                echo'<li><a href="profil.php">Profil</a></li>';
                                echo'<li><a href="connexion.php?action=deconnexion">Se Deconnecter <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>';

                            }
                            else
                            {
                                echo'<li><a href="inscription.php">Inscription</a></li>';
                                echo'<li><a href="connexion.php">Connexion <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span></a></li>';
                            }
                            echo '<li><a href="panier.php">Panier '.nbArticlePanier().'</a></li>';
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container main"><!-- coller le bas de la div container dans bas.php -->
    
    

<!-- couper la partie basse et coller dans bas.php
 </body>
</html> -->