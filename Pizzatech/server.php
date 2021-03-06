<?php
    //demarre la session
    @session_start();
?>
<?php
    date_default_timezone_set('Europe/Paris');
    //INDEX
    //Check user for DB ip
    if (empty($_ENV["USER"])) {
        $_ENV["USER"] = "vm";
    }

    $envUsername = $_ENV["USER"];
    $userMBP = "Tim";
    $ipDB = "";

    if ($envUsername == $userMBP) {
        $ipDB = "127.0.0.1:8889";
    } 
    else {
        $ipDB = "127.0.0.1";
    }

    //variables de co a la DB
    $servername = $ipDB;
    $usernameDB = "admin";
    $password = "n3NrT0565sK8GA8L";
    $dbname = "restaurant";

    $conn = mysqli_connect($servername, $usernameDB, $password, $dbname);

    //recup les pizza
    $sqlPizza = "SELECT * FROM `article`";
    $resultPizza = mysqli_query($conn, $sqlPizza);

    //recup le username
    if(isset($_SESSION['username'])){
        $currentUsername = $_SESSION['username'];
    }

    //NAVBAR
    //check if admin
    if(isset($_SESSION['username'])){
        $queryAdmin = "SELECT perso_profil FROM personne WHERE perso_username = '$currentUsername'";
        $resultAdmin = mysqli_query($conn, $queryAdmin);
        while ($row = mysqli_fetch_object($resultAdmin)) {
            $idUser = $row->perso_profil;
        }
    }

    //Commande register
    if (isset($_POST['commande_send'])) {

        //Get user id
        $currentUsername = $_SESSION['username'];
        $queryPersoID = "SELECT perso_id FROM personne WHERE perso_username = '$currentUsername'";
        $resultPersoID = mysqli_query($conn, $queryPersoID);
        while ($row = mysqli_fetch_object($resultPersoID)) {
            $persoID = $row->perso_id;
        }

        //Get date
        $date = date('Y-m-d', time());

        //insert commande
        $queryCommande = "INSERT INTO commande (cmd_valide, cmd_prix, cmd_date, perso_id) VALUES ('0', '0', '$date','$persoID' )";
        $resultCommande = mysqli_query($conn, $queryCommande);
        
        //sql last id == Id commande
        $sqllastID = "SELECT LAST_INSERT_ID() AS lastID;";
        $resultLastID = mysqli_query($conn, $sqllastID);
        while ($row = mysqli_fetch_object($resultLastID)) {
            $lastID = $row->lastID;
        }
        $total = 0;
        foreach($_SESSION["shopping_cart"] as $keys => $values){
            $itemName = $values["item_name"];
            $item_quantite = $values["item_quantity"];

            //recup id article
            $queryArtID = "SELECT art_id FROM article WHERE art_nom = '$itemName'";
            $resultArtID = mysqli_query($conn, $queryArtID);
            while ($row = mysqli_fetch_object($resultArtID)) {
                $artID = $row->art_id;
            }

            number_format($values["item_quantity"] * $values["item_price"], 2);
            $total = $total + ($values["item_quantity"] * $values["item_price"]);

            $queryLigne = "INSERT INTO ligne (cmd_id, art_id, lig_quantite) VALUES ('$lastID', '$artID ','$item_quantite')";
            $resultLigne = mysqli_query($conn, $queryLigne);
        }
        
        $prixTotal = number_format($total, 2);

        $queryPrixTotal = "UPDATE commande SET cmd_prix = '$prixTotal' WHERE cmd_id =  '$lastID' ";
        $resultPrixTotal = mysqli_query($conn, $queryPrixTotal);

        unset($_SESSION["shopping_cart"]);

        header('location: /Pizzatech/mes-commandes.php');
    }

    //Get user id
    if(!empty($_SESSION['username'])){
        $currentUsername = $_SESSION['username'];
        $queryPersoID = "SELECT perso_id FROM personne WHERE perso_username = '$currentUsername'";
        $resultPersoID = mysqli_query($conn, $queryPersoID);
        while ($row = mysqli_fetch_object($resultPersoID)) {
            $_SESSION['userID'] = $row->perso_id;
        }
    }

    //recup les commandes par user
    if(!empty($_SESSION['userID'])){
        $persoIdCommande = $_SESSION['userID'];
        $sqlCommandes = "SELECT * FROM `commande` WHERE commande.perso_id = $persoIdCommande ORDER by cmd_id DESC";
        $resultCommandes = mysqli_query($conn, $sqlCommandes);
    }

    //recup les commandes
    if(!empty($_SESSION['userID'])){
        $sqlAllCommandes = "SELECT * FROM `commande` ORDER by cmd_id DESC";
        $resultAllCommandes = mysqli_query($conn, $sqlAllCommandes);
    }

    // validation commande
    $idCommande = "";
    if (isset($_POST['validation'])) {
        // receive all input values from the form
        $idCommande = mysqli_real_escape_string($conn, $_POST['hidden_id']);


        $queryValide = "UPDATE `commande` SET `cmd_valide` = '1' WHERE `cmd_id` = $idCommande";
        mysqli_query($conn, $queryValide);
        header('location: les-commandes.php');
    }

?>