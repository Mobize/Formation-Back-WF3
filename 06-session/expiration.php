<?php

session_start();

echo 'Temps actuel : '.time().'<br>';
print_r($_SESSION); /* print_r permet d afficher le contenu d une variable de type array */

if ( isset($_SESSION['temps']) )
{
    if (time() > ( $_SESSION['limite']+ $_SESSION['temps'] ) ) /* si l entree temps existe dans session */
    {
        session_destroy(); /*  si c est le cas, la page n a pas été rafraichie dans les 10 secondes, on detruit la session */
        echo 'expiration de la session';
    }
    else
    {
        $_SESSION['temps'] = time();
        echo 'connexion mis à jour : 10 secondes de plus !'; 
        unset($_SESSION['mdp']); 
    }
}
else
{
    echo " connexion";
    $_SESSION['limite'] = 10; /* je fixe le temps d inactivité (secondes) */
    $_SESSION['temps'] = time();
    $_SESSION['login'] = 'olivier';
    $_SESSION['mdp'] = 'secret';
}

/* 

Les informations d une session sont enregistrées coté serveur, 
cela crée dans le meme temps un cooki qui identifie la session: 
    PHPSESSID
sur le PC et navigateur du client.

Si l internaut supprime ses cookies, il casse le lien entre l id de la session et les infos stockées sur le serveur

En general sur les sites qui vous proposent une connection, il y a une session qui vous "garde" connecté à partir du moment
ou vous etes passés une fois par la porte d entrée ( vous vous etes identifiés ).

Avantages: vos infos de session sont conservées d une page a l autre du site.( exemple: on conserve son panier)

*/