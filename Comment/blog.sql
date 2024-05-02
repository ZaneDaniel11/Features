-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 06:26 AM
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
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_reply_tb`
--

CREATE TABLE `comment_reply_tb` (
  `comment_repy_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `reply_msg` longtext NOT NULL,
  `commented_on` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_reply_tb`
--

INSERT INTO `comment_reply_tb` (`comment_repy_id`, `user_id`, `comment_id`, `reply_msg`, `commented_on`, `created_at`) VALUES
(1, 0, 0, '', '2024-04-23', '2024-04-23 03:15:53'),
(2, 1, 0, '', '2024-04-23', '2024-04-23 03:16:28'),
(3, 1, 1, '', '2024-04-23', '2024-04-23 03:18:09'),
(4, 1, 1, 'reply', '2024-04-23', '2024-04-23 03:18:53'),
(5, 1, 1, 'dwa', '2024-04-23', '2024-04-23 03:40:05'),
(6, 1, 1, 'daw', '2024-04-23', '2024-04-23 03:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `comment_tb`
--

CREATE TABLE `comment_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `msg` longtext NOT NULL,
  `commented_on` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_tb`
--

INSERT INTO `comment_tb` (`id`, `user_id`, `msg`, `commented_on`, `created_at`) VALUES
(1, 1, 'shesh', '0000-00-00', '2024-04-20 02:43:19'),
(2, 1, 'whoa', '0000-00-00', '2024-04-20 02:44:13'),
(3, 1, 'shesj', '0000-00-00', '2024-04-20 07:45:25'),
(4, 1, 'shes', '0000-00-00', '2024-04-20 08:08:14'),
(5, 1, 'shesh\\n', '0000-00-00', '2024-04-20 11:06:37'),
(6, 1, 'daw', '0000-00-00', '2024-04-20 11:34:09'),
(7, 1, 'dwa', '0000-00-00', '2024-04-21 06:13:20'),
(8, 1, 'awd', '0000-00-00', '2024-04-21 06:26:29'),
(9, 1, 'daw', '0000-00-00', '2024-04-21 06:26:37');

-- --------------------------------------------------------

--
-- Table structure for table `users_db`
--

CREATE TABLE `users_db` (
  `user_id` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fullName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_db`
--

INSERT INTO `users_db` (`user_id`, `email`, `password`, `date`, `fullName`) VALUES
(1, 'username@gmail.com', 'password', '2024-04-19 13:39:34', 'First Username'),
(2, 'admin@gmail.com', 'password', '2024-04-20 15:22:30', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_reply_tb`
--
ALTER TABLE `comment_reply_tb`
  ADD PRIMARY KEY (`comment_repy_id`);

--
-- Indexes for table `comment_tb`
--
ALTER TABLE `comment_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_db`
--
ALTER TABLE `users_db`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_reply_tb`
--
ALTER TABLE `comment_reply_tb`
  MODIFY `comment_repy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment_tb`
--
ALTER TABLE `comment_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_db`
--
ALTER TABLE `users_db`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
