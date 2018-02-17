<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Exercice 3</title>
</head>
<body>
    <div class="container">
    
</body>
</html>



<?php

/* initialisation de la base de donnée */
session_start();
$base = new PDO('mysql:host=localhost;dbname=exercice_3',
'root',
'',
array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'    
));


$contenu='';/* variable d'affichage */


/* ajout  d'un film */

if (isset($_POST['ajout']))
    {
       
        $maj = $base->prepare("INSERT INTO movies VALUES(NULL,:title,:actors,:director,:producer,:year_of_prod,:language,:category,:storyline,:video)" );
        $maj->execute(array(
                            'title' => $_POST['title'],
                            'actors' => $_POST['actors'],
                            'director' => $_POST['director'],
                            'producer' => $_POST['producer'],
                            'year_of_prod' => $_POST['year_of_prod'],
                            'language' => $_POST['language'],
                            'category' => $_POST['category'],
                            'storyline' => $_POST['storyline'],
                            'video' => $_POST['video'],
                           ));
            $contenu.='<p>Le film à été ajouté</p>';
    }


$resul = $base->query("SELECT * FROM movies");/* non terminé.. */
if(isset($_GET['id_movies']))
{
    $contenu.='<p>Fiche du film</p>';
    $ligne = $resul->fetch(PDO::FETCH_ASSOC);
    
        $contenu.='<p>'.$ligne['title'].'</p>';
                  '<p>'.$ligne['actors'].'</p>';
                  '<p>'.$ligne['director'].'</p>';
                  '<p>'.$ligne['producer'].'</p>';
                  '<p>'.$ligne['year_of_prod'].'</p>';
                  '<p>'.$ligne['language'].'</p>';
                  '<p>'.$ligne['category'].'</p>';
                  '<p>'.$ligne['storyline'].'</p>';
                  '<p>'.$ligne['video'].'</p>';
                  
}


/* affichage du tableau des films */

$resul = $base->query("SELECT * FROM movies");

$contenu .="<h3>Films</h3>";

$contenu .="<table class='table-striped'>
            <tr>";

/* Affichages des en tetes */

$contenu .='<th>Nom du film</th>';
$contenu .='<th>Realisateur</th>';
$contenu .='<th>Annee de production</th>';

$contenu .="</tr>";

/* Affichage des lignes */

while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    
    $contenu .='<td class="text-center">'.$ligne['title'].'</td>';     
    $contenu .='<td class="text-center">'.$ligne['director'].'</td>';     
    $contenu .='<td class="text-center">'.$ligne['year_of_prod'].'</td>';     
    $contenu .='<td><a href="?action=voir&id_movies='.$ligne['id_movies'].'">Voir plus</a></td>';
    $contenu .='</tr>';

}


$contenu .='<table>';/* fin du tableau */

echo $contenu;
?>
<div class="col-md-8">
    <form method="post" action="">
        <div class="form-group" action="">
            <input type="hidden" class="form-control" id="id_movies" name="id_movies" value="">
            <label for="film">Film</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="titre"  value="">
        </div>
        <div class="form-group">
            <label for="actors">Acteurs</label>
            <input type="text" name="actors" class="form-control" id="actors" placeholder="acteur" value="">
        </div>
        <div class="form-group">
            <label for="director">Realisateur</label>
            <input type="text" name="director" class="form-control" id="director" placeholder="realisateur" value="">
        </div>
        <div class="form-group">
            <label for="producer">Producteur</label>
            <input type="text" name="producer" class="form-control" id="producer" placeholder="producteur" value="">
        </div>
        <div class="form-group">
            <label for="year_of_prod">Année de production</label>
            <select name="year_of_prod" id="year_of_prod" class="form-control">

                <!-- affichage du menu deroulant -->
                <?php
                $resul = $base->query("SELECT * FROM movies");
                while($annees=$resul->fetch(PDO::FETCH_ASSOC))
                {
                echo '<option value="'.$annees['year_of_prod'].'"> '.$annees['year_of_prod'].'</option>';/* affichage des categories */
                }
                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="language">Langue</label>
            <select name="language" id="language" class="form-control">

                <!-- affichage du menu deroulant -->
                <?php
                $resul = $base->query("SELECT * FROM movies");
                while($annees=$resul->fetch(PDO::FETCH_ASSOC))
                {
                echo '<option value="'.$annees['language'].'">'.$annees['language'].'</option>';/* affichage des categories */
                }
                ?>

        </select>
        </div>
        <div class="form-group">

                <!-- affichage du menu deroulant -->

                <label for="category">categorie</label>
                <select name="category" id="category" class="form-control">

                <?php
                $resul = $base->query("SELECT * FROM movies");
                while($annees=$resul->fetch(PDO::FETCH_ASSOC))
                {
                echo '<option value="'.$annees['category'].'">'.$annees['category'].'</option>';/* affichage des categories */
                }
                ?>

        </select>
        </div>

        <div class="form-group">
            <label for="storyline">Synopsis</label>
            <input type="textarea" name="storyline" class="form-control" id="storyline" placeholder="Synopsis" value="">
        </div>
        <div class="form-group">
            <label for="video">Lien video</label>
            <input type="text" name="video" class="form-control" id="exampleInputPassword1" placeholder="prenom" value="">
        </div>
            <button type="submit" name="ajout" class="btn btn-default">Valider</button>
    </form>
        </div>

</div>
