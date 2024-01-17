<h2> Faites un essai</h2>
<div class="form">
    <form method="post" action="#">
        <label> Selectionnez un département</label>
        <select name="dep" required>
            <option> </option>
            <?php foreach ($allDepartement as $departement){ ?>
                <option value="<?= $departement["Code_INSEE_D"]; ?>">  <?= $departement["NomD"]; ?> </option>
            <?php } ?>
        </select> <br />
        <label for="mois"> le nombre de mois </label>
        <input type="number" name="mois"  id="mois" value="nombre de mois" required/> <br />
        <label for="kilo"> le nombre de kilomètre </label>
        <input type="number" name="kilo"  id="kilo" value="nombre de kilomètre" required/> <br />
        <input type="submit" name="boutonValider2" value="Ajouter"/>
    </form>
</div>

<!--<div class="form">
<?php 

    //var_dump($genererPeriode);










/*if(!empty($recupDonnee)) {
   foreach($recupDonnee as $donnee) {
       if(null !== $recupDonnee['C'] && is_array($recupDonnee['C'])) {
           foreach($recupDonnee['C'] as $communeIndex => $commune) { // index est l'indice du tab et commune est la valeur du tab
               echo "Les services ";
               foreach($recupDonnee['S'] as $servic) {
                   echo "$servic";
                   echo $commune['NomC'];
                   echo $recupDonnee['D'][$communeIndex];
               }
           }
       }else
           echo "Aucune commune specifiée pour cette periode";
   }
}else
   echo "Aucune periode d'essai generée." */
?>
</div>-->