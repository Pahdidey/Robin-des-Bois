<div class="modal" id="mettre-disque-sac">
    <div class="overlay"></div>
    <div class="content">
    	<h1>Mettre un ou plusieurs disques dans le sac</h1>
        <form action="action-mettre-disque-sac.php" method="post">
	    <div>
	    	<?php foreach ($partie->personnages->personnage as $personnage): ?>
				<?php if (($personnage['pioche'] != 0) or (($personnage['utilise'] == 0) and ($personnage['pioche'] == 0))): ?>
					<?php if ($personnage['utilise'] == 0): ?>
					<div class="soft">
					<?php else: ?>
					<div>
					<?php endif; ?>
					  	<input type="checkbox" id="disque-<?php echo $personnage['id']; ?>" name="disques[]" value="disque-<?php echo $personnage['id']; ?>" />
						<label for="disque-<?php echo $personnage['id']; ?>">Disque <?php echo $personnage['couleur']; ?> (<?php echo $personnage['nom']; ?>)</label>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php foreach ($partie->disques->disque as $disque): ?>
				<?php if (($disque['pioche'] != 0) or (($disque['utilise'] == 0) and ($disque['pioche'] == 0))): ?>
					<?php if ($disque['utilise'] == 0): ?>
					<div class="soft">
					<?php else: ?>
					<div>
					<?php endif; ?>
					  	<input type="checkbox" id="disque-<?php echo $disque['id']; ?>" name="disques[]" value="disque-<?php echo $disque['id']; ?>" />
						<label for="disque-<?php echo $disque['id']; ?>">Disque <?php echo $disque['couleur']; ?></label>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	    <button type="submit">Valider</button>
	</form>
   	</div>
</div>