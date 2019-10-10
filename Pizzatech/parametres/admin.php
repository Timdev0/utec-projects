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

    <?php $title = "Paramètres Admin"?>

    <?php include '../head.php'?>

    <body>
        <?php include '../navbar.php'?>

        <?php include 'errors.php'?>
        <div class="container my-3">
            <h2>Paramètres Admin</h2>
            <div class="accordion" id="accordionExample">
                <div class="card card-collapse">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-collapse" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Créer un compte employé
                        </button>
                    </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                        <form method="post" action="admin.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username">Utilisateur</label>
                                    <input id="username" class="form-control" type="text" name="username" value="<?php echo $username1; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Mail</label>
                                    <input id="email" class="form-control" type="email" name="email" value="<?php echo $email1; ?>">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom">Nom</label>
                                    <input id="nom" class="form-control" type="text" name="nom" value="<?php echo $nom1; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="prenom">Prénom</label>
                                    <input id=prenom class="form-control" type="text" name="prenom" value="<?php echo $prenom1; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tel" >Numero de téléphone</label>
                                    <input id="tel" class="form-control" type="tel" name="tel" value="<?php echo $tel1; ?>">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="civilite">Civilité</label>
                                    <select id="civilite" class="form-control" name="civilite">
                                        <option value="">Choisir une civilité</option>
                                        <option value="1" <?php if($civilite1 == 1){echo"selected";} ?> >Homme</option>
                                        <option value="2" <?php if($civilite1 == 2){echo"selected";} ?> >Femme</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="date">Date de naissance</label>
                                    <input id="date" class="form-control" type="date" name="daten" value="<?php echo $daten1; ?>">
                                </div>

                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="adresse">Adresse</label>
                                    <input id="adresse" class="form-control" type="text" name="adresse" value="<?php echo $adresse1; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ville">Ville</label>
                                    <input id="ville" class="form-control" type="text" name="ville" value="<?php echo $ville1; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="cp">Code postal</label>
                                    <input id="cp" class="form-control" type="text" pattern="[0-9]{5}" name="cp" value="<?php echo $cp1; ?>">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="psw1">Mot de passe</label>
                                    <input id="psw1" class="form-control" type="password" name="password_1">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="psw2">Confirmez le mot de passe</label>
                                    <input id="psw2" class="form-control" type="password" name="password_2">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="reg_emp">Enregistrer</button>
                            </div>

                        </form>

                        </div>
                    </div>
                </div>
                <div class="card card-collapse">
                    <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-collapse collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Créer un compte admin
                        </button>
                    </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <form method="post" action="admin.php">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username">Utilisateur</label>
                                    <input id="username" class="form-control" type="text" name="username2" value="<?php echo $username2; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Mail</label>
                                    <input id="email" class="form-control" type="email" name="email2" value="<?php echo $email2; ?>">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom">Nom</label>
                                    <input id="nom" class="form-control" type="text" name="nom2" value="<?php echo $nom2; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="prenom">Prénom</label>
                                    <input id=prenom class="form-control" type="text" name="prenom2" value="<?php echo $prenom2; ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tel" >Numero de téléphone</label>
                                    <input id="tel" class="form-control" type="tel" name="tel2" value="<?php echo $tel2; ?>">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="civilite">Civilité</label>
                                    <select id="civilite" class="form-control" name="civilite">
                                        <option value="">Choisir une civilité</option>
                                        <option value="1" <?php if($civilite2 == 1){echo"selected";} ?> >Homme</option>
                                        <option value="2" <?php if($civilite2 == 2){echo"selected";} ?> >Femme</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="date">Date de naissance</label>
                                    <input id="date" class="form-control" type="date" name="daten2" value="<?php echo $daten2; ?>">
                                </div>

                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="adresse">Adresse</label>
                                    <input id="adresse" class="form-control" type="text" name="adresse2" value="<?php echo $adresse2; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="ville">Ville</label>
                                    <input id="ville" class="form-control" type="text" name="ville2" value="<?php echo $ville2; ?>">
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="cp">Code postal</label>
                                    <input id="cp" class="form-control" type="text" pattern="[0-9]{5}" name="cp2" value="<?php echo $cp2; ?>">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="psw1">Mot de passe</label>
                                    <input id="psw1" class="form-control" type="password" name="password_12">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="psw2">Confirmez le mot de passe</label>
                                    <input id="psw2" class="form-control" type="password" name="password_22">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="reg_admin">Enregistrer</button>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>