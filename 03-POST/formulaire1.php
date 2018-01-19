<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire 1</title>
    <style>p{color:blue;font-family:tahoma;}</style>
</head>
<body>
    
    <h1>Formulaire</h1>
    <pre>
    <?php
    /* var_dump($_POST); */
    if ( $_POST && empty($_POST['prenom']) )
    {
        echo "<p>Veuillez saisir un prenom valide</p><hr>";
    }

    if ( $_POST && empty($_POST['nom']) )
    {
        echo "<p>Veullez saisir un nom</p>";
    };

    /* implode, explode, extract */

    $parametres = implode('#',$_POST);
    var_dump($parametres);

    $date ='19/01/2018';
    $date_tableau = explode('/',$date);
    var_dump($date_tableau);

    $csv = 'champ1;champ2;champ3';
    $tab = explode(";",$csv);
    var_dump($tab);

    var_dump($_POST);
    extract($_POST);
    
    



    ?>
    </pre>
    <form method="post" action="">
        <label for="prenom">Prénom :</label>
        
        <input type="text" name="prenom" id="prenom" placeholder="votre prenom" value="<?= $prenom ?? ''; ?>">
        <!--  isset($_POST['prenom']) ? $_POST['prenom'] : '';-->
        <br>
        <label for="nom">nom :</label>
        <input type="text" name="nom" id="nom" value="<?= $nom ?? ''; ?>">
        <br>
        <br>
        <label for="message">Message</label>
        <textarea name="message" id="message"  placeholder="ici" cols="40" rows="5"><?= $message ?? ''; ?></textarea>
        <br>
        <br>    
        <input type="submit" value="valider">

    </form>

</body>
</html>