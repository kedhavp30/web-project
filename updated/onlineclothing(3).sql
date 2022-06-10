-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 04:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineclothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `email`, `type`) VALUES
('hdsmathew', '$2y$10$P0FcliOMXsqqA7xvdEuRvOpY9TbqxfuvnbAOxzR9O0NfuT7VpQHJm', 'hdsmathew@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `productId` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `colour` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float NOT NULL,
  `discount` float NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`productId`, `size`, `colour`, `quantity`, `unitPrice`, `discount`, `username`) VALUES
(2, 'M', 'Red', 2, 100, 0, 'hdsmathew'),
(3, 'L', 'Red', 2, 100, 0, 'hdsmathew'),
(6, 'S', 'Blue', 2, 200, 0, 'hdsmathew'),
(11, 'M', 'Blue', 2, 150, 0, 'hdsmathew'),
(13, 'M', 'Blue', 2, 150, 0, 'hdsmathew');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `categoryDesc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryDesc`) VALUES
(1, 'Hoodie', 'Men Hoodies'),
(2, 'Jean', 'Men and Women Jeans'),
(3, 'Jogger', 'Men and Women Joggers'),
(4, 'Shoes', 'Men and Women Shoes'),
(5, 'Sportswear', 'Men and Women Sportswear'),
(6, 'Trousers', 'Men and Women Trousers'),
(7, 'Shirt', 'Men Shirts'),
(8, 'T-shirt', 'Men T-shirts'),
(9, 'Blouse', 'Women Blouses'),
(10, 'Dress', 'Women Dresses'),
(11, 'Sweatshirt', 'Women Sweatshirts');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `customerid` int(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`firstName`, `lastName`, `customerid`, `gender`, `dob`, `address`, `phone`, `username`) VALUES
('Headrick', 'Chan', 1, 'M', '2001-02-04', 'Mauritius', 1234567, 'hdsmathew');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `username` varchar(50) NOT NULL,
  `postedOn` date NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`username`, `postedOn`, `comment`) VALUES
('kedhav', '2022-03-30', 'Do you sell T-shirts?');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productId` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `colour` varchar(10) NOT NULL,
  `reOrderLevel` int(11) NOT NULL,
  `stockLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`productId`, `size`, `colour`, `reOrderLevel`, `stockLevel`) VALUES
