<?php

$connexion = getConnexionBD(); // connexion à la BD

if (isset($_POST['boutonGenerer'])) {
    $departement = $_POST['departement'];
    $mois_max = $_POST['mois_max'];
    $kilometres = $_POST['kilometres'];
    genererPeriodesEssai($connexion,$departement, $mois_max, $kilometres);
}
 ?>