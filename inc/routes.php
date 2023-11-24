<?php

/*
** Il est possible d'automatiser le routing, notamment en cherchant directement le fichier controleur et le fichier vue.
** ex, pour page=afficher : verification de l'existence des fichiers controleurs/controleurAfficher.php et vues/vueAfficher.php
** Cela impose un nommage strict des fichiers.
*/

$routes = array(
	'statistique' => array('controleur' => 'controleurStatistiques', 'vue' => 'vueStatistiques'),
	'service' => array('controleur' => 'controleurService', 'vue' => 'vueService'),
	'formulaire' => array('controleur' => 'controleurService', 'vue' => 'vueFormulaire'),
	'listeService' => array('controleur' => 'controleurService', 'vue' => 'vueListeServices'),
	'periodeEssai' => array('controleur' => 'controleurService', 'vue' => 'vuePeriodeDessai')
);

// fichiers statiques
$pathHeader = 'static/header.php';
$pathMenu = 'static/menu.php';
$pathFooter = 'static/footer.php';
$controleurAccueil = 'controleurAccueil';
$vueAccueil = 'vueAccueil';
?>
