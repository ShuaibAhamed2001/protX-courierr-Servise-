-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2023 at 03:20 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seller managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankd`
--

DROP TABLE IF EXISTS `bankd`;
CREATE TABLE IF NOT EXISTS `bankd` (
  `Account_No` int(11) NOT NULL,
  `Branch` varchar(50) NOT NULL,
  `Bank_Name` varchar(50) NOT NULL,
  `Account_holder` varchar(80) NOT NULL,
  `Bank_Statement` varchar(100) NOT NULL,
  PRIMARY KEY (`Account_No`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `SellerID` int(11) NOT NULL AUTO_INCREMENT,
  `Sellername` varchar(50) NOT NULL,
  `Phone_no` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ownerNIC` varchar(15) NOT NULL,
  `Businessregistration_no` varchar(15) NOT NULL,
  `warehouse_address` varchar(100) NOT NULL,
  `New_Password` varchar(8) NOT NULL,
  `ShopLink` varchar(500) NOT NULL,
  `reg_date` date DEFAULT NULL,
  PRIMARY KEY (`SellerID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SellerID`, `Sellername`, `Phone_no`, `email`, `ownerNIC`, `Businessregistration_no`, `warehouse_address`, `New_Password`, `ShopLink`, `reg_date`) VALUES
(5, 'shuaib', '0760091144', 'shuaibahamed1990@gmail.com', '20055555', '009', 'kollupitiya,Srilanka', 'aslam122', 'http/ajjg', '2023-06-04'),
(6, 'bilal', '0462221585', 'ahamednimal@gmail.com', '005252', '007', 'maradana,Srilanka', 'mjad125', 'http/aggvy', '2023-06-04'),
(3, 'abdul', '076000000', 'ffe8df7@gmail.com', '200369', '36', 'dickwalla', 'aslam', 'sddd', '2023-06-04');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
