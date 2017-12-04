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
				<li class="active">Hae ilmoitusta</li>
			</ul>
		</nav>

		<article>

			<form action="haeIlmoitus.php" method="post">
				<p>
					<label>Tyyppi</label> <select name="tyyppi">
						<option value="0">Valitse</option>
						<option value="1">Myydään</option>
						<option value="2">Ostetaan</option>
						<option value="3">Vaihdetaan</option>
					</select> <input class="blue" type="submit" name="hae" value="Hae">
				</p>
			</form>
			<br>

<?php
// Jos on hae-niminen painike, tehdään tietojen haku kannasta annetulla kriteerillä
if (isset ( $_POST ["hae"] ) && $_POST ["tyyppi"] != 0) {
	try {
		require_once "ilmoitusPDO.php";
        $kantakasittely = new ilmoitusPDO();
        $rivit = $kantakasittely->haeIlmoitus($_POST ["tyyppi"]);
        if ($kantakasittely->getLkm() == 0) {
            print("<p>Hakemasi tyyppisiä ilmoituksia ei ole</p>");
        }
		foreach ($rivit as $ilmoitus) {
            print("<p>Nimi: " . $ilmoitus->getNimi());
            print("<br>Otsikko: " . $ilmoitus->getOtsikko());
            print("<br>Hinta: " . $ilmoitus->getHinta() . "<br></p>\n");
        }
	
	} catch ( Exception $error ) { 
		print("Virhe: " . $error->getMessage());
		//header ( "location: virhe.php?virhe=" . $error->getMessage () );
		//exit ();
	}
}
?>
</article>

	</div>
</body>
</html>