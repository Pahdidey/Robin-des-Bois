<?php session_start(); ?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Robin des Bois</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="robots" content="noindex, nofollow" />
	    <link rel="stylesheet" href="./css/reset.css">
	    <link rel="stylesheet" href="./css/styles.css<?php echo "?".rand();?>">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script type="text/javascript" src="./js/scripts.js<?php echo "?".rand();?>"></script>
	</head>
	<body>
		<?php include('notifs.php'); ?>

		<?php $parties  =  simplexml_load_file('parties.xml'); ?>

		<header>
			<div class="banner">
				<h1>Les aventures de Robin des Bois</h1>
				<?php $i = 0; ?>
    			<?php foreach ($parties as $partie): ?>
	    			<?php $nom = $partie['nom']; ?>
	    			<?php if ($nom == $_GET['nompartie']): ?>
				        <p>La partie <strong><?php echo $nom; ?></strong> est en cours, partagez ce code avec les autres joueurs&nbsp;!</p>

				        <?php include('gestion-partie.php'); ?>

				        <div class="participants">
							<?php foreach ($partie->personnages->personnage as $personnage): ?>
								<?php if ($personnage['utilise'] > 0): ?>
									<div class="<?php echo $personnage['id']; ?>">
							    		<img src="./img/<?php echo $personnage['id']; ?>.png" alt="">
							    		<p><?php echo $personnage['nom']; ?></p>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
				    	<?php $i++; ?>
						<?php break; ?>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php if ($i == 0): ?>
					<p><strong>Aucune partie en cours.</strong><br>
					<?php include('gestion-partie.php'); ?>
				<?php endif; ?>
			</div>
		</header>

		<main>
			<?php $i = 0; ?>
			<?php foreach ($parties as $partie): ?>
				<?php $nom = $partie['nom']; ?>
				<?php if ($nom == $_GET['nompartie']): ?>
					<section id="actions">
						<div>
							<figure>
				    			<img src="./img/actions.png" alt="">
				    		</figure>
				    		<div id="contenu-disques">
					    		<ul class="disques">
									<?php foreach ($partie->personnages->personnage as $personnage): ?>
										<?php if (($personnage['utilise'] > 0) and ($personnage['pioche'] == 0)): ?>
											<li class="<?php echo $personnage['couleur']; ?>"><span class="invisible"><?php echo $personnage['couleur']; ?></span></li>
										<?php endif; ?>
									<?php endforeach; ?>
									<?php foreach ($partie->disques->disque as $disque): ?>
										<?php if (($disque['utilise'] > 0) and ($disque['pioche'] == 0)): ?>
											<li class="<?php echo $disque['couleur']; ?>"><span class="invisible"><?php echo $disque['couleur']; ?></span></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
			    		<div>
				    		<h2>Actions</h2>
				    		<p>Les disques permettent de gérer le tour des joueurs et les événements du jeu.</p>
				    		<div id="dernier-disque">
					    		<?php foreach ($partie->disques as $disques): ?>
									<?php if ($disques['dernier'] != ""): ?>
										<p><strong>Disque pioché&nbsp;:</strong> <span class="disque <?php echo $disques['dernier']; ?>"><span class="invisible"><?php echo $disques['dernier']; ?></span></span></p>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
				    		<div class="actions">
				    			<a href="#" class="button open-modal" data-modal="mettre-disque-sac">Ajouter au sac</a>
								<a href="action-piocher-disque-sac.php" class="button">Piocher dans le sac</a>
							</div>							
						</div>
				    </section>

				    <section id="combats">
				    	<div>
				    		<figure>
				    			<img src="./img/combat.png" alt="">
				    		</figure>
				    		<div id="contenu-cubes">
					    		<ul class="cubes">
									<?php foreach ($partie->cubes->cube as $cube): ?>
										<?php for ($i = 1; $i <= $cube['utilise']; $i++): ?>
										    <li class="<?php echo $cube['id']; ?>"><span class="invisible"><?php echo $cube['id']; ?></span></li>
										<?php endfor; ?>
									<?php endforeach; ?>
								</ul>
							</div>
			    		</div>
			    		<div>
				    		<h2>Combats</h2>
				    		<p>Les cubes sont utilisés pour les combats. Lorsqu'un joueur combat, il pioche 3 cubes les uns après les autres. Pour gagner, il faut avoir 1 cube blanc (parfois plus).</p>
				    		<div id="dernier-cube">
					    		<?php foreach ($partie->cubes as $cubes): ?>
									<?php if ($cubes['dernier'] != ""): ?>
										<p><strong>Cube pioché&nbsp;:</strong> <span class="cube <?php echo $cubes['dernier']; ?>"><span class="invisible"><?php echo $cubes['dernier']; ?></span></span></p>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
				    		<div class="actions">
				    			<a href="#" class="button open-modal" data-modal="mettre-cube-sac">Ajouter au sac</a>
								<a href="action-piocher-cube-sac.php" class="button">Piocher dans le sac</a>
							</div>
						</div>
				    </section>

				    <?php include('mettre-cube-sac.php'); ?>
					<?php include('mettre-disque-sac.php'); ?>

				<?php endif; ?>
			<?php endforeach; ?>

			<?php if ($i == 0): ?>
				<section>
					<div class="center">
						<figure class="margin-bottom">
							<img src="./img/error.png" alt="">
						</figure>
						<p>Pour jouer, <strong>créez une nouvelle partie</strong> ou <strong>rejoignez une partie</strong> existante.</p>
					</div>
				</section>
			<?php endif; ?>
		</main>

		<footer>
			<p class="smaller">Vous cherchez plus d'informations sur les jeux de société&nbsp;? Le site <a href="http://des-en-mousse.com/" title="des-en-mousse.com (nouvelle fenêtre)" aria-label="des-en-mousse.com (nouvelle fenêtre)">Dés en Mousse</a> est la pour vous&nbsp;!</p>
			<p class="smaller">Icônes héros&nbsp;: max.icons | Autres icônes&nbsp;: Freepik&nbsp;- Flaticons</p>
		</footer>


		<?php include('rejoindre-partie.php'); ?>
		

	</body>
</html>