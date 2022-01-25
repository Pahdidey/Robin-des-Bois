<?php
	session_start();

	$code = $_SESSION["nomPartie"];


	$file = 'parties.xml';
	$parties = simplexml_load_file($file);

	
	$xmlChemin = '//partie[@nom="' . $code . '"]';

	foreach ($parties->xpath($xmlChemin) as $partie) {
		foreach ($partie->cubes->cube as $cube) {
			$cubeId = "cube-" . $cube['id'];
			$cube['utilise'] = $cube['utilise'] + $_POST["{$cubeId}"];
		}
	}

	$dom = dom_import_simplexml($parties)->ownerDocument;
	$dom->formatOutput = true;
	$dom->preserveWhiteSpace = false;
	$dom->loadXML( $dom->saveXML());
	$dom->save($file);

	header("Location: index.php?nompartie={$code}#combats");
?>