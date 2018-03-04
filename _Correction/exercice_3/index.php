<!DOCTYPE html>
<html>
<head>
	<title>Faisons le ménage</title>
	<meta charset="utf-8">

<style>

#resultForm {
	margin-bottom: 10px;
}
label {
	display: inline-block;
	min-width: 150px;
}
input {
	margin-bottom: 5px;
}
.red {
	color: red;
}
.green {
	color: green;
}


</style>
</head>
<body>

	<h1>Ajout d'un véhicule</h1>
	<form method="POST">

		<div id="resultForm"><!-- Le retour ajax s'affichera dans cette div --></div>

		<div>
			<label for="brand">Marque :</label>
			<input type="text" name="brand" id="brand" required>
		</div>
		<div>
			<label for="model">Modèle :</label>
			<input type="text" name="model" id="model" required>
		</div>

		<div>
			<label for="year">Année :</label>
			<input type="text" name="year" id="year" required>
		</div>

		<div>
			<label for="color">Couleur :</label>
			<input type="text" name="color" id="color" required>
		</div>

		<div>
			<input type="submit" value="Envoyer">
	</form>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
$(function(){
	$('input[type="submit"]').click(function(e){
		e.preventDefault();
		$.ajax({
			url: 'inc/addCarAjax.php',
			type: 'post',
			cache: false,
			data: $('form').serialize(),
			dataType: 'json',
			success: function(result) {
				if(result.code == 'success'){
					$('#resultForm').html('<div class="green">'+result.msg+'</div>');
					$('input[type="text"]').val(''); // On vide les champs
				}
				else {
					$('#resultForm').html('<div class="red">'+result.msg+'</div>');

				}
			},
			error: function(err){
				// Si une erreur AJAX se produit
			}
		});
	});
});
</script>

</body>
</html>