<?php 

$allCommune = getCommune($connexion);
// fonction pas utilisée , mysqli real escape et les requetes preparées suffisent
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

//fonction qui verifie que les dates sont valides et coherentes entre elles, c'est a dire debut < fin
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
// fonction qui verifie que la commune ne propose pas deja le service
function communeEgal($connexion,$idComCompare,$idServCompare)
{
    $var = serviceCommune($connexion,$idServCompare);
    foreach ($var as $com)
    {
        if($com["IdComAuto"] === $idComCompare)
        {
            return -1;
        }
    }
    return 1;
}

$boolPayant = 0; // si l'utilisateur ne choisit rien, la commune opte pour la gratuité
if(isset($_POST['boutonValider']))
{
    
    $service = $_POST['libelle'];
    $description = $_POST['description'];
    $boolPayant = $_POST['typeService'];
    $dateDebut = $_POST['debut'];
    $dateFin = $_POST['fin'];
    $communeAajouter = $_POST["commune"];
    $test = verifieDate($dateDebut,$dateFin); // si debut < fin
    if ($boolPayant == "payant")
    {
        $payant = 1;
    }
    else if($boolPayant == "gratuit")
    {
        
        $payant = 0;
    }
          
        $serviceInsere = insertService($connexion,$service,$description, $payant); // insere service et mets -1 si il existe deja 
        $idservice = idService($connexion,$service/*,$payant*/); // recupere l'idservice, pour payant, voir modele fonction idservice
    if (isset($_POST['commune'])) {
        if($serviceInsere == 1) // si le service a bien été ajouté  
        {
            foreach($communeAajouter as $idcom) // je propose pour chaque commune vu que le service est nouveau et que personne ne l'a
            {
                $proposeBienPasse = insertPropose($connexion,$idcom,$idservice,$dateDebut,$dateFin,$test); 
            }
            $message = "Service ajouté et proposé dans les communes que vous avez choisies, Veuillez allez regarder la table service";
        }
        else // le service existe deja, on teste pour inserer que dans les communes qui ne prosent pas
        {
                foreach($communeAajouter as $idcom) // recupere l'id de chaque commune en bouclant un par un
                {
                    $Existe = communeEgal($connexion,$idcom,$idservice); // interroge pour voir si chaque commune propose le service
                    if($Existe==1) // si la commune en question ne propose pas le service
                    {
                        $proposeBienPasse = insertPropose($connexion,$idcom,$idservice,$dateDebut,$dateFin,$test); // on propose dans la commune en question
                    }
                
               }
                 $message = "Le service existe deja dans la table mais a été ajouté dans les communes pour les quelles vous avez demandé et qui ne le proposaient pas deja";
            
            
           
        }
    }
     else 
     {
        if($serviceInsere == 1)
        {
            $message = "N'essayez pas de soumettre sans communes, le service a été quand meme ajouté mais pas proposé, si vous voulez le proposer, veuillez remplir le
            formulaire à nouveau avec les meme informations pour le libellé et la description en mettant les communes";
        }
        else
        {
            $message = "Le service existe, mais vous l'avez proposé nulle part, veuillez recommencer ";
        }
     }
    
            
       
}   



?>