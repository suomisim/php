<?php
    require_once "checkform.php"; 
    session_start();

    if (isset($_SESSION["henkilo"])) {
        $tiedot = $_SESSION["henkilo"];
    } else {
        header("location: index.php");
        exit();
    }
    if (isset ( $_POST ["takaisin"] )) {
        unset($_SESSION["henkilo"]);
        header("location: list.php");
        exit();   
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Henkilön tiedot</title>
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
                <li><a href="search.php">Hae henkilöä  (Json)</a></li>
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>
    <form class="form-horizontal" method="post">
    <div class="well">
        <h3>Henkilötiedot</h3>
        <p>
        <b>Etunimi: </b><?php print($tiedot->getEtunimi())?><br />
        <b>Sukunimi: </b><?php print($tiedot->getSukunimi())?><br />
        <b>Lähiosoite: </b><?php print($tiedot->getLahiosoite())?><br />
        <b>Postinumero ja toimipaikka: </b><?php print($tiedot->getPostitiedot())?><br />
        <b>Syntymäaika: </b><?php print($tiedot->getSyntymaaika())?><br />
        <b>Email: </b><?php print($tiedot->getEmail())?><br />
        <b>Kotisivu: </b><?php print($tiedot->getKotisivu())?><br />
        <b>Kommentti: </b><?php print($tiedot->getKommentti())?><br /><br />
        <button type="submit" name="takaisin" class="btn btn-danger">Takaisin</button>
        </p>
    </div>
    </form>


</body>
</html>


