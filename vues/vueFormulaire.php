<h2>Ajout d'un service</h2>

<form method="post" action="controleurService.php">
	<label for="service"> Libellé du service </label><br/>
	<input type="text" name="libelle" id="service" placeholder="Scolaire" required />
	<br/>
    <label for="description"> Faites une breve description du service </label><br/>
    <textarea name="description" id="description"></textarea>
    <br/>
    <label for="periode"> Periode d'ouverture </label><br/>
    <label for="debut">Du</label>
    <input type="date" name="debut" id="debut"/>
    <label for="fin">Au</label>
    <input type="date" name="fin" id="fin"/>
    <br/>
	<label for="commune"> Dans quelle commune </label><br/>
	<select id="commune" name="commune">
		<?php foreach ($allCommune as $commune): ?>
            <option value="<?php echo $commune['nom_commune']; ?>"> <?php echo $commune['nom_commune']; ?> </option>
        <?php endforeach; ?>
    </select>
	<br/>
	<input type="submit" name="boutonValider" value="Ajouter"/>
</form>

<?php if(isset($message)) { ?>
	<p style="background-color: yellow;"><?= $message ?></p>
<?php } ?>