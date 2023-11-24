<?php

/****************
Modifiez vos paramètres de connexion à la BD ci-dessous (dans le 'else', lignes 10 à 13)
****************/

if(file_exists('../projetBDW/config-bd.php'))  // fichier de configuration "privé" (enseignants)
	require('../projetBDW/config-bd.php');
else {
	define('SERVEUR', 'localhost');
	define('UTILISATRICE', 'p2019597'); // votre login, par exemple p1234567
	define('MOTDEPASSE', 'Gooey89Fender'); // votre mot de passe, par exemple Abcd12Efgh
	define('BDD', 'p2019597'); // votre BD, par exemple p1234567
}
?>
