-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2025 at 08:11 AM
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
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(25) NOT NULL,
  `Password` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, 'LKG'),
(2, 'UKG'),
(3, '1st'),
(4, '2nd'),
(5, '3rd'),
(6, '4th'),
(7, '5th'),
(8, '6th'),
(9, '7th'),
(10, '8th'),
(11, '9th'),
(12, '10th');

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_id`, `subject_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 2, 4),
(9, 3, 1),
(10, 3, 2),
(11, 3, 3),
(12, 3, 4),
(13, 3, 5),
(14, 3, 6),
(15, 4, 1),
(16, 4, 2),
(17, 4, 3),
(18, 4, 4),
(19, 4, 5),
(20, 4, 6),
(21, 5, 1),
(22, 5, 2),
(23, 5, 3),
(24, 5, 4),
(25, 5, 5),
(26, 5, 6),
(27, 6, 1),
(28, 6, 2),
(29, 6, 3),
(30, 6, 4),
(31, 6, 5),
(32, 6, 6),
(33, 7, 1),
(34, 7, 2),
(35, 7, 3),
(36, 7, 4),
(37, 7, 5),
(38, 7, 6),
(39, 8, 1),
(40, 8, 2),
(41, 8, 3),
(42, 8, 4),
(43, 8, 5),
(44, 8, 6),
(45, 8, 7),
(46, 8, 8),
(47, 8, 9),
(48, 8, 10),
(49, 9, 1),
(50, 9, 2),
(51, 9, 3),
(52, 9, 4),
(53, 9, 5),
(54, 9, 6),
(55, 9, 7),
(56, 9, 8),
(57, 9, 9),
(58, 9, 10),
(59, 10, 1),
(60, 10, 2),
(61, 10, 3),
(62, 10, 4),
(63, 10, 5),
(64, 10, 6),
(65, 10, 7),
(66, 10, 8),
(67, 10, 9),
(68, 10, 10),
(69, 11, 1),
(70, 11, 2),
(71, 11, 3),
(72, 11, 4),
(73, 11, 5),
(74, 11, 6),
(75, 11, 7),
(76, 11, 8),
(77, 11, 9),
(78, 11, 10),
(79, 12, 1),
(80, 12, 2),
(81, 12, 3),
(82, 12, 4),
(83, 12, 5),
(84, 12, 6),
(85, 12, 7),
(86, 12, 8),
(87, 12, 9),
(88, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `fee_sett`
--

CREATE TABLE `fee_sett` (
  `id` int(11) NOT NULL,
  `class_id` int(8) NOT NULL,
  `Form_fee` int(8) NOT NULL,
  `AD_fee` int(8) NOT NULL,
  `Mis_fee` int(8) NOT NULL,
  `CM_fee` int(8) NOT NULL,
  `Tu_fee` int(8) NOT NULL,
  `Exam_fee` int(8) NOT NULL,
  `st_session` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fee_sett`
--

INSERT INTO `fee_sett` (`id`, `class_id`, `Form_fee`, `AD_fee`, `Mis_fee`, `CM_fee`, `Tu_fee`, `Exam_fee`, `st_session`) VALUES
(1, 1, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(2, 2, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(3, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(4, 4, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(5, 5, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(6, 6, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(7, 7, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(8, 8, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(9, 9, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(10, 10, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(11, 11, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(12, 12, 1000, 20000, 1000, 3000, 3200, 3000, '2023-2024'),
(13, 1, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(14, 2, 1000, 20000, 1000, 855, 3200, 3000, '2024-2025'),
(15, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(16, 4, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(17, 5, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(18, 6, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(19, 7, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(20, 8, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(21, 9, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(22, 10, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(23, 11, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(24, 12, 1000, 20000, 1000, 3000, 3200, 3000, '2024-2025'),
(25, 1, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(26, 2, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(27, 3, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(28, 4, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(29, 5, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(30, 6, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(31, 7, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(32, 8, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(33, 9, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(34, 10, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(35, 11, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026'),
(36, 12, 1000, 20000, 1000, 3000, 3200, 3000, '2025-2026');

-- --------------------------------------------------------

--
-- Table structure for table `setting_tb_std`
--

CREATE TABLE `setting_tb_std` (
  `s_reg_no` int(5) NOT NULL,
  `st_1` varchar(50) NOT NULL,
  `st_2` varchar(50) NOT NULL,
  `st_3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_tb_std`
--

INSERT INTO `setting_tb_std` (`s_reg_no`, `st_1`, `st_2`, `st_3`) VALUES
(20254, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(25) NOT NULL,
  `First_Name` varchar(25) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `Father_Name` varchar(25) NOT NULL,
  `Mother_Name` varchar(25) NOT NULL,
  `class_nm1` varchar(25) NOT NULL,
  `Section` varchar(10) NOT NULL,
  `Birth_day` int(2) NOT NULL,
  `Birth_month` varchar(12) NOT NULL,
  `Birth_year` int(4) NOT NULL,
  `Email_Id` varchar(50) NOT NULL,
  `Mobile_Number` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` varchar(25) NOT NULL,
  `City` varchar(10) NOT NULL,
  `Pin_Code` int(10) NOT NULL,
  `State` varchar(12) NOT NULL,
  `Country` varchar(10) NOT NULL,
  `S_REG_NUM` int(6) NOT NULL,
  `std_pic` varchar(100) NOT NULL,
  `st_session` varchar(15) NOT NULL,
  `Sibling` varchar(50) NOT NULL,
  `reg_date` varchar(50) NOT NULL,
  `Sibling_Des` varchar(10000) NOT NULL,
  `Tuit_mode` varchar(50) NOT NULL,
  `Total_fee` int(10) NOT NULL,
  `Ad_fee` int(10) NOT NULL,
  `Month_fee` int(10) NOT NULL,
  `Sibling_dis` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `First_Name`, `Last_Name`, `Father_Name`, `Mother_Name`, `class_nm1`, `Section`, `Birth_day`, `Birth_month`, `Birth_year`, `Email_Id`, `Mobile_Number`, `Gender`, `Address`, `City`, `Pin_Code`, `State`, `Country`, `S_REG_NUM`, `std_pic`, `st_session`, `Sibling`, `reg_date`, `Sibling_Des`, `Tuit_mode`, `Total_fee`, `Ad_fee`, `Month_fee`, `Sibling_dis`) VALUES
(1, 'Jasmine', 'Kaur', 'Jaspal Singh', 'Rajvinder Kaur', 'LKG', 'A', 5, 'April', 2009, 'jas45@gmail.com', 2147483647, 'Female', 'aaaa', 'Ludhiana', 141001, 'Punjab', 'India', 20252, '../std_pic/20252.jpg', '2023-2024', '', '0', '', '', 0, 0, 0, 0),
(3, 'Ricky', 'Kumar', 'Ram Kumar', 'Sunita', 'UKG', 'B', 8, 'April', 2009, 'ricky67@gmail.com', 2147483647, 'Male', 'ssss', 'Ludhiana', 141001, 'Punjab', 'India', 20253, '../std_pic/20253.jpg', '2023-2024', 'Brother', '0', '', '', 33840, 0, 3200, 0),
(4, 'Jasleen', 'Kaur', 'Jaspal Singh', 'Kirat Kaur', '1st', 'B', 7, 'July', 2004, 'jasleen34@gmail.com', 2147483647, 'Female', 'Dugri', 'Ludhiana', 141001, 'Punjab', 'India', 20254, '../std_pic/20254.jpg', '2024-2025', 'None', '2025-09-24', '', '', 28080, 0, 3200, 0),
(5, 'Jasleen', 'Kaur', 'Jaspal Singh', 'Kirat Kaur', '1st', 'B', 7, 'July', 2004, 'jasleen34@gmail.com', 2147483647, 'Female', 'Dugri', 'Ludhiana', 141001, 'Punjab', 'India', 20254, '../std_pic/20254.jpg', '2024-2025', 'None', '2025-09-24', '', '', 28080, 0, 3200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'ENGLISH'),
(2, 'HINDI'),
(3, 'PUNJABI'),
(4, 'MATH'),
(5, 'EVS'),
(6, 'COMPUTER'),
(7, 'ART'),
(8, 'SCIENCE'),
(9, 'SOCIAL STUDIES'),
(10, 'PHYSICAL EDUCATION');

-- --------------------------------------------------------

--
-- Table structure for table `transcation_info`
--

CREATE TABLE `transcation_info` (
  `Trans_id` int(11) NOT NULL,
  `S_REG_NUM` int(5) NOT NULL,
  `Description` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `class_nm1` int(25) NOT NULL,
  `Section` varchar(25) NOT NULL,
  `st_session` varchar(8) NOT NULL,
  `for_month` varchar(50) NOT NULL,
  `Monthly_fee` int(50) NOT NULL,
  `trans_amt` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transcation_info`
--

INSERT INTO `transcation_info` (`Trans_id`, `S_REG_NUM`, `Description`, `Date`, `class_nm1`, `Section`, `st_session`, `for_month`, `Monthly_fee`, `trans_amt`) VALUES
(1, 20254, 'adb', '0000-00-00', 1, 'B', '2024-202', 'jan-feb', 3200, 2147483647),
(2, 20254, 'abc', '2025-09-26', 1, 'B', '2024-202', 'jan-feb', 3200, 28080),
(3, 20253, 'abb', '2025-09-26', 0, 'B', '2023-202', 'jan-feb', 3200, 33840);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Username` varchar(25) NOT NULL,
  `Password1` int(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Privilege` varchar(25) NOT NULL,
  `id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password1`, `Email`, `Privilege`, `id`) VALUES
('Admin', 12345, 'admin@gamil.com', '', 1),
('Rohn', 2222, 'rohan12@gmail.com', '', 3),
('Aman', 7145, 'aman@gmail.com', '', 4),
('Gavy', 4354, 'gavy12@gmail.com', '', 5),
('Simran', 6895, 'simra12@gmail.com', '', 6),
('Goyal', 1245, 'goyal32@gmail.com', '', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `fee_sett`
--
ALTER TABLE `fee_sett`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fee_class` (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `transcation_info`
--
ALTER TABLE `transcation_info`
  ADD PRIMARY KEY (`Trans_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `fee_sett`
--
ALTER TABLE `fee_sett`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transcation_info`
--
ALTER TABLE `transcation_info`
  MODIFY `Trans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `class_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Constraints for table `fee_sett`
--
ALTER TABLE `fee_sett`
  ADD CONSTRAINT `fee_class` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
