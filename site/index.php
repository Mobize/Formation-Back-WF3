<?php

require_once('inc/init.php');
require_once('inc/haut.php');

/* Génération des categories pour alimenter le contenu gauche */

$categories = executeRequete("SELECT DISTINCT categorie FROM produit ORDER BY categorie");

$contenu_gauche .='<p class="lead">Categories</p>
                <div class="list-group">
                <a href="?categorie=all" class="list-group-item '.( !isset($_GET['categorie']) || ( isset($_GET['categorie']) && $_GET['categorie']=='all') ? 'active' : '' ).'">Toutes</a>';

                while ($cat = $categories->fetch(PDO::FETCH_ASSOC))
                {
                    $contenu_gauche .='<a href="?categorie='.$cat['categorie'].'"
                    class="list-group-item '.( isset($_GET['categorie']) && ($_GET['categorie']==$cat['categorie']) ? 'active' : '').'">'.ucfirst($cat['categorie']) .'</a>';
                }

                $contenu_gauche .='</div>';


                
 $couleurs = executeRequete("SELECT DISTINCT couleur FROM produit ORDER BY couleur");

/* generation de la liste des couleurs */
 $contenu_gauche .='<p class="lead">Couleur</p>
                  <div class="list-group">
                 <a href="?couleur=all" class="list-group-item '.( !isset($_GET['couleur']) || ( isset($_GET['couleur']) && $_GET['couleur']=='all') ? 'active' : '' ).'">Toutes</a>';
                
                 while ($color = $couleurs->fetch(PDO::FETCH_ASSOC))
                 {
                        $contenu_gauche .='<a href="?couleur='.$color['couleur'].'"
                                    class="list-group-item '.( isset($_GET['couleur']) && ($_GET['couleur']==$color['couleur']) ? 'active' : '').'">'.ucfirst($color['couleur']).'</a>';
                 }
                
                                $contenu_gauche .='</div>';
                


/* Affichage des produits pour alimenter le contenu droite en tenant compte dun eventuel choix de categories */

$complement_requete='';
$param=array();


if ( isset($_GET['categorie']) && $_GET['categorie'] !='all')
{
    $complement_requete=" AND categorie=:categorie";
    $param = array('categorie' => $_GET['categorie']);
}

if ( isset($_GET['couleur']) && $_GET['couleur'] !='all')
{
    $complement_requete=" AND couleur=:couleur";
    $param = array('couleur' => $_GET['couleur']);
}

$donnees = executeRequete("SELECT * FROM produit WHERE stock > 0".$complement_requete, $param);

/* var_dump($donnees);
 */

while ( $produit = $donnees->fetch(PDO::FETCH_ASSOC)) 
{
    $contenu_droite .='<div class="col-sm-4">
                        <div class="thumbnail">
                            <a href="fiche_produit.php?
                             id_produit='.$produit['id_produit'].'">
                             <img src="'.$produit['photo'].'"
                             class="img-responsive"></a>
                             <div class="caption">
                                <h4 class="pull-right">'.$produit['prix'].' €</h4>
                                <h4><a href="fiche_produit.php?id_produit='.$produit['id_produit'].'"</a>'.$produit['titre'].'</a></h4>
                                <p>'.$produit['description'].'</p>
                                <p> Disponibilité :'.$produit['stock'].' en stock.</p>
                                <form method="post" class="express" action="panier.php">
                                <input type="hidden" name="id_produit" value="'.$produit['id_produit'].'">
                                <input type="hidden" name="quantite" value="1">
                                <input type="hidden" name="origine" value="index">
                                <input type="submit" name="ajout_panier" value="Achat express" class="btn btn-primaty">
                                </form>
                             </div>
                          </div>        
                        </div>';  
                        
}



?>
<div class="row">
    <div class="col-md-3">
        <?= $contenu_gauche ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <?= $contenu_droite ?>
        </div>
    </div>
</div>




<?php

require_once('inc/bas.php');