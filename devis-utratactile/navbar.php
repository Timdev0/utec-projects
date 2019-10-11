<!-- Montre les erreurs-->
<?php
   ini_set("display_errors", true);
   error_reporting(E_ALL);
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/devis/index.php">
        <img class="img-fluid img-nav" src="/devis/assets/favicon.png" alt="ultratactile"/>
        Ultratactile (reproduction)
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/devis/devis.php">Devis</a>
                </li>
            <?php endif?>

            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/devis/devis-log.php">Devis</a>
                </li>
            <?php endif?>

            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/devis/login.php">Se connecter</a>
                </li>
            <?php endif?>

            <?php if (!isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link " href="/devis/register.php">S'enregister</a>
                </li>
            <?php endif?>

            
        </ul>


        <?php if (isset($_SESSION['username'])): ?>
            <a class="nav-link btn-nav" href="/devis/parametres.php">
                <i class="fa fa-cog" aria-hidden="true"></i>
            </a>
        <?php endif?>

        <?php if (isset($_SESSION['username'])): ?>
            <div class="disconnect">
                <a class="nav-link btn-nav disconnect" href="/devis/index.php?logout='1'">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </div>
        <?php endif?>
    </div>
</nav>