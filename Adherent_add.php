<?php
$titreLocal = "Ajouter un adhérent";
include ("connexion_bdd.php");
include("v_head.php");
include("v_nav.php");

if(isset($_POST["nomAdherent"]) AND isset($_POST["adresse"]) AND isset($_POST["datePaiement"])){
    $donnees["nomAdherent"]=htmlentities($_POST["nomAdherent"]);
    $donnees["adresse"] = htmlentities($_POST["adresse"]);
    $donnees["datePaiement"]=htmlentities($_POST["datePaiement"]);

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
        $ma_requete_SQL="INSERT INTO ADHERENT (idAdherent, nomAdherent, adresse, datePaiement)
        VALUES (NULL,'".$donnees["nomAdherent"]."','".$donnees["adresse"]."','".$donnees["datePaiement"]."')";
        $bdd->exec($ma_requete_SQL);
        header("Location: Adherent_show.php");
    }
}
?>

<form method="post" action="Adherent_add.php">
    <?php echo $ma_requete_SQL;?>
    <div class="row">
        <fieldset>
            <legend>Ajouter un adhérent</legend>
            <label>Nom
                <input name="nomAdherent" type="text" size="18" value=""/>
                <?php if(!empty($erreurs)){echo "<br>".$erreurs["nomAdherent"];};?>
            </label>
            <br>
            <label>Adresse
                <input name="adresse" type="text" size="18" value=""/>
                <?php if(!empty($erreurs)){echo "<br>".$erreurs["adresse"];};?>
            </label>
            <br>
            <label>Date de paiement
                <input name="datePaiement" type="date" size="18" value=""/>
                <?php if(!empty($erreurs)){echo "<br>".$erreurs["datePaiement"];};?>
            </label>
            <br>
            <input type="submit" name="AddAdherent" value="Ajouter">
        </fieldset>
    </div>
</form>

<?php
include("v_foot.php");
?>
