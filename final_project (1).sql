-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 11:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatives`
--

CREATE TABLE `alternatives` (
  `alt_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `alt_name` varchar(100) NOT NULL,
  `alt_company` varchar(100) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatives`
--

INSERT INTO `alternatives` (`alt_id`, `product_id`, `alt_name`, `alt_company`, `added_by`) VALUES
(43, 13, 'Free-Range Organic Eggs', 'HappyHens', 1),
(45, 15, 'Reusable Metal Cutlery', 'ZeroWaste Co.', 3),
(46, 16, 'Homemade Granola Bars', 'WholesomeEats', 1),
(47, 17, 'Rechargeable Toy', 'EcoPlay', 2),
(48, 18, 'Fair Trade Coffee', 'BeanEthics', 1),
(64, 21, 'Chicken Burger', 'Fri Chicks', 1),
(65, 22, 'Fried Chicken', 'Al-Nasir', 2),
(66, 23, 'Amrat Cola', 'Amrat Beverages', 1),
(67, 24, 'Pakola', 'Mehran Bottlers', 2),
(68, 25, 'Cold Coffee', 'Café Aroma', 3),
(69, 26, 'Shan Instant Noodles', 'Shan Foods', 1),
(70, 27, 'Paradise Chocolate', 'Hilal Foods', 2),
(71, 28, 'Servis Shoes', 'Servis Industries', 1),
(72, 29, 'Generic Cartridge', 'PrintTech', 2),
(73, 30, 'Manual Soda Maker', 'Crystal Pure', 3),
(74, 31, 'Homemade Hummus', 'Fauji Foods', 1),
(75, 32, 'Herbal Moisturizer', 'Saeed Ghani', 2),
(76, 33, 'Pakistani Dates', 'Sindhri Farms', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `company`, `reason`, `added_by`) VALUES
(13, 'Factory-Farmed Eggs', 'EggLand', 'Animal cruelty and unsanitary conditions', 1),
(15, 'Single-Use Cutlery', 'QuickBite', 'Contributes to plastic waste', 3),
(16, 'Artificial Snack Bars', 'EnergyGo', 'Contains preservatives and additives', 1),
(17, 'Battery-Powered Toy', 'ToyFun', 'Short life and non-recyclable parts', 2),
(18, 'Mass-Market Coffee', 'CoffeeCo', 'Unfair trade practices', 1),
(21, 'Big Mac', 'McDonald\'s', 'Provided 100,000 free meals to Israeli forces during Gaza conflict', 1),
(22, 'Fried Chicken', 'KFC', 'Parent company Yum! Brands invests in Israeli startups', 2),
(23, 'Coca-Cola', 'Coca-Cola Company', 'Operates bottling plant in West Bank settlement', 1),
(24, 'Pepsi', 'PepsiCo', 'Alleged donations to Israeli organizations', 2),
(25, 'Frappuccino', 'Starbucks', 'Founder Howard Schultz’s vocal support for Israel', 3),
(26, 'Maggi Noodles', 'Nestlé', 'Business ties with Starbucks and operations in Israel', 1),
(27, 'Dairy Milk', 'Cadbury', 'Owned by Mondelez International, alleged ties to Israel', 2),
(28, 'Sneakers', 'Puma', 'Sponsors Israel Football Association, including settlement teams', 1),
(29, 'Printer Cartridge', 'HP', 'Provides technology to Israel’s Population and Immigration Authority', 2),
(30, 'Sparkling Water Maker', 'SodaStream', 'Previously manufactured in illegal West Bank settlement', 3),
(31, 'Hummus', 'Sabra', 'Owned by Strauss Group, supports Israeli military', 1),
(32, 'Dead Sea Moisturizer', 'Ahava Cosmetics', 'Produced in illegal West Bank settlement', 2),
(33, 'Medjool Dates', 'Israeli Agricultural Exports', 'Grown on confiscated Palestinian land in Jordan Valley', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'kashif', 'kashif123', 'user'),
(2, 'sarim', 'sarim123', 'user'),
(3, 'admin', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`alt_id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `alternatives_ibfk_1` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `alt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD CONSTRAINT `alternatives_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alternatives_ibfk_2` FOREIGN KEY (`added_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
