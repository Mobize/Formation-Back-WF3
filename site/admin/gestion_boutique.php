<?php

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); /* si pas admin, redirection vers la page connexion */
    exit();
}


/* suppression */
if ( isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_produit']))
{
    $resul = executeRequete("SELECT photo FROM produit WHERE id_produit= :id_produit" ,
    array('id_produit' => $_GET['id_produit']));
    $photo_a_supprimer = $resul->fetch(PDO::FETCH_ASSOC);
    $chemin_photo = $_SERVER['DOCUMENT_ROOT'] . $photo_a_supprimer['photo'];

    if ( !empty($photo_a_supprimer['photo']) && file_exists($chemin_photo)){
        unlink($chemin_photo);
    }

    executeRequete("DELETE FROM produit WHERE id_produit =:id_produit" ,
    array('id_produit'=>$_GET['id_produit']));
    $contenu .='<div class="alert alert-success">Le produit a été supprimé <span class="glyphicon glyphicon-saved" aria-hidden="true"></span></div>';
    $_GET['action'] = 'affichage';

}


/* Onglet affichage ajout/modifier */
$contenu .='<ul class="nav nav-tabs">
                <li><a href="?action=affichage">Affichage des produits <span class="glyphicon glyphicon-sort" aria-hidden="true"></a></li>
                <li><a href="?action=ajout">Ajouter un produit <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></li>
            </ul>';

/* Enregistrement du produit en BDD */

if ( $_POST ){

    $photo_bdd='';

if ( isset($_POST['photo_actuelle']) )
{
    $photo_bdd= $_POST['photo_actuelle'];
}

/*  ajouter des controles sur le format, la taille et l extension de l image */



if ( !empty($_FILES['photo']['name']))
{
    $nom_photo = $_POST['reference'] . '-' . $_FILES['photo']['name'];
    $photo_bdd = RACINE_SITE . 'photo/' .$nom_photo;
    $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd;
    

    copy($_FILES['photo']['tmp_name'], $photo_dossier);
}

    /* on enregistre le produit en base (enfin !) */

    executeRequete("REPLACE INTO produit VALUES(:id_produit,:reference,:categorie,
    :titre,:description,:couleur,:taille,:public,:photo,:prix,:stock)", 
    array( 'id_produit' => $_POST['id_produit'],
        'reference'     => $_POST['reference'],
        'categorie'     => $_POST['categorie'],
        'titre'         => $_POST['titre'],
        'description'   => $_POST['description'],
        'couleur'       => $_POST['couleur'],
        'taille'        => $_POST['taille'],
        'public'        => $_POST['public'],
        'photo'         => $photo_bdd,
        'prix'          => $_POST['prix'],
        'stock'         => $_POST['stock'],
    ));

    $contenu .='<div class="alert alert-success">Le produit a été enregistré <span class="glyphicon glyphicon-saved" aria-hidden="true"></span></div>';

    $_GET['action'] = 'affichage';

}



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
            if ( ($indice=='photo') && $information != '')
            {
                $information ='<a target="_blank" href="'.$ligne['photo'].'"> <img class="img-thumbnail affiche" src="'.$information.'"
                alt="'.$ligne['titre'].'"></a> ';   
            }
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
<h3>Formulaire d'ajout ou de modification d'un produit</h3>
<form method="post" action="" enctype="multipart/form-data">
   <div class="form-group col-xs-5">
   <input type="hidden" class="form-control" id="id_produit" name="id_produit" value="<?= $produit_actuel['id_produit'] ?? 0 ?>">

   <label for="reference">Réference</label>
   <input type="text" class="form-control" id="reference" name="reference" value="<?= $produit_actuel['reference'] ?? '' ?>"><br>

   <label for="categorie">Categorie</label>
   <input type="text" class="form-control" id="categorie" name="categorie" value="<?= $produit_actuel['categorie'] ?? '' ?>"><br>

   <label for="titre">Titre</label>
   <input type="text" class="form-control" id="titre" name="titre" value="<?= $produit_actuel['titre'] ?? '' ?>"><br>

   <label for="description">Description</label><br>
   <textarea id="description" class="form-control" name="description" cols="40" rows="3" ><?= $produit_actuel['description'] ?? '' ?></textarea><br>

   <label for="couleur">Couleur</label>
   <input type="text" class="form-control" id="couleur" name="couleur" value="<?= $produit_actuel['couleur'] ?? '' ?>"><br>

   <label>Taille</label>
   <select name="taille">
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='S' ) ? 'selected' : '' ?> value="S">S</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='M' ) ? 'selected' : '' ?> value="M">M</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='L' ) ? 'selected' : '' ?> value="L">L</option>
       <option <?= ( isset($produit_actuel['taille']) && $produit_actuel['taille']=='XL' ) ? 'selected' : '' ?> value="XL">XL</option>
   </select><br>

   <!-- public : m,f, mixte -->
   <label for="public">Public</label><br>
   <input type="radio" name="public" value="m" <?= ((isset($produit_actuel['public']) &&
   $produit_actuel['public'] =='m') || !isset($produit_actuel['public'])) ? 'checked' : '' ?>>Homme 

<input type="radio" name="public" value="f" <?= (isset($produit_actuel['public']) &&
   $produit_actuel['public'] =='f') ? 'checked' : '' ?>>Femme 

<input type="radio" name="public" value="mixte" <?= (isset($produit_actuel['public']) &&
   $produit_actuel['public'] =='mixte') ? 'checked' : '' ?>>Mixte 

   <br>
   <label for="photo">Photo</label>
   <input type="file"  id="photo" name="photo">
   <?php

    if ( isset($produit_actuel['photo']) )
    {
        echo '<p>Vous pouvez uploader une nouvelle photo</p>';
        echo '<div class="row"><div class="col-xs-5"><img class="img-thumbnail" src="' .$produit_actuel['photo'] .'"alt="'.$produit_actuel['titre']. '" ></div></div>';
        echo '<input type="hidden" name="photo_actuelle" value="'.$produit_actuel['photo'].'" >';
        /* cet input permet de remplir $_POST sur un indice "photo actuelle" la valeur
            de l'url de la photo stockée en base. Ainsi si on ne charge pas de nouvelle photo,
            l'url actuelle sera remise en base.
        */
    }

   ?>
    <br>
   <label for="prix">Prix</label>
   <input type="text" class="form-control" id="prix" name="prix" size="10" value="<?= $produit_actuel['prix'] ?? 0 ?>">
   <br>

   <label for="stock">Stock</label>
   <input type="text" class="form-control" id="stock" name="stock" size="10" value="<?= $produit_actuel['stock'] ?? 0 ?>">
   <br>
   <!-- prix stock -->
   
   <input type="submit" value="Valider" class="btn btn-primary">
   </div>
</form>

<?php
endif;

require_once('../inc/bas.php');

