<?php
	session_start();

	$code = $_SESSION["nomPartie"];


	$file = 'parties.xml';
	$parties = simplexml_load_file($file);

	
	$xmlChemin = '//partie[@nom="' . $code . '"]';

	$sac = array();

	foreach ($parties->xpath($xmlChemin) as $partie) {
		$x = 0;
		foreach ($partie->cubes->cube as $cube) {			
			for ($i = 1; $i <= $cube['utilise']; $i++) {
				$sac[] = $cube['id'];
				$x++;
			}
		}
	}

	$max = $x - 1;

	$chiffreAuHasard = rand(0, $max);

	foreach ($parties->xpath($xmlChemin) as $partie) {
		foreach ($partie->cubes as $cubes) {
			$cubes['dernier'] = $sac[$chiffreAuHasard];
			foreach ($cubes->cube as $cube) {
				if ($cube['id'] == $sac[$chiffreAuHasard]) {
					$cube['utilise'] = $cube['utilise'] - 1;
				}
			}
		}
	}


	$dom = dom_import_simplexml($parties)->ownerDocument;
	$dom->formatOutput = true;
	$dom->preserveWhiteSpace = false;
	$dom->loadXML( $dom->saveXML());
	$dom->save($file);

	header("Location: index.php?nompartie={$code}#combats");
?>