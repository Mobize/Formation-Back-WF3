<?php

/* printf & sprintf*/

/* %s => string */
/* %f => float */
/* %d => integer */

$language ='php';

printf("Etude du language %s",$language);

echo'<br>';

$arg1 = "premier";
$arg2 ="deuxuieme";

printf("mon %s et mon %s",$arg1,$arg2);

echo'<br>';

$num =5;
$location = 'bananier';

echo sprintf('il y a %d singes dans le %s',$num,$location);
