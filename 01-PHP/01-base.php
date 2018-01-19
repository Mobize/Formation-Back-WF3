    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Base du PHP</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
   
    <h2>Base du php</h2>
    <?php
    // Ceci est un commentaire sur une ligne

    /* 
    Ceci est un commentaire PHP
    sur plusieurs
    lignes    
    */

    echo '<strong>Bonjour le monde</strong><br>';   /* echo est une intruction qui nous permet d'effectuer un affichage */

    print 'Nous sommes Jeudi<br>';

    echo "<hr><h2>Variables : type, déclaration, affectation</h2>";

    $a = 127;
    echo' a est de type ';
    echo gettype($a);/* gettype est une fonction php qui renvoit le type de la variable entre les parentheses */

    $b= 'Bonjour';
    echo '<br> b est de type ';
    echo gettype($b);

    $c= true;
    echo '<br> c est de type ';
    echo gettype($c);

    echo '<br>a vaut $a <br>';
    echo "a vaut $a";/* entre guillemets les variables sont intrerprétées (affichées) */

    echo "<h2>Concatenation</h2>";
    echo ' a est de type :' . gettype($a);

    echo '<br>a vaut ' . $a . '<br>';

    echo '<br><input type="text" name="nom">';
    echo '<br>Aujourd \'hui'; /* Le caractere d echappement est l antislash \ */
    echo "<br>Aujourd 'hui"; 
    
    $prenon1="Jean";
    $prenom1="<br>Claire";
    echo $prenom1;
    $prenom2="<br>nicolas ";
    $prenom2.="Marie";
    echo $prenom2;

    $prenom='Olivier';
    echo '<br>Bonjour '.$prenom; /* Solution 1 */

    echo "Bonjour $prenom";/* Solution 2 */

    $prenom='Bonjour';
    $prenom.='Olivier';
    echo $prenom;/*  Solution 3 */

    echo '<h2>Constantes et Constantes magiques</h2>';
    define('CAPITALE','Paris'); /* Je definis une constante CAPITALE */
    echo CAPITALE.'<br>';
    /* define ('CAPITALE','Lyon'); je ne peux pas modifier ou redefinir une constante */
    
    /* Exemple de constante magiques */
    echo __FILE__;
    echo "<br>";
    echo __LINE__;
    echo "<br>";

    echo "<h2>Operateurs arithmétiques</h2>";

    $a=10;
    $b=2;

    echo $a + $b.'<br>';
    echo $a - $b.'<br>';
    echo $a * $b.'<br>';
    echo $a / $b.'<br>';
    /* OPeration + reafectation */

    $a +=$b; /* $a = $a + $b */
    echo $a . '<br>';
    $a -= $b; /* $a = $a - $b */
    echo $a . '<br>';
    $a++;/* J'Incremente de 1 => $a= $a+1; */
    echo $a . '<br>';
    $a += 2;
    echo $a . '<br>';
    $a--;/*  Je Decremente => $a = $a-1; */
    echo $a. '<br>';

    echo '<h2> Structures conditionnelles ( if /else ) - opérateurs de comparaison</h2>';

    /* isset et empty */
    $var1=0;
    $var2='';
    
    if ( empty($var1) ) echo '0, vide ou non definie<br>';
    if ( isset($var2) ) echo 'var2 existe et est definie par rien<br>';
    if ( isset($var3) ) echo 'var 3 est defini<br>';
    if ( empty($var3) ) echo 'vaut soit 0, soit est vide, soit n est pas defini<br>';

    /* empty verifie si la variable testée est :
                                                - non definie
                                                - définie à 0
                                                - vide
        isset verifie si la variable a éte definie (independamment de sa valeur)
        ex: empty nous permettra de tester si un champ de formulaire a été laissé vide
    */

    /* if, else, elseif */
    $a=10; $b=5; $c=2;
    if ( $a > $b ) {
        echo "a est superieur à b";
    }
    else{
        echo "a est inferieur à b";
    }

    echo'<br>';

    /* Equivalent */
    if ( $a > $b ) :
        echo "a est superieur à b";
    else:
        echo "a est inferieur à b";
    endif;    

    echo'<br>';

    /* condition et && */
    if ( $a > $b && $b > $c ){
        echo "Ok pour les 2 conditions<br>";
    }

    /* condition ou || */
    if ( $a==9 || $b > $c ){
        echo "Ok pour au moins une des conditions";
    }

    
    if ( $a==10 XOR $b==5 ){
        echo "Ok pour pour une des conditions seulement";
    }

    /* if forme contractée */
    echo'<br>';
    echo ( $a == 10 ) ? " a est egal à 10 " : " a n est pas egal à 10";

    echo'<br>';
   
    $var1 = isset($maVar) ? $maVar : 'valeur_par_defaut';
    echo $var1;

    echo'<br>';

    /* ternaire courte PHP 7 */
    $var2 = $maVar ?? 'valeur_par_defaut';
    echo $var2;
    /* equivalent $var2 = isset($maVar) ? $maVar : 'valeur par defaut'; */

    echo'<br>';

    $var3 = $maVar1 ?? $maVar2 ?? 'valeur par defaut'; /* evec cette formulation on affectera à var3 
    la premiere des valeurs definies (maVar1 ou maVar2) sinon ce sera la valeur par defaut */
    echo $var3;
   
    ?>
    <input type="text" value="<?= $_POST['email'] ?? '' ?>"name="email"> <!-- PHP 7 -->
    
    <?php
    echo '<br>';

    $a = 1;
    $b = "1";
    if( $a == $b )
    {
        echo "c'est la meme chose en valeur";
    }
    if( $a === $b )
    {
        echo "c'est la meme chose en valeur et en type";
    }
    /* 
        = affectation ex : $a = 5;
        == comparaison ex : $a == $b;
        === comparaison en valeur et en type ex: if ( $a === $b ) 
    */
    echo'<br>';

    if( !isset($var4) )
    {
        echo "var4 n'est pas definie";
    }

    echo'<br>';

    $a=5;
    $b=2;
    if( $a != $b)
    {
        echo ' a est different de b';
    }

    /* elseif */
    echo'<br>';
    $couleur="noir";

    if( $couleur== 'bleu' ){
        echo'vous aimez le bleu<br>';
    }
    elseif( $couleur=='rouge')
    {
        echo'vous aimez le rouge<br>';
    }
    else{
        echo'vous aimez ni le bleu ni le rouge';
    }

    echo '<h2>Conditions Switch</h2>';
    
    switch( $couleur ){

        case 'bleu' : echo'vous aimez le bleu<br>';
        break;

        case 'rouge' : echo'vous aimez le rouge<br>';
        break;

        case 'vert' : echo'vous aimez le vert<br>';
        break;

        default : echo'vous aimez ni le bleu ni le rouge ni le vert';
        break;
    }

    echo '<hr>';

    echo '<h2>Fonctions prédéfinies</h2>';

    echo 'Date: '.date('l d/m/Y');

    echo'<br>';

    /* mktime(0,0,0,1,1,2018) heure, minute, seconde, mois, jour, annee */
    /*echo date('l',mktime(0,0,0,1,1,2018));*/
    echo'<br>';
    echo 'le premier jour de l annee 2018 tombait un '.date('l',mktime(0,0,0,1,1,2018));
    echo'<br>';
    echo'maintenant :'.date('Y-m-d H:i:s'). ' et nous sommes en semaine '.date('W');
    echo'<br>';
    /* traitement de chine de caracteres */
    $email = 'prenom@site.fr';
    echo strpos($email,'@');/* strpos indique la positio du caractere @ dans la chaine $email (calculer p=0) */
    echo'<br>';
    $email2='bonjour';
    echo strpos($email2,'@');
    if( strpos($email2,'@'))
    {
        echo "Le signe @dans la chaine $email2 se trouve à la position ".strpos($email2,'@')."<br>";
    }
    else
    {
        echo "je nai pas trouvé de signe @ dans $email2 <br>";
    }

    var_dump(strpos($email2,'@') );
    echo'<br>';
    $i = 6; var_dump($i);
    echo'<br>';
    $j = "bonjour"; var_dump($j);

    echo'<br>';

    $phrase = 'ici je mets une super phrase assez longue';
    echo strlen($phrase);
    echo'<br>';
    $texte='Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Aenean volutpat tellus vitae odio molestie interdum. Quisque 
    condimentum nibh vitae pulvinar viverra. Morbi quam diam, mattis 
    eget turpis id, dignissim elementum elit. Praesent sed placerat ex, 
    a semper mauris. Mauris blandit metus justo, ac vehicula augue ullamcorper 
    sit amet. Nam ultricies eu libero in dignissim. Suspendisse suscipit libero 
    in arcu tempor placerat. Aenean et metus ultricies, sagittis ante fringilla,
     vulputate velit. Pellentesque vel ultrices lorem. Interdum et malesuada fames
      ac ante ipsum primis in faucibus. Nulla ullamcorper massa nulla, sed 
      venenatis nisl euismod ut. Pellentesque et massa vitae justo accumsan hendrerit vel ut nisi';

      echo substr($texte,0,20). '...<a href="">lire la suite</a>';
    /* extrait une sous chaine de la chaine $texte en partant de la position 0 et sur une longueur de 20 caracteres. */
    echo'<br>';
    echo '<hr>';
    echo "<h2>Fonctions utilisateur</h2>";

    function vdm($var){
       echo"<pre>";
       var_dump($var);
       echo"</pre>";
    }

    function br()
    {
        echo '<br>';
    }
   
    vdm($texte);

    function separation(){
        return '<hr>';
    }
    echo separation();

    function hello($qui){
        return 'bonjour '.$qui.'!';
    }

    $prenom = 'Chloe';
    $nom    ='olivier';
    echo hello($prenom);
    echo '<br>';
    echo hello($nom);

    function appliqueTva($nombre){
        return $nombre*1.2;
    }
    function appliqueTva2($nombre, $taux=1.2){
    return $nombre*$taux;
    }

    echo '<br>';
    echo "10 euros avec tva à 20% font ".appliqueTva(10)."€ <br>";
    echo "100 euros avec tva à 20% font ".appliqueTva(100)."€ <br>";
    echo "100 euros avec tva à 5.5% font ".appliqueTva2(100,1.055)."€ <br>";

    echo appliqueTva2(100); echo '<br>';
    echo appliqueTva2(100,1.055);
    echo '<br>';
    
    function jourSemaine(){
        $jour = 'lundi';
        return $jour;
        echo "allo"; /* cette commande se situant apres le return ne sera pas executée */
    }
    
    /* echo $jour; ne fonctionne pas car la variable jour n'est connue que dans la fonction */
    $recup = jourSemaine();
    echo $recup;

    echo '<br>';

    $pays = 'France';
    function affichePays(){
        global $pays;/* Je globalise la variable $pays dans la fonction car elle fait parti de l environnement global*/
        echo $pays.' '.CAPITALE;/* Une constante est d office globalisée */
    }
    affichePays();

    echo '<br>';

    function facultatif()
    {
        //vdm( func_get_args() );
        /* func_get_args() est une commande qui crée un tableau
         associatif avec les arguments fournis à la fonction dans laquelle je l appelle */
        foreach( func_get_args() as $indice =>$element )
        {
            echo $indice . ' ->'.$element . '<br>';
        }
    }

    facultatif();
    facultatif('France','Italie');
    facultatif(1,2,3);

    echo "<hr><h2>Structures iteratives : boucles</h2>";

    /* boucle while */
    $i=0;/* situation de depart */
    while( $i < 3 )/* tant que la condition est vraie je boucle */
    {
        echo "$i --";
        $i++;/* variation de 1 (ne pas oublié l incrementation ! plantage de navigateur!*/
    }

    echo '<br>';
    echo separation();

    $i=0;
    while( $i <= 10)
    {
        echo $i .'<br>';
        $i+=2;
    }

    echo '<br>';
    echo separation();

    /* boucle for */

    for($j=0 ; $j<=10 ; $j++)
    {
        echo $j.'#';
    }

    ?>
    <br>
