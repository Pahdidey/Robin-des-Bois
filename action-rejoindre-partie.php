<?php
	session_start();
	
	$code = $_POST['code-liste'];

	if (!empty($_POST)) {
		$parties  =  simplexml_load_file('parties.xml');
		$i = 0;
		foreach ($parties as $partie) {
			$nom = $partie['nom'];
			if ($nom == $code) {
				$i++;
				$_SESSION["partie"] = "rejointe";
				$_SESSION["nomPartie"] = $code;
				header("Location: index.php?nompartie={$code}");
			}
		}
		if ($i == 0) {
			$_SESSION["partie"] = "inconnue";
			$_SESSION["nomPartie"] = $code;
			header("Location: index.php");
		}
	}
?>