<?php if (count($errors) > 0): ?>
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
