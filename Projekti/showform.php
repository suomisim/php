<?php
    require_once "checkform.php";

    session_start();

    if (isset($_SESSION["tiedot"])) {
        $tiedot = $_SESSION["tiedot"];
//      unset($_SESSION["tiedot"]);
    } else {
        header("location: index.php");
        exit();
    }

    if (isset ( $_POST ["peruuta"] )) {
        unset($_SESSION["tiedot"]);
        header("location: index.php");
        exit();
    }
    if (isset ( $_POST ["korjaa"] )) {
        $_SESSION["tiedot"] = $tiedot;
        session_write_close();
        header("location: form.php");
        exit();
    }
    if (isset ( $_POST ["talleta"] )) {
        try {
            require_once "formPDO.php";
            
            $kantakasittely = new formPDO();
            $id = $kantakasittely->lisaaTiedot($tiedot);
            $tiedot->setId($id);
            unset($_SESSION["tiedot"]);       
            
        } catch (Exception $error) {
            print("Virhe " . $error->getMessage());
            exit();
        }
        
        header("location: showform-success.php");
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
                <li class="active"><a href="form.php">Lisää henkilö</a></li>
                <li><a href="list.php">Näytä henkilöt</a></li>
                <li><a href="search.php">Hae henkilöä  (Json)</a></li>
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>

    <div class="well">
        <h3>Henkilötiedot</h3>
        <p>
        Etunimi: <?php print($tiedot->getEtunimi())?><br />
        Sukunimi: <?php print($tiedot->getSukunimi())?><br />
        Lähiosoite: <?php print($tiedot->getLahiosoite())?><br />
        Postinumero ja toimipaikka: <?php print($tiedot->getPostitiedot())?><br />
        Syntymäaika: <?php print($tiedot->getSyntymaaika())?><br />
        Email: <?php print($tiedot->getEmail())?><br />
        Kotisivu: <?php print($tiedot->getKotisivu())?><br />
        Kommentti: <?php print($tiedot->getKommentti())?>
        </p>
    </div>
    <div class="well">
        <form class="form-horizontal" method="post">
        <div class="btn-group">
            <button type="submit" name="talleta" class="btn btn-success">Talleta</button>
            <button type="submit" name="korjaa" class="btn btn-info">Korjaa</button>
            <button type="submit" name="peruuta" class="btn btn-danger">Peruuta</button>
        </div>
        </form>
    </div>

</body>
</html>