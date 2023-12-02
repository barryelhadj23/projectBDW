<h2>Ajout d'un service</h2>
<div class="form">
    <form method="post" action="#">
        <label for="service"> Libellé du service </label><br/>
        <input type="text" name="libelle" id="service" placeholder="Scolaire" required />
        <br/>
        <label for="description"> Faites une breve description du service </label><br/>
        <textarea name="description" id="description" required></textarea>
        <br/>
        <label for="typeService"> Type de service </label> <br/>
        <select id="type" name="typeService" required>
            <option> </option>
            <option>payant</option>
            <option>gratuit</option>
        </select>
        <br/>
        <label for="periode"> Periode d'ouverture </label><br/>
        <label for="debut">Du</label>
        <input type="date" name="debut" id="debut" required/>
        <label for="fin">Au</label>
        <input type="date" name="fin" id="fin" required/>
        <br/>
        <label for="commune"> Dans quelle commune </label><br/>
        <select id="commune" name="commune" >
            <option > </option>
            <?php foreach ($allCommune as $commune){ ?>
                <option value="<?= $commune["NomC"]; ?>">  <?= $commune["NomC"]; ?> </option>
            <?php } ?>
        </select> <br/>
        <input type="submit" name="boutonValider" value="Ajouter"/>
    </form>
</div>
<div class="form">
    <?php
    if(isset($_POST['boutonValider']))
    {
        echo " le nom du service est : $service </br>" ;
         echo " sa description est : $description </br>";
         if($test == 1 )
         {
             echo " il ouvre du $dateDebut au $dateFin </br>";
         }

         echo "il sera ajouter dans la commune $communeAajouter";
        echo "$idcom , $idservice , $payant";
    }
    ?>
</div>