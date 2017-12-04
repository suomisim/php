<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Hae henkilöä</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Henkilösivu</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="form.php">Lisää henkilö</a></li>
                <li><a href="list.php">Näytä henkilöt</a></li>
                <li class="active"><a href="search.php">Hae henkilöä</a></li>
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>  

    <form class="form-horizontal" action="search.php" method="post">
        <fieldset>
            <p><br /></p>
            <div class="form-group">
                <label class="col-md-4 control-label">Hae henkilöä tietokannasta sukunimellä</label>
                <div class="col-md-4">
                    <input name="sukunimi" placeholder="Anna sukunimi" class="form-control input-md" type="text" value="">
                    <br />
                    <button type="submit" name="hae" class="btn btn-primary">Hae</button>
                </div>
            </div>
        </fieldset>
    </form>

<?php
// Jos on hae-niminen painike, tehdään tietojen haku kannasta annetulla kriteerillä
    if (isset ( $_POST ["hae"] ) && strlen ($_POST ["sukunimi"]) != 0) {

	   try {
           require_once "formPDO.php";
           $kantakasittely = new formPDO();
           $rivit = $kantakasittely->haeTietty($_POST ["sukunimi"]);
           if ($kantakasittely->getLkm() == 0) {
                print("<p>Hakemasi tyyppisiä ilmoituksia ei ole</p>");
            }
           print("<div class='well'>");
           foreach ($rivit as $tieto) {
                print("<p><b>Etunimi: </b>" . $tieto->getEtunimi());
                print("<br><b>Sukunimi: </b>" . $tieto->getSukunimi());
                print("<br><b>Lähiosoite: </b>" . $tieto->getLahiosoite());
                print("<br><b>Postitiedot: </b>" . $tieto->getPostitiedot());
                print("<br><b>Syntymäaika: </b>" . $tieto->getSyntymaaika());
                print("<br><b>Sähköposti: </b>" . $tieto->getEmail());
                print("<br><b>Kotisivu: </b>" . $tieto->getKotisivu());
                print("<br><b>Kommentti: </b>" . $tieto->getKommentti() . "<br></p>\n");
            }
	       print("</div>");
	} catch ( Exception $error ) { 
		print("Virhe: " . $error->getMessage());
		header ( "location: virhe.php?virhe=" . $error->getMessage () );
		//exit ();
	}
}
?>
</div>

</body>
</html>