(1, 'L', 'Blue', 10, 100),
(1, 'L', 'Red', 10, 100),
(1, 'M', 'Blue', 10, 100),
(1, 'M', 'Red', 10, 100),
(1, 'S', 'Blue', 10, 100),
(1, 'S', 'Red', 10, 100),
(2, 'L', 'Blue', 10, 100),
(2, 'L', 'Red', 10, 100),
(2, 'M', 'Blue', 10, 100),
(2, 'M', 'Red', 10, 100),
(2, 'S', 'Blue', 10, 100),
(2, 'S', 'Red', 10, 100),
(3, 'L', 'Blue', 10, 100),
(3, 'L', 'Red', 10, 100),
(3, 'M', 'Blue', 10, 100),
(3, 'M', 'Red', 10, 100),
(3, 'S', 'Blue', 10, 100),
(3, 'S', 'Red', 10, 100),
(4, 'L', 'Blue', 10, 100),
(4, 'L', 'Red', 10, 100),
(4, 'M', 'Blue', 10, 100),
(4, 'M', 'Red', 10, 100),
(4, 'S', 'Blue', 10, 100),
(4, 'S', 'Red', 10, 100),
(5, 'L', 'Blue', 10, 100),
(5, 'L', 'Red', 10, 100),
(5, 'M', 'Blue', 10, 100),
(5, 'M', 'Red', 10, 100),
(5, 'S', 'Blue', 10, 100),
(5, 'S', 'Red', 10, 100),
(6, 'L', 'Blue', 10, 100),
(6, 'L', 'Red', 10, 100),
(6, 'M', 'Blue', 10, 100),
(6, 'M', 'Red', 10, 100),
(6, 'S', 'Blue', 10, 100),
(6, 'S', 'Red', 10, 100),
(7, 'L', 'Blue', 10, 100),
(7, 'L', 'Red', 10, 100),
(7, 'M', 'Blue', 10, 100),
(7, 'M', 'Red', 10, 100),
(7, 'S', 'Blue', 10, 100),
(7, 'S', 'Red', 10, 100),
(8, 'L', 'Blue', 10, 100),
(8, 'L', 'Red', 10, 100),
(8, 'M', 'Blue', 10, 100),
(8, 'M', 'Red', 10, 100),
(8, 'S', 'Blue', 10, 100),
(8, 'S', 'Red', 10, 100),
(9, 'L', 'Blue', 10, 100),
(9, 'L', 'Red', 10, 100),
(9, 'M', 'Blue', 10, 100),
(9, 'M', 'Red', 10, 100),
(9, 'S', 'Blue', 10, 100),
(9, 'S', 'Red', 10, 100),
(10, 'L', 'Blue', 10, 100),
(10, 'L', 'Red', 10, 100),
(10, 'M', 'Blue', 10, 100),
(10, 'M', 'Red', 10, 100),
(10, 'S', 'Blue', 10, 100),
(10, 'S', 'Red', 10, 100),
(11, 'L', 'Blue', 10, 100),
(11, 'L', 'Red', 10, 100),
(11, 'M', 'Blue', 10, 100),
(11, 'M', 'Red', 10, 100),
(11, 'S', 'Blue', 10, 100),
(11, 'S', 'Red', 10, 100),
(12, 'L', 'Blue', 10, 100),
(12, 'L', 'Red', 10, 100),
(12, 'M', 'Blue', 10, 100),
(12, 'M', 'Red', 10, 100),
(12, 'S', 'Blue', 10, 100),
(12, 'S', 'Red', 10, 100),
(13, 'L', 'Blue', 10, 100),
(13, 'L', 'Red', 10, 100),
(13, 'M', 'Blue', 10, 100),
(13, 'M', 'Red', 10, 100),
(13, 'S', 'Blue', 10, 100),
(13, 'S', 'Red', 10, 100),
(14, 'L', 'Blue', 10, 100),
(14, 'L', 'Red', 10, 100),
(14, 'M', 'Blue', 10, 100),
(14, 'M', 'Red', 10, 100),
(14, 'S', 'Blue', 10, 100),
(14, 'S', 'Red', 10, 100),
(15, 'L', 'Blue', 10, 100),
(15, 'L', 'Red', 10, 100),
(15, 'M', 'Blue', 10, 100),
(15, 'M', 'Red', 10, 100),
(15, 'S', 'Blue', 10, 100),
(15, 'S', 'Red', 10, 100),
(16, 'L', 'Blue', 10, 100),
(16, 'L', 'Red', 10, 100),
(16, 'M', 'Blue', 10, 100),
(16, 'M', 'Red', 10, 100),
(16, 'S', 'Blue', 10, 100),
(16, 'S', 'Red', 10, 100),
(17, 'L', 'Blue', 10, 100),
(17, 'L', 'Red', 10, 100),
(17, 'M', 'Blue', 10, 100),
(17, 'M', 'Red', 10, 100),
(17, 'S', 'Blue', 10, 100),
(17, 'S', 'Red', 10, 100),
(18, 'L', 'Blue', 10, 100),
(18, 'L', 'Red', 10, 100),
(18, 'M', 'Blue', 10, 100),
(18, 'M', 'Red', 10, 100),
(18, 'S', 'Blue', 10, 100),
(18, 'S', 'Red', 10, 100),
(19, 'L', 'Blue', 10, 100),
(19, 'L', 'Red', 10, 100),
(19, 'M', 'Blue', 10, 100),
(19, 'M', 'Red', 10, 100),
(19, 'S', 'Blue', 10, 100),
(19, 'S', 'Red', 10, 100),
(20, 'L', 'Blue', 10, 100),
(20, 'L', 'Red', 10, 100),
(20, 'M', 'Blue', 10, 100),
(20, 'M', 'Red', 10, 100),
(20, 'S', 'Blue', 10, 100),
(20, 'S', 'Red', 10, 100),
(21, 'L', 'Blue', 10, 100),
(21, 'L', 'Red', 10, 100),
(21, 'M', 'Blue', 10, 100),
(21, 'M', 'Red', 10, 100),
(21, 'S', 'Blue', 10, 100),
(21, 'S', 'Red', 10, 100),
(22, 'L', 'Blue', 10, 100),
(22, 'L', 'Red', 10, 100),
(22, 'M', 'Blue', 10, 100),
(22, 'M', 'Red', 10, 100),
(22, 'S', 'Blue', 10, 100),
(22, 'S', 'Red', 10, 100),
(23, 'L', 'Blue', 10, 100),
(23, 'L', 'Red', 10, 100),
(23, 'M', 'Blue', 10, 100),
(23, 'M', 'Red', 10, 100),
(23, 'S', 'Blue', 10, 100),
(23, 'S', 'Red', 10, 100),
(24, 'L', 'Blue', 10, 100),
(24, 'L', 'Red', 10, 100),
(24, 'M', 'Blue', 10, 100),
(24, 'M', 'Red', 10, 100),
(24, 'S', 'Blue', 10, 100),
(24, 'S', 'Red', 10, 100),
(25, 'L', 'Blue', 10, 100),
(25, 'L', 'Red', 10, 100),
(25, 'M', 'Blue', 10, 100),
(25, 'M', 'Red', 10, 100),
(25, 'S', 'Blue', 10, 100),
(25, 'S', 'Red', 10, 100),
(26, 'L', 'Blue', 10, 100),
(26, 'L', 'Red', 10, 100),
(26, 'M', 'Blue', 10, 100),
(26, 'M', 'Red', 10, 100),
(26, 'S', 'Blue', 10, 100),
(26, 'S', 'Red', 10, 100),
(27, 'L', 'Blue', 10, 100),
(27, 'L', 'Red', 10, 100),
(27, 'M', 'Blue', 10, 100),
(27, 'M', 'Red', 10, 100),
(27, 'S', 'Blue', 10, 100),
(27, 'S', 'Red', 10, 100),
(28, 'L', 'Blue', 10, 100),
(28, 'L', 'Red', 10, 100),
(28, 'M', 'Blue', 10, 100),
(28, 'M', 'Red', 10, 100),
(28, 'S', 'Blue', 10, 100),
(28, 'S', 'Red', 10, 100),
(29, 'L', 'Blue', 10, 100),
(29, 'L', 'Red', 10, 100),
(29, 'M', 'Blue', 10, 100),
(29, 'M', 'Red', 10, 100),
(29, 'S', 'Blue', 10, 100),
(29, 'S', 'Red', 10, 100),
(30, 'L', 'Blue', 10, 100),
(30, 'L', 'Red', 10, 100),
(30, 'M', 'Blue', 10, 100),
(30, 'M', 'Red', 10, 100),
(30, 'S', 'Blue', 10, 100),
(30, 'S', 'Red', 10, 100),
(31, 'L', 'Blue', 10, 100),
(31, 'L', 'Red', 10, 100),
(31, 'M', 'Blue', 10, 100),
(31, 'M', 'Red', 10, 100),
(31, 'S', 'Blue', 10, 100),
(31, 'S', 'Red', 10, 100),
(32, 'L', 'Blue', 10, 100),
(32, 'L', 'Red', 10, 100),
(32, 'M', 'Blue', 10, 100),
(32, 'M', 'Red', 10, 100),
(32, 'S', 'Blue', 10, 100),
(32, 'S', 'Red', 10, 100),
(33, 'L', 'Blue', 10, 100),
(33, 'L', 'Red', 10, 100),
(33, 'M', 'Blue', 10, 100),
(33, 'M', 'Red', 10, 100),
(33, 'S', 'Blue', 10, 100),
(33, 'S', 'Red', 10, 100),
(34, 'L', 'Blue', 10, 100),
(34, 'L', 'Red', 10, 100),
(34, 'M', 'Blue', 10, 100),
(34, 'M', 'Red', 10, 100),
(34, 'S', 'Blue', 10, 100),
(34, 'S', 'Red', 10, 100),
(35, 'L', 'Blue', 10, 100),
(35, 'L', 'Red', 10, 100),
(35, 'M', 'Blue', 10, 100),
(35, 'M', 'Red', 10, 100),
(35, 'S', 'Blue', 10, 100),
(35, 'S', 'Red', 10, 100),
(36, 'L', 'Blue', 10, 100),
(36, 'L', 'Red', 10, 100),
(36, 'M', 'Blue', 10, 100),
(36, 'M', 'Red', 10, 100),
(36, 'S', 'Blue', 10, 100),
(36, 'S', 'Red', 10, 100),
(37, 'L', 'Blue', 10, 100),
(37, 'L', 'Red', 10, 100),
(37, 'M', 'Blue', 10, 100),
(37, 'M', 'Red', 10, 100),
(37, 'S', 'Blue', 10, 100),
(37, 'S', 'Red', 10, 100),
(38, 'L', 'Blue', 10, 100),
(38, 'L', 'Red', 10, 100),
(38, 'M', 'Blue', 10, 100),
(38, 'M', 'Red', 10, 100),
(38, 'S', 'Blue', 10, 100),
(38, 'S', 'Red', 10, 100),
(39, 'L', 'Blue', 10, 100),
(39, 'L', 'Red', 10, 100),
(39, 'M', 'Blue', 10, 100),
(39, 'M', 'Red', 10, 100),
(39, 'S', 'Blue', 10, 100),
(39, 'S', 'Red', 10, 100),
(40, 'L', 'Blue', 10, 100),
(40, 'L', 'Red', 10, 100),
(40, 'M', 'Blue', 10, 100),
(40, 'M', 'Red', 10, 100),
(40, 'S', 'Blue', 10, 100),
(40, 'S', 'Red', 10, 100),
(41, 'L', 'Blue', 10, 100),
(41, 'L', 'Red', 10, 100),
(41, 'M', 'Blue', 10, 100),
(41, 'M', 'Red', 10, 100),
(41, 'S', 'Blue', 10, 100),
(41, 'S', 'Red', 10, 100),
(42, 'L', 'Blue', 10, 100),
(42, 'L', 'Red', 10, 100),
(42, 'M', 'Blue', 10, 100),
(42, 'M', 'Red', 10, 100),
(42, 'S', 'Blue', 10, 100),
(42, 'S', 'Red', 10, 100),
(43, 'L', 'Blue', 10, 100),
(43, 'L', 'Red', 10, 100),
(43, 'M', 'Blue', 10, 100),
(43, 'M', 'Red', 10, 100),
(43, 'S', 'Blue', 10, 100),
(43, 'S', 'Red', 10, 100),
(44, 'L', 'Blue', 10, 100),
(44, 'L', 'Red', 10, 100),
(44, 'M', 'Blue', 10, 100),
(44, 'M', 'Red', 10, 100),
(44, 'S', 'Blue', 10, 100),
(44, 'S', 'Red', 10, 100),
(45, 'L', 'Blue', 10, 100),
(45, 'L', 'Red', 10, 100),
(45, 'M', 'Blue', 10, 100),
(45, 'M', 'Red', 10, 100),
(45, 'S', 'Blue', 10, 100),
(45, 'S', 'Red', 10, 100),
(46, 'L', 'Blue', 10, 100),
(46, 'L', 'Red', 10, 100),
(46, 'M', 'Blue', 10, 100),
(46, 'M', 'Red', 10, 100),
(46, 'S', 'Blue', 10, 100),
(46, 'S', 'Red', 10, 100),
(47, 'L', 'Blue', 10, 100),
(47, 'L', 'Red', 10, 100),
(47, 'M', 'Blue', 10, 100),
(47, 'M', 'Red', 10, 100),
(47, 'S', 'Blue', 10, 100),
(47, 'S', 'Red', 10, 100),
(48, 'L', 'Blue', 10, 100),
(48, 'L', 'Red', 10, 100),
(48, 'M', 'Blue', 10, 100),
(48, 'M', 'Red', 10, 100),
(48, 'S', 'Blue', 10, 100),
(48, 'S', 'Red', 10, 100),
(49, 'L', 'Blue', 10, 100),
(49, 'L', 'Red', 10, 100),
(49, 'M', 'Blue', 10, 100),
(49, 'M', 'Red', 10, 100),
(49, 'S', 'Blue', 10, 100),
(49, 'S', 'Red', 10, 100),
(50, 'L', 'Blue', 10, 100),
(50, 'L', 'Red', 10, 100),
(50, 'M', 'Blue', 10, 100),
(50, 'M', 'Red', 10, 100),
(50, 'S', 'Blue', 10, 100),
(50, 'S', 'Red', 10, 100),
(51, 'L', 'Blue', 10, 100),
(51, 'L', 'Red', 10, 100),
(51, 'M', 'Blue', 10, 100),
(51, 'M', 'Red', 10, 100),
(51, 'S', 'Blue', 10, 100),
(51, 'S', 'Red', 10, 100),
(52, 'L', 'Blue', 10, 100),
(52, 'L', 'Red', 10, 100),
(52, 'M', 'Blue', 10, 100),
(52, 'M', 'Red', 10, 100),
(52, 'S', 'Blue', 10, 100),
(52, 'S', 'Red', 10, 100),
(53, 'L', 'Blue', 10, 100),
(53, 'L', 'Red', 10, 100),
(53, 'M', 'Blue', 10, 100),
(53, 'M', 'Red', 10, 100),
(53, 'S', 'Blue', 10, 100),
(53, 'S', 'Red', 10, 100),
(54, 'L', 'Blue', 10, 100),
(54, 'L', 'Red', 10, 100),
(54, 'M', 'Blue', 10, 100),
(54, 'M', 'Red', 10, 100),
(54, 'S', 'Blue', 10, 100),
(54, 'S', 'Red', 10, 100),
(55, 'L', 'Blue', 10, 100),
(55, 'L', 'Red', 10, 100),
(55, 'M', 'Blue', 10, 100),
(55, 'M', 'Red', 10, 100),
(55, 'S', 'Blue', 10, 100),
(55, 'S', 'Red', 10, 100),
(56, 'L', 'Blue', 10, 100),
(56, 'L', 'Red', 10, 100),
(56, 'M', 'Blue', 10, 100),
(56, 'M', 'Red', 10, 100),
(56, 'S', 'Blue', 10, 100),
(56, 'S', 'Red', 10, 100),
(57, 'L', 'Blue', 10, 100),
(57, 'L', 'Red', 10, 100),
(57, 'M', 'Blue', 10, 100),
(57, 'M', 'Red', 10, 100),
(57, 'S', 'Blue', 10, 100),
(57, 'S', 'Red', 10, 100),
(58, 'L', 'Blue', 10, 100),
(58, 'L', 'Red', 10, 100),
(58, 'M', 'Blue', 10, 100),
(58, 'M', 'Red', 10, 100),
(58, 'S', 'Blue', 10, 100),
(58, 'S', 'Red', 10, 100),
(59, 'L', 'Blue', 10, 100),
(59, 'L', 'Red', 10, 100),
(59, 'M', 'Blue', 10, 100),
(59, 'M', 'Red', 10, 100),
(59, 'S', 'Blue', 10, 100),
(59, 'S', 'Red', 10, 100),
(60, 'L', 'Blue', 10, 100),
(60, 'L', 'Red', 10, 100),
(60, 'M', 'Blue', 10, 100),
(60, 'M', 'Red', 10, 100),
(60, 'S', 'Blue', 10, 100),
(60, 'S', 'Red', 10, 100),
(61, 'L', 'Blue', 10, 100),
(61, 'L', 'Red', 10, 100),
(61, 'M', 'Blue', 10, 100),
(61, 'M', 'Red', 10, 100),
(61, 'S', 'Blue', 10, 100),
(61, 'S', 'Red', 10, 100),
(62, 'L', 'Blue', 10, 100),
(62, 'L', 'Red', 10, 100),
(62, 'M', 'Blue', 10, 100),
(62, 'M', 'Red', 10, 100),
(62, 'S', 'Blue', 10, 100),
(62, 'S', 'Red', 10, 100),
(63, 'L', 'Blue', 10, 100),
(63, 'L', 'Red', 10, 100),
(63, 'M', 'Blue', 10, 100),
(63, 'M', 'Red', 10, 100),
(63, 'S', 'Blue', 10, 100),
(63, 'S', 'Red', 10, 100),
(64, 'L', 'Blue', 10, 100),
(64, 'L', 'Red', 10, 100),
(64, 'M', 'Blue', 10, 100),
(64, 'M', 'Red', 10, 100),
(64, 'S', 'Blue', 10, 100),
(64, 'S', 'Red', 10, 100),
(65, 'L', 'Blue', 10, 100),
(65, 'L', 'Red', 10, 100),
(65, 'M', 'Blue', 10, 100),
(65, 'M', 'Red', 10, 100),
(65, 'S', 'Blue', 10, 100),
(65, 'S', 'Red', 10, 100),
(66, 'L', 'Blue', 10, 100),
(66, 'L', 'Red', 10, 100),
(66, 'M', 'Blue', 10, 100),
(66, 'M', 'Red', 10, 100),
(66, 'S', 'Blue', 10, 100),
(66, 'S', 'Red', 10, 100),
(67, 'L', 'Blue', 10, 100),
(67, 'L', 'Red', 10, 100),
(67, 'M', 'Blue', 10, 100),
(67, 'M', 'Red', 10, 100),
(67, 'S', 'Blue', 10, 100),
(67, 'S', 'Red', 10, 100),
(68, 'L', 'Blue', 10, 100),
(68, 'L', 'Red', 10, 100),
(68, 'M', 'Blue', 10, 100),
(68, 'M', 'Red', 10, 100),
(68, 'S', 'Blue', 10, 100),
(68, 'S', 'Red', 10, 100),
(69, 'L', 'Blue', 10, 100),
(69, 'L', 'Red', 10, 100),
(69, 'M', 'Blue', 10, 100),
(69, 'M', 'Red', 10, 100),
(69, 'S', 'Blue', 10, 100),
(69, 'S', 'Red', 10, 100),
(70, 'L', 'Blue', 10, 100),
(70, 'L', 'Red', 10, 100),
(70, 'M', 'Blue', 10, 100),
(70, 'M', 'Red', 10, 100),
(70, 'S', 'Blue', 10, 100),
(70, 'S', 'Red', 10, 100),
(71, 'L', 'Blue', 10, 100),
(71, 'L', 'Red', 10, 100),
(71, 'M', 'Blue', 10, 100),
(71, 'M', 'Red', 10, 100),
(71, 'S', 'Blue', 10, 100),
(71, 'S', 'Red', 10, 100),
(72, 'L', 'Blue', 10, 100),
(72, 'L', 'Red', 10, 100),
(72, 'M', 'Blue', 10, 100),
(72, 'M', 'Red', 10, 100),
(72, 'S', 'Blue', 10, 100),
(72, 'S', 'Red', 10, 100),
(73, 'L', 'Blue', 10, 100),
(73, 'L', 'Red', 10, 100),
(73, 'M', 'Blue', 10, 100),
(73, 'M', 'Red', 10, 100),
(73, 'S', 'Blue', 10, 100),
(73, 'S', 'Red', 10, 100),
(74, 'L', 'Blue', 10, 100),
(74, 'L', 'Red', 10, 100),
(74, 'M', 'Blue', 10, 100),
(74, 'M', 'Red', 10, 100),
(74, 'S', 'Blue', 10, 100),
(74, 'S', 'Red', 10, 100),
(75, 'L', 'Blue', 10, 100),
(75, 'L', 'Red', 10, 100),
(75, 'M', 'Blue', 10, 100),
(75, 'M', 'Red', 10, 100),
(75, 'S', 'Blue', 10, 100),
(75, 'S', 'Red', 10, 100),
(76, 'L', 'Blue', 10, 100),
(76, 'L', 'Red', 10, 100),
(76, 'M', 'Blue', 10, 100),
(76, 'M', 'Red', 10, 100),
(76, 'S', 'Blue', 10, 100),
(76, 'S', 'Red', 10, 100),
(77, 'L', 'Blue', 10, 100),
(77, 'L', 'Red', 10, 100),
(77, 'M', 'Blue', 10, 100),
(77, 'M', 'Red', 10, 100),
(77, 'S', 'Blue', 10, 100),
(77, 'S', 'Red', 10, 100),
(78, 'L', 'Blue', 10, 100),
(78, 'L', 'Red', 10, 100),
(78, 'M', 'Blue', 10, 100),
(78, 'M', 'Red', 10, 100),
(78, 'S', 'Blue', 10, 100),
(78, 'S', 'Red', 10, 100),
(79, 'L', 'Blue', 10, 100),
(79, 'L', 'Red', 10, 100),
(79, 'M', 'Blue', 10, 100),
(79, 'M', 'Red', 10, 100),
(79, 'S', 'Blue', 10, 100),
(79, 'S', 'Red', 10, 100),
(80, 'L', 'Blue', 10, 100),
(80, 'L', 'Red', 10, 100),
(80, 'M', 'Blue', 10, 100),
(80, 'M', 'Red', 10, 100),
(80, 'S', 'Blue', 10, 100),
(80, 'S', 'Red', 10, 100);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `size` varchar(5) NOT NULL,
  `colour` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` float NOT NULL,
  `discount` float NOT NULL,
  `reviewed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderId`, `productId`, `size`, `colour`, `quantity`, `unitPrice`, `discount`, `reviewed`) VALUES
(1, 1, 'M', 'Blue', 1, 100, 0, 1),
(1, 6, 'L', 'Red', 2, 200, 0, 0),
(1, 12, 'S', 'Blue', 3, 150, 0, 0),
(1, 14, 'S', 'Blue', 2, 1250, 0, 1),
(2, 1, 'M', 'Blue', 1, 100, 0, 0),
(2, 6, 'L', 'Red', 2, 200, 0, 0),
(2, 7, 'L', 'Red', 1, 875, 0, 0),
(2, 9, 'M', 'Blue', 2, 500, 0, 0),
(3, 1, 'M', 'Blue', 1, 100, 0, 0),
(3, 6, 'L', 'Red', 2, 200, 0, 0),
(3, 12, 'S', 'Blue', 3, 150, 0, 0),
(4, 1, 'S', 'Blue', 2, 1250, 0, 1),
(4, 10, 'M', 'Blue', 2, 500, 0, 1),
(4, 12, 'S', 'Blue', 3, 150, 0, 0),
(4, 14, 'L', 'Red', 1, 875, 0, 1),
(5, 1, 'M', 'Blue', 1, 100, 0, 0),
(5, 6, 'L', 'Red', 2, 200, 0, 0),
(5, 12, 'S', 'Blue', 3, 150, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `status` enum('Pending','Delivered') NOT NULL,
  `orderDate` date NOT NULL,
  `creditCardNo` varchar(20) NOT NULL,
  `customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `status`, `orderDate`, `creditCardNo`, `customerId`) VALUES
