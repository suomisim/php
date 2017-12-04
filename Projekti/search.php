<?php 
require_once "checkform.php";  //luokka joka käsittelee lomakkeen

session_start();    

    if (isset ( $_POST ["hae"] )) {
        $_SESSION["sukunimi"] = $_POST["sukunimi"];
        session_write_close();
        header("location: search.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <li class="active"><a href="search.php">Hae henkilöä (Json)</a></li>
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
    <div class="well">
		<div id="lista"></div>
	</div>
    <script type="text/javascript"> //skriptit aina bodyn loppuun että muut elementit on ladattu

		$( document ).ready(function() { //testataan onko jquery kirjasto ladattu
		
			$.ajax({ //mistä koodi löytyy
                url: "search-json.php",
                method: "post", //millä metodilla haetaan
                dataType: "json" //missä muodossa
            })
			.done(function(data) { //jos onnistuu
                //alert("ok");
                for (var i = 0; i < data.length; i++) { //käydään objektitaulukko läpi
                    $("#lista").append("<p><b>Etunimi:</b> " + data[i].etunimi +
                                       "<br><b>Sukunimi:</b> " + data[i].sukunimi +
                                       "<br><b>Lähiosoite:</b> " + data[i].lahiosoite +
                                       "<br><b>Postitiedot:</b> " + data[i].postitiedot +
                                       "<br><b>Syntymäaika:</b> " + data[i].syntymaaika +
                                       "<br><b>Sähköposti:</b> " + data[i].email +
                                       "<br><b>Kotisivu:</b> " + data[i].kotisivu +
                                       "<br><b>Kommentti:</b> " + data[i].kommentti +
                                       "</p>")            //viittaa id listaan
                }
            })
			.fail(function(jqXHR, textStatus, message ) {
 		         //alert("virhe");
                $("#lista").append("<p></p>")
			})
			
		})

    </script>

</div>

</body>
</html>
