-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 04:42 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` enum('card','COD') NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `last4` varchar(4) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `customer_id`, `payment_method`, `customer_name`, `address`, `customer_phone`, `postal_code`, `last4`, `order_date`) VALUES
(57, 15000.00, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 18:50:40'),
(58, 15000.00, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 18:53:10'),
(59, 16501.00, 1, '', 'Hello', 'Hello', 'Hello', 'Hello', NULL, '2024-10-06 19:14:45'),
(60, 16501.00, 1, '', 'asd', 'asd', 'asd', 'ad', NULL, '2024-10-06 19:25:04'),
(61, 16501.00, 1, '', 'asd', 'asd', 'asd', 'ad', NULL, '2024-10-06 19:28:34'),
(62, 16501.00, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 19:31:24'),
(63, 16501.00, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 19:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` text DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpets`
--

CREATE TABLE `tblpets` (
  `petID` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `petType` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `breed` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpets`
--

INSERT INTO `tblpets` (`petID`, `sellerId`, `petType`, `description`, `price`, `image`, `createdAt`, `breed`) VALUES
(50, 15, 'white kawa', 'Karachi', 1.00, '66fad29b70ee0.png', '2024-09-30 21:32:27', 'blue'),
(51, 15, 'butterfly', 'Colorfull butterfly', 15000.00, '66fae1600be6f.jpg', '2024-09-30 22:35:28', 'Papillon'),
(56, 15, 'Sparrow', 'Bbay sparrow', 1500.00, '66fc51d4daf09.jpg', '2024-10-02 00:47:32', 'cute');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `number`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12333', 'admin'),
(3, 'seller', 'seller@gmail.com', '123', '987978', 'seller'),
(9, 'Ameera', 'ameerausman200116@gmail.com', '12345', '235557788', 'seller'),
(11, 'lili', 'ameera@gmail.com', '12345', '2132576', 'seller'),
(12, 'neelam', 'neelam@gmail.com', '123', '42353652', 'seller'),
(13, 'meme', 'meme@gmail.com', 'meme', '1234', 'seller'),
(14, 'kawa', 'kawa@gmail.com', '12345', '1442546', 'buyer'),
(15, 'Muhammad Bilal Aslam', 'BilalAslam14@gmail.com', '1234', '3534576879', 'seller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpets`
--
ALTER TABLE `tblpets`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblpets`
--
ALTER TABLE `tblpets`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
