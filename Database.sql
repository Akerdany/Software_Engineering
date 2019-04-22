-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 22, 2019 at 11:49 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ccd`
--

INSERT INTO `ccd` (`id`, `courtId`, `courtDetailsId`) VALUES
(4, 3, 2),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sportId` (`sportId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`id`, `courtNumber`, `sportId`, `price`, `creationDate`, `isDeleted`) VALUES
(1, '34', 1, 64, '2019-02-28 19:43:57', 0),
(3, '142', 1, 12, '2019-03-08 14:02:31', 0),
(4, '12', 1, 15, '2019-03-08 14:03:08', 0);

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
  `isDeleted` tinyint(1) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `details`, `isDeleted`, `creationDate`) VALUES
(1, 'hhhh', '2010-11-10', 'hanel3aab koora', 0, '2019-02-28 19:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
CREATE TABLE IF NOT EXISTS `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `file`) VALUES
(1, 'Users', 'displayUsers.php'),
(2, 'Events', 'EventController.php'),
(3, 'Courts', 'CourtController.php'),
(4, 'PaymentMethod', 'PmController.php'),
(5, 'Reserve', 'addRe.php'),
(6, 'ManageAccount', 'editUser.php'),
(7, 'Reservation', 'displayRe.php'),
(9, 'Options', 'OptionsController.php');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `isDeleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `type`, `isDeleted`) VALUES
(1, 'Name', 'text', 0),
(2, 'ExpiryDate', 'date', 0),
(3, 'number', 'int', 0),
(4, 'cvv', 'int', 0),
(5, 'email', 'text', 0),
(6, 'phoneNo', 'int', 0),
(7, 'Gender', 'radio', 0),
(8, 'Address', 'text', 0),
(13, 'Loan', 'text', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pagecode`
--

DROP TABLE IF EXISTS `pagecode`;
CREATE TABLE IF NOT EXISTS `pagecode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PageID` int(11) NOT NULL,
  `HTML` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PageID` (`PageID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagecode`
--

INSERT INTO `pagecode` (`ID`, `PageID`, `HTML`) VALUES
(1, 4, '\r\n    <html><head>\r\n		<title>About Us</title>\r\n		<meta charset=\"utf-8\">\r\n		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\r\n		<link rel=\"stylesheet\" href=\"../css/aboutUs.css\">\r\n		<script src=\"../CKEDITOR/ckeditor.js\"></script><style>.cke{visibility:hidden;}</style>\r\n		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\r\n		<script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/config.js?t=J1QB\"></script><link rel=\"stylesheet\" type=\"text/css\" href=\"http://localhost/Software_Engineering/CKEDITOR/skins/moono-lisa/editor.css?t=J1QB\"><script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/lang/en.js?t=J1QB\"></script><script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/styles.js?t=J1QB\"></script>\r\n</head>\r\n	<body cz-shortcut-listen=\"true\">\r\n\r\n		<!-- Header -->\r\n			<header id=\"header\">\r\n				<div class=\"logo\"><a href=\"#\">About Us</a></div>\r\n			</header>\r\n\r\n		<!-- Main -->\r\n			<section id=\"main\">\r\n				<div class=\"inner\">\r\n\r\n				<!-- One -->\r\n					<section id=\"one\" class=\"wrapper style1\">\r\n						<header class=\"special\">\r\n							<h2>About the ministry</h2>\r\n							<p>of youth</p>\r\n						</header>\r\n						<div class=\"content\">\r\n							<p id=\"originalText\" name=\"originalText\"><p>bhkhnjkjk</p></p>\r\n							\r\n					</div>\r\n					<form action=\"pagebuilder.php\" method=\"post\">\r\n							<input type=\"hidden\" id = \"paragraph\" name = \"paragraph\">\r\n							<input type=\"submit\" id=\"submitButton\" name=\"submit\" value=\"Edit Content\">\r\n						</form>\r\n					</section>\r\n</div>\r\n</section></body>\r\n<script>\r\n		var text = $(\"#originalText\").html();\r\n		$(\"#paragraph\").val(text);\r\n</script>\r\n</html>\r\n    ');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(100) NOT NULL,
  `pageName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `link`, `pageName`) VALUES
(1, '../php/logOut.php', 'Log Out'),
(2, '../php/editUser.php', 'Edit Account'),
(3, '../php/registration.php', 'Registration'),
(4, '../php/aboutus.php', 'About Us');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

