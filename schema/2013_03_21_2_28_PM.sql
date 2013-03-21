-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2013 at 09:30 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parallex`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentdrama`
--

CREATE TABLE IF NOT EXISTS `commentdrama` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Did` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Email` varchar(60) COLLATE utf8_bin NOT NULL,
  `Website` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Did` (`Did`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `commentdrama`
--


-- --------------------------------------------------------

--
-- Table structure for table `commentmusic`
--

CREATE TABLE IF NOT EXISTS `commentmusic` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mid` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Email` varchar(60) COLLATE utf8_bin NOT NULL,
  `Website` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Mid` (`Mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `commentmusic`
--


-- --------------------------------------------------------

--
-- Table structure for table `commentshows`
--

CREATE TABLE IF NOT EXISTS `commentshows` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Sid` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Email` varchar(60) COLLATE utf8_bin NOT NULL,
  `Website` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Sid` (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `commentshows`
--


-- --------------------------------------------------------

--
-- Table structure for table `drama`
--

CREATE TABLE IF NOT EXISTS `drama` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProgramName` varchar(100) COLLATE utf8_bin NOT NULL,
  `Timing` datetime DEFAULT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Url` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `drama`
--


-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProgramName` varchar(100) COLLATE utf8_bin NOT NULL,
  `Timing` datetime DEFAULT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Url` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `music`
--


-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE IF NOT EXISTS `shows` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ProgramName` varchar(100) COLLATE utf8_bin NOT NULL,
  `Timing` datetime DEFAULT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Url` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `shows`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentdrama`
--
ALTER TABLE `commentdrama`
  ADD CONSTRAINT `commentdrama_ibfk_1` FOREIGN KEY (`Did`) REFERENCES `drama` (`Id`);

--
-- Constraints for table `commentmusic`
--
ALTER TABLE `commentmusic`
  ADD CONSTRAINT `commentmusic_ibfk_1` FOREIGN KEY (`Mid`) REFERENCES `music` (`Id`);

--
-- Constraints for table `commentshows`
--
ALTER TABLE `commentshows`
  ADD CONSTRAINT `commentshows_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `shows` (`Id`);
