<?php if (count($errorsP) > 0): ?>
  <div class="error bg-danger text-white">
		<p class="error-msg text-center">
		<?php $i = 0?>
			<?php foreach ($errorsP as $error): ?>
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

<?php if (@$_SESSION['blyat'] == 2): ?>
    <div class="success bg-success text-white">
        <p class="success-msg text-center">
            Les informations ont bien été enregistré
		</p>
    </div>
<?php endif?>