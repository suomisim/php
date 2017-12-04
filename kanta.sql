CREATE DATABASE a1501104;
USE a1501104;

CREATE TABLE henkilot (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	etunimi VARCHAR(50) NOT NULL,
	sukunimi VARCHAR(50) NOT NULL,
	lahiosoite VARCHAR(50) NOT NULL,
	postitiedot VARCHAR(50) NOT NULL,
	syntymaaika VARCHAR(12) NOT NULL,
	email VARCHAR(50) NOT NULL,
	kotisivu VARCHAR(100) NOT NULL,
	kommentti VARCHAR(200) NOT NULL,
	PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO henkilot(id, etunimi, sukunimi, lahiosoite, postitiedot, syntymaaika, email, kotisivu, kommentti)
	VALUES	(1, "Pekka", "Peruskäyttäjä", "Pekanpolku 6 A 6", "00120 KORVATUNTURI", "07-07-1990", "pekka@peruskayttaja.com", "www.pekka.com", "Tämä on testidataa."),
			(2, "Testi", "Käyttäjä", "Testikatu 44", "00651 TESTIJÄRVI", "10-10-1977", "testi@hotmail.com", "http://www.testisivu.edu", "Testikäyttäjä oli täällä.");
			

CREATE TABLE `ilmoitus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tyyppi` int(10) UNSIGNED NOT NULL,
  `otsikko` varchar(50) NOT NULL,
  `kuvaus` varchar(500) DEFAULT NULL,
  `hinta` decimal(10,2) NOT NULL,
  `nimi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `puhnro` varchar(20) DEFAULT NULL,
  `paikkakunta` varchar(50) NOT NULL,
  PRIMARY KEY(id))
ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ilmoitus` (`tyyppi`, `otsikko`, `kuvaus`, `hinta`, `nimi`, `email`, `puhnro`, `paikkakunta`) VALUES
(1, 'Purjevene', 'Vähän käytetty', '1000.00', 'Sirpa Marttila', 'sirpa.marttila@haaga-helia.fi', '1234567', 'Lohja'),
(1, 'Polkupyörä', 'Jopo kulunut', '100.00', 'Matti Meikäläinen', 'matti@meikala.fi', '7654321', 'Vitala');