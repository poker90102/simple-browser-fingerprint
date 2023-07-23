-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 04:27 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fingerprinting`
--

-- --------------------------------------------------------

--
-- Table structure for table `fingerprints`
--

CREATE TABLE `fingerprints` (
  `uid` varchar(64) NOT NULL,
  `screeninfo` varchar(500) NOT NULL,
  `hasjava` varchar(500) NOT NULL,
  `pluginlist` varchar(500) NOT NULL,
  `useragent` varchar(500) NOT NULL,
  `propertycount` varchar(500) NOT NULL,
  `webglinfo` varchar(500) NOT NULL,
  `permissions` varchar(500) NOT NULL,
  `ip` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fingerprints`
--

INSERT INTO `fingerprints` (`uid`, `screeninfo`, `hasjava`, `pluginlist`, `useragent`, `propertycount`, `webglinfo`, `permissions`, `ip`) VALUES
('9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', 'c3f4a1dce05d6bf7c109e1b9edd977f8225cbd7ec47e262501e7fc4bda99fe88', '787dd381d93801e46d1a76c9aa0bc716d15a27a373063ea7af2613c7f3119be5', '35da27bbec7797b947952783ea7cd39f4e8115d599eca3746d9ab120fd8ef555', '5a1fc776b0312aa8ad2effb636bc52b1d49a271e03c08f361012cd06dc2ded4e', '40464c51598adf5174b2d648bc686e65dbb6d75427b920ba1abe34afcc9beb9c', '3bf48d16e2afa5870a3e36d40f683927ed274b33bba442df3c01e82d02030e58', '1eee008048761ce84022ddbf4858b90cb7ce66e320abcfa56bcdc679c289e2f4', '4f99683f09c9e534ba9cfe1f5bb552d1b2b385c5f7eabd1e9775dea4eb3e91bf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`) VALUES
(1, 'test', 'lol', 'pass'),
(2, 'testagain', 'test', 'passy'),
(3, 'test2', 'test', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fingerprints`
--
ALTER TABLE `fingerprints`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
