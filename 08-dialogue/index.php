<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css">
    <title>Dialogue</title>
</head>
<body>
<?php
/*espace de dialogue

01. [x] modelisation et creation (base dialogue/table commentaire)
02. [x] connection à la base
03. [x] creer un formulaire HTML pour l ajout d un message (pseudo/message)
04. [x] recuperation et affichage des messages deja saisis
05. [x] requete d enregistrement (insert)
06. [x] Confirmation à l internaute (via $_POST)
07. [x] Attaque  :Injection SQL + XSS
08. [x] Etude et moyen pour contrer les attaques
09. [x] Ordonner et mettre les derniers messages en tete de liste
10. [ ] Afficher le nombre de messages
11. [ ] Ameliorer le visuel
12. [ ] Tests
*/    

$db = new PDO('mysql:host=localhost;dbname=dialogue',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'    
                ));

if( $_POST )
{
    if( !empty($_POST['pseudo']) && !empty($_POST['message']) ){
    $_POST['message'] = addslashes($_POST['message']);
        /* strip_tags() permet de supprimer toutes les balises html 
    $_POST['message'] = strip_tags($_POST['message']); 
    */

    /* htmlspecialchars() permet de rendre innofensives les balises html 
    $_POST['message'] = htmlspecialchars($_POST['message']);  
     */
    $sql = "INSERT INTO commentaire VALUE(NULL,'$_POST[pseudo]','$_POST[message]',NOW())";

     if($db->query($sql))
        {
            echo '<p class="info">Message enregistré</p>';
        }
    }
}                

?>
<div class="conteneur">
<form method="post" action="">
    <fieldset >
        <legend>Formulaire</legend>
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" value="<?=
        $_POST['pseudo'] ?? '' ?>">
        <br>
        <label for="message">Message</label><br>
        <textarea name="message" id="message" cols="40" rows="5"></textarea>
        <br>
        <input type="submit" value="Poster">
    </fieldset>    
</form>
</div>
<?php

$resultat = $db->query("SELECT * , 
                        DATE_FORMAT(date_enregistrement,'%d/%m/%Y') AS datefr, 
                        DATE_FORMAT(date_enregistrement,'%H:%i:%s') AS heurefr 
                        FROM commentaire
                        ORDER BY date_enregistrement DESC");

echo "<fieldset><legend>".$resultat->rowCount()." Messages</legend>";
while( $commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<div class="message">
                <div class="titre">Par : '.$commentaire['pseudo'].', le '.$commentaire['datefr'].' '.$commentaire['heurefr'].'</div> 
                <div class="contenu" id="contenu">'.$commentaire['message'].'</div>
         </div>';
}
echo "</fieldset>";

?>


</body>
</html>