<?php
spl_autoload_register(function($class){
	require_once 'class/'.$class.'.php';
});


$cat_1 = new Chat('Sashimi', 10, 'Gris', 'male', 'Persan');


echo '<strong>Chat 1</strong>';
echo '<ul>';
foreach($cat_1->getInfos() as $info){
	echo '<li>'.$info.'</li>';
}
echo '</ul>';


$cat_2 = new Chat('Sushi', 1, 'Noire', 'femelle', 'Gouttière');
echo '<strong>Chat 2</strong>';
echo '<ul>';
foreach($cat_2->getInfos() as $info){
	echo '<li>'.$info.'</li>';
}
echo '</ul>';




$cat_3 = new Chat('Yakitori', 5, 'Gris', 'male', 'Asiatique');
echo '<strong>Chat 3</strong>';
echo '<ul>';
foreach($cat_3->getInfos() as $info){
	echo '<li>'.$info.'</li>';
}
echo '</ul>';