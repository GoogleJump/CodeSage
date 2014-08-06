-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 12:09 PM
-- Server version: 5.5.32-cll-lve
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codeSage`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `facebookID` varchar(255) NOT NULL,
  `facebookName` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `totalPoints` int(11) NOT NULL,
  `battleCount` int(11) NOT NULL,
  `victoryCount` int(11) NOT NULL,
  `joinedAt` datetime NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `battles`
--

CREATE TABLE IF NOT EXISTS `battles` (
  `battleID` int(11) NOT NULL AUTO_INCREMENT,
  `battleKey` varchar(16) NOT NULL,
  `player1ID` varchar(255) NOT NULL,
  `player2ID` varchar(255) NOT NULL,
  `language` varchar(16) NOT NULL,
  `difficulty` varchar(16) NOT NULL,
  `questionCount` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `finishedAt` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`battleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `playerID` int(11) NOT NULL AUTO_INCREMENT,
  `facebookID` varchar(255) NOT NULL,
  `battleID` varchar(16) NOT NULL,
  `points` int(11) NOT NULL,
  `submissionCount` int(11) NOT NULL,
  `attackCount` int(11) NOT NULL,
  `questionNumber` int(15) NOT NULL,
  `questionCount` int(15) NOT NULL,
  `code` longtext NOT NULL,
  `winner` tinyint(4) NOT NULL,
  PRIMARY KEY (`playerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `powerDowns`
--

CREATE TABLE IF NOT EXISTS `powerDowns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `playerID` varchar(255) NOT NULL,
  `battleID` varchar(16) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` longtext NOT NULL,
  `Example` varchar(255) NOT NULL,
  `testCases` varchar(255) NOT NULL,
  `acceptedOutput` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
