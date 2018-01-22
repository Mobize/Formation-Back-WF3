<!doctype html>
<html>
	<head>
	    <!--Metadonnées-->
		<meta charset="utf-8" />
		<title>CV</title>
		<meta name="descritption" content="ma description" />
		<meta name="keywords" content="mots clés" />
		<style>
			@import url('https://fonts.googleapis.com/css?family=Raleway');
		</style>
	
		<!--Fichier CSS-->
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" href="./style.css" />
	</head>
	<body>
		<!--presentation / realisation / parcours / contact -->
		<header>
			<div class="conteneur">
				<div class="bloc40">
					<h1><a href="index.html">Olivier</a></h1>
				</div>
				<div class="bloc60">
					<nav class="ligne">
						<a href="#link1">Présentation</a>
						<a href="#link2">Réalisation</a>
						<a href="#link3">Parcours</a>
						<a href="#link4">Contact</a>
					</nav>
				</div>
				<div class="clear"></div>
			</div>
		</header>
		<section id="section1">
		<div id="link1"></div>
			<div class="conteneur ligne" ><!-- 2 classes differentes "conteneur" et "ligne" -->
				<div class="bloc70">
					<h2>Présentation</h2>
					<img class="imageronde" src="images/avatar.png" alt="mon portrait"/>
					<p>
						Vous êtes à la recherche d'un developpeur pour gerer vos projets web?<br>
						Je peux renforcer votre equipe, autant sur la partie graphique que sur le developpement.<br>
						
					</p>
				</div>
				<div class="bloc30">
					<h2>Compétences</h2>
					<ul>
						<li>
							<h3>Sourire le matin</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background:#87c6bf; width:90%;" >
								</div>
							</div>
						</li>
						<li>
							<h3>Faire le café</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background:#1054bf; width:60%;" >
								</div>
							</div>
						</li>
						<li>
							<h3>Rentrer tard</h3>
							<div class="jauge_fond">
								<div class="jauge_couleur" style="background:#8787bf; width:30%;" >
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="bloc100 ligne">
					<h2>Mes langages favoris</h2>
					<div class="bloc25">
						<img src="images/css.jpg"/>
					</div>
					<div class="bloc25">
						<img src="images/html.jpg"/>
					</div>
					<div class="bloc25">
						<img src="images/php.jpg"/>
					</div>
					<div class="bloc25">
						<img src="images/mysql.jpg"/>
					</div>
				</div>
			</div>
		</section>
		<section id="section2">
		<div id="link2"></div>
			<div class="conteneur ligne">
				<h2>Réalisation</h2>
				<div class="bloc33">
					<figure>
			<img src="images/image1.jpg" alt="realisation1"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>
				</div>
				<div class="bloc33">
					<figure>
			<img src="images/image2.jpg" alt="Golde Gate"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>
				</div>
				<div class="bloc33">
					<figure>
			<img src="images/image3.jpg" alt="Golde Gate"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>		
				</div>
				<div class="bloc33">
					<figure>
			<img src="images/image1.jpg" alt="realisation1"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>
				</div>
				<div class="bloc33">
					<figure>
			<img src="images/image2.jpg" alt="Golde Gate"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>
				</div>
				<div class="bloc33">
					<figure>
			<img src="images/image3.jpg" alt="Golde Gate"/>
			<figcaption>
				<h3>
					<a href="">Ma légende</a>
				</h3>
			</figcaption>
		</figure>		
				</div>
			</div>
		</section>
	<section id="section3">
	<div id="link3"></div>
			<div class="conteneur ligne">
				<div class="bloc66"> 
					<h2>Experiences</h2>
					<table>
						<tr>
							<td class="year" rowspan="2">2010
							<p>2008</p></td>
							<td class="job">Developpeur integrateur web</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail en entreprise</td>
						</tr>
					</table>
					<table>
						<tr>
							<td class="year" rowspan="2">2010
							<p>2008</p></td>
							<td class="job">Developpeur integrateur web</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail en entreprise</td>
						</tr>
					</table>
				</div>
				<div class="bloc33">
					<h2>Formation</h2>
					
					<table>
						<tr>
							<td class="year" rowspan="2">2017</td>
							<td class="job">Webforce 3</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail en entreprise</td>
						</tr>
					</table>
					
					<table>
						<tr>
							<td class="year" rowspan="2">2017</td>
							<td class="job">Webforce 3</td>
						</tr>
						<tr>
							<td class="job_desc">Ceci est la description de mon travail en entreprise</td>
						</tr>
					</table>
				</div>
			</div>
		</section>
		<section id="section4">
		<div id="link4"></div>
			<div class="conteneur ligne">
				<div class="bloc50">
					<h2>Contact</h2>
					<p>Olivier Charpentier</p>
					<p>31 avenue des arts 93370 Montfermeil</p>
					<p>Tel: 06.22.02.41.73</p>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.173959860322!2d2.5555433160656906!3d48.89302177929091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6117895b7f4b5%3A0x4d8a311fc4adb5f7!2s31+Avenue+des+Arts%2C+93370+Montfermeil!5e0!3m2!1sfr!2sfr!4v1513093804348" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="bloc50">
					<h2>Formulaire direct:</h2>
					<form method="POST" action="" enctype="multipart/form-data">
						<label for="objet">Objet:</label>
						<input type="objet" name="objet" id="objet" required placeholder="saisissez votre objet"/>
						<label for="monemail">Votre email:</label>
						<input type="email" name="email" id="monemail" required placeholder="saisissez votre e-mail"/>
						<p>
						<label for="texte">Message:</label>
						<textarea id="texte" name="texte" placeholder="saisissez votre message" required></textarea></p>
						
						<input type="submit" name="envoyer" value="Envoyer" /> 
					</form>
					<h2>Ou:</h2>
					<A HREF="mailto:olivier.charpentier@icloud.com" class="email" >olivier.charpentier@icloud.com</A>
				</div>
			</div>
		</section><footer>
			<div class="conteneur">
			Bas de page
			</div>
		</footer>
	</body>
</html>

<?php

var_dump($_POST);

if( $_POST ){
    $expediteur = 'From:'.$_POST['email'];
    $destinataire = 'agnesolivier@gmail.com';
    $sujet = $_POST['objet'];
    $message = $_POST['texte'];

    mail($destinataire,$sujet,$message,$expediteur);
}




?>

