<?php
    mysqli_close($conn);

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

    //Employé -- Insert une pizza
    $categorie = "";
    $nom = "";
    $prix = "";
    $desc = "";
    $img = "";

    $errors = array();

    if (isset($_POST['produit'])) {
        // receive all input values from the form
        $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prix = mysqli_real_escape_string($conn, $_POST['prix']);
        $desc = mysqli_real_escape_string($conn, $_POST['desc']);
        $img = mysqli_real_escape_string($conn, $_POST['img']);

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($categorie)) {array_push($errors, "Categorie requise");}
        if (empty($nom)) {array_push($errors, "Nom requis");}
        if (empty($prix)) {array_push($errors, "Prix requis");}
        if (empty($desc)) {array_push($errors, "Description requise");}
        if (empty($img)) {array_push($errors, "Image requise");}

        // first check the database to make sure
        $article_check_query = "SELECT * FROM article WHERE art_nom='$nom' LIMIT 1";
        $result = mysqli_query($conn, $article_check_query);
        $article = mysqli_fetch_assoc($result);

        if ($article) { // if article exists
            if ($article['art_nom'] === $nom) {
                array_push($errors, "L'article existe déjà");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {

            $query = "INSERT INTO article (cat_id, art_nom, art_description, art_image, art_prix) VALUES('$categorie', '$nom', '$desc', '$img', '$prix')";
            mysqli_query($conn, $query);
            $_SESSION['blyat'] = 1;
            $_SESSION['article'] = $nom;
            header('location: employe.php');
        }
    }


    //form user
    if (isset($_POST['update_user'])) {

        $userID = $_SESSION['userID'];

        // receive all input values from the form
        $usernamePOST = mysqli_real_escape_string($conn, $_POST['username']);
        $emailPOST = mysqli_real_escape_string($conn, $_POST['email']);
        $nomPOST = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenomPOST = mysqli_real_escape_string($conn, $_POST['prenom']);
        $civilitePOST = mysqli_real_escape_string($conn, $_POST['civilite']);
        $datenPOST = mysqli_real_escape_string($conn, $_POST['daten']);
        $telPOST = mysqli_real_escape_string($conn, $_POST['tel']);
        $adressePOST = mysqli_real_escape_string($conn, $_POST['adresse']);
        $cpPOST = mysqli_real_escape_string($conn, $_POST['cp']);
        $villePOST = mysqli_real_escape_string($conn, $_POST['ville']);
        $actuelMdpPOST = mysqli_real_escape_string($conn, $_POST['actuelMdp']);
        $mdp1POST = mysqli_real_escape_string($conn, $_POST['mdp1']);
        $mdp2POST = mysqli_real_escape_string($conn, $_POST['mdp2']);

        $sqlMDP = "SELECT perso_psw FROM `personne` WHERE perso_id = $userID";
        $resultMDP = mysqli_query($conn, $sqlMDP);
         while($row = mysqli_fetch_object($resultMDP)){
                $mdpRecup = $row->perso_psw;
        }
        $actuelMdpMD5 = md5($actuelMdpPOST);
        if ($actuelMdpMD5 != $mdpRecup){array_push($errors, "Mot de passe actuel incorrect");}

        if (empty($actuelMdpPOST)) {array_push($errors, "Mot de passe actuel requis");}
        
        if (!empty($mdp1POST)){
            if (empty($mdp1POST)) {array_push($errors, "Mot de passe requis");
            }
            if ($mdp1POST != $mdp2POST) {
                array_push($errors, "Les deux mots de passe ne correspondent pas.");
            }
        }

        if (count($errors) == 0) {
            
            $password = md5($mdp1POST); //encrypt the password before saving in the database

            $queryUpdate = "UPDATE personne SET perso_username = '$usernamePOST', perso_civilite = '$civilitePOST', perso_nom = '$nomPOST', perso_prenom = '$prenomPOST', perso_dnais = '$datenPOST', perso_phone = '$telPOST', perso_mail = '$emailPOST', perso_adresse = '$adressePOST', perso_cp = '$cpPOST', perso_ville = '$villePOST' WHERE perso_id = $userID";
            mysqli_query($conn, $queryUpdate);

            if (!empty($mdp1POST)){
                $queryUpdatePass = "UPDATE personne SET perso_psw = '$password' WHERE perso_id = $userID";
                mysqli_query($conn, $queryUpdatePass);
            }

            $_SESSION['blyat'] = 2;
            
            $_SESSION['username'] = $usernamePOST;

            header('location: /Pizzatech/parametres/utilisateur.php');
        }
    }

    //employe creation de compte
    // initializing variables
    $username1 = "";
    $email1 = "";
    $nom1 = "";
    $prenom1 = "";
    $civilite1 = "";
    $daten1 = "2019-01-01";
    $tel1 ="";
    $adresse1="";
    $cp1="";
    $ville1="";

    $errors = array();

    // connect to the database
    $db = mysqli_connect($ipDB, 'admin', 'n3NrT0565sK8GA8L', 'restaurant');

      // REGISTER USER
    if (isset($_POST['reg_emp'])) {
        // receive all input values from the form
        $username1 = mysqli_real_escape_string($db, $_POST['username']);
        $email1 = mysqli_real_escape_string($db, $_POST['email']);
        $nom1 = mysqli_real_escape_string($db, $_POST['nom']);
        $prenom1 = mysqli_real_escape_string($db, $_POST['prenom']);
        $civilite1 = mysqli_real_escape_string($db, $_POST['civilite']);
        $daten1 = mysqli_real_escape_string($db, $_POST['daten']);
        $tel1 = mysqli_real_escape_string($db, $_POST['tel']);
        $adresse1 = mysqli_real_escape_string($db, $_POST['adresse']);
        $cp1 = mysqli_real_escape_string($db, $_POST['cp']);
        $ville1 = mysqli_real_escape_string($db, $_POST['ville']);
        $password_11 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_21 = mysqli_real_escape_string($db, $_POST['password_2']);

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username1)) {array_push($errors, "Nom d'utilisateur requis");}
        if (empty($email1)) {array_push($errors, "Email requis");}
        if (empty($civilite1)) {array_push($errors, "Civilité requise");}
        if (empty($password_11)) {array_push($errors, "Mot de passe requis");}
        if ($password_11 != $password_21) {
            array_push($errors, "Les deux mots de passe ne correspondent pas.");
        }

        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM personne WHERE perso_username='$username1' OR perso_mail='$email1' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['perso_username'] === $username1) {
                array_push($errors, "L'utilisateur existe déjà");
            }

            if ($user['perso_mail'] === $email1) {
                array_push($errors, "L'utilisateur est déjà utilisé");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password_1); //encrypt the password before saving in the database

            $queryRegEmp = "INSERT INTO personne (perso_username, perso_civilite, perso_nom, perso_prenom, perso_dnais, perso_phone, perso_mail, perso_psw, perso_profil, perso_adresse, perso_cp, perso_ville)
            VALUES('$username1', '$civilite1', '$nom1', '$prenom1', '$daten1', '$tel1', '$email1', '$password1', '2', '$adresse1', '$cp1','$ville1')";
            mysqli_query($db, $queryRegEmp);
            $_SESSION['blyat'] = 3;
            header('location: /Pizzatech/parametres/admin.php');
        }
    }

    //admin creation de compte
