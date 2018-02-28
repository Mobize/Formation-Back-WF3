<?php

// On inclut les fichiers nécessaires
require_once 'inc/init.php';


if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])){
	$id = (int) $_GET['id'];

	$query = $dbh->prepare('SELECT * FROM movies WHERE id = :id');
	$query->bindValue(':id', $id, PDO::PARAM_INT);
	$query->execute();
	$movie = $query->fetch(PDO::FETCH_ASSOC);

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Détail d'un film</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<h1>Détail d'un film</h1>


	<?php if(!isset($movie) || empty($movie)): ?>
		<p class="errors">Ce film n'existe pas</p>
	<?php else: ?>
		<h2>Informations</h2>
		<ul>
			<li><strong>Titre :</strong> <?=$movie['title'];?></li>
			<li><strong>Réalisateur :</strong> <?=$movie['director'];?></li>
			<li><strong>Producteur :</strong> <?=$movie['producer'];?></li>
			<li><strong>Acteurs :</strong> <?=$movie['actors'];?></li>
			<li><strong>Années de production :</strong> <?=$movie['year_of_prod'];?></li>
			<!-- On récupère la valeur correspondante à la clé du tableau $languages ou $categories dans inc/datas.php -->
			<li><strong>Langue :</strong> <?=$languages[$movie['language']];?></li>
			<li><strong>Catégorie :</strong> <?=$categories[$movie['category']];?></li>
		</ul>

		<h2>Synopsis</h2>
		<p><?=$movie['storyline'];?></p>

		<h2>Bande annonce</h2>
		<p>
			<a href="<?=$movie['video'];?>" target="_blank">Voir la bande annonce</a>
		</p>

	<?php endif; ?>

</body>
</html>