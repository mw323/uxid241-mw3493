-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2026 at 10:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookbook`
--
CREATE DATABASE IF NOT EXISTS `cookbook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cookbook`;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `subtitle` varchar(120) NOT NULL,
  `category` varchar(100) NOT NULL,
  `main_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `subtitle`, `category`, `main_image`) VALUES
(1, 'Ancho Orange Chicken', 'with Kale Rice & Roasted Carrots', 'Meat', 'images/ancho-orange-chicken/dish.jpg'),
(2, 'Beef Medallions & Mushroom Sauce', 'with Mashed Potatoes', 'Meat', 'images/beef-medallions-mushroom-sauce/dish.jpg'),
(3, 'Broccoli & Basil Pesto Sandwiches', 'with Romaine & Citrus Salad', 'Vegetarian', 'images/broccoli-basil-pesto-sandwiches/dish.jpg'),
(4, 'Broccoli & Mozzarella Calzones', 'with Caesar Salad', 'Vegetarian', 'images/broccoli-mozzarella-calzones/dish.jpg'),
(5, 'Bucatini Alfredo', 'with Broccoli', 'Vegetarian', 'images/bucatini-alfredo/dish.jpg'),
(6, 'Bucatini & Tomato Sauce', 'with Roasted Broccoli', 'Vegetarian', 'images/bucatini-tomato-sauce/dish.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
