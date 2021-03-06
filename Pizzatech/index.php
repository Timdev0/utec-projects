<!-- Montre les erreurs-->
<?php
    ini_set("display_errors", true);
    error_reporting(E_ALL);
?>


<?php
    //Verifie si l'utisateur est co et vérifie sur il se déco
    session_start();
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "Vous devez d'abord vous connecter.";
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
    }
?>

<!-- Inclus connexion db -->
<?php include 'server.php'?>

<!doctype html>
<html lang="fr">

    <?php $title = "Accueil" ?>
    
    <?php include 'head.php'?>

    <body>
        <?php include 'navbar.php'?>


        <div class="container my-3">
            <div class="jumbotron">
                <h1 class="display-4">PizzaTech</h1>
                <p class="lead"></p>
                <hr class="my-4">
                <?php if (!isset($_SESSION['username'])): ?>
                    <p>Connectez vous pour commander.</p>
                <?php else : ?>
                    <p>
                        Bienvenue sur le site de PizzaTech
                        <?php if (!empty($_SESSION['name'])): ?>
                            <?php echo $_SESSION['name']; ?>
                        <?php elseif (empty($_SESSION['name'])): ?>
                            <?php echo $_SESSION['username']; ?>
                        <?php else: ?>
                            <?php echo $_SESSION['username']; ?>
                        <?php endif;?>
                    </p>
                <?php endif ;?>
                <p class="lead">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a class="btn btn-primary btn-lg first" href="/Pizzatech/commander.php" role="button">Commander</a>
                    <?php else :?>
                        <a class="btn btn-primary btn-lg first" href="/Pizzatech/registration/login.php" role="button">Se connecter</a>
                        <a class="btn btn-primary btn-lg" href="/Pizzatech/registration/register.php" role="button">S'enregistrer</a>
                        <a class="btn btn-primary btn-lg last" href="/Pizzatech/commander.php" role="button">Voir les produits</a>
                    <?php endif;?>
                </p>
            </div>

                    <!-- Login msg -->
            <div class="content">
                <!-- Message de bienvenue -->
                <?php if (isset($_SESSION['username'])): ?>
                    <div class="welcome">
                        <p>Bienvenue 
                            <strong>
                                <?php if (!empty($_SESSION['name'])): ?>
                                    <?php echo $_SESSION['name']; ?>
                                <?php elseif (empty($_SESSION['name'])) : ?>
                                    <?php echo $_SESSION['username']; ?>
                                <?php else : ?>
                                    <?php echo $_SESSION['username']; ?>
                                <?php endif ;?>
                            </strong>
                        </p>
                        <p>
                            <a href="index.php?logout='1'" style="color: red;"><i class="fa fa-sign-out" aria-hidden="true"></i> Se déconnecter</a>
                        </p>
                    </div>
                <?php endif?>
            </div>

        </div>

    </body>
</html>