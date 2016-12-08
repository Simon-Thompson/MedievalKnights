-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2016 at 01:18 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loveydovey`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`userId`, `itemId`, `quantity`) VALUES
(1, 6, 2),
(1, 8, 1),
(1, 9, 1),
(1, 16, 3),
(1, 17, 2),
(1, 18, 1),
(1, 19, 1),
(1, 21, 1),
(1, 22, 1),
(1, 23, 3),
(1, 24, 2),
(1, 25, 2),
(1, 28, 1),
(1, 29, 3),
(1, 31, 2),
(4, 8, 3),
(4, 9, 1),
(4, 10, 1),
(4, 11, 2),
(4, 12, 1),
(4, 16, 1),
(4, 17, 1),
(4, 18, 2),
(4, 19, 2),
(4, 22, 1),
(4, 23, 1),
(4, 24, 2),
(4, 25, 1),
(4, 29, 2),
(4, 31, 2),
(4, 32, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `typeId` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `power` int(11) NOT NULL DEFAULT '1',
  `chance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `typeId`, `price`, `power`, `chance`) VALUES
(1, 'Hellreaver', 1, 75, 750, 100),
(2, 'Spinefall', 1, 55, 550, 200),
(3, 'Replica Chopper', 1, 30, 300, 450),
(4, 'Piece Maker', 1, 60, 600, 150),
(5, 'Anduril, sword of bunnies', 1, 100, 10000, 50),
(6, 'Talonstrike, featherbow', 1, 12, 120, 3400),
(7, 'Heartpiercer', 1, 24, 240, 1200),
(8, 'Bullseye', 1, 15, 150, 4000),
(9, 'Yew Crossbow', 1, 5, 50, 5500),
(10, 'Steel Battleaxe', 1, 8, 80, 6000),
(11, 'Improved Bronze Lash', 1, 4, 40, 3500),
(12, 'Titanium Shortbow', 1, 7, 70, 2500),
(13, 'Vindicator Whip', 1, 18, 180, 2000),
(14, 'Bloodfist', 1, 35, 350, 1500),
(15, 'War Claw', 1, 16, 160, 3500),
(16, 'Bronze Dagger', 1, 1, 10, 7000),
(17, 'Steel Dagger', 1, 3, 30, 6700),
(18, 'Titanium Dagger', 1, 5, 50, 6000),
(19, 'Ebony Dagger', 1, 6, 60, 5600),
(20, 'Dawnbreaker', 1, 54, 540, 1000),
(21, 'Inherited Mace', 1, 4, 40, 6900),
(22, 'Last Words', 1, 66, 660, 1600),
(23, 'Bronze Spear', 1, 3, 30, 7500),
(24, 'Steel Spear', 1, 5, 50, 6000),
(25, 'Stormbringer', 1, 44, 440, 2400),
(26, 'Oathkeeper', 1, 30, 3000, 1500),
(27, 'Antique Scimitar', 1, 4, 2000, 2000),
(28, 'Golden Scimitar', 1, 22, 440, 4500),
(29, 'Mercenary''s Shortsword', 1, 5, 50, 6000),
(30, 'Remorse', 1, 80, 8000, 70),
(31, 'Recruit''s Blade', 1, 2, 20, 7800),
(32, 'Venomshank', 1, 23, 230, 4400);

-- --------------------------------------------------------

--
-- Table structure for table `itemtype`
--

CREATE TABLE `itemtype` (
  `typeId` int(11) NOT NULL,
  `typeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `itemtype`
--

INSERT INTO `itemtype` (`typeId`, `typeName`) VALUES
(1, 'Omni');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locationId` int(11) NOT NULL,
  `locationName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locationDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `locationLevel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mails`
--

CREATE TABLE `mails` (
  `mailId` int(11) NOT NULL,
  `mailSenderId` int(11) NOT NULL,
  `mailReceiverId` int(11) NOT NULL,
  `mailMessage` text COLLATE utf8_unicode_ci NOT NULL,
  `mailDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mails`
--

INSERT INTO `mails` (`mailId`, `mailSenderId`, `mailReceiverId`, `mailMessage`, `mailDate`) VALUES
(1, 1, 1, 'test', '2016-11-22 23:08:24'),
(2, 4, 4, 'Hello', '2016-12-07 21:36:47'),
(3, 4, 1, 'Hello', '2016-12-07 21:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userLevel` int(11) NOT NULL DEFAULT '1',
  `userPassword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userHealth` float NOT NULL DEFAULT '200',
  `attack` int(11) NOT NULL DEFAULT '1000',
  `defence` int(11) NOT NULL DEFAULT '1000',
  `speed` int(11) NOT NULL DEFAULT '1000',
  `privateKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `modulus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `energy` int(11) NOT NULL DEFAULT '100',
  `will` int(11) NOT NULL DEFAULT '100',
  `equipWeapon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userLevel`, `userPassword`, `userEmail`, `userHealth`, `attack`, `defence`, `speed`, `privateKey`, `modulus`, `energy`, `will`, `equipWeapon`) VALUES
(1, 'test', 11, 'test', '', 693, 27101, 2147483647, 4701, '', '', 100, 100, NULL),
(2, 'mega Vybs', 1, 'test', '', 200, 1500, 1500, 1500, '', '', 100, 100, NULL),
(3, 'doomkc1993', 1, 'doomkc1993', '', 200, 1000, 1000, 1000, '', '', 100, 100, NULL),
(4, 'Simon', 4, 'potato33', '', 0, 5622, 1000, 1000, '2027431327983597331500013162483748787718774835519504651335361', '2059835781819691475436647174369566302022139742333888799786207', 100, 100, 22);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`userId`,`itemId`),
  ADD KEY `foreignKeyItemId` (`itemId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `typeIdKey` (`typeId`) USING BTREE;

--
-- Indexes for table `itemtype`
--
ALTER TABLE `itemtype`
  ADD PRIMARY KEY (`typeId`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `mails`
--
ALTER TABLE `mails`
  ADD PRIMARY KEY (`mailId`),
  ADD KEY `mailSenderId` (`mailSenderId`),
  ADD KEY `mailReceiverId` (`mailReceiverId`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `equipWeapon` (`equipWeapon`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `itemtype`
--
ALTER TABLE `itemtype`
  MODIFY `typeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mails`
--
ALTER TABLE `mails`
  MODIFY `mailId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `foreignKeyItemId` FOREIGN KEY (`itemId`) REFERENCES `items` (`itemId`),
  ADD CONSTRAINT `foreignKeyUserId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `foreignKeyTypeId` FOREIGN KEY (`typeId`) REFERENCES `itemtype` (`typeId`);

--
-- Constraints for table `mails`
--
ALTER TABLE `mails`
  ADD CONSTRAINT `foreignKeyReceiverId` FOREIGN KEY (`mailReceiverId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `foreignKeySenderId` FOREIGN KEY (`mailSenderId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `foreignKeyEquipWeapon` FOREIGN KEY (`equipWeapon`) REFERENCES `items` (`itemId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
