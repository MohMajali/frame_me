-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 06:36 PM
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
-- Database: `frame_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(250) NOT NULL,
  `image` varchar(191) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `image`, `active`, `created_at`) VALUES
(1, 'T5roj', 'Categories_Images/grad.jpg', 1, '2024-04-06 18:28:19'),
(2, 'Category 2', 'Categories_Images/grad.jpg', 1, '2024-04-20 22:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `full_name`, `phone`, `email`, `message`) VALUES
(1, 'Test', '0123456789', 'test@yahoo.com', 'lorem lorem lorem lorem lorem lorem lorem ');

-- --------------------------------------------------------

--
-- Table structure for table `customer_photographer_rates`
--

CREATE TABLE `customer_photographer_rates` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer_photographer_rates`
--

INSERT INTO `customer_photographer_rates` (`id`, `customer_id`, `photographer_id`, `rate`, `created_at`) VALUES
(2, 5, 4, 4, '2024-04-20 20:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_accessories`
--

CREATE TABLE `photographer_accessories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `accessorie` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `photographer_accessories`
--

INSERT INTO `photographer_accessories` (`id`, `category_id`, `photographer_id`, `accessorie`, `created_at`) VALUES
(1, 1, 4, 'Accessorie 1', '2024-04-10 05:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `photographer_pictures`
--

CREATE TABLE `photographer_pictures` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `photographer_pictures`
--

INSERT INTO `photographer_pictures` (`id`, `category_id`, `photographer_id`, `image`, `created_at`) VALUES
(2, 1, 4, 'Photographer_Images/default_user.jpg', '2024-04-11 19:41:18'),
(3, 1, 4, 'Photographer_Images/grad.jpg', '2024-04-20 20:21:54'),
(4, 2, 4, 'Photographer_Images/grad.jpg', '2024-04-20 22:08:42');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `photographer_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_date` varchar(191) NOT NULL,
  `end_date` varchar(191) NOT NULL,
  `start_time` varchar(191) NOT NULL,
  `end_time` varchar(191) NOT NULL,
  `total_price` double DEFAULT NULL,
  `review` text DEFAULT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `category_id`, `photographer_id`, `customer_id`, `start_date`, `end_date`, `start_time`, `end_time`, `total_price`, `review`, `status`, `created_at`) VALUES
(1, 1, 4, 3, '2024-04-06', '2024-04-09', '11:30:28', '33:30:28', 150, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five cent', 'Rejected', '2024-04-06 21:31:31'),
(3, 1, 4, 5, '2024-04-16', '2024-04-17', '23:01', '13:01', 1800, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an un', 'Accepted', '2024-04-16 22:02:01'),
(4, 1, 4, 5, '2024-04-22', '2024-04-22', '22:27', '13:27', NULL, NULL, 'Pending', '2024-04-20 20:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `image` varchar(250) NOT NULL,
  `request_status` varchar(191) NOT NULL DEFAULT 'Pending',
  `total_rate` double DEFAULT NULL,
  `price_range` varchar(191) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type_id`, `name`, `email`, `description`, `password`, `phone`, `image`, `request_status`, `total_rate`, `price_range`, `active`, `created_at`) VALUES
(1, 1, 'Admin', 'admin@frameme.com', '', '1234567890', '9876543210', 'images/', 'Admin', 0, '0', 1, '2024-04-06 18:16:41'),
(2, 2, 'Photographer', 'photo@yahoo.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '1234567890', '0147852369', 'Photographer_Images/default_user.jpg', 'Pending', 0, '150', 1, '2024-04-06 18:43:48'),
(3, 3, 'Customer', 'customer@yahoo.com', '', '1234567890', '8523697410', 'images/', 'Customer', 0, '0', 1, '2024-04-06 21:18:57'),
(4, 2, 'Ghofran Hijazi', 'ghofran@yahoo.com', '                                                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ijd wduwbdiuwd wduwbdiwbdw dwuidwidhw kwdwdwd                                                                  ', 'Ab@12345', '0147852369', 'Photographer_Images/default_user.jpg', 'Accepted', 4, '150', 1, '2024-04-08 00:30:40'),
(5, 3, 'Customer', 'customer2@yahoo.com', NULL, 'Ab@12345', '0123456789', 'Photographer_Images/default_user.jpg', 'Pending', 0, '0', 1, '2024-04-14 22:46:07'),
(6, 3, 'Lina Droos', 'lina@yahoo.com', NULL, 'Ab@12345', '9876543210', 'Photographer_Images/default_user.jpg', 'Pending', 0, '0', 1, '2024-04-20 22:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `users_types`
--

CREATE TABLE `users_types` (
  `id` int(11) NOT NULL,
  `type` varchar(191) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_types`
--

INSERT INTO `users_types` (`id`, `type`, `created_at`) VALUES
(1, 'ADMIN', '2024-04-06 18:16:02'),
(2, 'PHOTOGRAPHER', '2024-04-06 18:16:02'),
(3, 'CUSTOMER', '2024-04-06 18:16:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_photographer_rates`
--
ALTER TABLE `customer_photographer_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_FK` (`customer_id`),
  ADD KEY `photographer_FK` (`photographer_id`);

--
-- Indexes for table `photographer_accessories`
--
ALTER TABLE `photographer_accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_FK` (`category_id`),
  ADD KEY `photographer_FK_1` (`photographer_id`);

--
-- Indexes for table `photographer_pictures`
--
ALTER TABLE `photographer_pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_FK_1` (`category_id`),
  ADD KEY `photographer_FK_2` (`photographer_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_FK_2` (`category_id`),
  ADD KEY `photographer_FK_3` (`photographer_id`),
  ADD KEY `customer_FK_1` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id_FK` (`user_type_id`);

--
-- Indexes for table `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_photographer_rates`
--
ALTER TABLE `customer_photographer_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photographer_accessories`
--
ALTER TABLE `photographer_accessories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photographer_pictures`
--
ALTER TABLE `photographer_pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_photographer_rates`
--
ALTER TABLE `customer_photographer_rates`
  ADD CONSTRAINT `customer_FK` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `photographer_FK` FOREIGN KEY (`photographer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `photographer_accessories`
--
ALTER TABLE `photographer_accessories`
  ADD CONSTRAINT `category_FK` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `photographer_FK_1` FOREIGN KEY (`photographer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `photographer_pictures`
--
ALTER TABLE `photographer_pictures`
  ADD CONSTRAINT `category_FK_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `photographer_FK_2` FOREIGN KEY (`photographer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `category_FK_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `customer_FK_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `photographer_FK_3` FOREIGN KEY (`photographer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `type_id_FK` FOREIGN KEY (`user_type_id`) REFERENCES `users_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
