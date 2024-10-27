<h2>Ajouter un service</h2>

<!-- Formulaire d'ajout de service-->
<form method="POST" action="#" class="formulaire">
    <!-- Différentes données à saisir -->
    <label for="libelle">Libellé du service :</label>
    <input type="text" name="libelle" id="libelle" placeholder="Entrez le nom du service (ex: Culture)" required/>

    <label for="description">Description du service :</label>
    <textarea id="description" name="description" rows="5" cols="30" minlength="50" maxlength="200" placeholder="Ajoutez une description du service (50 à 200 caractères)" required></textarea>

    <label for="prix">Prix (en euros) :</label>
    <input type="number" name="prix" id="prix" min="0" step="0.01" inputmode="decimal" placeholder="Entrez le prix du service (ex: 10)" required/>

    <label for="debut">Période d'ouverture :</label>
    <input type="date" name="debut" id="debut" value="<?= $currentDate ?>" min="<?= $currentDate ?>" />

    <label for="fin">Période de fermeture :</label>
    <input type="date" name="fin" id="fin" value="<?= $currentDate ?>" min="<?= $currentDate ?>" />

    <label for="departements">Sélection des communes qui vont proposer ce service :</label>
    <select name="departements[]" id="departements" size="10" required multiple>
        <!-- Ajout des communes dynamiquement -->
        <?php foreach ($communes as $commune) { ?>
            <option value="<?= $commune['idCommune'] ?>"><?= $commune['nom'] ?></option>
        <?php } ?>
    </select>

    <!-- Bouton pour valider le formulaire -->
    <input type="submit" name="boutonValider" value="Ajouter"/>

    <!-- Message de confirmation -->
    <div class="message">
        <?= $message ?>
    </div>
</form>

<h3>Liste de tous les services</h3>

<div class="tableau"> 
    <table>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
        </tr>

        <!-- Ajout des données -->
        <?php foreach($services as $service) { ?>
            <tr>
                <td><?= $service['libellé'] ?></td>
                <td><?= $service['description'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<h3>Informations propres aux services de chaque commune</h3>
<div class="tableau">
    <table>
        <thead>
            <tr>
                <th>Commune</th>
                <th>Services</th> 
                <th>Prix</th>
                <th>Période d'ouverture</th>
            </tr> 
        </thead>
        <tbody>
            <!-- Ajout des données -->
            <?php foreach ($communes as $commune) { ?>  
                <tr>
                    <td rowspan="<?= count($resultatServices[$commune['idCommune']]) + 1 ?>"><?= $commune['nom'] ?></td>
                    <?php if (empty($resultatServices[$commune['idCommune']])) { ?>
                        <td colspan=3>Aucun service proposé</td> <!-- Permet de régler la hauteur en fonction du nombre de services -->
                    <?php } else { ?>
                        </tr>
                            <?php foreach($resultatServices[$commune['idCommune']] as $service) { ?> 
                                <tr>
                                    <td><?= $service['libellé'] ?></td>
                                    <td><?= $service['prix'] . "€" ?></td>
                                    <td><?= $service['début'] ?> au <?= $service['fin'] ?></td>
                                </tr>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    // Gestion des dates
    const debut = document.getElementById('debut');
    const fin = document.getElementById('fin');

    // Empêche d'avoir une date de fin inférieure à celle de début
    debut.addEventListener('input', function() {
        fin.value = debut.value;
        fin.min = debut.value;
    });
</script>