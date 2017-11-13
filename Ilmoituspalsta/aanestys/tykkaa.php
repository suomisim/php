<?php
$xml = simplexml_load_file ( "kysymykset.xml" ); //xml tiedoston haku
$teksti = "";

if (isset($_COOKIE["lkm"])) { //jos keksi löytyy
    $lkm = $_COOKIE["lkm"];
} else {
    $lkm = 0;
}

if (isset ( $_POST ["tykkaan"] )) { //jos tykkaan nappia on painettu
	
    $id = $_POST["id"]; //haetaan piilokentän id arvo
	
    $haettu = $xml->xpath ( "/kysymykset/kysymys[@id = $id]" ); //hakee xml-tiedostosta haetun id:n mukaan
	$haettu [0]->tykkaaminen = $haettu [0]->tykkaaminen + 1; //muuttaa ks. id:n tykkäämisarvoa +1, [0] koska edellisen rivin haku palauttaa taulukon
    
    $lkm = $lkm + 1;
    setcookie("lkm", $lkm, time() + 60); //luodaan keksi ja määritellään sen sisältö ja kestoaika 60sec
    
    $teksti = $haettu[0]->kysymys . " Tykätty " . $haettu[0]->tykkaaminen . " kertaa."; //määrittää tekstille viimeksi tykätyn kysymyksen ja sen tykkäykset
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
        $id = $kysy["id"]; //kysytään attribuutin arvoa
        print("<form action='tykkaa.php' method='post'>\n");
        print("<p>" . $kysy->kysymys . " " . $kysy->tykkaaminen . "</p>\n"); //kysymykset elementin alta kysymys ja tykkaaminen (pisteet on plussia) ei saa laittaa lainausmerkkien sisään sellaisenaan
        print("<input type='submit' name='tykkaan' value='Tykkää'>\n");
        print("<input type='hidden' name='id' value='$id'>\n"); //piilotettu kenttä, jotta joka submitilla on oma id
        print("</form>\n");
	}
	
    
	$xml->asXML ( "kysymykset.xml" );
    print ("<p>Tykkäämisiä on ollut $lkm kappaletta</p>\n");
    print("<a href='index.php?tieto=$teksti'>Etusivulle</a>\n"); //vie $teksti -muuttujan etusivulle

?>
</body>
</html>
