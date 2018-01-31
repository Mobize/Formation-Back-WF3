<?php

require_once('inc/init.php');

/* traitement */
if ( isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    /* session_destroy(); */
    unset($_SESSION['membre']);
}

if ( estConnecte() ){
    header('location:profil.php'); /* renvoie une entete au client pour demander la page profil */
    exit(); /* puis je quitte le script */
}

if ( $_POST ) /* if( !empty($_POST) ) */
{
    $motdepassecrypte = md5($_POST['mdp']); /* je crypte le mot de passe saisi pour le comparer a la version cryptee du mot de passe enregistrée en base */

    /* requete de selection pour verifier que le membre existe et qu il a saisi correctement ses identifiants */
    $sql = "SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp";
    $resul = executeRequete( $sql, array('pseudo' => $_POST['pseudo'],
                                            'mdp' => $motdepassecrypte));

    if ( $resul->rowCount() ==1 ){
        /* si j'ai un resultat égal a 1 c est que j ai trouvé un membre qui a ce login et ce mot de passe */
        $membre = $resul->fetch(PDO::FETCH_ASSOC);
        $_SESSION['membre'] = $membre;
        header('location:profil.php');
        exit();
    }
    else{
        $contenu .='<div class="bg-danger">Erreur sur les identifiants</div>';
    }

}

require_once('inc/haut.php');
echo $contenu;
?>
<!-- exercice créér le formulaire de connexion -->

<div class="row">
<div class="container col-md-4 col-md-offset-4">
<h2 class="text-center">Connexion</h2>
<form method="post">
  <div class="form-group ">
    <label for="text1">Pseudo :</label>
    <input type="text" name="pseudo" class="form-control" id="text1" placeholder="Pseudo">
  </div>
  <div class="form-group">
    <label for="password1">Mot de passe :</label>
    <input type="password" name="mdp" class="form-control" id="password1" placeholder="Mot de passe">
  </div>
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
</div>
<?php

require_once('inc/bas.php');