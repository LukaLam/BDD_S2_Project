<?php
include("connexion_bdd.php");
echo "Test";
if(isset($_GET["id"]) AND is_numeric($_GET["id"])) {
    $id = htmlentities($_GET["id"]);
    $ma_requete_SQL = "DELETE FROM ADHERENT WHERE idAdherent = " . $id.";";
    echo $ma_requete_SQL;
    $bdd->exec($ma_requete_SQL);

    header("Location: Adherent_show.php");
}
?>