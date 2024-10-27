<h2>Générer une liste de périodes d'essai</h2>

<!-- Formulaire pour générer la liste -->
<form method="POST" action="#" class="formulaire">
    <!-- Saisie des paramètres -->
    <label for="departement">Département :</label>
    <input type="text" name="departement" id="departement" placeholder="Entrez le code du département (ex: 69)" required>

    <label for="mois_max">Nombre de mois maximum :</label>
    <input type="number" name="mois_max" id="mois_max" placeholder="Entrez le nombre de mois maximum (0 à 36)" min="0" max="36" required>

    <label for="kilometres">Nombre de kilomètres :</label>
    <input type="number" name="kilometres" id="kilometres" placeholder="Entrez le nombre de kilomètres (0 à 500)" min="0" max="500" required>

    <!-- Bouton de validation -->
    <input type="submit" name="boutonGenerer" value="Générer"/>

    <!-- Message de confirmation -->
    <div class="message">
        <?= $message ?>
    </div>
</form>

<div>
    <?php if (!empty($periodes)) { ?>
        <h3>Voici la liste des périodes d'essai que nous proposons gratuitement :</h3>
        <table>
            <tr>
                <th>Commune</th>
                <th>Services</th>
                <th>Durée</th>
            </tr>
            <?php foreach ($periodes as $per) { ?>
                <tr>
                    <td><?= $per['nomCommune'] ?></td>
                    <td><?= implode(", ", $per['services']) ?></td>
                    <td><?= $per['duree'] ?> mois</td>
                </tr>
            <?php } ?>
        </table>
    <?php } else {
        $message = "Aucune période d'essai n'a été générée.";
    } ?>
</div>