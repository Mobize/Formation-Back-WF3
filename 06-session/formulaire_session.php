<?php


/* 

    créer un formulaire pour demander le pseudo à l'internaute.
    Quand il valide son pseudo, on garde l'information en session
    Quand il revient sur la page, on lui indique "Votre pseudo est <pseudo>"
    et on n'affiche plus le formulaire.
    Ne pas enregistrer d information si le pseudo est vide

*/

    session_start();

   

    if( $_POST && !empty($_POST['pseudo']) )
    {
        
        $_SESSION['pseudo'] = $_POST['pseudo'];
    }
    if( isset($_SESSION['pseudo']) )
    {
        echo 'Votre pseudo est :'.$_SESSION['pseudo'];
          
    }
    else
    {
        ?>
                 <form action="" method="post">
                 <label for="pseudo" >Votre pseudo</label>
                 <input type="text" name="pseudo" id="pseudo">
                 <input type="submit" value="envoyer">
                 </form>
        <?php
    }
    

/*    session_destroy();
        header('location: formulaire_session.php'); */