// initializing variables
$username2 = "";
$email2 = "";
$nom2 = "";
$prenom2 = "";
$civilite2 = "";
$daten2 = "2019-01-01";
$tel2 = "";
$adresse2 = "";
$cp2 = "";
$ville2 = "";

$errors = array();

// connect to the database
$db = mysqli_connect($ipDB, 'admin', 'n3NrT0565sK8GA8L', 'restaurant');

// REGISTER USER
if (isset($_POST['reg_admin'])) {
    // receive all input values from the form
    $username2 = mysqli_real_escape_string($db, $_POST['username2']);
    $email2 = mysqli_real_escape_string($db, $_POST['email2']);
    $nom2 = mysqli_real_escape_string($db, $_POST['nom2']);
    $prenom2 = mysqli_real_escape_string($db, $_POST['prenom2']);
    $civilite2 = mysqli_real_escape_string($db, $_POST['civilite2']);
    $daten2 = mysqli_real_escape_string($db, $_POST['daten2']);
    $tel2 = mysqli_real_escape_string($db, $_POST['tel2']);
    $adresse2 = mysqli_real_escape_string($db, $_POST['adresse2']);
    $cp2 = mysqli_real_escape_string($db, $_POST['cp2']);
    $ville2 = mysqli_real_escape_string($db, $_POST['ville2']);
    $password_12 = mysqli_real_escape_string($db, $_POST['password_12']);
    $password_22 = mysqli_real_escape_string($db, $_POST['password_22']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username2)) {array_push($errors, "Nom d'utilisateur requis");}
    if (empty($email2)) {array_push($errors, "Email requis");}
    if (empty($civilite2)) {array_push($errors, "Civilité requise");}
    if (empty($password_12)) {array_push($errors, "Mot de passe requis");}
    if ($password_12 != $password_22) {
        array_push($errors, "Les deux mots de passe ne correspondent pas.");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM personne WHERE perso_username='$username2' OR perso_mail='$email2' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['perso_username'] === $username2) {
            array_push($errors, "L'utilisateur existe déjà");
        }

        if ($user['perso_mail'] === $email2) {
            array_push($errors, "L'utilisateur est déjà utilisé");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); //encrypt the password before saving in the database

        $queryRegAdmin = "INSERT INTO personne (perso_username, perso_civilite, perso_nom, perso_prenom, perso_dnais, perso_phone, perso_mail, perso_psw, perso_profil, perso_adresse, perso_cp, perso_ville)
            VALUES('$username2', '$civilite2', '$nom2', '$prenom2', '$daten2', '$tel2', '$email2', '$password2', '1', '$adresse2', '$cp2','$ville2')";
        mysqli_query($db, $queryRegAdmin);
        $_SESSION['blyat'] = 4;
        header('location: /Pizzatech/parametres/admin.php');
    }
}

