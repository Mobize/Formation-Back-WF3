<?php

/* cerises : 5,76€/kg
   bananes : 1,09€/kg
   pommes  : 1,61€/kg
   peches  : 3,23€/kg

   ecrire la fonction calcul() qui renvoie la phrase:
   les <nom des fruits> coutent <resultat du calcul> € <pour poids> Kg
   Requis : utiliser un switch

   DRY : don't repeat yourself

*/

function calcul($fruits,$poids){
   
    switch($fruits)
    {
        
        case 'cerises' : $prix=5.76*$poids;
        break;

        case 'bananes' : $prix=1.09*$poids;
        break;

        case 'peches': $prix=3.23*$poids;
        break;

        case 'pommes': $prix=1.60*$poids;
        break;
        default: echo"fruit innexistant";
    }

       return "les $fruits coutent $prix € pour $poids Kg";
       
}


?>
