<h2>Générer une liste de périodes d'essai</h2>

<form method="post" action= "#">
    <label for ="departement"> Département: </label>
    <input type="text" name="departement" id ="departement" required>
     <br/> <br/>
    <label for = "mois_max"> Nombre de mois maximum: </label>
    <input type="number" name ="mois_max" id="mois_max" placeholder="5" min="0" max="100"  required>
    <br/> <br/>
    <label for= "kilometres">Nombre de kilometres: </label>
    <input type="number" name ="kilometres" id="kilometres" placeholder="5" min="0" max="100"  required>
    <br/> <br/>
    <button type="submit" name ="boutonGenerer">Générer</button>
    <br/> 
    <br/> 
</form>
<?php if (isset ($message))
	{ ?> <p style = "background-color: pink"; > <?= $message?> </p> 
<?php } ?>