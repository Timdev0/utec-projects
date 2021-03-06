<!-- Montre les erreurs-->
<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>


<!-- Inclus connexion db -->
<?php include 'server.php'?>

<!doctype html>
<html lang="fr">

    <?php $title = "Les commandes"?>

    <?php include 'head.php'?>

    <body>
        <?php include 'navbar.php'?>
        <div class="container my-3">
            <h2>Les commandes</h2>
            <div class="accordion" id="accordionExample">

                <?php $i = 0; ?>

                <?php while($row1 = mysqli_fetch_object($resultAllCommandes)) :?>
                    <?php $idPerso = $row1->perso_id?>
                    <?php $i++; ?>
                    <div class="card card-collapse">
                        <div class="card-header" id="heading<?= $i ; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-collapse <?php if($i >= 2){echo "collapsed";} ?> " type="button" data-toggle="collapse" data-target="#collapse<?= $i ; ?>" aria-expanded="<?php if( $i >= 2 ){echo "false";} else{echo"true";} ?>" aria-controls="collapse<?= $i ; ?>">
                            <?php $commandeValide = $row1->cmd_valide ?>
                            Commande N°<?= $row1->cmd_id ?> | <?= $row1->cmd_date ?> | Total : <?= $row1->cmd_prix ?>€ | <?php if($commandeValide == 0 ){echo "<span class='text-danger'>Commande non validée</span>";} ?><?php if($commandeValide == 1 ){echo "<span class='text-success'>Commande validée</span>";} ?>
                            </button>
                        </h2>
                        </div>

                        <div id="collapse<?= $i ; ?>" class="collapse <?php if($i == 1){echo "show";} ?>" aria-labelledby="heading<?= $i ; ?>" data-parent="#accordionExample">
                            <div class="card-body">
                                <?php $idCommande = $row1->cmd_id ?>
                                <?php $sqlCommande = "SELECT * FROM `ligne`, `article` WHERE ligne.cmd_id = $idCommande AND ligne.art_id = article.art_id"; ?>
                                <?php $resultCommande = mysqli_query($conn, $sqlCommande); ?>
                                <?php while($row2 = mysqli_fetch_object($resultCommande)) :?>
                                    <p><?= $row2->art_nom ?> x<?= $row2->lig_quantite ?></p>
                                <?php endwhile ; ?>

                                <?php $sqlPersoCommande = "SELECT * FROM `personne` WHERE perso_id = $idPerso";?>
                                <?php $resultPersoCommande = mysqli_query($conn, $sqlPersoCommande);?>
                                <?php while ($row3 = mysqli_fetch_object($resultPersoCommande)): ?>
                                    <p>Commander par : <?=$row3->perso_prenom?> <?=$row3->perso_nom?></p>
                                <?php endwhile;?>


                                <?php if($commandeValide == 0):?>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $i ; ?>">
                                        Valider la commande
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal<?= $i ; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Valider la commande ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous vraiment valider la commande : <br>Commande N°<?= $row1->cmd_id ?> - <?= $row1->cmd_date ?> - Total : <?= $row1->cmd_prix ?>€  ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <form method="post" action="les-commandes.php">
                                                        <input type="hidden" name="hidden_id" value="<?php echo $row1->cmd_id; ?>" />
                                                        <input type="submit" name="validation" class="btn btn-primary" value="Valider" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </body>

</html>