<?php 
    //ajouterActiviteHistorique("page d'accueil");
    $nb = countInstances($connexion, "Communes");
    if($nb <= 0)
        $message = "Aucune commune n'a été trouvée dans la base de données !";
    else
        $message = "<mark>Connecté à la base de données.</mark> : actuellement <strong>$nb communes</strong> dans la base.";
?>