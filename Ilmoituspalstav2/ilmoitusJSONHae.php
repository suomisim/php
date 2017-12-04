<?php
try {
	require_once "ilmoitusPDO.php";
	$ilmoitusPDO = new ilmoitusPDO ();
		
	$tulos = $ilmoitusPDO->kaikkiIlmoitukset(); //kutsuu metodia
    print (json_encode ( $tulos )) ;
	
	
    } catch ( Exception $error ) {
        $tulos["message"] = "Haku ei onnistu";
        http_response-code(400);
        print(json_encode($tulos));
    }
?>