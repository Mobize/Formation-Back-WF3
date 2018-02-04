<?php

require_once('../inc/init.php');

if ( !estConnecteEtAdmin() )
{
    header('location:../connexion.php'); /* si pas admin, redirection vers la page connexion */
    exit();
}


/* change statut */

if ( isset($_GET['action']) && $_GET['action'] =='changestatut' && !empty($_GET['id_membre']) )
{
    if ( $_GET['id_membre'] != $_SESSION['membre']['id_membre'])
    {
        
        $resul = executeRequete("SELECT statut FROM membre WHERE id_membre= :id_membre",array('id_membre'=>$_GET['id_membre']));
        $membre = $resul->fetch(PDO::FETCH_ASSOC);
        $newStatut = ($membre['statut']==0) ? 1 : 0;

        executeRequete("UPDATE membre SET statut=:newstatut WHERE id_membre=:id_membre",
        array('id_membre'=>$_GET['id_membre'],
                'newstatut'=>$newStatut));
        $contenu .='<div class="alert alert-success">Le statut du membre à été modifié</div>';        
    }
}



/* suppression */
if( isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_membre']))
{
    if ( $_GET['id_membre'] !=$_SESSION['membre']['id_membre'])
    {   
        executeRequete("DELETE FROM membre WHERE id_membre= :id_membre",array('id_membre'=> $_GET['id_membre']));
        $contenu .='<div class="alert alert-success">Le membre a été supprimé</div>';
    }
}





/* creer un tableau html qui liste tout les membres ( sauf le mot de passe ) */

$resul = executeRequete("SELECT * FROM membre");

$contenu .="<h3>Affichage des membres</h3>";
$contenu .="<p>Nombre de membres : ".$resul->rowCount()."</p>";
$contenu .="<table class='table-striped'>
                <tr>";
/* les en tetes */
for( $i=0; $i<$resul->columnCount() ; $i++)        
{
    $colonne = $resul->getColumnMeta($i);   
    if ( $colonne['name'] !='mdp')
    {
        $contenu .='<th>'.ucfirst($colonne['name']).'</th>';
    }
} 
$contenu .='<th colspan="2">Actions</th>';
$contenu .="</tr>";
/* les donnees */
while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';
    foreach($ligne as $indice =>$information)
    {
        if ( $indice !='mdp'){
            $contenu .="<td class='text-center'>".$information.'</td>';
        }
    }
    if ( $ligne['id_membre'] != $_SESSION['membre']['id_membre'])
    {
    $type_action = ($ligne['statut']==0 ? 'promouvoir' : 'Dégrader');
    $contenu .='<td><a href="?action=changestatut&id_membre='.$ligne['id_membre'].'">'.$type_action.'</a>';
    
    $contenu .='<td><a href="?action=suppression&id_membre='.$ligne['id_membre'].'"onclick=
    "return(confirm(\'Etes vous certain de vouloir supprimer ce membre :'.$ligne['nom'].'?\'))">Supprimer</a></td>';
    }
    $contenu .='</tr>';
}
$contenu .='<table>';


require_once('../inc/haut.php');
echo $contenu;
require_once('../inc/bas.php');

?>

