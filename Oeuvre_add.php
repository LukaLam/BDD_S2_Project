<?php
include("connexion_bdd.php");
include("v_head.php");
include("v_nav.php");

if(isset($_POST["titre"]) AND isset($_POST["dateParution"]) AND isset($_POST["idAuteur"])){
    // Contrôle des données
    $donnees['titre']=htmlentities($_POST['titre']);
    $donnees['dateParution']=htmlentities($_POST['dateParution']);
    $donnees['idAuteur']=htmlentities($_POST['idAuteur']);

    $erreurs=array();
    if( !preg_match("/^[A-Za-z ]{2,}/", $donnees["titre"])){
        $erreurs["titre"] = "Le nom doit être composé de deux lettres minimum.";
    }
    if(!preg_match("#^([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})$#", $donnees["dateParution"], $matches)){
        $erreurs["dateParution"] = "La date doit être au format JJ/MM/AAAA";
    } else {
        if(!checkdate($matches[2], $matches[1], $matches[3])){
            $erreurs["dateParution"] = "La date n'est pas valide.";
        } else {
            $donnees["dateParution"]=$matches[3]."-".$matches[2]."-".$matches[1];
        }
    }

    if(! is_numeric($donnees['idAuteur'])) $erreurs['idAuteur'] = 'saisir une valeur';

    if(empty($erreurs)){

        $donnees['titre']=$bdd->quote($donnees['titre']);
        $ma_requete_SQL="INSERT INTO OEUVRE (noOeuvre, titre, dateParution, idAuteur)
        VALUES (NULL,'".$donnees["titre"]."','".$donnees["dateParution_us"]."','".$donnees["idAuteur"]."')";
        $bdd->exec($ma_requete_SQL);
        header("Location: Oeuvre_show.php");
    }
    else{
        $message="il y a des erreurs => réafficher la vue ( formulaire avec les erreurs)";
    }
}else{
    $donnees['dateParution']=date('d/m/Y');
}

$ma_requete_SQL="SELECT idAuteur,nomAuteur FROM AUTEUR ORDER BY nomAuteur;";
$reponse = $bdd->query($ma_requete_SQL);
$donneesAuteur=$reponse->fetchAll();


?>

<form method="post" action="Oeuvre_add.php">
    <div class="container">
        <fieldset>
            <legend>Ajouter une oeuvre</legend>
            <label>Titre
                <input name="titre" type="text" size="18" value="<?php if(isset($donnees['titre'])) echo $donnees['titre']; ?>"/>
            </label>
            <?php if(isset($erreurs['titre'])) echo '<div class="alert alert-danger">'.$erreurs['titre'].'<div>'; ?>
            <label>Date de parution
                <input name="dateParution" type="date" size="18" value="<?php if(isset($donnees['dateParution'])) echo $donnees['dateParution']; ?>"/>
            </label>
            <?php if(isset($erreurs['dateParution'])) echo '<div class="alert alert-danger">'.$erreurs['dateParution'].'</div>'; ?>
            <label>Auteur :
                <select name="idAuteur">
                    <?php if(!isset($donnees['idAuteur']) or $donnees['idAuteur']==""): ?>
                        <option value="">Saisir une valeur</option>
                    <?php endif; ?>
                    <?php foreach($donneesAuteur as $auteur): ?>
                        <option value=""<?php echo $auteur['idAuteur']; ?>"
                            <?php if(isset($donnees['idAuteur']) and $donnees['idAuteur']==$auteur['idAuteur'])echo "selected"; ?>
                    >
                            <?php echo $auteur['nomAuteur']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <?php if(isset($erreurs['idAuteur'])) echo '<div class="alert alert-danger">'.$erreurs['idAuteur'].'</div>'; ?>

            <input type="submit" name="AddOeuvre" value="Ajouter"/>
        </fieldset>
    </div>
</form>
<?php include("v_foot.php"); ?>





