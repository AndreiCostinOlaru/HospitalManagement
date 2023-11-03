-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 02:28 AM
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
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `diseaseID` int(11) NOT NULL,
  `roomTypeID` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`diseaseID`, `roomTypeID`, `name`) VALUES
(1, 1, 'Unknown'),
(2, NULL, 'Cured'),
(3, 2, 'Appendicitis'),
(4, 2, 'Benign Tumor'),
(5, 3, 'Suspecting Tumor'),
(6, 3, 'Suspecting Bone Fracture'),
(7, 4, 'Tuberculosis'),
(8, 4, 'COVID-19'),
(9, 5, 'Depression'),
(10, 5, 'Anxiety Disorders'),
(11, 6, 'Musculoskeletal Injury'),
(12, 6, 'Post-Surgery Weakness'),
(13, 7, 'Epilepsy'),
(14, 7, 'Migraines'),
(15, 8, 'Trauma'),
(16, 8, 'Sepsis'),
(17, 9, 'Suspecting Crohn\'s Disease'),
(18, 9, 'Suspecting Gastrointestinal Condition'),
(19, 10, 'Suspecting Kidney Infection'),
(20, 10, 'Suspecting Kidney Stones'),
(21, 2, 'Crohn\'s Disease'),
(22, 11, 'Gastroesophageal Reflux'),
(23, 11, 'Kidney Infection'),
(24, 2, 'Kidney Stones');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `firstName`, `lastName`) VALUES
(1, 'Liam', 'Smith'),
(2, 'Noah', 'Johnson'),
(3, 'Ethan', 'Brown'),
(4, 'Benjamin', 'Davis'),
(5, 'Alexander', 'Wilson'),
(6, 'Samuel', 'Lee'),
(7, 'William', 'Harris'),
(8, 'James', 'Clark'),
(9, 'Michael', 'Lewis'),
(10, 'David', 'Hall'),
(11, 'Daniel', 'Turner'),
(12, 'Andrew', 'Wright'),
(13, 'Christopher', 'White'),
(14, 'Joseph', 'Moore'),
(15, 'Nicholas', 'Baker'),
(16, 'John', 'Green'),
(17, 'Caleb', 'Adams'),
(18, 'Matthew', 'King'),
(19, 'Oliver', 'Scott'),
(20, 'Anthony', 'Young'),
(21, 'Mason', 'Mitchell'),
(22, 'Henry', 'Walker'),
(23, 'Jackson', 'Anderson'),
(24, 'Oliver', 'Thomas'),
(25, 'Samuel', 'Jackson'),
(26, 'William', 'Williams'),
(27, 'James', 'Hall'),
(28, 'Michael', 'Allen'),
(29, 'David', 'Martin'),
(30, 'Daniel', 'Taylor'),
(31, 'Andrew', 'Wood'),
(32, 'Christopher', 'Harris'),
(33, 'Joseph', 'Robinson'),
(34, 'Nicholas', 'Nelson'),
(35, 'John', 'Edwards'),
(36, 'Caleb', 'Turner'),
(37, 'Matthew', 'Carter'),
(38, 'Samuel', 'Parker'),
(39, 'Joseph', 'Evans'),
(40, 'Isaac', 'Collins'),
(41, 'Christopher', 'Murphy'),
(42, 'David', 'Bennett'),
(43, 'William', 'Roberts'),
(44, 'Andrew', 'Foster'),
(45, 'Nicholas', 'Gray'),
(46, 'James', 'Richardson'),
(47, 'Michael', 'Reed'),
(48, 'Jonathan', 'Murray'),
(49, 'Elijah', 'Cole'),
(50, 'Benjamin', 'Cooper'),
(51, 'Ryan', 'Ellis'),
(52, 'Luke', 'Howard'),
(53, 'Joshua', 'Ward'),
(54, 'Nathan', 'Cook'),
(55, 'Jackson', 'Cox'),
(56, 'Aiden', 'Reed'),
(57, 'Caleb', 'Hayes'),
(58, 'Matthew', 'Rose'),
(59, 'Samuel', 'Barnes'),
(60, 'Joseph', 'Kelly'),
(61, 'Daniel', 'Coleman'),
(62, 'William', 'Powell'),
(63, 'Andrew', 'Simmons'),
(64, 'Christopher', 'Long'),
(65, 'David', 'Patterson'),
(66, 'James', 'Hughes'),
(67, 'Michael', 'Sanders'),
(68, 'Jonathan', 'Murphy'),
(69, 'Ethan', 'Morris'),
(70, 'Oliver', 'Bennett'),
(71, 'Alexander', 'Sullivan'),
(72, 'Daniel', 'Morgan'),
(73, 'Liam', 'Stewart'),
(74, 'John', 'Ross'),
(75, 'William', 'Henderson'),
(76, 'David', 'Baker'),
(77, 'Michael', 'Wood'),
(78, 'Jonathan', 'Russell'),
(79, 'Ethan', 'Turner'),
(80, 'Oliver', 'Howard'),
(81, 'Samuel', 'Jenkins'),
(82, 'Joseph', 'Scott'),
(83, 'Christopher', 'Lewis'),
(84, 'David', 'Harris'),
(85, 'Jonathan', 'Reed'),
(86, 'Ethan', 'Foster'),
(87, 'Benjamin', 'King'),
(88, 'Ryan', 'White'),
(89, 'Daniel', 'Coleman'),
(90, 'Liam', 'Bailey'),
(91, 'John', 'Allen'),
(92, 'William', 'Patterson'),
(93, 'Andrew', 'Taylor'),
(94, 'Nicholas', 'Wright'),
(95, 'James', 'Davis'),
(96, 'Michael', 'Lee'),
(97, 'Jonathan', 'Carter'),
(98, 'Matthew', 'Martin'),
(99, 'William', 'Ward'),
(100, 'Caleb', 'Cox'),
(101, 'Emma', 'Smith'),
(102, 'Olivia', 'Johnson'),
(103, 'Sophia', 'Brown'),
(104, 'Isabella', 'Davis'),
(105, 'Ava', 'Wilson'),
(106, 'Mia', 'Lee'),
(107, 'Charlotte', 'Harris'),
(108, 'Amelia', 'Clark'),
(109, 'Harper', 'Lewis'),
(110, 'Evelyn', 'Hall'),
(111, 'Abigail', 'Turner'),
(112, 'Emily', 'Wright'),
(113, 'Elizabeth', 'White'),
(114, 'Sofia', 'Moore'),
(115, 'Madison', 'Baker'),
(116, 'Avery', 'Green'),
(117, 'Ella', 'Adams'),
(118, 'Scarlett', 'King'),
(119, 'Grace', 'Scott'),
(120, 'Lily', 'Young'),
(121, 'Chloe', 'Mitchell'),
(122, 'Camila', 'Walker'),
(123, 'Penelope', 'Anderson'),
(124, 'Victoria', 'Thomas'),
(125, 'Aria', 'Jackson'),
(126, 'Riley', 'Williams'),
(127, 'Layla', 'Hall'),
(128, 'Zoey', 'Allen'),
(129, 'Mila', 'Martin'),
(130, 'Addison', 'Taylor'),
(131, 'Aubrey', 'Wood'),
(132, 'Aurora', 'Harris'),
(133, 'Hannah', 'Robinson'),
(134, 'Aaliyah', 'Nelson'),
(135, 'Savannah', 'Edwards'),
(136, 'Anna', 'Turner'),
(137, 'Natalie', 'Carter'),
(138, 'Daisy', 'Parker'),
(139, 'Valentina', 'Evans'),
(140, 'Kayla', 'Collins'),
(141, 'Lillian', 'Murphy'),
(142, 'Eliana', 'Bennett'),
(143, 'Olivia', 'Roberts'),
(144, 'Natalie', 'Foster'),
(145, 'Audrey', 'Gray'),
(146, 'Lily', 'Richardson'),
(147, 'Zoe', 'Reed'),
(148, 'Lucy', 'Murray'),
(149, 'Emily', 'Cole'),
(150, 'Ava', 'Cooper'),
(151, 'Emma', 'Ellis'),
(152, 'Nora', 'Howard'),
(153, 'Luna', 'Ward'),
(154, 'Mila', 'Cook'),
(155, 'Sofia', 'Cox'),
(156, 'Layla', 'Reed'),
(157, 'Ella', 'Hayes'),
(158, 'Scarlett', 'Rose'),
(159, 'Grace', 'Barnes'),
(160, 'Avery', 'Kelly'),
(161, 'Hazel', 'Coleman'),
(162, 'Camila', 'Powell'),
(163, 'Penelope', 'Simmons'),
(164, 'Victoria', 'Long'),
(165, 'Aria', 'Patterson'),
(166, 'Riley', 'Hughes'),
(167, 'Lily', 'Sanders'),
(168, 'Chloe', 'Murphy'),
(169, 'Natalie', 'Morris'),
(170, 'Zoey', 'Bennett'),
(171, 'Mila', 'Sullivan'),
(172, 'Addison', 'Morgan'),
(173, 'Aubrey', 'Stewart'),
(174, 'Aurora', 'Ross'),
(175, 'Hannah', 'Henderson'),
(176, 'Aaliyah', 'Baker'),
(177, 'Savannah', 'Wood'),
(178, 'Anna', 'Russell'),
(179, 'Nora', 'Turner'),
(180, 'Audrey', 'Howard'),
(181, 'Luna', 'Jenkins'),
(182, 'Nora', 'Scott'),
(183, 'Luna', 'Lewis'),
(184, 'Sofia', 'Harris'),
(185, 'Savannah', 'Reed'),
(186, 'Anna', 'Foster'),
(187, 'Aria', 'King'),
(188, 'Hazel', 'White'),
(189, 'Camila', 'Coleman'),
(190, 'Penelope', 'Bailey'),
(191, 'Victoria', 'Allen'),
(192, 'Ava', 'Patterson'),
(193, 'Avery', 'Taylor'),
(194, 'Ella', 'Wright'),
(195, 'Emma', 'Davis'),
(196, 'Natalie', 'Lee'),
(197, 'Olivia', 'Carter'),
(198, 'Lily', 'Martin'),
(199, 'Zoe', 'Ward'),
(200, 'Lucy', 'Cox');

