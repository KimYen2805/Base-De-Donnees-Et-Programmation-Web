<?php

if(file_exists('../serial-critique-private/config-bd.php'))  // fichier de configuration "privé" (enseignants)
	require('../serial-critique-private/config-bd.php'); // ?
else {
	define('SERVEUR', 'localhost');
	define('UTILISATRICE', 'p2309122'); 
	define('MOTDEPASSE', 'Strum18Fabric'); 
	define('BDD', 'p2309122'); 	
}
?>
