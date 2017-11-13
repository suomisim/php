<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tilanhallintaa</title>
</head>
<body>
	<h3>Tilanhallintaa (keksi, kyselymerkijono, piilokenttä)</h3>
	<?php
        if (isset($_GET["tieto"])) { //jos tieto on asetettu GET:llä
            print("<p>" . $_GET["tieto"] . "</p>");
        }
	?> 
	<p>
		<a href="tykkaa.php">Tykkää</a>
	</p>
</body>
</html>
