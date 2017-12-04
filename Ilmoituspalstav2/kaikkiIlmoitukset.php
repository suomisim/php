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
				<li class="active">Kaikki ilmoitukset</li>
				<li><a href="haeIlmoitus.php">Hae ilmoitusta</a></li>
			</ul>
		</nav>

		<article>

<?php 
try {
	require_once "ilmoitusPDO.php";
    $kantakasittely = new ilmoitusPDO();
	
    $rivit = $kantakasittely->kaikkiIlmoitukset();
    foreach ($rivit as $ilmoitus) {
        print("<p>Nimi: " . $ilmoitus->getNimi());
        print("<br>Otsikko: " . $ilmoitus->getOtsikko());
        print("<br>Hinta: " . $ilmoitus->getHinta() . "<br></p>\n");
    }
	
} catch ( Exception $error ) {
	print("<p>Virhe: " . $error->getMessage ());
	//header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage () );
	//exit ();
}

?>
</article>

	</div>
</body>
</html>