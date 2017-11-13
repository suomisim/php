<?php
require_once "ilmoitus.php";

session_start(); //luokan lisäämisen jälkeen



if (isset ( $_POST ["submit"] )) {
    $ilmoitus = new Ilmoitus($_POST["nimi"], $_POST["email"], $_POST["puhnro"], $_POST["paikkakunta"], $_POST["tyyppi"], $_POST["otsikko"], $_POST["kuvaus"], $_POST["hinta"]); //huom järjestys
    $_SESSION["ilmoitus"] = $ilmoitus; //olion lisääminen sessioon nimeltä ilmoitus
    session_write_close(); //istunnon päättäminen
    // print_r($ilmoitus); Voi käyttää virheiden selvitykseen
    $nimiVirhe = $ilmoitus->checkNimi();
    $emailVirhe = $ilmoitus->checkEmail();
    $hintaVirhe = $ilmoitus->checkHinta(true, 0.0, 1000.0);
    $puhnroVirhe = $ilmoitus->checkPuhnro();
    $kuvausVirhe = $ilmoitus->checkKuvaus();
    
    if ($nimiVirhe == 0 && $emailVirhe == 0 && $hintaVirhe == 0 && $puhnroVirhe == 0 && $kuvausVirhe == 0){
        header("location: naytaIlmoitus.php");
        exit();
    }
    
    
} 
elseif (isset ( $_POST ["peruuta"] )) {
	header ( "location: index.php" );
	exit ();
} 
else {
    if (isset($_SESSION["ilmoitus"])) { //jos ilmoitus-sessio on olemassa
        $ilmoitus = $_SESSION["ilmoitus"]; //sessio ilmoitus -> olio ilmoitus
        $nimiVirhe = $ilmoitus->checkNimi();
        $emailVirhe = $ilmoitus->checkEmail();
        $hintaVirhe = $ilmoitus->checkHinta(true, 0.0, 1000.0);
        $puhnroVirhe = $ilmoitus->checkPuhnro();
        $kuvausVirhe = $ilmoitus->checkKuvaus();
    } else {
        $ilmoitus = new Ilmoitus(); //tyhjä olio
        $nimiVirhe = 0; //virheet nollaksi kun saavutaan sivulle
        $emailVirhe = 0;
        $hintaVirhe = 0;
        $puhnroVirhe = 0;
        $kuvausVirhe = 0;
    }
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Myyntipaikka netissä - osta, myy &amp; vaihda!</title>
<meta name="author" content="Sirpa Marttila">
<link href="ilmoitus.css" rel="stylesheet">
<style type="text/css">
label {
	display: block;
	float: left;
	width: 8em;
}
</style>
</head>
<body>
	<div class="tausta">
		<header> Myyntipaikka netissä </header>
		<nav>
			<ul>
				<li><a href="index.php">Etusivu</a></li>
				<li class="active">Ilmoita</li>
				<li><a href="">Kaikki ilmoitukset</a></li>
				<li><a href="">Hae ilmoitusta</a></li>
			</ul>
		</nav>

		<article>
			<form action="uusiIlmoitus.php" method="post">
				<fieldset>

					<legend>Ilmoittaja</legend>
					<p>
						<label>Nimi <span style="color: #B94A48">*</span></label> <input
							type="text" name="nimi" value="<?php print(htmlentities ($ilmoitus->getNimi(), ENT_QUOTES, "UTF-8")) ?>">
                        <span class="virhe"><?php print($ilmoitus->getError($nimiVirhe))?></span>
                    </p>

					<p>
						<label>Sähköposti <span style="color: #B94A48">*</span></label> <input
							type="text" name="email" value="<?php print(htmlentities ($ilmoitus->getEmail(), ENT_QUOTES, "UTF-8")) ?>">
                        <span class="virhe"><?php print($ilmoitus->getError($emailVirhe))?></span>
					</p>

					<p>
						<label>Puhelinnumero</label> <input type="text" name="puhnro"
							value="<?php print(htmlentities ($ilmoitus->getPuhnro(), ENT_QUOTES, "UTF-8")) ?>">
                        <span class="virhe"><?php print($ilmoitus->getError($puhnroVirhe))?></span>
					</p>

					<p>
						<label>Paikkakunta <span style="color: #B94A48">*</span></label> <input
							type="text" name="paikkakunta" value="<?php print(htmlentities ($ilmoitus->getPaikkakunta(), ENT_QUOTES, "UTF-8")) ?>">
                        <span class="virhe"><?php print($ilmoitus->getError($nimiVirhe))?></span>
					</p>

				</fieldset>

				<fieldset>

					<legend>Ilmoitus</legend>
					<p>
						<label>Tyyppi</label> <select name="tyyppi">
							<option value="1">Myydään</option>
							<option value="2">Ostetaan</option>
							<option value="3">Vaihdetaan</option>
						</select>
					</p>

					<p>
						<label>Otsikko <span style="color: #B94A48">*</span></label> <input
							type="text" name="otsikko" value="<?php print(htmlentities ($ilmoitus->getOtsikko(), ENT_QUOTES, "UTF-8")) ?>">
                        <span class="virhe"><?php print($ilmoitus->getError($nimiVirhe))?></span>
					</p>

					<p>
						<label>Kuvaus</label>
						<textarea rows="10" name="kuvaus"><?php print(htmlentities ($ilmoitus->getKuvaus(), ENT_QUOTES, "UTF-8")) ?></textarea>
                        <span class="virhe"><?php print($ilmoitus->getError($kuvausVirhe))?></span>
					</p>

					<p>
						<label>Hinta <span style="color: #B94A48">*</span></label> <input
							size="16" type="text" name="hinta" value="<?php print(htmlentities ($ilmoitus->getHinta(), ENT_QUOTES, "UTF-8")) ?>"> &euro;
                        <span class="virhe"><?php print($ilmoitus->getError($hintaVirhe))?></span>
					</p>

					<p style="margin-left: 8em">
						<input class="blue" type="submit" name="submit" value="Lähetä"> 
                        <input class="red" type="submit" name="peruuta" value="Peruuta">
					</p>
				</fieldset>
			</form>
		</article>
	</div>
</body>
</html>