-------------------------------------------------------------
    <br>
    <!-- 1ere version -->

    <select>
    <option value="1">selectionnez</option>
        
    <?php
    for($i=date('Y')-1; $i>= 1950; $i--)
    {
        echo '<option value>'. $i .'</option>';
    }
    ?>
     </select>
     <br>

----------------------------------------------------------
    <br>
    <!-- 2eme version -->

    <label for="Année">Année</label> 
    <select name="année">
    <?php for ( $a = date('Y'); $a >= 1950; $a--): ?>
        <option value="<?=$a ?>"><?=$a?></option>
    <?php endfor;?>
    </select>    
    <br>
----------------------------------------------------------
<br>
    <table>
        <?php
        $compteur=0;
         for($o=1; $o<=20; $o++){
         echo '<tr>';
            for ($i=1; $i<=15; $i++)
            {
                $compteur++;
                echo '<td>'.$compteur.'</td>';
            }
         echo '</tr>';
            }
        ?>   
    </table>

---------------------------------------------------------
<br>
<form action="#" method="post">
<input type="text" name="ligne">
<input type="text" name="colonne">
<input type="submit" name="valider">
</form>
<?php

if( !empty($_POST)) {
    echo "je rentre dans le if<br>";
    echo "si POST n'est pas vide => ca veut dire que post contient les données du formulaire => j'ai appuyé sur le bouton valider";
   
    vdm($_POST);
    $lignes=$_POST["ligne"];
    $colonnes=$_POST["colonne"];
   ?>
    <table>
        <?php 
        $compteur=0;
        for($ligne=1; $ligne<=$lignes; $ligne++) :?>
            <tr>
            <?php
            for($colonne=1; $colonne<=$colonnes; $colonne++):
                $compteur++;
                ?>
                <td><?= $compteur ?></td>
                <?php
            endfor;?>
            </tr>
            <?php
        endfor;
        ?>    
    </table>
        
    <?php
}
echo "<h2>Inclusion de fichiers</h2>";

