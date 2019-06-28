-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2019 at 12:27 PM
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
-- Table structure for table `ca`
--

CREATE TABLE `ca` (
  `name` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `userid` bigint(255) UNSIGNED NOT NULL,
  `mobile` varchar(31) NOT NULL,
  `whatsapp` varchar(31) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `addr` varchar(1022) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `dname` varchar(255) NOT NULL,
  `dno` varchar(31) DEFAULT NULL,
  `demail` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pno` varchar(31) DEFAULT NULL,
  `pemail` varchar(255) NOT NULL,
  `past_ex` varchar(2046) NOT NULL,
  `skill` varchar(2046) NOT NULL,
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ca`
--
ALTER TABLE `ca`
  ADD PRIMARY KEY (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
