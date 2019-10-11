<?php if (count($errors) > 0): ?>
<?php @$_SESSION['blyat'] = 0 ?>
  <div class="error bg-danger text-white">
		<p class="error-msg text-center">
		<?php $i = 0?>
			<?php foreach ($errors as $error): ?>
				<?php $i++?>
				<?php if ($i > 1): ?>
					<?php echo " - " . $error ?>
				<?php else: ?>
					<?php echo $error ?>
				<?php endif?>
			<?php endforeach?>
		</p>
  </div>
<?php endif?>

<?php if (@$_SESSION['blyat'] == 1): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Le produit : <?=$_SESSION['article'] ?> à bien été enregistré
		</p>
    </div>
<?php endif?>

<?php if (@$_SESSION['blyat'] == 2): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Les informations ont bien été enregistré
		</p>
    </div>
<?php endif?>

<?php if (@$_SESSION['blyat'] == 3): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Compte employé créé
		</p>
    </div>
<?php endif?>

<?php if (@$_SESSION['blyat'] == 4): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Article modifié
		</p>
    </div>
<?php endif?>

<?php if (@$_SESSION['blyat'] == 5): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Article Supprimé
		</p>
    </div>
<?php endif?>