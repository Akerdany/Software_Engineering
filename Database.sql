-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2019 at 07:40 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address`, `parent_id`) VALUES
(1, 'base', 1),
(2, 'Egypt', 1),
(3, 'Cairo', 2),
(4, 'Nasr City', 3),
(5, 'Makram', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ccd`
--

DROP TABLE IF EXISTS `ccd`;
CREATE TABLE IF NOT EXISTS `ccd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courtId` int(11) NOT NULL,
  `courtDetailsId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courtId` (`courtId`),
  KEY `courtDetailsId` (`courtDetailsId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ccd`
--

INSERT INTO `ccd` (`id`, `courtId`, `courtDetailsId`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

DROP TABLE IF EXISTS `court`;
CREATE TABLE IF NOT EXISTS `court` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courtNumber` varchar(100) NOT NULL,
  `sportId` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sportId` (`sportId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `courtNumber`, `sportId`, `price`) VALUES
(1, '1', 1, 50),
(2, '2', 1, 70);

-- --------------------------------------------------------

--
-- Table structure for table `courtdetails`
--

DROP TABLE IF EXISTS `courtdetails`;
CREATE TABLE IF NOT EXISTS `courtdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specs` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courtdetails`
--

INSERT INTO `courtdetails` (`id`, `specs`) VALUES
(1, 'Clay'),
(2, 'Grass');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL COMMENT 'Title of the event',
  `date` date NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `link`, `pageName`, `userTypeId`) VALUES
(3, 'https://www.facebook.com/', 'Facebook.com', 1),
(4, 'https://twitter.com/', 'Twitter.com', 1),
(5, 'https://www.facebook.com/', 'Facebook.com', 2),
(6, 'https://twitter.com/', 'Twitter.com', 3),
(7, 'https://www.google.com/', 'Google.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `previliges`
--

DROP TABLE IF EXISTS `previliges`;
CREATE TABLE IF NOT EXISTS `previliges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeId` int(11) NOT NULL,
  `featureId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`),
  KEY `optionId` (`featureId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `courtId` int(11) NOT NULL,
  `reservationDetailsId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservationDetailsId` (`reservationDetailsId`),
  KEY `courtId` (`courtId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `userId`, `courtId`, `reservationDetailsId`) VALUES
(1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

DROP TABLE IF EXISTS `reservationdetails`;
CREATE TABLE IF NOT EXISTS `reservationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `supervisorId` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supervisorId` (`supervisorId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`id`, `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES
(1, '2019-02-11', '02:00:00', '04:00:00', 4, 'player', 50);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

DROP TABLE IF EXISTS `sports`;
CREATE TABLE IF NOT EXISTS `sports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`) VALUES
(1, 'Tennis');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `dateOfBirth` date NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `ssn` varchar(14) NOT NULL,
  `addressId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`),
  KEY `address_id` (`addressId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `telephone`, `ssn`, `addressId`, `userTypeId`) VALUES
(1, 'test1', 'test1', 'test', 'pass', '0111-11-11', '', '', 2, 3),
(3, 'hello', 'hello', 'hello', '$2y$10$Zm.1tm4yXUlitqpvwY//yeGnbXeEqA8hyLw/OrwYIXyHpZy2ILjQ6', '1111-11-11', '', '', 2, 4),
(4, 'admin', 'admin', 'admin', '$2y$10$EVyYxauio/qK6uysFBjtO.n7a1wf6NeBdzjsOEOiIzo1DYGEVQiQe', '1111-11-11', '', '', 2, 1),
(5, '', 'aa', 'aa', '$2y$10$piv8sfS2caynSYamyO70b.jv78RwdUbIfK0XUPz1DSBLZGwBz0n62', '0111-11-11', '', '', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `userTypeName`) VALUES
(1, 'Admin'),
(2, 'Guest'),
(3, 'Test'),
(4, 'Emp');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `ccd`
--
ALTER TABLE `ccd`
  ADD CONSTRAINT `ccd_ibfk_1` FOREIGN KEY (`courtDetailsId`) REFERENCES `courtdetails` (`id`),
  ADD CONSTRAINT `ccd_ibfk_2` FOREIGN KEY (`courtId`) REFERENCES `court` (`id`);

--
-- Constraints for table `court`
--
ALTER TABLE `court`
  ADD CONSTRAINT `court_ibfk_1` FOREIGN KEY (`sportId`) REFERENCES `sports` (`id`);

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`);

--
-- Constraints for table `previliges`
--
ALTER TABLE `previliges`
  ADD CONSTRAINT `previliges_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `previliges_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `features` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`courtId`) REFERENCES `court` (`id`),
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`reservationDetailsId`) REFERENCES `reservationdetails` (`id`);

--
-- Constraints for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD CONSTRAINT `reservationDetails_ibfk_1` FOREIGN KEY (`supervisorId`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`addressId`) REFERENCES `address` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
