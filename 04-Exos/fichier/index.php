<?php

$nom_fichier = 'fichier.txt';

$fichier = file($nom_fichier);

/* var_dump($fichier); */

foreach( $fichier as $ligne){
    echo $ligne.'<br>';
}

$nom_fichier2 = 'fichier.csv';
$fichier2 = file($nom_fichier2);

foreach( $fichier2 as $ligne){
    $info_ligne = explode(';',$ligne);
    foreach( $info_ligne as $info)
    {
        echo $info.'<br>';
    }
    echo'<hr>';
}