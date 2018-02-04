<?php
require_once('admin/init.php');
require_once('haut.php');


$contenu='';

/* suppression */

if( isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_association']))
{ 
    
        $base->query("DELETE FROM association_vehicule_conducteur WHERE id_association = ".$_GET['id_association']);
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
       
        $maj = $base->prepare("REPLACE INTO association_vehicule_conducteur VALUES(".implode(',',$champs).")" );
        $maj->execute($params);
    }

/* affichage du tableau des conducteurs */

$resul = $base->query("SELECT * FROM association_vehicule_conducteur");

$contenu .="<h3>Association Véhicules Conducteurs</h3>";
$contenu .="<p>Nombre d'associations : ".$resul->rowCount()."</p>";
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
           
    $contenu .='<td><a href="?action=modifier&id_association='.$ligne['id_association'].'">modifier</a></td>';
            $contenu .='<td><a href="?action=suppression&id_association='.$ligne['id_association'].'"onclick=
            "return(confirm(\'Etes vous certain de vouloir supprimer ce membre :'.$ligne['id_association'].'?\'))">Supprimer</a></td>';
            $contenu .='</tr>';

}

$contenu .='<table>';

 /* affichage des donnes pour modification */

   if ( !empty( $_GET['id_association']) )
   {
        $resul = $base->prepare("SELECT * FROM association_vehicule_conducteur WHERE id_association=:id_association");
        $resul->execute(array('id_association' =>$_GET['id_association']));
        $conducteur=$resul->fetch(PDO::FETCH_ASSOC);
   }
   echo $contenu;
?>
<div class="col-md-8">
<form method="post" action="">
<div class="form-group" action="">
  <label for="exampleInputEmail1">Conducteur</label>
  <input type="hidden" class="form-control" id="id_association" name="id_association" value="<?= $conducteur['id_association'] ?? '' ?>">



   <select class="form-control" name="id_association" id="conducteur">
   <?php
   $resul = $base->query("SELECT * FROM association_vehicule_conducteur");
   while($conducteur=$resul->fetch(PDO::FETCH_ASSOC))
   {
   echo '<option value="">Conducteur n°: '.$conducteur['id_association'].'</option>';
   }
   ?>
   </select>

   <select class="form-control" name="id_association" id="conducteur">
   <?php
   $resul = $base->query("SELECT * FROM association_vehicule_conducteur");
   while($conducteur=$resul->fetch(PDO::FETCH_ASSOC))
   {
   echo '<option value="">Véhicule n°: '.$conducteur['id_vehicule'].'</option>';
   }
   ?>
   </select>

   <!-- <select class="form-control" name="vehicule" id="vehicule">
    <option value=""></option>
   </select> -->




  <input type="text" name="id_vehicule" class="form-control" id="id_vehicule" placeholder="id_vehicule" value="<?= $conducteur['id_vehicule'] ?? '' ?>">
</div>
<div class="form-group">
  <label for="exampleInputPassword1">Vehicule</label>
  <input type="text" name="id_conducteur" class="form-control" id="id_conducteur" placeholder="id_conducteur" value="<?= $conducteur['id_conducteur'] ?? '' ?>">
</div>
<button type="submit" name="update" class="btn btn-default">Valider</button>
</form>
</div>
<?php

?>

