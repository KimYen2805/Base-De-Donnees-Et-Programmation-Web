<?php
    $message = '';

    // Validation du formulaire
    if (isset($_POST['boutonGenerer'])) {
        $departement = $_POST['departement'];
        $mois_max = $_POST['mois_max'];
        $kilometres = $_POST['kilometres'];
        
        // Vérification de si le département existe sur la BD 
        $verification = getDepartementByINSEE($connexion, $departement);

        if (!$verification || count($verification) === 0) {
            $message = "Ce département est introuvable.";
        } else {
            // Génération des périodes d'essai
            $periodes = generateTrialPeriod($connexion, $departement, $mois_max, $kilometres);

            if ($periodes == TRUE) {
                $message = "Les périodes d'essai ont bien été générées.";
            } else {
                $message = "Les données fournies ne permettent pas de générer des périodes d'essai.";
            }
        }
    }
?>