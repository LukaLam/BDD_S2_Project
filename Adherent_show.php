<?php
$titreLocal = "Gestion des adhérents";
include("connexion_bdd.php");

$ma_commande_SQL = "SELECT ADHERENT.nomAdherent, ADHERENT.adresse, ADHERENT.datePaiement, ADHERENT.idAdherent,
	COUNT(EMPRUNT.idAdherent) AS nbrEmprunt,
	IF(CURRENT_DATE()>=DATE_ADD(ADHERENT.datePaiement, INTERVAL 1 YEAR),1,0) AS flagRetard,
	IF(CURRENT_DATE()>=DATE_ADD(ADHERENT.datePaiement, INTERVAL 11 MONTH),1,0) AS flagRetardProche,
	DATE_ADD(ADHERENT.datePaiement, INTERVAL 1 YEAR) as datePaiementFutur
FROM ADHERENT
LEFT JOIN EMPRUNT ON ADHERENT.idAdherent = EMPRUNT.idAdherent
GROUP BY (ADHERENT.idAdherent)
ORDER BY ADHERENT.nomAdherent;";
$reponse = $bdd->query($ma_commande_SQL);
$donnees = $reponse->fetchAll();
?>

<?php include("v_head.php"); ?>
<?php include("v_nav.php"); ?>

<div class="row">
    <a href="Adherent_add.php">Ajouter un adhérent</a>
    <table border="2">
        <caption>Récapitulatif des adhérents</caption>
        <?php if(isset($donnees[0])): ?>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>datePaiement</th>
                <th>Information</th>
                <th>Opérations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($donnees as $value): ?>
            <tr>
                <td><?php echo $value['nomAdherent']; ?></td>
                <td><?php echo $value['adresse']; ?></td>
                <td><?php echo $value['datePaiement']; ?></td>
                <td><?php if($value['nbrEmprunt']>0){echo $value['nbrEmprunt']." emprunt(s) en cours";}
                if($value['nbrEmprunt']>0 && $value['flagRetard']==1){ echo "<br>";}
                if($value['flagRetard']==1){ echo "<span style='color:red'>Paiement en retard depuis : ". $value['datePaiementFutur']."</span>";}
                if($value['flagRetardProche']==1 && $value['flagRetard']!=1){ echo "Paiement à renouveler";}?></td>
                <td>
                    <a href="Adherent_edit.php?id=<?php echo $value['idAdherent']; ?>">Modifier</a>
                    <a href="Adherent_delete.php?id=<?php echo $value['idAdherent']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <?php else: ?>
        <tr>
            <td>Pas d'adhérents dans la base de données</td>
        </tr>
        <?php endif; ?>
    </table>
</div>
