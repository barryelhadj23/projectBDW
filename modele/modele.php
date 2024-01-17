<?php
// connexion à la BD, retourne un lien de connexion
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	mysqli_query($connexion,'SET NAMES UTF8'); // noms en UTF8
	return $connexion;
}
// déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

// fonction qui compte le nombre d'instances d'une table
function nbInstances($connexion, $nomTable)
{
	$req = "SELECT count(*) as nb FROM $nomTable";
	$res = mysqli_query($connexion,$req);
	if($res != false)
	{
		$var = mysqli_fetch_assoc($res);
		return $var['nb'];
	}
	else 
		return "erreur";
}
// fonction qui compte le top 3 des departements avec le plus de communes
function Top3Depart($connexion)
{
	$requete = "SELECT NomD as Departement, COUNT(*) as Nombre_de_Communes
	FROM Departement
	NATURAL JOIN Commune
	GROUP BY NomD
	ORDER BY Nombre_de_Communes DESC
	LIMIT 3";
	$resultat = mysqli_query($connexion,$requete);
	if($resultat != FALSE)
	{
		$variable = mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		return $variable;
	}
	else{
		return -1;
	}


}

// fonction top 3 des services les plus demandés par les citoyens
function Top3ServicesDemandes($connexion)
{
	$requete = 
		"	SELECT Libellé_S , COUNT(*) as nb
			FROM Service NATURAL JOIN Demande 
			GROUP BY Libellé_S
			ORDER BY nb DESC
			LIMIT 3
		";
	$resultat = mysqli_query($connexion,$requete);
	if($resultat != FALSE)
	{
		$variable = mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		return $variable;
	}
	else{
		return -1;
	}
}
//fonction top 3 des services les plus proposés par les communes
function Top3ServicesProposes($connexion)
{
	$requete = 
		"	SELECT Libellé_S, COUNT(*) as nb
			FROM Service NATURAL JOIN Propose 
			GROUP BY Libellé_S
			ORDER BY nb DESC
			LIMIT 3
		";
	$resultat = mysqli_query($connexion,$requete);
	if($resultat != FALSE)
	{
		$variable = mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		return $variable;
	}
	else{
		return -1;
	}	
}

// fonction liste des enfants avec leur ecole
function listeEnfants($connexion)
{
	$requete = 
		"	SELECT NomEnf, PrenomEnf, NomE FROM Ecole NATURAL JOIN Enfant LIMIT 10
		";
	$resultat = mysqli_query($connexion,$requete);
	if($resultat != FALSE)
	{
		$variable = mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		return $variable;
	}
	else{
		return -1;
	}	

}


// paire d'enfants avec meme prenoms et noms mais ecoles differents
function paireEnfants($connexion)
{
	
	$requete = 
		"	SELECT e1.NomEnf , e1.PrenomEnf , Ecole.NomE
			FROM Ecole 
			NATURAL JOIN
			Enfant e1
			 JOIN
			 Enfant e2 
			 ON ((e1.NomEnf = e2.NomEnf) AND (e1.PrenomEnf = e2.PrenomEnf) AND (e1.idEcole != e2.idEcole))
		";
	$resultat = mysqli_query($connexion,$requete);
	if($resultat != FALSE)
	{
		$variable = mysqli_fetch_all($resultat,MYSQLI_ASSOC);
		return $variable;
	}
	else{
		return -1;
	}	
}
// fonction nombre d'unions
function top3NbUnions($connexion)
{
	$req = "	SELECT c.IdComAuto, c.NomC,COUNT(uc.idUnion) AS nombreU
				FROM Commune c
				NATURAL JOIN Propose p 
				NATURAL JOIN Demande d
				NATURAL JOIN Union_civile uc
				GROUP BY c.IdComAuto
				ORDER BY nombreU DESC
				LIMIT 3
			";
	$res = mysqli_query($connexion,$req);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}
}	

