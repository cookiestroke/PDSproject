-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 03, 2020 at 04:44 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wds`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

DROP TABLE IF EXISTS `admin1`;
CREATE TABLE IF NOT EXISTS `admin1` (
  `amail` varchar(50) NOT NULL,
  `apass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`amail`, `apass`) VALUES
('admin@wds.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `ains`
--

DROP TABLE IF EXISTS `ains`;
CREATE TABLE IF NOT EXISTS `ains` (
  `hinsid` int(10) NOT NULL AUTO_INCREMENT,
  `vid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vmake` varchar(20) NOT NULL,
  `vmodel` varchar(20) NOT NULL,
  `vyear` int(4) NOT NULL,
  `vterm` int(10) NOT NULL,
  `vstat` char(1) NOT NULL,
  PRIMARY KEY (`hinsid`,`vid`),
  UNIQUE KEY `vid` (`vid`)
) ENGINE=MyISAM AUTO_INCREMENT=50018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ains`
--

INSERT INTO `ains` (`hinsid`, `vid`, `vmake`, `vmodel`, `vyear`, `vterm`, `vstat`) VALUES
(50016, '1234567893', 'Honda', 'City', 2013, 56, 'F'),
(50013, '1234567891', 'Toyota', 'Subaru', 2013, 95, 'O'),
(50013, '1234567892', 'Honda', 'Civic', 2009, 30, 'L'),
(50016, '1234567894', 'Mazda', 'Scorpio', 2011, 25, 'F'),
(50017, '1234567895', 'Infernus', 'Z', 1992, 21, 'O');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cmail` varchar(50) NOT NULL,
  `cfirst` varchar(30) NOT NULL,
  `clast` varchar(30) NOT NULL,
  `czip` varchar(30) NOT NULL,
  `cpass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cmar` char(1) NOT NULL,
  `cgen` char(1) NOT NULL,
  PRIMARY KEY (`cmail`),
  UNIQUE KEY `cmail` (`cmail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cmail`, `cfirst`, `clast`, `czip`, `cpass`, `cmar`, `cgen`) VALUES
('a@a.a', 'Manny', 'Mandark', '11218', '25f9e794323b453885f5181f1b624d0b', 'W', 'M'),
('bj@gmail.com', 'Bimmy', 'Jimmy', '10010', '25f9e794323b453885f5181f1b624d0b', 'M', 'M'),
('vicetommy@hotmail.com', 'Tommy', 'Vercetti', '33101', '6ebe76c9fb411be97b3b0d48b791a7c9', 'M', 'M'),
('cj@gmail.com', 'Carl', 'Johnson', '90059', '58b4e38f66bcdb546380845d6af27187', 'S', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
CREATE TABLE IF NOT EXISTS `driver` (
  `dlicen` varchar(10) NOT NULL,
  `dfname` varchar(30) NOT NULL,
  `dlname` varchar(30) NOT NULL,
  `dbdate` date NOT NULL,
  PRIMARY KEY (`dlicen`),
  UNIQUE KEY `dlicen` (`dlicen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`dlicen`, `dfname`, `dlname`, `dbdate`) VALUES
('gasgasgas1', 'Takumi', 'Fujiwara', '1981-05-08'),
('cars2isbad', 'Lightning', 'McQueen', '2000-09-01'),
('mach5speed', 'Speed', 'Racer', '1966-06-01'),
('trains1234', 'Thomas', 'Tank', '1995-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `drivveh`
--

DROP TABLE IF EXISTS `drivveh`;
CREATE TABLE IF NOT EXISTS `drivveh` (
  `dlicen` varchar(10) NOT NULL,
  `vid` varchar(20) NOT NULL,
  PRIMARY KEY (`dlicen`,`vid`),
  UNIQUE KEY `dlicen` (`dlicen`,`vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drivveh`
--

INSERT INTO `drivveh` (`dlicen`, `vid`) VALUES
('cars2isbad', '1234567891'),
('cars2isbad', '1234567893'),
('gasgasgas1', '1234567891'),
('gasgasgas1', '1234567892'),
('mach5speed', '1234567895');

-- --------------------------------------------------------

--
-- Table structure for table `hins`
--

DROP TABLE IF EXISTS `hins`;
CREATE TABLE IF NOT EXISTS `hins` (
  `hinsid` int(10) NOT NULL AUTO_INCREMENT,
  `hid` varchar(10) NOT NULL,
  `purval` float NOT NULL,
  `harea` int(11) NOT NULL,
  `htype` char(1) NOT NULL,
  `swim` char(1) NOT NULL,
  `basement` char(1) NOT NULL,
  `hsec` char(1) NOT NULL,
  `afire` char(1) NOT NULL,
  `purdate` date NOT NULL,
  `iterm` int(10) NOT NULL,
  PRIMARY KEY (`hinsid`,`hid`),
  UNIQUE KEY `hid` (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=10027 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hins`
--

INSERT INTO `hins` (`hinsid`, `hid`, `purval`, `harea`, `htype`, `swim`, `basement`, `hsec`, `afire`, `purdate`, `iterm`) VALUES
(10023, '1asx123456', 12000, 200, 'C', 'M', '0', '1', '1', '2020-04-08', 12),
(10025, '1adad56127', 12000, 2000, 'S', 'N', '0', '0', '0', '2007-05-09', 65),
(10025, '1adad56122', 120000, 1000, 'T', 'O', '1', '1', '1', '2018-05-02', 65),
(10026, '1adad56128', 50000, 2000, 'M', 'U', '0', '0', '0', '1988-02-03', 123),
(10026, '1adad56129', 60000, 2000, 'S', 'I', '1', '1', '1', '1998-05-06', 78);

-- --------------------------------------------------------

--
-- Table structure for table `ins`
--

DROP TABLE IF EXISTS `ins`;
CREATE TABLE IF NOT EXISTS `ins` (
  `hinsid` int(10) NOT NULL,
  `cmail` varchar(50) NOT NULL,
  `istart` date NOT NULL,
  `iend` date NOT NULL,
  `iprem` float NOT NULL,
  `itype` char(1) NOT NULL,
  `istatus` char(1) NOT NULL,
  PRIMARY KEY (`hinsid`,`cmail`),
  UNIQUE KEY `hinsid` (`hinsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ins`
--

INSERT INTO `ins` (`hinsid`, `cmail`, `istart`, `iend`, `iprem`, `itype`, `istatus`) VALUES
(10025, 'bj@gmail.com', '2020-05-02', '2025-10-02', 161.862, 'H', 'P'),
(50013, 'a@a.a', '2020-04-30', '2025-09-30', 138.237, 'A', 'P'),
(50016, 'bj@gmail.com', '2020-05-02', '2025-01-02', 133.243, 'A', 'P'),
(10023, 'a@a.a', '2020-02-24', '2021-04-30', 463.33, 'H', 'P'),
(10026, 'cj@gmail.com', '2020-05-03', '2030-08-03', 136.492, 'H', 'P'),
(50017, 'cj@gmail.com', '2020-05-03', '2022-02-03', 165.714, 'A', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `hinsid` int(10) NOT NULL,
  `invdate` date NOT NULL,
  `invamt` float NOT NULL,
  `duedate` date NOT NULL,
  `invmeth` varchar(6) NOT NULL,
  PRIMARY KEY (`hinsid`,`invdate`)
) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
