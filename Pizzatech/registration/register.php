<!-- Montre les erreurs-->
<?php
	ini_set("display_errors", true);
	error_reporting(E_ALL);
?>

<!-- Inclus connexion db -->
<?php include 'server-register-login.php'?>

<!DOCTYPE html>
<html>

    <?php $title = "S'enregistrer"?>

    <?php include '../head.php'?>
	
	<body>
		<!-- Navbar-->
		<?php include '../navbar.php'?>

		<?php include 'errors-register-login.php'; ?>

		<div class="container my-3">

			<div class="header">
				<h2>S'enregistrer</h2>
			</div>

			<!-- Formulaire register -->
			<form method="post" action="register.php">
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
					<button type="submit" class="btn btn-primary" name="reg_user">S'enregistrer</button>
				</div>

				<p>Vous possédez déjà un compte ?<a href="login.php"> Connectez-vous</a></p>

			</form>

		</div>

	</body>
</html>