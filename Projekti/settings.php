<?php
    session_start();
    
    if (isset ( $_POST ["savekayttaja"] )) {
        $kayttaja = $_POST["kayttaja"];
        setcookie("kayttaja", $kayttaja, time() + 60*60*24*7); //luodaan keksi ja määritellään sen sisältö ja kestoaika viikko
        header("location: index.php");
        exit();
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Asetukset</title>
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
                <li class="active"><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>  

    <form class="form-horizontal" method="post">
        <fieldset>
            <p><br /></p>
            <div class="form-group">
                <label class="col-md-4 control-label">Käyttäjänimi</label>
                <div class="col-md-4">
                    <input name="kayttaja" placeholder="Anna käyttäjänimi:" class="form-control input-md" type="text" value="">
                    <br />
                    <button type="submit" name="savekayttaja" class="btn btn-primary">Tallenna</button>
                </div>
            </div>
        </fieldset>
    </form>



</body>
</html>