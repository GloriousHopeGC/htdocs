-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 05:55 AM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_DeleteUser` (IN `_user_id` INT(11))   BEGIN
  DELETE FROM users WHERE user_id = _user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminCount` ()   BEGIN
   SELECT COUNT(*) as post_count FROM post;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminInfo` (IN `_admin_id` INT(11))   BEGIN
   SELECT * FROM admin2 WHERE id = _admin_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetAdminPost` ()   BEGIN
  SELECT * FROM post
LEFT JOIN admin2 ON post.id = admin2.id
ORDER BY post.post_date DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetFeedbackCount` ()   BEGIN
   SELECT COUNT(*) as feedback_count FROM feedback;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetItmanager` (IN `_it_id` INT(11))   BEGIN
  SELECT * FROM itmanager WHERE id = _it_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetUserCount` ()   BEGIN
   SELECT COUNT(*) as user_count FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetUserId` (IN `_user_id` INT(11))   BEGIN
 SELECT * FROM users WHERE user_id = _user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetUserInfo` (IN `_user_id` INT(11))   BEGIN
  SELECT * FROM users WHERE user_id = _user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Login` (IN `_user_username` VARCHAR(100))   BEGIN
    SELECT user_id, user_pass, user_status
    FROM users
    WHERE user_username = _user_username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LoginAdmin` (IN `_admin_username` VARCHAR(255), IN `_admin_password` VARCHAR(255))   BEGIN
    DECLARE hashedPassword VARCHAR(100);
    SET hashedPassword = MD5(_admin_password);

    SELECT id
    INTO @user_id
    FROM admin2
    WHERE admin_username = _admin_username AND admin_password = hashedPassword;

    SELECT @user_id AS user_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_post` (IN `_post_title` VARCHAR(255), IN `_post` TEXT, IN `_post_date` DATETIME, IN `_post_options` VARCHAR(255), IN `_admin_id` INT)   BEGIN
  INSERT INTO post (user_title, user_post, post_date, post_options, id)
  VALUES (_post_title, _post, _post_date, _post_options, _admin_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SFB` (IN `_keyword` VARCHAR(255))   BEGIN
   SELECT * FROM feedback
    INNER JOIN users ON feedback.user_id = users.user_id
    WHERE user_feedback LIKE CONCAT('%', _keyword, '%') OR
          CONCAT(user_fname, ' ', user_lname) LIKE CONCAT('%', _keyword, '%') OR
          user_email LIKE CONCAT('%', _keyword, '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_UserFeedback` ()   BEGIN
  SELECT * FROM feedback
  INNER JOIN users ON feedback.user_id = users.user_id;
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
(9, 'Marcelito', 'Cuyos', '09436459302', 'marcelito66@gmail.com', 'lito', '6d61025ef56bc5a94fe657f16049f451'),
(10, 'Glorious Hope', 'Cuyos', '09662378899', 'cuyoshope@gmail.com', 'hope', '6d61025ef56bc5a94fe657f16049f451');

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
(12, 1, 'Nice One Keep It Up'),
(23, 6, 'Need Improvements In The Ui');

-- --------------------------------------------------------

--
-- Table structure for table `itmanager`
--

CREATE TABLE `itmanager` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itmanager`
--

INSERT INTO `itmanager` (`id`, `username`, `password`) VALUES
(1, 'itmanager', 'f0063a78be872d4245557026e1dab7e4');

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
(207, 'No Sunday Service', 'Walay Sunday Service', '2023-12-15 09:27:44', 2, 9),
(208, 'Appreciacion', 'Thank You For Visiting Our Website', '2023-12-15 13:28:40', 1, 9),
(209, 'Attention!!', 'There will be a meeting in the AGCOWC Youth On Sunday, December 17, 2023', '2023-12-15 13:32:32', 1, 10),
(210, 'Service', 'There will Be A service on Sunday', '2023-12-15 13:33:03', 2, 10);

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
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_birthday`, `user_gender`, `user_contactnum`, `user_email`, `user_username`, `user_pass`, `profile_photo`, `user_status`) VALUES
(1, 'Glorious Hope   ', 'Cuyos', '2002-07-25', 'Male', '09662379503', 'cuyosglorious@gmail.com', 'GHGC', '$2y$10$R5DvXP1KuRVezWNlspdnw.rjDzKflkdqIFf9Sg1oKkmeiupNMfmAW', '6570843530c94-378398423_1077007263708298_8678816927246300015_n.jpg', 1),
(3, 'Rodrigo', 'Balorio', '1995-01-12', 'Male', '09662378899', 'rodrigobalorio@gmail.com', 'rodrigo', '$2y$10$6ttM8w74r7rijecerfdmP.az7ESCXLJxpvEusNaYQngXJSrVPjH7K', '657122c97a421-405499312_680622767590621_3969610937641684934_n.jpg', 1),
(4, 'Berni', 'Empaces', '2002-01-03', 'Male', '09876543211', 'bernie@gmail.com', 'bernie', '$2y$10$rezU1xbHvTkveN8Ihjw70eZQgFn9BRZ5JeUoCWG1qVD.w9AtRLEkq', '65713c8bba428-375028999_3667997136763403_7622998742519583850_n.jpg', 1),
(6, 'Marjorie', 'Sagadsad', '1998-07-16', 'Female', '09662379482', 'marjoriesagadsad2019@gmail.com', 'Ebing', '$2y$10$alzsmqhdyvPqwmQ4wG/T1uMSfh01qmc7ckx6Nm9s9ke4OpQM7Lb/m', '657932b15d109-Picture3.jpg', 1),
(8, 'Marjorie ', 'Sagadsad II', '1998-12-07', 'Female', '09662379482', 'marjoriesagadsad2019@gmail.com', 'lbj', '$2y$10$nzQPA3Yve.UN41pv6ou5QuN2guvU9Rk1fUq7CBacRUoBDdJh07WuO', '657c02814a776-315799948_835986187648827_7286978541520403390_n.jpg', 1);

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
-- Indexes for table `itmanager`
--
ALTER TABLE `itmanager`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `itmanager`
--
ALTER TABLE `itmanager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_feedback_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_admin2_id` FOREIGN KEY (`id`) REFERENCES `admin2` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
