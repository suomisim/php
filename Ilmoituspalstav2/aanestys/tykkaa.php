<?php
$xml = simplexml_load_file ( "kysymykset.xml" );
$teksti = "";
   
if (isset($_COOKIE["lkm"])) {
    $lkm = $_COOKIE["lkm"];
} else {
    $lkm = 0;
}

if (isset ( $_POST ["tykkaan"] )) {
	$id = $_POST["id"];
    
	$haettu = $xml->xpath ( "/kysymykset/kysymys[@id = $id]" );
	$haettu [0]->tykkaaminen = $haettu [0]->tykkaaminen + 1;	
      
    $lkm = $lkm + 1;
    setcookie("lkm", $lkm, time() + 60);
    
    $teksti = $haettu[0]->kysymys . " tykätty " . $haettu[0]->tykkaaminen . " kertaa";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Piilokenttä</title>
<style type="text/css">
label {
	display: block;
	float: left;
	width: 16em;
}
</style>
</head>
<body>
	<h3>Tykkääminen (piilokenttä)</h3>
<?php
// Tehtävässä käytettään XML-dokumenttia.
// Asia ei kuulu kurssin sisältöön, mutta auttaa tekemään järkevän esimerkin.

// Haetaan jokainen kysymys ja sen id XML-dokumentista
	foreach ( $xml->xpath ( "/kysymykset/kysymys" ) as $kysy ) {
        $id = $kysy["id"];
        print("<form action='tykkaa.php' method='post'>\n");
        print("<p>" . $kysy->kysymys . " " . $kysy->tykkaaminen . "</p>\n");
        print("<input type='submit' name='tykkaan' value='Tykkää'>\n");
        print("<input type='hidden' name='id' value='$id'>\n");
        print("</form>\n");
	}
	
	$xml->asXML ( "kysymykset.xml" );

    print("<p>Tykkäämisiä on ollut $lkm</p>\n");
    
    print("<a href='index.php?tieto=$teksti'>Etusivulle</a>\n");
?>
</body>
</html>
