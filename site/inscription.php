<?php

require_once('inc/init.php');

$inscription = false; /* inscription pas faite, je m en sers pour afficher le formulaire */

if ( $_POST ){
    
    /* je poste mon formulaire d inscription */

    /* controles sur les champs */
    $champs_vides = 0;
    foreach ( $_POST as $indice => $valeur )
    {
        if( empty($valeur) )
        {
            $champs_vides++;
        }
    }

    if ($champs_vides > 0 )
    {
        $contenu .='<div class="alert alert-danger">Il y a '.$champs_vides.' information(s) manquante(s)</div>';
    }

    /* verifier qu une chaine contient des caracteres autorises */


    $verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
    $verif_codepostal = preg_match('#^[0-9]{5}$#',$_POST['code_postal']);

    /* expression regulieres */

   /*  - je delimite l expresion par le symbol # debut et fin
       - ^ signifie "commence par tout ce qui suit"
       - $ signifie "finit par tout ce qui precede"
       - [] pour delimiter les intervalles ( ici de a à z, de A à Z, de 0 à 9, et on ajoute ".","_" ou "-" )
       - le + pour dire que les caracteres sont acceptés de 0 à x fois
    */



    /* si tout va bien  */
    /* Je controle que le pseudo n existe pas deja dans la table */
    /* sinon j invite l internaute a changer de pseudo */

    /* si tout va bien */
    /* j insere le nouveau membre dans la table membre (avec statut = 0)*/
    /* je mets $inscription à true */

}

require_once('inc/haut.php');
echo $contenu;
if ( !$inscription ) :
?>
<!-- formulaire d inscription -->
<!-- champs a prevoir : pseudo,mdp,prenom,nom,email,civilite,ville,code postal,adresse -->

<div class="row">
<div class="container col-md-4 col-md-offset-4">
<h2 class="text-center">Inscription</h2>
<form method="post" action="">
  <div class="form-group">
    <label for="pseudo">Saisissez un pseudo</label>
    <input type="text" name="pseudo" class="form-control" id="pseudo" placeholder="pseudo" value="<?=$_POST['pseudo'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="mdp">Saisissez un mot de passe</label>
    <input type="password" name="mdp" class="form-control" id="mdp" placeholder="mot de passe" value="<?=$_POST['mdp'] ?? '' ?>">
  </div>
    <div class="form-group">
    <label for="prenom">Saisissez votre prenom</label>
    <input type="text" name="prenom" class="form-control" id="prenom" placeholder="prenom" value="<?=$_POST['prenom'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="nom">Saisissez votre nom</label>
    <input type="text" name="nom" class="form-control" id="nom" placeholder="nom" value="<?=$_POST['nom'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="email">Saisissez votre email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?=$_POST['email'] ?? '' ?>">
    </div>
    <label for="civilite">Civilité  </label>
    <div class="radio-inline">
    <label>
    <input type="radio" name="optionsRadios" id="optionsRadios1" value="m" <?= ( (isset($_POST['optionsRadios']) && $_POST['optionsRadios'] == 'm')
     || !isset($_POST['optionsRadios']) ) ? 'checked' : '' ?>>
    Mr
    </label>
    </div>
    <div class="radio-inline">
    <label>
    <input type="radio" name="optionsRadios" id="optionsRadios2" value="f" <?= ( (isset($_POST['optionsRadios']) && $_POST['optionsRadios'] == 'f')
     || !isset($_POST['optionsRadios']) ) ? 'checked' : '' ?>>
    Mme
    </label>
    </div>
    <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" name="ville" class="form-control" id="ville" placeholder="ville" value="<?=$_POST['ville'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="code postal">Saisissez votre code postal</label>
    <input type="text" name="code_postal" class="form-control" id="code_postal" placeholder="code postal" value="<?=$_POST['code_postal'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="adresse">Saisissez votre adresse</label>
    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="adresse" value="<?=$_POST['adresse'] ?? '' ?>">
    </div>
  
  <div class="form-group">
  <button type="submit" class="btn btn-default">Envoyer</button>
</form>
</div>
</div>

<?php
endif;

require_once('inc/bas.php');