echo "premiere fois<br>"; 
include('exemple.php');
echo "<br>";
/*
echo "deuxieme fois<br>"; 
include_once('exemple.php');
echo "<br>";

echo "troisieme fois<br>";
require('exemple.php');
echo "<br>";

echo "quatrieme fois";
require_once('exemple.php');
echo '<br>';
*/

echo '<h2>Tableaux de données : ARRAY</h2>' ;

$liste = array('Ruben','Hamid','Moundir','olivier','Romain');

vdm($liste);

$fruits = array();
$fruits[] = 'pomme';
$fruits[] = 'poire';
$fruits[] = 'orange';

vdm($fruits);

$fruits2 = array('pm'=>'pomme','pr'=>'poire','og'=>'orange');
vdm($fruits2);

$fruits2[] ='cerise';
$fruits2['bn'] ='banane';
vdm($fruits2);

$fruits2['pm'] ='peche';
vdm($fruits2);

$fruits2[] ='kiwi';
vdm($fruits2);

$fruits2[99] ='clementine';
$fruits2[] = 'raisin';
vdm($fruits2);

/*  boucle foreach */

foreach($fruits2 as $info)
{
    echo $info.'-';
}
echo '<hr>';

foreach( $fruits2 as $indice => $valeur)
{
    echo "a l'indice $indice je trouve $valeur<br>";
}
/*
 syntaxe : foreach ( nomtableauaparcourir as index=> valeur ) 
           foreach ( nomtableauaparcourir as valeur)
*/
echo '<hr>';