(1, 'Pending', '2022-03-25', '123412341234', 1),
(2, 'Delivered', '2022-03-23', '123412341234', 1),
(3, 'Pending', '2022-03-25', '123412341234', 1),
(4, 'Delivered', '2022-03-22', '123412341234', 1),
(5, 'Pending', '2022-03-25', '123412341234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymentinfo`
--

CREATE TABLE `paymentinfo` (
  `creditCardpin` int(11) NOT NULL,
  `creditCardNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentinfo`
--

INSERT INTO `paymentinfo` (`creditCardpin`, `creditCardNo`) VALUES
(1234, '123412341234');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `unitPrice` float NOT NULL,
  `picture` varchar(200) NOT NULL,
  `discount` float NOT NULL,
  `prodDesc` varchar(100) NOT NULL,
  `prodName` varchar(30) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `unitPrice`, `picture`, `discount`, `prodDesc`, `prodName`, `categoryId`) VALUES
(1, 100, 'Men/Hoodies/41.png', 0, 'Made with highest quality cotton for your comfort', 'Men-Hoodie', 1),
(2, 100, 'Men/Hoodies/42.png', 0, 'Made with highest quality cotton for your comfort', 'Men-Hoodie', 1),
(3, 100, 'Men/Hoodies/43.png', 0, 'Made with highest quality cotton for your comfort', 'Men-Hoodie', 1),
(4, 100, 'Men/Hoodies/44.png', 0, 'Made with highest quality cotton for your comfort', 'Men-Hoodie', 1),
(5, 100, 'Men/Hoodies/45.png', 0, 'Made with highest quality cotton for your comfort', 'Men-Hoodie', 1),
(6, 200, 'Men/Jeans/51.png', 0, 'Casual trendy Jeans', 'Men-Jeans', 2),
(7, 200, 'Men/Jeans/52.png', 0, 'Casual trendy Jeans', 'Men-Jeans', 2),
(8, 200, 'Men/Jeans/53.png', 0, 'Casual trendy Jeans', 'Men-Jeans', 2),
(9, 200, 'Men/Jeans/54.png', 0, 'Casual trendy Jeans', 'Men-Jeans', 2),
(10, 200, 'Men/Jeans/55.png', 0, 'Casual trendy Jeans', 'Men-Jeans', 2),
(11, 150, 'Men/Joggers/71.png', 0, 'Stretchy 100% cotton Joggers', 'Men-Joggers', 3),
(12, 150, 'Men/Joggers/72.png', 0, 'Stretchy 100% cotton Joggers', 'Men-Joggers', 3),
(13, 150, 'Men/Joggers/73.png', 0, 'Stretchy 100% cotton Joggers', 'Men-Joggers', 3),
(14, 150, 'Men/Joggers/74.png', 0, 'Stretchy 100% cotton Joggers', 'Men-Joggers', 3),
(15, 150, 'Men/Joggers/75.png', 0, 'Stretchy 100% cotton Joggers', 'Men-Joggers', 3),
(16, 250, 'Men/Shirts/46.png', 0, ' Shirts with a modern look', 'Men-Shirts', 7),
(17, 250, 'Men/Shirts/47.png', 0, 'Shirts with a modern look', 'Men-Shirts', 7),
(18, 250, 'Men/Shirts/48.png', 0, 'Shirts with a modern look', 'Men-Shirts', 7),
(19, 250, 'Men/Shirts/49.png', 0, 'Shirts with a modern look', 'Men-Shirts', 7),
(20, 250, 'Men/Shirts/50.png', 0, 'Shirts with a modern look', 'Men-Shirts', 7),
(21, 1250, 'Men/Shoes/61.png', 0, 'Shoes for maximum comfort', 'Men-Shoes', 4),
(22, 1250, 'Men/Shoes/62.png', 0, 'Shoes for maximum comfort', 'Men-Shoes', 4),
(23, 1250, 'Men/Shoes/63.png', 0, 'Shoes for maximum comfort', 'Men-Shoes', 4),
(24, 1250, 'Men/Shoes/64.png', 0, 'Shoes for maximum comfort', 'Men-Shoes', 4),
(25, 1250, 'Men/Shoes/65.png', 0, 'Shoes for maximum comfort', 'Men-Shoes', 4),
(26, 875, 'Men/Sportswear/66.png', 0, 'Perfect for any activity', 'Men-Sportswear', 5),
(27, 875, 'Men/Sportswear/67.png', 0, 'Perfect for any activity', 'Men-Sportswear', 5),
(28, 875, 'Men/Sportswear/68.png', 0, 'Perfect for any activity', 'Men-Sportswear', 5),
(29, 875, 'Men/Sportswear/69.png', 0, 'Perfect for any activity', 'Men-Sportswear', 5),
(30, 875, 'Men/Sportswear/70.png', 0, 'Perfect for any activity', 'Men-Sportswear', 5),
(31, 500, 'Men/Trousers/56.png', 0, 'Sleek and fresh look', 'Men-Trousers', 6),
(32, 500, 'Men/Trousers/57.png', 0, 'Sleek and fresh look', 'Men-Trousers', 6),
(33, 500, 'Men/Trousers/58.png', 0, 'Sleek and fresh look', 'Men-Trousers', 6),
(34, 500, 'Men/Trousers/59.png', 0, 'Sleek and fresh look', 'Men-Trousers', 6),
(35, 500, 'Men/Trousers/60.png', 0, 'Sleek and fresh look', 'Men-Trousers', 6),
(36, 150, 'Men/TShirts/36.png', 0, 'Relaxed fit crewneck T-Shirts', 'Men-TShirts', 8),
(37, 150, 'Men/TShirts/37.png', 0, 'Relaxed fit crewneck T-Shirts', 'Men-TShirts', 8),
(38, 150, 'Men/TShirts/38.png', 0, 'Relaxed fit crewneck T-Shirts', 'Men-TShirts', 8),
(39, 150, 'Men/TShirts/39.png', 0, 'Relaxed fit crewneck T-Shirts', 'Men-TShirts', 8),
(40, 150, 'Men/TShirts/40.png', 0, 'Relaxed fit crewneck T-Shirts', 'Men-TShirts', 8),
(41, 125, 'Women/Blouses/1.png', 0, 'Casual blouses', 'Women-Blouses', 9),
(42, 125, 'Women/Blouses/2.png', 0, 'Casual blouses', 'Women-Blouses', 9),
(43, 125, 'Women/Blouses/3.png', 0, 'Casual blouses', 'Women-Blouses', 9),
(44, 125, 'Women/Blouses/4.png', 0, 'Casual blouses', 'Women-Blouses', 9),
(45, 125, 'Women/Blouses/5.png', 0, 'Casual blouses', 'Women-Blouses', 9),
(46, 700, 'Women/Dress/76.png', 0, 'Silky dresses', 'Women-Dresses', 10),
(47, 700, 'Women/Dress/77.png', 0, 'Mini Skirts', 'Women-Skirts', 10),
(48, 700, 'Women/Dress/78.png', 0, 'Midi Skirts', 'Women-Skirts', 10),
(49, 700, 'Women/Dress/79.png', 0, 'Mini Skirts', 'Women-Skirts', 10),
(50, 700, 'Women/Dress/80.png', 0, 'Silky dresses', 'Women-Dresses', 10),
(51, 250, 'Women/Jeans/11.png', 0, 'Casual trendy Jeans', 'Women-Jeans', 2),
(52, 250, 'Women/Jeans/12.png', 0, 'Casual trendy Jeans', 'Women-Jeans', 2),
(53, 250, 'Women/Jeans/13.png', 0, 'Casual trendy Jeans', 'Women-Jeans', 2),
(54, 250, 'Women/Jeans/14.png', 0, 'Casual trendy Jeans', 'Women-Jeans', 2),
(55, 250, 'Women/Jeans/15.png', 0, 'Casual trendy Jeans', 'Women-Jeans', 2),
(56, 325, 'Women/Joggers/31.png', 0, 'Perfect fit for exercising', 'Women-Joggers', 3),
(57, 325, 'Women/Joggers/32.png', 0, 'Perfect fit for exercising', 'Women-Joggers', 3),
(58, 325, 'Women/Joggers/33.png', 0, 'Perfect fit for exercising', 'Women-Joggers', 3),
(59, 325, 'Women/Joggers/34.png', 0, 'Perfect fit for exercising', 'Women-Joggers', 3),
(60, 325, 'Women/Joggers/35.png', 0, 'Perfect fit for exercising', 'Women-Joggers', 3),
(61, 1325, 'Women/Shoes/21.png', 0, 'Shoes for maximum comfort', 'Women-Shoes', 4),
(62, 1325, 'Women/Shoes/22.png', 0, 'Shoes for maximum comfort', 'Women-Shoes', 4),
(63, 1325, 'Women/Shoes/23.png', 0, 'Shoes for maximum comfort', 'Women-Shoes', 4),
(64, 1325, 'Women/Shoes/24.png', 0, 'Shoes for maximum comfort', 'Women-Shoes', 4),
(65, 1325, 'Women/Shoes/25.png', 0, 'Shoes for maximum comfort', 'Women-Shoes', 4),
(66, 875, 'Women/Sportswear/26.png', 0, 'Perfect for any activity', 'Women-Sportswear', 5),
(67, 875, 'Women/Sportswear/27.png', 0, 'Perfect for any activity', 'Women-Sportswear', 5),
(68, 875, 'Women/Sportswear/28.png', 0, 'Perfect for any activity', 'Women-Sportswear', 5),
(69, 875, 'Women/Sportswear/29.png', 0, 'Perfect for any activity', 'Women-Sportswear', 5),
(70, 875, 'Women/Sportswear/30.png', 0, 'Perfect for any activity', 'Women-Sportswear', 5),
(71, 600, 'Women/Sweatshirts/6.png', 0, 'Cozy 100% cotton', 'Women-Sweatshirts', 11),
(72, 600, 'Women/Sweatshirts/7.png', 0, 'Cozy 100% cotton', 'Women-Sweatshirts', 11),
(73, 600, 'Women/Sweatshirts/8.png', 0, 'Cozy 100% cotton', 'Women-Sweatshirts', 11),
(74, 600, 'Women/Sweatshirts/9.png', 0, 'Cozy 100% cotton', 'Women-Sweatshirts', 11),
(75, 600, 'Women/Sweatshirts/10.png', 0, 'Cozy 100% cotton', 'Women-Sweatshirts', 11),
(76, 500, 'Women/Trousers/16.png', 0, 'Sleek and fresh look', 'Women-Trousers', 6),
(77, 500, 'Women/Trousers/17.png', 0, 'Sleek and fresh look', 'Women-Trousers', 6),
(78, 500, 'Women/Trousers/18.png', 0, 'Sleek and fresh look', 'Women-Trousers', 6),
(79, 500, 'Women/Trousers/19.png', 0, 'Sleek and fresh look', 'Women-Trousers', 6),
(80, 500, 'Women/Trousers/20.png', 0, 'Sleek and fresh look', 'Women-Trousers', 6);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `productId` int(11) NOT NULL,
  `postedOn` date NOT NULL,
  `reviewDesc` varchar(30) NOT NULL,
  `flag` int(11) NOT NULL,
  `rating` float NOT NULL,
  `customerid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`productId`, `postedOn`, `reviewDesc`, `flag`, `rating`, `customerid`) VALUES
(1, '2022-03-25', 'Nice Nice!', 0, 4, 1),
(1, '2022-03-30', 'Nice!', 0, 1, 1),
(10, '2022-03-30', 'Nice Nice Nice!', 0, 5, 1),
(14, '2022-03-25', 'Very Very Nice!', 0, 3, 1),
(14, '2022-03-30', 'Very Nice!', 0, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`productId`,`size`,`colour`,`username`),
  ADD KEY `cart-inventory-const` (`productId`,`size`,`colour`),
  ADD KEY `cart-account-const` (`username`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`),
  ADD KEY `customer-account-const` (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`username`,`postedOn`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productId`,`size`,`colour`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderId`,`productId`,`size`,`colour`),
  ADD KEY `orderitems-inventory` (`productId`,`size`,`colour`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `orders-paymentinfo` (`creditCardNo`),
  ADD KEY `orders-customerId` (`customerId`);

--
-- Indexes for table `paymentinfo`
--
ALTER TABLE `paymentinfo`
  ADD PRIMARY KEY (`creditCardNo`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `product-category-const` (`categoryId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`productId`,`postedOn`,`customerid`),
  ADD KEY `review-product-const` (`productId`),
  ADD KEY `review-customer-const` (`customerid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart-account-const` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart-inventory-const` FOREIGN KEY (`productId`,`size`,`colour`) REFERENCES `inventory` (`productId`, `size`, `colour`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer-account-const` FOREIGN KEY (`username`) REFERENCES `account` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `product-inventory-const` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems-inventory` FOREIGN KEY (`productId`,`size`,`colour`) REFERENCES `inventory` (`productId`, `size`, `colour`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderitems-orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders-customerId` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders-paymentinfo` FOREIGN KEY (`creditCardNo`) REFERENCES `paymentinfo` (`creditCardNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product-category-const` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review-customer-const` FOREIGN KEY (`customerid`) REFERENCES `customer` (`customerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review-product-const` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
