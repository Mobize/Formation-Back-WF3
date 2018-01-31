
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    

<?php

/* PDO : Php Data Object */

echo "<h2>01- PDO: Connexion</h2>";

$pdo = new PDO('mysql:host=localhost;dbname=boutique',
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

   $resul=$pdo->exec("DELETE FROM employes WHERE id_employes=1004"); 
   echo $resul;/* vaut 1 au premier affichage  puis 0 si je rafraichis*/
    
   /* pdo->exec execute une requete directe (insert,update,delete) */
   /* si je stocke l execution dans une variable (ex: resul), il
      contiendra le nombre de lignes affectés par la requete */

  echo"<h2>03 - PDO: Select</h2>";

$resul = $pdo->query("SELECT * FROM employes WHERE prenom='daniel'");

echo '<pre>';
var_dump($resul);
var_dump(get_class_methods($resul) );
echo'<pre>';

$employe_daniel = $resul->fetch(PDO::FETCH_ASSOC);

/* var_dump($employe_daniel); */

echo "Bonjour, je suis ".$employe_daniel['prenom'].' '.$employe_daniel['nom'].' du service '.$employe_daniel['service'].'<br>';

/* $pdo est un objet(1) issu de la classe predefinie PDO 
Quand on execute une requete de selection via la methode query()
sur l objet PDO, on obtient un autre objet(2) issu de la classe PDOstatement qui a ses propres propriétés et methodes.

Si on execute une requete de type insert, update, delete avec query() au lieu
de exect() on obtient un booleen.*/

echo'<hr>';

/* select avec plusieurs resultats  */
$resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

echo 'Nombre de commerciaux : '.$resul->rowCount().'<br>';

while( $contenu = $resul->fetch(PDO::FETCH_ASSOC) )
{
    echo $contenu['prenom'].' '.$contenu['nom'].'('.$contenu['sexe'].')<br>';
}

/* select tableau multidimensionnel */

 $resul = $pdo->query("SELECT * FROM employes WHERE service='commercial'");

$donnees = $resul->fetchAll(PDO::FETCH_ASSOC);
echo'<pre>';
var_dump($donnees);
echo'</pre>';

foreach($donnees as $indice1=>$contenu1)
{
    echo'<div class="madiv">';
    foreach($contenu1 as $indice2=>$contenu2)
    {
        echo"$indice2 : $contenu2<br>";
    }
    echo'</div>';
} 

echo'<hr>';
?>

<?php

$resul1 = $pdo->query("SHOW DATABASES");

$allBdd = $resul1->fetchAll(PDO::FETCH_ASSOC);


foreach($allBdd as $oneBase)
{
    echo'<ul>';
    foreach($oneBase as $nameBase)
    {
        echo "<li>$nameBase</li>";
    }
    echo'</ul>';
}


/* BONUS */

$resul = $pdo->query("SHOW DATABASES");

echo"<ul>";
while($base = $resul->fetch(PDO::FETCH_ASSOC) )
{
    $database = $base['Database'];
    echo'<li>'.$database."<ul>";
        $pdo->exec("USE `$database`");
        $resul2 = $pdo->query("SHOW TABLES");
        while( $table = $resul2->fetch(PDO::FETCH_ASSOC) )
        {
            echo "<li>".$table['Tables_in_'.$database]."</li>";
        }
        echo"</ul></li>";
}
echo"</ul>";

/* parcours de table */

$pdo->exec('USE bibliotheque');
$nomtable = "livre";
$resul = $pdo->query("SELECT * FROM ".$nomtable);
echo"<table><tr>";

/* generer les entetes de colonnes */
$nbcolones= $resul->columnCount(); /* columnCount() renvoie le nombre de colonnes */
for( $i=0; $i < $nbcolones; $i++){
    $infocolone = $resul->getColumnMeta($i);
    /* getColumnMeta(index) envoie les informations d une colonne comme son type son nom et sa longueur
    Dans notre exemple c'est l'index "name" qui nous interesse */
    echo '<th>'.$infocolone['name'].'</th>';
}
echo"</tr>";

/* parcours des enregistrements */
while($ligne = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
        foreach($ligne as $information){
            echo"<td>$information</td>";
        }
    echo"</tr>";
}

echo"</table>";

echo"<hr>";

$pdo->exec('USE entreprise');
$nomtable = "employes";
$resul = $pdo->query("SELECT * FROM ".$nomtable);
echo"<table><tr>";

/* generer les entetes de colonnes */
$nbcolones= $resul->columnCount();
for( $i=0; $i < $nbcolones; $i++){
    $infocolone = $resul->getColumnMeta($i);
    echo '<th>'.$infocolone['name'].'</th>';
}
echo"</tr>";

/* parcours des enregistrements */
while($ligne = $resul->fetch(PDO::FETCH_ASSOC))
{
    echo "<tr>";
        foreach($ligne as $information){
            echo"<td>$information</td>";
        }
    echo"</tr>";
}

echo"</table>";


echo "<h2>PDO : prepare, bindParam, BindValue, execute</h2>";

$pdo->exec('USE entreprise');
$nom = 'sennard';

$resul = $pdo->prepare("SELECT * FROM employes where nom = :nom");
$resul->bindParam(':nom',$nom,PDO::PARAM_STR);/* bindParam recoit exclusivement une variable */
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);

echo'<br>';

$nom = 'thoyer';

$resul = $pdo->prepare("SELECT * FROM employes where nom = :nom");
$resul->BindValue('nom','thoyer',PDO::PARAM_STR);/* bindValue recoit une variable ou une chaine de caractere */
$resul->execute();
$donnees = $resul->fetch(PDO::FETCH_ASSOC);
echo implode(' ',$donnees);
?>

</body>
</html>