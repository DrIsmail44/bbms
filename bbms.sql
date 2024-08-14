-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2020 at 01:50 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

CREATE TABLE `calculations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `building_type` varchar(100) NOT NULL,
  `calculations` text NOT NULL,
  `total` int(11) NOT NULL,
  `last_edited` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calculations`
--

INSERT INTO `calculations` (`id`, `client_id`, `owner_id`, `building_type`, `calculations`, `total`, `last_edited`) VALUES
(2, 3, 1, 'Duplex', 'O:8:\"stdClass\":4:{s:12:\"calculations\";a:2:{i:0;O:8:\"stdClass\":5:{s:8:\"category\";s:7:\"windows\";s:5:\"total\";i:12500;s:8:\"unitCost\";i:500;s:4:\"name\";s:9:\"Aluminium\";s:3:\"qty\";i:25;}i:1;O:8:\"stdClass\":5:{s:8:\"category\";s:5:\"Doors\";s:5:\"total\";i:25000;s:8:\"unitCost\";i:1000;s:4:\"name\";s:5:\"Slide\";s:3:\"qty\";i:25;}}s:9:\"totalCost\";i:37500;s:8:\"comments\";s:62:\"Its was nice having a contract with you Engr. Musa D Abdullahi\";s:6:\"others\";O:8:\"stdClass\":3:{s:9:\"client_id\";s:1:\"3\";s:13:\"building_type\";s:6:\"Duplex\";s:5:\"flats\";s:1:\"3\";}}', 37500, '2020-06-30 01:01:12'),
(3, 3, 1, 'Bungalow', 'O:8:\"stdClass\":4:{s:12:\"calculations\";a:2:{i:0;O:8:\"stdClass\":5:{s:8:\"category\";s:5:\"Doors\";s:5:\"total\";i:3000;s:8:\"unitCost\";i:1000;s:4:\"name\";s:5:\"Slide\";s:3:\"qty\";i:3;}i:1;O:8:\"stdClass\":5:{s:8:\"category\";s:3:\"POP\";s:5:\"total\";i:3000;s:8:\"unitCost\";i:1000;s:4:\"name\";s:4:\"POP1\";s:3:\"qty\";i:3;}}s:9:\"totalCost\";i:6000;s:8:\"comments\";s:27:\"This is without workmanship\";s:6:\"others\";O:8:\"stdClass\":3:{s:9:\"client_id\";s:1:\"3\";s:13:\"building_type\";s:8:\"Bungalow\";s:5:\"flats\";s:1:\"3\";}}', 6000, '2020-08-18 02:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `reg_by` varchar(200) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `phone`, `email`, `reg_by`, `date_registered`) VALUES
(3, 'Musa D Abdullahi', '08036910033', 'engrmusadenice@gmail.com', 'admin', '2020-06-29 17:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(400) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `name`, `password`, `type`) VALUES
(1, 'admin', 'Ismail DIDA', '1234', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` varchar(100) NOT NULL,
  `variety` text NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `name`, `category`, `variety`, `owner`) VALUES
(5, 'windows', 'Roofing', 'O:8:\"stdClass\":3:{s:5:\"vData\";a:3:{i:0;O:8:\"stdClass\":2:{s:4:\"name\";s:5:\"Slide\";s:4:\"cost\";s:4:\"2000\";}i:1;O:8:\"stdClass\":2:{s:4:\"name\";s:7:\"wooding\";s:4:\"cost\";s:4:\"1000\";}i:2;O:8:\"stdClass\":2:{s:4:\"name\";s:9:\"Aluminium\";s:4:\"cost\";s:3:\"500\";}}s:5:\"other\";s:7:\"Roofing\";s:12:\"materialName\";s:7:\"windows\";}', 1),
(6, 'Doors', 'Roofing', 'O:8:\"stdClass\":3:{s:5:\"vData\";a:3:{i:0;O:8:\"stdClass\":2:{s:4:\"name\";s:5:\"Slide\";s:4:\"cost\";s:4:\"1000\";}i:1;O:8:\"stdClass\":2:{s:4:\"name\";s:7:\"wooding\";s:4:\"cost\";s:4:\"2000\";}i:2;O:8:\"stdClass\":2:{s:4:\"name\";s:9:\"Aluminium\";s:4:\"cost\";s:3:\"500\";}}s:5:\"other\";s:7:\"Roofing\";s:12:\"materialName\";s:5:\"Doors\";}', 1),
(7, 'POP', 'Ceiling', 'O:8:\"stdClass\":3:{s:5:\"vData\";a:2:{i:0;O:8:\"stdClass\":2:{s:4:\"name\";s:4:\"POP1\";s:4:\"cost\";s:4:\"1000\";}i:1;O:8:\"stdClass\":2:{s:4:\"name\";s:4:\"POP2\";s:4:\"cost\";s:4:\"1500\";}}s:5:\"other\";s:7:\"Ceiling\";s:12:\"materialName\";s:3:\"POP\";}', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculations`
--
ALTER TABLE `calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calculations_ibfk_1` (`client_id`),
  ADD KEY `calculations_ibfk_2` (`owner_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `reg_by` (`reg_by`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calculations`
--
ALTER TABLE `calculations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calculations`
--
ALTER TABLE `calculations`
  ADD CONSTRAINT `calculations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `calculations_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `login` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`reg_by`) REFERENCES `login` (`username`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`owner`) REFERENCES `login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
