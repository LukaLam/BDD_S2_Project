<?php
include("connexion_bdd.php");
if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"])){
    $donnees['titre']=$_POST['titre'];
}
?>

<form method="post" action="Oeuvre_add.php">
    <div class="row">
        <fieldset>
            <legend>Ajouter une oeuvre</legend>
            <label>Titre
                <input name="titre" type="text" size="18" value=""/>
            </label>
            <label>Date de parution
                <input name="dateParution" type="text" size="18" value=""/>
            </label>
            <label>Identifiant de l'auteur
                <input name="idAuteur" type="text" size="18" value="1"/>
            </label>
            <input type="submit" name="AddOeuvre" value="Ajouter une oeuvre">
        </fieldset>
    </div>
</form>
