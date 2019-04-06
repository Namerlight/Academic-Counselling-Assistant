-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 08:54 PM
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
-- Database: `aca`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `average_annual_living_cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country`, `average_annual_living_cost`) VALUES
('Argentina', '6000'),
('Australia', '20571'),
('Belgium', '10000'),
('Canada', '17000'),
('China', '2700'),
('Denmark', '28000'),
('France', '20667'),
('Germany', '13667'),
('Hong Kong', '6600'),
('Japan', '14720'),
('Leeds', '13000'),
('Malaysia', '5600'),
('Netherlands', '11667'),
('New Zealand', '22500'),
('Russia', '2200'),
('Singapore', '17150'),
('South Korea', '4720'),
('Sweden', '9600'),
('Switzerland', '19667'),
('Taiwan', '3000'),
('United Kingdom', '13529'),
('United States', '15930');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
