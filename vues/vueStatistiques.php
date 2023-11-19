<h2>Statistiques</h2>

<h3>Nombre d'instances pour 3 tables de notre choix</h3>
<ul>
    <li>Citoyens : <?= $nbCitoyens ?></li>
    <li>Demandes : <?= $nbDemandes ?></li>
    <li>Communes : <?= $nbCommunes ?></li>
</ul>

<h3>Liste de chaque enfant et de son école actuelle</h3> <!--TODO : voir pour faire un tableau avec scroll-->

<div class="tableau">
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>École</th>
        </tr>
        <?php foreach($listeEnfantsEcole as $enfant) { ?>
            <tr>
                <td><?= strtoupper($enfant['nom']) ?></td>
                <td><?= $enfant['prénom'] ?></td>
                <td><?= $enfant['école'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Liste des enfants avec le nom de la cantine où ils mangeront le 01/01/2024</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Cantine</th>
        </tr>

        <?php foreach($listeEnfantsCantine as $enfant) { ?>
            <tr>
                <td><?= strtoupper($enfant['nom']) ?></td>
                <td><?= $enfant['prénom'] ?></td>
                <td><?= $enfant['cantine'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Paires d'enfants ayant les mêmes nom et prénom, mais inscrits dans des écoles différentes</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>École</th>
        </tr>
        
        <?php foreach($listeHomonymesEcole as $enfant) { ?>
            <tr>
                <td><?= strtoupper($enfant['nom']) ?></td>
                <td><?= $enfant['prénom'] ?></td>
                <td><?= $enfant['école'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Top-3 des départements ayant le plus de communes</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Code INSEE</th>
            <th>Département</th>
            <th>Nombre de communes<th>
        </tr>

        <?php foreach($topDepartements as $department) { ?>
            <tr>
                <td><?= $department['codeINSEE'] ?></td>
                <td><?= $department['nomDépartement'] ?></td>
                <td><?= $department['nbCommunes'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Top-3 des services les plus demandés (par les citoyens)</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
            <th>Nombre de demandes<th>
        </tr>

        <?php foreach($topRequestedServices as $service) { ?>
            <tr>
                <td><?= $service['libellé'] ?></td>
                <td><?= $service['description'] ?></td>
                <td><?= $service['nbDemandes'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Top-3 des services les plus proposés (par les communes)</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
            <th>Nombre de propositions<th>
        </tr>

        <?php foreach($topOfferedServices as $service) { ?>
            <tr>
                <td><?= $service['libellé'] ?></td>
                <td><?= $service['description'] ?></td>
                <td><?= $service['nbServices'] ?></td> <!--TODO : verif-->
            </tr>
        <?php } ?>
    </table>
</div>


<h3>Top-3 des communes qui réalisent le plus d'unions.</h3>

<div class="tableau">
    <table>
        <tr>
            <th>Identifiant</th>
            <th>Commune</th>
            <th>Nombre d'unions<th>
        </tr>

        <?php foreach($topMunicipalities as $municipality) { ?>
            <tr>
                <td><?= $municipality['idCommune'] ?></td>
                <td><?= $municipality['commune'] ?></td>
                <td><?= $municipality['nbUnions'] ?></td> <!--TODO : verif-->
            </tr>
        <?php } ?>
    </table>
</div>
