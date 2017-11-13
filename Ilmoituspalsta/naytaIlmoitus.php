<?php
require_once "ilmoitus.php";

session_start();

if (isset($_SESSION["ilmoitus"])) {
    $ilmoitus = $_SESSION["ilmoitus"];
    unset($_SESSION["ilmoitus"]); // 1 tapa tyhjentää sessio kun se on lähetetty, kevyempi versio
    // Tyhjennetään istuntomuuttujat palvelimelta kokonaan
    //$_SESSION = array();
    //if (isset($_COOKIE[session_name()])) {
    // Poistetaan istunnon tunniste käyttäjän koneelta
    //setcookie(session_name(), '', time()-100, '/');
//  }
// Tuhotaan istunto
//session_destroy(); 
} else {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html> 
<html>
<head> 
<meta charset="UTF-8">
<title>Myyntipaikka netissä - osta, myy &amp; vaihda!</title>
<meta name="author" content="Sirpa Marttila">
<link href="ilmoitus.css" rel="stylesheet">
</head>
<body>
	<div class="tausta">

		<header> Myyntipaikka netissä </header>

		<nav>
			<ul>
				<li><a href="index.php">Etusivu</a></li>
				<li><a href="uusiIlmoitus.php">Ilmoita</a></li>
				<li><a href="kaikkiIlmoitukset.php">Kaikki ilmoitukset</a></li>
				<li><a href="haeIlmoitus.php">Hae ilmoitusta</a></li>
				<li><a href="yhteystiedot.php">Yhteystiedot</a></li>
			</ul>
		</nav>

		<article>
			<h3 style="text-align: center">Ilmoituksen tiedot</h3>
            <span class="virhe"><?php print($ilmoitus->getNimi())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getEmail())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getPuhnro())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getPaikkakunta())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getTyyppi())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getOtsikko())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getKuvaus())?></span><br />
            <span class="virhe"><?php print($ilmoitus->getHinta())?></span>
		</article>

	</div>
</body>
</html>