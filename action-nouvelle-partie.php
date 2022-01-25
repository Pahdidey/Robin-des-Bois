<?php
	session_start();	

    $file = 'parties.xml';
	$parties = simplexml_load_file($file);

    $chaine = 'abcdefghijklmnopqrstuvwxyz';
    $chaine .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
	$chaine .= '1234567890'; 
	$code = ''; 

	for ($i=0; $i < 5; $i++) { 
		$code .= substr($chaine,rand()%(strlen($chaine)),1); 
	}

	echo $code;

	// PARTIE
	$nvPartie = $parties->addChild('partie');
	$nvPartie->addAttribute('nom', $code);

	// PERSONNAGES
	$nvPersos = $nvPartie->addChild('personnages');
	// Robin
	$ajoutRobin = $nvPersos->addChild('personnage');
	$ajoutRobin->addAttribute('id', 'robin');
	$ajoutRobin->addAttribute('couleur', 'vert');
	$ajoutRobin->addAttribute('nom', 'Robin des Bois');
	$ajoutRobin->addAttribute('utilise', '0');
	$ajoutRobin->addAttribute('pioche', '0');
	// Marianne
	$ajoutMarianne = $nvPersos->addChild('personnage');
	$ajoutMarianne->addAttribute('id', 'marianne');
	$ajoutMarianne->addAttribute('couleur', 'jaune');
	$ajoutMarianne->addAttribute('nom', 'Belle Marianne');
	$ajoutMarianne->addAttribute('utilise', '0');
	$ajoutMarianne->addAttribute('pioche', '0');
	// Jean
	$ajoutJean = $nvPersos->addChild('personnage');
	$ajoutJean->addAttribute('id', 'jean');
	$ajoutJean->addAttribute('couleur', 'bleu');
	$ajoutJean->addAttribute('nom', 'Petit Jean');
	$ajoutJean->addAttribute('utilise', '0');
	$ajoutJean->addAttribute('pioche', '0');
	// Will
	$ajoutWill = $nvPersos->addChild('personnage');
	$ajoutWill->addAttribute('id', 'will');
	$ajoutWill->addAttribute('couleur', 'turquoise');
	$ajoutWill->addAttribute('nom', 'Will Scarlet');
	$ajoutWill->addAttribute('utilise', '0');
	$ajoutWill->addAttribute('pioche', '0');


	// DISQUES
    $nvDisques = $nvPartie->addChild('disques');
    $nvDisques->addAttribute('dernier', '');
    $arrDisques = [
	    "rouge" => "rouge",
	    "blanc" => "blanc",
	    "gris1" => "gris",
	    "gris2" => "gris",
	    "violet1" => "violet",
	    "violet2" => "violet"
	];
	foreach ($arrDisques as $id => $couleur) {
	    $nvDisque = $nvDisques->addChild('disque');
		$nvDisque->addAttribute('id', $id);
		$nvDisque->addAttribute('couleur', $couleur);
		$nvDisque->addAttribute('utilise', '0');
		$nvDisque->addAttribute('pioche', '0');
	}


    // CUBES
    $nvCubes = $nvPartie->addChild('cubes');
    $nvCubes->addAttribute('dernier', '');
    // Violet
    $ajoutCubeViolet = $nvCubes->addChild('cube');
	$ajoutCubeViolet->addAttribute('id', 'violet');
	$ajoutCubeViolet->addAttribute('utilise', '0');
	// Blanc
    $ajoutCubeBlanc = $nvCubes->addChild('cube');
	$ajoutCubeBlanc->addAttribute('id', 'blanc');
	$ajoutCubeBlanc->addAttribute('utilise', '0');



	$dom = dom_import_simplexml($parties)->ownerDocument;
	$dom->formatOutput = true;
	$dom->preserveWhiteSpace = false;
	$dom->loadXML( $dom->saveXML());
	$dom->save($file);

    $_SESSION["partie"] = "nouvelle";
	$_SESSION["nomPartie"] = $code;

	header("Location: index.php?nompartie={$code}");
?>