DROP TABLE IF EXISTS `paymentmethod`;
CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`, `isDeleted`, `creationDate`) VALUES
(1, 'Visaa', 0, '2019-02-28 19:45:28'),
(5, 'fawry', 0, '2019-03-14 13:00:25'),
(15, 'QQCard', 0, '2019-04-18 13:51:46'),
(16, 'vps', 1, '2019-04-19 13:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'addUser'),
(2, 'editUser'),
(3, 'deleteUser'),
(4, 'addEvent'),
(5, 'addcourt'),
(6, 'addFeature'),
(7, 'addOption'),
(8, 'addReservation'),
(9, 'addPm'),
(10, 'editPm'),
(11, 'deletePm'),
(12, 'PmController'),
(17, 'OptionsController');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previliges`
--

INSERT INTO `previliges` (`id`, `userTypeId`, `featureId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 5),
(5, 2, 5),
(8, 4, 3),
(9, 1, 6),
(10, 1, 7),
(11, 2, 6),
(14, 1, 4),
(15, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `p_method_option_value`
--

DROP TABLE IF EXISTS `p_method_option_value`;
CREATE TABLE IF NOT EXISTS `p_method_option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selectedoptionsId` int(11) NOT NULL,
  `value` text NOT NULL,
  `reservationId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservationId` (`reservationId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p_method_option_value`
--

INSERT INTO `p_method_option_value` (`id`, `selectedoptionsId`, `value`, `reservationId`) VALUES
(1, 1, 'hussammm', 1),
(2, 2, '1234567890', 1),
(3, 3, '132', 1),
(4, 4, '2019-03-21', 1),
(5, 1, 'hhh', 1),
(6, 2, '123', 1),
(7, 3, '321', 1),
(8, 4, '2019-03-14', 1);

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
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reservationDetailsId` (`reservationDetailsId`),
  KEY `courtId` (`courtId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `userId`, `courtId`, `reservationDetailsId`, `isDeleted`, `creationDate`) VALUES
(1, 3, 1, 1, 0, '2019-02-28 19:45:48'),
(3, 11, 1, 7, 0, '2019-03-18 23:34:44'),
(4, 11, 1, 8, 0, '2019-03-18 23:35:19'),
(5, 11, 1, 9, 0, '2019-03-19 07:59:56'),
(6, 11, 1, 10, 0, '2019-04-12 20:32:55'),
(7, 11, 1, 11, 0, '2019-04-12 21:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

DROP TABLE IF EXISTS `reservationdetails`;
CREATE TABLE IF NOT EXISTS `reservationdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `startTime` decimal(10,2) NOT NULL,
  `endTime` decimal(10,2) NOT NULL,
  `supervisorId` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `supervisorId` (`supervisorId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`id`, `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`, `status`) VALUES
(1, '2019-02-11', '2.00', '4.00', 4, 'player', 50, 0),
(2, '2019-03-21', '4.00', '6.00', 4, 'normal', 15, 0),
(3, '2019-03-21', '1.30', '3.00', 4, 'normal', 15, 0),
(4, '2019-03-21', '8.00', '11.30', 4, 'normal', 15, 0),
(5, '2019-03-22', '8.00', '9.30', 1, 'normal', 128, 0),
(7, '2019-03-22', '8.00', '9.30', 1, 'normal', 128, 0),
(8, '2019-03-22', '9.30', '11.30', 1, 'normal', 128, 0),
(9, '2019-03-21', '10.00', '13.00', 1, 'normal', 128, 0),
(10, '2019-04-18', '11.00', '14.00', 1, 'normal', 128, 0),
(11, '2019-04-14', '8.30', '10.30', 1, 'normal', 128, 0);

-- --------------------------------------------------------

--
-- Table structure for table `selectedoptions`
--

DROP TABLE IF EXISTS `selectedoptions`;
CREATE TABLE IF NOT EXISTS `selectedoptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paymentId` int(11) NOT NULL,
  `optionId` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paymentId` (`paymentId`),
  KEY `optionId` (`optionId`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selectedoptions`
--

INSERT INTO `selectedoptions` (`id`, `paymentId`, `optionId`, `priority`) VALUES
(1, 1, 1, 1),
(4, 1, 2, 3),
(9, 5, 1, 1),
(49, 5, 3, 2),
(52, 1, 3, 2),
(82, 15, 1, 1),
(83, 15, 3, 2),
(84, 15, 4, 3),
(85, 16, 1, 2),
(86, 16, 3, 1),
(88, 16, 2, 4),
(89, 16, 6, 5);

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
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `hours` decimal(10,2) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`ID`, `hours`, `state`) VALUES
(2, '8.00', 0),
(3, '8.30', 0),
(4, '9.00', 0),
(5, '9.30', 0),
(6, '10.00', 0),
(7, '10.30', 0),
(8, '11.00', 0),
(12, '13.00', 0),
(13, '13.30', 0),
(14, '14.00', 0),
(15, '14.30', 0),
(16, '15.00', 0),
(17, '15.30', 0),
(18, '16.00', 0),
(19, '16.30', 0),
(20, '17.00', 0),
(21, '17.30', 0),
(22, '18.00', 0),
(23, '18.30', 0),
(24, '19.00', 0),
(25, '19.30', 0),
(26, '20.00', 0),
(27, '20.30', 0),
(28, '21.00', 0),
(29, '21.30', 0),
(30, '22.00', 0),
(31, '22.30', 0),
(32, '23.00', 0),
(33, '23.30', 0),
(34, '24.00', 0),
(35, '24.30', 0),
(36, '25.00', 0),
(37, '25.30', 0);

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
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`),
  KEY `address_id` (`addressId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `dateOfBirth`, `telephone`, `ssn`, `addressId`, `userTypeId`, `isDeleted`, `creationDate`) VALUES
(1, 'test1', 'test1', 'test', 'pass', '0111-11-11', '010', '111', 2, 3, 0, '2019-02-28 19:46:28'),
(3, 'hello', 'hello', 'hello', '$2y$10$Zm.1tm4yXUlitqpvwY//yeGnbXeEqA8hyLw/OrwYIXyHpZy2ILjQ6', '1111-11-11', '011', '123', 2, 4, 0, '2019-02-28 19:46:28'),
(4, 'admin', 'admin', 'admin', '$2y$10$EVyYxauio/qK6uysFBjtO.n7a1wf6NeBdzjsOEOiIzo1DYGEVQiQe', '1111-11-11', '012', '124', 2, 1, 0, '2019-02-28 19:46:28'),
(5, 'aa', 'aa', 'aa', '$2y$10$piv8sfS2caynSYamyO70b.jv78RwdUbIfK0XUPz1DSBLZGwBz0n62', '0000-00-00', '01010', '125', 3, 3, 0, '2019-02-28 19:46:28'),
(6, 'test', 'test', 'test', '$2y$10$RzrBPRj5SDpfd3YvU1GscuxEAERmVruNhOhvZTEi443oo8mS5Hu5G', '0066-06-16', '6616', '661616', 3, 2, 0, '2019-03-09 21:09:03'),
(7, 'test', 'test', 'test', '$2y$10$kHbKqh/xTTd.rnrS08j3W.VuvqIAEQihtdvkWIHl9prEGc/PkO6c2', '0018-12-18', '81818', '18181', 3, 2, 0, '2019-03-09 21:09:58'),
(8, 'ahmed', 'zeft', 'zeft', '$2y$10$BYXXQnkvwHvqO.PR89JAZ.LEkt4CU6qYgYtJAagJm6eqihd/xk5wS', '0017-12-17', '1717171', '1111111', 3, 1, 1, '2019-03-09 21:40:13'),
(9, 'hussam', 'eldin', 'hussam@gmail.com', '$2y$10$uneyeYAhIXqnHWWEWqvDOedTOSYEFY7d78CxeAj6pA.e5lBcqjdzS', '2019-03-27', '123456234', '1242131243', 3, 2, 0, '2019-03-09 20:37:04'),
(10, 'wageh', 'wego', 'wego@gmail.com', '$2y$10$CquEoUkFfh.G6YuwJ0zwAemlan87ebswYY/SODvg8nnHRcjefEGoW', '2019-03-22', '12345467', '123456', 3, 3, 0, '2019-03-09 18:46:51'),
(11, 'ahmed', 'ahmed', 'ahmed@gmail.com', '$2y$10$m/wQGt97ok84qgQvq64rZOb7noPiGsYl8yMI.7VLTqVJGaFbwmmna', '1919-12-19', '19919919', '199919919919', 3, 1, 0, '2019-03-18 11:15:15'),
(14, 'Omar', 'Anas', 'omaranas@yahoo.com', '$2y$10$xl8JB6q7f9qAvXM1x7tD2.Dp1QozVbNIiPqhxDkU2bHBshbfoxS2S', '2019-04-17', '1234567890', '1234567890', 3, 3, 0, '2019-04-20 08:30:43'),
(15, 'John', 'Cena', 'JohnCena@gmail.com', '$2y$10$EpYIIrLaQnCGA26VERyq4uf/sndm08nn2KEWMUVzXHIvjM1YGvP5m', '2019-04-09', '12345678', '1234567878', 3, 2, 0, '2019-04-20 08:43:21'),
(16, 'john', 'john', 'john@gmail.com', '$2y$10$zdceg54kuNEDv58VSODhO.AvpG2NZWAFKeBm3AKt3ngaOXxbvKgp6', '2019-04-11', '584887', '57854788', 3, 2, 0, '2019-04-20 08:44:14'),
(17, 'h', 'h', 'h@h.com', '$2y$10$hywJsbjxLYN3DD0lI2bmQ.83JW5Gq58zEOOP35N44axr0TChZIPji', '2019-04-23', '1', '1', 3, 3, 0, '2019-04-20 08:46:34'),
(18, 'Guest', 'Guest', 'guest@gmail.com', '$2y$10$IXn5Com4efamzYyG1tpJnebXJ3KrP/hyrvw6s8FYMdLy8qYRlTnbO', '2019-04-11', '1234', '1234567890', 3, 2, 0, '2019-04-21 19:35:21'),
(19, 'Admin', 'Admin', 'admin@gmail.com', '$2y$10$1C.I6k7uZ0LV1KqN7.lQj.f8v3uGsKQhGCqJckDutV.NzNfhekAFa', '2019-04-12', '1234', '1234567890', 3, 1, 0, '2019-04-21 19:35:58'),
(20, 'IT', 'IT', 'IT@gmail.com', '$2y$10$6yaDeSnzAFWVrrvlUIMRxepqW3oYtJIugsgJkZJn7MVGtr3u0t56i', '2019-04-08', '1234', '123456789', 3, 3, 0, '2019-04-21 19:37:18'),
(21, 'Employee', 'Employee', 'emp@gmail.com', '$2y$10$mNEqB4MKqFMSs8xMr5MnI.Ol5fIMh2IuBJQEx8B3lKffXyYqT.wNC', '2019-04-09', '1234', '1234567890', 3, 4, 0, '2019-04-21 19:39:39'),
(22, 'Accountant', 'Accountant', 'Accountant@gmail.com', '$2y$10$d8XYLwASsp8PfGeN2zj0KOjrYuNGanLuFahz4rbxzfjxRfAkR5g1a', '2019-04-04', '1234', '123456789', 3, 5, 0, '2019-04-21 19:40:40'),
(23, 'Sponsor', 'Sponsor', 'Sponsor@gmail.com', '$2y$10$3w05ZTU.nsGm5f0B8X/8lu3iYn6GkeWzSDWEgneeneMxhQNwzRMV2', '2019-04-16', '1234', '123456789', 3, 6, 0, '2019-04-21 19:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

DROP TABLE IF EXISTS `usertype`;
CREATE TABLE IF NOT EXISTS `usertype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeName` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `userTypeName`) VALUES
(1, 'Admin'),
(2, 'Guest'),
(3, 'IT'),
(4, 'Employee'),
(5, 'Accountant'),
(6, 'Sponsor');

-- --------------------------------------------------------

--
-- Table structure for table `usertype_pages`
--

DROP TABLE IF EXISTS `usertype_pages`;
CREATE TABLE IF NOT EXISTS `usertype_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pageId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pageId` (`pageId`),
  KEY `userTypeId` (`userTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype_pages`
--

INSERT INTO `usertype_pages` (`id`, `pageId`, `userTypeId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usertype_permission`
--

DROP TABLE IF EXISTS `usertype_permission`;
CREATE TABLE IF NOT EXISTS `usertype_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userTypeId` int(11) NOT NULL,
  `permissionId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userTypeId` (`userTypeId`),
  KEY `permissionId` (`permissionId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype_permission`
--

INSERT INTO `usertype_permission` (`id`, `userTypeId`, `permissionId`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_company`
--

DROP TABLE IF EXISTS `user_company`;
CREATE TABLE IF NOT EXISTS `user_company` (
  `ID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Constraints for table `previliges`
--
ALTER TABLE `previliges`
  ADD CONSTRAINT `previliges_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `previliges_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `features` (`id`);

--
-- Constraints for table `p_method_option_value`
--
ALTER TABLE `p_method_option_value`
  ADD CONSTRAINT `P_Method_Option_Value_ibfk_1` FOREIGN KEY (`reservationId`) REFERENCES `reservation` (`id`);

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
-- Constraints for table `selectedoptions`
--
ALTER TABLE `selectedoptions`
  ADD CONSTRAINT `paymentMethodOptions_ibfk_1` FOREIGN KEY (`optionId`) REFERENCES `options` (`id`),
  ADD CONSTRAINT `paymentMethodOptions_ibfk_2` FOREIGN KEY (`paymentId`) REFERENCES `paymentmethod` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`addressId`) REFERENCES `address` (`id`);

--
-- Constraints for table `usertype_pages`
--
ALTER TABLE `usertype_pages`
  ADD CONSTRAINT `userType_Pages_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `pages` (`id`),
  ADD CONSTRAINT `userType_Pages_ibfk_2` FOREIGN KEY (`userTypeId`) REFERENCES `usertype` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
