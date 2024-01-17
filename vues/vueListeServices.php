<div class="liste">
        <h2>Liste de nos services</h2>
        <p>
            <?php foreach ($recupereService as $recup) {
                if ($recup["boolPayant"] == 0)
                        $payant = "Gratuit";
                else
                        $payant = "Payant";
                ?>
                <li><?= $recup["Libellé_S"] ?> : <?= $payant ?> </li>
            <?php } ?>
        </p>
</div>