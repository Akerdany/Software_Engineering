-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 11:29 PM
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
(4, 3, 2),
(5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `id` int(11) NOT NULL,
  `courtNumber` varchar(100) NOT NULL,
  `sportId` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `details` text NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `date`, `details`, `isDeleted`, `creationDate`) VALUES
(1, 'hhhh', '2010-11-10', 'hanel3aab koora', 0, '2019-02-28 19:44:55');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature`, `file`) VALUES
(1, 'Delete_user', 'deleteUser.php'),
(2, 'Edit_user', 'editUser.php');

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
(2, 'ExpiryDate', 'date'),
(3, 'number', 'int'),
(4, 'cvv', 'int'),
(5, 'email', 'text'),
(6, 'phoneNo', 'int');

-- --------------------------------------------------------

--
-- Table structure for table `pagecode`
--

CREATE TABLE `pagecode` (
  `ID` int(11) NOT NULL,
  `PageID` int(11) NOT NULL,
  `HTML` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pagecode`
--

INSERT INTO `pagecode` (`ID`, `PageID`, `HTML`) VALUES
(1, 4, '\n    <html><head>\n		<title>About Us</title>\n		<meta charset=\"utf-8\">\n		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n		<link rel=\"stylesheet\" href=\"../css/aboutUs.css\">\n		<script src=\"../CKEDITOR/ckeditor.js\"></script><style>.cke{visibility:hidden;}</style>\n		<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\n		<script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/config.js?t=J1QB\"></script><link rel=\"stylesheet\" type=\"text/css\" href=\"http://localhost/Software_Engineering/CKEDITOR/skins/moono-lisa/editor.css?t=J1QB\"><script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/lang/en.js?t=J1QB\"></script><script type=\"text/javascript\" src=\"http://localhost/Software_Engineering/CKEDITOR/styles.js?t=J1QB\"></script>\n</head>\n	<body cz-shortcut-listen=\"true\">\n\n		<!-- Header -->\n			<header id=\"header\">\n				<div class=\"logo\"><a href=\"#\">About Us</a></div>\n			</header>\n\n		<!-- Main -->\n			<section id=\"main\">\n				<div class=\"inner\">\n\n				<!-- One -->\n					<section id=\"one\" class=\"wrapper style1\">\n						<header class=\"special\">\n							<h2>About the ministry</h2>\n							<p>of youth</p>\n						</header>\n						<div class=\"content\">\n							<p id=\"originalText\" name=\"originalText\">Another Test  </p>\n							\n					</div>\n					<form action=\"pagebuilder.php\" method=\"post\">\n							<input type=\"hidden\" id = \"paragraph\" name = \"paragraph\">\n							<input type=\"submit\" id=\"submitButton\" name=\"submit\" value=\"Edit Content\">\n						</form>\n					</section>\n</div>\n</section></body>\n<script>\n		var text = $(\"#originalText\").html();\n		$(\"#paragraph\").val(text);\n</script>\n</html>\n    ');

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
(1, '../php/logOut.php', 'Log Out'),
(2, '../php/editUser.php', 'Edit Account'),
(3, '../php/registration.php', 'Registration'),
(4, '../php/aboutus.php', 'About Us');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `name`, `isDeleted`, `creationDate`) VALUES
(1, 'Visaa', 0, '2019-02-28 19:45:28'),
(5, 'fawry', 0, '2019-03-14 13:00:25'),
(6, 'abaS', 1, '2019-03-14 13:03:54');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(12, 'displayPm'),
(17, 'editCourt'),
(18, 'deleteCourt');

-- --------------------------------------------------------

--
-- Table structure for table `previliges`
--

CREATE TABLE `previliges` (
  `id` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `featureId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `previliges`
--

INSERT INTO `previliges` (`id`, `userTypeId`, `featureId`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `p_method_option_value`
--

CREATE TABLE `p_method_option_value` (
  `id` int(11) NOT NULL,
  `selectedoptionsId` int(11) NOT NULL,
  `value` text NOT NULL,
  `reservationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 4, '2019-03-14', 1),
(9, 1, 'hussam', -1),
(10, 2, '145235235', -1),
(11, 3, '123', -1),
(12, 4, '2019-03-16', -1),
(13, 1, 'hanon', -1),
(14, 2, '124124235', -1),
(15, 3, '123', -1),
(16, 4, '2019-03-20', -1),
(17, 1, 'hanon', -1),
(18, 2, '214134132', -1),
(19, 3, '123', -1),
(20, 4, '2019-03-14', -1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `courtId` int(11) NOT NULL,
  `reservationDetailsId` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `userId`, `courtId`, `reservationDetailsId`, `isDeleted`, `creationDate`) VALUES
