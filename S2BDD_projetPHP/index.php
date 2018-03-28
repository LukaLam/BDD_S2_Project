<?php
include("connexion_bdd.php");
include("v_head.php");
include ("v_nav.php");
include ("v_foot.php");
// ## accés au modèle
$ma_commande_SQL = "SELECT OEUVRE.titre, OEUVRE.noOeuvre, OEUVRE.idAuteur, OEUVRE.dateParution
FROM OEUVRE
ORDER BY OEUVRE.titre;";
$reponse = $bdd->query($ma_commande_SQL);
$donnees = $reponse->fetchAll();
// ## test
echo "<pre>"; print_r($donnees); echo "</pre>";
//## affichage de la vue
?>