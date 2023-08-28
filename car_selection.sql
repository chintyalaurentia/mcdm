-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 03:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_selection`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `manufacturer` varchar(20) NOT NULL,
  `sales_in_thousands` varchar(20) NOT NULL,
  `year_resale_value` varchar(20) NOT NULL,
  `price_in_thousands` varchar(20) NOT NULL,
  `horsepower` varchar(20) NOT NULL,
  `curb_weight` varchar(20) NOT NULL,
  `fuel_capacity` varchar(20) NOT NULL,
  `fuel_efficiency` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `manufacturer`, `sales_in_thousands`, `year_resale_value`, `price_in_thousands`, `horsepower`, `curb_weight`, `fuel_capacity`, `fuel_efficiency`) VALUES
(1, 'Chevrolet', 'high', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(2, 'Chevrolet', 'high', 'low', 'low', 'average', 'heavy', 'medium', 'excellent'),
(3, 'Chevrolet', 'low', 'low', 'low', 'average', 'heavy', 'medium', 'excellent'),
(4, 'Chevrolet', 'medium', 'low', 'low', 'average', 'heavy', 'large', 'excellent'),
(5, 'Chevrolet', 'medium', 'low', 'low', 'fast', 'heavy', 'medium', 'excellent'),
(6, 'Chevrolet', 'low', 'medium', 'medium', 'fast', 'heavy', 'large', 'average'),
(7, 'Chevrolet', 'medium', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(8, 'Chevrolet', 'low', 'low', 'low', 'low', 'average', 'small', 'excellent'),
(9, 'Dodge', 'high', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(10, 'Dodge', 'low', 'low', 'low', 'average', 'average', 'medium', 'average'),
(11, 'Dodge', 'high', 'low', 'low', 'average', 'heavy', 'medium', 'average'),
(12, 'Dodge', 'low', 'high', 'medium', 'fast', 'heavy', 'large', 'bad'),
(13, 'Dodge', 'high', 'low', 'low', 'fast', 'heavy', 'large', 'bad'),
(14, 'Dodge', 'low', 'low', 'low', 'average', 'heavy', 'large', 'bad'),
(15, 'Dodge', 'medium', 'low', 'low', 'average', 'heavy', 'large', 'bad'),
(16, 'Dodge', 'high', 'low', 'low', 'low', 'heavy', 'large', 'bad'),
(17, 'Dodge', 'high', 'low', 'low', 'low', 'heavy', 'large', 'average'),
(18, 'Toyota', 'high', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(19, 'Toyota', 'high', 'low', 'low', 'low', 'average', 'large', 'excellent'),
(20, 'Toyota', 'high', 'low', 'medium', 'fast', 'heavy', 'large', 'excellent'),
(21, 'Toyota', 'medium', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(22, 'Toyota', 'high', 'low', 'low', 'low', 'average', 'medium', 'average'),
(23, 'Toyota', 'medium', 'low', 'low', 'low', 'average', 'medium', 'excellent'),
(24, 'Toyota', 'high', 'low', 'low', 'low', 'heavy', 'large', 'average'),
(25, 'Toyota', 'low', 'medium', 'medium', 'fast', 'heavy', 'large', 'bad');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_detail_list`
--

CREATE TABLE `criteria_detail_list` (
  `id` int(11) NOT NULL,
  `id_criteria` int(11) NOT NULL,
  `criteria_range` varchar(25) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria_detail_list`
--

INSERT INTO `criteria_detail_list` (`id`, `id_criteria`, `criteria_range`, `detail`) VALUES
(1, 1, '&gt;100', 'Very High'),
(2, 1, '50-75', 'High'),
(3, 1, '25-50', 'Medium'),
(4, 1, '0-25', 'Low'),
(5, 2, '50-75', 'High'),
(6, 2, '25-50', 'Medium'),
(7, 2, '0-25', 'Low'),
(8, 3, '75-100', 'High'),
(9, 3, '40-75', 'Medium'),
(10, 3, '0-40', 'Low'),
(11, 4, '&gt;200', 'Fast'),
(12, 4, '100-200', 'Average'),
(13, 4, '&lt;100', 'Low'),
(14, 5, '3-4', 'Heavy'),
(15, 5, '1-2', 'Average'),
(16, 5, '0-1', 'Light'),
(17, 6, '&gt;14', 'Large'),
(18, 6, '7-14', 'Medium'),
(19, 6, '&lt;7', 'Small'),
(20, 7, '&gt;35', 'Excellent'),
(21, 7, '25-35', 'Average'),
(22, 7, '&lt;25', 'Bad');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_list`
--

CREATE TABLE `criteria_list` (
  `id` int(11) NOT NULL,
  `criteria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `criteria_list`
--

INSERT INTO `criteria_list` (`id`, `criteria`) VALUES
(1, 'Sales in Thousand'),
(2, 'Year Resale Value'),
(3, 'Price in Thousand'),
(4, 'Horsepower'),
(5, 'Curb Weight'),
(6, 'Fuel Capacity'),
(7, 'Fuel Efficiency');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criteria_detail_list`
--
ALTER TABLE `criteria_detail_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_criteria` (`id_criteria`);

--
-- Indexes for table `criteria_list`
--
ALTER TABLE `criteria_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `criteria_detail_list`
--
ALTER TABLE `criteria_detail_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `criteria_list`
--
ALTER TABLE `criteria_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criteria_detail_list`
--
ALTER TABLE `criteria_detail_list`
  ADD CONSTRAINT `FK_id_criteria` FOREIGN KEY (`id_criteria`) REFERENCES `criteria_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
