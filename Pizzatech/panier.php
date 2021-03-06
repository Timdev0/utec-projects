<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>

<!-- Inclus connexion db -->
<?php include 'server.php'?>

<?php
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
				echo '<script>window.location="panier.php"</script>';
			}
		}
	}
}
?>

<!doctype html>
<html lang="fr">
    <?php $title = "Panier"?>

    <?php include 'head.php'?>

    <body>

        <?php // print_r($_SESSION["shopping_cart"]) ?>
        <?php
        // $timezone = date_default_timezone_get();
        // echo "<br><br>Timezone : ".$timezone."<br><br>";
        // $date = date('Y-m-d', time());
        // echo "Date : ".$date."<br><br>";
        // $heure = date('H:i:s', time());
        // echo "Heure : ".$heure."<br><br>";

        ?>

        <?php include 'navbar.php'?>

        <div class="container my-3">
            <h2>Panier</h2>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Nom du produit</th>
                        <th width="10%">Quantité</th>
                        <th width="20%">Prix</th>
                        <th width="15%">Total</th>
                        <th width="5%"></th>
                    </tr>
                    <?php
                    if(!empty($_SESSION["shopping_cart"]))
                    {
                        $total = 0;
                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                    ?>
                            <tr>
                                <td><?php echo $values["item_name"]; ?></td>
                                <td><?php echo $values["item_quantity"]; ?></td>
                                <td><?php echo $values["item_price"]; ?> €</td>
                                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> €</td>
                                <td class="text-center">
                                    <a class="btn btn-danger text-white" href="panier.php?action=delete&id=<?php echo $values["item_id"]; ?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
                        ?>
                        <tr>
                            <td colspan="3" class="text-right">Total</td>
                            <td class="text-right"><?php echo number_format($total, 2); ?> €</td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>  
                </table>
                <form class="text-right" method="post" action="panier.php">
                    <button type="submit" class="btn btn-primary" name="commande_send" 
                    <?php if(empty($_SESSION["shopping_cart"])){echo"disabled";} ?>>
                        Commander
                    </button>
                </form>
            </div>
        </div>
    </body>

</html>