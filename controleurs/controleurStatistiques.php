<?php
// Nombre d'instances des 3 tables
$table = "Commune";
$nb = nbInstances($connexion,$table);

$tab = "Region";
$nb1 = nbInstances($connexion,$tab);

$tab2 = "Departement";
$nb2 = nbInstances($connexion,$tab2);
$total = $nb+$nb1+$nb2;

// top 3 des departements avec le plus de communes
$top3Dep = Top3Depart($connexion);

// top 3 des services les plus demandés
$top3Service = Top3ServicesDemandes($connexion);

// top 3 des services les plus proposés par les communes
$top3ServiceProp = Top3ServicesProposes($connexion);

// liste des enfants avec leur ecole
$ListeEnfant = listeEnfants($connexion);

// paire d'enfants
$paireEnf = paireEnfants($connexion);

// fonction top3 communes nbunions
$topUnion = top3NbUnions($connexion);

// liste enfants et cantine ou ils mangent le 01/01/2024
$cantine = listeEnfCantine($connexion);


?>