<?php

require_once('inc/init.php');
$aside ='';


/*1- controler l existence du produit demandé */
if ( isset($_GET['id_produit']))
{
    $resul = executeRequete('SELECT * FROM produit where id_produit=:id_produit',
    array('id_produit' => $_GET['id_produit']));
    if ( $resul->rowCount() == 0)
    {
        header('location:index.php');
        exit();
    }
    /* si j'arrive ici c'est que j'ai un produit en base */
    /* Affichage et mise en forme de la fiche produit */
    $produit=$resul->fetch(PDO::FETCH_ASSOC);
    
    $contenu .='<div class="row">
                    <div class="col-sm-12">
                        <h1 class="page-header">'.$produit['titre']
                        .'</h1>
                    </div>
                </div>';

    $contenu .='<div class="col-md-8">
                    <img class="img-responsive" src="'.$produit['photo'].'" alt="" title="">
                </div>';

    $contenu .='<div class="col-md-4">
                    <h3>Description</h3>
                    <p>'.$produit['description'].'</p>
                    <h3>Détails</h3>
                    <ul>
                        <li>Categorie : '.$produit['categorie'].'</li>
                        <li>Couleur : '.$produit['couleur'].'</li>
                        <li>Taille : '.$produit['taille'].'</li>
                        <li>Stock : '.$produit['stock'].'</li>
                    </ul>    
                    <p class="lead alert alert-info">Prix : '.$produit['prix'].' €</p>
                </div>';    


     /* gérer l'affichage de l ajout au panier */
     
     if ( $produit['stock'] > 0 )
     {
        $contenu .='<div class="col-md-4">
                        <form method="post" action="panier.php">
                            <input type="hidden" name="id_produit" value="'.$produit['id_produit'].'">
                            <select name="quantite" class="form-group-sm
                            form-control-static">';

                            for( $i=1; $i<=$produit['stock'] && $i <=5; $i++ ) /* 5 est egal à la valeur maximum d 'achat de ce produit */
                            {
                                $contenu .='<option>'.$i.'</option>';
                            }
        $contenu .='        </select>
                        <input type="submit" name="ajout_panier" value="ajouter au panier" class="btn btn-primaty">
                        </form>                      
                   </div>';       
     }
     else
     {
        $contenu .='<div class="col-md4">
                 <p>Produit indisponible</p>
                 </div>';
     }


/* lien de retour à la boutique ( en preselectionnant la categorie du produit consulté) */
    $contenu .='<div class="col-md-4">
                    <p>
                        <a href="index.php?categorie='.$produit['categorie'].'">Produits de même categorie</a>
                    </p>
                </div>';
                
/* construction de la variable aside */      

     $resul = executeRequete('SELECT id_produit,photo,titre FROM produit WHERE categorie=:cat AND id_produit != :id_prod LIMIT 0,2',
     array('cat' => $produit['categorie'],
            'id_prod' => $produit['id_produit'] ));

    while ( $suggestion =$resul->fetch(PDO::FETCH_ASSOC) )
    {
        $aside .='<div class="col-sm-3">
        <div class="thumbnail">
                        <a href="?id_produit='.$suggestion['id_produit'].'">
                        <img class="img-responsive" src="'.$suggestion['photo'].'"></a>
                         <div class="caption">
                            <h4  class="text-center">'.$suggestion['titre'].'</h4>
                        </div>
                    </div>    
            </div>'; 
                    
    }

}
else
{
    header('location:index.php');
    exit();
}

/* affichage de la confirmation de l'ajout de l'article au panier */
$popup='';
if ( isset($_GET['statut_produit']) && $_GET['statut_produit']=='ajoute' )
{
    $popup ='<div class="modal fade" id="myModal" role ="dialog">
                <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h4>Le produit à bien été ajouté au panier</h4>
                         </div>
                         <div class="modal-body">
                         <p><a href="panier.php">Voir le panier</a></p>
                         <p><a href="index.php">Continuer ses achats</a></p>
                          </div>
                     </div>
                </div>
            </div>';
}



require_once('inc/haut.php');
echo $popup;
?>
<div class="row">
    <?= $contenu;?>
</div>
<div class="row">
    <div class="col-sm-12">
        <h3 class="page-header">Suggestion de produits</h3>
    </div>
    <?=$aside ?>
</div>

<!-- eventuel html -->


<?php

require_once('inc/bas.php');
?>
<script>
    $(function(){
        $('#myModal').modal('show');
    });
</script>