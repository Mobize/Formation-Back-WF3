<?php

require_once('inc/init.php');
require_once('inc/haut.php');

/* Génération des categories pour alimenter le contenu gauche */

/* Affichage des produits pour alimenter le contenu droite en tenant compte dun eventuel choix de categories */

?>
<div class="row">
    <div class="col-md-3">
        <?= $contenu_gauche ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <?= $contenu_droite ?>
        </div>
    </div>
</div>




<?php

require_once('inc/bas.php');