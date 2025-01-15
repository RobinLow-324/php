-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 15, 2025 at 04:42 AM
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
  `username` varchar(50) NOT NULL,
  `password` varchar(10) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`, `first_name`, `last_name`, `gender`, `date_of_birth`, `registration_date_time`, `account_status`) VALUES
(1, 'William', '1234', 'wei', 'jian', 'Male', '2006-06-15', '2024-12-18 05:40:26', 'Active'),
(2, 'Jun_wei', 'Jun@2023', 'Jun', 'Wei', 'Male', '2003-08-22', '2024-12-18 05:40:26', 'Active'),
(3, 'jian_bin', 'Jian$4567', 'Jian', 'Bin', 'Male', '2003-01-10', '2024-12-18 05:40:26', 'Inactive'),
(4, 'Harry', 'Happy#7890', 'Harry', 'Potter', 'Male', '1998-03-27', '2024-12-18 05:40:26', 'Pending'),
(5, 'Kai_wei', 'Kai789', 'Kai', 'Wei', 'Male', '2005-12-05', '2024-12-18 05:40:26', 'Active'),
(6, 'Robin_low', 'robin324', 'robin', 'low', 'Male', '2005-03-24', '2024-12-18 06:00:24', 'Active');

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
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `promotion_price`, `created`, `modified`, `manufacture_date`, `expired_date`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, 0, '2015-08-02 12:04:03', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gatorade', 'This is a very good drink for athletes.', 1.99, 0, '2015-08-02 12:14:29', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Eye Glasses', 'It will make you read better.', 6, 0, '2015-08-02 12:15:04', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, 0, '2015-08-02 12:16:08', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Mouse', 'Very useful if you love your computer.', 11.35, 0, '2015-08-02 12:17:58', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Earphone', 'You need this one if you love music.', 7, 0, '2015-08-02 12:18:21', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Pillow', 'Sleeping well is important.', 8.99, 0, '2015-08-02 12:18:56', '2015-08-05 22:59:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Bread', '', 5.5, 0, '2024-12-13 03:04:41', '2024-12-13 03:04:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
