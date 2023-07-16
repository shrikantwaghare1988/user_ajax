-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 10:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `country`, `state`, `city`) VALUES
(4, 'India', 'Maharashtra', 'Ambarnath'),
(6, 'India', 'Maharashtra', 'Ambarnath'),
(7, 'India', 'Maharashtra', 'Kalyan'),
(8, 'India', 'Maharashtra', 'Kalyan'),
(9, 'India', 'Maharashtra', 'Kalyan'),
(10, 'India', 'Maharashtra', 'Kalyan'),
(11, 'India', 'Maharashtra', 'Kalyan'),
(12, 'India', 'Maharashtra', 'Kalyan'),
(13, 'India', 'Maharashtra', 'Kalyan'),
(14, 'India', 'Maharashtra', 'Thane'),
(15, 'India', 'Maharashtra', 'Thane'),
(16, 'India', 'Maharashtra', 'Thane'),
(17, 'India', 'Maharashtra', 'Thane'),
(18, 'India', 'Maharashtra', 'Ambarnath');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `mobile_no` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `full_name`, `mobile_no`, `email`, `loc_id`, `file_name`, `created_date`) VALUES
(18, 'Shrikant Waghare', '7676565676', 'shrikant23@gmail.com', 4, 'pic_27560.jpg', '2023-07-01 06:13:17'),
(19, 'Dinesh', '9898788787', 'testemail3232@gmail.com', 6, '', '2023-07-01 06:17:47'),
(20, 'Akash', '9898543434', 'testemail326532@gmail.com', 7, 'pic_88392.jpg', '2023-07-03 06:19:18'),
(22, 'Prakash', '9898543434', 'testemail3826532@gmail.com', 9, '', '2023-07-04 06:19:43'),
(23, 'Satish', '9898543434', 'testemail38626532@gmail.com', 10, '', '2023-07-04 06:19:58'),
(24, 'Jayesh', '9898543434', 'testemail386296532@gmail.com', 11, 'pic_48176.jpg', '2023-07-06 06:20:16'),
(25, 'Haresh', '9898543434', 'testemail54@gmail.com', 12, '', '2023-07-06 06:20:35'),
(26, 'Mahesh', '9898543434', 'testemail584@gmail.com', 13, '', '2023-07-07 06:20:52'),
(27, 'Mandar', '9898543434', 'testemail784@gmail.com', 14, 'pic_69118.jpg', '2023-07-08 06:21:27'),
(28, 'Bharat', '9898543434', 'testemail7874@gmail.com', 15, '', '2023-07-08 06:21:40'),
(29, 'Kunal', '9898543434', 'testemail78794@gmail.com', 16, 'pic_48249.jpg', '2023-07-13 06:21:53'),
(30, 'Atul', '9898543434', 'testemail878794@gmail.com', 17, 'pic_88025.jpg', '2023-07-13 06:22:05'),
(31, 'Prashant', '9898543434', 'testemail8778794@gmail.com', 18, 'pic_20987.jpg', '2023-07-13 06:22:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
