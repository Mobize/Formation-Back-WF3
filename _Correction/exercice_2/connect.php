<?php

// On vérifie que le nom de base de données correspond, mais également le nom d'utilisateur et mot de passe
$db = new PDO('mysql:host=localhost;dbname=exo1_userslist;charset=utf8', 'root', '');