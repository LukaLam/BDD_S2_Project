<?php
 include("v_head.php");
  include("v_nav.php");
/**
 * Created by PhpStorm.
 * User: llambalo
 * Date: 28/03/18
 * Time: 11:59
 */
include("connexion_bdd.php");
if(isset($_POST["nomAuteur"]) AND isset($_POST["prenomAuteur"])){
    $donnees['nomAuteur']=htmlentities($_POST['nomAuteur']);
    $donnees['prenomAuteur']=htmlentities($_POST['prenomAuteur']);
    $ma_requete_SQL='INSERT INTO AUTEUR(idAuteur,nomAuteur,prenomAuteur) VALUES(NULL,"'.$donnees['nomAuteur'].'","'.$donnees['prenomAuteur'].'");';
    $bdd->exec($ma_requete_SQL);
    header("Location: Auteur_show.php");
}
?>

<form method="post" action="Auteur_add.php">
    <div class="row">
        <fieldset>
            <legend>Ajouter un auteur</legend>
            <label>Nom de l'auteur
                <input name="nomAuteur" type="text" size="18" value=""/>
            </label>
            <label>Prenom de l'auteur
                <input name="prenomAuteur" type="text" size="18" value=""/>
            </label>
            <input type="submit" name="AddAuteur" value="Ajouter un auteur">
        </fieldset>
    </div>
</form>
<?php include("v_foot.php");