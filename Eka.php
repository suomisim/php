<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Simon Perusteita</title>
</head>
<body>
<div class="container-fluid">
  <div class="page-header">
    <h1>Hello World!</h1>      
  </div> 
</div> 
<div class="container-fluid">
    <div class="well">
        <?php
            $aika = time();
            $paiva = date("j.n.Y", $aika);
            $kello = date("G:i", $aika);
            print("<p>Tänään on $paiva</p>");
            print("<br />");
            print("<p style='color:red;'>Kello on $kello </p>");
        ?>
    </div>
    <div class="well">
        <button type="button" class="btn btn-success">
        <?php
            $etunimi = "Simo";
            $sukunimi = "Suominen";
            
            $etunimi = trim($etunimi); //Siistitään tyhjät merkit alusta ja lopusta
            $etunimi = mb_convert_case($etunimi, MB_CASE_TITLE, "UTF-8"); //Ensimmäinen isolla, loput pienellä vrt. MB_CASE_UPPER tai MB_CASE_LOWER
            print("$etunimi $sukunimi");
        ?>
        </button>
    </div>
    <div class="well">
        <?php
            $pvm = "AAA23.10.2017";
            
            if (preg_match("/^\d{2}\.\d{2}\.\d{4}$/", $pvm)) { 
                list($pp, $kk, $vvvv) = explode(".", $pvm); //. kohdalta pilkkoo $pvm taulukoksi
            
                if (checkdate($kk, $pp, $vvvv)) {
                    print("Päivämäärä OK");
                } else {
                    print("Päivämäärä EI OK");
                }
            } else {
                print("Päivämäärä on väärää muotoa");
            }
        ?>
    </div>
        <div class="well">
        <?php
            $syntymaaika = "01-01-1900";
            $pp = mb_substr($syntymaaika, 0, 2);
            $kk = mb_substr($syntymaaika, 3, 2);
            $vv = mb_substr($syntymaaika, 6, 4);
            print("$pp $kk $vv");
        ?>
    </div>
</div>
</body>
</html>
