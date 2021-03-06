<!-- Montre les erreurs-->
<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>


<!-- Inclus connexion db -->
<?php include 'server.php'?>

<!--  Panier -->
<?php
$errors = array();

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
            );

            foreach($_SESSION["shopping_cart"] as $keys => $values){
                if ($keys == $count){
                    $count++;
                }
            }

            $_SESSION["shopping_cart"][$count] = $item_array;

		}
		else
		{
            //array_push($errors, "Article déjà ajouté");
            // ajouter au panier sans suppr (addition quantitié)
            
            $i = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values){
                if ($values["item_id"] == $_GET["id"]){
                    $j = $i;
                }
                $i++;
            }
            $_SESSION["shopping_cart"][$j]["item_quantity"] ++;
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
                unset($_SESSION["shopping_cart"][$keys]);
                break;
                echo '<script>window.location="commander.php"</script>';
			}
		}
	}
}
?>

<!doctype html>
<html lang="fr">

    <?php $title = "Commander"?>

    <?php include 'head.php'?>

   <body id="commander">

        <?php include 'navbar.php'?>
            <?php if (count($errors) > 0): ?>
            <div class="error bg-danger text-white">
                    <p class="error-msg text-center">
                    <?php $i = 0?>
                        <?php foreach ($errors as $error): ?>
                            <?php $i++?>
                            <?php if ($i > 1): ?>
                                <?php echo " - " . $error ?>
                            <?php else: ?>
                                <?php echo $error ?>
                            <?php endif?>
                        <?php endforeach?>
                    </p>
            </div>
            <?php endif?>
               <!-- Affiche les pizzas -->
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-10">
                    <h2>
                        Produits 
                        <button type="button" class="btn btn-primary mobile-basket" data-toggle="modal" data-target="#exampleModal">
                            Voir le panier
                        </button> 
                    </h2>

                    <div class="row">

                    <?php if(mysqli_num_rows($resultPizza) > 0) : ?>

                        <?php while($rowProduit = mysqli_fetch_object($resultPizza)) : ?>

                            <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                                <div class="card">
                                    <img class="card-img-top" src="<?=$rowProduit->art_image?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <?=$rowProduit->art_nom?>
                                            <span class="categorie bg-info text-white">
                                                <?php
                                                    $currentCat = $rowProduit->cat_id ;
                                                    $queryCat = "SELECT * FROM categorie WHERE cat_id = '$currentCat'";
                                                    $resultCat = mysqli_query($conn, $queryCat);
                                                    $rowProduitCat = mysqli_fetch_assoc($resultCat);
                                                ?>
                                                <?=$rowProduitCat['cat_libelle']?>
                                            </span>
                                        </h5>
                                        <p class="card-text"><?=$rowProduit->art_description?></p>
                                            

                                        <form method="post" action="commander.php?action=add&id=<?php echo $rowProduit->art_id; ?>">
                                            <input type="number" name="quantity" value="1" style="width: 45%;"/> 
                                            <p class="prix">
                                                <span class="bg-warning text-white"><?=$rowProduit->art_prix?> €</span>
                                                <input type="hidden" name="item_id" value="<?=$rowProduit->art_id?>" />
                                                <input type="hidden" name="hidden_name" value="<?= $rowProduit->art_nom; ?>" />
                                                <input type="hidden" name="hidden_price" value="<?php echo $rowProduit->art_prix; ?>" />
                                                <input <?php if(empty($_SESSION['username']) OR $idUser == 2){echo "disabled";} ?> type="submit" name="add_to_cart" class="btn btn-primary ajout-panier" value="Ajouter" />
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endwhile ; ?>

                    <?php endif ; ?>

                </div>
            </div>
            <div id="petit-panier" class="col-md-2">
                <h2 class="text-center">Panier</h2>
                <div class="container-petit-panier">
                    <?php if (!empty($_SESSION["shopping_cart"])) :?>
                        <?php $total = 0; ?>
                        <div class="parent-row">
                            <?php foreach($_SESSION["shopping_cart"] as $keys => $values) : ?>
                                <div class="row">
                                    <div class="col-sm-5 text-right">Produit :</div>
                                    <div class="col-sm-7">
                                        <?php echo $values["item_name"]; ?>
                                    </div>
                                    <div class="col-sm-5 text-right">Qté :</div>
                                    <div class="col-sm-7">
                                        <?php echo $values["item_quantity"]; ?>
                                    </div>
                                    <div class="col-sm-5 text-right">Prix U. :</div>
                                    <div class="col-sm-7">
                                        <?php echo $values["item_price"]; ?> €
                                    </div>
                                    <div class="col-sm-5 text-right">Prix :</div>
                                    <div class="col-sm-7">
                                        <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> €
                                    </div>
                                    <div class="col-sm-5 text-right"></div>
                                    <div class="col-sm-7">
                                        <a href="commander.php?action=delete&id=<?php echo $values["item_id"]; ?>">
                                            <span class="text-danger">Supprimer</span>
                                        </a>
                                    </div>
                                    <br><br>
                                    <?php $total = $total + ($values["item_quantity"] * $values["item_price"]);?>
                                </div>
                                
                            <?php endforeach ; ?>
                        </div>
                        <tr>
                        <div class="total-little-panier">
                        <p>
                            Total du panier : <?php echo number_format($total, 2); ?> €
                            
                        </p>

                        <p>
                            <a class="btn btn-primary" href="/Pizzatech/panier.php">Commander</a>
                        </p>
                            
                        </div>

                    <?php endif ; ?>

                </div>
            </div>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Votre panier | Total : <?php echo number_format($total, 2); ?> € 
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php foreach ($_SESSION["shopping_cart"] as $keys => $values): ?>
                        <div class="row">
                            <div class="col-sm-5 text-right">Produit :</div>
                            <div class="col-sm-7">
                                <?php echo $values["item_name"]; ?>
                            </div>
                            <div class="col-sm-5 text-right">Qté :</div>
                            <div class="col-sm-7">
                                <?php echo $values["item_quantity"]; ?>
                            </div>
                            <div class="col-sm-5 text-right">Prix U. :</div>
                            <div class="col-sm-7">
                                <?php echo $values["item_price"]; ?> €
                            </div>
                            <div class="col-sm-5 text-right">Prix :</div>
                            <div class="col-sm-7">
                                <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?> €
                            </div>
                            <div class="col-sm-5 text-right"></div>
                            <div class="col-sm-7">
                                <a href="commander.php?action=delete&id=<?php echo $values["item_id"]; ?>">
                                    <span class="text-danger">Supprimer</span>
                                </a>
                            </div>
                            <br><br>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <a href="/Pizzatech/panier.php" class="btn btn-primary">Commander</a>
                </div>
                </div>
            </div>
            </div>
        </div>
   </body>