/* Tableau multi dimensionnel */

$superheros = array(

                    'Superman'=> array(
                                'nom'=>'Kent',
                                'prenom'=>'Clark',
                                'Univers'=> 'DC Comics'),

                    'Spiderman'=> array(
                                'nom'=>'Parker',
                                'prenom'=>'Peter',
                                'Univers'=> 'DC Comics'),

                    'Batman'=> array(
                                'nom'=>'Wayne',
                                'prenom'=>'Bruce',
                                'Univers'=> 'marvel'),

                    'Ironman'=> array(
                                'nom'=>'Stark',
                                'prenom'=>'Tony',
                                'Univers'=> 'Marvel'),                              
                    
                    );
/* vdm($superheros);*/
echo count($superheros);
echo '<br>';
echo sizeof($superheros);
echo '<br>';
/* count() et sizeof() indiqunet tous deux le nombre d entrés dans le tableau */

echo $superheros['Batman']['prenom'];
echo '<br>';
echo $superheros['Spiderman']['Univers'];
echo '<br>';

foreach($superheros as $nomsuper=>$tabsuper)
{
    echo '<p>'.$nomsuper.'<p>';
    foreach($tabsuper as $info=>$valeur2){
        echo $valeur2;
    }
};

vdm($fruits2);

$fruit3 = array('pomme','cerise', 'orange');

$nbelements= count($fruit3);

for( $i=0; $i<$nbelements; $i++)
{
    echo $fruit3[$i].'-';
};


echo '<h2>Objets</h2>';

class Etudiant
{
    public $prenom = 'JUlien';
    public $age = 25;
    public function pays(){
        return 'France';
    }
}

$objet = new Etudiant;
vdm($objet);

vdm(get_class_methods($objet));
h();
echo $objet->age;
h();
br();
echo $objet->pays();

function h()
{
    echo '<hr>';
};




?>



    <!-- <?='allo'?> --> <!--  revient à < ?  php echo -->
    
    </body>
    </html>

