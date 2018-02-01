
<?php

require_once('admin/init.php');

if ($_POST)
{
    if (!empty($_POST['email'])
    && !empty($_POST['objet'])
    && !empty($_POST['msg'])
    )
    {
        $email = htmlspecialchars($_POST['email']);
        $objet = htmlspecialchars($_POST['objet'], ENT_QUOTES);
        $message = htmlspecialchars($_POST['msg'],ENT_QUOTES);

        $req = $base->prepare("INSERT INTO messages VALUES(NULL,:email,:objet,:msg,NOW())");
        $req->execute(array('email'=> $email,
                            'objet'=>$objet,
                            'msg'=>$message));

    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cv Olivier Charpentier</title>
	<style>
			@import url('https://fonts.googleapis.com/css?family=Raleway');
	</style>
	<link rel="stylesheet" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/style.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
						<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#monmenu">
								<span class="sr-only">Naviguer</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
							<h1><a class="navbar-brand " href="">Olivier Charpentier</a></h1>	
						</div>
						<div class="collapse navbar-collapse" id="monmenu">
								<ul class="nav navbar-nav">
										<li><a class="" href="">Présentation</a></li>
										<li><a href="">Realisation</a></li>
										<li><a href="">Compétences</a></li>
										<li><a href="">Parcours</a></li>
										<li><a href="">Contact</a></li>
								</ul>
						</div>
				</div>
		</nav>
</header>
<main>
	<div class="">
	<div class="jumbotron">
  <h1>Developpeur Integrateur Web</h1>
  <img src="./images/fond5.png" class="img-responsive" alt="">
</div>
    
    
     
	</div>
	<div class="container">
	 	<div class="row presentation">
			<div class="col-md-12">
				<h2>Présentation</h2>
				<img class="imageronde col-md-2 col-sm-2 col-xs-3 img-responsive" src="images/Profil.png" alt="mon portrait"/>
				<p>
					Vous êtes à la recherche d'un developpeur pour gerer vos projets web?<br>
					Je peux renforcer votre equipe, autant sur la partie graphique que sur le developpement<br>
				</p>
			</div>
		</div>
		<div class="row">
			<h2>Compétences</h2>
			   <div class="col-md-3">
					<ul>
                        <?php

                        $competences = $base->query("SELECT * FROM competences limit 0,3");

                        while ( $competence = $competences->fetch(PDO::FETCH_ASSOC))
                        {
                            echo'<li>
							<h3>'.$competence['titre'].'</h3>
							<div class="jauge_fond">
                                <div class="jauge_couleur" style="background:
                                 '.$competence['couleur'].';width: '.$competence
                                 ['pourcentage'].'%">
								</div>
							</div>
						</li>';
                        }

                        ?>
						<!-- <li>
							<h3>Sourire le matin</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background: #87c6bf; width: 90%;">
								
								</div>
							</div>
						</li> -->
                    </ul>	
            </div>
            <div class="col-md-3">
					<ul>
                        <?php

                        $competences = $base->query("SELECT * FROM competences limit 3,6");

                        while ( $competence = $competences->fetch(PDO::FETCH_ASSOC))
                        {
                            echo'<li>
							<h3>'.$competence['titre'].'</h3>
							<div class="jauge_fond">
                                <div class="jauge_couleur" style="background:
                                 '.$competence['couleur'].';width: '.$competence
                                 ['pourcentage'].'%">
								</div>
							</div>
						</li>';
                        }

                        ?>
						<!-- <li>
							<h3>Sourire le matin</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background: #87c6bf; width: 90%;">
								
								</div>
							</div>
						</li> -->
                    </ul>	
            </div>
            
        </div>
        <div class="row">
			<h2>Mes languages favoris</h2>
			   
					
               <?php
                    $languages = $base->query("SELECT * FROM languages");

                    while ( $language = $languages->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<div class="col-md-3">
                        <img src="'.$language['image'].'" class="img-responsive"></div>';
                    }
                ?>
            
        </div>
        <div class="row">
				<div class="col-md-7">
                        <h2>Expériences</h2>
                        <?php
                    $experience = $base->query("SELECT * FROM experiences");

                    while ( $experiences = $experience->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<table>
                        <tr>
                            <td class="year" rowspan="2">
                                '.$experiences['annee_fin'].'
                                <p>'.$experiences['annee_debut'].'</p>
                            </td>
                            <td class="job">'.$experiences['titre'].'</td>
                        </tr>
                        <tr>
                            <td class="job_desc">'.$experiences['description'].'</td>
                        </tr>
                    </table>';
                    }
                ?>
						<!-- <table>
							<tr>
								<td class="year" rowspan="2">
									2010
									<p>2008</p>
								</td>
								<td class="job">Developpeur intégrateur web.</td>
							</tr>
							<tr>
								<td class="job_desc">Ceci est la description de mon travail dans cette entreprise</td>
							</tr>
						</table> -->
						
						
					</div>
					<div class="col-md-4">
                            <h2>Formation</h2>
                            
                            <?php
                    $formation = $base->query("SELECT * FROM formation order by annee desc");

                    while ( $formations = $formation->fetch(PDO::FETCH_ASSOC))
                    {
                        echo '<table>
                        <tr>
                            <td class="year" rowspan="2">
                                '.$formations['annee'].'
                            </td>
                            <td class="job">'.$formations['titre'].'</td>
                        </tr>
                        <tr>
                            <td class="job_desc">'.$formations['description'].'</td>
                        </tr>
                    </table>';
                    }
                ?>
							<!-- <table>
								<tr>
									<td class="year" rowspan="2">
										2017
									</td>
									<td class="job">Webforce3</td>
								</tr>
								<tr>
									<td class="job_desc">Ceci est la description de mon travail dans cette entreprise</td>
								</tr>
							</table> -->
						
						
						</div>
				</div>
		<div class="row">
				<h2>Réalisations</h2>
				<div class="col-md-4">
					<figure>
						<img src="images/image1.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4">
					<figure>
						<img src="images/image2.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4">
					<figure>
						<img src="images/image3.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
				<div class="row">
				<div class="col-md-4">
					<figure>
						<img src="images/image4.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4">
					<figure>
						<img src="images/image5.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4">
					<figure>
						<img src="images/image6.jpg" class="img-responsive" alt="Réalisation 1" />
						<figcaption>
							<h3>
								<a href="">Ma légende</a>
							</h3>
						</figcaption>
					</figure>
				</div>
			</div>
		</div><!-- fin de realisations -->
		<!-- fin de realisation -->
		<div class="row">
				<h2>Pour me contacter</h2>
			<div class="col-md-4 ">
            <form method="get" action="#" >
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Votre email ici..."/>
                
                <label for="objet">Objet</label>
                <input type="text" id="objet" name="objet" required placeholder="Votre objet ici..." />
                
                <label for="msg">Message</label>
                <textarea required name="msg" id="msg" placeholder="Votre message ici..."></textarea>
                
                <input type="submit" value="Envoyer" />
            </form>
				<!-- <form>
				<div class="form-group">
				  <label for="exampleInputEmail1">Email address</label>
				  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				</div>
				<div class="form-group">
				  <label for="exampleInputPassword1">Password</label>
				  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				
				<button type="submit" class="btn btn-default">Submit</button>
			  </form> -->
			</div>
		</div>
    </div><!-- Fin du container -->

    <div class="container"><a href="admin/index.php">Connexion admin</a></div>
</main>
	

<footer>
	<script src="./bootstrap-3.3.7-dist/css/bootstrap.min.css"></script> 
	<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script><!-- fichier jquery -->
  
</footer>
</body>
</html>