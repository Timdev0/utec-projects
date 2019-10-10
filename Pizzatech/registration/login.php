<!-- Montre les erreurs-->
<?php
	ini_set("display_errors", true);
	error_reporting(E_ALL);
?>

<!-- Inclus connexion db -->
<?php include 'server-register-login.php'?>

<!DOCTYPE html>
<html>

    <?php $title = "Se connecter"?>

    <?php include '../head.php'?>

   <body>
      <!-- Navbar -->
      <?php include '../navbar.php'?>

      <?php include 'errors-register-login.php';?>

      <div class="container my-3">

         <div class="header">
            <h2>Se connecter</h2>
         </div>

         <!-- Formulaire de login -->
         <form method="post" action="login.php">

            <div class="form-group">
               <label for="username">Nom d'utilisateur</label>
               <input id="username" class="form-control" type="text" name="username" >
            </div>

            <div class="form-group">
               <label for="password">Mot de passe</label>
               <input id="password" class="form-control" type="password" name="password">
            </div>

            <div class="form-group">
               <button type="submit" class="btn btn-primary" name="login_user">Se connecter</button>
              
            </div>
            <p>Pas encore inscrit ? <a href="register.php">S'enregistrer</a></p>
         </form>
      </div>

   </body>
</html>