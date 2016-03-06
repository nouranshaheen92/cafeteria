-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2016 at 01:24 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_telephone`, `customer_email`, `customer_extension`, `customer_username`, `customer_password`, `customer_image`, `customer_notes`, `room_id`) VALUES
(1, 'admin Person', '01001122334', 'admin@gmail.com', '1234', 'admin', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 1),
(2, 'test', '01112255887', 'test@gmail.com', '1234', 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'profile.jpg', 'Notes', 1),
(3, 'Hoda', '01007783632', 'hoda@gmail.com', '1234', 'hoda', '81dc9bdb52d04dc20036dbd8313ed055', 'hoda.png', 'Notes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_time` varchar(100) NOT NULL,
  `order_notes` text,
  `delivery_status` enum('Processing','Out Of Delivery','Delivered') NOT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `orders_ibfk_1` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_time`, `order_notes`, `delivery_status`, `customer_id`) VALUES
(1, '03/01/2016 11:10 AM', NULL, 'Processing', 1),
(2, '03/01/2016 11:11 AM', NULL, 'Processing', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_details_id`, `order_details_product_quantity`, `order_details_unit_price`, `order_details_total_price`, `product_id`, `order_id`) VALUES
(1, 2, 4, 8, 1, 1),
(2, 5, 2, 10, 7, 1),
(3, 1, 3.5, 3.5, 3, 2),
(4, 3, 3, 9, 4, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `product_image`, `product_available`, `category_id`) VALUES
(1, 'Nescafe', 4, 'cafe.jpg', 1, 1),
(2, 'Late', 4, 'late.jpg', 1, 1),
(3, 'Pepsi', 3.5, 'pepsi.jpg', 1, 2),
(4, 'Fanta', 3, 'fanta.jpg', 1, 2),
(5, 'Sprite', 4, 'sprite.png', 1, 2),
(7, 'Tea', 2, 'tea.png', 1, 1);

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
