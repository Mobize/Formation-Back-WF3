<?php

require_once('inc/init.php');

/* traitement */
if ( isset($_POST['ajout_panier']) )
{
    $resultat_de_ma_requete= executeRequete('SELECT * FROM produit WHERE id_produit=:id_produit',
    array('id_produit'=>$_POST['id_produit']));

    if ( $resultat_de_ma_requete->rowCount() > 0) /* si le resultat est superieur à 0 */
    {
        $produit=$resultat_de_ma_requete->fetch(PDO::FETCH_ASSOC);

        /* fonction d ajout au panier */
        ajouterProduitDansPanier($produit['id_produit'],$_POST['quantite'],$produit['prix']);

        /* Retour à la fiche produit avec la prise en compte de la mise au panier*/
        
        if(isset($_POST['origine']) && $_POST['origine']=='index')
        {
           header('location:index.php');
        }else{
             header('location:fiche_produit.php?statut_produit=ajoute&id_produit='.$_POST['id_produit']);
        }

    }
    else
    {
        if(isset($_POST['origine']) && $_POST['origine']=='index')
        {
            header('location:index.php');
        }else {
             header('location:fiche_produit.php?id_produit='.$_POST['id_produit']);
        }
    }
}


require_once('inc/haut.php');


echo $contenu;


require_once('inc/bas.php');