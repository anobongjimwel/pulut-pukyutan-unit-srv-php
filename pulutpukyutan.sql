-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 01:28 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pulutpukyutan`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `prefName` varchar(500) NOT NULL,
  `prefValue` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`prefName`, `prefValue`) VALUES
('biodegCount', '4'),
('biodegMaxCount', '0'),
('bio_operational', '1'),
('fullname', 'Jimwel Anobong'),
('nonbioCount', '1'),
('nonbioMaxCount', '0'),
('non_operational', '1'),
('password', '$2y$10$jOJdpTTTquchHXuIyOA6xOoHkFTrswGstMmBT0KCEoG25V31LyLn6'),
('schedules', '1, 2'),
('subtitle', 'Chief Operations Officer'),
('unspecCount', '80'),
('unspecMaxCount', '0'),
('uns_operational', '1'),
('username', 'jtAnobong');

-- --------------------------------------------------------

--
-- Table structure for table `wasteobjects`
--

CREATE TABLE `wasteobjects` (
  `objectName` varchar(250) DEFAULT NULL,
  `objectType` char(17) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `objectLink` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wasteobjects`
--

INSERT INTO `wasteobjects` (`objectName`, `objectType`, `dateAdded`, `objectLink`) VALUES
('bottle', 'non-biodegradable', '2018-10-08 05:08:32', NULL),
('bottle', 'non-biodegradable', '2018-10-08 05:09:48', NULL),
('banana peel', 'biodegradable', '2018-10-08 05:10:21', NULL),
('apple peel', 'biodegradable', '2018-10-08 05:13:25', NULL),
('atis peel', 'biodegradable', '2018-10-08 05:13:41', NULL),
('orange peel', 'biodegradable', '2018-10-08 05:13:50', NULL),
('grape peel', 'non-biodegradable', '2018-10-08 05:24:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`prefName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
