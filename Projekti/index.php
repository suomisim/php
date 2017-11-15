<?php
    if (isset($_COOKIE["kayttaja"])) { //jos keksi löytyy
        $kayttaja = $_COOKIE["kayttaja"];
    } else {
        $kayttaja = "";
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Kotisivu</title>
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
                <li><a href="settings.php">Asetukset</a></li>
            </ul>
        </div>
    </nav>  
    <div class="jumbotron" style="padding-left:10px;"><h3>Tervetuloa <?php print("$kayttaja") ?></h3></div>
    <div class="container">
        <img src="https://img-9gag-fun.9cache.com/photo/a05Yxqz_700b.jpg" />
    </div>




</body>
</html>