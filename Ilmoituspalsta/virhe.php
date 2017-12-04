<?php
session_start ();

// Poistetaan istunnosta ilmoitus
unset ( $_SESSION ["ilmoitus"] );

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Myyntipaikka netissä - osta, myy &amp; vaihda!</title>
<meta name="author" content="Sirpa Marttila">
<link href="ilmoitus.css" rel="stylesheet">
<style type="text/css">
label {
	display: block;
	float: left;
	width: 8em;
}
</style>
</head>
<body>
	<div class="tausta">
		<header> Myyntipaikka netissä </header>
		<nav>
			<ul>

				<li><a href="index.php">Etusivu</a></li>
				<li><a href="uusiIlmoitus.php">Ilmoita</a></li>
				<li><a href="kaikkiIlmoitukset.php">Kaikki ilmoitukset</a></li>
				<li><a href="haeIlmoitus.php">Hae ilmoitusta</a></li>
			</ul>
		</nav>

		<article> 
<?php
if (isset ( $_GET ["virhe"] )) {
	$virhe = $_GET ["virhe"];
} else {
	$virhe = "Tuntematon virhe";
}

print ("<p style='margin-top:1cm'>$virhe <br><br>Siirrytään etusivulle 5 sekunnin kuluttua...</p>") ;

?>

</article>
	</div>
</body>
</html>
<?php
header ( "refresh:5; url=index.php?virhe=kylla" );
exit ();
?>
