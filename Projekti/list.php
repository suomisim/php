<?php
    require_once "checkform.php";
    session_start();
    if (isset ( $_POST ["poista"] )) {
        try {
            require_once "formPDO.php";
            
            $kantakasittely = new formPDO();
            $kantakasittely->poistaTiedot($_POST ["id"]);
            
        } catch (Exception $error) {
            print("Virhe " . $error->getMessage());
            exit();
        }
        
        header("location: list.php");
        exit();   
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Näytä henkilöt</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Henkilösivu</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="form.php">Lisää henkilö</a></li>
                <li class="active"><a href="list.php">Näytä henkilöt</a></li>
                <li><a href="search.php">Hae henkilöä</a></li>
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>
<?php
   
// Jos on nayta-niminen painike, tehdään tietojen haku kannasta annetulla kriteerillä
    if (isset ( $_POST ["nayta"] )) {


        require_once "formPDO.php";
        $kantakasittely = new formPDO();
        $rivit = $kantakasittely->haeId($_POST ["nayta"]);
        foreach ($rivit as $tieto) {
            $etunimi = $tieto->getEtunimi();
            $sukunimi = $tieto->getSukunimi();
            $lahiosoite = $tieto->getLahiosoite();
            $postitiedot = $tieto->getPostitiedot();
            $syntymaaika = $tieto->getSyntymaaika();
            $email = $tieto->getEmail();
            $kotisivu = $tieto->getKotisivu();
            $kommentti = $tieto->getKommentti();
            $tiedot = new Tiedot($etunimi, $sukunimi, $lahiosoite, $postitiedot, $syntymaaika, $email, $kotisivu, $kommentti);
            $_SESSION["henkilo"] = $tiedot;
            session_write_close();
            header("location: list-show.php");
            exit();
        }


    }
?>

<div class="well">
<?php 
    try {
	   require_once "formPDO.php";
        $kantakasittely = new formPDO();
	
        $rivit = $kantakasittely->haeTiedot();
        foreach ($rivit as $tieto) {
            $riviid = $tieto->getId();
            print("<form action='' method='post'><input type='hidden' name='id' value='$riviid'>");
            print("<p><b>Etunimi: </b>" . $tieto->getEtunimi());
            print("<br><b>Sukunimi: </b>" . $tieto->getSukunimi() . "<br></p>\n");
            print("<div class='btn-group'><button type='submit' name='nayta' value='$riviid' class='btn btn-info'>Näytä</button><button type='submit' name='poista' class='btn btn-danger'>Poista</button></div>");
            print("<hr>");
            print("</form>");
        }
	
    } catch ( Exception $error ) {
	   print("<p>Virhe: " . $error->getMessage ());
	   //header ( "location: virhe.php?sivu=Listaus&virhe=" . $error->getMessage () );
	   //exit ();
    }

?>
</div>



</body>
</html>


