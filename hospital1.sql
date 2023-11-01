-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 02:59 PM
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
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `diseaseID` int(11) DEFAULT NULL,
  `atHospital` tinyint(1) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL,
  `atHospitalTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `lastName`, `diseaseID`, `atHospital`, `userID`, `atHospitalTime`) VALUES
(1, 'Liam', 'Smith', NULL, 0, 1, '2023-11-01 13:39:29'),
(2, 'Noah', 'Johnson', NULL, 0, 1, '2023-11-01 14:12:59'),
(3, 'Ethan', 'Brown', NULL, 0, 1, '2023-11-01 13:39:07'),
(4, 'Benjamin', 'Davis', NULL, 0, 1, '2023-11-01 13:24:47'),
(5, 'Alexander', 'Wilson', NULL, 0, 1, '2023-11-01 13:38:58'),
(6, 'Samuel', 'Lee', NULL, 0, 1, '2023-11-01 13:24:47'),
(7, 'William', 'Harris', NULL, 0, 1, '2023-11-01 13:24:47'),
(8, 'James', 'Clark', NULL, 0, 1, '2023-11-01 13:37:36'),
(9, 'Michael', 'Lewis', NULL, 0, 1, '2023-11-01 13:24:47'),
(10, 'David', 'Hall', NULL, 0, 1, '2023-11-01 14:13:00'),
(11, 'Daniel', 'Turner', NULL, 0, 1, '2023-11-01 13:37:53'),
(12, 'Andrew', 'Wright', NULL, 0, 1, '2023-11-01 13:39:32'),
(13, 'Christopher', 'White', NULL, 0, 1, '2023-11-01 13:24:47'),
(14, 'Joseph', 'Moore', NULL, 0, 1, '2023-11-01 13:34:31'),
(15, 'Nicholas', 'Baker', NULL, 0, 1, '2023-11-01 13:39:30'),
(16, 'John', 'Green', NULL, 0, 1, '2023-11-01 13:43:51'),
(17, 'Caleb', 'Adams', NULL, 0, 1, '2023-11-01 13:39:00'),
(18, 'Matthew', 'King', NULL, 0, 1, '2023-11-01 13:24:47'),
(19, 'Oliver', 'Scott', NULL, 0, 1, '2023-11-01 13:39:53'),
(20, 'Anthony', 'Young', NULL, 0, 1, '2023-11-01 13:37:54'),
(21, 'Mason', 'Mitchell', NULL, 0, 1, '2023-11-01 13:24:47'),
(22, 'Henry', 'Walker', NULL, 0, 1, '2023-11-01 13:39:41'),
(23, 'Jackson', 'Anderson', NULL, 0, 1, '2023-11-01 13:43:47'),
(24, 'Oliver', 'Thomas', NULL, 0, 1, '2023-11-01 13:24:47'),
(25, 'Samuel', 'Jackson', NULL, 0, 1, '2023-11-01 13:39:27'),
(26, 'William', 'Williams', NULL, 0, 1, '2023-11-01 13:24:47'),
(27, 'James', 'Hall', NULL, 0, 1, '2023-11-01 14:12:54'),
(28, 'Michael', 'Allen', NULL, 0, 1, '2023-11-01 13:24:47'),
(29, 'David', 'Martin', NULL, 0, 1, '2023-11-01 13:24:47'),
(30, 'Daniel', 'Taylor', NULL, 0, 1, '2023-11-01 13:38:55'),
(31, 'Andrew', 'Wood', NULL, 0, 1, '2023-11-01 13:24:47'),
(32, 'Christopher', 'Harris', NULL, 0, 1, '2023-11-01 13:39:03'),
(33, 'Joseph', 'Robinson', NULL, 0, 1, '2023-11-01 13:39:01'),
(34, 'Nicholas', 'Nelson', NULL, 0, 1, '2023-11-01 13:37:41'),
(35, 'John', 'Edwards', NULL, 0, 1, '2023-11-01 14:12:56'),
(36, 'Caleb', 'Turner', NULL, 0, 1, '2023-11-01 13:39:56'),
(37, 'Matthew', 'Carter', NULL, 0, 1, '2023-11-01 13:39:35'),
(38, 'Samuel', 'Parker', NULL, 0, 1, '2023-11-01 13:34:27'),
(39, 'Joseph', 'Evans', NULL, 0, 1, '2023-11-01 13:39:54'),
(40, 'Isaac', 'Collins', NULL, 0, 1, '2023-11-01 13:24:47'),
(41, 'Christopher', 'Murphy', NULL, 0, 1, '2023-11-01 13:38:59'),
(42, 'David', 'Bennett', NULL, 0, 1, '2023-11-01 13:24:47'),
(43, 'William', 'Roberts', NULL, 0, 1, '2023-11-01 13:38:49'),
(44, 'Andrew', 'Foster', NULL, 0, 1, '2023-11-01 13:39:39'),
(45, 'Nicholas', 'Gray', NULL, 0, 1, '2023-11-01 14:12:54'),
(46, 'James', 'Richardson', NULL, 0, 1, '2023-11-01 13:37:36'),
(47, 'Michael', 'Reed', NULL, 0, 1, '2023-11-01 13:39:27'),
(48, 'Jonathan', 'Murray', NULL, 0, 1, '2023-11-01 13:24:47'),
(49, 'Elijah', 'Cole', NULL, 0, 1, '2023-11-01 13:39:06'),
(50, 'Benjamin', 'Cooper', NULL, 0, 1, '2023-11-01 13:39:22'),
(51, 'Ryan', 'Ellis', NULL, 0, 2, '2023-11-01 13:24:47'),
(52, 'Luke', 'Howard', NULL, 0, 2, '2023-11-01 13:24:47'),
(53, 'Joshua', 'Ward', NULL, 0, 2, '2023-11-01 13:24:47'),
(54, 'Nathan', 'Cook', NULL, 0, 2, '2023-11-01 13:24:47'),
(55, 'Jackson', 'Cox', NULL, 0, 2, '2023-11-01 13:24:47'),
(56, 'Aiden', 'Reed', NULL, 0, 2, '2023-11-01 13:24:47'),
(57, 'Caleb', 'Hayes', NULL, 0, 2, '2023-11-01 13:24:47'),
(58, 'Matthew', 'Rose', NULL, 0, 2, '2023-11-01 13:24:47'),
(59, 'Samuel', 'Barnes', NULL, 0, 2, '2023-11-01 13:24:47'),
(60, 'Joseph', 'Kelly', NULL, 0, 2, '2023-11-01 13:24:47'),
(61, 'Daniel', 'Coleman', NULL, 0, 2, '2023-11-01 13:24:47'),
(62, 'William', 'Powell', NULL, 0, 2, '2023-11-01 13:24:47'),
(63, 'Andrew', 'Simmons', NULL, 0, 2, '2023-11-01 13:24:47'),
(64, 'Christopher', 'Long', NULL, 0, 2, '2023-11-01 13:24:47'),
(65, 'David', 'Patterson', NULL, 0, 2, '2023-11-01 13:24:47'),
(66, 'James', 'Hughes', NULL, 0, 2, '2023-11-01 13:24:47'),
(67, 'Michael', 'Sanders', NULL, 0, 2, '2023-11-01 13:24:47'),
(68, 'Jonathan', 'Murphy', NULL, 0, 2, '2023-11-01 13:24:47'),
(69, 'Ethan', 'Morris', NULL, 0, 2, '2023-11-01 13:24:47'),
(70, 'Oliver', 'Bennett', NULL, 0, 2, '2023-11-01 13:24:47'),
(71, 'Alexander', 'Sullivan', NULL, 0, 2, '2023-11-01 13:24:47'),
(72, 'Daniel', 'Morgan', NULL, 0, 2, '2023-11-01 13:24:47'),
(73, 'Liam', 'Stewart', NULL, 0, 2, '2023-11-01 13:24:47'),
(74, 'John', 'Ross', NULL, 0, 2, '2023-11-01 13:24:47'),
(75, 'William', 'Henderson', NULL, 0, 2, '2023-11-01 13:24:47'),
(76, 'David', 'Baker', NULL, 0, 2, '2023-11-01 13:24:47'),
(77, 'Michael', 'Wood', NULL, 0, 2, '2023-11-01 13:24:47'),
(78, 'Jonathan', 'Russell', NULL, 0, 2, '2023-11-01 13:24:47'),
(79, 'Ethan', 'Turner', NULL, 0, 2, '2023-11-01 13:24:47'),
(80, 'Oliver', 'Howard', NULL, 0, 2, '2023-11-01 13:24:47'),
(81, 'Samuel', 'Jenkins', NULL, 0, 2, '2023-11-01 13:24:47'),
(82, 'Joseph', 'Scott', NULL, 0, 2, '2023-11-01 13:24:47'),
(83, 'Christopher', 'Lewis', NULL, 0, 2, '2023-11-01 13:24:47'),
(84, 'David', 'Harris', NULL, 0, 2, '2023-11-01 13:24:47'),
(85, 'Jonathan', 'Reed', NULL, 0, 2, '2023-11-01 13:24:47'),
(86, 'Ethan', 'Foster', NULL, 0, 2, '2023-11-01 13:24:47'),
(87, 'Benjamin', 'King', NULL, 0, 2, '2023-11-01 13:24:47'),
(88, 'Ryan', 'White', NULL, 0, 2, '2023-11-01 13:24:47'),
(89, 'Daniel', 'Coleman', NULL, 0, 2, '2023-11-01 13:24:47'),
(90, 'Liam', 'Bailey', NULL, 0, 2, '2023-11-01 13:24:47'),
(91, 'John', 'Allen', NULL, 0, 2, '2023-11-01 13:24:47'),
(92, 'William', 'Patterson', NULL, 0, 2, '2023-11-01 13:24:47'),
(93, 'Andrew', 'Taylor', NULL, 0, 2, '2023-11-01 13:24:47'),
(94, 'Nicholas', 'Wright', NULL, 0, 2, '2023-11-01 13:24:47'),
(95, 'James', 'Davis', NULL, 0, 2, '2023-11-01 13:24:47'),
(96, 'Michael', 'Lee', NULL, 0, 2, '2023-11-01 13:24:47'),
(97, 'Jonathan', 'Carter', NULL, 0, 2, '2023-11-01 13:24:47'),
(98, 'Matthew', 'Martin', NULL, 0, 2, '2023-11-01 13:24:47'),
(99, 'William', 'Ward', NULL, 0, 2, '2023-11-01 13:24:47'),
(100, 'Caleb', 'Cox', NULL, 0, 2, '2023-11-01 13:24:47'),
(101, 'Emma', 'Smith', NULL, 0, 1, '2023-11-01 13:24:47'),
(102, 'Olivia', 'Johnson', NULL, 0, 1, '2023-11-01 13:24:47'),
(103, 'Sophia', 'Brown', NULL, 0, 1, '2023-11-01 13:34:26'),
(104, 'Isabella', 'Davis', NULL, 0, 1, '2023-11-01 13:37:49'),
(105, 'Ava', 'Wilson', NULL, 0, 1, '2023-11-01 14:12:55'),
(106, 'Mia', 'Lee', NULL, 0, 1, '2023-11-01 13:39:37'),
(107, 'Charlotte', 'Harris', NULL, 0, 1, '2023-11-01 13:43:49'),
(108, 'Amelia', 'Clark', NULL, 0, 1, '2023-11-01 13:24:47'),
(109, 'Harper', 'Lewis', NULL, 0, 1, '2023-11-01 13:24:47'),
(110, 'Evelyn', 'Hall', NULL, 0, 1, '2023-11-01 13:24:47'),
(111, 'Abigail', 'Turner', NULL, 0, 1, '2023-11-01 13:24:47'),
(112, 'Emily', 'Wright', NULL, 0, 1, '2023-11-01 13:37:57'),
(113, 'Elizabeth', 'White', NULL, 0, 1, '2023-11-01 13:24:47'),
(114, 'Sofia', 'Moore', NULL, 0, 1, '2023-11-01 13:43:58'),
(115, 'Madison', 'Baker', NULL, 0, 1, '2023-11-01 13:38:57'),
(116, 'Avery', 'Green', NULL, 0, 1, '2023-11-01 13:39:25'),
(117, 'Ella', 'Adams', NULL, 0, 1, '2023-11-01 13:39:30'),
(118, 'Scarlett', 'King', NULL, 0, 1, '2023-11-01 13:37:32'),
(119, 'Grace', 'Scott', NULL, 0, 1, '2023-11-01 13:39:28'),
(120, 'Lily', 'Young', NULL, 0, 1, '2023-11-01 13:39:52'),
(121, 'Chloe', 'Mitchell', NULL, 0, 1, '2023-11-01 13:24:47'),
(122, 'Camila', 'Walker', NULL, 0, 1, '2023-11-01 13:38:59'),
(123, 'Penelope', 'Anderson', NULL, 0, 1, '2023-11-01 13:39:34'),
(124, 'Victoria', 'Thomas', NULL, 0, 1, '2023-11-01 13:44:00'),
(125, 'Aria', 'Jackson', NULL, 0, 1, '2023-11-01 14:12:58'),
(126, 'Riley', 'Williams', NULL, 0, 1, '2023-11-01 13:37:37'),
(127, 'Layla', 'Hall', NULL, 0, 1, '2023-11-01 14:12:58'),
(128, 'Zoey', 'Allen', NULL, 0, 1, '2023-11-01 13:38:52'),
(129, 'Mila', 'Martin', NULL, 0, 1, '2023-11-01 13:24:47'),
(130, 'Addison', 'Taylor', NULL, 0, 1, '2023-11-01 13:24:47'),
(131, 'Aubrey', 'Wood', NULL, 0, 1, '2023-11-01 13:39:52'),
(132, 'Aurora', 'Harris', NULL, 0, 1, '2023-11-01 14:13:00'),
(133, 'Hannah', 'Robinson', NULL, 0, 1, '2023-11-01 13:24:47'),
(134, 'Aaliyah', 'Nelson', NULL, 0, 1, '2023-11-01 14:13:08'),
(135, 'Savannah', 'Edwards', NULL, 0, 1, '2023-11-01 13:24:47'),
(136, 'Anna', 'Turner', NULL, 0, 1, '2023-11-01 13:24:47'),
(137, 'Natalie', 'Carter', NULL, 0, 1, '2023-11-01 13:39:33'),
(138, 'Daisy', 'Parker', NULL, 0, 1, '2023-11-01 13:39:24'),
(139, 'Valentina', 'Evans', NULL, 0, 1, '2023-11-01 13:24:47'),
(140, 'Kayla', 'Collins', NULL, 0, 1, '2023-11-01 13:37:50'),
(141, 'Lillian', 'Murphy', NULL, 0, 1, '2023-11-01 14:13:06'),
(142, 'Eliana', 'Bennett', NULL, 0, 1, '2023-11-01 13:24:47'),
(143, 'Olivia', 'Roberts', NULL, 0, 1, '2023-11-01 13:39:02'),
(144, 'Natalie', 'Foster', NULL, 0, 1, '2023-11-01 13:24:47'),
(145, 'Audrey', 'Gray', NULL, 0, 1, '2023-11-01 13:24:47'),
(146, 'Lily', 'Richardson', NULL, 0, 1, '2023-11-01 13:37:42'),
(147, 'Zoe', 'Reed', NULL, 0, 1, '2023-11-01 13:24:47'),
(148, 'Lucy', 'Murray', NULL, 0, 1, '2023-11-01 14:12:53'),
(149, 'Emily', 'Cole', NULL, 0, 1, '2023-11-01 13:37:39'),
(150, 'Ava', 'Cooper', NULL, 0, 1, '2023-11-01 13:24:47'),
(151, 'Emma', 'Ellis', NULL, 0, 2, '2023-11-01 13:24:47'),
(152, 'Nora', 'Howard', NULL, 0, 2, '2023-11-01 13:24:47'),
(153, 'Luna', 'Ward', NULL, 0, 2, '2023-11-01 13:24:47'),
(154, 'Mila', 'Cook', NULL, 0, 2, '2023-11-01 13:24:47'),
(155, 'Sofia', 'Cox', NULL, 0, 2, '2023-11-01 13:24:47'),
(156, 'Layla', 'Reed', NULL, 0, 2, '2023-11-01 13:24:47'),
(157, 'Ella', 'Hayes', NULL, 0, 2, '2023-11-01 13:24:47'),
(158, 'Scarlett', 'Rose', NULL, 0, 2, '2023-11-01 13:24:47'),
(159, 'Grace', 'Barnes', NULL, 0, 2, '2023-11-01 13:24:47'),
(160, 'Avery', 'Kelly', NULL, 0, 2, '2023-11-01 13:24:47'),
(161, 'Hazel', 'Coleman', NULL, 0, 2, '2023-11-01 13:24:47'),
(162, 'Camila', 'Powell', NULL, 0, 2, '2023-11-01 13:24:47'),
(163, 'Penelope', 'Simmons', NULL, 0, 2, '2023-11-01 13:24:47'),
(164, 'Victoria', 'Long', NULL, 0, 2, '2023-11-01 13:24:47'),
(165, 'Aria', 'Patterson', NULL, 0, 2, '2023-11-01 13:24:47'),
(166, 'Riley', 'Hughes', NULL, 0, 2, '2023-11-01 13:24:47'),
(167, 'Lily', 'Sanders', NULL, 0, 2, '2023-11-01 13:24:47'),
(168, 'Chloe', 'Murphy', NULL, 0, 2, '2023-11-01 13:24:47'),
(169, 'Natalie', 'Morris', NULL, 0, 2, '2023-11-01 13:24:47'),
(170, 'Zoey', 'Bennett', NULL, 0, 2, '2023-11-01 13:24:47'),
(171, 'Mila', 'Sullivan', NULL, 0, 2, '2023-11-01 13:24:47'),
(172, 'Addison', 'Morgan', NULL, 0, 2, '2023-11-01 13:24:47'),
(173, 'Aubrey', 'Stewart', NULL, 0, 2, '2023-11-01 13:24:47'),
(174, 'Aurora', 'Ross', NULL, 0, 2, '2023-11-01 13:24:47'),
(175, 'Hannah', 'Henderson', NULL, 0, 2, '2023-11-01 13:24:47'),
(176, 'Aaliyah', 'Baker', NULL, 0, 2, '2023-11-01 13:24:47'),
(177, 'Savannah', 'Wood', NULL, 0, 2, '2023-11-01 13:24:47'),
(178, 'Anna', 'Russell', NULL, 0, 2, '2023-11-01 13:24:47'),
(179, 'Nora', 'Turner', NULL, 0, 2, '2023-11-01 13:24:47'),
(180, 'Audrey', 'Howard', NULL, 0, 2, '2023-11-01 13:24:47'),
(181, 'Luna', 'Jenkins', NULL, 0, 2, '2023-11-01 13:24:47'),
(182, 'Nora', 'Scott', NULL, 0, 2, '2023-11-01 13:24:47'),
(183, 'Luna', 'Lewis', NULL, 0, 2, '2023-11-01 13:24:47'),
(184, 'Sofia', 'Harris', NULL, 0, 2, '2023-11-01 13:24:47'),
(185, 'Savannah', 'Reed', NULL, 0, 2, '2023-11-01 13:24:47'),
(186, 'Anna', 'Foster', NULL, 0, 2, '2023-11-01 13:24:47'),
(187, 'Aria', 'King', NULL, 0, 2, '2023-11-01 13:24:47'),
(188, 'Hazel', 'White', NULL, 0, 2, '2023-11-01 13:24:47'),
(189, 'Camila', 'Coleman', NULL, 0, 2, '2023-11-01 13:24:47'),
(190, 'Penelope', 'Bailey', NULL, 0, 2, '2023-11-01 13:24:47'),
(191, 'Victoria', 'Allen', NULL, 0, 2, '2023-11-01 13:24:47'),
(192, 'Ava', 'Patterson', NULL, 0, 2, '2023-11-01 13:24:47'),
(193, 'Avery', 'Taylor', NULL, 0, 2, '2023-11-01 13:24:47'),
(194, 'Ella', 'Wright', NULL, 0, 2, '2023-11-01 13:24:47'),
(195, 'Emma', 'Davis', NULL, 0, 2, '2023-11-01 13:24:47'),
(196, 'Natalie', 'Lee', NULL, 0, 2, '2023-11-01 13:24:47'),
(197, 'Olivia', 'Carter', NULL, 0, 2, '2023-11-01 13:24:47'),
(198, 'Lily', 'Martin', NULL, 0, 2, '2023-11-01 13:24:47'),
(199, 'Zoe', 'Ward', NULL, 0, 2, '2023-11-01 13:24:47'),
(200, 'Lucy', 'Cox', NULL, 0, 2, '2023-11-01 13:24:47');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `roomTypeID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `availability`, `roomTypeID`, `userID`) VALUES
(6, 3, 1, 1),
(7, 1, 2, 1),
(8, 3, 1, 1),
(9, 3, 1, 1),
(16, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `roomTypeID` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `num_janitors` int(11) DEFAULT NULL,
  `num_doctors` int(11) DEFAULT NULL,
  `num_nurses` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`roomTypeID`, `price`, `description`, `num_janitors`, `num_doctors`, `num_nurses`, `capacity`) VALUES