-- --------------------------------------------------------

--
-- Table structure for table `patient_management`
--

CREATE TABLE `patient_management` (
  `patientID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `atHospitalTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `diseaseID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomID` int(11) NOT NULL,
  `availability` tinyint(1) DEFAULT NULL,
  `roomTypeID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `inUse` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomID`, `availability`, `roomTypeID`, `userID`, `inUse`) VALUES
(6, 3, 1, 1, 1),
(7, 1, 2, 1, 0),
(8, 3, 1, 1, 1),
(9, 3, 1, 1, 1),
(16, 3, 1, 1, 0);

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
  `num_nurses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`roomTypeID`, `price`, `description`, `num_janitors`, `num_doctors`, `num_nurses`) VALUES
(1, 400, 'Consulting Room', 1, 1, 1),
(2, 650, 'Operating Room', 1, 1, 1),
(3, 800, 'Radiology Room', 1, 1, 2),
(4, 950, 'Isolation Room', 1, 2, 2),
(5, 400, 'Psychiatric Room', 2, 1, 3),
(6, 650, 'Physiotherapy Room', 1, 3, 1),
(7, 550, 'Neurology Room', 1, 1, 2),
(8, 650, 'ICU Room', 2, 3, 4),
(9, 700, 'Endoscopy Room', 1, 1, 2),
(10, 700, 'Ultrasound Room', 1, 1, 2),
(11, 400, 'Pharmacy Room', 1, 0, 1);

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
(1, 'General Practitioner', 250),
(2, 'General Nurse Practitioner', 150),
(3, 'Janitor', 100),
(4, 'Surgeon', 350),
(5, 'Operating Room Nurse', 225),
(6, 'Radiologist', 300),
(7, 'Radiology Nurse', 200),
(8, 'Infectious Disease Specialist', 300),
(9, 'Infection Control Nurse', 200),
(10, 'Psychiatrist', 300),
(11, 'Psychiatric Nurse', 225),
(12, 'Physiotherapist', 250),
(13, 'Neurologist', 325),
(14, 'Neurology Nurse', 225),
(15, 'Intensivist', 350),
(16, 'Intensive Care Nurse', 250),
(17, 'Endoscopist', 300),
(18, 'Endoscopy Nurse', 200),
(19, 'Ultrasound Technician', 225);

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
(1, 'andrei', 'andrei', 'Andrei', 3100),
(2, 'chris', 'chris', 'chris', 1000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`diseaseID`),
  ADD KEY `roomTypeID` (`roomTypeID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`);

--
-- Indexes for table `patient_management`
--
ALTER TABLE `patient_management`
  ADD KEY `patientID` (`patientID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `diseaseID` (`diseaseID`);

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
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `diseaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `roomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `staffTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disease`
--
ALTER TABLE `disease`
  ADD CONSTRAINT `disease_ibfk_1` FOREIGN KEY (`roomTypeID`) REFERENCES `room_type` (`roomTypeID`);

--
-- Constraints for table `patient_management`
--
ALTER TABLE `patient_management`
  ADD CONSTRAINT `patient_management_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`),
  ADD CONSTRAINT `patient_management_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `patient_management_ibfk_3` FOREIGN KEY (`diseaseID`) REFERENCES `disease` (`diseaseID`);

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
