<?php
class Tiedot {
	// Virhekoodeja vastaavat virheilmoitukset
	private static $virhelista = array (
			- 1 => "Tuntematon virhe",
			0 => "",
			
        //Etunimi        
            11 => "Etunimi ei voi olla tyhjä",
			12 => "Etunimessä on kiellettyjä merkkejä",
			13 => "Etunimessä on liian vähän merkkejä",
			14 => "Etunimessä on liikaa merkkejä",
        //Sukunimi
            21 => "Sukunimi ei voi olla tyhjä",
			22 => "Sukunimessä on kiellettyjä merkkejä",
			23 => "Sukunimessä on liian vähän merkkejä",
			24 => "Sukunimessä on liikaa merkkejä",
        //Lähiosoite
			31 => "Lähiosoite ei voi olla tyhjä",
            32 => "Lähisoitteessa voi olla kirjaimia, numeroita ja väliviiva",
        //Postitiedot
			41 => "Postitiedot eivät voi olla tyhjät",
			42 => "Annathan postitiedot muodossa Postinumero Postitoimipaikka",
        //Syntymäaika
			51 => "Syntymäaika ei voi olla tyhjä",
			52 => "Annathan syntymäajan muodossa pp.kk.vvvv",
        //Email
			61 => "Sähköposti ei saa olla tyhjä",
			62 => "Sähköpostin muoto on väärä",
        //Kotisivu
            71 => "Kotisivun osoite ei saa olla tyhjä",
			72 => "Annathan kotisivun osoitteen muodossa: http://www.kotisivu.com",
        //Kommentti
            81 => "Kommentti ei saa olla tyhjä",
			82 => "Kommentissa on kiellettyjä merkkejä",
            83 => "Kommentin on oltava 8-100 merkkiä pitkä"
	);

	// Kertoo virhekoodia vastaavan virhetekstin
	public static function getError($virhekoodi) {
		if (isset ( self::$virhelista [$virhekoodi] ))
			return self::$virhelista [$virhekoodi];

		return self::$virhelista [- 1];
	}

	// Luokan attribuutit
	
    private $etunimi;
    private $sukunimi;
    private $lahiosoite;
    private $postitiedot;
    private $syntymaaika;
    private $email;
    private $kotisivu;
    private $kommentti;
	private $id;

	// Konstruktori

	// $ilmoitus = new Ilmoitus(" Sirpa ", "sirpa.marttila@haaga-helia.fi");
	function __construct($etunimi = "", $sukunimi = "", $lahiosoite = "", $postitiedot = "", $syntymaaika = "", $email = "", $kotisivu = "", $kommentti = "", $id = 0) {
        $this->etunimi = trim ( mb_convert_case ( $etunimi, MB_CASE_TITLE, "UTF-8" ) );
        $this->sukunimi = trim ( mb_convert_case ( $sukunimi, MB_CASE_TITLE, "UTF-8" ) );
        $this->lahiosoite = trim ( mb_convert_case ( $lahiosoite, MB_CASE_TITLE, "UTF-8" ) );
		$this->postitiedot = trim ( mb_convert_case ( $postitiedot, MB_CASE_UPPER, "UTF-8" ) );
        $this->syntymaaika = trim ( $syntymaaika );
        $this->email = trim ( $email );
		$this->kotisivu = trim ( $kotisivu );
		$this->kommentti = trim ( $kommentti );
		$this->id = $id;    
	}

	public function setEtunimi($nimi) {
		$this->etunimi = trim ( $etunimi );
	}

	public function getEtunimi() {
		return $this->etunimi;
	}

