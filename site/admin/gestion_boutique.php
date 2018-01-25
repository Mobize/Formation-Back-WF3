<?php

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); /* si pas admin, redirection vers la page connexion */
    exit();
}

$contenu .='<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits</a></li>
                <li><a href="?action=ajout">Ajouter un produit</a></li>
            </ul>';

if ( (isset($_GET['action']) && $_GET['action']=='affichage') || !isset($_GET['action']))
{
    /* affichage des produits */
    $resul = executeRequete("SELECT * FROM produit");

$contenu .="<h3>Affichage des produits</h3>";
$contenu .="<p>Nombre de produits : ".$resul->rowCount()."</p>";
$contenu .="<table class='table-striped'>
                <tr>";
/* les en tetes */
for( $i=0; $i<$resul->columnCount() ; $i++)        
{
    $colonne = $resul->getColumnMeta($i);
    $contenu .='<th class="text-center">'.ucfirst($colonne['name']).'</th>';
    
} 
$contenu .='<th colspan="2">Actions</th>';
$contenu .="</tr>";
/* les donnees */
while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';
    foreach($ligne as $indice =>$information)
    {
            $contenu .="<td class='text-center'>".$information.'</td>';
    }
    $contenu .='<td><a href="?action=modifier&id_produit='.$ligne['id_produit'].'">Modifier</a>';
    
    $contenu .='<td><a href="?action=suppression&id_produit='.$ligne['id_produit'].'"onclick=
    "return(confirm(\'Etes vous certain de vouloir supprimer ce produit :'.$ligne['titre'].'?\'))">Supprimer</a></td>';


    $contenu .='</tr>';
}
$contenu .='<table>';


}

/* produits */


/* insertion produit */




require_once('../inc/haut.php');
echo $contenu;

/* je veux afficher un formulaire  */

if ( (isset($_GET['action']) && ($_GET['action']=='ajout' || $_GET['action']=='modifier')))
:
   if ( !empty( $_GET['id_produit']) )
   {
        $resul = executeRequete("SELECT * FROM produit WHERE id_produit=:id_produit",array
        ('id_produit'=>$_GET['id_produit']));
        $produit_actuel=$resul->fetch(PDO::FETCH_ASSOC);
   }
?>
<h3>Formulaire d'ajout ou de modifiaction d'un produit</h3>
<form method="post" action="" enctype="multipart/fomr-data">
   <input type="hidden" id="id_produit" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">

   <label for="reference">réference</label>
   <input type="text" id="reference" name="reference" value="<?= $produit_actuel['reference'] ?? '' ?>"><br>

   <label for="categorie">categorie</label>
   <input type="text" id="categorie" name="categorie" value="<?= $produit_actuel['categorie'] ?? '' ?>"><br>

   <label for="titre">titre</label>
   <input type="text" id="titre" name="titre" value="<?= $produit_actuel['titre'] ?? '' ?>"><br>

   <label for="description">description</label><br>
   <textarea id="decription" name="decription" cols="40" rows="3" ><?= $produit_actuel['description'] ?? '' ?></textarea><br>

   <label for="couleur">couleur</label>
   <input type="text" id="couleur" name="couleur" value="<?= $produit_actuel['couleur'] ?? '' ?>"><br>

   <label>Taille</label>
   <select name="taille">
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='S' ) ? 'selected' : '' ?> value="S">S</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='M' ) ? 'selected' : '' ?> value="M">M</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='L' ) ? 'selected' : '' ?> value="L">L</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL' ) ? 'selected' : '' ?> value="XL">XL</option>
   </select><br>

   <!-- public : m,f, mixte -->
   <label for="photo">Photo</label>
   <input type="file" id="photo" name="photo">
   <!-- prix stock -->

   <input type="submit" value="Valider" class="btn btn-primary">

</form>
<?php
endif;

require_once('../inc/bas.php');

