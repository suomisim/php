-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 04:15 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myyntipalsta`
--

-- --------------------------------------------------------

--
-- Table structure for table `ilmoitus`
--
create database myyntipalsta;
use myyntipalsta;

CREATE TABLE `ilmoitus` (
  `id` int(10) UNSIGNED NOT NULL,
  `tyyppi` int(10) UNSIGNED NOT NULL,
  `otsikko` varchar(50) NOT NULL,
  `kuvaus` varchar(500) DEFAULT NULL,
  `hinta` decimal(10,2) NOT NULL,
  `nimi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `puhnro` varchar(20) DEFAULT NULL,
  `paikkakunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ilmoitus`
--

INSERT INTO `ilmoitus` (`id`, `tyyppi`, `otsikko`, `kuvaus`, `hinta`, `nimi`, `email`, `puhnro`, `paikkakunta`) VALUES
(1, 1, 'Purjevene', 'Vähän käytetty', '1000.00', 'Sirpa Marttila', 'sirpa.marttila@haaga-helia.fi', '1234567', 'Lohja'),
(2, 1, 'Polkupyörä', 'Jopo kulunut', '100.00', 'Matti Meikäläinen', 'matti@meikala.fi', '7654321', 'Vitala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilmoitus`
--
ALTER TABLE `ilmoitus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilmoitus`
--
ALTER TABLE `ilmoitus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
