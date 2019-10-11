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

//variables de co a la DB
$servername = $ipDB;
$usernameDB = "admin";
$password = "n3NrT0565sK8GA8L";
$dbname = "devis";

?>



<!-- Connect to db -->
<?php
$conn = mysqli_connect($servername, $usernameDB, $password, $dbname);
?>

<?php


//REGISTER

session_start();

// initializing variables
$username = "";
$email = "";
$nom = "";
$prenom = "";
$civilite = "";
$tel="";
$adresse="";
$cp="";
$ville="";

$errors = array();

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $civilite = mysqli_real_escape_string($conn, $_POST['civilite']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $cp = mysqli_real_escape_string($conn, $_POST['cp']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {array_push($errors, "Nom d'utilisateur requis");}
    if (empty($email)) {array_push($errors, "Email requis");}
    if (empty($nom)) {array_push($errors, "Nom requis");}
    if (empty($prenom)) {array_push($errors, "Prenom requis");}
    if (empty($civilite)) {array_push($errors, "Civilité requise");}
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
    $result = mysqli_query($conn, $user_check_query);
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

        $query = "INSERT INTO personne (perso_username, perso_civilite, perso_nom, perso_prenom, perso_phone, perso_mail, perso_psw, perso_adresse, perso_cp, perso_ville, role)
        VALUES('$username', '$civilite', '$nom', '$prenom', '$tel', '$email', '$password', '$adresse', '$cp','$ville', 3)";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Vous êtes maintenant connecté.";
        $_Session['name'] = $prenom ;

        //Get user id
        if (!empty($_SESSION['username'])) {
            $currentUsername = $_SESSION['username'];
            $queryPersoID = "SELECT perso_id FROM personne WHERE perso_username = '$currentUsername'";
            $resultPersoID = mysqli_query($conn, $queryPersoID);
            while ($row = mysqli_fetch_object($resultPersoID)) {
                $_SESSION['userID'] = $row->perso_id;
            }
        }
        header('location: index.php');
    }
}

// LOGIN
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Nom d'utilisateur requis");
    }
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM personne WHERE perso_username='$username' AND perso_psw='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Vous êtes connecté";
            $_SESSION['name'] = mysqli_fetch_object($results)->perso_prenom;
            //Get user id
            if (!empty($_SESSION['username'])) {
                $currentUsername = $_SESSION['username'];
                $queryPersoID = "SELECT perso_id FROM personne WHERE perso_username = '$currentUsername'";
                $resultPersoID = mysqli_query($conn, $queryPersoID);
                while ($row = mysqli_fetch_object($resultPersoID)) {
                    $_SESSION['userID'] = $row->perso_id;
                }
            }
            header('location: index.php');
        } 
        else {
            array_push($errors, "Mauvais nom d'utilisateur / mot de passe");
        }
    }
}


//parametre user
$errorsP = array();


if (isset($_POST['update_user'])) {

    $userID = $_SESSION['userID'];

    // receive all input values from the form
    $usernamePOST = mysqli_real_escape_string($conn, $_POST['username']);
    $emailPOST = mysqli_real_escape_string($conn, $_POST['email']);
    $nomPOST = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenomPOST = mysqli_real_escape_string($conn, $_POST['prenom']);
    $civilitePOST = mysqli_real_escape_string($conn, $_POST['civilite']);
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

    if (empty($actuelMdpPOST)) {array_push($errorsP, "Mot de passe actuel requis");}
    
    if (!empty($mdp1POST)){
        if (empty($mdp1POST)) {array_push($errorsP, "Mot de passe requis");
        }
        if ($mdp1POST != $mdp2POST) {
            array_push($errorsP, "Les deux mots de passe ne correspondent pas.");
        }
    }

    if (count($errorsP) == 0) {
        
        $password = md5($mdp1POST); //encrypt the password before saving in the database

        $queryUpdate = "UPDATE personne SET perso_username = '$usernamePOST', perso_civilite = '$civilitePOST', perso_nom = '$nomPOST', perso_prenom = '$prenomPOST', perso_phone = '$telPOST', perso_mail = '$emailPOST', perso_adresse = '$adressePOST', perso_cp = '$cpPOST', perso_ville = '$villePOST' WHERE perso_id = $userID";
        mysqli_query($conn, $queryUpdate);

        if (!empty($mdp1POST)){
            $queryUpdatePass = "UPDATE personne SET perso_psw = '$password' WHERE perso_id = $userID";
            mysqli_query($conn, $queryUpdatePass);
        }

        $_SESSION['blyat'] = 2;
        
        $_SESSION['username'] = $usernamePOST;

        header('location: /devis/parametres.php');
    }
}

//SEND FORM


?>