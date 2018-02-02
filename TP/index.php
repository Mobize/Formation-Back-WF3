<?php

require_once('./inc/init.php');


require_once('./inc/haut.php');


        $table_courante='prog';
  
        $affichage='';

        $resul = $base->query("SELECT * FROM prog");

        $affichage.='';
        
        
             
            
            ob_start();
       
        /* lignes */
        while ($ligne = $resul->fetch(PDO::FETCH_ASSOC))
        {   
         ?>
         
         <div class="col-md-12">
            <h2>Nom du Programme</h2><?= $ligne['nom_du_programme'] ?>
        </div>
                <img src="<?= $ligne['image'] ?>">
                     <div class="col-md-3">
                        <h2>Description</h2><?= $ligne['description'] ?>
                    </div>
         <?php             
        }

        $affichage=ob_get_clean();
        echo $affichage; 
          

require_once('./inc/bas.php');


?>