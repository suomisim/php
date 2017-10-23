# PHP
## 23.10.2017

Regexp

\d{1,5}\(.\d{2)? = hinta

\d{2}\.\d{2}\.\d{4} = pvm

[Aa]\d{7} = opiskelijanro

\d{6}[+\-A]\d{3}[0-9A-Z] = hetu

[a-zåäöA-ZÅÄÖ ]{4,50} = nimi

[a-zåäö\-]{2,50} = paikkakunta

post > get

	<?php
	require_once "ilmoitus.php";  //luokka joka käsittelee lomakkeen

	if (isset ( $_POST ["laheta"] )) { //jos nimi on "laheta"
		
	} 
	elseif (isset ( $_POST ["etusivulle"] )) { //jos nimi on "etusivulle"
	header ( "location: index.php" );
	exit ();
	} 
	else {	//jos sivulle tultiin muuta kautta
	} 
	?>

## 30.10.2017