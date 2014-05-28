<?php
	include_once('../inc/connect.inc.php');
	include_once('../prive/param_bd.php');
	
	$connexion = connexion_bd(SERVEUR,LOGIN,PASSWORD,BASE);
	
	////////////////////////////////////////////////
	///////// INSCRIRE UN NOUVEAU BEST_SCORE ///////
	////////////////////////////////////////////////
	$new_score = $_POST['score'];
	$name = $_POST['name'];
	
	$verif_best_score = "SELECT * FROM jeux WHERE score < '".$new_score."' ORDER BY score DESC LIMIT 10";
	$resultat_best_score = mysql_query($verif_best_score, $connexion);
		
	if(mysql_num_rows($resultat_best_score) > 0){		
		while ($bad_score = mysql_fetch_assoc($resultat_best_score))
		{
			$plus_mauvais = $bad_score['id'];
		}		
		if(!empty($name)){
			$requete_delete = "DELETE FROM jeux WHERE id='$plus_mauvais'";
			$resultat_delete = mysql_query($requete_delete, $connexion);
			
			$requete_ajout = "INSERT INTO jeux (pseudo, score) value ('$name', '$new_score')";
			$resultat_ajout = mysql_query($requete_ajout, $connexion);
		}		
	}
		
	$requete = "SELECT * FROM jeux ORDER BY score DESC LIMIT 10";
	$resultat = mysql_query($requete, $connexion);
	
	
	$best_score = "";
	while ($score = mysql_fetch_assoc($resultat))
	{
		$best_score.= "<span class=\"line\">";
		$best_score.= $score['score'] . " " . $score['pseudo'];
		$best_score.= "</span>";
	}
	echo $best_score;
?>
