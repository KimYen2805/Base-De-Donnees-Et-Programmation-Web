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

// Retourne les instances d'une table $nomTable
function getInstances($connexion, $nomTable) {
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// FONCTIONS PERSONNALISÉES

// Retourne la liste de chaque enfant et de son école actuelle
function getChildsAndSchool($connexion) {
	$requete = "SELECT I.nom, I.prénom, Ec.nom école FROM Inscrit I RIGHT OUTER JOIN École Ec ON I.idLieu= Ec.idLieu";
	$res = mysqli_query($connexion, $requete);
	$liste = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $liste;
}

// Retourne la liste des enfants avec le nom de la cantine où ils mangeront à la date précisée
function getChildsAndCanteen($connexion, $date) {
	$requete = "SELECT M.nom, M.prénom, E.nom_C cantine FROM `Manger` M NATURAL JOIN `Enfant` E WHERE dateC = '" . formatDate($date) . "'";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne la liste des enfants ayant le même nom et prénom, mais inscrits dans des écoles différentes
function getHomonymsAndSchool($connexion) {
	$requete = "SELECT I1.nom, I1.prénom , E.nom école FROM Inscrit I1 INNER JOIN Inscrit I2 INNER JOIN École E ON I1.nom = I2.nom AND I1.prénom = I2.prénom AND I1.idLieu != I2.idLieu WHERE I1.idLieu = E.idLieu";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Top-3 des départements ayant le plus de communes
function getTop3Departments($connexion) {
	$requete = "SELECT D.codeINSEE_2 codeINSEE, D.nom nomDépartement, COUNT(C.idCommune) nbCommunes FROM Département D LEFT JOIN Commune C ON D.codeINSEE_2 = C.codeINSEE_2 GROUP BY D.codeINSEE_2, D.nom ORDER BY nbCommunes DESC LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Top-3 des services les plus demandés (par les citoyens)
function getTop3RequestedServices($connexion) {
	$requete = "SELECT D.libellé, S.description, COUNT(E.idDemande) nbDemandes FROM Demande D JOIN Effectuer E ON D.idDemande = E.idDemande NATURAL JOIN Service S GROUP BY D.libellé ORDER BY nbDemandes DESC LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Top-3 des services les plus proposés (par les communes)
function getTop3OfferedServices($connexion) { // TODO : voir à quoi correspond nb
	$requete = "SELECT P.libellé,S.description, COUNT(P.idCommune) AS nbServices FROM Proposer P NATURAL JOIN  Service S WHERE P.libellé= S.libellé GROUP BY P.libellé ORDER BY nbServices DESC LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Top-3 des communes qui réalisent le plus d'unions.
function getTop3Municipalities($connexion) { // TODO : revoir la requête
	$requete = "SELECT C.idCommune, C.nom commune, COUNT(UC.idDemande) AS nbUnions FROM Commune C JOIN Proposer P ON C.idCommune = P.idCommune JOIN Service S ON P.libellé = S.libellé JOIN Demande D ON S.libellé = D.libellé JOIN Union_civile UC ON D.idDemande = UC.idDemande GROUP BY C.idCommune, C.nom ORDER BY nbUnions DESC LIMIT 3 ";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Transforme un objet date en format SQL
function formatDate($date) {
	$year = $date->format('Y');
	$month = $date->format('m');
	$day = $date->format('d');
	return "$year-$month-$day";
}

// Vérifie si les données fournies sont vides
function checkIfEmpty($data, $message) {
	if ($data == null || count($data) == 0) {
		echo($message);
		return true;
	}
	return false;
}

// Insère une nouvelle série nommée $nomSerie
// function insertSerie($connexion, $nomSerie) {
// 	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie); // au cas où $nomSerie provient d'un formulaire
// 	$requete = "INSERT INTO Series VALUES ('". $nomSerie . "')";
// 	$res = mysqli_query($connexion, $requete);
// 	return $res;
// }

// // Insère une nouvelle critique
// function insertCritique($connexion, $date, $pseudo, $texte, $nomSerie) {
// 	$pseudo = mysqli_real_escape_string($connexion, $pseudo); 
// 	$texte = mysqli_real_escape_string($connexion, $texte); 
// 	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie);
// 	$requete = "INSERT INTO Critiques VALUES (NULL,'" . $date . "','".  $pseudo . "','" . $texte . "','" . $nomSerie . "')";
// 	$res = mysqli_query($connexion, $requete);
// 	return $res;
// }

// Retourne les informations sur la série nommée $nomSerie
// function getSeriesByName($connexion, $nomSerie) {
// 	$nomSerie = mysqli_real_escape_string($connexion, $nomSerie); // sécurisation de $nomSerie
// 	$requete = "SELECT * FROM Series WHERE nomSerie = '". $nomSerie . "'";
// 	$res = mysqli_query($connexion, $requete);
// 	$series = mysqli_fetch_all($res, MYSQLI_ASSOC);
// 	return $series;
// }

// TODO : à tester
// function search($connexion, $table, $valeur) {
// 	$valeur = mysqli_real_escape_string($connexion, $valeur); // au cas où $valeur provient d'un formulaire
// 	if($table == 'Series')
// 		$requete = 'SELECT * FROM Series WHERE nomSerie LIKE \'%'.$valeur.'%\';';
// 	else  // $table == 'Actrices'
// 		$requete = 'SELECT * FROM Actrices WHERE nom LIKE \'%'.$valeur.'%\' OR prenom LIKE \'%'.$valeur.'%\';';
// 	$res = mysqli_query($connexion, $requete);
// 	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
// 	return $instances;
// }

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
// function getEpisodesPrepared($stmt, $numEpisode) {
// 	mysqli_stmt_bind_param($stmt, "i", $numEpisode); // lier la variable $var au paramètre de la requête
// 	mysqli_stmt_execute($stmt); // exécution de la requête
// 	$episodes = mysqli_stmt_get_result($stmt);  // récupération des tuples résultats dans la variable $episodes
// 	return $episodes;
// }

?>
