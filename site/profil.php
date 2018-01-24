<?php

require_once('inc/init.php');

if ( !estConnecte() )
{
    header('location:connexion.php');
    exit();
}

$contenu = '<h2>Bonjour '.ucfirst($_SESSION['membre']['pseudo']).'</h2>';

if ( estConnecteEtAdmin())
{
    $contenu .='<p>Vous etes connecté en tant qu\'Administrateur</p>';
}

$contenu .='<div><h3>Vos informations de profil</h3>
            <p>Email: '.$_SESSION['membre']['email'].'</p>
            <p>Nom,prenom: '.ucfirst($_SESSION['membre']['nom']).', '.ucfirst($_SESSION['membre']['prenom']).'</p>
            </div>';

require_once('inc/haut.php');
echo $contenu;
require_once('inc/bas.php');
