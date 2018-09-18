-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2015 at 10:54 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` bigint(20) NOT NULL,
  `productId` bigint(20) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `userId` int(11) NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `productId`, `comment`, `userId`, `commentDate`) VALUES
(1, 11, 'very good', 1, '2015-08-29 00:40:35'),
(2, 11, 'cool', 1, '2015-08-29 02:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `namegenarate`
--

CREATE TABLE IF NOT EXISTS `namegenarate` (
`id` int(11) NOT NULL,
  `imageName` varchar(50) NOT NULL,
  `OrderUniqueId` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `namegenarate`
--

INSERT INTO `namegenarate` (`id`, `imageName`, `OrderUniqueId`, `date`) VALUES
(1, '26', 2, '2015-09-13');

-- --------------------------------------------------------

--
-- Table structure for table `optiongroups`
--

CREATE TABLE IF NOT EXISTS `optiongroups` (
`OptionGroupID` int(11) NOT NULL,
  `OptionGroupName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL,
  `optionDescription` varchar(100) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `optiongroups`
--

INSERT INTO `optiongroups` (`OptionGroupID`, `OptionGroupName`, `optionDescription`) VALUES
(1, 'color', 'color with R G B'),
(2, 'size', 'size s m l xl xxl');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
`OptionID` int(11) NOT NULL,
  `OptionGroupID` int(11) DEFAULT NULL,
  `OptionName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`OptionID`, `OptionGroupID`, `OptionName`) VALUES
(1, 1, 'red'),
(2, 1, 'blue'),
(3, 1, 'green'),
(4, 2, 'S'),
(5, 2, 'M'),
(6, 2, 'L'),
(7, 2, 'XL'),
(8, 2, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
`DetailID` bigint(20) NOT NULL,
  `DetailOrderIDUnique` bigint(20) NOT NULL,
  `DetailProductID` bigint(20) NOT NULL,
  `DetailName` varchar(250) COLLATE latin1_german2_ci NOT NULL,
  `DetailPrice` float NOT NULL,
  `DetailAttribute` varchar(200) COLLATE latin1_german2_ci NOT NULL,
  `DetailQuantity` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`DetailID`, `DetailOrderIDUnique`, `DetailProductID`, `DetailName`, `DetailPrice`, `DetailAttribute`, `DetailQuantity`) VALUES
(1, 2015091122, 12, 'product qith main', 0, 'Color : blue, Size : M', 1),
(2, 2015091123, 5, 'product 2', 500, '', 1),
(3, 2015091124, 1, 'p', 300, '', 1),
(4, 2015091125, 11, 'product add', 250, 'Color : blue, Size : M, Color : red', 1),
(5, 2015091126, 2, 'product 2', 500, '', 1),
(6, 2015091127, 1, 'p', 300, '', 3),
(7, 201509131, 2, 'product 2', 500, '', 3),
(8, 201509132, 2, 'product 2', 500, '', 1),
(9, 201509132, 11, 'product add', 250, 'Color : blue, Size : S, Color : red', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`OrderID` bigint(20) NOT NULL,
  `OrderUniqueId` bigint(20) NOT NULL,
  `OrderUserID` int(11) NOT NULL,
  `OrderGuestName` varchar(250) COLLATE latin1_german2_ci NOT NULL,
  `OrderAmount` float NOT NULL,
  `OrderQuntity` int(11) NOT NULL,
  `OrderShipName` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `OrderShipAddress` varchar(500) COLLATE latin1_german2_ci NOT NULL,
  `OrderCity` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `OrderZip` varchar(20) COLLATE latin1_german2_ci NOT NULL,
  `OrderCountry` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `OrderPhone` varchar(20) COLLATE latin1_german2_ci NOT NULL,
  `OrderMobile` varchar(20) COLLATE latin1_german2_ci NOT NULL,
  `OrderShippingCost` float NOT NULL,
  `OrderTax` float NOT NULL,
  `OrderEmail` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OrderShipped` tinyint(1) NOT NULL DEFAULT '0',
  `OrderStatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderUniqueId`, `OrderUserID`, `OrderGuestName`, `OrderAmount`, `OrderQuntity`, `OrderShipName`, `OrderShipAddress`, `OrderCity`, `OrderZip`, `OrderCountry`, `OrderPhone`, `OrderMobile`, `OrderShippingCost`, `OrderTax`, `OrderEmail`, `OrderDate`, `OrderShipped`, `OrderStatus`) VALUES
