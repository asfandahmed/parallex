-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2013 at 09:38 PM
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
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentId` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_bin NOT NULL,
  `Email` varchar(60) COLLATE utf8_bin NOT NULL,
  `Website` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `Comment` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ContentId` (`ContentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentType` int(11) NOT NULL,
  `ProgramName` varchar(100) COLLATE utf8_bin NOT NULL,
  `Timing` datetime DEFAULT NULL,
  `Description` text COLLATE utf8_bin NOT NULL,
  `Url` text COLLATE utf8_bin NOT NULL,
  `DateAndTime` datetime NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ContentType` (`ContentType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `content`
--


-- --------------------------------------------------------

--
-- Table structure for table `contenttype`
--

CREATE TABLE IF NOT EXISTS `contenttype` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `Type` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `contenttype`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ContentId`) REFERENCES `content` (`Id`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_ibfk_1` FOREIGN KEY (`ContentType`) REFERENCES `contenttype` (`Id`);
