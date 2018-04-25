<?php
include("connexion_bdd.php");
include("v_head.php");
include("v_nav.php");

if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"])){

    // Contrôle des données
    $donnees['titre']=htmlentities($_POST['titre']);
    $donnees['dateParution']=htmlentities($_POST['dateParution']);
    $donnees['idAuteur']=htmlentities($_POST['idAuteur']);
    //Accès au modèle
    $ma_requete_SQL = "INSERT INTO OEUVRE (noOeuvre, titre, dateParution, idAuteur)
      VALUES (NULL, '".donnees['titre']."','".donnees['dateParution']."',".donnees['idAuteur'].");";
    $bdd->exec($ma_requete_SQL);


    //Redirection
    header("Location: Oeuvre_show.php");
}
$ma_requete_SQL="SELECT idAuteur,nomAuteur FROM AUTEUR ORDER BY nomAuteur;";
$reponse=$bdd->query($ma_requete_SQL);
$donneesAuteur = $reponse->fetchAll();
?>

<form method="post" action="Oeuvre_add.php">
    <div class="row">
        <fieldset>
            <legend>Ajouter une oeuvre</legend>
            <label>Titre
                <input name="titre" type="text" size="18" value=""/>
            </label>
            <label>Date de parution
                <input name="dateParution" type="date" size="18" value=""/>
            </label>
            <label>Identifiant de l'auteur
                <input name="idAuteur" type="text" size="18" value="1"/>
            </label>
            <input type="submit" name="AddOeuvre" value="Ajouter une oeuvre"/>
        </fieldset>
    </div>
</form>
<?php include("v_foot.php"); ?>





