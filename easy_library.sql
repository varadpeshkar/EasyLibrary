-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 10:55 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easy_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `session_id` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'stores session cookie id to prevent session concurrency',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(254) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s deletion status',
  `user_account_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s account type (basic, premium, etc)',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_suspension_timestamp` bigint(20) DEFAULT NULL COMMENT 'Timestamp till the end of a user suspension',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `session_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_deleted`, `user_account_type`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_suspension_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`) VALUES
(12, 'ikkgjl0v2jfvkc7t6h38odl7a7', 'chinmay', '$2y$10$h.t9OcewTr.dT7yJ0BgJQer0oDfnrJ7WAARDr7FcLFMnFH6O3aEf.', 'chinmay@asd.com', 1, 0, 7, 0, NULL, 1487021135, NULL, 1487026703, 0, NULL, '62d1d806c98c689761b45c13f33d3df0599604e1', NULL, NULL, 'DEFAULT'),
(13, 'g7jahm75855uc8jrbv9fbc76o2', 'rohan', '$2y$10$ydOYH.ZuxK9v6EAR98Tsg..kVyOFwdRHgHD9qdSuaue9ayvmhgxD.', 'rohan@aveshan.com', 1, 0, 1, 0, NULL, 1487158128, NULL, 1487586716, 0, NULL, 'd7743d3158ad230c027d8f8f7f2564b6b70bd626', NULL, NULL, 'DEFAULT');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` text NOT NULL,
  `name` text NOT NULL,
  `author` text NOT NULL,
  `publisher` text NOT NULL,
  `department` text NOT NULL,
  `tags` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `name`, `author`, `publisher`, `department`, `tags`, `timestamp`) VALUES
(32, '1131165175', 'Discrete Structures', 'J.P.Mathew', 'Arihant', 'Computer Eng.', 'some, tag', '2017-02-18 20:05:31'),
(33, '1133365565', 'Refrigeration and Air Conditioning', 'Akanksha Bhaskar', 'Tata McgraHills', 'Mech. Eng.', 'some, tag', '2017-02-18 20:05:31'),
(34, '1133995175', 'Basics of Automobile Engineering', 'Arunima Sinha', 'Tata McgraHills', 'Mech. Eng.', 'some, tag', '2017-02-18 20:05:32'),
(35, '1135875175', 'Wireless Sensor Networks', 'John Mathai', 'Nirali', 'Entc Eng.', 'some, tag', '2017-02-18 20:05:32'),
(36, '1422580423', 'Sensors in Intrumentation', 'Debashish Sen', 'Nirali', 'Entc Eng.', 'some, tag', '2017-02-18 20:05:32'),
(37, '1422470432', 'Basics of Electronics', 'Robert Dahl', 'Tata McgraHills', 'Entc Eng.', 'some, tag', '2017-02-18 20:05:32'),
(38, '1422470431', 'Design of Steel Structures', 'Unmesh Banerjee', 'Tata McgraHills', 'Civil Eng.', 'some, tag', '2017-02-18 20:05:32'),
(39, '1454838094', 'Basic Surveying', 'Girish Dandavate', 'Tata McgraHills', 'Civil Eng.', 'some, tag', '2017-02-18 20:05:32'),
(40, '1133365175', 'Data Structures', 'Julie Moncada', 'Arihant', 'Computer Eng.', 'some, tag', '2017-02-18 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `section` text NOT NULL,
  `shelf` text NOT NULL,
  `row` int(11) NOT NULL,
  `column1` int(11) NOT NULL,
  `current_count` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `book_id`, `section`, `shelf`, `row`, `column1`, `current_count`, `timestamp`) VALUES
(22, 32, 'Comp', 'A', 1, 3, 5, '2017-02-18 20:05:31'),
(23, 33, 'Air_cond', 'B', 2, 1, 5, '2017-02-18 20:05:32'),
(24, 34, 'Automob', 'A', 1, 2, 7, '2017-02-18 20:05:32'),
(25, 35, 'Sens', 'C', 2, 3, 5, '2017-02-18 20:05:32'),
(26, 36, 'Sens', 'D', 3, 2, 5, '2017-02-18 20:05:32'),
(27, 37, 'Elect', 'B', 1, 2, 3, '2017-02-18 20:05:32'),
(28, 38, 'Struct', 'B', 2, 2, 4, '2017-02-18 20:05:32'),
(29, 39, 'Survey', 'A', 2, 1, 6, '2017-02-18 20:05:32'),
(30, 40, 'Comp', 'C', 2, 2, 7, '2017-02-18 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `current_year` text NOT NULL,
  `branch` text NOT NULL,
  `mobile_number` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `auth_token` text,
  `status` int(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `current_year`, `branch`, `mobile_number`, `email`, `password`, `auth_token`, `status`, `timestamp`) VALUES
(1, 'Test', 'T.E', 'Mechanical Engineering', '6546666666', 'test@test.com', 'asdasd', NULL, 0, '2017-02-20 12:18:33'),
(2, 'Test 2', 'B.E', 'Electrical Engineering', '4556646546', 'test@test.com', 'aasdasd', NULL, 1, '2017-02-20 12:28:18'),
(3, 'Rohan', 'S.E', 'IT Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25'),
(4, 'Varad', 'T.E', 'Comp Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25'),
(5, 'Chinmay', 'S.E', 'IT Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25'),
(6, 'Nikita', 'B.E', 'IT Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25'),
(7, 'Rohan', 'S.E', 'IT Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25'),
(8, 'Rohan', 'S.E', 'IT Engineering', '9730333946', 'rohan@aveshan.com', 'test123', NULL, 1, '2017-02-20 12:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `students_books`
--

CREATE TABLE `students_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_books`
--
ALTER TABLE `students_books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `students_books`
--
ALTER TABLE `students_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
