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
                </div>
                <div class="collapse navbar-collapse" id="monmenu">
                    <ul class="nav navbar-nav">
                        <?php
                            echo '<li><a class="" href="./chauffeurs.php">Chauffeurs</a></li>';
                            echo '<li><a href="./vehicules.php">Vehicules</a></li>';
                            echo '<li><a href="./association.php">Association</a></li>';
                            echo '<li><a href="./exercice5.php">Exercice 5</a></li>';
                            echo '<li><a href="./modif.php">modif</a></li>';
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