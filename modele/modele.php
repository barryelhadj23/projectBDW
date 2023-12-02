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
	JOIN Commune ON Departement.Code_INSEE_D = Commune.Code_INSEE_D
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
			FROM Service JOIN Demande on (Service.idService = Demande.idService)
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
			FROM Service JOIN Propose ON (Service.idService = Propose.idService)
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
        "	SELECT NomEnf, PrenomEnf, NomE FROM Ecole NATURAL JOIN Enfant LIMIT 5
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
// top 3
function Top3 ($connexion, $tab1, $tab2, $affiche,$count)
{
    $requete =
        "	SELECT $affiche, COUNT(*) as $count
			FROM $tab1 JOIN $tab2 
			GROUP BY $affiche
			ORDER BY $count DESC
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
				LEFT JOIN Union_civile uc ON p.idService = uc.idD
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
				NATURAL JOIN
    				Periode P
				WHERE
  				    P.DebutMangeCANT <= '2024-01-01'
    			AND P.FinMangeCANT >= '2024-01-01'
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
    $requete = "SELECT NomC FROM Commune ORDER BY NomC ASC";
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


// fonction qui insere un nouveau service
function insertService($connexion, $libelle,$description,$payant)
{
    $req = "	INSERT INTO `Service`(`Libellé_S`, `Description`, `boolPayant`)
	 			VALUES (?,?,?)
			";
    $etat = mysqli_prepare($connexion,$req);
    $libelleSur = traitement_donnees($connexion,$libelle);
    $descriptionSur = traitement_donnees($connexion,$description);
    mysqli_stmt_bind_param($etat,"ssi",$libelleSur,$descriptionSur,$payant);
    mysqli_stmt_execute($etat);
}

// fonction qui recupere l'id de la commune
function idCommune($connexion, $com)
{
    $req = "SELECT idComAuto FROM Commune WHERE NomC LIKE '%$com%'";
    $res = mysqli_query($connexion, $req);
    if($res!= FALSE)
    {
        $var = mysqli_fetch_assoc($res);
        return $var['idComAuto'];
    }
    else
        return -1;
}

//fonction qui recupere l id du service
function idService($connexion,$libelle_s)
{
    $req = "SELECT idService FROM Service  WHERE Libellé_S LIKE '%$libelle_s%'";
    $res = mysqli_query($connexion, $req);
    if($res!= FALSE)
    {
        $var = mysqli_fetch_assoc($res);
        return $var['idService'];
    }
    else
        return -1;
}

// fonction qui rempli la table periode_ouverture du service de la commune
function inserePeriodeOverture($connexion,$dateDebut,$dateFin,$test)
{
    if($test == 1) // le retour de la fonction verfiedate qui verfie que ce sont des dates relles et debut < fin
    {
        $req = "INSERT INTO `Periode_Ouverture`(`ouverture`, `fermeture`) VALUES (?,?)";
        $statement = mysqli_prepare($connexion,$req);
        mysqli_stmt_bind_param($statement,"ss",$dateDebut,$dateFin);
        mysqli_stmt_execute($statement);
    }

}

// fonction qui rempli la table propose entre commune et service
function insertPropose($connexion,$idCom,$idService)
{
    $req = "INSERT INTO `Propose`(`IdComAuto`, `idService`) VALUES (?,?)";
    $etat = mysqli_prepare($connexion,$req);
    mysqli_stmt_bind_param($etat,"ii",$idCom,$idService);
    mysqli_execute($etat);

}

// fonction qui rempli la table Ouvert
function insertOuvert($connexion,$idCom,$idService,$dateDebut,$dateFin,$test)
{
    if($test==1)
    {
        $req = "INSERT INTO `Ouvert`(`IdComAuto`, `idService`, `ouverture`, `fermeture`) VALUES (?,?,?,?)";
        $etat = mysqli_prepare($connexion,$req);
        mysqli_stmt_bind_param($etat,"iiss",$idCom,$idService,$dateDebut,$dateFin);
        mysqli_stmt_execute($etat);
    }
}

?>