<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Lisää henkilö</title>
<?php
require_once "checkform.php";  //luokka joka käsittelee lomakkeen

if (isset ( $_POST ["laheta"] )) { //jos nimi on "laheta"
	
} 
elseif (isset ( $_POST ["peruuta"] )) { //jos nimi on "peruuta"
header ( "location: index.php" );
exit ();
} 
else {	//jos sivulle tultiin muuta kautta
} 
?>
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
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav> 

    <form class="form-horizontal" action="form.php" method="post">
        <fieldset>
            <p><br /></p>
            <div class="form-group">
                <label class="col-md-4 control-label" for="etunimi">Etunimi</label>
                <div class="col-md-4">
                    <input name="etunimi" placeholder="Anna etunimesi:" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="sukunimi">Sukunimi</label>
                <div class="col-md-4">
                    <input name="sukunimi" placeholder="Anna sukunimesi:" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="lahiosoite">Lähiosoite</label>
                <div class="col-md-4">
                    <input name="lahiosoite" placeholder="Anna lähiosoitteesi:" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="postinumero">Postinumero</label>
                <div class="col-md-4">
                    <input name="postinumero" placeholder="Anna postinumerosi:" class="form-control input-md" type="number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="postitoimipaikka">Postitoimipaikka</label>
                <div class="col-md-4">
                    <input name="postinumero" placeholder="Anna postitoimipaikkasi:" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="syntymaaika">Syntymäaika</label>
                <div class="col-md-4">
                    <input name="syntymaaika" placeholder="Anna syntymäaikasi" class="form-control input-md" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="email">Sähköposti</label>
                <div class="col-md-4">
                    <input name="email" placeholder="Anna sähköpostiosoitteesi:" class="form-control input-md" type="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="kotisivu">Kotisivusi</label>
                <div class="col-md-4">
                    <input name="kotisivu" placeholder="Anna kotisivusi osoite:" class="form-control input-md" type="url">
                    <span class="help-block">Esim. www.example.com</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="kommentti">Kommentti</label>
                <div class="col-md-4">
                    <textarea class="form-control" name="kommentti" type="text"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="laheta"></label>
                <div class="col-md-4">
                    <button type="submit" name="laheta" class="btn btn-primary">Lähetä tiedot</button>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="peruuta"></label>
                <div class="col-md-4">
                    <button type="submit" name="peruuta" class="btn btn-danger">Palaa etusivulle</button>
                </div>
            </div>
        </fieldset>
    </form>





</body>
</html>