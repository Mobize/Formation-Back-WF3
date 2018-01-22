<?php

session_start(); /* permet de creer une session, ou d en ouvrir une si elle existe */

$_SESSION['login'] = 'olivier';
$_SESSION['mdp'] = 'secret';

echo '<pre>';
var_dump($_SESSION);
var_dump($_COOKIE);
echo '</pre>';