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


$resul = executeRequete("SELECT * FROM commande c, details_commande d, produit p
                         WHERE c.id_commande=d.id_commande
                         AND d.id_produit = p.id_produit 
                         AND c.id_membre = :id_membre ORDER BY date_enregistrement DESC ",array('id_membre' => $_SESSION['membre']['id_membre']));

$contenu .='<table class="table table-bordered">';
$commande_courante=0; // variable mémoire

while ( $commande = $resul->fetch(PDO::FETCH_ASSOC))
{
    if ( $commande['id_commande'] != $commande_courante )
    {
        // entete de commande 1 seule fois par commandes
        $contenu .= '<tr class="info">
                    <td colspan="2"><h3>Commande '.$commande['id_commande'].' passée le '.$commande['date_enregistrement'].
                    '</h3><h5>Etat de la commande : '.$commande['etat'].'</h5></td><td colspan="2" class="text-center"><h3>'.$commande['montant'].' €</h3></td></tr>
                    <tr>
                        <th>Quantité</th>
                        <th>Article/Taille</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                    </tr>';
    }

    // ligne d'article
    $contenu .='<tr><td class="text-center">'.$commande['quantite'].' ex</td><td >'.$commande['titre'].' ( Taille '.$commande['taille'].')</td><td class="text-center">'.$commande['prix'].' €/pièce</td>
    <td class="text-center">'.$commande['prix'] * $commande['quantite'].' €</td></tr>';

    //mise à jour de ma variable mémoire
    $commande_courante = $commande['id_commande'];
}

$contenu .='</table>';

/* $o=executeRequete('SELECT id_commande from commande where id_membre = '.$_SESSION['membre']['id_membre']);
$commande=$o->fetch(PDO::FETCH_ASSOC);

$contenu.='<div><h3>Vos informations de profil</h3>
                    <p>Email: '.$_SESSION['membre']['email'].'</p>
                    <p>Nom,prenom: '.ucfirst($_SESSION['membre']['nom']).', '.ucfirst($_SESSION['membre']['prenom']).'</p>
                    <h3>Vos commandes</h3>
          </div>';

while ( $commande = $o->fetch(PDO::FETCH_ASSOC)) 
{
    $contenu.='<p>'.$commande['id_commande'].'</p>';

    $detail=executeRequete("SELECT p.titre,d.prix from produit p,details_commande d where p.id_produit=d.id_produit AND id_commande=".$commande['id_commande']);

    while ( $produit=$detail->fetch(PDO::FETCH_ASSOC))
    {
        $contenu.='
            
            <table><tr><th>
            <p>'.$produit['titre'].''.$produit['prix'].'</p>
             </th></tr></table>';
    }           
} */
require_once('inc/haut.php');
echo $contenu;
require_once('inc/bas.php');
