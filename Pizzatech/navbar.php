<!-- Montre les erreurs-->
<?php
   ini_set("display_errors", true);
   error_reporting(E_ALL);
?>


<!-- Inclus connexion db -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/Pizzatech/index.php">
        <img class="img-fluid img-nav" src="/Pizzatech/assets/favicon.png" alt="pizza"/>
        PizzaTech
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/Pizzatech/commander.php">Commander</a>
            </li>

            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Pizzatech/registration/login.php">Se connecter</a>
                </li>
            <?php endif?>

            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link " href="/Pizzatech/registration/register.php">S'enregister</a>
                </li>
            <?php endif?>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($idUser == 3 or $idUser == 1 or $idUser == 4 ) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/Pizzatech/mes-commandes.php">Mes commandes</a>
                </li>
                <?php endif;?>
            <?php endif;?>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($idUser == 1 or $idUser == 4 ): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Pizzatech/les-commandes.php">Les commandes</a>
                    </li>
                <?php endif;?>
            <?php endif;?>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($idUser == 1 or $idUser == 4 ): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Pizzatech/parametres/admin.php">Paramètres admin</a>
                    </li>
                <?php endif?>
            <?php endif?>

            <?php if (isset($_SESSION['username'])): ?>
                <?php if ($idUser == 2 or $idUser == 4 ): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Pizzatech/parametres/employe.php">Paramètres employé</a>
                    </li>
                <?php endif?>
            <?php endif?>
            
        </ul>

        <?php if (isset($_SESSION['username'])): ?>
            <?php if ($idUser == 3 or $idUser == 1 or $idUser == 4 ): ?>
                <a class="nav-link btn-nav" href="/Pizzatech/panier.php">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </a>
            <?php endif;?>
        <?php endif;?>

        <?php if (isset($_SESSION['username'])): ?>
            <a class="nav-link btn-nav" href="/Pizzatech/parametres/utilisateur.php">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </a>
        <?php endif?>

        <?php if (isset($_SESSION['username'])): ?>
            <div class="disconnect">
                <a class="nav-link btn-nav disconnect" href="/Pizzatech/index.php?logout='1'">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </div>
        <?php endif?>
    </div>
</nav>