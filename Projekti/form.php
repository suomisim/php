<?php
require_once "checkform.php";  //luokka joka käsittelee lomakkeen

session_start();

if (isset ( $_POST ["laheta"] )) { //jos nimi on "laheta"
	$tiedot = new Tiedot($_POST["etunimi"], $_POST["sukunimi"], $_POST["lahiosoite"], $_POST["postitiedot"], $_POST["syntymaaika"], $_POST["email"], $_POST["kotisivu"], $_POST["kommentti"]);
    
    $_SESSION["tiedot"] = $tiedot;
    session_write_close();
    
    $etunimiVirhe = $tiedot->checkEtunimi();
    $sukunimiVirhe = $tiedot->checkSukunimi();
    $lahiosoiteVirhe = $tiedot->checkLahiosoite();
    $postitiedotVirhe = $tiedot->checkPostitiedot();
    $syntymaaikaVirhe = $tiedot->checkSyntymaaika();
    $emailVirhe = $tiedot->checkEmail();
    $kotisivuVirhe = $tiedot->checkKotisivu();
    $kommenttiVirhe = $tiedot->checkKommentti();
    
    if ($etunimiVirhe == 0 && $sukunimiVirhe == 0 && $lahiosoiteVirhe == 0 && $postitiedotVirhe == 0 && $syntymaaikaVirhe == 0  && $emailVirhe == 0 && $kotisivuVirhe == 0 && $kommenttiVirhe == 0) {
        header("location: showform.php");
        exit();
    }
 
} 
//tästä alas toimii
elseif (isset ( $_POST ["peruuta"] )) { //jos nimi on "peruuta"
    unset($_SESSION["tiedot"]);
    header ( "location: index.php" );
    exit ();
} 
else {	//jos sivulle tultiin muuta kautta
    if (isset($_SESSION["tiedot"])) {
        $tiedot = $_SESSION["tiedot"];
        $etunimiVirhe = $tiedot->checkEtunimi();
        $sukunimiVirhe = $tiedot->checkSukunimi();
        $lahiosoiteVirhe = $tiedot->checkLahiosoite();
        $postitiedotVirhe = $tiedot->checkPostitiedot();
        $syntymaaikaVirhe = $tiedot->checkSyntymaaika();
        $emailVirhe = $tiedot->checkEmail();
        $kotisivuVirhe = $tiedot->checkKotisivu();
        $kommenttiVirhe = $tiedot->checkKommentti();
    } else {
        $tiedot = new Tiedot();
        $etunimiVirhe = 0;
        $sukunimiVirhe = 0;
        $lahiosoiteVirhe = 0;
        $postitiedotVirhe = 0;
        $syntymaaikaVirhe = 0;
        $emailVirhe = 0;
        $kotisivuVirhe = 0;
        $kommenttiVirhe = 0;
    }        
} 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Lisää henkilö</title>
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
                <li><a href="search.php">Hae henkilöä (Json)</a></li>
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav> 

    <form class="form-horizontal" action="form.php" method="post">
        <fieldset>
            <p><br /></p>
            <div class="form-group">
                <label class="col-md-4 control-label">Etunimi</label>
                <div class="col-md-4">
                    <input name="etunimi" placeholder="Anna etunimesi:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getEtunimi(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($etunimiVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Sukunimi</label>
                <div class="col-md-4">
                    <input name="sukunimi" placeholder="Anna sukunimesi:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getSukunimi(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($sukunimiVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Lähiosoite</label>
                <div class="col-md-4">
                    <input name="lahiosoite" placeholder="Anna lähiosoitteesi:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getLahiosoite(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($lahiosoiteVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Postitiedot</label>
                <div class="col-md-4">
                    <input name="postitiedot" placeholder="Anna postinumerosi ja postitoimipaikkasi:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getPostitiedot(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($postitiedotVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Syntymäaika</label>
                <div class="col-md-4">
                    <input name="syntymaaika" placeholder="Anna syntymäaikasi" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getSyntymaaika(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($syntymaaikaVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Sähköposti</label>
                <div class="col-md-4">
                    <input name="email" placeholder="Anna sähköpostiosoitteesi:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getEmail(), ENT_QUOTES, "UTF-8")) ?>">
                    <div style="color:red;"><?php print($tiedot->getError($emailVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Kotisivusi</label>
                <div class="col-md-4">
                    <input name="kotisivu" placeholder="Anna kotisivusi osoite:" class="form-control input-md" type="text" value="<?php print(htmlentities ($tiedot->getKotisivu(), ENT_QUOTES, "UTF-8")) ?>">
                    <span class="help-block">Esim. www.example.com</span>
                    <div style="color:red;"><?php print($tiedot->getError($kotisivuVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Kommentti</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="kommentti"><?php print(htmlentities ($tiedot->getKommentti(), ENT_QUOTES, "UTF-8")) ?></textarea>
                    <div style="color:red;"><?php print($tiedot->getError($kommenttiVirhe))?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" name="laheta" class="btn btn-primary">Lähetä tiedot</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" name="peruuta" class="btn btn-danger">Palaa etusivulle</button>
                </div>
            </div>
        </fieldset>
    </form>





</body>
</html>