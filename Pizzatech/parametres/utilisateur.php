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

    <?php $title = "Paramètres de compte"?>
    
    <?php include '../head.php'?>

    <body>

        <?php include '../navbar.php'?>

        <?php include 'errors.php' ?>

        <div class="container my-3">
            <h2>Paramètres de compte</h2>

            <?php
            $persoIdInfos = $_SESSION['userID'];
            $sqlInfos = "SELECT * FROM `personne` WHERE perso_id = $persoIdInfos";
            $resultInfos = mysqli_query($conn, $sqlInfos);
            while($row = mysqli_fetch_object($resultInfos)){
                // initializing variables
                $username = "$row->perso_username";
                $email = "$row->perso_mail";
                $nom = "$row->perso_nom";
                $prenom = "$row->perso_prenom";
                $civilite = "$row->perso_civilite";
                $daten = "$row->perso_dnais";
                $tel="$row->perso_phone";
                $adresse="$row->perso_adresse";
                $cp="$row->perso_cp";
                $ville="$row->perso_ville";
            }

            ?>


            <h3 class="mb-0">
                Option de compte
            </h3>


            <form method="post" action="utilisateur.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Utilisateur</label>
                        <input id="username" class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">Mail</label>
                        <input id="email" class="form-control" type="email" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nom">Nom</label>
                        <input id="nom" class="form-control" type="text" name="nom" value="<?php echo $nom; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="prenom">Prénom</label>
                        <input id=prenom class="form-control" type="text" name="prenom" value="<?php echo $prenom; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tel" >Numero de téléphone</label>
                        <input id="tel" class="form-control" type="tel" name="tel" value="<?php echo $tel; ?>">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="civilite">Civilité</label>
                        <select id="civilite" class="form-control" name="civilite">
                            <option value="">Choisir une civilité</option>
                            <option value="1" <?php if($civilite == 1){echo"selected";} ?> >Homme</option>
                            <option value="2" <?php if($civilite == 2){echo"selected";} ?> >Femme</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="date">Date de naissance</label>
                        <input id="date" class="form-control" type="date" name="daten" value="<?php echo $daten; ?>">
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="adresse">Adresse</label>
                        <input id="adresse" class="form-control" type="text" name="adresse" value="<?php echo $adresse; ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ville">Ville</label>
                        <input id="ville" class="form-control" type="text" name="ville" value="<?php echo $ville; ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="cp">Code postal</label>
                        <input id="cp" class="form-control" type="text" pattern="[0-9]{5}" name="cp" value="<?php echo $cp; ?>">
                    </div>

                </div>

                <div class="form-row">
                <div class="form-group col-md-12">
                        <label for="psw1">Mot de passe actuel</label>
                        <input id="psw1" class="form-control" type="password" name="actuelMdp">
                    </div>

                <!-- Nouveau mot de passe
                    <div class="form-group col-md-4">
                        <label for="mdp1">Nouveau mot de passe</label>
                        <input id="mdp1" class="form-control" type="password" name="mdp1">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="mdp2">Confirmez le nouveau mot de passe</label>
                        <input id="mdp2" class="form-control" type="password" name="mdp2">
                    </div>
                </div>

                -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="update_user">Enregistrer</button>
                </div>
                
            </form>
        </div>        
    </body>
</html>