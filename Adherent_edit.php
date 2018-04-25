<?php
include("connexion_bdd.php");
$titreLocal = "Modifier un adhérent";
include("v_head.php");
include("v_nav.php");

if(isset($_GET["id"]) AND is_numeric($_GET["id"])){

    $id = htmlentities($_GET["id"]);
    $ma_requete_SQL = "SELECT ADHERENT.nomAdherent, ADHERENT.idAdherent, ADHERENT.adresse, ADHERENT.datePaiement
        FROM ADHERENT
        WHERE idAdherent = ".$id.";";
    $reponse = $bdd->query($ma_requete_SQL);
    $donnees = $reponse->fetch();
}

if(isset($_POST["nomAdherent"]) AND isset($_POST["adresse"]) AND isset($_POST["datePaiement"])){
    $donnees["nomAdherent"]=htmlentities($_POST["nomAdherent"]);
    $donnees["adresse"] = htmlentities($_POST["adresse"]);
    $donnees["datePaiement"]=htmlentities($_POST["datePaiement"]);
    $donnees["idAdherent"]=htmlentities($_POST["idAdherent"]);

    $erreurs=array();
    if( !preg_match("/^[A-Za-z ]{2,}/", $donnees["nomAdherent"])){
        $erreurs["nomAdherent"] = "Le nom doit être composé de deux lettres minimum.";
    }
    if( !preg_match("/^[A-Za-z ]{2,}/", $donnees["adresse"])){
        $erreurs["adresse"] = "L'adresse doit être composée de deux lettres minimum.";
    }
    if(!preg_match("#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#", $donnees["datePaiement"], $matches)){
        $erreurs["datePaiement"] = "La date doit être au format JJ/MM/AAAA";
    } else {
        if(!checkdate($matches[2], $matches[1], $matches[3])){
            $erreurs["datePaiement"] = "La date n'est pas valide.";
        } else {
            $donnees["datePaiement"]=$matches[3]."-".$matches[2]."-".$matches[1];
        }
    }

    if(empty($erreurs)){
        $ma_requete_SQL="UPDATE ADHERENT SET
          nomAdherent = '". $donnees["nomAdherent"]."', 
          adresse = '". $donnees["adresse"]."', 
          datePaiement = '". $donnees["datePaiement"]."'
          WHERE idAdherent =". $donnees["idAdherent"]. ";";
        echo $ma_requete_SQL;
        $bdd->exec($ma_requete_SQL);
        header("Location: Adherent_show.php");
    }
}
?>

    <form method="post" action="Adherent_edit.php">
        <div class="row">
            <fieldset>
                <legend>Modifier un adhérent</legend>

                <input name="idAdherent" type="hidden" value="<?php if(isset($donnees["idAdherent"])){ echo $donnees["idAdherent"];} ?>" />
                <br>

                <label>Nom
                    <input name="nomAdherent" type="text" size="18" value="<?php if(isset($donnees["nomAdherent"])){echo $donnees["nomAdherent"];}?>" />
                    <?php if(!empty($erreurs)){echo "<br>".$erreurs["nomAdherent"];};?>
                </label>
                <br>

                <label>Adresse
                    <input name="adresse" type="text" size="18" value="<?php if(isset($donnees["adresse"])){echo $donnees["adresse"];}?>" />
                    <?php if(!empty($erreurs)){echo "<br>".$erreurs["adresse"];};?>
                </label>
                <br>

                <label>Date de paiement
                    <input name="datePaiement" type="date" size="18" value="<?php if(isset($donnees["datePaiement"])){echo $donnees["datePaiement"];}?>" />
                    <?php if(!empty($erreurs)){echo "<br>".$erreurs["datePaiement"];};?>
                </label>
                <br>

                <input type="submit" name="EditAdherent" value="Modifier">
            </fieldset>
        </div>
    </form>

<?php include("v_foot.php"); ?>