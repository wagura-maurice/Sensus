-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2017 at 10:57 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sampletestdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `emailaddress` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `telephone`, `emailaddress`) VALUES
(1, 'James Kinyua', '722331935', 'james@isolutions.co.ke'),
(3, 'john muriuki', '721364502', 'muriukijohn@gmail.com'),
(4, 'ian khamadi', '722744579', 'ianksizzn@live.com'),
(5, 'major laibutta', '72231506', 'laibutas17@yahoo.com'),
(6, 'michael kiarie', '733827233', 'm.nkiarie@yahoo.com'),
(7, 'earnest moturi', '722961707', 'earnrst.moturi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
`id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `products` text NOT NULL,
  `total` float NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `customers_id`, `products`, `total`, `status`) VALUES
(1, 1, '["[\\"2\\",\\"www.bingibranding.com\\",\\"website domain\\",\\"1000\\",\\"ksh\\"]","[\\"5\\",\\"www.maalimelectronics.com\\",\\"website domain\\",\\"1000\\",\\"ksh\\"]"]', 2000, 'pending'),
(2, 5, '["[\\"6\\",\\"www.nexxtageoutsourcing.com\\",\\"website domain\\",\\"2000\\",\\"ksh\\"]"]', 2000, 'pending'),
(3, 6, '["[\\"4\\",\\"www.bushpathafricasafaris.com\\",\\"website domain\\",\\"4500\\",\\"ksh\\"]","[\\"3\\",\\"www.drobakchristiancentre.org\\",\\"website domain\\",\\"2000\\",\\"ksh\\"]"]', 6500, 'pending'),
(4, 4, '["[\\"1\\",\\"www.valueit.co.ke\\",\\"website domain\\",\\"5000\\",\\"ksh\\"]","[\\"2\\",\\"www.bingibranding.com\\",\\"website domain\\",\\"1000\\",\\"ksh\\"]","[\\"3\\",\\"www.drobakchristiancentre.org\\",\\"website domain\\",\\"2000\\",\\"ksh\\"]"]', 8000, 'pending'),
(5, 7, '["[\\"4\\",\\"www.bushpathafricasafaris.com\\",\\"website domain\\",\\"4500\\",\\"ksh\\"]","[\\"5\\",\\"www.maalimelectronics.com\\",\\"website domain\\",\\"1000\\",\\"ksh\\"]","[\\"6\\",\\"www.nexxtageoutsourcing.com\\",\\"website domain\\",\\"2000\\",\\"ksh\\"]"]', 7500, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `code`) VALUES
(1, 'www.valueit.co.ke', 'website domain', 5000, 'ksh'),
(2, 'www.bingibranding.com', 'website domain', 1000, 'ksh'),
(3, 'www.drobakchristiancentre.org', 'website domain', 2000, 'ksh'),
(4, 'www.bushpathafricasafaris.com', 'website domain', 4500, 'ksh'),
(5, 'www.maalimelectronics.com', 'website domain', 1000, 'ksh'),
(6, 'www.nexxtageoutsourcing.com', 'website domain', 2000, 'ksh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
