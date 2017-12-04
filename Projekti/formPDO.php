<?php
require_once "checkform.php";

class formPDO {
	private $db;
	private $lkm;
	
	function __construct($dsn = "mysql:host=localhost;dbname=henkilot", $user = "root", $password = "salainen") {
		// Ota yhteys kantaan
		$this->db = new PDO ( $dsn, $user, $password );
		
		// Virheiden jäljitys kehitysaikana
		$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		
		// MySQL injection estoon (paramerit sidotaan PHP:ssä ennen SQL-palvelimelle lähettämistä)
		$this->db->setAttribute ( PDO::ATTR_EMULATE_PREPARES, false );
		
		// Tulosrivien määrä
		$this->lkm = 0;
	}
	
	// Metodi palauttaa tulosrivien määrän
	function getLkm() {
		return $this->lkm;
	}
	
	public function haeTiedot() {
		$sql = "SELECT id, etunimi, sukunimi, lahiosoite, postitiedot, syntymaaika, email, kotisivu, kommentti FROM henkilot";
		
		// Valmistellaan lause
		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Ajetaan lauseke
		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Käsittellään hakulausekkeen tulos
		$tulos = array ();
		
		// Pyydetään haun tuloksista kukin rivi kerrallaan
		while ( $row = $stmt->fetchObject () ) {
			// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
			$tiedot = new Tiedot ();
			
			$tiedot->setId ( $row->id );
			$tiedot->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$tiedot->setSukunimi ( utf8_encode ( $row->sukunimi ) );
            $tiedot->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
            $tiedot->setPostitiedot ( utf8_encode ( $row->postitiedot ) );
            $tiedot->setSyntymaaika ( utf8_encode ( $row->syntymaaika ) );
			$tiedot->setEmail ( utf8_encode ( $row->email ) );
			$tiedot->setKotisivu ( utf8_encode ( $row->kotisivu ) );
			$tiedot->setKommentti ( utf8_encode ( $row->kommentti ) );
			
			// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
			$tulos [] = $tiedot;
		} 
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
	function lisaaTiedot($tiedot) {
		$sql = "INSERT INTO henkilot(etunimi, sukunimi, lahiosoite, postitiedot, syntymaaika, email, kotisivu, kommentti) VALUES (:etunimi, :sukunimi, :lahiosoite, :postitiedot, :syntymaaika, :email, :kotisivu, :kommentti)";
		
		// Valmistellaan SQL-lause
		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Parametrien sidonta
		$stmt->bindValue ( ":etunimi", utf8_decode ( $tiedot->getEtunimi () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":sukunimi", utf8_decode ( $tiedot->getSukunimi () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":lahiosoite", utf8_decode ( $tiedot->getLahiosoite () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":postitiedot", utf8_decode ( $tiedot->getPostitiedot () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":syntymaaika", $tiedot->getSyntymaaika (), PDO::PARAM_STR );
        $stmt->bindValue ( ":email", $tiedot->getEmail (), PDO::PARAM_STR );
        $stmt->bindValue ( ":kotisivu", $tiedot->getKotisivu (), PDO::PARAM_STR );
        $stmt->bindValue ( ":kommentti", utf8_decode ( $tiedot->getKommentti () ), PDO::PARAM_STR );
        

		// Jotta id:n saa lisäyksestä, täytyy laittaa tapahtumankäsittely päälle
		$this->db->beginTransaction();
		
		// Suoritetaan SQL-lause (insert)
		if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();
			
			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}
			 
			// Perutaan tapahtuma
			$this->db->rollBack();
			$this->lkm = 0;
            
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		$this->lkm = 1;
		
		// id täytyy ottaa talteen ennen tapahtuman päättymistä
		$id = $this->db->lastInsertId ();
		
		$this->db->commit();
		
		// Palautetaan lisätyn ilmoituksen id
		return $id;
	}
    public function haeTietty($sukunimi) {
        $sql = "SELECT id, etunimi, sukunimi, lahiosoite, postitiedot, syntymaaika, email, kotisivu, kommentti FROM henkilot WHERE sukunimi = :sukunimi";
        if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
        $stmt->bindValue ( ":sukunimi", $sukunimi, PDO::PARAM_INT );
        
        if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();
			
			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Käsittellään hakulausekkeen tulos
		$tulos = array ();
		
		while ( $row = $stmt->fetchObject () ) {
			// Tehdään tietokannasta haetusta rivistä tiedot-luokan olio
            $tiedot = new Tiedot();
            $tiedot->setId ( $row->id );
			$tiedot->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$tiedot->setSukunimi ( utf8_encode ( $row->sukunimi ) );
            $tiedot->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
            $tiedot->setPostitiedot ( utf8_encode ( $row->postitiedot ) );
            $tiedot->setSyntymaaika ( utf8_encode ( $row->syntymaaika ) );
			$tiedot->setEmail ( utf8_encode ( $row->email ) );
			$tiedot->setKotisivu ( utf8_encode ( $row->kotisivu ) );
			$tiedot->setKommentti ( utf8_encode ( $row->kommentti ) );
            
            $tulos[] = $tiedot;        
        }
    $this->lkm = $stmt->rowCount ();
    return $tulos;
    }
    public function haeId($id) {
        $sql = "SELECT id, etunimi, sukunimi, lahiosoite, postitiedot, syntymaaika, email, kotisivu, kommentti FROM henkilot WHERE id = :id";
        if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
        $stmt->bindValue ( ":id", $id, PDO::PARAM_INT );
        
        if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();
			
			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Käsittellään hakulausekkeen tulos
		$tulos = array ();
		
		while ( $row = $stmt->fetchObject () ) {
			// Tehdään tietokannasta haetusta rivistä tiedot-luokan olio
            $tiedot = new Tiedot();
            $tiedot->setId ( $row->id );
			$tiedot->setEtunimi ( utf8_encode ( $row->etunimi ) );
			$tiedot->setSukunimi ( utf8_encode ( $row->sukunimi ) );
            $tiedot->setLahiosoite ( utf8_encode ( $row->lahiosoite ) );
            $tiedot->setPostitiedot ( utf8_encode ( $row->postitiedot ) );
            $tiedot->setSyntymaaika ( utf8_encode ( $row->syntymaaika ) );
			$tiedot->setEmail ( utf8_encode ( $row->email ) );
			$tiedot->setKotisivu ( utf8_encode ( $row->kotisivu ) );
			$tiedot->setKommentti ( utf8_encode ( $row->kommentti ) );
            
            $tulos[] = $tiedot;        
        }
    $this->lkm = $stmt->rowCount ();
    return $tulos;
    }
    public function poistaTiedot($id) {
        $sql = "DELETE FROM henkilot WHERE id = :id";
        if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
        $stmt->bindValue ( ":id", $id, PDO::PARAM_INT );
        
        if (! $stmt->execute ()) {
			$virhe = $stmt->errorInfo ();
			
			if ($virhe [0] == "HY093") {
				$virhe [2] = "Invalid parameter";
			}
			
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
    }
}
?>