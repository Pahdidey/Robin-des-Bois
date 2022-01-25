<?php
	session_start();

	$code = $_SESSION["nomPartie"];


	$file = 'parties.xml';
	$parties = simplexml_load_file($file);

	
	$xmlChemin = '//partie[@nom="' . $code . '"]';

	foreach ($parties->xpath($xmlChemin) as $partie) {
		foreach ($partie->disques->disque as $disque) {
			$disqueId = "disque-" . $disque['id'];
			foreach($_POST['disques'] as $disqueChoisi) {
				if ($disqueChoisi == $disqueId) {
					$disque['utilise'] = "1";
					$disque['pioche'] = "0";
				}
			}
		}
		foreach ($partie->personnages->personnage as $personnage) {
			$persoId = "disque-" . $personnage['id'];
			foreach($_POST['disques'] as $disqueChoisi) {
				if ($disqueChoisi == $persoId) {
					$personnage['utilise'] = "1";
					$personnage['pioche'] = "0";
				}
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