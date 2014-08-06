-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2014 at 11:35 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `facebookID`, `facebookName`, `rating`, `totalPoints`, `battleCount`, `victoryCount`, `joinedAt`) VALUES
(20, '694366633945862', 'Devon Bernard', 1000, 0, 0, 0, '2014-07-25 02:04:58'),
(21, '10204318854516253', 'Laurie Wu', 1000, 0, 0, 0, '2014-07-25 02:10:06'),
(22, '10152584528231125', 'Reza Nayebi', 1000, 0, 0, 0, '2014-08-01 19:05:50'),
(23, '795471103808592', 'Fred Gisa', 1000, 0, 0, 0, '2014-08-01 19:08:28');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `battles`
--

INSERT INTO `battles` (`battleID`, `battleKey`, `player1ID`, `player2ID`, `language`, `difficulty`, `questionCount`, `views`, `createdAt`, `finishedAt`, `duration`) VALUES
(1, 'jlnrINQX34', '2147483647', '10152584528231125', 'php', 'ninja', 4, 0, '2014-07-25 01:37:48', '0000-00-00 00:00:00', 0),
(2, 'lopwxyBEQ8', '694366633945862', '3250987', 'php', 'ninja', 8, 0, '2014-07-25 01:59:52', '0000-00-00 00:00:00', 0),
(3, 'irwACLXY17', '10204318854516253', '436346', 'c++', 'easy', 1, 0, '2014-07-25 02:10:23', '0000-00-00 00:00:00', 0),
(4, 'hkopuAIKRY', '10204318854516253', '694366633945862', 'python', 'medium', 4, 0, '2014-07-26 22:32:01', '0000-00-00 00:00:00', 0),
(5, 'cjozBCDQT3', '694366633945862', '795471103808592', 'python', 'hard', 2, 0, '2014-07-26 22:52:22', '0000-00-00 00:00:00', 0),
(6, 'fltCJUVY18', '694366633945862', '10152584528231125', 'c++', 'easy', 4, 0, '2014-07-26 22:53:13', '0000-00-00 00:00:00', 0),
(7, 'qstvyDHOT4', '694366633945862', '10152584528231125', 'c++', 'easy', 5, 0, '2014-07-26 22:53:48', '0000-00-00 00:00:00', 0),
(8, 'ajruvyIS17', '694366633945862', '436346', 'java', 'easy', 4, 0, '2014-07-26 22:56:00', '0000-00-00 00:00:00', 0),
(9, 'beghsSTZ09', '694366633945862', '10204318854516253', 'php', 'hard', 4, 0, '2014-07-27 12:24:30', '0000-00-00 00:00:00', 0),
(10, 'dLMNPT1268', '694366633945862', '10204318854516253', 'python', 'ninja', 7, 0, '2014-07-27 19:08:23', '0000-00-00 00:00:00', 0),
(11, 'fiyIZ01246', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-01 19:05:57', '0000-00-00 00:00:00', 0),
(12, 'fptuGIQT17', '10152584528231125', '', 'python', 'medium', 3, 0, '2014-08-02 07:29:34', '0000-00-00 00:00:00', 0),
(13, 'egkrtv0348', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-02 07:34:29', '0000-00-00 00:00:00', 0),
(14, 'fkoEGJNRV3', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-02 07:35:18', '0000-00-00 00:00:00', 0),
(15, 'aehnvzIKV0', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-02 07:39:12', '0000-00-00 00:00:00', 0),
(16, 'afpvxQX045', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-02 09:48:05', '0000-00-00 00:00:00', 0),
(17, 'bmnrsAKQS3', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-04 23:46:20', '0000-00-00 00:00:00', 0),
(18, 'dorCGLUZ12', '10152584528231125', '795471103808592', 'python', 'easy', 1, 0, '2014-08-04 23:47:58', '0000-00-00 00:00:00', 0),
(19, 'ekyCHITUYZ', '10152584528231125', '795471103808592', 'java', 'easy', 1, 0, '2014-08-05 12:01:05', '0000-00-00 00:00:00', 0),
(20, 'jmnquEU459', '10152584528231125', '795471103808592', 'c++', 'easy', 4, 0, '2014-08-05 14:29:40', '0000-00-00 00:00:00', 0),
(21, 'dqsHPQTX17', '10152584528231125', '795471103808592', 'java', 'medium', 1, 0, '2014-08-05 16:44:14', '0000-00-00 00:00:00', 0),
(22, 'iuwAHJNY03', '10152584528231125', '', 'php', 'easy', 2, 0, '2014-08-05 17:20:26', '0000-00-00 00:00:00', 0),
(23, 'gnxzDK0679', '795471103808592', '10152584528231125', 'python', 'hard', 2, 0, '2014-08-05 17:24:18', '0000-00-00 00:00:00', 0),
(24, 'bpuxSX1379', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 17:26:15', '0000-00-00 00:00:00', 0),
(25, 'klnyEGX158', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 18:48:56', '0000-00-00 00:00:00', 0),
(26, 'bejpBDLQVW', '694366633945862', '', 'c++', 'medium', 3, 0, '2014-08-05 19:26:32', '0000-00-00 00:00:00', 0),
(27, 'ahnqtvzFLN', '795471103808592', '694366633945862', 'c++', 'easy', 2, 0, '2014-08-05 19:29:57', '2014-08-06 03:25:54', 0),
(28, 'hjlmCLPW15', '795471103808592', '', 'c++', 'hard', 6, 0, '2014-08-05 19:42:10', '0000-00-00 00:00:00', 0),
(29, 'fmBCFINTZ4', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 19:52:27', '0000-00-00 00:00:00', 0),
(30, 'hqwxyAFJMW', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 20:44:54', '0000-00-00 00:00:00', 0),
(31, 'huABEMQSTW', '795471103808592', '', 'python', 'easy', 1, 0, '2014-08-05 20:46:55', '0000-00-00 00:00:00', 0),
(32, 'ptvxGHIO57', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 20:58:21', '0000-00-00 00:00:00', 0),
(33, 'acBHJOS137', '10152584528231125', '795471103808592', 'c++', 'easy', 3, 0, '2014-08-05 20:59:03', '0000-00-00 00:00:00', 0),
(34, 'hjptyHIUW7', '10152584528231125', '795471103808592', 'java', 'easy', 2, 0, '2014-08-05 21:02:53', '0000-00-00 00:00:00', 0),
(35, 'gilopqIYZ5', '10152584528231125', '795471103808592', 'c++', 'easy', 3, 0, '2014-08-05 21:16:40', '0000-00-00 00:00:00', 0),
(36, 'ehpwBCHOST', '10152584528231125', '795471103808592', 'python', 'easy', 4, 0, '2014-08-05 21:17:37', '0000-00-00 00:00:00', 0),
(37, 'ehtxyzCEV5', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-05 22:14:24', '0000-00-00 00:00:00', 0),
(38, 'cpqszDEHTZ', '10152584528231125', '', 'java', 'easy', 1, 0, '2014-08-05 22:15:38', '0000-00-00 00:00:00', 0),
(39, 'fivxyIPX09', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-05 22:16:07', '0000-00-00 00:00:00', 0),
(40, 'erFOUYZ458', '10152584528231125', '795471103808592', 'python', 'easy', 1, 0, '2014-08-05 22:16:16', '0000-00-00 00:00:00', 0),
(41, 'bhlCNQUY16', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-05 22:17:12', '0000-00-00 00:00:00', 0),
(42, 'gjquwxFW27', '10152584528231125', '795471103808592', 'java', 'easy', 1, 0, '2014-08-05 22:18:43', '0000-00-00 00:00:00', 0),
(43, 'beknyzHMQZ', '10152584528231125', '795471103808592', 'python', 'easy', 1, 0, '2014-08-05 22:19:35', '0000-00-00 00:00:00', 0),
(44, 'bckwLNPTW2', '795471103808592', '', 'python', 'hard', 3, 0, '2014-08-05 22:29:35', '0000-00-00 00:00:00', 0),
(45, 'bqJKMYZ058', '795471103808592', '', 'c++', 'easy', 1, 0, '2014-08-05 22:37:32', '0000-00-00 00:00:00', 0),
(46, 'ehizBCKOZ0', '795471103808592', '', 'python', 'hard', 7, 0, '2014-08-05 22:50:23', '0000-00-00 00:00:00', 0),
(47, 'nvzBERTY58', '10152584528231125', '795471103808592', 'python', 'easy', 1, 0, '2014-08-05 22:53:49', '0000-00-00 00:00:00', 0),
(48, 'abcjlmsL13', '795471103808592', '', 'python', 'ninja', 6, 0, '2014-08-05 22:59:01', '0000-00-00 00:00:00', 0),
(49, 'hkrvHKNQ47', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-05 23:10:52', '0000-00-00 00:00:00', 0),
(50, 'iowxBHMRT3', '795471103808592', '', 'python', 'easy', 1, 0, '2014-08-05 23:13:10', '0000-00-00 00:00:00', 0),
(51, 'biqACEMU24', '10152584528231125', '795471103808592', 'c++', 'easy', 3, 0, '2014-08-05 23:15:17', '0000-00-00 00:00:00', 0),
(52, 'jmuHPSTU45', '10152584528231125', '', 'java', 'easy', 1, 0, '2014-08-05 23:21:24', '0000-00-00 00:00:00', 0),
(53, 'fxDNOPXZ46', '10152584528231125', '795471103808592', 'java', 'easy', 1, 0, '2014-08-05 23:21:24', '0000-00-00 00:00:00', 0),
(54, 'csCGLST578', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 00:11:43', '0000-00-00 00:00:00', 0),
(55, 'dozAHJKS01', '795471103808592', '', 'python', 'medium', 5, 0, '2014-08-06 00:39:10', '0000-00-00 00:00:00', 0),
(56, 'lvIPQYZ158', '10152584528231125', '795471103808592', 'java', 'easy', 1, 0, '2014-08-06 00:39:56', '0000-00-00 00:00:00', 0),
(57, 'efjnrADMXY', '10152584528231125', '', 'java', 'easy', 1, 0, '2014-08-06 00:47:22', '0000-00-00 00:00:00', 0),
(58, 'dtIJNU1268', '10152584528231125', '694366633945862', 'c++', 'easy', 1, 0, '2014-08-06 00:47:26', '0000-00-00 00:00:00', 0),
(59, 'ovEOQTVY18', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-06 00:50:00', '0000-00-00 00:00:00', 0),
(60, 'bdsuvDE129', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-06 00:53:09', '0000-00-00 00:00:00', 0),
(61, 'BFHLOPQTX3', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 01:23:53', '0000-00-00 00:00:00', 0),
(62, 'djlouLPV18', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-06 01:34:07', '0000-00-00 00:00:00', 0),
(63, 'cdpuBLOT28', '10152584528231125', '795471103808592', 'c++', 'easy', 2, 0, '2014-08-06 01:34:21', '0000-00-00 00:00:00', 0),
(64, 'alHIRXY235', '10152584528231125', '795471103808592', 'c++', 'easy', 2, 0, '2014-08-06 02:05:21', '0000-00-00 00:00:00', 0),
(65, 'ilnqBEFOS0', '10152584528231125', '', 'c++', 'easy', 2, 0, '2014-08-06 02:06:41', '0000-00-00 00:00:00', 0),
(66, 'bfklNPU014', '10152584528231125', '795471103808592', 'java', 'easy', 3, 0, '2014-08-06 02:18:37', '0000-00-00 00:00:00', 0),
(67, 'emnoBFL189', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 02:23:00', '0000-00-00 00:00:00', 0),
(68, 'dklruCHLS5', '10152584528231125', '795471103808592', 'java', 'easy', 3, 0, '2014-08-06 02:52:59', '0000-00-00 00:00:00', 0),
(69, 'elmxyILSYZ', '10152584528231125', '795471103808592', 'python', 'easy', 3, 0, '2014-08-06 02:55:14', '0000-00-00 00:00:00', 0),
(70, 'dmuvwxNTZ9', '10152584528231125', '795471103808592', 'c++', 'easy', 3, 0, '2014-08-06 03:16:00', '0000-00-00 00:00:00', 0),
(71, 'bceopsuwBG', '694366633945862', '795471103808592', 'php', 'easy', 2, 0, '2014-08-06 03:36:32', '2014-08-06 03:41:15', 0),
(72, 'acgvCNOS78', '694366633945862', '10152584528231125', 'c++', 'easy', 2, 0, '2014-08-06 03:42:07', '2014-08-06 12:03:35', 0),
(73, 'gjtBGMQTUW', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 03:55:11', '0000-00-00 00:00:00', 0),
(74, 'cjrDEHMX29', '10152584528231125', '', 'c++', 'easy', 1, 0, '2014-08-06 06:32:43', '0000-00-00 00:00:00', 0),
(75, 'deoqyAEIRS', '10152584528231125', '', 'c++', 'easy', 2, 0, '2014-08-06 10:39:23', '0000-00-00 00:00:00', 0),
(76, 'abdgDGJQRX', '25252', '694366633945862', 'c++', 'easy', 2, 0, '2014-08-06 12:11:37', '2014-08-06 12:15:30', 0),
(77, 'kqrtzEOW06', '694366633945862', '25252', 'c++', 'easy', 3, 0, '2014-08-06 12:17:33', '2014-08-06 12:31:43', 0),
(78, 'eosBNY5679', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 12:37:15', '0000-00-00 00:00:00', 0),
(79, 'mrswBORSU1', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 12:52:19', '0000-00-00 00:00:00', 0),
(80, 'fluyJLOV35', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 12:59:19', '0000-00-00 00:00:00', 0),
(81, 'nvDHIKQS27', '694366633945862', '10152584528231125', 'c++', 'easy', 3, 0, '2014-08-06 13:02:06', '2014-08-06 13:07:47', 0),
(82, 'aosAPRUXY2', '25252', '694366633945862', 'c++', 'easy', 2, 0, '2014-08-06 13:08:45', '0000-00-00 00:00:00', 0),
(83, 'antuFJRXZ3', '10152584528231125', '795471103808592', 'c++', 'easy', 2, 0, '2014-08-06 13:09:05', '0000-00-00 00:00:00', 0),
(84, 'efopMWZ017', '694366633945862', '10152584528231125', 'c++', 'easy', 2, 0, '2014-08-06 13:13:31', '0000-00-00 00:00:00', 0),
(85, 'gklptHNQR0', '10152584528231125', '795471103808592', 'c++', 'easy', 3, 0, '2014-08-06 13:21:33', '0000-00-00 00:00:00', 0),
(86, 'gqFGMPTWX4', '10152584528231125', '795471103808592', 'c++', 'easy', 1, 0, '2014-08-06 13:31:06', '0000-00-00 00:00:00', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`playerID`, `facebookID`, `battleID`, `points`, `submissionCount`, `attackCount`, `questionNumber`, `questionCount`, `code`, `winner`) VALUES
(1, '694366633945862', 'ajruvyIS17', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(2, '10204318854516253', 'ajruvyIS17', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n    THIS IS LAURIE\n}', 0),
(4, '694366633945862', 'beghsSTZ09', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    agr\n    dsag\n    aweg\n    awehg\n    waeh\n    aweh\n    \n    return x;\n}', 0),
(5, '10204318854516253', 'beghsSTZ09', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    etewytoieruyoieutyoieuryoiureoiuteroiyue\n    roiuyoiuyreoiuyreoiuyreoiuyreoiuyreoiuyreoiu\n    return x;\n}', 0),
(6, '694366633945862', 'dLMNPT1268', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    ewjoifhjwieogheoisahtgoihsaegoihasge\n    for(int i )\n    return x;\n}', 0),
(7, '10204318854516253', 'dLMNPT1268', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    sadjoiuhdsagfasdhoisadh\n    asdfhasdhadfh\n    sf\\hdafhsdfh\n    ahrsdtrhaerh\n    sdrhsdrh\n    \n    return x;\n}', 0),
(8, '10152584528231125', 'fiyIZ01246', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(9, '10152584528231125', 'qstvyDHOT4', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(10, '795471103808592', 'cjozBCDQT3', 0, 0, 0, 0, 0, 'def square(x):\n    return x*x', 0),
(11, '10152584528231125', 'jlnrINQX34', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax h;\n    return x;\n}', 0),
(12, '10152584528231125', 'fptuGIQT17', 0, 0, 0, 0, 0, 'function foo(items) {\n    var str = "";\n    for(var i = 0; i < 10; i  ) {\n        str  = items;\n    }\n    return str;\n}', 0),
(13, '10152584528231125', 'egkrtv0348', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(14, '10152584528231125', 'fkoEGJNRV3', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(15, '10152584528231125', 'aehnvzIKV0', 0, 0, 0, 0, 0, '', 0),
(16, '10152584528231125', 'fltCJUVY18', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(17, '10152584528231125', 'afpvxQX045', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(18, '10152584528231125', 'bmnrsAKQS3', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(19, '795471103808592', 'bmnrsAKQS3', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(20, '10152584528231125', 'dorCGLUZ12', 0, 0, 0, 0, 0, 'def main():\n    print "Hello"\n	return\nmain()', 0),
(21, '795471103808592', 'dorCGLUZ12', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "this is syntax highlighted";\n    return x;\n}', 0),
(22, '10152584528231125', 'ekyCHITUYZ', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(23, '795471103808592', 'ekyCHITUYZ', 0, 0, 0, 0, 0, '', 0),
(24, '10152584528231125', 'jmnquEU459', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(25, '795471103808592', 'jmnquEU459', 0, 0, 0, 0, 0, '', 0),
(26, '10152584528231125', 'dqsHPQTX17', 0, 0, 0, 0, 0, 'function foo(items) {\n    var x = "All this is syntax highlighted";\n    return x;\n}', 0),
(27, '795471103808592', 'dqsHPQTX17', 0, 0, 0, 0, 0, '\nSystem.out.prinln("Hello")', 0),
(28, '10152584528231125', 'iuwAHJNY03', 0, 0, 0, 0, 0, '', 0),
(29, '795471103808592', 'gnxzDK0679', 0, 0, 0, 0, 0, '', 0),
(30, '10152584528231125', 'bpuxSX1379', 0, 0, 0, 0, 0, '', 0),
(31, '795471103808592', 'bpuxSX1379', 0, 0, 0, 0, 0, '', 0),
(32, '10152584528231125', 'klnyEGX158', 0, 0, 0, 0, 0, '', 0),
(33, '795471103808592', 'ahnqtvzFLN', 0, 0, 0, 3, 0, '', 0),
(34, '795471103808592', 'hjlmCLPW15', 0, 0, 0, 3, 0, '', 0),
(35, '694366633945862', 'ahnqtvzFLN', 40, 0, 0, 1, 4, '#include <iostream>\nusing namespace std;\nint main() {    cout<< "aaaaaaaaaa";\n}', 1),
(36, '10152584528231125', 'fmBCFINTZ4', 0, 0, 0, 1, 0, '', 0),
(37, '795471103808592', 'klnyEGX158', 0, 0, 0, 2, 0, '', 0),
(38, '10152584528231125', 'hqwxyAFJMW', 0, 0, 0, 1, 0, '#include <iostream>\n\nusing namespace std;\n\nint main() {\n    int x;\n    x = 5;\n    cout << x << endl;\n    return 0;\n}', 0),
(39, '795471103808592', 'huABEMQSTW', 0, 0, 0, 1, 0, 'def main():\n    print(4)\nmain()', 0),
(40, '795471103808592', 'fmBCFINTZ4', 0, 0, 0, 1, 0, '', 0),
(41, '795471103808592', 'hqwxyAFJMW', 0, 0, 0, 1, 0, '', 0),
(42, '10152584528231125', 'ptvxGHIO57', 0, 0, 0, 2, 0, '', 0),
(43, '10152584528231125', 'acBHJOS137', 0, 0, 0, 1, 0, '', 0),
(44, '795471103808592', 'acBHJOS137', 0, 0, 0, 1, 0, '', 0),
(45, '10152584528231125', 'hjptyHIUW7', 0, 0, 0, 1, 0, '', 0),
(46, '10152584528231125', 'gilopqIYZ5', 0, 0, 0, 2, 0, '', 0),
(47, '795471103808592', 'gilopqIYZ5', 0, 0, 0, 3, 0, '', 0),
(48, '10152584528231125', 'ehpwBCHOST', 0, 0, 0, 1, 0, '', 0),
(49, '795471103808592', 'ehpwBCHOST', 0, 0, 0, 3, 0, 'def main():\n    print(5)\nmain()', 0),
(50, '795471103808592', 'ptvxGHIO57', 0, 0, 0, 1, 0, '', 0),
(51, '795471103808592', 'hjptyHIUW7', 0, 0, 0, 1, 0, '', 0),
(52, '10152584528231125', 'ehtxyzCEV5', 0, 0, 0, 2, 0, '', 0),
(53, '10152584528231125', 'cpqszDEHTZ', 0, 0, 0, 1, 0, '', 0),
(54, '10152584528231125', 'fivxyIPX09', 0, 0, 0, 1, 0, '', 0),
(55, '10152584528231125', 'erFOUYZ458', 0, 0, 0, 1, 0, '', 0),
(56, '10152584528231125', 'bhlCNQUY16', 0, 0, 0, 2, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << "Hello" << endl;\n    return 0;\n}', 0),
(57, '10152584528231125', 'gjquwxFW27', 0, 0, 0, 3, 0, '', 0),
(58, '10152584528231125', 'beknyzHMQZ', 0, 0, 0, 2, 0, 'def main(x):\n    print x\n    return \nmain(5)', 0),
(59, '795471103808592', 'beknyzHMQZ', 0, 0, 0, 1, 0, 'def p():\n    print(7)\n    \np()', 0),
(60, '795471103808592', 'gjquwxFW27', 0, 0, 0, 2, 0, '', 0),
(61, '795471103808592', 'erFOUYZ458', 0, 0, 0, 3, 0, 'def main(x):\n    print x*x\nmain(5)', 0),
(62, '795471103808592', 'bckwLNPTW2', 0, 0, 0, 1, 0, 'def rep():\n    print("ff")\n    \nrep()', 0),
(63, '795471103808592', 'bqJKMYZ058', 0, 0, 0, 3, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout<<"youuuuuu";\n}\n', 0),
(64, '795471103808592', 'bhlCNQUY16', 0, 0, 0, 2, 0, '', 0),
(65, '795471103808592', 'ehizBCKOZ0', 0, 0, 0, 1, 0, '', 0),
(66, '10152584528231125', 'nvzBERTY58', 0, 0, 0, 2, 0, '', 0),
(67, '795471103808592', 'nvzBERTY58', 0, 0, 0, 3, 0, 'print("gf")', 0),
(68, '795471103808592', 'abcjlmsL13', 0, 0, 0, 1, 0, 'print(4 if 5 > 7 else 8)', 0),
(69, '10152584528231125', 'hkrvHKNQ47', 0, 0, 0, 2, 0, '#include <iostream>\n#include <stdio.h>\nusing namespace std;\n\nint main()\n{\n	int* x = null;\n	int y = 3;\n	*x = 2;\n	printf("%d", *x);\n	return 0;\n}', 0),
(70, '795471103808592', 'iowxBHMRT3', 0, 0, 0, 3, 0, '', 0),
(71, '10152584528231125', 'biqACEMU24', 0, 0, 0, 2, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << "Hello" << endl;\n    return 0;\n}\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n', 0),
(72, '795471103808592', 'biqACEMU24', 0, 0, 0, 1, 0, '#include <iostream>\nusing namespace std;\n\nint x = 8;\nint main(x) {\n    cout<<x*x;\n    return 0;\n}\n', 0),
(73, '10152584528231125', 'jmuHPSTU45', 0, 0, 0, 1, 0, '', 0),
(74, '10152584528231125', 'fxDNOPXZ46', 0, 0, 0, 1, 0, 'class Main {\n    public static void main(String[] args) {\n        System.out.println("Hello");\n    }\n}', 0),
(75, '795471103808592', 'fxDNOPXZ46', 0, 0, 0, 2, 0, 'dfvds', 0),
(76, '10152584528231125', 'csCGLST578', 0, 0, 0, 3, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << "Hi" << endl;\n    return 0;\n}', 0),
(77, '795471103808592', 'csCGLST578', 0, 0, 0, 1, 0, '', 0),
(78, '795471103808592', 'dozAHJKS01', 0, 0, 0, 1, 0, 'def main():\n    print(0)\nmain()', 0),
(79, '10152584528231125', 'lvIPQYZ158', 0, 0, 0, 2, 0, '', 0),
(80, '795471103808592', 'lvIPQYZ158', 0, 0, 0, 2, 0, '', 0),
(81, '10152584528231125', 'efjnrADMXY', 0, 0, 0, 2, 0, '', 0),
(82, '10152584528231125', 'dtIJNU1268', 0, 0, 0, 3, 0, '', 0),
(83, '10152584528231125', 'ovEOQTVY18', 0, 0, 0, 2, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    cout << "hello" << endl;\n    return 0;\n}', 0),
(84, '10152584528231125', 'bdsuvDE129', 0, 0, 0, 1, 0, '#include <iostream>\nusing namespace std;\n\nint main() {\n    \n    return 0;\n}', 0),
(85, '10152584528231125', 'BFHLOPQTX3', 0, 0, 0, 2, 0, '', 0),
(86, '795471103808592', 'BFHLOPQTX3', 0, 0, 0, 2, 0, '', 0),
(87, '10152584528231125', 'djlouLPV18', 0, 0, 0, 3, 0, '', 0),
(88, '10152584528231125', 'cdpuBLOT28', 0, 0, 0, 1, 0, '', 0),
(89, '795471103808592', 'cdpuBLOT28', 0, 0, 0, 2, 0, '', 0),
(90, '10152584528231125', 'alHIRXY235', 0, 0, 0, 1, 0, '', 0),
(91, '795471103808592', 'alHIRXY235', 0, 0, 0, 1, 0, '', 0),
(92, '10152584528231125', 'ilnqBEFOS0', 0, 0, 0, 1, 0, '', 0),
(93, '10152584528231125', 'bfklNPU014', 0, 0, 0, 2, 0, '', 0),
(94, '795471103808592', 'bfklNPU014', 0, 0, 0, 1, 0, '', 0),
(95, '10152584528231125', 'emnoBFL189', 0, 0, 0, 2, 0, '', 0),
(96, '795471103808592', 'emnoBFL189', 0, 0, 0, 4, 0, '', 0),
(97, '10152584528231125', 'dklruCHLS5', 0, 0, 0, 1, 0, '', 0),
(98, '795471103808592', 'dklruCHLS5', 0, 0, 0, 2, 0, '', 0),
(99, '10152584528231125', 'elmxyILSYZ', 0, 0, 0, 1, 0, 'def main():\n    x = int(raw_input())\n    print x*x\n    return\n\nmain()', 0),
(100, '795471103808592', 'elmxyILSYZ', 0, 0, 0, 1, 0, '', 0),
(101, '10152584528231125', 'dmuvwxNTZ9', 0, 0, 0, 1, 0, '#include <iostream>\nusing namespace std;\nint main() { \n    cout << "Hello" << endl;\n    return 0;\n    \n}', 0),
(102, '795471103808592', 'dmuvwxNTZ9', 0, 0, 0, 3, 0, '', 0),
(103, '694366633945862', 'bceopsuwBG', 20, 0, 0, 3, 3, '<?php\n\necho "aaaaaaaaaa";\n\n?>', 1),
(104, '795471103808592', 'bceopsuwBG', 0, 0, 0, 3, 0, '', 0),
(105, '694366633945862', 'acgvCNOS78', 10, 0, 0, 1, 3, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 1),
(106, '694366633945862', 'dtIJNU1268', 0, 0, 0, 2, 0, '#include <iostream>\r\nusing namespace std;\r\n\r\n\r\n#include <iostream>\r\nusing namespace std;\r\nint main() {\r\n    int i = 6;\r\n    cout << 2*i;\r\n    return 0;\r\n}', 0),
(107, '10152584528231125', 'acgvCNOS78', 0, 0, 0, 1, 0, '', 0),
(108, '10152584528231125', 'gjtBGMQTUW', 0, 0, 0, 1, 1, '#include <iostream>\nusing namespace std;\nint main() {\n    cout << "Hello world" << endl;\n    return 0;\n    \n}', 0),
(109, '795471103808592', 'gjtBGMQTUW', 0, 0, 0, 1, 0, 'klihg/ hkklb', 0),
(110, '10152584528231125', 'cjrDEHMX29', 0, 0, 0, 1, 1, '', 0),
(111, '10152584528231125', 'deoqyAEIRS', 0, 0, 0, 2, 1, '', 0),
(112, '25252', 'abdgDGJQRX', 20, 0, 0, 3, 3, '#include <iostream> \nusing namespace std;\n\nint main() {\n   cout << "aaaaaaaaaa";\n}', 1),
(113, '694366633945862', 'abdgDGJQRX', 10, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(114, '694366633945862', 'kqrtzEOW06', 10, 0, 0, 1, 4, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 1),
(115, '25252', 'kqrtzEOW06', 0, 0, 0, 2, 0, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(116, '10152584528231125', 'eosBNY5679', 0, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello" << endl;\n    return 0;\n}', 0),
(117, '795471103808592', 'eosBNY5679', 0, 0, 0, 1, 0, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(118, '10152584528231125', 'mrswBORSU1', 0, 0, 0, 2, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello world" << endl;\n    return 0;\n}', 0),
(119, '795471103808592', 'mrswBORSU1', 0, 0, 0, 1, 0, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(120, '10152584528231125', 'fluyJLOV35', 2, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}ch', 0),
(121, '795471103808592', 'fluyJLOV35', 2, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(122, '694366633945862', 'nvDHIKQS27', 29, 0, 0, 3, 4, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << 10;\n}', 1),
(123, '10152584528231125', 'nvDHIKQS27', 1, 0, 0, 3, 1, '', 0),
(124, '25252', 'aosAPRUXY2', 2, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n    sdfh\n    dfh\n    dfh\n    dfh\n    dfh\n    fdh\n    dfh\n    fdh\n    fdh\n    fh\n}', 0),
(125, '694366633945862', 'aosAPRUXY2', 2, 0, 0, 3, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n    bROSIOJDJIOSUDFJIODJFIOJ\n}', 0),
(126, '10152584528231125', 'antuFJRXZ3', 2, 0, 0, 2, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello world!" << endl;\n    return 0;\n}', 0),
(127, '795471103808592', 'antuFJRXZ3', 0, 0, 0, 3, 1, '', 0),
(128, '694366633945862', 'efopMWZ017', 11, 0, 0, 2, 2, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "aaaaaaaaa";\n    fdg\n    dfg\n    dfg\n    dfg\n    dfg\n    \n}', 0),
(129, '10152584528231125', 'efopMWZ017', 0, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello" << endl;\n    return 0;\n}', 0),
(130, '10152584528231125', 'gklptHNQR0', 2, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello world" << endl;\n    return 0;\n}', 0),
(131, '795471103808592', 'gklptHNQR0', 0, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0),
(132, '10152584528231125', 'gqFGMPTWX4', 2, 0, 0, 4, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    cout << "Hello world!" << endl;\n    return 0;\n}', 0),
(133, '795471103808592', 'gqFGMPTWX4', 0, 0, 0, 1, 1, '#include <iostream> \nusing namespace std;\n\nint main() {\n    return 0;\n}', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `powerDowns`
--

INSERT INTO `powerDowns` (`id`, `playerID`, `battleID`, `type`) VALUES
(1, '436346', 'ajruvyIS17', 'popup'),
(15, '694366633945862', 'qstvyDHOT4', 'popup'),
(16, '694366633945862', 'qstvyDHOT4', 'popup'),
(17, '694366633945862', 'fltCJUVY18', 'flip'),
(18, '694366633945862', 'fltCJUVY18', 'snip'),
(19, '694366633945862', 'fltCJUVY18', 'freeze'),
(20, '694366633945862', 'fltCJUVY18', 'blur'),
(21, '694366633945862', 'fltCJUVY18', 'popup'),
(22, '694366633945862', 'qstvyDHOT4', 'popup'),
(28, '795471103808592', 'ekyCHITUYZ', 'popup'),
(29, '795471103808592', 'ekyCHITUYZ', 'snip'),
(30, '10152584528231125', 'jmnquEU459', 'popup'),
(31, '795471103808592', 'jmnquEU459', 'blur'),
(32, '795471103808592', 'jmnquEU459', 'snip'),
(33, '10152584528231125', 'dqsHPQTX17', 'popup'),
(34, '795471103808592', 'dqsHPQTX17', 'popup'),
(35, '10152584528231125', 'dqsHPQTX17', 'blur'),
(36, '795471103808592', 'dqsHPQTX17', 'popup'),
(37, '795471103808592', 'dqsHPQTX17', 'snip'),
(38, '795471103808592', 'dqsHPQTX17', 'flip'),
(39, '10152584528231125', 'dqsHPQTX17', 'popup'),
(40, '10152584528231125', 'dqsHPQTX17', 'popup'),
(41, '10152584528231125', 'dqsHPQTX17', 'popup'),
(42, '10152584528231125', 'dqsHPQTX17', 'popup'),
(43, '10152584528231125', 'dqsHPQTX17', 'popup'),
(44, '10152584528231125', 'dqsHPQTX17', 'popup'),
(45, '10152584528231125', 'dqsHPQTX17', 'blur'),
(46, '10152584528231125', 'dqsHPQTX17', 'blur'),
(47, '10152584528231125', 'dqsHPQTX17', 'blur'),
(48, '10152584528231125', 'dqsHPQTX17', 'freeze'),
(49, '10152584528231125', 'dqsHPQTX17', 'freeze'),
(50, '10152584528231125', 'dqsHPQTX17', 'freeze'),
(51, '10152584528231125', 'dqsHPQTX17', 'snip'),
(52, '10152584528231125', 'dqsHPQTX17', 'snip'),
(53, '10152584528231125', 'dqsHPQTX17', 'flip'),
(54, '10152584528231125', 'dqsHPQTX17', 'snip'),
(55, '10152584528231125', 'dqsHPQTX17', 'flip'),
(56, '10152584528231125', 'dqsHPQTX17', 'flip'),
(57, '10152584528231125', 'dqsHPQTX17', 'flip'),
(58, '795471103808592', 'dqsHPQTX17', 'snip'),
(59, '10152584528231125', 'dqsHPQTX17', 'popup'),
(60, '10152584528231125', 'dqsHPQTX17', 'popup'),
(61, '10152584528231125', 'dqsHPQTX17', 'popup'),
(62, '10152584528231125', 'dqsHPQTX17', 'popup'),
(63, '10152584528231125', 'dqsHPQTX17', 'blur'),
(64, '10152584528231125', 'dqsHPQTX17', 'blur'),
(65, '10152584528231125', 'dqsHPQTX17', 'blur'),
(66, '10152584528231125', 'dqsHPQTX17', 'blur'),
(67, '10152584528231125', 'dqsHPQTX17', 'snip'),
(68, '10152584528231125', 'dqsHPQTX17', 'snip'),
(69, '10152584528231125', 'dqsHPQTX17', 'flip'),
(70, '10152584528231125', 'dqsHPQTX17', 'flip'),
(71, '10152584528231125', 'dorCGLUZ12', 'flip'),
(72, '10152584528231125', 'jmnquEU459', 'flip'),
(73, '10152584528231125', 'jmnquEU459', 'blur'),
(74, '795471103808592', 'acBHJOS137', 'popup'),
(75, '795471103808592', 'acBHJOS137', 'popup'),
(76, '795471103808592', 'acBHJOS137', 'blur'),
(77, '10152584528231125', 'acBHJOS137', 'popup'),
(78, '10152584528231125', 'acBHJOS137', 'blur'),
(79, '10152584528231125', 'acBHJOS137', 'snip'),
(80, '795471103808592', 'acBHJOS137', 'popup'),
(81, '795471103808592', 'acBHJOS137', 'popup'),
(82, '10152584528231125', 'hjptyHIUW7', 'popup'),
(83, '10152584528231125', 'nvzBERTY58', 'popup'),
(84, '10152584528231125', 'nvzBERTY58', 'blur'),
(85, '10152584528231125', 'nvzBERTY58', 'freeze'),
(86, '10152584528231125', 'nvzBERTY58', 'snip'),
(87, '10152584528231125', 'nvzBERTY58', 'flip'),
(88, '10152584528231125', 'nvzBERTY58', 'popup'),
(89, '795471103808592', 'biqACEMU24', 'popup'),
(90, '795471103808592', 'biqACEMU24', 'popup'),
(91, '795471103808592', 'biqACEMU24', 'popup'),
(92, '795471103808592', 'fxDNOPXZ46', 'popup'),
(93, '795471103808592', 'alHIRXY235', 'blur'),
(94, '10152584528231125', 'alHIRXY235', 'popup'),
(95, '795471103808592', 'emnoBFL189', 'popup'),
(96, '795471103808592', 'emnoBFL189', 'freeze'),
(97, '10152584528231125', 'emnoBFL189', 'popup'),
(98, '10152584528231125', 'emnoBFL189', 'blur'),
(99, '795471103808592', 'emnoBFL189', 'flip'),
(100, '795471103808592', 'emnoBFL189', 'blur'),
(101, '795471103808592', 'elmxyILSYZ', 'popup'),
(102, '795471103808592', 'elmxyILSYZ', 'popup'),
(103, '10152584528231125', 'dmuvwxNTZ9', 'popup'),
(104, '795471103808592', 'gjtBGMQTUW', 'popup'),
(105, '10152584528231125', 'gjtBGMQTUW', 'popup'),
(106, '10152584528231125', 'acgvCNOS78', 'blur'),
(107, '10152584528231125', 'acgvCNOS78', 'popup'),
(108, '10152584528231125', 'acgvCNOS78', 'blur'),
(109, '10152584528231125', 'acgvCNOS78', 'popup');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `Description`, `Example`, `testCases`, `acceptedOutput`) VALUES
(1, 'Given an integer ''x'', return the square value of ''x''.', '3 &rarr; 9, 5 &rarr; 25, 10 &rarr; 100', '3,25,500,0', '9,625,250000,0'),
(2, 'Given a char ''c'', return a string that contains that char 10 times.', 'a &rarr; aaaaaaaaaa,A &rarr; AAAAAAAAAA', 'a,b,E,!,0', 'aaaaaaaaaa,bbbbbbbbbb,EEEEEEEEEE,!!!!!!!!!!,0000000000'),
(3, 'Given an string ''s'', reverse it', '''abc'' &rarr; ''cba'', ''Racecar'' &rarr; ''racecaR''', 'abc,Racecar,Ae!2', 'cba, racecaR, 2!eA'),
(4, 'Given an string of space separated integers, add them.', '"1 2 3 4" &rarr; 10', '"1 2 3 4", "10, 10, 10", "50"', '10, 30, 50'),
(5, 'Given an integer ''x'', return the double value of ''x''.', '1 &rarr; 2, 5 &rarr; 10, 100 &rarr; 200', '1,10,500,0', '2,20,1000,0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