//modifier les produits
$queryArtcilesAll = "SELECT * FROM article";
$resultArtcilesAll = mysqli_query($conn, $queryArtcilesAll);

//form modif article
if (isset($_POST['produitModif'])) {
    // receive all input values from the form
    $categorieArt = mysqli_real_escape_string($conn, $_POST['categorieArt']);
    $nomArt = mysqli_real_escape_string($conn, $_POST['nomArt']);
    $prixArt = mysqli_real_escape_string($conn, $_POST['prixArt']);
    $descArt = mysqli_real_escape_string($conn, $_POST['descArt']);
    $imageArt = mysqli_real_escape_string($conn, $_POST['imageArt']);
    $idArt = mysqli_real_escape_string($conn, $_POST['idArt']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($categorieArt)) {array_push($errors, "Categorie requise");}
    if (empty($nomArt)) {array_push($errors, "Nom requis");}
    if (empty($prixArt)) {array_push($errors, "Prix requis");}
    if (empty($descArt)) {array_push($errors, "Description requise");}
    if (empty($imageArt)) {array_push($errors, "Image requise");}

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        $queryModifArt = "UPDATE `article` SET `art_nom` = '$nomArt', `art_prix` = '$prixArt', `art_description` = '$descArt', `art_image` = '$imageArt', `cat_id` = '$categorieArt'  WHERE `art_id` = '$idArt'";
        mysqli_query($conn, $queryModifArt);
        $_SESSION['blyat'] = 4;
        header('location: employe.php');
    }
}

//form modif article
if (isset($_POST['produitSuppr'])) {
    $idArtSuppr = mysqli_real_escape_string($conn, $_POST['idArtSuppr']);

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        $querySupprArt = "DELETE FROM `article` WHERE `art_id` = '$idArtSuppr'";
        mysqli_query($conn, $querySupprArt);
        $_SESSION['blyat'] = 5;
        header('location: employe.php');
    }
}


?>