<?php
// On renverra du JSON
header('Content-Type: application/json');

// On inclu la connexion SQL
require_once 'connect.php';


$post = [];
$errors = [];

if(!empty($_POST)){

	$post = array_map('trim', array_map('strip_tags', $_POST));

	// On effectue les vérifications du formulaire
	// Il est évidemment possible d'effectuer des vérifications plus poussées (par exemple : longueur de chaine, etc.) 
	if(empty($post['brand'])){
		$errors[] = 'La marque du véhicule est invalide';
	}

	if(empty($post['model'])){
		$errors[] = 'Le modèle du véhicule est invalide';
	}

	if(empty($post['year']) || !is_numeric($post['year'])){
		$errors[] = 'L\'année du véhicule est invalide';
	}

	if(empty($post['color'])){
		$errors[] = 'La couleur du véhicule est invalide';
	}

	if(count($errors) === 0){

		// Il n'y a pas d'erreurs, on stock en SQL
		$insert = $dbh->prepare('INSERT INTO vehicles(brand, model, year, color) VALUES(:brand, :model, :year, :color)');
		$insert->bindValue(':brand', $post['brand']);
		$insert->bindValue(':model', $post['model']);
		$insert->bindValue(':year', $post['year'], PDO::PARAM_INT);
		$insert->bindValue(':color', $post['color']);

		if($insert->execute()){
			// On créer un tableau, celui ci nous permettra de gérer notre affichage ensuite
			$json = [
				'code'  => 'success',
				'msg'	=> 'Le véhicule a été ajouté avec succès',
			];
		}
		else {
			var_dump($insert->errorInfo());
		}
	}	
	else {
		$json = [
			'code' => 'errors', 
			'msg'  => implode('<br>', $errors),
		];
	}


	// On envoi le tout en JSON
	echo json_encode($json);

}