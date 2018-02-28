<?php

// On inclut les fichiers nécessaires
require_once 'inc/init.php';

$movies = $dbh->prepare('SELECT id, title, director, year_of_prod FROM movies');
$movies->execute();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Liste des films</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<h1>Liste des films</h1>

	<table>

		<thead>
			<tr>
				<th>Nom du film</th>
				<th>Producteur</th>
				<th>Année de production</th>
				<th>Détails</th>
			</tr>
		</thead>

		<tbody>
		<?php if($movies->rowCount() == 0 ): // S'il n'y a pas de film ?>
			<tr>
				<td colspan="4" class="errors center">Aucun film correspondant</td>
			</tr>
		<?php else: ?>
			<?php while($movie = $movies->fetch(PDO::FETCH_ASSOC)): ?>
				<tr>
					<td><?=$movie['title'];?></td>
					<td><?=$movie['director'];?></td>
					<td><?=$movie['year_of_prod'];?></td>
					<td>
						<a href="view_movie.php?id=<?=$movie['id'];?>">Plus d'infos</a>
					</td>
				</tr>
			<?php endwhile; ?>
		<?php endif; ?>
		</tbody>
	</table>

</body>
</html>