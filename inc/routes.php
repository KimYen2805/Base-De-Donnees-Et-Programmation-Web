<?php
	$routes = array(
		'afficher' => array('controleur' => 'controleurAfficher', 'vue' => 'vueAfficher'),
		'statistiques' => array('controleur' => 'controleurStatistiques', 'vue' => 'vueStatistiques'),
		'ajouter' => array('controleur' => 'controleurAjouter', 'vue' => 'vueAjouter'),
		'generer' => array('controleur' => 'controleurGenerer', 'vue' => 'vueGenerer')
	);

	// Fichiers statiques
	$pathHeader = 'static/header.php';
	$pathMenu = 'static/menu.php';
	$pathFooter = 'static/footer.php';
	$controleurAccueil = 'controleurAccueil';
	$vueAccueil = 'vueAccueil';
?>
