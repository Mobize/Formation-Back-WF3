<?php

/* fonction de conversion Euros en dollars Americains*/

if(isset($_POST['valeur']) && !empty($_POST['valeur']))/* verifications */
{
function conversion($montant, $devise)
{
   $calcul = $montant * $devise; 
   return $calcul; 
}
$calcul = conversion($_POST['valeur'], 1.24597);
}

?>

<!-- debut du HTML -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice 2</title>
</head>
<body>
    <h3>Convertisseur d'Euros en Dollars Americains (exercice 2)</h3>
    <form action="" method="POST" name="form1">    <!-- Affichage du formulaire -->
        <input type="text" name="valeur" id="valeur" placeholder="chiffre en euros">
        <input type="submit" name="convertir" value="Envoyer">
    </form>

<?php

    if(isset($_POST['valeur']) && !empty($_POST['valeur']))/* verifications */
    {
        echo  '<h3>La conversion de ' . $_POST['valeur'].' Euros est egale à '.$calcul.' Dollar(s) americain</h3>'; /* Affichage du resultat */
    }
     

?>

</body>
</html>