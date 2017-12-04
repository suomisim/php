<?php
require_once "ilmoitus.php";

session_start();

if (isset ( $_POST ["laheta"] )) {
   $ilmoitus = new Ilmoitus($_POST["nimi"], $_POST["email"], $_POST["puhnro"], $_POST["paikkakunta"], $_POST["tyyppi"], $_POST["otsikko"], $_POST["kuvaus"], $_POST["hinta"] );
    
    print_r($ilmoitus);
    
    $nimiVirhe = $ilmoitus->checkNimi();
    $hintaVirhe = $ilmoitus->checkHinta(true, 0.0, 1000.0);
    $puhelinVirhe = $ilmoitus->checkPuhnro();
    $kuvausVirhe = $ilmoitus->checkKuvaus(false, 10, 50);
    
    if ($nimiVirhe == 0 && $hintaVirhe == 0 && $puhelinVirhe == 0 && $kuvausVirhe == 0) {
        try {
            require_once "ilmoitusPDO.php";
            
            $kantakasittely = new ilmoitusPDO();
            $id = $kantakasittely->lisaaIlmoitus($ilmoitus);
            $ilmoitus->setId($id);
            
            $_SESSION["ilmoitus"] = $ilmoitus;
            session_write_close();
            
        } catch (Exception $error) {
            print("Virhe: " . $error->getMessage());
		  //header ( "location: virhe.php?virhe=" . $error->getMessage () );
		    exit ();        
        }
        
       header("location: naytaIlmoitus.php");
       exit();
    }
} 
elseif (isset ( $_POST ["etusivulle"] )) {
	header ( "location: index.php" );
	exit ();
} 
else {
    if (isset($_SESSION["ilmoitus"])) {
        $ilmoitus = $_SESSION["ilmoitus"];
        
        $nimiVirhe = $ilmoitus->checkNimi();
        $hintaVirhe = $ilmoitus->checkHinta(true, 0.0, 1000.0);
        $puhelinVirhe = $ilmoitus->checkPuhnro();
        $kuvausVirhe = $ilmoitus->checkKuvaus(false, 10, 50);       
    } else {
        $ilmoitus = new Ilmoitus();
        
        $nimiVirhe = 0;
        $hintaVirhe = 0;
        $puhelinVirhe = 0;
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
    .virhe {
        color: red;
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
				<li><a href="kaikkiIlmoitukset.php">Kaikki ilmoitukset</a></li>
				<li><a href="haeIlmoitus.php">Hae ilmoitusta</a></li>
			</ul>
		</nav>

		<article>
			<form action="uusiIlmoitus.php" method="post">
				<fieldset>

					<legend>Ilmoittaja</legend>
					<p>
						<label>Nimi <span style="color: #B94A48">*</span></label> <input
							type="text" name="nimi" 
                 value="<?php print(htmlentities ($ilmoitus->getNimi(), ENT_QUOTES, "UTF-8")) ?>">
					    <span class='virhe'><?php print($ilmoitus->getError($nimiVirhe))?></span>
                    </p>

					<p>
						<label>Sähköposti <span style="color: #B94A48">*</span></label> <input
							type="text" name="email" value="<?php print(htmlentities ($ilmoitus->getEmail(), ENT_QUOTES, "UTF-8")) ?>">
					</p>

					<p>
						<label>Puhelinnumero</label> <input type="text" name="puhnro"
							value="<?php print(htmlentities ($ilmoitus->getPuhnro(), ENT_QUOTES, "UTF-8")) ?>">
					    <span class='virhe'><?php print($ilmoitus->getError($puhelinVirhe))?></span>
  
					</p>

					<p>
						<label>Paikkakunta <span style="color: #B94A48">*</span></label> <input
							type="text" name="paikkakunta" value="<?php print(htmlentities ($ilmoitus->getPaikkakunta(), ENT_QUOTES, "UTF-8")) ?>">
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
					</p>

					<p>
						<label>Kuvaus</label>
						<textarea rows="10" name="kuvaus"><?php print(htmlentities ($ilmoitus->getKuvaus(), ENT_QUOTES, "UTF-8")) ?></textarea>
                        <span class='virhe' style='vertical-align:top'><?php print($ilmoitus->getError($kuvausVirhe))?></span>

					</p>

					<p>
						<label>Hinta <span style="color: #B94A48">*</span></label> <input
							size="16" type="text" name="hinta" value="<?php print(htmlentities ($ilmoitus->getHinta(), ENT_QUOTES, "UTF-8")) ?>"> &euro;
					    <span class='virhe'><?php print($ilmoitus->getError($hintaVirhe))?></span>
    
                    </p>

					<p style="margin-left: 8em">
						<input class="blue" type="submit" name="laheta" value="Lähetä"> <input
							class="red" type="submit" name="etusivulle" value="Etusivulle">
					</p>
				</fieldset>
			</form>
		</article>
	</div>
</body>
</html>