(1, 400, 'General Ward', 1, 1, 1, 3),
(2, 500, 'Operating Room', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `staffTypeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `last_name`, `first_name`, `staffTypeID`, `userID`, `level`) VALUES
(41, 'Snow', 'Anna', 1, 1, 0),
(42, 'Doe', 'John', 2, 1, 0),
(43, 'Mihu', 'Traian', 3, 1, 0),
(44, 'Luigi', 'Anna', 4, 1, 0),
(45, 'Luigi', 'Mario', 5, 1, 0),
(46, 'Doe', 'Traian', 1, 1, 0),
(47, 'Luigi', 'John', 2, 1, 0),
(48, 'Doe', 'Anna', 1, 1, 0),
(49, 'Mihu', 'John', 2, 1, 0),
(50, 'Chris', 'Chris', 1, 1, 0),
(51, 'Andrei', 'Andrei', 2, 1, 0),
(52, 'Mihu', 'Anna', 1, 1, 0),
(54, 'Baba', 'Zaza', 2, 1, 0),
(55, 'Draghici', 'Alex', 1, 1, 0),
(56, 'Olaru', 'Chris', 2, 1, 0),
(57, 'Doe', 'John', 4, 1, 0),
(58, 'Mia', 'Mama', 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `staffTypeID` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`staffTypeID`, `description`, `salary`) VALUES
(1, 'General Practitioner', 300),
(2, 'General Nurse Practitioner', 200),
(3, 'Janitor', 100),
(4, 'Surgeon', 350),
(5, 'Operating Room Nurse', 250);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hospitalName` varchar(30) NOT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`, `hospitalName`, `budget`) VALUES
(1, 'andrei', 'andrei', 'Andrei', 2350),
(2, 'chris', 'chris', 'chris', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomID`),
  ADD KEY `roomTypeID` (`roomTypeID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`roomTypeID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `staffTypeID` (`staffTypeID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`staffTypeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `roomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `staffTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`roomTypeID`) REFERENCES `room_type` (`roomTypeID`),
  ADD CONSTRAINT `room_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`staffTypeID`) REFERENCES `staff_type` (`staffTypeID`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
