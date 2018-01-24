<?php

function estConnecte(){
    /*  la presence de l index membre dans la superglobale $_SESSION indique que le membre est connecté */
    if ( isset($_SESSION['membre']) ){
        return true;
    }
    else
    {
        return false;
    }
}

function estConnecteEtAdmin(){
    /* s'il est connecté ET que son statut vaut 1 c'est qu'il s agit d un admin*/
    if ( estConnecte() && $_SESSION['membre']['statut']==1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function executeRequete($sql, $params=array() ){
    if( !empty($params) )
    {
        foreach($params as $indice => $param )
        {
            $params[$indice] = htmlspecialchars($param, ENT_QUOTES);
        }
    }
    global $pdo;
    $r = $pdo->prepare($sql);
    $r->execute($params);

    if ( !empty($r->errorInfo()[2]) ){
        die('<p>Erreur rencontrée pendant la requête. Message: '.$r->errorInfo()[2].'<p>');
    }

    return $r; /*  on retourne l objet issu de la requete à l endroit ou la fonction a ete appelée */
}





function nbArticlePanier(){

}