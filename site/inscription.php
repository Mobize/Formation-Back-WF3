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
       - le + pour dire que la chaine peut faire de 1 à n caractères
            + equivalent de {1,}
            ? equivalent de {0,1}
            * equivalent de {0,}
            {5} 5 précisement
            {3,15} de 3 à 15 caractères

    */

    if ( !$verif_caractere ){
        $contenu .='<div class="alert alert-danger">Le pseudo doit contenir 3 à 15 caractères (lettres de a à z, chiffres de 0 à 9, _.-)</div>';
    }

    if ( !$verif_codepostal){
        $contenu .='<div class="alert alert-danger">Le code postale n\'est pas correct</div>';
    }


    if ( $_POST['civilite'] !='m' && $_POST['civilite'] !='f' )
    {
        $contenu.='<div class="alert alert-danger">De quel genre etes vous?</div>';
    }

    /* astuce de controle d email avec filter_var, fonction qui verifie la chaine de caractere par rapport à un format */
    if ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) )
    {
        $contenu .='<div class="alert alert-danger">Adresse email invalide</div>';
    }



    /* si tout va bien  */
    /* Je controle que le pseudo n existe pas deja dans la table */
    /* sinon j invite l internaute a changer de pseudo */

    $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo",array('pseudo' =>$_POST['pseudo']));
    if ( $membre->rowCount() > 0 )
    {
        $contenu .='<div class="alert alert-danger">Pseudo indisponible, merci d\'en choisir un autre</div>';
    }


    /* si tout va bien */
    /* j insere le nouveau membre dans la table membre (avec statut = 0)*/
    /* je mets $inscription à true */

    if ( empty($contenu))
    {
        executeRequete("INSERT INTO membre VALUES ( NULL,:pseudo,:mdp,:nom,:prenom,:email,:civilite,:ville,:code_postal,:adresse,0)",
         array( 'pseudo' => $_POST['pseudo'],
                'mdp' => MD5($_POST['mdp']),
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'civilite' => $_POST['civilite'],
                'ville' => $_POST['ville'],
                'code_postal' => $_POST['code_postal'],
                'adresse' => $_POST['adresse']           
                ));
                $contenu.='<div class="alert alert-success">Vous çetes inscrit sur notre site.
                            <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
                $inscription = true;
    }
    

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
    <input type="radio" name="civilite" id="optionsRadios1" value="m" <?= ( (isset($_POST['civilite']) && $_POST['civilite'] == 'm')
     || !isset($_POST['civilite']) ) ? 'checked' : '' ?>>
    Mr
    </label>
    </div>
    <div class="radio-inline">
    <label>
    <input type="radio" name="civilite" id="optionsRadios2" value="f" <?= ( (isset($_POST['civilite']) && $_POST['civilite'] == 'f')
     || !isset($_POST['civilite']) ) ? : '' ?>>
    Mme
    </label>
    </div>
    <div class="form-group">
    <label for="ville">Ville</label>
    <input type="text" name="ville" class="form-control" id="ville" placeholder="ville" value="<?=$_POST['ville'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="code postal">Saisissez votre code postal</label>
    <input type="text" name="code_postal" class="form-control" id="code_postal" maxlength="5" placeholder="code postal" value="<?=$_POST['code_postal'] ?? '' ?>">
    </div>
    <div class="form-group">
    <label for="adresse">Saisissez votre adresse</label>
    <input type="text" name="adresse" class="form-control" id="adresse" placeholder="adresse" value="<?=$_POST['adresse'] ?? '' ?>">
    </div>
  
  <div class="form-group">
  <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</div>
</div>

<?php
endif;

require_once('inc/bas.php');