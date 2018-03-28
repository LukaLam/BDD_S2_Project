<?php
include("connexion_bdd.php");

// ## accès au modèle
$ma_commande_SQL = "SELECT OEUVRE.titre, OEUVRE.noOeuvre, OEUVRE.idAuteur, OEUVRE.dateParution
FROM OEUVRE
ORDER BY OEUVRE.titre;";
$reponse = $bdd->query($ma_commande_SQL);
$donnees = $reponse->fetchAll();
// ## test
//echo "<pre>"; print_r($donnees); echo "</pre>";
//## affichage de la vue
?>

<div class="row">
    <a href="Oeuvre_add.php"> Ajouter une oeuvre </a>
    <table border="2">
        <caption>Récapitulatif des oeuvres</caption>
        <?php if(isset($donnees[0])): ?>
            <thead>
            <tr>
                <th>Titre de l'oeuvre</th>
                <th>Identifiant auteur</th>
                <th>Date de parution</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($donnees as $value): ?>
                <tr>
                    <td><?php echo $value['titre'];?></td>
                    <td><?php echo $value['idAuteur']; ?></td>
                    <td><?php echo $value['dateParution']; ?></td>
                    <td>
                        <a href="Oeuvre_edit.php?id=<?= $value['noOeuvre']; ?>">Modifier</a>
                        <a href="Oeuvre_delete.php?id=<?= $value['noOeuvre']; ?>">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        <?php else :?>
            <tr>
                <td>Pas d'oeuvre dans la base de données.</td>
            </tr>
        <?php endif ; ?>
    </table>
</div>
