<?php 
    $nb = countInstances($connexion, "Commune");
    if($nb <= 0)
        $message = "Aucune commune n'a été trouvée dans la base de données !";
    else
        $message = "<mark>Connecté à la base de données.</mark>";
?>