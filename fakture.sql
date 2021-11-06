-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 6, 2021 at 10:47 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakture`
--

CREATE DATABASE IF NOT EXISTS 'fakture' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

--
-- Table stucture for table `izdavac`
--

DROP TABLE IF EXISTS `izdavac`;
CREATE TABLE `izdavac` (
    `izdavacId` int(11) NOT NULL,
    `naziv` varchar(255) NOT NULL,
    `pib` int(10) NOT NULL,
    `adresa` varchar(255) NOT NULL.
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
    PRIMARY KEY (`izdavacId`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `komitent`
--
DROP TABLE IF EXISTS `komitent`;
CREATE TABLE `komitent`(
    `komitentId` int(11) NOT NULL,
    `naziv` varchar(255) NOT NULL,
    `pib` int(10) NOT NULL,
    `adresa` varchar(255) NOT NULL,
    PRIMARY KEY (`komitentId`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `faktura`
--
DROP TABLE IF EXISTS `faktura`;
CREATE TABLE `faktura`(
    `fakturaId` int(11) NOT NULL,
    `broj` varchar(255) NOT NULL,
    `datum` date NOT NULL DEFAULT current_timestamp(),
    `ukupan_iznos` float(24) NOT NULL,
    PRIMARY KEY (`fakturaId`),
    FOREIGN KEY (`izdavacId`) REFERENCES `izdavac(izdavacId)`,
    FOREIGN KEY (`komitentId`) REFERENCES `komitent(komitentId)`
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `stavka fakture`
--
DROP TABLE IF EXISTS `stavka fakutre`;
CREATE TABLE `stavka fakture`(
    `stavkaId` int(11) NOT NULL,
    `naziv_proizvoda` varchar(255) NOT NULL,
    `kolicina` int(6) NOT NULL,
    `valuta` varchar(255) NOT NULL,
    PRIMARY KEY (`stavkaId`),
    PRIMARY KEY (`fakturaId`) REFERENCES `fakutra(fakturaId)`
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ALTER TABLE 'izdavac'
--     ADD PRIMARY KEY (`izdavacId`);

-- ALTER TABLE 'komitent'
--     ADD PRIMARY KEY (`komitentId`);

-- ALTER TABLE 'faktura'
--     ADD PRIMARY KEY (`fakturaId`);
--     ADD FOREIGN KEY (`izdavacId`) REFERENCES 

-- ALTER TABLE 'stavka fakutre'
--     ADD PRIMARY KEY (`stavkaId`);
--     ADD FOREIGN KEY (``)

--
-- AUTO_INCREMENT for table `izdavac`
--
ALTER TABLE `izdavac`
  MODIFY `izdavaciId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `komitent`
--
ALTER TABLE `komitent`
  MODIFY `komitentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `faktura`
--
ALTER TABLE `faktura`
  MODIFY `fakutraId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `stavka fakture`
--
ALTER TABLE `stavka fakture`
  MODIFY `stavkaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;


ALTER TABLE `stavka fakture`
	ADD PRIMARY KEY (`fk_faktura`) REFERENCES `faktura`(`fakturaId`) ON DELETE RESTRICT ON UPDATE RESTRICT;