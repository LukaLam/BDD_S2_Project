<?php
/**
 * Created by PhpStorm.
 * User: llambalo
 * Date: 04/04/18
 * Time: 10:36
 */


include("connexion_bdd.php");
 include("v_head.php");
  include("v_nav.php");

// ## accès au modèle
$ma_commande_SQL = "
SELECT au.nomAuteur, au.prenomAuteur, au.idAuteur, count(oe.noOeuvre) as nbrOeuvre
FROM OEUVRE oe
RIGHT JOIN AUTEUR au On au.idAuteur=oe.idAuteur
GROUP BY au.nomAuteur,au.prenomAuteur,au.idAuteur
ORDER BY au.nomAuteur;
";


$reponse = $bdd->query($ma_commande_SQL);
$donnees = $reponse->fetchAll();
// ## test
//echo "<pre>"; print_r($donnees); echo "</pre>";
//## affichage de la vue
?>

<div class="row">
    <a href="Auteur_add.php"> Ajouter un Auteur </a>
    <table border="2">
        <caption>Récapitulatif des auteurs</caption>
        <?php if(isset($donnees[0])): ?>
            <thead>
            <tr>
                <th>Nom de l'auteur</th>
                <th>Prenom de l'auteur</th>
                <th>Nombre d'oeuvres</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($donnees as $value): ?>
                <tr>
                    <td><?php echo $value['nomAuteur'];?></td>
                    <td><?php echo $value['prenomAuteur']; ?></td>
                    <td><?php echo $value['nbrOeuvre']; ?></td>
                    <td>
                        <a href="Auteur_edit.php?id=<?= $value['idAuteur']; ?>">Modifier</a>
                        <a href="Auteur_delete.php?id=<?= $value['idAuteur']; ?>">Supprimer</a>
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
<?php "v_foot.php"?>