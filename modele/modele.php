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
?>