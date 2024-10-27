<?php 
    $message = '';

    // Récupérer toutes les instances de communes
    $communes = getInstancesSorted($connexion, "Commune", "nom", "ASC");
    checkIfEmpty($communes, "Aucune commune trouvée.");

    $services = getInstancesSorted($connexion, "Service", "libellé", "ASC");
    checkIfEmpty($services, "Aucun service trouvé.");
    
    // Affichage des données des services
    $resultatServices = array();

    foreach ($communes as $commune)
    {
        $servicesCommune = getMunicipalServicesByID($connexion, $commune['idCommune']);
        $resultatServices[$commune['idCommune']] = $servicesCommune;
    }
    
    // Date actuelle
    $currentDate = date('Y-m-d');

    // Validation du formulaire
    if (isset($_POST['boutonValider'])) {
        // Vérification des données postées
        if (isset($_POST['libelle']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['debut']) && isset($_POST['fin']) && isset($_POST['departements'])) 
        {
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $debut = $_POST['debut'];
            $fin = $_POST['fin'];
            $idCommunes = $_POST['departements'];
    
            // Vérification si le service existe déjà
            $verification = getServiceByName($connexion, $libelle);
    
            if (!checkIfEmpty($verification, "")) {
                $message = "Le service $libelle existe déjà !";
            } elseif ($prix < 0) {
                $message = "Le prix ne peut pas être négatif.";
            } elseif ($fin < $debut) {
                $message = "La date de fin ne peut pas être antérieure à la date de début.";
            } else {
                // Insertion dans service et proposer
                $insertionService = insertService($connexion, $libelle, $description);
    
                if ($insertionService) 
                {
                    $insertionSuccess = true;
                    foreach ($idCommunes as $idCommune) 
                    {
                        $insertionProposer = insertProposer($connexion, $idCommune, $libelle, $prix, $debut, $fin);
                        if (!$insertionProposer) {
                            $insertionSuccess = false;
                            break;
                        }
                    }
    
                    if ($insertionSuccess) {
                        $message = "Le service $libelle a été ajouté avec succès !";
                    } else {
                        $message = "Erreur lors de l'insertion des propositions pour le service $libelle : " . mysqli_error($connexion);
                    }
                } else {
                    $message = "Erreur lors de l'insertion du service $libelle : " . mysqli_error($connexion);
                }
            }
        } else {
            $message = "Merci de remplir tous les champs du formulaire.";
        }
    }
    
?>