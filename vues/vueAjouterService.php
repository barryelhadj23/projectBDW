<h2>Ajout d'un service</h2>
<p>
    Quelques spécifications : <br/> 
   La date de debut doit forcement etre inferieur à la date de fin, si vous decidez pas si le service est payant ou gratuit,
   il sera gratuit par defaut. <br/> Vous devez terminer par la selection des communes, si vous ne rentrez aucune commune, le service sera ajouté s'il n'existe pas, mais ne sera pas proposé   <br/>

</p>
<div class="form">
    <form method="post" action="#">
        <label for="service"> Libellé du service </label><br/>
        <input type="text" name="libelle" id="service" value="Scolaire" required />
        <br/>
        <label for="description"> Faites une breve description du service </label><br/>
        <textarea name="description" id="description" placeholder="inscription des enfants" required></textarea>
        <br/>
        <label for="typeService"> Type de service </label> <br/>
        <select id="type" name="typeService" required>
            <option>payant</option>
            <option>gratuit</option>
        </select>
        <br/>
        <label for="periode"> Periode d'ouverture </label><br/>
        <label for="debut">Du</label>
        <input type="date" name="debut" id="debut" value="2023-12-08" required/>
        <label for="fin">Au</label>
        <input type="date" name="fin" id="fin" value="2023-12-31" required/>
        <br/>
        <label for="commune"> Dans quelle commune </label><br/>
        <select id="commune" name="commune[]" multiple>
            <?php foreach ($allCommune as $commune){ ?>
                <option value="<?= $commune["idComAuto"]; ?>">  <?= $commune["NomC"]; ?> </option>
            <?php } ?>
        </select> <br/>
        <input type="submit" name="boutonValider" value="Ajouter"/>
    </form>
</div>
<div class="form">
    <?php
    if(isset($_POST['boutonValider']))
    {
        echo " le nom du service que vous avez envoyé est : $service </br>" ;
         if($test == 1 )
         {
             echo " il ouvre du $dateDebut au $dateFin </br>";
         }
         if(isset($message))
         {
            echo "$message";
         }
    }
    ?>
</div>