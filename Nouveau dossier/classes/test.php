<?php
	include 'base_de_donnees.php';
	$dbtest = new bd();
	$dbtest->requete("Select * From jeux_video");
?>