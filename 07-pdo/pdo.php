<?php

/* PDO : Php Data Object */

echo "<h2>01- PDO: Connexion</h2>";

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'    
                ));
  echo "<h2>02 - PDO: Insert,Update,Delete</h2>";
  /*
  $pdo->exec("INSERT INTO employes VALUES (NULL,'test','test','M','commercial','2018-01-22',500)");
  echo 'dernier id ajouté :'.$pdo->lastInsertId();
  $dernier_id=$pdo->lastInsertId();

  $pdo->exec("UPDATE employes SET salaire=1400 WHERE id_employes=".$dernier_id);*/

  echo"<h2>03 - PDO: Select</h2>";