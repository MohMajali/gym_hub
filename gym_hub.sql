-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 12:35 AM
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
-- Database: `gym_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `active`, `created_at`) VALUES
(1, 'Categories_Images/grad.jpg', 'Category 12222', 1, '2024-05-04 15:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `clients_subscriptions`
--

CREATE TABLE `clients_subscriptions` (
  `id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `payment_type` varchar(191) NOT NULL,
  `start_date` varchar(191) NOT NULL,
  `end_date` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients_subscriptions`
--

INSERT INTO `clients_subscriptions` (`id`, `gym_id`, `client_id`, `offer_id`, `payment_type`, `start_date`, `end_date`, `created_at`) VALUES
(2, 1, 3, NULL, 'E-Payment', '2024-05-15', '2024-05-31', '2024-05-06 00:32:07'),
(3, 1, 3, 1, 'E-Payment', '2024-05-16', '2024-05-23', '2024-05-06 00:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

CREATE TABLE `gyms` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `city` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'PENDING',
  `total_rate` double NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`id`, `manager_id`, `title`, `email`, `phone`, `password`, `city`, `image`, `status`, `total_rate`, `active`, `created_at`) VALUES
(1, 2, 'Gym 1', 'gym@yahoo.com', '7412589630', 'Ab@12345', 'City 1', 'Gyms_Images/grad.jpg', 'Accepted', 0, 1, '2024-05-04 16:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `gym_client_ratings`
--

CREATE TABLE `gym_client_ratings` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gym_coaches`
--

CREATE TABLE `gym_coaches` (
  `id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gym_coaches`
--

INSERT INTO `gym_coaches` (`id`, `gym_id`, `name`, `email`, `image`, `phone`, `active`, `created_at`) VALUES
(1, 1, 'Coach 1', 'coach@yahoo.com', 'Gym_Coaches/grad.jpg', '1234567890', 1, '2024-05-04 19:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `gym_images`
--

CREATE TABLE `gym_images` (
  `id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gym_offers`
--

CREATE TABLE `gym_offers` (
  `id` int(11) NOT NULL,
  `gym_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `duration` varchar(250) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gym_offers`
--

INSERT INTO `gym_offers` (`id`, `gym_id`, `name`, `description`, `price`, `duration`, `active`, `created_at`) VALUES
(1, 1, 'Offer 1', 'lorem lorem lorem lorem ', 120, '6 days', 1, '2024-05-04 19:47:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `item_id`, `quantity`, `total_price`, `created_at`) VALUES
(6, 3, 1, 3, 30, '2024-05-05 22:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `category_id`, `title`, `description`, `image`, `quantity`, `price`, `active`, `created_at`) VALUES
(1, 1, 'Item 1', 'Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem Lorem ', 'Store_Items_Images/grad.jpg', 1, 10, 1, '2024-05-04 16:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `location` varchar(191) NOT NULL,
  `gender` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `name`, `email`, `password`, `phone`, `location`, `gender`, `created_at`) VALUES
(1, 'ADMIN', 'Admin', 'admin@gymhub.com', '1234567890', '9876543210', 'Amman', 'Male', '2024-05-04 15:30:43'),
(2, 'Manager', 'Manager', 'manager@yahoo.com', 'Ab@12345', '9876543210', 'location 1', 'Male', '2024-05-04 16:04:59'),
(3, 'Manager', 'CLIENT', 'client@yahoo.com', '1234567890', '9876543210', 'location 2', 'Female', '2024-05-05 22:32:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_subscriptions`
--
ALTER TABLE `clients_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_subscription_id_FK` (`client_id`),
  ADD KEY `offer_id_FK` (`offer_id`),
  ADD KEY `gym_subcription_id_FK` (`gym_id`);

--
-- Indexes for table `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id_FK` (`manager_id`);

--
-- Indexes for table `gym_client_ratings`
--
ALTER TABLE `gym_client_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id_FK` (`client_id`),
  ADD KEY `gym_rate_id_FK` (`gym_id`);

--
-- Indexes for table `gym_coaches`
--
ALTER TABLE `gym_coaches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gym_coach_id_FK` (`gym_id`);

--
-- Indexes for table `gym_images`
--
ALTER TABLE `gym_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gym_id_FK` (`gym_id`);

--
-- Indexes for table `gym_offers`
--
ALTER TABLE `gym_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gym_offer_id_FK` (`gym_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_order_FK` (`client_id`),
  ADD KEY `item_order_FK` (`item_id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id_FK` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients_subscriptions`
--
ALTER TABLE `clients_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gym_client_ratings`
--
ALTER TABLE `gym_client_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gym_coaches`
--
ALTER TABLE `gym_coaches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gym_images`
--
ALTER TABLE `gym_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gym_offers`
--
ALTER TABLE `gym_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store_items`
--
ALTER TABLE `store_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients_subscriptions`
--
ALTER TABLE `clients_subscriptions`
  ADD CONSTRAINT `client_subscription_id_FK` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `gym_subcription_id_FK` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`),
  ADD CONSTRAINT `offer_id_FK` FOREIGN KEY (`offer_id`) REFERENCES `gym_offers` (`id`);

--
-- Constraints for table `gyms`
--
ALTER TABLE `gyms`
  ADD CONSTRAINT `manager_id_FK` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gym_client_ratings`
--
ALTER TABLE `gym_client_ratings`
  ADD CONSTRAINT `client_id_FK` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `gym_rate_id_FK` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);

--
-- Constraints for table `gym_coaches`
--
ALTER TABLE `gym_coaches`
  ADD CONSTRAINT `gym_coach_id_FK` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);

--
-- Constraints for table `gym_images`
--
ALTER TABLE `gym_images`
  ADD CONSTRAINT `gym_id_FK` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);

--
-- Constraints for table `gym_offers`
--
ALTER TABLE `gym_offers`
  ADD CONSTRAINT `gym_offer_id_FK` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `client_order_FK` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `item_order_FK` FOREIGN KEY (`item_id`) REFERENCES `store_items` (`id`);

--
-- Constraints for table `store_items`
--
ALTER TABLE `store_items`
  ADD CONSTRAINT `category_id_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
