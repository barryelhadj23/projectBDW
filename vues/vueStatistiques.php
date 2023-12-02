<div class="wrapper content-stats">
    <div class="add-service">
        <h1>Top-3 des départements ayant le plus de communes</h1>
        <p>
            <?php foreach ($top3Dep as $Dep) { ?>
                <li> <?= $Dep["Departement"] ?> <?= $Dep["Nombre_de_Communes"]?> </li>
            <?php } ?>
        </p>
    </div>

    <div class="add-service">
        <h1>Top-3 des services les plus demandés (par les citoyen·ne·s)</h1>
        <p>
            <?php foreach ($top3Service as $Serv) { ?>
                <li> <?= $Serv["Libellé_S"]?> </li>
            <?php } ?>
        </p>
    </div>

    <div class="add-service">
        <h1>Top-3 des services les plus proposés (par les communes)</h1>
        <p>
            <?php foreach ($top3ServiceProp as $prop) { ?>
                <li> <?= $prop["Libellé_S"]?> </li>
            <?php } ?>
        </p>
    </div>

    <div class="add-service">
        <h1>Top-3 des communes qui réalisent le plus d’unions</h1>
        <p>
            <?php foreach ($topUnion as $top) { ?>
                <li> <?= $top["NomC"]?> : <?= $top["nombreU"]?> </li>
            <?php } ?>
        </p>
    </div>

    <div class="add-service">
        <h1>Nombre d'instances</h1>
        <p> <?= $table ?> : <?= $nb?> <br/> <?= $tab ?> : <?= $nb1 ?> <br/> <?= $tab2 ?> : <?= $nb2?><br/>
            Le total des 3 tables est : <?=$total?>
        <p>
    </div>

    <div class="add-service">
        <h1>Liste de chaque enfant et de son école actuelle</h1>
        <p>Voir la liste complète</p>
            <a href=""><input type="submit" class="btn" value="GO"></a>
    </div>

    <div class="add-service">
        <h1>Liste des enfants avec le nom de la cantine où ils mangeront le 01/01/2024</h1>
            <p>Voir la liste</p>
                <a href=""><input type="submit" class="btn" value="GO"></a>
    </div>

    <div class="add-service">
        <h1>Paires d’enfants ayant les mêmes nom et prénom, mais inscrits dans des écoles différentes</h1>
            <p>
                <?php foreach ($paireEnf as $paireEnf) { ?>
                    <li> <?= $paireEnf["NomEnf"] ?> <?= $paireEnf["PrenomEnf"]?> : <?= $paireEnf["NomE"]?> </li>
                <?php } ?>
            </p>
    </div>
</div>