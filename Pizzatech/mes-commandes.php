<!-- Montre les erreurs-->
<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>


<!-- Inclus connexion db -->
<?php include 'server.php'?>

<!doctype html>
<html lang="fr">
    <!-- aide de Thomas
        1. récupérer toutes les commandes d'un utilisateur en fonction de son perso_id

        $commandes = SELECT * FROM `commande` WHERE commande.perso_id = 13;

        2. faire une boucle sur toutes les commandes de l'utilisateur pour récupérer les lignes d'une commande

        foreach ($commande of $commandes) {
            $id_commande = $commande.id_cmd;
            $lignes_commande = SELECT * FROM `ligne`, `article` WHERE ligne.cmd_id = $id_commande AND ligne.art_id = article.art_id;
        }
        
        $currentUsername = $_SESSION['username'];
        $queryPersoID = "SELECT perso_id FROM personne WHERE perso_username = '$currentUsername'";
        $resultPersoID = mysqli_query($conn, $queryPersoID);
        while ($row = mysqli_fetch_object($resultPersoID)) {
            $_SESSION['userID'] = $row->perso_id;
        }

    -->

    <?php $title = "Mes commandes"?>

    <?php include 'head.php'?>

    <body>
        <?php include 'navbar.php'?>
        <div class="container my-3">
            <h2>Mes commandes</h2>
            <div class="accordion" id="accordionExample">

                <?php $i = 0; ?>

                <?php while($row = mysqli_fetch_object($resultCommandes)) :?>
                    <?php $i++; ?>
                    <div class="card card-collapse">
                        <div class="card-header" id="heading<?= $i ; ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-collapse <?php if($i >= 2){echo "collapsed";} ?> " type="button" data-toggle="collapse" data-target="#collapse<?= $i ; ?>" aria-expanded="<?php if( $i >= 2 ){echo "false";} else{echo"true";} ?>" aria-controls="collapse<?= $i ; ?>">
                            <?php $commandeValide = $row->cmd_valide ?>
                            Commande N°<?= $row->cmd_id ?> | <?= $row->cmd_date ?> | Total : <?= $row->cmd_prix ?>€ | <?php if($commandeValide == 0 ){echo "<span class='text-danger'>Commande non validée</span>";} ?><?php if($commandeValide == 1 ){echo "<span class='text-success'>Commande validée</span>";} ?>
                            </button>
                        </h2>
                        </div>

                        <div id="collapse<?= $i ; ?>" class="collapse <?php if($i == 1){echo "show";} ?>" aria-labelledby="heading<?= $i ; ?>" data-parent="#accordionExample">
                        <div class="card-body">
                            <?php $idCommande = $row->cmd_id ?>
                            <?php $sqlCommande = "SELECT * FROM `ligne`, `article` WHERE ligne.cmd_id = $idCommande AND ligne.art_id = article.art_id"; ?>
                            <?php $resultCommande = mysqli_query($conn, $sqlCommande); ?>
                            <?php while($row = mysqli_fetch_object($resultCommande)) :?>
                            <p><?= $row->art_nom ?> x<?= $row->lig_quantite ?></p>
                            <?php endwhile ; ?>
                        </div>
                        </div>
                    </div>
                <?php endwhile;?>
            </div>
        </div>
    </body>

</html>