(2, 3, 1, 1, 0, '2019-03-18 16:04:57'),
(3, 1, 1, 2, 0, '2019-03-18 16:04:57'),
(4, 4, 1, 3, 0, '2019-03-18 16:05:34'),
(5, 8, 1, 4, 0, '2019-03-18 16:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `reservationdetails`
--

CREATE TABLE `reservationdetails` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `startTime` decimal(10,2) NOT NULL,
  `endTime` decimal(10,2) NOT NULL,
  `supervisorId` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservationdetails`
--

INSERT INTO `reservationdetails` (`id`, `date`, `startTime`, `endTime`, `supervisorId`, `type`, `cost`) VALUES
(1, '2019-02-11', '2.00', '4.00', 4, 'player', 50),
(2, '2019-03-21', '4.00', '6.00', 4, 'normal', 15),
(3, '2019-03-21', '1.30', '3.00', 4, 'normal', 15),
(4, '2019-03-21', '8.00', '11.30', 4, 'normal', 15);

-- --------------------------------------------------------

--
-- Table structure for table `selectedoptions`
--

CREATE TABLE `selectedoptions` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `optionId` int(11) NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selectedoptions`
--

INSERT INTO `selectedoptions` (`id`, `paymentId`, `optionId`, `priority`) VALUES
(1, 1, 1, 1),
(2, 1, 3, 2),
(3, 1, 4, 3),
(4, 1, 2, 4),
(9, 5, 1, 1),
(10, 5, 3, 2);

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
-- Table structure for table `time`
--

CREATE TABLE `time` (
  `ID` int(11) NOT NULL,
  `hours` decimal(10,2) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(9, '11.30', 0),
(10, '12.00', 0),
(11, '12.30', 0),
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
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 'ahmed', 'z', 'z', '$2y$10$BYXXQnkvwHvqO.PR89JAZ.LEkt4CU6qYgYtJAagJm6eqihd/xk5wS', '0017-12-17', '1717171', '1111111', 3, 1, 1, '2019-03-09 21:40:13'),
(9, 'hussam', 'eldin', 'hussam@gmail.com', '$2y$10$uneyeYAhIXqnHWWEWqvDOedTOSYEFY7d78CxeAj6pA.e5lBcqjdzS', '2019-03-27', '123456234', '1242131243', 3, 2, 0, '2019-03-09 20:37:04'),
(10, 'wageh', 'wego', 'wego@gmail.com', '$2y$10$CquEoUkFfh.G6YuwJ0zwAemlan87ebswYY/SODvg8nnHRcjefEGoW', '2019-03-22', '12345467', '123456', 3, 2, 1, '2019-03-09 18:46:51'),
(11, 'ahmed', 'ahmed', 'ahmed@gmail.com', '$2y$10$m/wQGt97ok84qgQvq64rZOb7noPiGsYl8yMI.7VLTqVJGaFbwmmna', '1919-12-19', '19919919', '199919919919', 3, 1, 0, '2019-03-18 11:15:15');

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
(3, 'IT'),
(4, 'Employee'),
(5, 'Accountant'),
(6, 'Sponsor');

-- --------------------------------------------------------

--
-- Table structure for table `usertype_pages`
--

CREATE TABLE `usertype_pages` (
  `id` int(11) NOT NULL,
  `pageId` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `usertype_permission` (
  `id` int(11) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `permissionId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

CREATE TABLE `user_company` (
  `ID` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `CompanyID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `pagecode`
--
ALTER TABLE `pagecode`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PageID` (`PageID`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `previliges`
--
ALTER TABLE `previliges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTypeId` (`userTypeId`),
  ADD KEY `optionId` (`featureId`);

--
-- Indexes for table `p_method_option_value`
--
ALTER TABLE `p_method_option_value`
  ADD PRIMARY KEY (`id`),
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
-- Indexes for table `selectedoptions`
--
ALTER TABLE `selectedoptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paymentId` (`paymentId`),
  ADD KEY `optionId` (`optionId`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time`
--
ALTER TABLE `time`
  ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `usertype_pages`
--
ALTER TABLE `usertype_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pageId` (`pageId`),
  ADD KEY `userTypeId` (`userTypeId`);

--
-- Indexes for table `usertype_permission`
--
ALTER TABLE `usertype_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userTypeId` (`userTypeId`),
  ADD KEY `permissionId` (`permissionId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pagecode`
--
ALTER TABLE `pagecode`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `previliges`
--
ALTER TABLE `previliges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `p_method_option_value`
--
ALTER TABLE `p_method_option_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservationdetails`
--
ALTER TABLE `reservationdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `selectedoptions`
--
ALTER TABLE `selectedoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `time`
--
ALTER TABLE `time`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usertype_pages`
--
ALTER TABLE `usertype_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usertype_permission`
--
ALTER TABLE `usertype_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`reservationDetailsId`) REFERENCES `reservationdetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`courtId`) REFERENCES `court` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
