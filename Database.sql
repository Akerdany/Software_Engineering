-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2019 at 08:17 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `ccd` (
  `id` int(11) NOT NULL,
  `courtId` int(11) NOT NULL,
  `courtDetailsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `court` (
  `id` int(11) NOT NULL,
  `courtNumber` varchar(100) NOT NULL,
  `sportId` int(11) NOT NULL,
  `price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `courtdetails` (
  `id` int(11) NOT NULL,
  `specs` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL COMMENT 'Title of the event',
  `date` date NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `details`) VALUES
(1, 'Koora', '2010-11-10', 'hanel3aab koora');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `type`) VALUES
(1, 'Name', 'text'),
(2, 'expDate', 'date');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `pageName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `link`, `pageName`) VALUES
(3, '../php/logOut.php', 'Log Out'),
(4, '../php/editUser.php', 'Edit Account');

-- --------------------------------------------------------

--
-- Table structure for table `paymentMethod`
--

CREATE TABLE `paymentMethod` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentMethodOptions`
--

CREATE TABLE `paymentMethodOptions` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `optionId` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `previliges`
--

CREATE TABLE `previliges` (
  `id` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `featureId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `P_Method_Option_Value`
--

CREATE TABLE `P_Method_Option_Value` (
  `id` int(11) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `value` text NOT NULL,
  `reservationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `courtId` int(11) NOT NULL,
  `reservationDetailsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `userId`, `courtId`, `reservationDetailsId`) VALUES
(1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

CREATE TABLE `reservationdetails` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `supervisorId` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`id`, `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES
(1, '2019-02-11', '02:00:00', '04:00:00', 4, 'player', 50);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `name`) VALUES
(1, 'Tennis');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `dateOfBirth` date NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `ssn` varchar(14) NOT NULL,
  `addressId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `telephone`, `ssn`, `addressId`, `userTypeId`, `isDeleted`) VALUES
(1, 'test1', 'test1', 'test', 'pass', '0111-11-11', '010', '111', 2, 3, 0),
(3, 'hello', 'hello', 'hello', '$2y$10$Zm.1tm4yXUlitqpvwY//yeGnbXeEqA8hyLw/OrwYIXyHpZy2ILjQ6', '1111-11-11', '011', '123', 2, 4, 0),
(4, 'admin', 'admin', 'admin', '$2y$10$EVyYxauio/qK6uysFBjtO.n7a1wf6NeBdzjsOEOiIzo1DYGEVQiQe', '1111-11-11', '012', '124', 2, 1, 0),
(5, 'aa', 'aa', 'aa', '$2y$10$piv8sfS2caynSYamyO70b.jv78RwdUbIfK0XUPz1DSBLZGwBz0n62', '0000-00-00', '01011', '125', 3, 2, 0),
(8, 'admin1', 'admin1', 'admin1', '$2y$10$3Ie/6pJ3ZXvtgsCX5DPg9u6Za1gvDut/0nq5R5.oiamwvhUsCL.U2', '1919-12-19', '', '', 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `userTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `userTypeName`) VALUES
(1, 'Admin'),
(2, 'Guest'),
(3, 'Test'),
(4, 'Emp');

-- --------------------------------------------------------

--
-- Table structure for table `userType_Pages`
--

CREATE TABLE `userType_Pages` (
  `id` int(11) NOT NULL,
  `pageId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userType_Pages`
--

INSERT INTO `userType_Pages` (`id`, `pageId`, `userTypeId`) VALUES
(1, 4, 1),
(2, 3, 1),
(3, 3, 2),
(4, 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `ccd`
--
ALTER TABLE `ccd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courtId` (`courtId`),
  ADD KEY `courtDetailsId` (`courtDetailsId`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sportId` (`sportId`);

--
-- Indexes for table `courtdetails`
--
ALTER TABLE `courtdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentMethod`
--
ALTER TABLE `paymentMethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentMethodOptions`
--
ALTER TABLE `paymentMethodOptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `optionId` (`optionId`);

--
-- Indexes for table `previliges`
--
ALTER TABLE `previliges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTypeId` (`userTypeId`),
  ADD KEY `optionId` (`featureId`);

--
-- Indexes for table `P_Method_Option_Value`
--
ALTER TABLE `P_Method_Option_Value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `reservationId` (`reservationId`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservationDetailsId` (`reservationDetailsId`),
  ADD KEY `courtId` (`courtId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisorId` (`supervisorId`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTypeId` (`userTypeId`),
  ADD KEY `address_id` (`addressId`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userType_Pages`
--
ALTER TABLE `userType_Pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pageId` (`pageId`),
  ADD KEY `userTypeId` (`userTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ccd`
--
ALTER TABLE `ccd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courtdetails`
--
ALTER TABLE `courtdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paymentMethod`
--
ALTER TABLE `paymentMethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentMethodOptions`
--
ALTER TABLE `paymentMethodOptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `previliges`
--
ALTER TABLE `previliges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `P_Method_Option_Value`
--
ALTER TABLE `P_Method_Option_Value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userType_Pages`
--
ALTER TABLE `userType_Pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `paymentMethodOptions`
--
ALTER TABLE `paymentMethodOptions`
  ADD CONSTRAINT `paymentMethodOptions_ibfk_1` FOREIGN KEY (`optionId`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `paymentMethodOptions_ibfk_2` FOREIGN KEY (`paymentId`) REFERENCES `paymentMethod` (`id`);

--
-- Constraints for table `previliges`
--
ALTER TABLE `previliges`
  ADD CONSTRAINT `previliges_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `previliges_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `features` (`id`);

--
-- Constraints for table `P_Method_Option_Value`
--
ALTER TABLE `P_Method_Option_Value`
  ADD CONSTRAINT `P_Method_Option_Value_ibfk_1` FOREIGN KEY (`reservationId`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `P_Method_Option_Value_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `paymentMethod` (`id`);

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

--
-- Constraints for table `userType_Pages`
--
ALTER TABLE `userType_Pages`
  ADD CONSTRAINT `userType_Pages_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `userType_Pages_ibfk_2` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
