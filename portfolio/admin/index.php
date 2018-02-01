<?php




require_once('init.php'); /* j inclus mon fichier init avec la connexion a la base de donnee */

if ( isset($_POST['connexion'] ) )
{
    /* j ai cliqué sur" me connecter" */
    if ( !empty($_POST['login']) && !empty($_POST['pwd']) )
    {
        $resul = $base->prepare("SELECT * FROM user WHERE login=:login AND password=:password");/* j envoie ma requete */

        $resul->execute(array('login'=>$_POST['login'],'password'=> sha1($_POST['pwd'])));

        if ($resul->rowCount() == 1)
        {
            $_SESSION['user'] = $_POST['login'];
        }
        else
        {
            echo" erreur sur les identifiants";
        }
    }
}




if ( isset($_SESSION['user']) )
{
    /* je suis connecte et j'accede a mon back office */
    

    $tables_a_exclure=" 'user','message' ";

    $mestables = $base->query("SHOW TABLES WHERE Tables_in_portfolio NOT IN (".$tables_a_exclure.")");
    while( $matable = $mestables->fetch(PDO::FETCH_ASSOC))
    {
        echo '<a href="?table='.$matable['Tables_in_portfolio'].'">'.ucfirst($matable['Tables_in_portfolio']).'</a>     ';
    }
    echo"<hr>";

    if (!empty($_GET['table']) )
    {
        $table_courante=$_GET['table'];

        /* affichage */
        /* formulaire */

        $affichage='';
        $formulaire='';

        $resul = $base->query("SELECT * FROM ".$table_courante);

        $affichage.='<table><tr>';
        $nbcolonnes=$resul->columnCount();


        $formulaire.='<hr><form action="" method="post">
                        <input type="hidden" name="table" value="'.$table_courante.'">';

        for( $i=0; $i<$nbcolonnes; $i++)
        {

            $info_colonne=$resul->getColumnMeta($i);
            if ($i == 0){
                $indice_table = $info_colonne['name'];
                $formulaire.='<input type="hidden" name="indice" value="0">';
            }
            $affichage .='<th>'.$info_colonne['name'].'</th>';
            if ($i!=0){
            $formulaire.='<p><label for="'.$info_colonne['name'].'">'.$info_colonne['name'].'</label>';

            if ( $info_colonne['name'] =='description')
            {
                $formulaire.='<textarea name="'.$info_colonne['name'].'" cols="40"
                rows="5"></textarea></p>';
            }
            else
            {
                $formulaire.='<input type="text" id="'.$info_colonne['name'].'"
                name="'.$info_colonne['name'].'" value=""></p>';
            }
        }       
            
        }
        $affichage.='<th colspan="2">Actions</th>';
        $affichage.='</tr>';
        $formulaire.='<input type="submit" name="update" value="Valider">
                        </form>';
       
        /* lignes */
        while ($ligne = $resul->fetch(PDO::FETCH_ASSOC))
        {
            $affichage .='<tr>';
            foreach( $ligne as $information )
            {
                $affichage.='<td>'.$information.'</td>';
            }
            $affichage.='<td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table].'&action=modifier">Modifier</td>
                         <td><a href="?table='.$table_courante.'&'.$indice_table.'='.$ligne[$indice_table]
                         .'&action=supprimer" onclick="return(confirm(\'etes vous certain de vouloir supprimer cette ligne?\'))">Supprimer</td>';
            $affichage.='</tr>';
            
        }

        $affichage.='</table>';
        echo $affichage;
        echo $formulaire;
    }


}
else
{
    /* sinon je ne suis pas encore connecte et j affiche le formulaire */
    ?>  
<form action="" method="post">
<label for="login">Login</label>
<input type="text" name="login" id="login">
<label for="pwd">Password</label>
<input type="password" name="pwd" id="pwd">

<input type="submit" name="connexion" value="Me connecter">

</form>
<?php
}


