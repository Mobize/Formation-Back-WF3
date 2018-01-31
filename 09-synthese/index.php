<?php

// Synthèse
// variables affectation
$variable1 = 5;
$variable2= "chaine";

// constante
define('CONSTANTE','42');

// tableau
$tab = array();
$tab[] =1;
$tab[] =2;
echo $tab[0]; // 1
echo $tab[1]; // 2
$tab['toto'] = 'titi';
echo $tab['toto']; // titi

// boucles
// while
$i=0; // init
while ( $i < 10) {  // condition d'arret
    echo $i;
    $i++; //incrémentation
}
// for
for ($i=0; $i<10 ; $i++){ // ( //init; //condition d'arret ; //incrémentation )
    echo $i;
}
// foreach (spécial tableaux et objets)
foreach ( $tab as $index => $value )
{
    //je parcoure le tableau, j'ai le nom de l'indice et sa valeur
}

// Fonctions
// permet de répeter une serie d'instructions en appelant une fonction
function mise_au_carre($nombre){
    return $nombre*$nombre;
}

echo mise_au_carre(4); // 16

function addition($a,$b=10)
{
    return $a+$b;
}
echo addition(2,3); // 5
echo addition(7); // 17

// objets
// ex : PDO
// Autre exemple DateTime
$madate = new DateTime;
echo $madate->format('Y-m-d H:i:s');

$madate2 = new DateTime('2018-01-31 15:42:23');

$madate3 = new DateTime;
$madate3->setTimestamp(mktime(15,42,23,1,31,2018));
echo $madate3->format('d/m/Y');

/* inclusion de fichier */
require_once('autrefichier.php');

/* connaitre le type d une variable */
echo gettype($variable1); /* integer */

/* concatenation */
echo 'le debut d\'une chaine'.$variable1.'et la fin de la chaine';
echo "une chaine avec la variable $variable1 interprétée entre guillemets";
echo "une chaine ".$variable2." aussi concaténée";


/* sql */

$options = array(PDO::ATTR_ERRORMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$db = new PDO('mysql:host=localhost;dbname=bibliotheque','root','',$options);

$db ->exec"INSERT INTO...");
$db ->exec"UPDATE...");
$db ->exec"DELETE...");

$resul = $db->query("SELECT...")

/* POUR 1 RESULTAT */
$ligne = $resul ->fetch(PDO::FETCH_ASSOC);

/* pour plusieurs resultats */
while ( $ligne = $resul ->fetch(PDO::FETCH_ASSOC) )
{
    echo $ligne['colone'];
}

/* requete avec preparation/execution */
$valeur ='valeur';
$db->prepare("SELECT ...:param...");
$db->execute(array( 'param' => $valeur ));

$dd->query("INSERT INTO...");
$var3 =$db->lastInsertId();


/* super globales */

$_POST /* tableau qui contient les "names" des "input,select,radio,etc" d'un formulaire
    associés à leur valeurs si la méthodd d'envoi du formulaire est POST
    form method="post"...
    */

$_GET /* Tableau qui contient les entrés dans l'url qui suivent le "?" 
        ex: index.php?action=modifier&id_produit=5
        on aura $_GET['action'] qui vaut "modifier"
        et $_GET['id_produit'] qui vaut 5
        */    
 
$_FILES /* Tableau qui contient les infos des fichiers uploads sur un formulaire
            <forme method="post" action="" enctype="multipart/form-data">
        */        
 
 $_SESSION, $_COOKIE, ...
 /* Pour $_SESSION je dois avoir initialisé la session avec session_start()
    /!\ cela crée un cookie PHPSESSID pour relier au fichier de session stocké sur le serveur dans le repertoir /tmp */

 /* $_COOKIE est un tableau stocké coté client dans ses cookies de son navigateur */


 /* condition */

 if ( condition )
 {

 }
 else
 {

 }

 /* autre form */
 if ( condition ):
 
 else:

 endif:

/* switch */ 
switch( $chiffre )
{
    case 1 : ... ; break;
    case 2 : ... ; break;
    default: ... ; break;
}   

/* comparaison */
empty($var); /* renvoi vrai si $var n'est pas defini, est vide ou vaut 0 */
isset( $var ); /* renvoi vrai si $var est definie quelque soit sa valeur */

/* suppression d'un fichier */
unlink('fichier.txt');
/* suppression d'une variable */
unset($var);
/* suppression d'une session */
session_destroy();

/* nombre aleatoire */
srand(); /* initialisation du generateur de nombre aleatoire */
$nb = rand(1,10);

/* redirection */
header(location:url);
/* ne fonctionne que si je n'ai eu aucune instruction echo avant ni balise html*/

/* encryptage */

md5($password); /* encrypte en md5 (32 caracteres)*/
sha1($password); /* encrypte en sha1 (Secure Hash Algorithm 1 (40caracteres))*/




