<?php
include("connexion_bdd.php");
include("v_head.php");
include("v_nav.php");

if(isset($_GET["id"]) AND is_numeric($_GET["id"])){
    //Accès au modèle
    $id=htmlentities($_GET['id']);
    $ma_requete_SQL="SELECT au.idAuteur, au.nomAuteur, au.prenomAuteur FROM AUTEUR au WHERE idAuteur=".$id.";";
    $reponse = $bdd->query($ma_requete_SQL);
    $donnees = $reponse->fetch();
}

if(isset($_POST["idAuteur"]) AND isset($_POST["nomAuteur"]) AND isset($_POST['prenomAuteur'])){
    //contrôle des données
    $donnees['idAuteur']=htmlentities($_POST['idAuteur']);
    $donnees['nomAuteur']=htmlentities($_POST['nomAuteur']);
    $donnees['prenomAuteur']=htmlentities($_POST['prenomAuteur']);
    //accès au modèle
    $ma_requete_SQL = "UPDATE AUTEUR SET nomAuteur='".$donnees['nomAuteur']."', prenomAuteur='".$donnees['prenomAuteur']."' WHERE idAuteur =".$donnees['idAuteur'].";";
    var_dump($ma_requete_SQL);
    $bdd->exec($ma_requete_SQL);
    // redirection
    header("Location: Auteur_show.php");
}

?>

<form method="post" action="Auteur_edit.php">
    <div class="row">
        <fieldset>
            <legend>Modifier un Auteur</legend>
            <!-- Champ caché avec l'id pour conserver la valeur de l'id lors de la validation !-->
            <input name="idAuteur" type="hidden" value="<?php if(isset($donnees['idAuteur'])) echo $donnees['idAuteur']; ?> "/>


            <label>Nom de l'auteur :
                <input name="nomAuteur" type="text" size="18" value="<?php if(isset($donnees['nomAuteur'])) echo $donnees['nomAuteur']; ?>"/>
            </label>
            <br>
            <label>Prenom de l'auteur :
                <input name="prenomAuteur" type="text" size="18" value="<?php if(isset($donnees['prenomAuteur'])) echo $donnees['prenomAuteur']; ?>"/>
            </label>
            <br>

            <input name="ModifierAuteur" type="submit" value="Modifier" />
        </fieldset>
    </div>
</form>

<?php include("v_foot.php");