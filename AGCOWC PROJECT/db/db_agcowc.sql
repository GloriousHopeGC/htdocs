-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 08:07 PM
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
-- Database: `db_agcowc`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUser` (IN `p_user_id` INT)   SELECT * from tbl_users where userid = p_user_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_regAgcowc` (IN `p_user_id` INT, IN `p_user_fname` TEXT, IN `p_user_lname` TEXT, IN `p_user_contactnum` TEXT, IN `p_user_email` TEXT, IN `p_user_password` TEXT)   BEGIN

if p_user_id = 0 THEN
insert into users(user_fname,user_lname,user_contactnum,user_email,user_password) values(p_user_fname,p_user_lname,p_user_contactnum,p_user_email, p_user_password());
ELSE
update users set user_fname = p_user_fname, user_lname = p_user_lname, user_contactnum = p_user_contactnum, user_email = p_user_email, user_password = p_user_password where userid = p_user_id;
end if;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin2`
--

CREATE TABLE `admin2` (
  `id` int(11) NOT NULL,
  `admin_fname` varchar(100) NOT NULL,
  `admin_lname` varchar(100) NOT NULL,
  `admin_contactnum` varchar(11) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin2`
--

INSERT INTO `admin2` (`id`, `admin_fname`, `admin_lname`, `admin_contactnum`, `admin_email`, `admin_username`, `admin_password`) VALUES
(2, 'Marcelito', 'Cuyos', '09662379482', 'marcelito@gmail.com', 'lito', '1dd519ab6fffb00896c62913959d2843');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_feedback` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `user_feedback`) VALUES
(6, 2, 'hello my friend'),
(7, 1, 'Ayoha Inyung System Mga bogo!!');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_title` varchar(250) NOT NULL,
  `user_post` varchar(500) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_options` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_title`, `user_post`, `post_date`, `post_options`, `id`) VALUES
(54, 'This is a public post', 'This is', '2023-12-05 10:32:37', 1, 2),
(55, 'This is a private Post', 'Private', '2023-12-05 12:18:42', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(50) DEFAULT NULL,
  `user_lname` varchar(50) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_gender` varchar(250) NOT NULL,
  `user_contactnum` varchar(11) DEFAULT NULL,
  `user_email` varchar(250) DEFAULT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_pass` varchar(200) DEFAULT NULL,
  `profile_photo` varchar(250) DEFAULT NULL,
  `user_status` int(11) NOT NULL,
  `activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_birthday`, `user_gender`, `user_contactnum`, `user_email`, `user_username`, `user_pass`, `profile_photo`, `user_status`, `activity`) VALUES
(1, 'Glorious Hopes', 'Cuyos', '2002-02-02', 'Male', '09662379503', 'cuyoshope@gmail.com', 'Hope', '$2y$10$A8ctNL/bb6BCp..fCgcFXe75a3eoBt5x057TVQ9Q.CTw8RQ8iLC9u', '6569c3804acfa-Picture4.jpg', 1, 0),
(2, 'Marjorie', 'Sagadsad', '1998-07-16', 'Female', '09436459302', 'marjoriesagadsad2019@gmail.com', 'Ebing', '$2y$10$keZhNhISEaK88jytaYO5Auw2rhwjb1bBz4YURCQOZX2COcM/okhPy', '656725b5cec3d-Picture3.jpg', 1, 0),
(4, 'Jirah', 'Cuyos', '1996-01-10', 'Female', '09876543211', 'jirahgrace@gmail.com', 'jirah', '$2y$10$ijnXgiEq19Tu0e7W7wqaae9CSsMSHQFvwHPTM0S32sWu/p6VzstwS', NULL, 0, 0),
(5, 'Jireh', 'Cuyos', '1989-12-11', 'Male', '09876543212', 'rehjicy@gmail.com', 'rehjicy', '$2y$10$cl2sFBbufqL9EjkuGNRlB.z3i7Pr9FL/0Icr.Z9BEUSwQXPutr1sy', '65689e1f4a8a2-29790393_1728412197201755_1364142211094449735_n.jpg', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin2`
--
ALTER TABLE `admin2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_feedback_users_user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_post_admin2_id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin2`
--
ALTER TABLE `admin2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_feedback_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_admin2_id` FOREIGN KEY (`id`) REFERENCES `admin2` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
