-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2025 at 10:03 AM
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
-- Database: `sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `c`
--

CREATE TABLE `c` (
  `classification_id` int(11) NOT NULL,
  `c_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `c`
--

INSERT INTO `c` (`classification_id`, `c_name`) VALUES
(1, 'Chips'),
(2, 'Candies'),
(3, 'Drinks'),
(4, 'Snacks'),
(5, 'Noodles'),
(6, 'Canned Goods'),
(7, 'Condiments'),
(8, 'Baking'),
(9, 'Spreads'),
(10, 'Sauces');

-- --------------------------------------------------------

--
-- Table structure for table `d`
--

CREATE TABLE `d` (
  `date_id` int(11) NOT NULL,
  `date_delivered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `d`
--

INSERT INTO `d` (`date_id`, `date_delivered`) VALUES
(1, '2024-06-24'),
(2, '2024-06-25'),
(3, '2024-06-26'),
(4, '2024-06-27'),
(5, '2024-06-28'),
(6, '2024-06-29'),
(7, '2024-06-30'),
(8, '2024-07-01'),
(9, '2024-07-02'),
(10, '2024-07-03'),
(11, '2024-07-04'),
(12, '2024-07-05'),
(13, '2024-07-06'),
(14, '2024-07-07'),
(15, '2024-07-08'),
(16, '2024-07-09'),
(17, '2024-07-10'),
(18, '2024-07-11'),
(19, '2024-07-12'),
(20, '2024-07-13'),
(21, '2024-07-14'),
(22, '2024-07-15'),
(23, '2024-07-16'),
(24, '2024-07-17'),
(25, '2024-07-18'),
(26, '2024-07-19'),
(27, '2024-07-20'),
(28, '2024-07-21'),
(29, '2024-07-22'),
(30, '2024-07-23'),
(31, '2024-07-24'),
(32, '2024-07-25'),
(33, '2024-07-26'),
(34, '2024-07-27'),
(35, '2024-07-28'),
(36, '2024-07-29'),
(37, '2024-07-30'),
(38, '2024-07-31'),
(39, '2024-08-01'),
(40, '2024-08-02'),
(41, '2024-08-03'),
(42, '2024-08-04'),
(43, '2024-08-05'),
(44, '2024-08-06'),
(45, '2024-08-07'),
(46, '2024-08-08'),
(47, '2024-08-09'),
(48, '2024-08-10'),
(49, '2024-08-11'),
(50, '2024-08-12'),
(51, '2024-10-30'),
(52, '2024-04-11'),
(53, '2025-02-02'),
(54, '2024-07-21'),
(55, '2025-03-15'),
(56, '2024-12-30'),
(57, '2024-11-09'),
(58, '2024-06-23'),
(59, '2025-01-22'),
(60, '2025-02-18'),
(61, '2024-10-07'),
(62, '2024-08-15'),
(63, '2025-02-25'),
(64, '2024-11-11'),
(65, '2025-01-03'),
(66, '2024-07-14'),
(67, '2025-03-19'),
(68, '2024-10-20'),
(69, '2024-06-29'),
(70, '2024-09-08'),
(71, '2024-08-04'),
(72, '2024-04-18'),
(73, '2024-11-21'),
(74, '2025-02-05'),
(75, '2024-03-12'),
(76, '2024-05-27'),
(77, '2024-08-14'),
(78, '2024-07-06'),
(79, '2024-12-13'),
(80, '2025-02-16'),
(81, '2024-10-27'),
(82, '2025-03-13'),
(83, '2024-09-15'),
(84, '2025-01-30'),
(85, '2024-05-10'),
(86, '2024-08-12'),
(87, '2024-06-07'),
(88, '2025-04-18'),
(89, '2025-03-22'),
(90, '2024-09-08'),
(91, '2024-07-10'),
(92, '2024-05-16'),
(93, '2024-11-30'),
(94, '2024-06-25'),
(95, '2024-09-16'),
(96, '2025-03-25'),
(97, '2024-07-21'),
(98, '2024-11-14'),
(99, '2024-06-17'),
(100, '2024-12-10'),
(101, '2025-01-19'),
(102, '2024-08-05'),
(103, '2025-05-15'),
(104, '2024-07-22'),
(105, '2025-04-30'),
(106, '2024-06-09'),
(107, '2024-09-14'),
(108, '2024-11-28'),
(109, '2025-03-07'),
(110, '2024-07-25'),
(111, '2024-12-02'),
(112, '2025-02-18'),
(113, '2025-05-06'),
(114, '2024-09-30'),
(115, '2025-01-15'),
(116, '2025-03-10'),
(117, '2024-10-27'),
(118, '2025-06-22'),
(119, '2024-08-30');

-- --------------------------------------------------------

--
-- Table structure for table `p`
--

CREATE TABLE `p` (
  `product_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `classification_id` int(11) NOT NULL,
  `p_desc` text NOT NULL,
  `pieces_pack` varchar(10) DEFAULT NULL,
  `size` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `p`
--

INSERT INTO `p` (`product_id`, `name`, `classification_id`, `p_desc`, `pieces_pack`, `size`) VALUES
(1, 'Piattos', 1, 'Cheese Flavor', NULL, '40g'),
(2, 'Frutos', 2, 'Soft Chewy Candy', '50 pcs.', '175g'),
(3, 'C2 AppleTea', 3, 'Apple Green Tea Flavor', NULL, '230ml'),
(4, 'C2 Lemon Tea', 3, 'Lemon Green Tea Flavor', NULL, '230ml'),
(5, 'Crossini', 4, 'Chocolate Flavor', '10 pcs.', '35g'),
(6, 'Cheezy Corn Crunch', 4, 'Spicy & Cheesy Flavor', NULL, '22g'),
(7, 'Coca-Cola', 3, 'Regular Mismo', NULL, '300ml'),
(8, 'Maxx', 2, 'Cherry Flavor', '50 pcs.', '200g'),
(9, 'Oishi Pillows', 4, 'Chocolate Filled Crackers', NULL, '24g'),
(10, 'Mentos', 2, 'Mint Flavor', NULL, '38g'),
(11, 'Richoco', 4, 'Chocolate Wafer', NULL, '50g'),
(12, 'Lucky Me Pancit Canton', 5, 'Kalamansi Flavor', NULL, '60g'),
(13, 'Lucky Me Instant Noodles', 5, 'Beef Flavor', NULL, '55g'),
(14, 'Nissin Cup Noodles', 5, 'Seafood Flavor', NULL, '60g'),
(15, 'Mountain Dew', 3, 'Mountain Dew Mismo', NULL, '295ml'),
(16, 'Royal', 3, 'Tru-Orange Regular Mismo', NULL, '250ml'),
(17, 'Sprite', 3, 'Sprite Mismo', NULL, '290ml'),
(18, 'RC Cola', 3, 'RC Cola Misma', NULL, '237ml'),
(19, 'Zest-O', 3, 'Zest-O Big 250 Apple', NULL, '250ml'),
(20, 'Vcut', 1, 'Spicy Barbecue Flavor', NULL, '60g'),
(21, 'Combi', 4, 'Choco wafer', NULL, '30g'),
(22, 'Roller Coaster', 1, 'Cheddar Cheese Potato Rings', NULL, '85g'),
(23, 'Hansel', 4, 'Chocolate Sandwich', NULL, '310g'),
(24, 'Yakult', 3, 'Probiotic Milk', NULL, '65ml'),
(25, 'Sting', 3, 'Energy Drink', NULL, '320ml'),
(26, 'Lay\'s', 1, 'Classic Chips', NULL, '150g'),
(27, 'Kit Kat', 4, 'Milk Chocolate Wafer Bar', NULL, '45g'),
(28, 'Tropicana', 3, 'Orange Juice', NULL, '1L'),
(29, 'Hershey\'s', 4, 'Milk Chocolate Bar', NULL, '100g'),
(30, 'Red Bull', 3, 'Energy Drink', NULL, '250ml'),
(31, 'Choco Mucho', 4, 'Chocolate and Wafer', NULL, '25g'),
(32, 'Big Bang', 4, 'Popcorn', NULL, '100g'),
(33, 'Gatorade', 3, 'Lemon-Lime', NULL, '500ml'),
(34, 'M&M\'s', 2, 'Peanut Butter', NULL, '150g'),
(35, 'Pringles', 1, 'Sour Cream & Onion', NULL, '70g'),
(36, 'Reese\'s', 2, 'Peanut Butter Cups', NULL, '40g'),
(37, '7-Up', 3, 'Regular', NULL, '330ml'),
(38, 'Nescafe', 3, 'Instant Coffee', NULL, '100g'),
(39, 'Oreo', 4, 'Original Cookies', NULL, '150g'),
(40, 'Lays BBQ', 1, 'Barbecue Chips', NULL, '130g'),
(41, 'Tostitos', 4, 'Tortilla Chips', NULL, '200g'),
(42, 'Fanta', 3, 'Orange Flavor', NULL, '330ml'),
(43, 'Munch', 4, 'Chocolate Bar', NULL, '60g'),
(44, 'Cheetos', 1, 'Cheese Flavored Snacks', NULL, '60g'),
(45, 'Snickers', 4, 'Chocolate Peanut Bar', NULL, '50g'),
(46, 'Lipton', 3, 'Iced Tea Lemon', NULL, '500ml'),
(47, 'Goya', 4, 'Chocolate Coated Nuts', NULL, '150g'),
(48, 'Minute Maid', 3, 'Apple Juice', NULL, '1L'),
(49, 'Sweet Corn', 4, 'Sweet Corn Snack', NULL, '25g'),
(50, 'Skittles', 2, 'Tropical Flavor', NULL, '150g'),
(51, 'Mountain Dew', 3, 'Code Red', NULL, '500ml'),
(52, 'Pepsi', 3, 'Regular Soda', NULL, '300ml'),
(53, 'Big Gulp', 3, 'Slush', NULL, '500ml'),
(54, 'Crunch', 4, 'Chocolate and Peanut Butter Bar', NULL, '40g'),
(55, 'Lays Sour Cream', 1, 'Sour Cream Chips', NULL, '150g'),
(56, 'Red Ribbon', 4, 'Butter Cake', NULL, '500g'),
(57, 'Kit Kat Chunky', 4, 'Chocolate Bar', NULL, '60g'),
(58, 'Gummy Bears', 2, 'Fruit-flavored Gummies', NULL, '200g'),
(59, 'Puregold', 3, 'Pure Orange Juice', NULL, '250ml'),
(60, 'Cadbury', 4, 'Dairy Milk Chocolate', NULL, '100g'),
(61, 'Tropicana', 3, 'Pineapple Juice', NULL, '1L'),
(62, 'Mentos', 2, 'Fruity Chewy Candy', NULL, '37g'),
(63, 'Popcorn King', 4, 'Buttered Popcorn', NULL, '150g'),
(64, 'Choco Pie', 4, 'Chocolate Filled Snack Cake', NULL, '80g'),
(65, 'Aquafina', 3, 'Bottled Water', NULL, '500ml'),
(66, 'Viso', 3, 'Vitamin C Drink', NULL, '330ml'),
(67, 'Cadbury Dairy Milk', 4, 'Chocolate Bar', NULL, '120g'),
(68, 'Bounty', 4, 'Coconut Chocolate Bar', NULL, '58g'),
(69, 'Sprite Zero', 3, 'Sugar-Free Sprite', NULL, '330ml'),
(70, 'Jack n\' Jill', 1, 'Potato Chips, Barbecue', NULL, '80g'),
(71, 'Hershey\'s Kisses', 2, 'Milk Chocolate', NULL, '150g'),
(72, 'Del Monte', 3, 'Pineapple Juice', NULL, '1L'),
(73, 'C2 Green Tea', 3, 'Lemon & Honey', NULL, '230ml'),
(74, 'Gatorade Frost', 3, 'Glacier Freeze', NULL, '500ml'),
(75, 'Jolly Time Popcorn', 4, 'Classic Butter', NULL, '100g'),
(76, 'M&M\'s Peanut', 2, 'Peanut Chocolate Candies', NULL, '200g'),
(77, 'Pepsi Max', 3, 'Sugar-Free Cola', NULL, '330ml'),
(78, 'Oishi Prawn Crackers', 4, 'Original Prawn Flavor', NULL, '100g'),
(79, 'McVitie\'s Digestive Biscuits', 4, 'Chocolate Coated Biscuits', NULL, '250g'),
(80, 'Crush', 3, 'Orange Soda', NULL, '330ml'),
(81, 'Dole', 3, 'Orange Juice', NULL, '1L'),
(82, 'Chippy', 1, 'Barbecue Flavor', NULL, '80g'),
(83, 'Mang Juan', 1, 'Spicy Corn Chips', NULL, '50g'),
(84, 'Boy Bawang', 4, 'Garlicky Flavor', NULL, '50g'),
(85, 'Nissin Pancit Canton', 5, 'Original Flavor', NULL, '60g'),
(86, 'Sunny Gold', 4, 'Banana Chips', NULL, '150g'),
(87, 'Milo', 3, 'Chocolate Malt Drink', NULL, '500g'),
(88, 'Juicy Lemon', 3, 'Lemon Iced Tea', NULL, '500ml'),
(89, 'Taro Chips', 1, 'Original Flavor', NULL, '100g'),
(90, 'Red Ribbon', 4, 'Ube Cake', NULL, '400g'),
(91, 'White King', 4, 'Pancake Mix', NULL, '200g'),
(92, 'Oishi Prawn Crackers', 4, 'Spicy Prawn', NULL, '150g'),
(93, 'Bear Brand', 3, 'Powdered Milk', NULL, '400g'),
(94, 'Ligo', 6, 'Sardines', NULL, '155g'),
(95, 'Century Tuna', 6, 'Hot & Spicy', NULL, '180g'),
(96, 'Lucky Me Pancit Canton', 5, 'Instant Noodles', NULL, '60g'),
(97, '555 Tuna', 6, 'Chunk Style', NULL, '180g'),
(98, 'Jack n\' Jill', 4, 'Calbee Sweet Potato Chips', NULL, '60g'),
(99, 'C2 Green Tea', 3, 'Lemon Flavor', NULL, '230ml'),
(100, 'Nestle Chuckie', 3, 'Chocolate Milk', NULL, '250ml'),
(101, 'Nova', 1, 'Country Cheddar', NULL, '78g'),
(102, 'Rebisco Crackers', 4, 'Butter Flavor', NULL, '32g'),
(103, 'NutriAsia Datu Puti', 7, 'Soy Sauce', NULL, '385ml'),
(104, 'Chips Delight', 4, 'Chocolate Chip Cookies', NULL, '60g'),
(105, 'Zesto Choco Boom', 3, 'Chocolate Drink', NULL, '200ml'),
(106, 'Cloud 9', 4, 'Chocolate Bar', NULL, '50g'),
(107, 'Nestle Bear Brand', 3, 'Sterilized Milk', NULL, '500ml'),
(108, 'Oreo Thins', 4, 'Vanilla Creme', NULL, '100g'),
(109, 'Nagaraya', 4, 'BBQ Cracker Nuts', NULL, '160g'),
(110, 'Gulaman Powder', 8, 'Strawberry', NULL, '50g'),
(111, 'Sprite Cranberry', 3, 'Cranberry Soda', NULL, '330ml'),
(112, 'Energen', 3, 'Chocolate Cereal Drink', NULL, '400ml'),
(113, 'Ruffles', 1, 'Sour Cream & Onion', NULL, '125g'),
(114, 'Dutch Mill', 3, 'Yogurt Drink', NULL, '180ml'),
(115, 'Primo', 4, 'Butter Cookies', NULL, '150g'),
(116, 'Nutella', 9, 'Hazelnut Spread', NULL, '350g'),
(117, 'Tostitos Salsa', 10, 'Chunky Medium', NULL, '400g'),
(118, 'Coca-Cola Zero', 3, 'Sugar-Free Cola', NULL, '500ml'),
(119, 'Lays Stax', 1, 'Sour Cream & Onion', NULL, '155g');

-- --------------------------------------------------------

--
-- Table structure for table `stck`
--

CREATE TABLE `stck` (
  `stck_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `storage_id` int(11) NOT NULL,
  `num_stck` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `date_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `stck`
--

INSERT INTO `stck` (`stck_id`, `product_id`, `storage_id`, `num_stck`, `remarks`, `date_id`) VALUES
(1, 1, 1, 57, 'In stock', 1),
(2, 2, 2, 94, 'In stock', 2),
(3, 3, 3, 19, 'Low stock', 3),
(4, 4, 2, 27, 'Low stock', 4),
(5, 5, 1, 35, 'In stock', 5),
(6, 6, 1, 29, 'Low stock', 6),
(7, 7, 2, 12, 'Low stock', 7),
(8, 8, 3, 53, 'In stock', 8),
(9, 9, 1, 37, 'In stock', 9),
(10, 10, 3, 75, 'In stock', 10),
(11, 11, 1, 32, 'Low stock', 11),
(12, 12, 1, 21, 'Low stock', 12),
(13, 13, 1, 42, 'In stock', 13),
(14, 14, 1, 12, 'Low stock', 14),
(15, 15, 2, 85, 'In stock', 15),
(16, 16, 2, 93, 'In stock', 16),
(17, 17, 2, 64, 'In stock', 17),
(18, 18, 2, 32, 'Low stock', 18),
(19, 19, 2, 21, 'Low stock', 19),
(20, 20, 1, 72, 'In stock', 20),
(21, 21, 1, 14, 'Low stock', 21),
(22, 22, 1, 10, 'Low stock', 22),
(23, 23, 1, 50, 'In stock', 23),
(24, 24, 2, 23, 'Low stock', 24),
(25, 25, 2, 79, 'In stock', 25),
(26, 26, 1, 43, 'In stock', 26),
(27, 27, 1, 36, 'In stock', 27),
(28, 28, 2, 56, 'In stock', 28),
(29, 29, 1, 48, 'In stock', 29),
(30, 30, 2, 60, 'In stock', 30),
(31, 31, 1, 49, 'In stock', 31),
(32, 32, 1, 20, 'Low stock', 32),
(33, 33, 2, 80, 'In stock', 33),
(34, 34, 3, 68, 'In stock', 34),
(35, 35, 1, 75, 'In stock', 35),
(36, 36, 3, 52, 'In stock', 36),
(37, 37, 2, 30, 'Low stock', 37),
(38, 38, 2, 62, 'In stock', 38),
(39, 39, 1, 65, 'In stock', 39),
(40, 40, 1, 58, 'In stock', 40),
(41, 41, 1, 22, 'Low stock', 41),
(42, 42, 2, 26, 'Low stock', 42),
(43, 43, 1, 19, 'Low stock', 43),
(44, 44, 1, 23, 'Low stock', 44),
(45, 45, 1, 29, 'Low stock', 45),
(46, 46, 2, 13, 'Low stock', 46),
(47, 47, 1, 17, 'Low stock', 47),
(48, 48, 2, 55, 'In stock', 48),
(49, 49, 1, 80, 'In stock', 49),
(50, 50, 3, 60, 'In stock', 50),
(51, 51, 2, 48, 'In stock', 51),
(52, 52, 2, 54, 'In stock', 52),
(53, 53, 2, 38, 'In stock', 53),
(54, 54, 1, 33, 'In stock', 54),
(55, 55, 1, 72, 'In stock', 55),
(56, 56, 1, 27, 'Low stock', 56),
(57, 57, 1, 63, 'In stock', 57),
(58, 58, 2, 49, 'In stock', 58),
(59, 59, 3, 28, 'Low stock', 59),
(60, 60, 2, 25, 'Low stock', 60),
(61, 61, 1, 30, 'Low stock', 61),
(62, 62, 3, 16, 'Low stock', 62),
(63, 63, 1, 32, 'Low stock', 63),
(64, 64, 1, 18, 'Low stock', 64),
(65, 65, 1, 25, 'Low stock', 65),
(66, 66, 2, 28, 'Low stock', 66),
(67, 67, 1, 19, 'Low stock', 67),
(68, 68, 1, 23, 'Low stock', 68),
(69, 69, 2, 77, 'In stock', 69),
(70, 70, 1, 64, 'In stock', 70),
(71, 71, 2, 45, 'In stock', 71),
(72, 72, 1, 82, 'In stock', 72),
(73, 73, 3, 53, 'In stock', 73),
(74, 74, 1, 32, 'Low stock', 74),
(75, 75, 1, 28, 'Low stock', 75),
(76, 76, 2, 59, 'In stock', 76),
(77, 77, 2, 64, 'In stock', 77),
(78, 78, 1, 42, 'In stock', 78),
(79, 79, 1, 51, 'In stock', 79),
(80, 80, 2, 68, 'In stock', 80),
(81, 81, 1, 55, 'In stock', 81),
(82, 82, 1, 68, 'In stock', 82),
(83, 83, 2, 45, 'In stock', 83),
(84, 84, 3, 72, 'In stock', 84),
(85, 85, 1, 64, 'In stock', 85),
(86, 86, 1, 50, 'In stock', 86),
(87, 87, 1, 83, 'In stock', 87),
(88, 88, 2, 39, 'In stock', 88),
(89, 89, 1, 51, 'In stock', 89),
(90, 90, 2, 56, 'In stock', 90),
(91, 91, 1, 42, 'In stock', 91),
(92, 92, 3, 48, 'In stock', 92),
(93, 93, 1, 70, 'In stock', 93),
(94, 94, 2, 34, 'In stock', 94),
(95, 95, 2, 49, 'In stock', 95),
(96, 96, 2, 58, 'In stock', 96),
(97, 97, 3, 61, 'In stock', 97),
(98, 98, 1, 42, 'In stock', 98),
(99, 99, 2, 51, 'In stock', 99),
(100, 100, 1, 40, 'In stock', 100),
(101, 101, 2, 58, 'In stock', 101),
(102, 102, 1, 29, 'Low stock', 102),
(103, 103, 1, 45, 'In stock', 103),
(104, 104, 1, 37, 'In stock', 104),
(105, 105, 1, 27, 'Low stock', 105),
(106, 106, 3, 61, 'In stock', 106),
(107, 107, 1, 33, 'In stock', 107),
(108, 108, 2, 52, 'In stock', 108),
(109, 109, 1, 48, 'In stock', 109),
(110, 110, 2, 20, 'Low stock', 110),
(111, 111, 2, 35, 'In stock', 111),
(112, 112, 3, 68, 'In stock', 112),
(113, 113, 1, 49, 'In stock', 113),
(114, 114, 3, 57, 'In stock', 114),
(115, 115, 2, 42, 'In stock', 115),
(116, 116, 2, 25, 'Low stock', 116),
(117, 117, 1, 19, 'Low stock', 117),
(118, 118, 1, 50, 'In stock', 118),
(119, 119, 3, 62, 'In stock', 119);

--
-- 
--
-- --------------------------------------------------------

--
-- Table structure for table `strg`
--

CREATE TABLE `strg` (
  `storage_id` int(11) NOT NULL,
  `strg_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `strg`
--

INSERT INTO `strg` (`storage_id`, `strg_location`) VALUES
(1, 'Storage A'),
(2, 'Storage B'),
(3, 'Storage C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c`
--
ALTER TABLE `c`
  ADD PRIMARY KEY (`classification_id`);

--
-- Indexes for table `d`
--
ALTER TABLE `d`
  ADD PRIMARY KEY (`date_id`);

--
-- Indexes for table `p`
--
ALTER TABLE `p`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `stck`
--
ALTER TABLE `stck`
  ADD PRIMARY KEY (`stck_id`);

--
-- Indexes for table `strg`
--
ALTER TABLE `strg`
  ADD PRIMARY KEY (`storage_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c`
--
ALTER TABLE `c`
  MODIFY `classification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `d`
--
ALTER TABLE `d`
  MODIFY `date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `p`
--
ALTER TABLE `p`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `stck`
--
ALTER TABLE `stck`
  MODIFY `stck_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `strg`
--
ALTER TABLE `strg`
  MODIFY `storage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
