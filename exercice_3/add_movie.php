<?php

// On inclut les fichiers nécessaires
require_once 'inc/init.php';


// On instancie nos variables
$errors = array();

if(!empty($_POST)){ // Si la super-globale $_POST n'est pas vide, le formulaire a été soumis

	// On réécrit $_POST qui contiendra les valeurs nettoyées de notre formulaire 
	foreach($_POST as $index => $value)
	{
	$_POST[$index] = htmlspecialchars($value, ENT_QUOTES);
	}
		

	if(strlen($_POST['title']) < 5){
		$errors[] = 'Le titre doit comporter au moins 5 caractères';
	}

	if(strlen($_POST['actors']) < 5){
		$errors[] = 'Le nom des acteurs doit comporter au moins 5 caractères';
	}

	if(strlen($_POST['director']) < 5){
		$errors[] = 'Le nom du réalisateur doit comporter au moins 5 caractères';
	}

	if(strlen($_POST['producer']) < 5){
		$errors[] = 'Le nom du producteur doit comporter au moins 5 caractères';
	}

	if(empty($_POST['year_of_prod'])){
		$errors[] = 'L\'année de production est vide !';
	} 
	elseif(!is_numeric($_POST['year_of_prod']) ){
		$errors[] = 'L\'année de production est invalide';
	}

	if(strlen($_POST['storyline']) < 5){
		$errors[] = 'Le synopsis doit comporter au moins 5 caractères';
	}

	if(!filter_var($_POST['video'], FILTER_VALIDATE_URL)){
		$errors[] = 'L\'URL de la bande annonce est invalide';
	}


	if(count($errors) === 0){

		$query = $dbh->prepare('INSERT INTO movies(title, actors, director, producer, year_of_prod, language, category, storyline, video) 
		VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video);');
		
		/*
		$query->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
		$query->bindValue(':actors', $_POST['actors'], PDO::PARAM_STR);
		$query->bindValue(':director', $_POST['director'], PDO::PARAM_STR);
		$query->bindValue(':producer', $_POST['producer'], PDO::PARAM_STR);
		$query->bindValue(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT);
		$query->bindValue(':language', $_POST['language'], PDO::PARAM_STR);
		$query->bindValue(':category', $_POST['category'], PDO::PARAM_STR);
		$query->bindValue(':storyline', $_POST['storyline'], PDO::PARAM_STR);
		$query->bindValue(':video', $_POST['video'], PDO::PARAM_STR);
		*/
		
		if($query->execute( array ('title' => $_POST['title'],
								   'actors' => $_POST['actors'],
								   'director' => $_POST['director'],
								   'producer' => $_POST['producer'],
								   'year_of_prod' => $_POST['year_of_prod'],
								   'language' => $_POST['language'],
								   'category' =>  $_POST['category'],
								   'storyline' => $_POST['storyline'],
								   'video' =>  $_POST['video']) ) )	{								   
			echo '<p class="success">Le film a bien été ajouté !</p>';
			}
			
	}
	else 
	{
		echo '<p class="errors">'.implode('<br>', $errors).'</p>';
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter un film</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<h1>Ajouter un film</h1>
	<form method="post">
		
		<div class="input-group">
			<label for="title">Nom du film :</label>
			<input type="text" name="title" id="title">
		</div>

		<div class="input-group">
			<label for="actors ">Acteurs :</label>
			<input type="text" name="actors" id="actors">
		</div>

		<div class="input-group">
			<label for="director">Réalisateur :</label>
			<input type="text" name="director" id="director">
		</div>

		<div class="input-group">
			<label for="producer">Producteur :</label>
			<input type="text" name="producer" id="producer">
		</div>

		<div class="input-group">
			<label for="year_of_prod">Année de production :</label>
	
			<select name="year_of_prod" id="year_of_prod">
				<option value="" selected disabled>-- Sélectionnez --</option>
				<!-- On part de l'année en cours et on boucle sur 100 ans en décrémentant -->
				<?php for($i=date('Y');$i>=date('Y')-100;$i--): ?>
					<option value="<?=$i;?>"><?=$i;?></option>
				<?php endfor;?>
			</select>
		</div>

		<div class="input-group">
			<label for="language">Langue du film :</label>
	
			<select name="language" id="language">
				<option value="" selected disabled>-- Sélectionnez --</option>
				<!-- On réutilise notre array() ci-dessus -->
				<?php foreach($languages as $key => $value): ?>
					<option value="<?=$key;?>"><?=$value;?></option>
				<?php endforeach;?>
			</select>
		</div>

		<div class="input-group">
			<label for="category">Catégorie du film :</label>
	
			<select name="category" id="category">
				<option value="" selected disabled>-- Sélectionnez --</option>
				<!-- On réutilise notre array() ci-dessus -->
				<?php foreach($categories as $key => $value): ?>
					<option value="<?=$key;?>"><?=$value;?></option>
				<?php endforeach;?>
			</select>
		</div>

		<div class="input-group">
			<label for="storyline">Synopsis :</label>
			<textarea name="storyline" id="storyline"></textarea>
		</div>

		<div class="input-group">
			<label for="video">Bande annonce (vidéo) :</label>
			<input type="url" name="video" id="video">
		</div>

		<button type="submit">Envoyer</button>

	</form>


</body>
</html>