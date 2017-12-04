<?php
$sukunimi = "Suominen";
try {
	require_once "formPDO.php";
	$formPDO = new formPDO ();
		
	$tulos = $formPDO->haeTietty($sukunimi); //kutsuu metodia
    print (json_encode ( $tulos ));
	
	
    } catch ( Exception $error ) {
        $tulos["message"] = "Haku ei onnistu";
        http_response-code(400);
        print(json_encode($tulos));
    }
?>