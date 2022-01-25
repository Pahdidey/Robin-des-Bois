<?php
	session_start();

	$code = $_SESSION["nomPartie"];


	$file = 'parties.xml';
	$parties = simplexml_load_file($file);

	
	$xmlChemin = '//partie[@nom="' . $code . '"]';

	$sac = array();

	foreach ($parties->xpath($xmlChemin) as $partie) {
		$x = 0;
		foreach ($partie->disques->disque as $disque) {	
			if (($disque['utilise'] == 1) and ($disque['pioche'] == 0)) {
				$sac[] = $disque['id'];
				$x++;
			}		
		}
		foreach ($partie->personnages->personnage as $personnage) {			
			if (($personnage['utilise'] == 1) and ($personnage['pioche'] == 0)) {
				$sac[] = $personnage['id'];
				$x++;
			}
		}
	}

	$max = $x - 1;

	$chiffreAuHasard = rand(0, $max);
	echo $chiffreAuHasard;
	echo "<br>";

	echo $sac[$chiffreAuHasard];

	foreach ($parties->xpath($xmlChemin) as $partie) {
		foreach ($partie->disques as $disques) {
			$disques['dernier'] = $sac[$chiffreAuHasard];
			foreach ($disques->disque as $disque) {
				if ($disque['id'] == $sac[$chiffreAuHasard]) {
					echo $sac[$chiffreAuHasard];
					$disque['pioche'] = "1";
				}
			}
		}
		foreach ($partie->personnages->personnage as $personnage) {
			if ($personnage['id'] == $sac[$chiffreAuHasard]) {
				echo $sac[$chiffreAuHasard];
				$personnage['pioche'] = "1";
			}
		}
	}


	$dom = dom_import_simplexml($parties)->ownerDocument;
	$dom->formatOutput = true;
	$dom->preserveWhiteSpace = false;
	$dom->loadXML( $dom->saveXML());
	$dom->save($file);

	header("Location: index.php?nompartie={$code}#actions");
?>