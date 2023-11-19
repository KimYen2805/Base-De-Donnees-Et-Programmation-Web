<h2>Ajouter un service</h2>


<form method="POST" action="#"> <!--post -->
    <!-- 1. Formulaire avec les informations à saisir pour le service.-->
	<label for="libelle">Libellé du service : </label>
	<input type="text" name="libelle" id="libelle" placeholder="Culture" required />
	<label for="description">Description du service : </label>
	<input type="text" name="description" id="description" placeholder="Le Service Culture dynamise la vie artistique locale par des événements et favorise la diversité culturelle de la communauté." required />
	<!-- textbox à la place ???-->
    <br/><br/>

    <!-- 2. Permet également de choisir la ou les communes qui vont proposer ce nouveau service.
    => Penser à proposer des valeurs par défaut pour chaque champ de saisie, afin de ne pas avoir à remplir tous les champs du formulaire lors des tests. -->
    <label for="dep-select">Sélection des communes qui vont proposer ce service :</label>
    <select name="deps" id="dep-select">
        <option value="">--Sélectionner une option--</option> <!--générer automatiquement avec une requête les éléments (voir cours si ça y est)-->
        <option value="dep1">DEP1</option>
        <option value="dep2">DEP2</option>
        <option value="dep3">DEP3</option>
    </select>
    <br/><br/>

    <!-- 3. Utiliser des listes pour sélectionner une valeur (pour les communes) si nécessaire. -->

    <br/><br/>

    <!-- 4. Le système effectuera des vérifications avant d’insérer en base (e.g., pas de service existant avec le même intitulé) -->

    <br/><br/>

    <!-- 5. Afficher des messages pertinents pour faciliter la correction des erreurs de saisie. -->

    <br/><br/>


	<input type="submit" name="boutonValider" value="Ajouter"/>
</form>



