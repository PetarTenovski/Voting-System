-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2024 at 07:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `username`, `password`) VALUES
(1, 'Petar Tenovski', 'petar', '$2y$10$5moLnWhBzCXcqjWHxxkYXOthtjzwBfOE13U0/XbmKWGlhMVHB70hu'),
(3, 'Marko Markov', 'marko', '$2y$10$mX9JdrNsrsglGBziIwEbcuI4YE2Khi1AQ34VBRypVS5HJ6kHS.J6.'),
(5, 'Kiko Kiko', 'kiko', '$2y$10$e7CUjLAFsIKYGJzyFXuHK.1maXtTmVIEzFEW7KO7.uBWrdlL/dN.2'),
(7, 'Barmen', 'martin', '$2y$10$WS6fi./j/Kgq.CDJqYY9i.Jzgg8xzr/yOBHfc3mBAuYpnaJKlu0ae'),
(8, 'Filip Ivanov', 'filip', '$2y$10$X4VxprIFdyImLDBem9YPS.5IfSeKI3WJYRDCC8DDfJRJuKEZuZiSS'),
(13, 'Martin Janevski', 'macko', '$2y$10$84A.DEJ2P.aQ9qAJvFTMmu1IgYQEl8zsmxI5KJQlooCkRhgRdU0/G'),
(14, 'Stefan Stefkov', 'stefan', '$2y$10$2hKKoxX2N5cw9Vm9nZQuue8DsN0M9qTh8eNLg6VUERxDoGMRbEtLq');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `voter_id` int NOT NULL,
  `nominee_id` int NOT NULL,
  `category` enum('Makes Work Fun','Team Player','Culture Champion','Difference Maker') NOT NULL,
  `comment` text NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category`, `comment`, `timestamp`) VALUES
(1, 1, 3, 'Makes Work Fun', '.', '2024-12-05 15:21:15'),
(2, 1, 5, 'Makes Work Fun', '.\r\n', '2024-12-05 15:23:51'),
(3, 1, 3, 'Team Player', '.', '2024-12-05 15:24:08'),
(4, 1, 3, 'Team Player', '.', '2024-12-05 16:24:54'),
(5, 1, 3, 'Culture Champion', '.', '2024-12-05 16:33:00'),
(6, 1, 3, 'Difference Maker', '.', '2024-12-05 16:33:03'),
(7, 5, 3, 'Makes Work Fun', '.', '2024-12-05 16:39:14'),
(8, 5, 3, 'Team Player', '.', '2024-12-05 16:39:22'),
(9, 5, 1, 'Culture Champion', '.', '2024-12-05 16:39:43'),
(10, 5, 3, 'Culture Champion', '.', '2024-12-05 16:39:55'),
(11, 5, 3, 'Difference Maker', '.', '2024-12-05 16:40:15'),
(12, 7, 1, 'Makes Work Fun', '.', '2024-12-05 16:47:00'),
(13, 7, 3, 'Team Player', '.', '2024-12-05 16:47:08'),
(14, 7, 1, 'Difference Maker', '.', '2024-12-05 16:56:43'),
(15, 7, 5, 'Makes Work Fun', '.', '2024-12-05 17:57:34'),
(16, 7, 3, 'Difference Maker', '.', '2024-12-05 17:57:56'),
(17, 1, 7, 'Makes Work Fun', '.', '2024-12-05 18:18:41'),
(18, 1, 7, 'Team Player', '.', '2024-12-05 18:18:49'),
(19, 1, 7, 'Culture Champion', '.', '2024-12-05 18:18:54'),
(20, 1, 7, 'Difference Maker', '.', '2024-12-05 18:18:58'),
(21, 13, 1, 'Makes Work Fun', '.', '2024-12-05 18:49:17'),
(22, 13, 1, 'Team Player', '.', '2024-12-05 18:51:55'),
(23, 13, 5, 'Makes Work Fun', '.', '2024-12-05 18:55:01'),
(24, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:09:25'),
(25, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:09:46'),
(26, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:09:55'),
(27, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:10:08'),
(28, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:10:15'),
(29, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:10:26'),
(30, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:10:34'),
(31, 13, 5, 'Makes Work Fun', '.', '2024-12-05 19:10:48'),
(32, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:10:57'),
(33, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:10:59'),
(34, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:11:01'),
(35, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:11:45'),
(36, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:12:07'),
(37, 13, 7, 'Difference Maker', '.', '2024-12-05 19:12:37'),
(38, 13, 7, 'Difference Maker', '.', '2024-12-05 19:13:02'),
(39, 13, 7, 'Difference Maker', '.', '2024-12-05 19:13:09'),
(40, 13, 7, 'Difference Maker', '.', '2024-12-05 19:14:54'),
(41, 13, 7, 'Difference Maker', '.', '2024-12-05 19:14:59'),
(42, 13, 7, 'Difference Maker', '.', '2024-12-05 19:15:12'),
(43, 13, 7, 'Difference Maker', '.', '2024-12-05 19:15:18'),
(44, 13, 7, 'Difference Maker', '.', '2024-12-05 19:17:58'),
(45, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:18:08'),
(46, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:18:10'),
(47, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:18:17'),
(48, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:18:21'),
(49, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:19:00'),
(50, 13, 1, 'Makes Work Fun', '.', '2024-12-05 19:19:04'),
(51, 1, 3, 'Makes Work Fun', '.', '2024-12-05 19:21:10'),
(52, 1, 3, 'Makes Work Fun', '.', '2024-12-05 19:21:14'),
(53, 1, 3, 'Makes Work Fun', '.', '2024-12-05 19:21:46'),
(54, 1, 3, 'Makes Work Fun', '.', '2024-12-05 19:21:51'),
(55, 1, 5, 'Makes Work Fun', '.', '2024-12-05 19:26:28'),
(56, 1, 5, 'Makes Work Fun', '.', '2024-12-05 19:26:37'),
(57, 14, 1, 'Makes Work Fun', '.', '2024-12-05 19:30:43'),
(58, 14, 1, 'Makes Work Fun', '.', '2024-12-05 19:30:47'),
(59, 14, 1, 'Makes Work Fun', '.', '2024-12-05 19:30:59'),
(60, 14, 1, 'Makes Work Fun', '.', '2024-12-05 19:31:02'),
(61, 14, 1, 'Makes Work Fun', '.', '2024-12-05 19:31:16'),
(62, 14, 1, 'Team Player', '.', '2024-12-05 19:32:50'),
(63, 3, 1, 'Makes Work Fun', '.', '2024-12-05 20:16:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `nominee_id` (`nominee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
