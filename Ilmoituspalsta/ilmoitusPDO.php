<?php
require_once "ilmoitus.php";

class ilmoitusPDO {
	private $db;
	private $lkm;
	
	function __construct($dsn = "mysql:host=localhost;dbname=a1501104", $user = "root", $password = "salainen") {
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
	
	public function kaikkiIlmoitukset() {
		$sql = "SELECT id, tyyppi, otsikko, kuvaus, hinta, nimi, email, puhnro, paikkakunta
		        FROM ilmoitus";
		
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
			$ilmoitus = new Ilmoitus ();
			
			$ilmoitus->setId ( $row->id );
			$ilmoitus->setTyyppi ( $row->tyyppi  );
			$ilmoitus->setOtsikko ( utf8_encode ( $row->otsikko ) );
			$ilmoitus->setKuvaus ( utf8_encode ( $row->kuvaus ) );
			$ilmoitus->setHinta ( $row->hinta );
			$ilmoitus->setNimi ( utf8_encode ( $row->nimi ) );
			$ilmoitus->setEmail ( utf8_encode ( $row->email ) );
			$ilmoitus->setPuhnro ( utf8_encode ( $row->puhnro ) );
			$ilmoitus->setPaikkakunta ( utf8_encode ( $row->paikkakunta ) );
			
			// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
			$tulos [] = $ilmoitus;
		} 
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
	public function haeIlmoitus($tyyppi) {
		$sql = "SELECT id, tyyppi, otsikko, kuvaus, hinta, nimi, email, puhnro, paikkakunta
		        FROM ilmoitus
				WHERE tyyppi = :tyyppi";
		
		// Valmistellaan lause, prepare on PDO-luokan metodeja
		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Sidotaan parametrit
		$stmt->bindValue ( ":tyyppi", $tyyppi, PDO::PARAM_INT );
		
		// Ajetaan lauseke
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
			// Tehdään tietokannasta haetusta rivistä leffa-luokan olio
			$ilmoitus = new Ilmoitus ();
			
			$ilmoitus->setId ( $row->id );
			$ilmoitus->setTyyppi (  $row->tyyppi  );
			$ilmoitus->setOtsikko ( utf8_encode ( $row->otsikko ) );
			$ilmoitus->setKuvaus ( utf8_encode ( $row->kuvaus ) );
			$ilmoitus->setHinta ( $row->hinta );
			$ilmoitus->setNimi ( utf8_encode ( $row->nimi ) );
			$ilmoitus->setEmail ( utf8_encode ( $row->email ) );
			$ilmoitus->setPuhnro ( utf8_encode ( $row->puhnro ) );
			$ilmoitus->setPaikkakunta ( utf8_encode ( $row->paikkakunta ) );
			
			// Laitetaan olio tulos taulukkoon (olio-taulukkoon)
			$tulos [] = $ilmoitus;
		}
		
		$this->lkm = $stmt->rowCount ();
		
		return $tulos;
	}
	
	function lisaaIlmoitus($ilmoitus) {
		$sql = "insert into ilmoitus (otsikko, tyyppi, kuvaus, hinta, email, puhnro, paikkakunta, nimi)
		        values (:otsikko, :tyyppi, :kuvaus, :hinta, :email, :puhnro, :paikkakunta, :nimi)";
		
		// Valmistellaan SQL-lause
		if (! $stmt = $this->db->prepare ( $sql )) {
			$virhe = $this->db->errorInfo ();
			throw new PDOException ( $virhe [2], $virhe [1] );
		}
		
		// Parametrien sidonta
		$stmt->bindValue ( ":otsikko", utf8_decode ( $ilmoitus->getOtsikko () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":tyyppi", $ilmoitus->getTyyppi (), PDO::PARAM_INT);
		$stmt->bindValue ( ":kuvaus", utf8_decode ( $ilmoitus->getKuvaus () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":hinta", $ilmoitus->getHinta (), PDO::PARAM_STR );
		$stmt->bindValue ( ":email", utf8_decode ( $ilmoitus->getEmail () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":puhnro", utf8_decode ( $ilmoitus->getPuhnro () ), PDO::PARAM_STR );
		$stmt->bindValue ( ":paikkakunta", utf8_decode ( $ilmoitus->getPaikkakunta () ), PDO::PARAM_STR );
        $stmt->bindValue ( ":nimi", utf8_decode ( $ilmoitus->getNimi () ), PDO::PARAM_STR );
		
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
}
?>