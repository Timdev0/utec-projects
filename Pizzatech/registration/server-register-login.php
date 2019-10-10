<!-- Montre les erreurs-->
<?php
	ini_set("display_errors", true);
	error_reporting(E_ALL);
?>

<!-- Check user for DB ip-->
<?php
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
?>

<?php
    // connect to the database
    $db = mysqli_connect($ipDB, 'admin', 'n3NrT0565sK8GA8L', 'restaurant');

    session_start();

    // initializing variables
    $username = "";
    $email = "";
    $nom = "";
    $prenom = "";
    $civilite = "";
    $daten = "";
    $tel="";
    $adresse="";
    $cp="";
    $ville="";

    $errors = array();

    // REGISTER USER
    if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $nom = mysqli_real_escape_string($db, $_POST['nom']);
        $prenom = mysqli_real_escape_string($db, $_POST['prenom']);
        $civilite = mysqli_real_escape_string($db, $_POST['civilite']);
        $daten = mysqli_real_escape_string($db, $_POST['daten']);
        $tel = mysqli_real_escape_string($db, $_POST['tel']);
        $adresse = mysqli_real_escape_string($db, $_POST['adresse']);
        $cp = mysqli_real_escape_string($db, $_POST['cp']);
        $ville = mysqli_real_escape_string($db, $_POST['ville']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        // form validation: ensure that the form is correctly filled ...
        // by adding (array_push()) corresponding error unto $errors array
        if (empty($username)) {array_push($errors, "Nom d'utilisateur requis");}
        if (empty($email)) {array_push($errors, "Email requis");}
        if (empty($nom)) {array_push($errors, "Nom requis");}
        if (empty($prenom)) {array_push($errors, "Prenom requis");}
        if (empty($civilite)) {array_push($errors, "Civilité requise");}
        if (empty($daten)) {array_push($errors, "Date de naissance requise");}
        if (empty($tel)) {array_push($errors, "Numéro de téléphoner requis");}
        if (empty($adresse)) {array_push($errors, "Adresse requise");}
        if (empty($cp)) {array_push($errors, "Code postal requis");}
        if (empty($ville)) {array_push($errors, "Ville requise");}
        if (empty($password_1)) {array_push($errors, "Mot de passe requis");}
        if ($password_1 != $password_2) {
            array_push($errors, "Les deux mots de passe ne correspondent pas.");
        }

        // first check the database to make sure
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM personne WHERE perso_username='$username' OR perso_mail='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['perso_username'] === $username) {
                array_push($errors, "L'utilisateur existe déjà");
            }

            if ($user['perso_mail'] === $email) {
                array_push($errors, "L'utilisateur est déjà utilisé");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password_1); //encrypt the password before saving in the database

            $query = "INSERT INTO personne (perso_username, perso_civilite, perso_nom, perso_prenom, perso_dnais, perso_phone, perso_mail, perso_psw, perso_profil, perso_adresse, perso_cp, perso_ville)
            VALUES('$username', '$civilite', '$nom', '$prenom', '$daten', '$tel', '$email', '$password', '3', '$adresse', '$cp','$ville')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Vous êtes maintenant connecté.";
            header('location: ../index.php');
        }
    }

    // LOGIN USER
    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Nom d'utilisateur requis");
        }
        if (empty($password)) {
            array_push($errors, "Mot de passe requis");
        }

        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM personne WHERE perso_username='$username' AND perso_psw='$password'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Vous êtes connecté";
                $_SESSION['name'] = mysqli_fetch_object($results)->perso_prenom;
                header('location: ../index.php');
            } 
            else {
                array_push($errors, "Mauvais nom d'utilisateur / mot de passe");
            }
        }
    }
?>