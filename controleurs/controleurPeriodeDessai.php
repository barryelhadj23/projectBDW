<?php

    $allDepartement = getDepartement($connexion);

    // deux variables pour recuperer les fonctions generationPeriodeEssai et getDonneePeriode

    if(isset($_POST["boutonValider2"]))
    {
        $depart = $_POST["dep"];
        $moisMaxi = $_POST["mois"];
        $nbKm = $_POST["kilo"];

        // fonction qui selectionne aleatoirement entre 5 et 20 communes
        
        function selectionCommunes($connexion)
        {
            $nombreCommunes = rand(5, 20);
            return $nombreCommunes;
        }

        // fonction qui selectionne aleatoirement la duree de chaque periode d'essai entre 3, 4 ou 6 mois

        function dureePeriodeEssaiAleatoire($connexion, $maxMois) {
            $var = 0;
            do {
                $var = rand(1, 3);
                if($var == 1)
                    $var = 3;
                else if ($var == 2)
                    $var = 4;
                else
                    $var = 6;
            }while($var > $maxMois);
            return $var;
        }

        // fonction qui selectionne aleatoirement le nombre de service de chaque periode d'essai entre 3 et 5

        function nombreService($connexion) {
            $nombrePossible = [3, 4, 5];
            $nombreSelectionnee = $nombrePossible[array_rand($nombrePossible)];
            return $nombreSelectionnee;
        }
        generationPeriodeEssai($connexion,$depart,$moisMaxi,$nbKm);
        $recupDonnee = getDonneePeriode($connexion);

    }

    
?>