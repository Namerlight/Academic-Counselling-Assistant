-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2019 at 10:06 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_tutorial_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `Country` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `Living_Cost` double(17,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`Country`, `Living_Cost`) VALUES
(' Argentina ', 6000),
(' Australia ', 20571),
(' Belgium ', 10000),
(' Canada ', 17000),
(' China ', 2700),
(' Denmark ', 28000),
(' France ', 20667),
(' Germany ', 13667),
(' Hong Kong ', 6600),
(' Japan ', 14720),
(' Leeds ', 13000),
(' Malaysia ', 5600),
(' Netherlands ', 11667),
(' New Zealand ', 22500),
(' Russia ', 2200),
(' Singapore ', 17150),
(' South Korea ', 4720),
(' Sweden ', 9600),
(' Switzerland ', 19667),
(' Taiwan ', 3000),
(' United Kingdom ', 13529),
(' United States ', 15930);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
