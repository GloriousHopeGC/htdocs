-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 11:39 AM
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
-- Database: `testingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `position`, `office`, `age`, `salary`) VALUES
(1, 'Tiger Wood', 'Accountant', 'Tokyo', 36, 5689),
(2, 'Mark Oto Ednalan', 'Chief Executive Officer (CEO)', 'London', 56, 5648),
(3, 'Jacob thompson', 'Junior Technical Author', 'San Francisco', 23, 5689),
(4, 'cylde Ednalan', 'Software Engineer', 'Olongapo', 23, 54654),
(5, 'Rhona Davidson', 'Software Engineer', 'San Francisco', 26, 5465),
(6, 'Quinn Flynn', 'Integration Specialist', 'New York', 53, 56465),
(8, 'Tiger Nixon', 'Software Engineer', 'London', 45, 456),
(9, 'Airi Satou updated', 'Pre-Sales Support updated', 'New York', 25, 4568),
(10, 'Angelica Ramos updated', 'Sales Assistant updated', 'New York', 45, 456),
(11, 'Ashton updated', 'Senior Javascript Developer', 'Olongapo', 45, 54565),
(12, 'Bradley Greer', 'Regional Director', 'San Francisco', 27, 5485),
(13, 'Brenden Wagner', 'Javascript Developer', 'San Francisco', 38, 65468),
(14, 'Brielle Williamson', 'Personnel Lead', 'Olongapo', 56, 354685),
(15, 'Bruno Nash', 'Customer Support', 'New York', 36, 65465),
(16, 'cairocoders', 'Sales Assistant', 'Sydney', 45, 56465),
(17, 'Zorita Serrano', 'Support Engineer', 'San Francisco', 38, 6548),
(18, 'Zenaida Frank', 'Chief Operating Officer (COO)', 'San Francisco', 39, 545),
(19, 'Sakura Yamamoto', 'Support Engineer', 'Tokyo', 48, 5468),
(20, 'Serge Baldwin', 'Data Coordinator', 'Singapore', 85, 5646),
(21, 'Shad Decker', 'Regional Director', 'Tokyo', 45, 4545);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
