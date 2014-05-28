<?php
function connexion_bd($serveur, $login, $password, $base) {
  // Connexion au serveur MySQL
	$connexion_bd = mysql_connect($serveur, $login, $password)
    or die("Impossible de se connecter : " . mysql_error());

	// S�lection de la base
	$selection_bd = mysql_select_db($base, $connexion_bd)
    or die ("Impossible de sélectionner la base de données : " . mysql_error());
	
	return $connexion_bd;
}
?>
