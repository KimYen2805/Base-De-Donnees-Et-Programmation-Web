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

// Retourne les instances d'une table de façon triée
function getInstancesSorted($connexion, $nomTable, $attribut, $ordre) {
	$requete = "SELECT * FROM $nomTable ORDER BY $attribut $ordre";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne la liste de chaque enfant et de son école actuelle
function getChildsAndSchool($connexion) {
	$requete = "SELECT I.nom, I.prénom, Ec.nom école FROM Inscrit I RIGHT OUTER JOIN École Ec ON I.idLieu= Ec.idLieu";
	$res = mysqli_query($connexion, $requete);
	$liste = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $liste;
}

// Retourne la liste des enfants avec le nom de la cantine où ils mangeront à la date précisée
function getChildsAndCanteen($connexion, $date) {
	$requete = "SELECT M.nom, M.prénom, E.nom_C cantine FROM `Manger` M NATURAL JOIN `Enfant` E WHERE '" . formatDate($date) . "' BETWEEN début AND fin";
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
function getTop3OfferedServices($connexion) { 
	$requete = "SELECT P.libellé,S.description, COUNT(P.idCommune) AS nbServices FROM Proposer P NATURAL JOIN  Service S WHERE P.libellé= S.libellé GROUP BY P.libellé ORDER BY nbServices DESC LIMIT 3";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Top-3 des communes qui réalisent le plus d'unions.
function getTop3Municipalities($connexion) { 
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
	if ($data == null || empty($data)) { 
		echo($message);
		return true;
	}
	return false;
}

// Retourne les informations sur le service spécifié
function getServiceByName($connexion, $libelle) {
	$libelle = mysqli_real_escape_string($connexion, $libelle);
	$requete = "SELECT * FROM Service WHERE libellé = '$libelle'";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Retourne les services et les prix auxquels ils sont proposés par la commune spécifiée
function getMunicipalServicesByID($connexion, $idCommune) {
	$idCommune = mysqli_real_escape_string($connexion, $idCommune);
	$requete = "SELECT * FROM Proposer WHERE idCommune = $idCommune";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Insère un nouveau service
function insertService($connexion, $libelle, $description) {
    $requete = "INSERT INTO Service VALUES (?, ?)";
    if (!($stmt = mysqli_prepare($connexion, $requete))) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, 'ss', $libelle, $description);
    $res = mysqli_stmt_execute($stmt);
    return $res;
}

// Insère le service dans la commune spécifiée
function insertProposer($connexion, $idCommune, $libelle, $prix, $debut, $fin) {
    $requete = "INSERT INTO Proposer VALUES (?, ?, ?, ?, ?)";
    if (!($stmt = mysqli_prepare($connexion, $requete))) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, 'issss', $idCommune, $libelle, $prix, $debut, $fin);
    $res = mysqli_stmt_execute($stmt);
    return $res;
}


// Récupère le département par son code INSEE
function getDepartementByINSEE($connexion, $codeINSEE) {
	$codeINSEE = mysqli_real_escape_string($connexion, $codeINSEE);
	$requete = "SELECT nom FROM Département WHERE codeINSEE_2 = $codeINSEE";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Génère des services
function generateRandomServices($connexion) {
	$nbServices = rand(3, 5);
	$requete = "SELECT libellé FROM Service";
	$res = mysqli_query($connexion, $requete);
	$services =[]; 
	while ($row = mysqli_fetch_assoc($res))
	 { $services[] = $row['libellé']; } 
	$randomServices = [];
	
	for ($i = 0; $i < $nbServices; $i++) {
	  $randomIndex = array_rand($services);
	  $randomServices[] = $services[$randomIndex];
	  unset($services[$randomIndex]);
	}
	
	return $randomServices;
  }

// Génère les périodes d'essai
function generateTrialPeriod($connexion, $departement, $mois_max, $kilometres)
{
    $nbCommunes = rand(5, 20);
    $durees = [3, 4, 6];
    $totalDurees = 0;
    $mois_max = intval($mois_max);
	$periodes = [];
    for ($i = 0; $i < $nbCommunes; $i++) {
		if ($mois_max > 0 && $totalDurees >= $mois_max){
			break;
		}
		
        // choisir une commune
        $queryFirstCommune = "SELECT nom AS nomE,
                                     SUBSTRING_INDEX(coordonnées, ',', 1) AS latitudeE,
                                     SUBSTRING_INDEX(coordonnées, ',', -1) AS longitudeE
                              FROM Commune
                              WHERE codeINSEE_2 = '$departement'
                              ORDER BY RAND()
                              LIMIT 1";

        $resultFirstCommune = mysqli_query($connexion, $queryFirstCommune);

        if ($resultFirstCommune && $rowFirstCommune = mysqli_fetch_assoc($resultFirstCommune)) {
            $nomE = $rowFirstCommune['nomE'];
			$latitudeE = $rowFirstCommune['latitudeE'];
            $longitudeE = $rowFirstCommune['longitudeE'];
				// choisir une autre commune plus prochesssss
            $querySecondCommune = "SELECT nom,
                                          SUBSTRING_INDEX(coordonnées, ',', 1) AS latitude,
                                          SUBSTRING_INDEX(coordonnées, ',', -1) AS longitude
                                   FROM Commune
                                   WHERE ST_Distance_Sphere(
                                       POINT($longitudeE, $latitudeE),
                                       POINT(
                                           CAST(SUBSTRING_INDEX(coordonnées, ',', -1) AS DECIMAL(9, 6)),
                                           CAST(SUBSTRING_INDEX(coordonnées, ',', 1) AS DECIMAL(8, 6))
                                       ) 
                                   ) / 1000 <= $kilometres
                                   ORDER BY RAND()
                                   LIMIT 1";

            $resultSecondCommune = mysqli_query($connexion, $querySecondCommune);
			if ($resultSecondCommune && $rowSecondCommune = mysqli_fetch_assoc($resultSecondCommune)) {
                $nomSecondCommune = $rowSecondCommune['nom'];

                $randomServices = generateRandomServices($connexion);
                $duree = $durees[$i % count($durees)];

				// Vérifie si la durée est inférieure au maximum
				if ($mois_max > 0 && $totalDurees + $duree > $mois_max) {
                    break;
                }
				$periodes []= [
					'nomCommune' => $nomSecondCommune,
					'services' => $randomServices,
					'duree' => $duree,
				];
				$totalDurees += $duree;
			}
        }
        
    }
	return $periodes;
}
?>
