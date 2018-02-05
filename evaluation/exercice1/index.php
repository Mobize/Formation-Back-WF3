<?php

/*  definition du Tableau */
$liste = array( "Prenom :"             => ' olivier',
                "Nom :"                => ' charpentier',
                "Adresse :"            =>  ' 31 av des arts',
                "Ville :"              =>  ' Montfermeil',
                "Code postal : "       =>    93370,
                "E-mail :"             =>  ' olivier.charpentier@icloud.com',
                "Téléphone :"          =>  ' 06 22 02 41 73',
                "date de naissance :"  =>  ' 1980-21-04',);


echo '<h2>Presentation</h2>';

foreach ($liste as $indice => $valeur) /* Boucle d'affichae de la liste */
{
   /* Definition de la date  */
    $date = new DateTime();
    $date->setDate(1980, 04, 21);
    $liste["date de naissance :"] = $date->format(' d-m-Y');

    echo "<p> <li>" . $indice . $liste[$indice] . "</p>";/* Affichage de la liste */
}
?>