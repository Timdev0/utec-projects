<!-- Montre les erreurs-->
<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>

<!-- Inclus connexion db -->
<?php include '../server.php'?>
<?php include 'server-parametre.php'?>

<!doctype html>
<html lang="fr">

    <?php $title = "Paramètres Employé"?>
    
    <?php include '../head.php'?>

    <body>

        <?php include '../navbar.php'?>

        <?php include 'errors.php' ?>

        <div class="container my-3">
            <h2>Paramètres employé</h2>
            <div class="accordion" id="accordionExample">
                <div class="card card-collapse">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-collapse" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Ajouter un produit
                        </button>
                    </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">

                        <form method="post" action="employe.php">
            

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="categorie">Catégorie</label>
                                    <select id="categorie" class="form-control" name="categorie">
                                        <option value="">Choisir une catégorie</option>
                                        <option value="1" <?php if($categorie == 1){echo"selected";} ?> >Dessert</option>
                                        <option value="2" <?php if($categorie == 2){echo"selected";} ?> >Pizza</option>
                                        <option value="3" <?php if($categorie == 3){echo"selected";} ?> >Boisson</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nom">Nom</label>
                                    <input id="nom" class="form-control" type="text" name="nom" value="<?php echo $nom; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="prix">Prix</label>
                                    <input id="prix" class="form-control" type="number" min="0.00" max="10000.00" step="0.01" name="prix" value="<?php echo $prix; ?>">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="desc">Description</label>
                                <input id="desc" class="form-control" type="text" name="desc" value="<?php echo $desc; ?>">
                            </div>

                            <div class="form-group">
                                <label for="img">Image</label>
                                <input id="img" class="form-control" type="text" name="img" value="<?php echo $img; ?>">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="produit">Enregistrer</button>
                            </div>
            
                        </form>

                    </div>
                    </div>
                </div>
                <div class="card card-collapse">
                    <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-collapse collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Modifier les produits
                        </button>
                    </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">

                        <?php if(mysqli_num_rows($resultArtcilesAll) > 0) : ?>
                            <?php $i = 0; ?>
                            <?php while($rowArticles = mysqli_fetch_object($resultArtcilesAll)) : ?>
                            <?php $i++; ?>

                            <div class="container">

                                <div class="row" style="border-bottom: 1px solid grey; margin-bottom:1rem;">

                                    <div style="width: 33%;">
                                        <p style="margin-bottom:1rem;">
                                            ID : 
                                            <?= $rowArticles->art_id ?>
                                        </p>
                                    </div>
                                    <div style="width: 33%;">
                                        <p class="text-center "style="margin-bottom:1rem;">
                                            <?= $rowArticles->art_nom ?>
                                        </p>
                                    </div>
                                    <div style="width: 33%;">
                                        <p class="text-right" style="margin-bottom:1rem;">
                                            <button type="button" class="btn btn-primary text-right" data-toggle="modal" data-target="#modal<?= $i ; ?>">
                                                Modifier le produit
                                            </button>
                                            <button type="button" class="btn btn-danger text-right" data-toggle="modal" data-target="#modalSuppr<?= $i ; ?>">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <?php 
                            $categorieArt = $rowArticles->cat_id;
                            $idArtC = $rowArticles->art_id;
                            $nomArt = $rowArticles->art_nom;
                            $prixArt = $rowArticles->art_prix;
                            $descArt = $rowArticles->art_description;
                            $imageArt = $rowArticles->art_image;

                            ?>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="modal<?= $i ; ?>" tabindex="-1" role="dialog" aria-labelledby="modal<?= $i ; ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal<?= $i ; ?>Label">Modication article : <?= $idArtC ?> - <?= $nomArt ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                        <form method="post" action="employe.php">
                                            <div class="modal-body">
                                            
                                                <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label for="categorie">Catégorie</label>
                                                    <select id="categorie" class="form-control" name="categorieArt">
                                                        <option value="">Choisir une catégorie</option>
                                                        <option value="1" <?php if($categorieArt == 1){echo"selected";} ?> >Dessert</option>
                                                        <option value="2" <?php if($categorieArt == 2){echo"selected";} ?> >Pizza</option>
                                                        <option value="3" <?php if($categorieArt == 3){echo"selected";} ?> >Boisson</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="nom">Nom</label>
                                                    <input id="nom" class="form-control" type="text" name="nomArt" value="<?php echo $nomArt; ?>">
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="prix">Prix</label>
                                                    <input id="prix" class="form-control" type="number" min="0.00" max="10000.00" step="0.01" name="prixArt" value="<?php echo $prixArt; ?>">
                                                </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="desc">Description</label>
                                                    <input id="desc" class="form-control" type="text" name="descArt" value="<?php echo $descArt; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="img">Image</label>
                                                    <input id="img" class="form-control" type="text" name="imageArt" value="<?php echo $imageArt; ?>">
                                                </div>

                                                <input type="hidden" name="idArt" value="<?=$idArtC?>" />

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" name="produitModif">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="modalSuppr<?= $i ; ?>" tabindex="-1" role="dialog" aria-labelledby="modalSuppr<?= $i ; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalSuppr<?= $i ; ?>">Voulez-vous vraiment supprimer le produit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>ID : <?= $rowArticles->art_id ?></p>
                                            <p>Nom : <?= $rowArticles->art_nom ?></p>
                                            <img class="img-fluid" src="<?= $rowArticles->art_image ?>" alt="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <form method="post" action="employe.php">
                                                <input type="hidden" name="idArtSuppr" value="<?=$idArtC?>" />
                                                <button type="submit" class="btn btn-primary" name="produitSuppr">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endwhile ; ?>

                        <?php endif ; ?>

                    </div>
                    </div>
                </div>
            </div>

        </div>
        
    </body>

</html>