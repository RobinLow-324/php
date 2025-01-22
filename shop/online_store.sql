-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2025 at 07:12 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `password` varchar(10) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` varchar(20) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `date_of_birth`, `registration_date_time`, `account_status`) VALUES
(1, 'William', '2345', 'wei', 'jian', 'Male', '2006-06-15', '2024-12-18 05:40:26', 'Active'),
(2, 'Jun_wei', '2506', 'Jun', 'Wei', 'Male', '2003-08-22', '2024-12-18 05:40:26', 'Active'),
(3, 'jian_bin', '2010', 'Jian', 'Bin', 'Male', '2003-01-10', '2024-12-18 05:40:26', 'Inactive'),
(4, 'Harry', '2005', 'Harry', 'Potter', 'Male', '1998-03-27', '2024-12-18 05:40:26', 'Pending'),
(5, 'Kai_wei', '2007', 'Kai', 'Wei', 'Male', '2005-12-05', '2024-12-18 05:40:26', 'Active'),
(6, 'Robin_low', '1995', 'robin', 'low', 'Male', '2005-03-24', '2024-12-18 06:00:24', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `promotion_price` double NOT NULL,
  `manufacture_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created` date DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `promotion_price`, `manufacture_date`, `expired_date`, `created`, `category_id`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(3, 'Gatorade', 'This is a very good drink for athletes.', 1.99, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(4, 'Eye Glasses', 'It will make you read better.', 6, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(5, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(6, 'Mouse', 'Very useful if you love your computer.', 11.35, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(7, 'Earphone', 'You need this one if you love music.', 7, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(8, 'Pillow', 'Sleeping well is important.', 8.99, 0, '2025-01-15', '0000-00-00', NULL, NULL),
(9, 'Bread', 'very nice', 10, 0, '2025-01-15', '2025-01-25', NULL, NULL),
(11, 'hotdog', 'very hot', 15, 10, '2025-01-15', '2025-01-25', '2025-01-15', NULL),
(12, 'Laptop', 'RTX3060 , 520GB , 12Ram', 4000, 3800, '2025-01-15', '0000-00-00', '2025-01-15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_cat_id` int NOT NULL,
  `product_cat_name` text NOT NULL,
  `product_cat_description` text NOT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_name`, `product_cat_description`) VALUES
(101, 'Electronics', 'Devices like smartphones, laptops, and accessories.'),
(102, 'Fashion', 'Clothing and accessories for all genders and ages.'),
(103, 'Sport', 'All sporting goods'),
(104, 'Books', 'Printed and digital books across various genres.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
