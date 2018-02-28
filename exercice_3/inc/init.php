<?php

// Connexion à la base de données "exercice_3"
$dbh = new PDO('mysql:host=localhost;dbname=exercice_3;charset=utf8', 'root', '');


/*
 * On créer un tableau de notre liste de langues disponibles.
 * Il nous permettra de gérer notre menu déroulant (select) mais également d'effectuer nos vérifications
 */
$languages = array(
	'fr' 	=> 'Français',
	'en' 	=> 'Anglais',
	'jp'	=> 'Japonais'
);

/*
 * Idem que pour les langues, on créer un tableau qui nous servira pour gérer notre select et nos vérifications
 */
$categories = array(
	'adventure'	=> 'Film d\'aventure',
	'war'		=> 'Film de guerre',
	'fantastic'	=> 'Film fantastique',
	'animation'	=> 'Film d\'animation',
	'comedy'	=> 'Comédie',
	'bio'		=> 'Film biographique'
);