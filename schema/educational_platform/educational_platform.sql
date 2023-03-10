SET @ORIG_SQL_REQUIRE_PRIMARY_KEY = @@SQL_REQUIRE_PRIMARY_KEY;
SET SQL_REQUIRE_PRIMARY_KEY = 0;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db-mysql-tor1-18786-do-user-12947055-0.b.db.ondigitalocean.com:25060
-- Generation Time: Dec 13, 2022 at 10:14 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educational_platform`
--
CREATE DATABASE IF NOT EXISTS `educational_platform` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `educational_platform`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_view`
--

CREATE TABLE `category_view` (
  `view_id` int NOT NULL,
  `category_id` int NOT NULL COMMENT 'fk',
  `month` tinyint NOT NULL,
  `year` year NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `resource_id` int NOT NULL,
  `resource_title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(100) DEFAULT 'https://source.unsplash.com/random/?beauty,salon,barber',
  `tags` varchar(150) DEFAULT NULL,
  `content` longtext NOT NULL,
  `date_created` date NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resource_view`
--

CREATE TABLE `resource_view` (
  `view_id` int NOT NULL,
  `resource_id` int NOT NULL COMMENT 'fk',
  `month` tinyint NOT NULL,
  `year` year NOT NULL,
  `count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `category_view`
--
ALTER TABLE `category_view`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `category_hit_category_fk` (`category_id`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `resource_category_fk` (`category_id`);

--
-- Indexes for table `resource_view`
--
ALTER TABLE `resource_view`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `resource_id` (`resource_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_view`
--
ALTER TABLE `category_view`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `resource_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resource_view`
--
ALTER TABLE `resource_view`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_view`
--
ALTER TABLE `category_view`
  ADD CONSTRAINT `category_hit_category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_category_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `resource_view`
--
ALTER TABLE `resource_view`
  ADD CONSTRAINT `resource_hit_resource_fk` FOREIGN KEY (`resource_id`) REFERENCES `resource` (`resource_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