// fonction liste enfant avec la cantine ou ils mangeront le 2024-01-01
function listeEnfCantine($connexion)
{
	$req = "	SELECT
    				 (SELECT NomEnf FROM Enfant WHERE idE = M.idE) AS NomEnf,
   					 (SELECT PrenomEnf FROM Enfant WHERE idE = M.idE) AS PrenomEnf,
   					 (SELECT NomCan FROM Cantine WHERE idCantine = M.idCantine) AS NomCantine
				FROM
    				Manger M
				WHERE
  				    DebutMangeCANT <= '2024-01-01'
    			AND FinMangeCANT >= '2024-01-01'
			";
	$res = mysqli_query($connexion,$req);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}
		
}
// fonction qui recuprere les commumnes
function getCommune($connexion)
{
	$requete = "SELECT idComAuto,NomC FROM Commune ORDER BY NomC ASC";
	$res = mysqli_query($connexion,$requete);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}

}

//fonction qui recupere les departements
function getDepartement($connexion)
{
	$requete = "SELECT Code_INSEE_D, NomD FROM Departement ORDER BY NomD ASC";
	$res = mysqli_query($connexion,$requete);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}

}

// fonction qui traite les données du formulaire apres soumission
function traitement_donnees($connexion,$variable)
{
	$safe = mysqli_real_escape_string($connexion,$variable);
	return $safe;
}

// fonction qui recupere tous mes services
function recupereServices($connexion)
{
	$requete = "SELECT DISTINCT Libellé_S , boolPayant FROM Service ";
	$res = mysqli_query($connexion,$requete);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}

}


// fonction qui insere un nouveau service en ayant testé qu'il n'existe pas deja 
function insertService($connexion, $libelle,$description,$payant)
{
	$serviceExistant = recupereServices($connexion);
	if($serviceExistant != -1)
	{
		foreach ($serviceExistant as $existe)
		{
			if(strcasecmp($existe["Libellé_S"], $libelle) === 0 /*&& $existe["boolPayant"] == $payant*/) //bonus pour differecier le servie grace au booleen, voir plus bas
			{
				return -1;
			}
		}
	}
	else{
		return -1;
	}
	
	$req = "	INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`)
	 			VALUES (?,?,?)
			";
	 $etat = mysqli_prepare($connexion,$req);
	 $libelleSur = traitement_donnees($connexion,$libelle);
	 $descriptionSur = traitement_donnees($connexion,$description);
	mysqli_stmt_bind_param($etat,"ssi",$libelleSur,$descriptionSur,$payant);
	mysqli_stmt_execute($etat);

	return 1;
}

/*fonction qui recupere l id du service sachant qu'on a décidé que 2 services pouvaient avoir le meme libéllé et que si leur gratuité
	diffère, on les considérait comme 2 services differents (merci de decommenter AND boolPayant = $payant pour avoir cette condition)
	Là pour respecter les specifications de la fontionnalité, un service n'est identifié que par son libéllé et payant ne servira que si vous le decommentez, 
	mais je vous le laisse au cas où vous vouliez tester */
function idService($connexion,$libelle_s/*,$payant*/)
{
	$req = "SELECT idService FROM Service  WHERE Libellé_S LIKE '%$libelle_s%' ";/*AND boolPayant = $payant ";*/
	$res = mysqli_query($connexion, $req);
	if($res!= FALSE)
	{
		$var = mysqli_fetch_assoc($res);
		return $var['idService'];
	}
	else
		return -1;
}

// fonction qui rempli la table propose entre commune et service
function insertPropose($connexion,$idCom,$idService,$debut,$fin,$test)
{
	if($test==1)
	{
		$req = "INSERT INTO `Propose`(`IdComAuto`, `idService`,`ouverture`, `fermeture`) VALUES (?,?,?,?)"; 
		$etat = mysqli_prepare($connexion,$req);
		mysqli_stmt_bind_param($etat,"iiss",$idCom,$idService,$debut,$fin);
		mysqli_stmt_execute($etat);
		return 1;
	}
	else
		return -1;
	
	
}

// fonction qui recupere toutes les communes qui propose un service, voir communeEgal dans le controleur ajouter qui va tester si une commune propose deja un service

function serviceCommune($connexion,$idService)
{
	$req = "SELECT IdComAuto, idService FROM  Propose WHERE idService = $idService ";
	$res = mysqli_query($connexion, $req);
	if($res!=FALSE)
	{
		$var= mysqli_fetch_all($res,MYSQLI_ASSOC);
		return $var;
	}
	else
	{
		return -1;
	}
}

/* Periode d'essai */

