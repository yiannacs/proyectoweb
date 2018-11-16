-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2018 at 07:50 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labelectronica`
--
CREATE DATABASE IF NOT EXISTS `labelectronica` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `labelectronica`;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dueDate` date NOT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `orderId`, `item`, `quantity`, `dueDate`, `returned`) VALUES
(26, 40, 1, 0, '2018-11-20', 1),
(27, 40, 2, 0, '2018-12-15', 1),
(28, 40, 3, 0, '2018-11-16', 1),
(29, 41, 2, 3, '2018-12-15', 0),
(30, 41, 3, 1, '2018-11-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `student` varchar(9) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `returned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `student`, `timestamp`, `returned`) VALUES
(40, 'a01234567', '2018-11-15 23:22:05', 1),
(41, 'a01234567', '2018-11-15 23:22:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `total` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `loanLength` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `description`, `total`, `available`, `loanLength`) VALUES
(1, 'Osciloscopio', 10, 10, 5),
(2, 'Arduino Zero', 5, 2, 30),
(3, 'CAN Duo', 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(9) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `addedby` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `password`, `name`, `email`, `phone`, `admin`, `addedby`) VALUES
('a01234567', '1234', 'dbdf@fdbdb.df', 'dbdf@fdbdb.df', '1234567890', 0, NULL),
('a01234568', '1234', 'dbdf@fdbdb.df', 'dbdf@fdbdb.df', '1234567890', 0, NULL),
('a01234569', '1234', 'yiann', 'dbdf@fdbdb.df', '1234567890', 0, NULL),
('a01250246', '1234', 'dsgbdg', 'dgb@efg.eef', '1234567890', 0, NULL),
('l00000001', '1234', 'marco', 'egveve@egbved.e', '5542424242', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
