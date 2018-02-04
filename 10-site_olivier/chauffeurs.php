<?php
require_once('admin/init.php');
require_once('haut.php');


$contenu='';

/* suppression */

if( isset($_GET['action']) && $_GET['action'] == 'suppression' && !empty($_GET['id_conducteur']))
{ 
    
        $base->query("DELETE FROM conducteur WHERE id_conducteur = ".$_GET['id_conducteur']);
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
       
        $maj = $base->prepare("REPLACE INTO conducteur VALUES(".implode(',',$champs).")" );
        $maj->execute($params);
    }

/* affichage du tableau des conducteurs */

$resul = $base->query("SELECT * FROM conducteur");

$contenu .="<h3>Conducteurs</h3>";
$contenu .="<p>Nombre de conducteurs : ".$resul->rowCount()."</p>";
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
           
    $contenu .='<td><a href="?action=modifier&id_conducteur='.$ligne['id_conducteur'].'">modifier</a></td>';
            $contenu .='<td><a href="?action=suppression&id_conducteur='.$ligne['id_conducteur'].'"onclick=
            "return(confirm(\'Etes vous certain de vouloir supprimer ce membre :'.$ligne['nom'].'?\'))">Supprimer</a></td>';
            $contenu .='</tr>';

}

$contenu .='<table>';

 /* affichage des donnes pour modification */

   if ( !empty( $_GET['id_conducteur']) )
   {
        $resul = $base->prepare("SELECT * FROM conducteur WHERE id_conducteur=:id_conducteur");
        $resul->execute(array('id_conducteur' =>$_GET['id_conducteur']));
        $conducteur=$resul->fetch(PDO::FETCH_ASSOC);
   }
   echo $contenu;
?>
<div class="col-md-8">
<form method="post" action="">
<div class="form-group" action="">
  <label for="exampleInputEmail1">nom</label>
  <input type="hidden" class="form-control" id="id_conducteur" name="id_conducteur" value="<?= $conducteur['id_conducteur'] ?? '' ?>">
  <input type="text" name="nom" class="form-control" id="exampleInputEmail1" placeholder="nom" value="<?= $conducteur['nom'] ?? '' ?>">
</div>
<div class="form-group">
  <label for="exampleInputPassword1">Prenom</label>
  <input type="text" name="prenom" class="form-control" id="exampleInputPassword1" placeholder="prenom" value="<?= $conducteur['prenom'] ?? '' ?>">
</div>
<button type="submit" name="update" class="btn btn-default">Valider</button>
</form>
</div>
<?php

?>

