-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2018 at 12:36 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
('biodegCount', '0'),
('biodegMaxCount', '0'),
('bio_operational', '1'),
('fullname', 'Jimwel Anobong'),
('msg_accessToken', 'CVbDBhFYq3uBPb4rK3T-pYYG8idbVOo_x6I7YGM6qDc'),
('msg_append_items', '1'),
('msg_service', '0'),
('msg_subscriberNumber', '09357267168'),
('nonbioCount', '0'),
('nonbioMaxCount', '0'),
('non_operational', '1'),
('password', '$2y$10$jOJdpTTTquchHXuIyOA6xOoHkFTrswGstMmBT0KCEoG25V31LyLn6'),
('schedules', '1, 2'),
('subtitle', 'Chief Operations Officer'),
('unspecCount', '123'),
('unspecMaxCount', '123'),
('uns_operational', '1'),
('username', 'jtAnobong');

-- --------------------------------------------------------

--
-- Table structure for table `wasteobjects`
--

CREATE TABLE `wasteobjects` (
  `objectName` varchar(250) NOT NULL,
  `objectType` char(17) DEFAULT NULL,
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wasteobjects`
--

INSERT INTO `wasteobjects` (`objectName`, `objectType`, `dateAdded`) VALUES
('1231231331', 'unspecified', '2018-10-14 00:41:43'),
('Test 12312321321', 'unspecified', '2018-10-14 00:40:53'),
('Test Object', 'unspecified', '2018-10-14 00:30:04'),
('Test object 1231231231231313', 'unspecified', '2018-10-14 00:46:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`prefName`);

--
-- Indexes for table `wasteobjects`
--
ALTER TABLE `wasteobjects`
  ADD PRIMARY KEY (`objectName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
