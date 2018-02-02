<?php

/* 
    Ce fichier sera inclus dans tous les scripts pour initialiser les elements
    suivants:

    -creation/ouverture de session
    -connexion à la BDD site
    -definition du chemin du site
    -inclusion de notre fichier de fonction utilisateur (fonction.php)
*/

//Session
session_start();

//Connexion à la base de donnée
$base = new PDO('mysql:host=localhost;dbname=programme','root','',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



