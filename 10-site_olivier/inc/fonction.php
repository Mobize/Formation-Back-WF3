<?php


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