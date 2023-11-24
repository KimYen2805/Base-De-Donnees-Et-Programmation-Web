<?php
$connexion = getConnexionBD(); // connexion à la BD

if (isset($_POST['boutonGenerer'])) {
    $departement = $_POST['departement'];
    $mois_max = $_POST['mois_max'];
    $kilometres = $_POST['kilometres'];

    $trialResults = genererPeriodesEssai($connexion, $departement, $mois_max, $kilometres);

    echo "Résultats des périodes d'essai";

    if (empty($trialResults)) {
        echo "Aucune période d'essai générée. Raison : [Ajoutez un message de débogage ici]";
    } else {
        foreach ($trialResults as $res) {
            echo "<p>Commune: {$res['commune']} <br>
            - Durée: {$res['duree']} mois <br>
            - Services: " . implode(', ', $res['services']) . "</p>";
        }
    }
    
        
        
    }

?>
