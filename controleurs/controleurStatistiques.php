<?php 
    // Afficher le nombre d'instance pour 3 tables de notre choix
    $nbCitoyens = countInstances($connexion, "Citoyen"); 
    $nbDemandes = countInstances($connexion, "Demande");
    $nbCommunes = countInstances($connexion, "Commune");

    //Afficher une liste de chaque enfant et de son école actuelle
    $listeEnfantsEcole = getChildsAndSchool($connexion);
    checkIfEmpty($listeEnfantsEcole, "Aucun enfant trouvé dans la base de données.");

    //Afficher la liste des enfants avec le nom de la cantine où ils mangeront le 01/01/2024
    $listeEnfantsCantine = getChildsAndCanteen($connexion, new DateTime('2024-01-01'));
    checkIfEmpty($listeEnfantsCantine, "Aucun enfant trouvé dans la base de données pour cette date.");

    //Afficher les paires d'enfants ayant les mêmes nom et prénom, mais inscrits dans des écoles différentes
    $listeHomonymesEcole = getHomonymsAndSchool($connexion);
    checkIfEmpty($listeHomonymesEcole, "Aucun enfant trouvé dans la base de données.");

    //Top-3 des départements ayant le plus de communes
    $topDepartements = getTop3Departments($connexion);
    checkIfEmpty($topDepartements, "Aucun département trouvé.");

    //Top-3 des services les plus demandés (par les citoyen•ne•s)
    $topRequestedServices = getTop3RequestedServices($connexion);
    checkIfEmpty($topRequestedServices, "Aucun département trouvé.");

    //Top-3 des services les plus proposés (par les communes)
    $topOfferedServices = getTop3OfferedServices($connexion);
    checkIfEmpty($topOfferedServices, "Aucun service trouvé.");

    //Top-3 des communes qui réalisent le plus d'unions.
    $topMunicipalities = getTop3Municipalities($connexion);
    checkIfEmpty($topRequestedServices, "Aucune commune trouvée.");
?>