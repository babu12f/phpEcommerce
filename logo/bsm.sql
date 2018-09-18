-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 09:46 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `productId`, `comment`, `userId`, `commentDate`) VALUES
(1, 12, 'fsdfafsdf', 1, '2015-09-26 23:15:04'),
(2, 4, 'very good', 4, '2015-09-29 21:29:55'),
(3, 4, 'cool', 4, '2015-09-29 21:30:07'),
(4, 4, 'rqreqrqew', 4, '2015-09-29 21:32:49'),
(5, 4, 'this is good', 4, '2015-09-29 21:47:17'),
(6, 16, 'this is a comments', 4, '2015-09-30 00:52:59'),
(7, 15, 'this is goor', 2, '2015-10-01 17:39:16'),
(8, 21, 'comment', 4, '2016-01-18 14:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `namegenarate`
--

CREATE TABLE IF NOT EXISTS `namegenarate` (
  `id` int(11) NOT NULL,
  `imageName` varchar(50) NOT NULL,
  `OrderUniqueId` int(11) NOT NULL,
  `ProductIdGenarate` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `namegenarate`
--

INSERT INTO `namegenarate` (`id`, `imageName`, `OrderUniqueId`, `ProductIdGenarate`, `date`) VALUES
(1, '2', 1, 5, '2017-01-13');

-- --------------------------------------------------------

--
-- Table structure for table `optiongroups`
--

CREATE TABLE IF NOT EXISTS `optiongroups` (
  `OptionGroupID` int(11) NOT NULL,
  `OptionGroupName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL,
  `optionDescription` varchar(100) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `optiongroups`
--

INSERT INTO `optiongroups` (`OptionGroupID`, `OptionGroupName`, `optionDescription`) VALUES
(2, 'Size', '15 16'),
(3, 'color', 'faf'),
(6, 'mobile phn color', 'mobile phone color');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `OptionID` int(11) NOT NULL,
  `OptionGroupID` int(11) DEFAULT NULL,
  `OptionName` varchar(50) COLLATE latin1_german2_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`OptionID`, `OptionGroupID`, `OptionName`) VALUES
(1, 2, '15'),
(2, 2, '15.5'),
(3, 2, '16'),
(4, 2, '16.5'),
(5, 3, 'blue'),
(6, 3, 'red'),
(7, 3, 'green'),
(12, 6, 'black'),
(13, 6, 'white'),
(14, 6, 'silver');

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`DetailID`, `DetailOrderIDUnique`, `DetailProductID`, `DetailName`, `DetailPrice`, `DetailAttribute`, `DetailQuantity`) VALUES
(1, 201509211, 2, 'kana', 3213, 'Size : 15, Color : red', 2),
(2, 201509201, 1, 'kana', 123, 'Size : 16', 1),
(3, 201509281, 12, 'PRODUCT 2', 213, '', 4),
(4, 201509301, 4, 'afadsf', 3213, '', 1),
(5, 201509301, 12, 'PRODUCT 2', 213, '', 1),
(6, 201509302, 12, 'PRODUCT 2', 213, '', 1),
(7, 201510011, 16, 'PRODUCT 16', 12, 'Size : 16.5', 1),
(8, 201510012, 4, 'afadsf', 3213, '', 1),
(9, 201510012, 15, 'res', 2132, '', 1),
(10, 201510013, 12, 'PRODUCT 2', 213, '', 1),
(11, 201601182, 16, 'PRODUCT 16', 12, 'Size : 15.5', 1),
(12, 201601184, 4, 'afadsf', 3213, '', 2),
(13, 201601186, 16, 'PRODUCT 16', 12, 'Size : 16.5', 1),
(14, 201601186, 17, 'fdvd', 1200, 'Size : 16', 1),
(15, 201601186, 13, 'PRODUCT 2', 213, 'Color : blue', 1),
(16, 201601187, 21, 'p in s 1', 123, 'Size : 15.5', 1),
(17, 201601188, 9, 'PRODUCT 2', 213, 'Color : blue', 1),
(18, 201701131, 12, 'PRODUCT 2', 213, '', 2),
(19, 201701131, 15, 'res', 2132, '', 5);

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
  `OrderStatus` int(11) NOT NULL DEFAULT '0',
  `o_store` bigint(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `OrderUniqueId`, `OrderUserID`, `OrderGuestName`, `OrderAmount`, `OrderQuntity`, `OrderShipName`, `OrderShipAddress`, `OrderCity`, `OrderZip`, `OrderCountry`, `OrderPhone`, `OrderMobile`, `OrderShippingCost`, `OrderTax`, `OrderEmail`, `OrderDate`, `OrderShipped`, `OrderStatus`, `o_store`) VALUES
(1, 201509211, 2, '', 6426, 1, '', '1', '', '', '', '', '', 0, 0, 'babu_12f@yahoo.com', '2015-09-20 14:01:57', 0, 0, 0),
(2, 201509201, 2, '', 123, 1, '', '1', '', '', '', '', '', 0, 0, 'babu_12f@yahoo.com', '2015-09-19 22:33:22', 0, 0, 0),
(3, 201509281, 4, 'tanvir alam sakib', 852, 1, '351/1/a,tilpapara,dhaka-1219', '3', 'Feni', '24324', '', '01552339425', 'Bangladesh', 0, 0, 'tanvirasakib@gmail.com', '2015-09-27 13:14:41', 0, 0, 0),
(4, 201509301, 2, '', 3426, 2, '', '1', '', '', '', '', '', 47, 0, 'babu_12f@yahoo.com', '2015-09-29 14:22:45', 0, 0, 0),
(5, 201509302, 0, 'babor', 213, 1, 'feni shn', 'santi co raak feni', '5', '125', 'Bangladesh', '1234567890', '01814772282', 25, 0, 'babor@k.com', '2015-09-29 14:26:53', 0, 0, 0),
(6, 201510011, 0, 'alkfjds', 12, 1, 'ajfsdjflkaf', 'the quiick brown fox jumps over a alzyddog', 'Feni', '1200', 'Bangladesh', '12345678901', '01814772282', 0, 0, 'babor@k.com', '2015-09-30 15:03:08', 0, 0, 0),
(7, 201510012, 5, 'riyad mhib', 5345, 2, 'rrthdh rretryjyf ertrtty', '3', 'Dhaka', '3900', '', '01829913207', 'Bangladesh', 0, 0, 'riyad@yahoo.com', '2015-09-30 17:15:17', 0, 0, 0),
(8, 201510013, 5, 'riyad mhib', 213, 1, 'rrthdh rretryjyf ertrtty', '3', 'Dhaka', '3900', '', '01829913207', 'Bangladesh', 50, 0, 'riyad@yahoo.com', '2015-09-30 23:32:25', 0, 1, 0),
(9, 201601182, 4, 'tanvir alam sakib', 12, 1, '143/3 til pa para', '3', 'Feni', '324', 'khilgaon', '01554321425', 'Bangladesh', 0, 0, 'tanvir@hotmail.com', '2016-01-17 12:54:58', 0, 0, 0),
(10, 201601184, 4, 'tanvir alam sakib', 6426, 1, '143/3 til pa para', '3', 'Feni', '324', 'khilgaon', '01554321425', 'Bangladesh', 0, 0, 'tanvir@hotmail.com', '2016-01-17 12:55:55', 0, 0, 0),
(11, 201601185, 4, 'tanvir alam sakib', 1425, 3, '143/3 til pa para', '3', 'Feni', '324', 'khilgaon', '01554321425', 'Bangladesh', 0, 0, 'tanvir@hotmail.com', '2016-01-17 13:12:48', 0, 1, 1),
(12, 201601186, 4, 'tanvir alam sakib', 1425, 3, '143/3 til pa para', '3', 'Feni', '324', 'khilgaon', '01554321425', 'Bangladesh', 0, 0, 'tanvir@hotmail.com', '2016-01-17 13:12:48', 0, 0, 2),
(13, 201601187, 4, 'tanvir alam sakib', 123, 1, '143/3 til pa para', '3', 'Feni', '324', 'khilgaon', '01554321425', 'Bangladesh', 0, 0, 'tanvir@hotmail.com', '2016-01-18 02:59:59', 0, 5, 1),
(14, 201601188, 0, 'habib', 213, 1, 'fsafsadfdsaffasdf', 'dhanmindi 4A jigatola', 'Dhaka', '1200', 'Bangladesh', '1234567890', '01814772284', 50, 0, 'babu12f@gmail.com', '2016-01-18 04:31:37', 0, 1, 1),
(15, 201701131, 0, 'saurav', 11086, 2, 'short address', 'ajkfdlksjfklajsklfd', 'Chittagong', '2123', 'Bangladesh', '03120302130', '97842937498', 47, 0, 'saurav@k.com', '2017-01-13 10:54:40', 0, 0, 1);

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
(2, 1),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(13, 1),
(13, 2),
(15, 1),
(1, 1),
(14, 1),
(14, 2),
(12, 1),
(17, 3),
(21, 1),
(22, 1),
(24, 3);

-- --------------------------------------------------------

--
-- Table structure for table `productcategories`
--

CREATE TABLE IF NOT EXISTS `productcategories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(50) COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `productcategories`
--

INSERT INTO `productcategories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Formal Shirt'),
(2, 'Casual Shirt'),
(3, 'T-shirt');

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
(5, 'images/shirt.jpg', '0'),
(5, 'images/images.jpg', '1'),
(6, 'images/shirt.jpg', '0'),
(6, 'images/images.jpg', '1'),
(7, 'images/shirt.jpg', '0'),
(7, 'images/images.jpg', '1'),
(9, 'images/shirt.jpg', '0'),
(9, 'images/images.jpg', '1'),
(10, 'images/shirt.jpg', '0'),
(10, 'images/images.jpg', '1'),
(11, 'images/shirt.jpg', '0'),
(11, 'images/images.jpg', '1'),
(13, 'images/shirt.jpg', '0'),
(13, 'images/images.jpg', '1'),
(15, 'images/Desert.jpg', '0'),
(15, 'images/t-shirt.png', '1'),
(1, 'images/201509203.png', '0'),
(1, 'images/201509204.png', '1'),
(14, 'images/shirt.jpg', '0'),
(14, 'images/images.jpg', '1'),
(12, 'images/shirt.jpg', '1'),
(12, 'images/images.jpg', '0'),
(4, 'images/Penguins.jpg', '0'),
(4, 'images/201509sssss204.png', '1'),
(17, 'images/201509205.png', '1'),
(17, 'images/201509207.png', '0'),
(21, 'images/1370944794.jpg', '1'),
(22, 'images/b.jpg', '1'),
(23, 'images/201509203.png', '1'),
(24, 'images/201509203.png', '1');

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
(5, 3),
(6, 3),
(7, 3),
(9, 3),
(10, 3),
(11, 3),
(13, 3),
(1, 2),
(17, 2),
(21, 2),
(22, 2),
(23, 6),
(24, 6);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `ProductID` bigint(20) NOT NULL,
  `ProductUniqueId` bigint(20) NOT NULL,
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
  `ProductLive` tinyint(1) DEFAULT '-1',
  `ProductUnlimited` tinyint(1) DEFAULT '1',
  `ProductLocation` varchar(250) COLLATE latin1_german2_ci DEFAULT NULL,
  `productOffer` varchar(100) COLLATE latin1_german2_ci DEFAULT NULL,
  `product_store` bigint(20) NOT NULL,
  `jsImage` text COLLATE latin1_german2_ci NOT NULL,
  `opt` text COLLATE latin1_german2_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `ProductUniqueId`, `ProductName`, `ProductPrice`, `prevPrice`, `ProductWeight`, `ProductCartDesc`, `ProductShortDesc`, `ProductLongDesc`, `ProductThumb`, `ProductImage`, `ProductCategoryID`, `ProductAddDate`, `ProductUpdateDate`, `ProductStock`, `ProductLive`, `ProductUnlimited`, `ProductLocation`, `productOffer`, `product_store`, `jsImage`, `opt`) VALUES
(1, 201509201, 'kana', 123, 1234, 0, '', 'asdfsda', 'sdfa', '', 'images/201509203.png', NULL, '2015-09-20 00:00:00', '2015-09-20 11:39:53', NULL, 1, 1, NULL, 'sdaff', 2, '', ''),
(2, 201509211, 'kana', 3213, 3213, 0, '', 'asfda', 'fasd', '', 'images/201509204.png', NULL, '2015-09-21 00:00:00', '2015-09-20 12:01:10', NULL, 1, 1, NULL, 'fas', 2, '', ''),
(3, 201509212, 'fdsafa', 2113, 321312, 0, '', 'fdsaf', 'fasdfa', '', 'images/girl2.jpg', NULL, '2015-09-21 00:00:00', '2015-09-20 12:05:50', NULL, 1, 1, NULL, 'f', 2, '', ''),
(4, 201509213, 'afadsf', 3213, 3213, 0, '', 'sdafasd', '  fadsf  ', '', 'images/201509sssss204.png', NULL, '2015-09-21 00:00:00', '2015-09-25 23:43:12', NULL, 0, 1, NULL, 'sdfd', 2, '', ''),
(5, 201509214, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:11:00', '2015-09-20 14:11:00', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(6, 201509215, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:11:40', '2015-09-20 14:11:40', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(7, 201509216, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:11:42', '2015-09-20 14:11:42', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(17, 201510021, 'fdvd', 1200, 1300, 0, '', 'czxvxcv', 'fvzxcvcx', '', 'images/201509205.png', NULL, '2015-10-02 12:39:47', '2015-10-02 00:39:47', NULL, 1, 1, NULL, '34', 2, '', ''),
(9, 201509218, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:16:16', '2015-09-20 14:16:16', NULL, 1, 1, NULL, 'dsad', 1, '', ''),
(10, 201509219, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:16:18', '2015-09-20 14:16:18', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(11, 2015092110, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:16:21', '2015-09-20 14:16:21', NULL, 1, 1, NULL, 'dsad', 1, '', ''),
(12, 2015092111, 'PRODUCT 2', 213, 23123, 0, '', 'product 2 short', '             FDSAFDS             ', '', 'images/shirt.jpg', NULL, '2015-09-21 02:16:23', '2015-09-25 23:35:13', NULL, 1, 1, NULL, '3.35%', 1, '', ''),
(13, 2015092112, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', 'FDSAFDS', '', 'images/images.jpg', NULL, '2015-09-21 02:16:38', '2015-09-20 14:16:38', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(14, 2015092113, 'PRODUCT 2', 213, 23123, 0, '', 'fgsgfdgs', ' FDSAFDS ', '', 'images/images.jpg', NULL, '2015-09-21 02:16:47', '2015-09-25 23:19:35', NULL, 1, 1, NULL, 'dsad', 2, '', ''),
(15, 201509221, 'res', 2132, 2312, 0, '', 'dsad', 'sasd', '', 'images/t-shirt.png', NULL, '2015-09-22 04:04:00', '2015-09-21 16:04:00', NULL, 1, 1, NULL, 'saf', 1, '', ''),
(22, 201601183, 'product naem', 200, 300, 0, '', 'short des', ' long drs ', '', 'products/dress1home.jpg', NULL, '2016-01-18 16:35:06', '2017-01-13 10:52:41', NULL, 1, 1, NULL, '-5%', 0, '["products\\/dress1home.jpg","products\\/dress5home.jpg","products\\/dress4home.jpg","products\\/dress6home.jpg"]', ''),
(21, 201601182, 'p in s 1', 123, 2312, 0, '', 'asdfdas', 'long des s1', '', 'images/1370944794.jpg', NULL, '2016-01-18 02:28:24', '2016-01-17 14:28:24', NULL, 1, 1, NULL, '-5%', 1, '', ''),
(23, 201701134, 'samsung s7 edge', 300000, 350000, 0, '', 'description', 'this is cool', '', 'images/201509203.png', NULL, '2017-01-13 17:15:07', '2017-01-13 11:15:07', NULL, 1, 1, NULL, '2%', 0, '', ''),
(24, 201701135, 'samsung s7 edge', 300000, 350000, 0, '', 'description', 'this is cool', '', 'images/201509203.png', NULL, '2017-01-13 17:15:39', '2017-01-13 11:15:39', NULL, 1, 1, NULL, '2%', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `servicearea`
--

CREATE TABLE IF NOT EXISTS `servicearea` (
  `id` bigint(20) NOT NULL,
  `district` varchar(50) NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `servicearea`
--

INSERT INTO `servicearea` (`id`, `district`, `cost`) VALUES
(1, 'Feni', 0),
(2, 'Dhaka', 50),
(3, 'Chittagong', 47);

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
(1, 1, 'safsad'),
(3, 2, 'yrtytryrt'),
(4, 2, 'jjjlk'),
(5, 100, 'dafd');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` bigint(20) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_type` text NOT NULL,
  `store_woner` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_type`, `store_woner`) VALUES
(1, 'mithila store', 'type', 6),
(2, 'another store', 'tt', 7),
(3, 'n', 't', 1),
(4, 's store name', 's toeme detail', 11);

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
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserFullName`, `UserEmail`, `UserPassword`, `UserFirstName`, `UserLastName`, `UserCity`, `UserDistrict`, `UserZip`, `UserEmailVerified`, `UserRegistrationDate`, `UserVerificationCode`, `UserPhone`, `UserMobile`, `UserCountry`, `UserShortAddress`, `UserDetailAddress`, `UserType`) VALUES
(1, 'motaher hossain murad', 'mdmhmurad51@gmail.com', 'murad870257940257', NULL, NULL, NULL, NULL, NULL, 0, '2015-09-20 09:03:58', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, ' babor', 'babu_12f@yahoo.com', '12345', '', '', '', 'Feni', '', 0, '2015-09-20 11:37:22', NULL, '', '', 'Bangladesh', '', '', 1),
(3, 'asdfgh ', '', '', 'asdfgh', '', '', '-- District --', '', 0, '2015-09-28 01:01:21', NULL, '', '12345678909', 'Bangladesh', '', 'dfgffhgfttfyh', 3),
(4, 'tanvir alam sakib', 'tanvir@hotmail.com', '123', 'tanvir', 'alam sakib', 'dhaka', 'Feni', '324', 0, '2015-09-28 01:10:26', NULL, '', '01554321425', 'Bangladesh', 'khilgaon', '143/3 til pa para', 3),
(5, 'riyad mhib', 'riyad@yahoo.com', 'sasa123', 'riyad', 'mhib', 'feni', 'Dhaka', '3900', 0, '2015-10-01 04:30:06', NULL, '033367', '01829913207', 'Bangladesh', '', 'rrthdh rretryjyf ertrtty', 3),
(6, '', 'store', 'store', NULL, NULL, NULL, NULL, NULL, 0, '2016-01-17 12:21:34', NULL, NULL, NULL, NULL, NULL, NULL, 4),
(7, '', 'store2', 'store2', NULL, NULL, NULL, NULL, NULL, 0, '2016-01-17 12:22:39', NULL, NULL, NULL, NULL, NULL, NULL, 4),
(11, 'babu sofi', 'b@k.com', '1234', 'babu', 'sofi', NULL, NULL, NULL, 0, '2016-01-17 18:23:24', NULL, NULL, '01814772282', 'Bangladesh', NULL, 'detail address', 4),
(12, 'afsda afsdasdf', 'anik@k.com', '123456', 'afsda', 'afsdasdf', 'dhaka', 'Dhaka', '1200', 0, '2016-01-18 03:08:29', NULL, '01715046689', '01814772284', 'Bangladesh', 'short Address', 'detail Address', 3);

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
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD KEY `productId` (`productId`);

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
-- Indexes for table `servicearea`
--
ALTER TABLE `servicearea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `namegenarate`
--
ALTER TABLE `namegenarate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `optiongroups`
--
ALTER TABLE `optiongroups`
  MODIFY `OptionGroupID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `OptionID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `DetailID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `productcategories`
--
ALTER TABLE `productcategories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `productoptions`
--
ALTER TABLE `productoptions`
  MODIFY `ProductOptionID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `servicearea`
--
ALTER TABLE `servicearea`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
