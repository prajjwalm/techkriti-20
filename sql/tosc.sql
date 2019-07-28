-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2019 at 09:34 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techkriti_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tosc`
--

CREATE TABLE `tosc` (
  `name` varchar(255) NOT NULL,
  `team` varchar(15) NOT NULL,
  `techid` mediumint(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `psd_hash` varchar(255) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `mob` varchar(31) NOT NULL,
  `male` tinyint(1) NOT NULL,
  `grade` tinyint(3) UNSIGNED NOT NULL,
  `school` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `school_addr` varchar(255) NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `txnid` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tosc`
--
ALTER TABLE `tosc`
  ADD PRIMARY KEY (`techid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `techid` (`techid`),
  ADD KEY `techid_2` (`techid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tosc`
--
ALTER TABLE `tosc`
  MODIFY `techid` mediumint(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
