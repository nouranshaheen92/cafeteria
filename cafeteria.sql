-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2016 at 12:43 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Hot'),
(2, 'Cold');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `customer_telephone` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_extension` varchar(100) NOT NULL,
  `customer_username` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `customer_image` varchar(100) DEFAULT NULL,
  `customer_notes` varchar(100) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `customer_name` (`customer_name`),
  UNIQUE KEY `customer_username` (`customer_username`),
  KEY `customer_ibfk_1` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_telephone`, `customer_email`, `customer_extension`, `customer_username`, `customer_password`, `customer_image`, `customer_notes`, `room_id`) VALUES
(1, 'Admin', '01001122334', 'admin@gmail.com', '1234', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'profile.jpg', 'Notes', 1),
(8, 'Hend', '010998989898', 'hend@gmail.com', '152', 'hend', '81dc9bdb52d04dc20036dbd8313ed055', 'images.jpg', 'Notes', 2),
(9, 'Hoda', '013142526712', 'hoda.mtaha@gmail.com', '12345', 'hoda', '533107c202fe579936fb59f9bde33e2e', '765-default-avatar.png', 'Notes', 1),
(10, 'Menna', '01091840494', 'menna@gmail.com', '102', 'Menna', '81dc9bdb52d04dc20036dbd8313ed055', 'images.jpg', 'Notes', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_time` varchar(100) NOT NULL,
  `order_notes` text,
  `order_status` enum('Processing','Out Of Delivery','Delivered') NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `orders_ibfk_1` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_time`, `order_notes`, `order_status`, `customer_id`) VALUES
(1, '03/01/2016', NULL, 'Delivered', 1),
(2, '03/01/2016', NULL, 'Processing', 1),
(3, '05/03/2016', 'Notes', 'Processing', NULL),
(4, '05/03/2016', 'Notes', 'Processing', NULL),
(5, '05/03/2016', 'Notes2', 'Processing', NULL),
(6, '05/03/2016', '', 'Processing', NULL),
(9, '06/03/2016', '', 'Processing', 1),
(13, '07/03/2016', 'Notes Test', 'Processing', 1),
(14, '07/03/2016', 'Menna', 'Processing', NULL),
(15, '07/03/2016', '', 'Processing', 9),
(16, '10/03/2016', '', 'Processing', 9),
(17, '10/03/2016', '', 'Processing', 9),
(23, '16/03/2016', 'nnnnnnnnmmmmmm', 'Processing', 8),
(24, '16/03/2016', 'hoda', 'Processing', 9),
(25, '16/03/2016', 'hend', 'Processing', 8),
(27, '17/03/2016', 'tessssssssssssssst', 'Processing', 9),
(28, '17/03/2016', 'hhhhhhhhhhhhhh', 'Processing', 9),
(29, '17/03/2016', 'test 1', 'Processing', 9),
(34, '03/17/2016', 'neeeeeew', 'Processing', 9),
(35, '03/17/2016', 'neeeeeew', 'Processing', 9),
(36, '17/03/2016', 'Test 1', 'Processing', 1),
(37, '17/03/2016', '', 'Processing', 1),
(39, '17/03/2016', '', 'Processing', 8),
(42, '17/03/2016', '', 'Processing', 10),
(43, '17/03/2016', '', 'Processing', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `order_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_details_product_quantity` int(11) NOT NULL,
  `order_details_unit_price` float NOT NULL,
  `order_details_total_price` double DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_details_id`),
  KEY `order_details_ibfk_1` (`product_id`),
  KEY `order_details_ibfk_2` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_details_product_quantity`, `order_details_unit_price`, `order_details_total_price`, `product_id`, `order_id`) VALUES
(1, 2, 4, 8, 2, 1),
(2, 5, 2, 10, 3, 1),
(3, 1, 3.5, 3.5, 3, 2),
(4, 3, 3, 9, 4, 2),
(7, 1, 4, 4, 4, 3),
(8, 1, 3, 3, 4, 4),
(9, 1, 4, 4, 5, 5),
(10, 1, 2, 2, 2, 5),
(11, 1, 3.5, 3.5, 3, 5),
(12, 5, 4, 20, 5, 6),
(13, 5, 3, 15, 4, 6),
(17, 1, 4, 4, 2, 9),
(21, 1, 4, 4, 2, 13),
(22, 1, 3.5, 3.5, 3, 13),
(23, 2, 4, 8, 2, 14),
(24, 1, 3.5, 3.5, 3, 14),
(25, 1, 4, 4, 2, 15),
(26, 1, 4, 4, 2, 16),
(27, 1, 4, 4, 2, 17),
(28, 2, 4, 8, 2, 13),
(29, 3, 4, 12, 2, 23),
(30, 1, 4, 4, 2, 24),
(31, 1, 3.5, 3.5, 3, 24),
(32, 1, 4, 4, 2, 24),
(33, 1, 4, 4, 2, 25),
(34, 1, 3.5, 3.5, 3, 25),
(35, 1, 3, 3, 4, 25),
(38, 1, 4, 4, 2, 27),
(39, 1, 3.5, 3.5, 3, 27),
(40, 1, 4, 4, 2, 28),
(41, 1, 3.5, 3.5, 3, 28),
(42, 1, 4, 4, 2, 29),
(43, 1, 3.5, 3.5, 3, 29),
(44, 4, 4, 16, 2, 34),
(45, 6, 3.5, 21, 3, 34),
(46, 6, 3, 18, 4, 34),
(47, 4, 4, 16, 2, 35),
(48, 6, 3.5, 21, 3, 35),
(49, 6, 3, 18, 4, 35),
(50, 6, 4, 24, 2, 36),
(51, 2, 3.5, 7, 3, 36),
(52, 1, 3.5, 3.5, 3, 37),
(55, 1, 4, 4, 2, 39),
(56, 1, 3.5, 3.5, 3, 39),
(62, 1, 4, 4, 2, 42),
(63, 3, 4, 12, 5, 42),
(64, 1, 4, 4, 2, 43),
(65, 1, 3.5, 3.5, 3, 43),
(66, 1, 3, 3, 4, 43);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_price` float DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `product_available` tinyint(1) DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_name` (`product_name`),
  KEY `products_ibfk_1` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_available`, `category_id`) VALUES
(2, 'Late', 4, 'late.jpg', 1, 1),
(3, 'Pepsi', 3.5, 'pepsi.jpg', 1, 2),
(4, 'Fanta', 3, 'fanta.jpg', 1, 2),
(5, 'Sprite', 4, 'sprite.png', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(100) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`) VALUES
(1, '1001'),
(2, '1002');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
