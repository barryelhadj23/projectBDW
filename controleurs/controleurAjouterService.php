<?php

$allCommune = getCommune($connexion);

function enleve_caracteres_speciaux($chaine)
{
    if (preg_match('/^[a-zA-Z0-9 ]*$/', $chaine)) // /^[a-zA-Z0-9 ]*$/ pattern qui cherche un caractere special
    {
        return $chaine;
    }
    else
    {
        return -1;
    }
}

//fonction qui verifie que les dates sont valides et coherentes entre elles
function verifieDate($debut,$fin)
{
    $dateD = strtotime($debut);
    $dateF = strtotime($fin);

    if($dateD != FALSE && $dateF != FALSE)
    {
        if($dateD < $dateF)
        {
            return 1;
        }
        else
            return -1;

    }
    return -1;
}


if(isset($_POST['boutonValider']))
{
    $servi = $_POST['libelle'];
    $description = $_POST['description'];
    $boolPayant = $_POST['typeService'];
    $dateDebut = $_POST['debut'];
    $dateFin = $_POST['fin'];
    $communeAajouter = $_POST['commune'];
    $service = enleve_caracteres_speciaux($servi);
    //$description = enleve_caracteres_speciaux($descri);
    $test = verifieDate($dateDebut,$dateFin);
    if ($boolPayant == "payant")
    {
        $payant = 1;
    }
    else if($boolPayant == "gratuit")
    {
        $payant = 0;
    }

    if($service != -1 )
    {

        insertService($connexion,$service,$description, $payant);
        $idcom = idCommune($connexion,$communeAajouter);
        $idservice = idService($connexion,$service);
        insertPropose($connexion,$idcom,$idservice);
        inserePeriodeOverture($connexion,$dateDebut,$dateFin,$test);
        insertOuvert($connexion,$idcom,$idservice,$dateDebut,$dateFin,$test);
    }


}

?>