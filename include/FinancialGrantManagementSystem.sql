-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 12:52 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `FinancialGrantManagementSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `AllUsers`
--
-- Creation: Mar 08, 2016 at 09:35 AM
--

CREATE TABLE IF NOT EXISTS `AllUsers` (
  `RollNumber` varchar(20) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Role` varchar(20) DEFAULT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'Unregistered',
  `Password` varchar(25) DEFAULT NULL,
  `Accessor` varchar(20) DEFAULT NULL,
  `Requester` varchar(20) DEFAULT NULL,
  `Justification` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AllUsers`
--

INSERT INTO `AllUsers` (`RollNumber`, `Name`, `EmailId`, `Role`, `Status`, `Password`, `Accessor`, `Requester`, `Justification`) VALUES
('UG201310003', 'Abhay Kumar Singh', 'ug201310003@iitj.ac.in', 'Admin1', 'Registered', 'abhay', NULL, NULL, ''),
('UG201313008', 'Deepshi Garg', 'ug201313008@iitj.ac.in', 'Admin2', 'Registered', 'deepshi', NULL, NULL, ''),
('UG201310016', 'Sai Raghav', 'ug201310016@iitj.ac.in', 'Faculty', 'Registered', 'raghav', NULL, NULL, ''),
('UG201310005', 'Amit Jain', 'ug201310005@iitj.ac.in', 'PhD', 'Registered', 'amit', 'UG201310002', NULL, NULL),
('UG201310004', 'Aman Singh', 'ug201310004@iitj.ac.in', 'MTech', 'Registered', 'aman', 'UG201310002', NULL, NULL),
('UG201310002', 'Aayush Sharda', 'ug201310002@iitj.ac.in', 'Faculty', 'Registered', 'aayush', NULL, NULL, ''),
('UG201310010', 'Avan', 'ug201310010@iitj.ac.in', 'PhD', 'Registered', 'avan', NULL, NULL, ''),
('UG201310033', 'Shubham Saxena', 'ug201310033@iitj.ac.in', 'MTech', 'Registered', 'shubham', NULL, NULL, ''),
('UG201312001', 'Aditya Saxena', 'ug201312001@iitj.ac.in', 'MTech', 'Registered', 'chandana', NULL, NULL, ''),
('UG201310009', 'Arnav Jindal', 'ug201310009@iitj.ac.in', 'Faculty', 'Registered', 'arnav', NULL, NULL, ''),
('UG201310025', NULL, 'ug201310025@iitj.acin', 'MTech', 'Unregistered', NULL, NULL, NULL, NULL),
('UG201313010', 'Sangram', 'ug201313010@iitj.ac.in', 'PhD', 'Registered', 'sangram', NULL, NULL, NULL),
('UG201311019', 'Kanika', 'ug201311019@iitj.ac.in', 'PhD', 'Registered', 'kanika', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `GrantDetails`
--
-- Creation: Mar 01, 2016 at 06:46 AM
--

CREATE TABLE IF NOT EXISTS `GrantDetails` (
  `GrantID` int(11) NOT NULL AUTO_INCREMENT,
  `RollNumber` varchar(20) DEFAULT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Justification` varchar(200) DEFAULT NULL,
  `AmountRequested` bigint(20) DEFAULT NULL,
  `AmountApproved` bigint(20) DEFAULT NULL,
  `RequestDate` date DEFAULT NULL,
  `ApprovalDate` date DEFAULT NULL,
  `SettlementDate` date DEFAULT NULL,
  `GrantStatus` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`GrantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `GrantDetails`
--

INSERT INTO `GrantDetails` (`GrantID`, `RollNumber`, `Type`, `Justification`, `AmountRequested`, `AmountApproved`, `RequestDate`, `ApprovalDate`, `SettlementDate`, `GrantStatus`) VALUES
(71, 'UG201310002', 'Travel Allowances', 'Conference in IITB', 12345, 12345, '2016-03-09', '2016-03-09', NULL, 'Unsettled'),
(72, 'UG201310005', 'Resources', 'Stationary', 120, NULL, '2016-03-09', NULL, NULL, 'Admin2_Rejected'),
(74, 'UG201310005', 'Resources', 'Printer', 2000, NULL, '2016-03-09', NULL, NULL, 'Admin2_Approved'),
(75, 'UG201310004', 'Travel Allowances', 'Germany DAAD', 2400, NULL, '2016-03-09', NULL, NULL, 'Cancelled'),
(76, 'UG201313010', 'Resources', 'New Research', 12345, 123, '2016-03-09', '2016-03-09', NULL, 'Unsettled'),
(77, 'UG201310002', 'Travel Allowances', 'feadsxcv ', 1234, 1000, '2016-03-10', '2016-03-10', '2016-03-10', 'Settled');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