// fonction qui recupere les communes dans un departement donné
function getCommuneDep($connexion, $dep)
{
    $requete = "SELECT NomC, Latitudec, LongitudeC FROM Commune WHERE Code_INSEE_D = $dep"; 
    $res = mysqli_query($connexion,$requete);
    if($res!=FALSE)
    {
        $var= mysqli_fetch_all($res,MYSQLI_ASSOC);
        return $var;
    }
    else
    {
        return -1;
    }
}

// fonction qui selection aleatoirement une liste de service
function listeServiceAleatoire ($connexion) {
    $requete = "SELECT Libellé_S FROM Service ";
    $res = mysqli_query($connexion,$requete);
    $var = mysqli_fetch_all($res,MYSQLI_ASSOC);
    $listeService = $var;
    $servicesChoisi = [];
    $nb = nombreService($connexion); // appel la fonction qui genere entre 3 4 ou 5 services
    for($i = 0; $i< $nb; $i++) {
        $clef = array_rand($listeService);
        $servicesChoisi [] = $listeService [$clef];
        unset($listeService [$clef]); // Éviter de choisir le même service à nouveau. Si la clef existe deja, elle l'ecrase
    }
    return $servicesChoisi;
}

// fonction qui genere la periode d'essai
function generationPeriodeEssai ($connexion, $dep, $distanceMax, $maxMois) {
    $nbCommune = selectionCommunes($connexion);
    $comDep = getCommuneDep($connexion, $dep);
    $communeDeBase = $comDep [0];
    $communesChoisies = [];
    $periodeGeneree = [];
    $listDuree = [];
    for ($i = 1; $i< $nbCommune; $i++) {
        $dureePeriodeEssai = dureePeriodeEssaiAleatoire($connexion, $maxMois);
        $servicesChoisis = listeServiceAleatoire($connexion);
        $communeCourante = $comDep[$i];
        $requete = "SELECT ST_Distance(POINT(?, ?), POINT(?, ?)) AS distance";
        $stmt = mysqli_prepare($connexion,$requete);
        mysqli_stmt_bind_param($stmt, "ssss", $communeDeBase['LatitudeC'],
            $communeDeBase['LongitudeC'],
            $communeCourante['LatitudeC'],
            $communeCourante['LongitudeC']
        );
        mysqli_stmt_execute($stmt);
        $resultat = mysqli_stmt_get_result($stmt);
        $distance = mysqli_fetch_assoc($resultat);
        $distance = $distance ["distance"];

        if ($distance <= $distanceMax) {
            $communesChoisies [] = $communeCourante;
            $listDuree [] = $dureePeriodeEssai;
        }
    }


    //un tabeau associatif qui contient les element generer dans la boucle e.g : $periodeGeneree['S'] recup la liste des services car cle S
    $periodeGeneree = [
        "S" => $servicesChoisis,
        "C" => $communesChoisies,
        "D" => $listDuree
    ];

    //la serialisation d'un tab permet de stocket celui-ci dans un champ type text uniquement a la database
    $listeServiceSerialisee = serialize($periodeGeneree['S']);
    $listeCommuneSerialisee = serialize($periodeGeneree['C']);
    $dureeSerialisee = serialize($periodeGeneree['D']);

    $sql = "INSERT INTO `Periode`(`ListeCommues`, `ListeServices`, `ListeDuree`) VALUES (?, ?, ?)";
    $resultat = mysqli_query($connexion, $sql);
    $statement = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($statement, "sss",
        $listeCommuneSerialisee, 
        $listeServiceSerialisee,
        $dureeSerialisee
    );
    mysqli_stmt_execute($statement);

    //return $periodeGeneree; // j'ai retourné pour pouvoir voir ce qu'il y'a dedans

}

// fonction qui recupere les données de la table periode
function getDonneePeriode($connexion) {
    $requete = "SELECT * FROM Periode";
    $res = mysqli_query($connexion,$requete);
    if($res!=FALSE)
    {
        $var= mysqli_fetch_all($res,MYSQLI_ASSOC);
        $periodeGeneree = [];
        foreach($var as $v) {
            $periodeGeneree = [
                "S" => unserialize($v["ListeServices"]),
                "C" => unserialize($v["ListeCommues"]),
                "D" => unserialize($v["ListeDuree"])
            ];
        }
        return $periodeGeneree;
    }
    else
    {
        return -1;
    }
}
?>