(1, 2015091122, 0, 'shofiullah babor', 100, 0, '', 'fadsfdsfafasd', 'Feni', '', 'Bangladesh', '01814772282', '01814772282', 0, 0, 'babu_12f@yahoo.com', '2015-09-11 19:35:49', 0, 0),
(2, 2015091123, 0, 'shofiullah babor', 100, 0, '', 'fdsgedsfgsdfgsd', 'Feni', '', 'Bangladesh', '', '01814772282', 0, 0, 'babu_12f@yahoo.com', '2015-09-11 19:41:55', 0, 0),
(3, 2015091124, 0, '', 100, 0, '', '', '', '', '', '', '', 0, 0, '', '2015-09-11 19:43:51', 0, 0),
(4, 2015091125, 3, 'shofiullah babor', 0, 0, '', 'gsdfgdsfgds', 'Feni', '', 'Bangladesh', '01814772282', '01814772282', 0, 0, 'babu_12f@yahoo.com', '2015-09-11 21:33:45', 0, 5),
(5, 2015091126, 3, 'shofiullah babor', 0, 0, '', 'pathan bari road', 'feni', '1240', '', '', '01814772282', 0, 0, 'babu12f@hotmail.com', '2015-09-11 21:37:52', 0, 4),
(6, 2015091127, 3, 'shofiullah babor', 900, 0, '', 'pathan bari road', 'feni', '1240', '', '', '01814772282', 0, 0, 'babu12f@hotmail.com', '2015-09-11 21:41:12', 0, 3),
(7, 201509131, 0, 'shofiullah babor', 1500, 1, 'femifdsa', 'pthan bari road', 'Feni', '1200', 'Bangladesh', '01814772282', '01814772282', 0, 0, 'babu_12f@yahoo.com', '2015-09-13 09:28:56', 0, 2),
(8, 201509132, 0, 'shofiullah babor', 750, 2, 'femifdsa', 'pathan bari road', 'Feni', '1200', 'Bangladesh', '01814772282', '01814772282', 0, 0, 'babu_12f@yahoo.com', '2015-09-13 09:31:21', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productcat`
--

CREATE TABLE IF NOT EXISTS `productcat` (
  `ProductId` bigint(20) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productcat`
--

INSERT INTO `productcat` (`ProductId`, `categoryId`) VALUES
(1, 2),
(2, 1),
(2, 6),
(3, 1),
(3, 6),
(4, 1),
(4, 6),
(5, 1),
(5, 6),
(6, 1),
(6, 6),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(9, 2),
(9, 3),
(10, 2),
(10, 3),
(11, 4),
(11, 5),
(12, 3),
(12, 4),
(12, 5);

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE IF NOT EXISTS `productcategories` (
`CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Running'),
(2, 'Walking'),
(3, 'HIking'),
(4, 'Track and Trail'),
(5, 'Short Sleave'),
(6, 'Long Sleave'),
(15, 'Gg');

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE IF NOT EXISTS `productimage` (
  `productId` bigint(20) NOT NULL,
  `imageUrl` varchar(300) NOT NULL,
  `mainImage` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`productId`, `imageUrl`, `mainImage`) VALUES
(1, 'images/b.jpg', '0'),
(1, 'images/Desert.jpg', '1'),
(2, 'images/t-shirt.png', '0'),
(2, 'images/images.jpg', '1'),
(3, 'images/t-shirt.png', '0'),
(3, 'images/images.jpg', '1'),
(4, 'images/t-shirt.png', '0'),
(4, 'images/images.jpg', '1'),
(5, 'images/t-shirt.png', '0'),
(5, 'images/images.jpg', '1'),
(6, 'images/t-shirt.png', '0'),
(6, 'images/images.jpg', '1'),
(7, 'images/product3.jpg', '0'),
(7, 'images/product2.jpg', '0'),
(7, 'images/shirt.jpg', '1'),
(8, 'images/product3.jpg', '0'),
(8, 'images/product2.jpg', '0'),
(8, 'images/shirt.jpg', '1'),
(9, 'images/product3.jpg', '0'),
(9, 'images/product2.jpg', '0'),
(9, 'images/shirt.jpg', '1'),
(10, 'images/product3.jpg', '0'),
(10, 'images/product2.jpg', '0'),
(10, 'images/shirt.jpg', '1'),
(11, 'images/product5.jpg', '0'),
(11, 'images/product1.jpg', '0'),
(11, 'images/t-shirt.png', '1'),
(11, 'images/gallery2-.jpg', '0'),
(12, 'images/girl2.jpg', '0'),
(12, 'images/girl3.jpg', '1'),
(12, 'images/gallery4.jpg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `productimagegalary`
--

CREATE TABLE IF NOT EXISTS `productimagegalary` (
  `ProductId` bigint(20) NOT NULL,
  `ImageURL` varchar(200) NOT NULL,
  `MainImage` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `productoption`
--

CREATE TABLE IF NOT EXISTS `productoption` (
  `productId` bigint(20) NOT NULL,
  `optiongroutId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productoption`
--

INSERT INTO `productoption` (`productId`, `optiongroutId`) VALUES
(11, 1),
(11, 2),
(11, 1),
(12, 1),
(12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `productoptions`
--

CREATE TABLE IF NOT EXISTS `productoptions` (
`ProductOptionID` int(10) unsigned NOT NULL,
  `ProductID` bigint(20) unsigned NOT NULL,
  `OptionID` int(10) unsigned NOT NULL,
  `OptionPriceIncrement` double DEFAULT NULL,
  `OptionGroupID` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `productoptions`
--

INSERT INTO `productoptions` (`ProductOptionID`, `ProductID`, `OptionID`, `OptionPriceIncrement`, `OptionGroupID`) VALUES
(1, 1, 1, 0, 1),
(2, 1, 2, 0, 1),
(3, 1, 3, 0, 1),
(4, 1, 4, 0, 2),
(5, 1, 5, 0, 2),
(6, 1, 6, 0, 2),
(7, 1, 7, 2, 2),
(8, 1, 8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`ProductID` bigint(20) NOT NULL,
  `ProductSKU` varchar(50) COLLATE latin1_german2_ci NOT NULL,
  `ProductName` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `ProductPrice` float NOT NULL,
  `prevPrice` int(11) NOT NULL,
  `ProductWeight` float NOT NULL,
  `ProductCartDesc` varchar(250) COLLATE latin1_german2_ci NOT NULL,
  `ProductShortDesc` varchar(1000) COLLATE latin1_german2_ci NOT NULL,
  `ProductLongDesc` text COLLATE latin1_german2_ci NOT NULL,
  `ProductThumb` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `ProductImage` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `ProductCategoryID` int(11) DEFAULT NULL,
  `ProductAddDate` datetime NOT NULL,
  `ProductUpdateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProductStock` float DEFAULT NULL,
  `ProductLive` tinyint(1) DEFAULT '0',
  `ProductUnlimited` tinyint(1) DEFAULT '1',
  `ProductLocation` varchar(250) COLLATE latin1_german2_ci DEFAULT NULL,
  `productOffer` varchar(100) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductSKU`, `ProductName`, `ProductPrice`, `prevPrice`, `ProductWeight`, `ProductCartDesc`, `ProductShortDesc`, `ProductLongDesc`, `ProductThumb`, `ProductImage`, `ProductCategoryID`, `ProductAddDate`, `ProductUpdateDate`, `ProductStock`, `ProductLive`, `ProductUnlimited`, `ProductLocation`, `productOffer`) VALUES
(1, '', 'p', 300, 0, 0, '', 'dsfad', 'dsafs', '', 'images/Desert.jpg', NULL, '2015-08-24 00:00:00', '2015-08-24 11:02:51', NULL, 0, 1, NULL, ''),
(2, '', 'product 2', 500, 0, 0, '', 'short descrioption', 'long', '', 'images/images.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:25:35', NULL, 1, 1, NULL, ''),
(3, '', 'product 2', 500, 0, 0, '', 'short descrioption', 'long', '', 'images/images.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:25:49', NULL, 1, 1, NULL, ''),
(4, '', 'product 2', 500, 0, 0, '', 'short descrioption', 'long', '', 'images/images.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:25:52', NULL, 1, 1, NULL, ''),
(5, '', 'product 2', 500, 0, 0, '', 'short descrioption', 'long', '', 'images/images.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:25:54', NULL, 1, 1, NULL, ''),
(6, '', 'product 2', 500, 0, 0, '', 'short descrioption', 'long', '', 'images/images.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:25:56', NULL, 1, 1, NULL, ''),
(7, '', 'product 6', 1254, 0, 0, '', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\n', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\nNAME:SALMAN\r\nAGE:25\r\nPOSITION:STAFF\r\nBLOOD_GROUP:O+\r\nCONTACT:+8801676353621', '', 'images/shirt.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:27:43', NULL, 1, 1, NULL, ''),
(8, '', 'product 6', 1254, 0, 0, '', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\n', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\nNAME:SALMAN\r\nAGE:25\r\nPOSITION:STAFF\r\nBLOOD_GROUP:O+\r\nCONTACT:+8801676353621', '', 'images/shirt.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:27:54', NULL, 1, 1, NULL, ''),
(9, '', 'product 6', 1254, 0, 0, '', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\n', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\nNAME:SALMAN\r\nAGE:25\r\nPOSITION:STAFF\r\nBLOOD_GROUP:O+\r\nCONTACT:+8801676353621', '', 'images/shirt.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:27:57', NULL, 1, 1, NULL, ''),
(10, '', 'product 6', 1254, 0, 0, '', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\n', 'ID:13201033\r\nNAME:RASEL AHMED\r\nAGE:20\r\nKAVIN_NUMBER:15\r\nBLOOD_GROUP:A+\r\nCONTACT:+8801676353621\r\nID:13201016\r\nNAME:SALMAN\r\nAGE:25\r\nPOSITION:STAFF\r\nBLOOD_GROUP:O+\r\nCONTACT:+8801676353621', '', 'images/shirt.jpg', NULL, '2015-08-25 00:00:00', '2015-08-25 16:27:59', NULL, 1, 1, NULL, ''),
(11, '', 'product add', 250, 300, 0, '', 'short', 'des', '', 'images/t-shirt.png', NULL, '2015-08-26 00:00:00', '2015-08-25 23:32:50', NULL, 0, 1, NULL, 'sell'),
(12, '', 'product qith main', 0, 0, 0, '', 'kfdsfkasdk', 'kkkk', '', 'images/girl3.jpg', NULL, '2015-08-26 00:00:00', '2015-08-26 18:49:07', NULL, 1, 1, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
`id` int(11) NOT NULL,
  `productId` bigint(20) NOT NULL,
  `sliderText` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `productId`, `sliderText`) VALUES
(2, 2, 'p2'),
(3, 3, 'p3'),
(5, 6, 'this is th slider');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`UserID` bigint(20) NOT NULL,
  `UserFullName` varchar(100) COLLATE latin1_german2_ci NOT NULL,
  `UserEmail` varchar(500) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserPassword` varchar(500) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserFirstName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserLastName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserCity` varchar(90) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserDistrict` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserZip` varchar(12) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserEmailVerified` tinyint(1) DEFAULT '0',
  `UserRegistrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserVerificationCode` varchar(20) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserPhone` varchar(20) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserMobile` varchar(20) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserCountry` varchar(20) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserShortAddress` varchar(100) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserDetailAddress` varchar(500) COLLATE latin1_german2_ci DEFAULT NULL,
  `UserType` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserFullName`, `UserEmail`, `UserPassword`, `UserFirstName`, `UserLastName`, `UserCity`, `UserDistrict`, `UserZip`, `UserEmailVerified`, `UserRegistrationDate`, `UserVerificationCode`, `UserPhone`, `UserMobile`, `UserCountry`, `UserShortAddress`, `UserDetailAddress`, `UserType`) VALUES
(1, '', 'babu_12f@yahoo.com', '123', NULL, NULL, NULL, NULL, NULL, 0, '2015-09-11 20:34:47', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, '', 'babu12f@gmail.com', '147', NULL, NULL, NULL, NULL, NULL, 0, '2015-09-11 20:34:47', NULL, NULL, NULL, NULL, NULL, NULL, 3),
(3, 'shofiullah babor', 'babu12f@hotmail.com', '159', NULL, NULL, 'feni', 'feni', '1240', 0, '2015-09-11 20:50:10', NULL, NULL, '01814772282', NULL, 'bangladesh', 'pathan bari road', 3),
(10, 'shofiullah babor', 'babu_12f@lkmail.com', '1478', 'shofiullah', 'babor', 'febu', 'Feni', '14789', 0, '2015-09-13 19:13:17', NULL, '01814772282', '01824772282', '2', 'alam mansion', 'detail address for feni', 3),
(6, 'shofiullah babor', 'babu_12f@kmail.com', '255325', 'shofiullah', 'babor', 'feni', 'Feni', '1200', 0, '2015-09-13 10:29:08', NULL, '01814772282', '01824772282', 'Bangladesh', 'alam mansion', 'santo co road', 3),
(11, 'shofiullah babor', 'babu_12f@lkkmail.com', '', 'shofiullah', 'babor', 'febu', 'Feni', '14789', 0, '2015-09-13 19:17:48', NULL, '01814772282', '01824772282', '2', 'alam mansion', 'detail address for feni', 3),
(9, 'shofiullah babor', 'babu_12f@kmaikl.com', '255325', 'shofiullah', 'babor', 'feni', 'Feni', '1200', 0, '2015-09-13 18:26:12', NULL, '01254', '01824772282', 'Bangladesh', '', 'afdafdsfdsafda  dfsaf', 3),
(12, 'shofiullah babor', 'babu_12f@kjjmail.com', '255325', 'shofiullah', 'babor', 'febu', 'Feni', '3625', 0, '2015-09-13 19:18:58', NULL, '01814772282', '01824772282', 'Bangladesh', 'alam mansion', 'ghsgdfsgdsfgdfgdsd', 2),
(13, 'shofiullah ', '', '', 'shofiullah', '', '', '-- District --', '', 0, '2015-09-17 23:35:37', NULL, '', '', '-- Country --', '', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `namegenarate`
--
ALTER TABLE `namegenarate`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `optiongroups`
--
ALTER TABLE `optiongroups`
 ADD PRIMARY KEY (`OptionGroupID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
 ADD PRIMARY KEY (`OptionID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
 ADD PRIMARY KEY (`DetailID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `productcategories`
--
ALTER TABLE `productcategories`
 ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `productoptions`
--
ALTER TABLE `productoptions`
 ADD PRIMARY KEY (`ProductOptionID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `namegenarate`
--
ALTER TABLE `namegenarate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `optiongroups`
--
ALTER TABLE `optiongroups`
MODIFY `OptionGroupID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
MODIFY `OptionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
MODIFY `DetailID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `productoptions`
--
ALTER TABLE `productoptions`
MODIFY `ProductOptionID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `ProductID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `UserID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
