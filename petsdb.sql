-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 07:42 PM
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
  `total_price` decimal(10,0) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method` enum('card','COD') NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `last4` varchar(4) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `customer_id`, `payment_method`, `customer_name`, `address`, `customer_phone`, `postal_code`, `last4`, `createdAt`) VALUES
(57, 15000, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-24 18:50:40'),
(58, 15000, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-11-06 18:53:10'),
(59, 16501, 1, '', 'Hello', 'Hello', 'Hello', 'Hello', NULL, '2024-10-06 19:14:45'),
(60, 16501, 1, '', 'asd', 'asd', 'asd', 'ad', NULL, '2024-10-06 19:25:04'),
(61, 16501, 1, '', 'asd', 'asd', 'asd', 'ad', NULL, '2024-10-06 19:28:34'),
(62, 16501, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 19:31:24'),
(63, 16501, 1, '', 'asda', 'dasda', 'asdadada', 'asdad', NULL, '2024-10-06 19:32:54'),
(64, 15000, 1, '', 'Riley Ferguson', 'Voluptatum consequun', '+1 (117) 574-7258', 'Et ea distinctio As', NULL, '2024-10-10 10:53:35'),
(65, 15000, 1, '', 'Craig Owens', 'Et atque fugiat repr', '+1 (724) 337-6971', 'Officia recusandae ', NULL, '2024-10-10 10:55:40'),
(66, 15000, 1, '', 'Steel Gamble', 'Deserunt quos possim', '+1 (398) 505-1262', 'Aute at ex hic rem d', NULL, '2024-10-10 11:12:55'),
(67, 15000, 1, '', 'Steel Gamble', 'Deserunt quos possim', '+1 (398) 505-1262', 'Aute at ex hic rem d', NULL, '2024-10-10 11:13:23'),
(68, 15000, 1, '', 'Harriet Thomas', 'Reprehenderit volupt', '+1 (473) 888-8228', 'Exercitation ratione', NULL, '2024-10-10 11:16:16'),
(69, 15000, 1, '', 'Harriet Thomas', 'Reprehenderit volupt', '+1 (473) 888-8228', 'Exercitation ratione', NULL, '2024-10-10 11:16:48'),
(70, 15000, 1, '', 'Harriet Thomas', 'Reprehenderit volupt', '+1 (473) 888-8228', 'Exercitation ratione', NULL, '2024-10-10 11:16:56'),
(71, 15000, 1, '', 'Emerald Silva', 'Voluptate animi vol', '+1 (871) 527-5972', 'Non fugit accusanti', NULL, '2024-10-10 11:23:26'),
(72, 15000, 1, '', 'Inez Nolan', 'Qui aut aut adipisic', '+1 (402) 495-5919', 'Quis culpa qui elit', NULL, '2024-10-10 11:24:23'),
(73, 1, 1, '', 'Lydia Hayden', 'Aut earum laboriosam', '+1 (101) 537-3414', 'Odit ex irure aliqua', NULL, '2024-10-16 04:51:18'),
(74, 1, 14, '', 'Uriel White', 'Irure ullam totam so', '+1 (974) 929-6471', 'Anim dolor possimus', NULL, '2024-10-16 04:55:53'),
(75, 1500, 14, '', 'Kieran Singleton', 'Et ut architecto off', '+1 (134) 996-4258', 'Rerum quibusdam quae', NULL, '2024-10-16 05:09:28'),
(76, 1, 14, '', 'Uriel White', 'Irure ullam totam so', '+1 (974) 929-6471', 'Anim dolor possimus', NULL, '2024-10-16 05:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` text DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `petID`, `price`, `image`, `name`, `breed`, `description`) VALUES
(32, 64, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(33, 65, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(34, 66, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(35, 67, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(36, 68, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(37, 69, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(38, 70, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(39, 71, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(40, 72, 51, 15000, '66fae1600be6f.jpg', 'butterfly', 'Papillon', 'Description'),
(41, 73, 50, 1, '66f876bb0afcf.jpg', 'white kawa', 'blue', 'Description'),
(42, 74, 50, 1, '66f876bb0afcf.jpg', 'white kawa', 'blue', 'Description'),
(43, 75, 56, 1500, '66f876bb0afcf.jpg', 'Sparrow', 'cute', 'Description'),
(44, 76, 50, 1, '66f876bb0afcf.jpg', 'white kawa', 'blue', 'Description');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `description` text NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `petID`, `userId`, `description`, `createdAt`) VALUES
(6, 56, 14, 'asda', '2024-10-17 08:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `tblpets`
--

CREATE TABLE `tblpets` (
  `petID` int(11) NOT NULL,
  `sellerId` int(11) NOT NULL,
  `petType` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `breed` varchar(255) DEFAULT NULL,
  `status` enum('available','sold','blocked') NOT NULL DEFAULT 'available',
  `updatedAt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpets`
--

INSERT INTO `tblpets` (`petID`, `sellerId`, `petType`, `description`, `price`, `image`, `createdAt`, `breed`, `status`, `updatedAt`) VALUES
(56, 15, 'Sparrow', 'Bbay sparrow', 1500, '66f876bb0afcf.jpg', '2024-10-02 00:47:32', 'cute', 'available', '2024-10-16 02:08:15'),
(57, 9, 'Kaitlin Gonzales', 'Voluptates laboriosa', 884, '66f876bb0afcf.jpg', '2024-10-06 22:31:05', 'Voluptatem In exerc', 'available', '2024-09-16 02:08:22'),
(58, 9, 'Amethyst Curtis', 'Hic voluptatem elig', 198, '66f876bb0afcf.jpg', '2024-10-13 00:43:50', 'Eligendi commodo vol', 'available', '2024-10-17 02:42:20');

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
  `role` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `email`, `password`, `number`, `role`, `status`, `createdAt`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '12333', 'admin', 'active', '2024-10-23 17:04:34'),
(3, 'seller', 'seller@gmail.com', '123', '987978', 'seller', 'active', '2024-10-24 17:04:34'),
(9, 'Ameera', 'ameerausman200116@gmail.com', '12345', '235557788', 'seller', 'active', '2024-10-23 17:04:34'),
(11, 'lili', 'ameera@gmail.com', '12345', '2132576', 'seller', 'active', '2024-09-24 17:04:34'),
(12, 'neelam', 'neelam@gmail.com', '123', '42353652', 'seller', 'active', '2024-10-24 17:04:34'),
(13, 'meme', 'meme@gmail.com', 'meme', '1234', 'seller', 'active', '2024-10-24 17:04:34'),
(14, 'kawa', 'kawa@gmail.com', '12345', '1442546', 'buyer', 'active', '2024-10-24 17:04:34'),
(15, 'Muhammad Bilal Aslam', 'BilalAslam14@gmail.com', '1234', '3534576879', 'seller', 'active', '2024-10-24 17:04:34'),
(16, 'rojibatudi', 'hevikawude@mailinator.com', 'Pa$$w0rd!', '212', 'seller', 'active', '2024-10-24 17:04:34'),
(17, 'sofofetad', 'jicylixy@mailinator.com', 'Pa$$w0rd!', '224', 'seller', 'active', '2024-10-24 17:04:34'),
(18, 'japyza', 'bejoq@mailinator.com', 'Pa$$w0rd!', '95', 'buyer', 'active', '2024-10-24 17:04:34'),
(19, 'kikuro', 'xamol@mailinator.com', 'Pa$$w0rd!', '312', 'seller', 'active', '2024-10-24 17:04:34');

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblpets`
--
ALTER TABLE `tblpets`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
