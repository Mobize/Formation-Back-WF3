<?php

$prenom = array(
    'prenom'      =>'Olivier',
    'nom'         =>'Charpentier',
    'adresse'     =>'31 avenue des arts',
    'code postal' =>'93370',
    'telephone'   =>'06.22.02.41.73',
    'ville'       =>'Montfermeil',
    
  );
foreach( $prenom as $tableau1=>$tableau2)
{
  echo $tableau1.': '.$tableau2.'<br>';
}

?>