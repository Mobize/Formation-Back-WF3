<?php
require_once('admin/init.php');
require_once('haut.php');


$contenu='';

/* suppression */

if( isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_vehicule']))
{ 
    
        $base->query("DELETE FROM vehicule WHERE id_vehicule = ".$_GET['id_vehicule']);
        $contenu .='<div class="alert alert-success">Le membre a été supprimé</div>';
    
}

/* ajout et modification */

if (isset($_POST['update']))
    {
        $champs = array();
        $params = array();
        

        foreach( $_POST as $index =>$valeur )
        {
            if ( $index != 'table' && $index !='update')
            {
               $champs[] = ':'.$index;
               $params[$index]=$valeur;     
            }
        }
       
        $maj = $base->prepare("REPLACE INTO vehicule VALUES(".implode(',',$champs).")" );
        $maj->execute($params);
    }

/* affichage du tableau des conducteurs */

$resul = $base->query("SELECT * FROM vehicule");

$contenu .="<h3>Véhicules</h3>";
$contenu .="<p>Nombre de Véhicule : ".$resul->rowCount()."</p>";
$contenu .="<table class='table-striped'>
            <tr>";

/* les en tetes */
for( $i=0; $i<$resul->columnCount() ; $i++)        
{
    $colonne = $resul->getColumnMeta($i);   
    
        $contenu .='<th>'.ucfirst($colonne['name']).'</th>';
    
} 

$contenu .='<th >Modifier</th>';
$contenu .='<th >Supprimer</th>';
$contenu .="</tr>";

/* les donnees */
while ( $ligne = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $contenu .='<tr>';
    foreach($ligne as $indice =>$information)
    {
            $contenu .="<td class='text-center'>".$information.'</td>';
    }
           
    $contenu .='<td><a href="?action=modifier&id_vehicule='.$ligne['id_vehicule'].'">modifier</a></td>';
            $contenu .='<td><a href="?action=suppression&id_vehicule='.$ligne['id_vehicule'].'"onclick=
            "return(confirm(\'Etes vous certain de vouloir supprimer ce membre :'.$ligne['id_vehicule'].'?\'))">Supprimer</a></td>';
            $contenu .='</tr>';

}

$contenu .='<table>';

 /* affichage des donnes pour modification */

   if ( !empty( $_GET['id_vehicule']) )
   {
        $resul = $base->prepare("SELECT * FROM vehicule WHERE id_vehicule=:id_vehicule");
        $resul->execute(array('id_vehicule' =>$_GET['id_vehicule']));
        $conducteur=$resul->fetch(PDO::FETCH_ASSOC);
   }
   echo $contenu;
?>
<div class="col-md-8">
<form method="post" action="">
<div class="form-group" action="">
  <label for="exampleInputEmail1">Marque</label>
  <input type="hidden" class="form-control" id="id_vehicule" name="id_vehicule" value="<?= $conducteur['id_vehicule'] ?? '' ?>">
  <input type="text" name="marque" class="form-control" id="marque" placeholder="marque" value="<?= $conducteur['marque'] ?? '' ?>">
</div>
<div class="form-group">
  <label for="exampleInputPassword1">Modele</label>
  <input type="text" name="modele" class="form-control" id="modele" placeholder="modele" value="<?= $conducteur['modele'] ?? '' ?>">
</div>
<div class="form-group">
  <label for="exampleInputPassword1">Couleur</label>
  <input type="text" name="couleur" class="form-control" id="couleur" placeholder="couleur" value="<?= $conducteur['couleur'] ?? '' ?>">
</div>
<div class="form-group">
  <label for="exampleInputPassword1">Immatriculation</label>
  <input type="text" name="immatriculation" class="form-control" id="immatriculation" placeholder="immatriculation" value="<?= $conducteur['immatriculation'] ?? '' ?>">
</div>
<button type="submit" name="update" class="btn btn-default">Valider</button>
</form>
</div>
<?php

?>