	public function checkEtunimi($required = true, $min = 3, $max = 20) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->etunimi ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->etunimi ) == 0) {
			return 11;
		}
		// Jos nimen muoto ei ole oikea
		if (! preg_match ( "/^[A-Z]'?[- a-zA-Z]+$/", $this->etunimi )) {
			return 12;
		}
		// Jos nimi on liian lyhyt
		if (strlen ( $this->etunimi) < $min) {
			return 13;
		}
		// Jos nimi on liian pitkä
		if (strlen ( $this->etunimi ) > $max) {
			return 14;
		}
		// Kentässä ei ole virhettä
		return 0;
	}
    public function setSukunimi($nimi) {
		$this->sukunimi = trim ( $sukunimi );
	}

	public function getSukunimi() {
		return $this->sukunimi;
	}

	public function checkSukunimi($required = true, $min = 3, $max = 30) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->sukunimi ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->sukunimi ) == 0) {
			return 21;
		}
		// Jos nimen muoto ei ole oikea
		if (! preg_match ( "/^[A-Z]'?[- a-zA-Z]+$/", $this->sukunimi )) {
			return 22;
		}
		// Jos nimi on liian lyhyt
		if (strlen ( $this->sukunimi) < $min) {
			return 23;
		}
		// Jos nimi on liian pitkä
		if (strlen ( $this->sukunimi ) > $max) {
			return 24;
		}
		// Kentässä ei ole virhettä
		return 0;
	}
    public function setLahiosoite($lahiosoite) {
		$this->lahiosoite = trim ( $lahiosoite );
	}

	public function getLahiosoite() {
		return $this->lahiosoite;
	}

	public function checkLahiosoite($required = true) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->lahiosoite ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->lahiosoite ) == 0) {
			return 31;
		}
        if (preg_match ( "/\d{1,5}\s\w.\s(\b\w*\b\s){1,2}\w*\./", $this->lahiosoite )) {
			return 32;
		}

		return 0;
	}
    public function setPostitiedot($postitiedot) {
		$this->postitiedot = trim ( $postitiedot );
	}

	public function getPostitiedot() {
		return $this->postitiedot;
	}

	public function checkPostitiedot($required = true) {
		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->postitiedot ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->postitiedot ) == 0) {
			return 41;
		}
        if (! preg_match ( "/[0-9]{5}\ [a-zåäöA-ZÅÄÖ]{2,40}/", $this->postitiedot )) {
			return 42;
		}
		// Kentässä ei ole virhettä
		return 0;
	}
    public function setSyntymaaika($syntymaaika) {
		$this->syntymaaika = trim ( $syntymaaika );
	}
	public function getSyntymaaika() {
		return $this->syntymaaika;
	}
 	public function checkSyntymaaika($required = true) {

		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->syntymaaika ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->syntymaaika ) == 0) {
			return 51;
		}
		// Jos syntymäajan muoto ei ole oikea
        if (! preg_match ( "/^(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}$/", $this->syntymaaika )) {
            return 52;
        }
		return 0;
	}
	// Email
	public function setEmail($email) {
		$this->email = trim ( $email );
	}
	public function getEmail() {
		return $this->email;
	}
	public function checkEmail($required = true) {
        if ($required == false && strlen ( $this->email ) == 0) {
			return 0;
		}
		if ($required == true && strlen ( $this->email) == 0) {
			return 61;
		}
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return 62; 
        }
        return 0;
        
	}
    public function setKotisivu($kotisivu) {
		$this->kotisivu = trim ( $kotisivu );
	}
	public function getKotisivu() {
		return $this->kotisivu;
	}
 	public function checkKotisivu($required = true) {

		// Jos saa olla tyhjä ja on tyhjä
		if ($required == false && strlen ( $this->kotisivu ) == 0) {
			return 0;
		}
		// Jos ei saa olla tyhjä ja on tyhjä
		if ($required == true && strlen ( $this->kotisivu ) == 0) {
			return 71;
		}
		// Jos kotisivun muoto ei ole oikea
        if (! preg_match ( "/(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/", $this->kotisivu )) {
            return 72;
        }
		return 0;
	}
    public function setKommentti($kommentti) {
		$this->kuvaus = trim ( $kommentti );
	}
	public function getKommentti() {
		return $this->kommentti;
	}
	public function checkKommentti($required = true, $min = 8, $max = 100) {
		if ($required == false && strlen ( $this->kommentti ) == 0) {
			return 0;
		}
		if ($required == true && strlen ( $this->kommentti ) == 0) {
			return 81;
		}
		if (strlen ( $this->kommentti ) < $min) {
			return 83;
		}
		if (strlen ( $this->kommentti ) > $max) {
			return 83;
		}
        if (preg_match ( "/[*|\":<>[\]{}`\\()';@&$]/", $this->kommentti )) {
			return 82;
		}
		return 0;
	}
	public function setId($id) {
		$this->id = trim ( $id );
	}

	public function getId() {
		return $this->id;
	}
}
?>