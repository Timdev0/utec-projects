<!-- Montre les erreurs-->
<?php
	ini_set("display_errors", true);
	error_reporting(E_ALL);
?>

<html>

    <?php include 'server.php'?>   
   
    <head>
        <meta charset="utf-8">
        <title>Envoi du devis | Ultratactile</title>
        <link rel="icon" href="/devis/assets/favicon.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/devis/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/devis/css/style.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Ajouter le head old -->
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <meta http-equiv="refresh" content="15; URL=index.php">

    </head>
   
    <body>

        <?php include 'navbar.php'?>

    	<div class="container-fluid mt-3">
		    <div class ="row">
		        <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xs-8 offset-xs-2 align-endform">

                    <?php

                    //var id
                    $myid = "";

                    // Ma clé privée
                    $secret = "6Lc41V0UAAAAAIga0Xt_MPF05rVhNcksqbfNtIZS";

                    // Paramètre renvoyé par le recaptcha
                    $response = $_POST['g-recaptcha-response'];

                    // On récupère l'IP de l'utilisateur
                    $remoteip = $_SERVER['REMOTE_ADDR'];
                    
                    //récup reponse Recaptcha
                    $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="

					. $secret

					. "&response=" . $response

                    . "&remoteip=" . $remoteip;
                    
				    $decode = json_decode(file_get_contents($api_url), true);

                    // Si reCaptcha ok 
				    if ($decode['success'] == true) {
                        //var form a entrer dans BDD
                        $domaine = $_POST["domaine"];
                        $caisses = $_POST["caisses"];
                        $appel = $_POST["appel"];
                        $finala = "";
                        $accessoire = "";

                        if (!empty($_POST["accessoire"])){
                            $accessoire = $_POST["accessoire"];
                            foreach ($accessoire as $valeur) {
                                $finala = $finala . $valeur . " + ";
                            }
                            $finala = substr($finala, 0, -2);
                            
                        }

                        else {
                            $finala = "Non";
                        }

                        
                        // avoir une réponse du serveur smtp
                        $f = fsockopen('smtp.gmail.com', 587);

                        //check smtp server
                        if ($f !== false) {
                            $res = fread($f, 1024);
                            //if stmp server is here
                            if (strlen($res) > 0 && strpos($res, '220') === 0) {

                                $idUser = $_SESSION['userID'];
                                
                                //insert devis
                                $sqlDevis = "INSERT INTO devis (accessoires, caisses, domaine, appel, perso_id) VALUES ('$finala', '$caisses', '$domaine', '$appel', '$idUser')";
                                
                                //var user
                                $nom = "";
                                $prenom = "";
                                $mail = "";
                                $phone = "";

                                //recup infos user
                                $sqlInfosUser = "SELECT * FROM personne WHERE perso_id = '$idUser' ";
                                $resultInfosUser = mysqli_query($conn, $sqlInfosUser);
                                    while ($row = mysqli_fetch_object($resultInfosUser)) {
                                        $nom = $row->perso_nom;
                                        $prenom = $row->perso_prenom;
                                        $phone = $row->perso_phone;
                                        $mail = $row->perso_mail;
                                    }

                                //recupérer id devis
                                $sqlId = "SELECT `id` FROM `devis` WHERE `accessoires` = '$finala' AND `caisses` = '$caisses' AND `domaine` = '$domaine' AND `appel` = '$appel' AND `perso_id` = '$idUser' ";
                                
                                if (mysqli_query($conn, $sqlDevis)) {
                                    echo "Devis enregistré.<br>";
                                } else {
                                    echo "Erreur" . mysqli_error($conn);
                                }
                                $result = mysqli_query($conn, $sqlId);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_object($result)) {
                                        $myid = $myid . " " . $row->id;
                                    }
                                } else {
                                    $myid = "Erreur : Pas d'ID";
                                }

                                $messageClient = "Votre demande de devis est la suivante : ";

                                $messageMail = '
                                    <div
                                    style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; font-family: sans-serif;">
                                        <div
                                            style="display: -ms-flexbox; display: flex; -ms-flex-wrap: wrap; flex-wrap: wrap; margin-right: -15px; margin-left: -15px;">
                                            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xs-6 offset-xs-3">
                                                <div
                                                    style="font-size: 20px;margin-bottom: 12px;font-weight: bold;text-decoration: underline; text-align: center !important;">
                                                    Demande de devis
                                                </div>
                                                <table class="table table-hover"
                                                    style="width: 100%; max-width: 100%; margin-bottom: 1rem; background-color: transparent; border-collapse: collapse; color: #fff; background-color: #212529; text-align: center;">
                                                    <thead style="border-bottom:solid 2px white;">
                                                        <tr>
                                                            <th scope="col" style="padding-bottom: 8px;">Demande de devis</th>
                                                            <th scope="col" style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">ID : ' .
                                                                $myid . '</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Nom :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $nom . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Prénom :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $prenom . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">E-mail :</th>
                                                            <td
                                                                style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px; background-color :#c8d6e5;">
                                                                ' . $mail . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Téléphone :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $phone . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Domaine :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $domaine . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Nombre de caisses :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $caisses . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Accessoires :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $finala . '</td>
                                                        </tr>
                                                        <tr style="border-bottom:solid 2px white;">
                                                            <th scope="row" style="padding-bottom: 8px;">Souhaite être appelé :</th>
                                                            <td style="padding-bottom: 8px; padding-left: 64px; padding-right: 8px;">' . $appel . '</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                ';
                                
                                require_once('vendor/PHPMailer/PHPMailerAutoload.php');
                                define('GMailUSER', 'xxx@gmail.com'); // utilisateur Gmail
                                define('GMailPWD', 'yyy'); // Mot de passe Gmail
                                define('sec1', 'ssl');
                                define('port1', '465');
                                define('sec2', 'tls');
                                define('port2', '587');
                                function smtpMailer($to, $from, $from_name, $subject, $body) {
                                    $mail = new PHPMailer();  // Cree un nouvel objet PHPMailer
                                    $mail->CharSet =  "utf-8";
                                    $mail->IsSMTP(); // active SMTP
                                    $mail->SMTPDebug = 0;  // debogage: 1 = Erreurs et messages,
                                                        //           2 = messages seulement
                                    $mail->Debugoutput = 'html';
                                    $mail->SMTPAuth = true;  // Authentification SMTP active
                                    $mail->SMTPSecure = sec2; // Gmail requiert le transfert sécurisé
                                    $mail->Host = 'smtp.gmail.com';
                                    $mail->Port = port2;
                                    $mail->Username = 'tim089140@gmail.com';
                                    $mail->Password = 'Gypsy89140_';
                                    $mail->SetFrom($from, $from_name);
                                    $mail->Subject = $subject;
                                    $mail->isHTML(true);
                                    $mail->Body = $body;
                                    $mail->AddAddress($to);
                                    if(!$mail->Send()) {
                                    return 'Mail error: '.$mail->ErrorInfo;
                                    }
                                    else {
                                    return true;
                                } }
                                $result = smtpmailer('quentin.peltier.pro@gmail.com',
                                                    'tim089140@gmail.com',
                                                    'Ultratactile', 'Demande de devis',$messageMail);
                                if (true !== $result) {
                                    echo $result;
                                }
                                else echo "Devis envoyé";

                                $result2 = smtpmailer($mail,
                                                    'tim089140@gmail.com',
                                                    'Ultratactile', 'Demande de devis',$messageClient.$messageMail);
                                if (true !== $result2) {
                                    echo $result2;
                                }
                                else echo "<br>Un mail avec vos informations de connexion a été envoyé";
                                
                            } 
                            else {
                                echo "Une erreur c'est produite lors de l'envois du formulaire, réessayer ultérieurement.<br>";
                            }
                        }
                        fclose($f);
                    }
                    else {
                        // C'est un robot ou le code de vérification est incorrecte
                        echo "Captcha non validé<br>";
                        echo '<br><a href="devis.php"><button type="button" class="btn btn-primary redi-button">Retour au formulaire</button></a>';
                    }
                    ?>
                    
                    <div class="redirection-text">
                        Vous allez être redirigé vers l’accueil dans 15 secondes, ou cliquez sur le bouton.<br>
                    </div>
                    <a href="index.php"><button type="button" class="btn btn-primary redi-button">Accueil</button></a>

                </div>
            </div>
        </div>
      
    </body>
</html>