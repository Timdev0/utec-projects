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

<html>
    <?php $title="Accueil"; ?>
    <!-- include head -->
    <?php include 'head.php' ?>

    <body>

        <?php include 'navbar.php'?>

        <div class="container my-3">
            <div class="jumbotron">
                <h1 class="display-4">Ultratactile (reproduction)</h1>
                <p class="lead"></p>
                <hr class="my-4">
                <?php if (!isset($_SESSION['username'])): ?>
                    <p>Bienvenu sur le site Ultratactile</p>
                <?php else : ?>
                    <p>
                        Bienvenue sur le site d'Ultratactile
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
                <?php if (!isset($_SESSION['username'])): ?>
                    <a class="btn btn-primary btn-lg first" href="/devis/login.php" role="button">Se connecter</a>
                    <a class="btn btn-primary btn-lg" href="/devis/register.php" role="button">S'enregistrer</a>
                <?php endif ; ?>
                <a class="btn btn-primary btn-lg last" href="/devis/devis.php" role="button">Faire une demande de devis</a>
                </p>
            </div>
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