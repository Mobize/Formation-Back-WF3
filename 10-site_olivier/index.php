<?php

include_once('inc/init.php');
include_once('inc/fonction.php');
include_once('inc/haut.php');

$resul = executeRequete("SELECT * FROM conducteur ");
$membre = $resul->fetch(PDO::FETCH_ASSOC);

echo '<h3>Affichage des Conducteurs</h3>
        <table class="table-striped">';
            

while($membre = $resul->fetch(PDO::FETCH_ASSOC))
{
    for( $i=0; $i<$resul->columnCount() ; $i++) 
    {
        $colonne = $resul->getColumnMeta($i);
        '<th>'.ucfirst($colonne['name']).'</th>';
    }
    /* echo '<tr>'.$membre['id_conducteur'].$membre['prenom'].$membre['nom'].'</tr>'; */
    
}

echo'</table>';


include_once('inc/bas.php');