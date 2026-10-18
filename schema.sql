-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2026 at 12:05 AM
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Meat'),
(2, 'Seafood'),
(3, 'Vegetarian');

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
  `main_image` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `subtitle`, `category`, `main_image`, `category_id`) VALUES
(1, 'Ancho Orange Chicken', 'with Kale Rice & Roasted Carrots', 'Meat', 'images/ancho-orange-chicken/dish.jpg', 1),
(2, 'Beef Medallions & Mushroom Sauce', 'with Mashed Potatoes', 'Meat', 'images/beef-medallions-mushroom-sauce/dish.jpg', 1),
(3, 'Broccoli & Basil Pesto Sandwiches', 'with Romaine & Citrus Salad', 'Vegetarian', 'images/broccoli-basil-pesto-sandwiches/dish.jpg', 3),
(4, 'Broccoli & Mozzarella Calzones', 'with Caesar Salad', 'Vegetarian', 'images/broccoli-mozzarella-calzones/dish.jpg', 3),
(5, 'Bucatini Alfredo', 'with Broccoli', 'Vegetarian', 'images/bucatini-alfredo/dish.jpg', 3),
(6, 'Bucatini & Tomato Sauce', 'with Roasted Broccoli', 'Vegetarian', 'images/bucatini-tomato-sauce/dish.jpg', 3),
(7, 'Cheesy Enchiladas Rojas', 'with Mushrooms & Kale', 'Vegetarian', 'images/cheesy-enchiladas-rojas/dish.jpg', 3),
(8, 'Crispy Fish Sandwiches', 'with Tartar Sauce & Roasted Sweet Potato Wedges', 'Seafood', 'images/crispy-fish-sandwiches/dish.jpg', 2),
(9, 'General Tso\'s Chicken', 'with Bok Choy & Jasmine Rice', 'Meat', 'images/general-tsos-chicken/dish.jpg', 1),
(10, 'Hoisin-Glazed Pork Chops', 'with Stir-Fried Vegetables & Wonton Noodles', 'Meat', 'images/hoisin-glazed-pork-chops/dish.jpg', 1),
(11, 'Honey-Butter Barramundi', 'with Za\'atar Roasted Vegetables', 'Seafood', 'images/honey-butter-barramundi/dish.jpg', 2),
(12, 'Kale & Ricotta Quiche', 'with Romaine, Apple, & Almond Salad', 'Vegetarian', 'images/kale-ricotta-quiche/dish.jpg', 3),
(13, 'Mexican-Spiced Barramundi', 'with Kale, Sweet Potato, & Avocado Salad', 'Seafood', 'images/mexican-spiced-barramundi/dish.jpg', 2),
(14, 'Mushroom & Potato Tacos', 'with Romaine & Orange Salad', 'Vegetarian', 'images/mushroom-potato-tacos/dish.jpg', 3),
(15, 'Parmesan-Crusted Chicken', 'with Mashed Sweet Potatoes & Roasted Broccoli', 'Meat', 'images/parmesan-crusted-chicken/dish.jpg', 1),
(16, 'Pimento Cheeseburgers', 'with Sweet Potato Oven Fries', 'Meat', 'images/pimento-cheeseburgers/dish.jpg', 1),
(17, 'Pork Chorizo Tacos', 'with Cheesy Roasted Potatoes', 'Meat', 'images/pork-chorizo-tacos/dish.jpg', 1),
(18, 'Roasted Broccoli & Fregola Sarda Salad', 'with Hard-Boiled Eggs & Tahini Dressing', 'Vegetarian', 'images/roasted-broccoli-fregola-sarda-salad/dish.jpg', 3),
(19, 'Roasted Brussels Sprout & Freekeh Salad', 'with Lemon Yogurt & Barrel-Aged Feta', 'Vegetarian', 'images/roasted-brussels-sprout-freekeh-salad/dish.jpg', 3),
(20, 'Roasted Cauliflower Salad', 'with Caper Brown Butter & Parmesan Breadcrumbs', 'Vegetarian', 'images/roasted-cauliflower-salad/dish.jpg', 3),
(21, 'Roasted Chicken & Fall Vegetables', 'with Cranberry & Ginger Compote', 'Meat', 'images/roasted-chicken-fall-vegetables/dish.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_recipes_category` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_recipes_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
