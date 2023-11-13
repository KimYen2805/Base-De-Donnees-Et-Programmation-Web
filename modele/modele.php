<?php 

// Connexion à la BD, retourne un lien de connexion
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	mysqli_query($connexion,'SET NAMES UTF8'); // noms en UTF8
	return $connexion;
}

// Déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

// Nombre d'instances d'une table $nomTable
function countInstances($connexion, $nomTable) {
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	if($res != FALSE) {
		$row = mysqli_fetch_assoc($res);
		return $row['nb'];
	}
	return -1;  // valeur négative si erreur de requête (ex, $nomTable contient une valeur qui n'est pas une table)
}

// Eetourne les instances d'une table $nomTable
function getInstances($connexion, $nomTable) {
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne les informations sur la série nommée $nomSerie
function getSeriesByName($connexion, $nomSerie) {
	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie); // sécurisation de $nomSerie
	$requete = "SELECT * FROM Series WHERE nomSerie = '". $nomSerie . "'";
	$res = mysqli_query($connexion, $requete);
	$series = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $series;
}

// Insère une nouvelle série nommée $nomSerie
function insertSerie($connexion, $nomSerie) {
	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie); // au cas où $nomSerie provient d'un formulaire
	$requete = "INSERT INTO Series VALUES ('". $nomSerie . "')";
	$res = mysqli_query($connexion, $requete);
	return $res;
}

// // Insère une nouvelle critique
// function insertCritique($connexion, $date, $pseudo, $texte, $nomSerie) {
// 	$pseudo = mysqli_real_escape_string($connexion, $pseudo); 
// 	$texte = mysqli_real_escape_string($connexion, $texte); 
// 	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie);
// 	$requete = "INSERT INTO Critiques VALUES (NULL,'" . $date . "','".  $pseudo . "','" . $texte . "','" . $nomSerie . "')";
// 	$res = mysqli_query($connexion, $requete);
// 	return $res;
// }

// TODO : à tester
function search($connexion, $table, $valeur) {
	$valeur = mysqli_real_escape_string($connexion, $valeur); // au cas où $valeur provient d'un formulaire
	if($table == 'Series')
		$requete = 'SELECT * FROM Series WHERE nomSerie LIKE \'%'.$valeur.'%\';';
	else  // $table == 'Actrices'
		$requete = 'SELECT * FROM Actrices WHERE nom LIKE \'%'.$valeur.'%\' OR prenom LIKE \'%'.$valeur.'%\';';
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// // Prépare la requête qui retourne les épisodes
// function prepareRequeteEpisodes($connexion) {
// 	$requete = "SELECT titre FROM Episodes WHERE numero = ?";
// 	$stmt = mysqli_prepare($connexion, $requete);
// 	if($stmt == false) {
// 		return null;
// 	}
// 	return $stmt;
// }

// Retourne les instances d'épisodes numérotés $id avec une requête préparée // TODO : à tester
function getEpisodesPrepared($stmt, $numEpisode) {
	mysqli_stmt_bind_param($stmt, "i", $numEpisode); // lier la variable $var au paramètre de la requête
	mysqli_stmt_execute($stmt); // exécution de la requête
	$episodes = mysqli_stmt_get_result($stmt);  // récupération des tuples résultats dans la variable $episodes
	return $episodes;
}

?>
