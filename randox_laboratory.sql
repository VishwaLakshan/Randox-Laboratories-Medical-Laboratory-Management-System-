-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 11:21 AM
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
-- Database: `randox_laboratory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `otp_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_email`, `otp_code`) VALUES
(1, 'Dilshan Oshada', 'Admin', '$2y$10$Ef7juR9nm/za25XU6TG3KuCUh98.RImnwomu94NjtyTbwHtDeb0wC', 'dilshanoshada7@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` varchar(255) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `report_type` int(11) NOT NULL,
  `appinment_date` date NOT NULL,
  `appointment_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `payment_id`, `customer_id`, `report_type`, `appinment_date`, `appointment_time`) VALUES
('0065082928', 3, 1, 1, '2023-11-14', 1),
('1094997474', 9, 3, 2, '2023-11-28', 3),
('1285978821', 18, 10, 2, '2023-11-25', 1),
('2180756787', 1, 1, 2, '2023-11-18', 3),
('2890568731', 13, 5, 2, '2023-11-30', 1),
('3113748008', 4, 1, 3, '2023-11-06', 2),
('3145373694', 10, 1, 3, '2023-11-28', 3),
('3551390857', 7, 3, 1, '2023-11-30', 2),
('3951074203', 17, 9, 3, '2023-11-25', 2),
('5135457244', 0, 1, 2, '2023-11-25', 1),
('5918346715', 0, 1, 1, '2023-11-11', 2),
('6023272716', 5, 1, 2, '2023-11-27', 1),
('6051672071', 12, 1, 2, '2023-11-25', 3),
('7189347676', 8, 3, 1, '2023-11-30', 3),
('7628574565', 0, 1, 2, '2023-11-24', 1),
('7760145463', 16, 8, 1, '2023-11-29', 1),
('7768853725', 11, 4, 2, '2023-11-29', 1),
('8166999124', 19, 10, 1, '2023-12-06', 3),
('8235417512', 15, 7, 1, '2023-11-30', 1),
('8657592421', 2, 2, 3, '2023-11-22', 3),
('9127583267', 20, 11, 1, '2023-12-12', 1),
('9347635544', 6, 1, 2, '2023-11-08', 1),
('9372142982', 14, 6, 2, '2023-11-30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_bd` date NOT NULL,
  `customer_nic` varchar(15) DEFAULT NULL,
  `customer_pnumber` varchar(15) NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL DEFAULT 'default_profile.png',
  `auth_token` varchar(255) DEFAULT NULL,
  `otp_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_bd`, `customer_nic`, `customer_pnumber`, `customer_email`, `username`, `password`, `profile_pic`, `auth_token`, `otp_code`) VALUES
(3, 'Kalana Piyumantha', '1999-10-19', '992933852V', '94769758088', '251kalana@gmail.com', 'Kalanam7s7mp', '$2y$12$iU9fyrkUZ50jovD2twUc3eZ9W7x0D67KiwCT4ERmxzqyXOGx8MYii', 'default_profile.png', 'y07VTRdX0NmapB5NPgF3', NULL),
(4, 'Vishwa Lakshan', '2022-11-09', '992234567V', '94718698684', 'iit20090@std.uwu.ac.lk', 'VishwabMzbTG', '$2y$10$0MKUj/oo.6OFZt/Eloy2neO/hu77ZWe5w8mZdz87zxrjih22hAjNG', 'default_profile.png', 'z9ksIkfBoX9Z6a6EBSjc', '72828'),
(8, 'Thilina Pathum', '1999-10-09', '992939852V', '94714280535', 'iit20049@std.uwu.ac.lk', 'ThilinaNhTlC7', '$2y$10$oUEWQsdjudNyNLhaf5elPOL3bUwWYxrzX8wgeIZ8uqVMI1B1DJLcC', 'default_profile.png', 'B85HNP87cBQZJwCf3Nju', '60328'),
(9, 'Dilshan Manahara', '1999-12-20', '199935512510', '94785221703', 'manahara9912@gmail.com', 'DilshanMPdlAo', '$2y$10$ndCpwGMPn1DmB99wXw6QiOqG/EKPgO316ZGhBbI5SBWuAdm0I8zVa', 'DilshanMPdlAo65602f4122eaa6.53490230.png', 'UBvVaozjvpzCqaRJthDA', NULL),
(10, 'Dilshan Oshada', '2000-12-15', '200035003270', '94778096452', 'dilshanoshada7@gmail.com', 'DilshanHHf8Ac', '$2y$10$NCj/vYkZ4CirxsNYVwsn9.PdrbMMxMuks8urvUZVbWCNjvocYMdbm', 'DilshanHHf8Ac65604c246bbd72.76298464.png', 'MIkmkxQptUzTdk9tQ5nF', NULL),
(11, 'Sakila Gunawardhane', '1998-12-06', '200035003270', '94770595105', 'gunawardhanasakila@gmail.com', 'Sakilaiy2WhW', '$2y$12$ye1O0MxmVYsfg71cM7Y80O.UNJvUDR8KtqNfLjuRPrWWHS4c62oTG', 'default_profile.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lab_technician`
--

CREATE TABLE `lab_technician` (
  `labtec_id` int(11) NOT NULL,
  `labtec_name` varchar(255) NOT NULL,
  `labtec_email` varchar(255) NOT NULL,
  `labtec_username` varchar(255) NOT NULL,
  `labtec_password` varchar(255) NOT NULL,
  `labtec_role` varchar(100) NOT NULL,
  `otp_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lab_technician`
--

INSERT INTO `lab_technician` (`labtec_id`, `labtec_name`, `labtec_email`, `labtec_username`, `labtec_password`, `labtec_role`, `otp_code`) VALUES
(1, 'Kalana Piyumantha', '251kalana@gmail.com', 'Kalana', '$2y$10$8sFt.8akkqvQBYtEHGurbOhTK1lZR1YjZvUo0O6xCarXMnpVEEN4.', 'senior', ''),
(2, 'Vishwa Lakshan', 'vishwadimbulana1999@gmail.com', 'Vishwa', '$2y$10$8sFt.8akkqvQBYtEHGurbOhTK1lZR1YjZvUo0O6xCarXMnpVEEN4.', 'junior', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `appointment_id`, `payment_date`, `payment_time`, `payment_amount`) VALUES
(1, 1, '2180756787', '2023-11-03', '15:44:30', 450.00),
(2, 2, '8657592421', '2023-11-04', '23:38:44', 950.00),
(3, 1, '0065082928', '2023-11-05', '00:40:04', 850.00),
(4, 1, '3113748008', '2023-11-05', '00:41:22', 950.00),
(5, 1, '6023272716', '2023-11-05', '01:27:53', 450.00),
(6, 1, '9347635544', '2023-11-06', '12:56:41', 450.00),
(7, 3, '3551390857', '2023-11-23', '20:47:41', 850.00),
(8, 3, '7189347676', '2023-11-23', '21:09:42', 850.00),
(9, 3, '1094997474', '2023-11-23', '21:19:03', 450.00),
(10, 1, '3145373694', '2023-11-23', '22:12:12', 950.00),
(11, 4, '7768853725', '2023-11-24', '08:26:22', 450.00),
(12, 1, '6051672071', '2023-11-24', '08:45:49', 450.00),
(13, 5, '2890568731', '2023-11-24', '08:56:21', 450.00),
(14, 6, '9372142982', '2023-11-24', '09:51:46', 450.00),
(15, 7, '8235417512', '2023-11-24', '10:02:38', 850.00),
(16, 8, '7760145463', '2023-11-24', '10:08:49', 850.00),
(17, 9, '3951074203', '2023-11-24', '10:29:43', 950.00),
(18, 10, '1285978821', '2023-11-24', '12:29:38', 450.00),
(19, 10, '8166999124', '2023-11-24', '12:34:45', 850.00),
(20, 11, '9127583267', '2023-11-24', '12:52:11', 850.00);

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `receptionist_id` int(11) NOT NULL,
  `receptionist_name` varchar(255) NOT NULL,
  `receptionist_email` varchar(255) NOT NULL,
  `receptionist_username` varchar(255) NOT NULL,
  `receptionist_password` varchar(255) NOT NULL,
  `otp_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receptionist`
--

INSERT INTO `receptionist` (`receptionist_id`, `receptionist_name`, `receptionist_email`, `receptionist_username`, `receptionist_password`, `otp_code`) VALUES
(1, 'Thilina Pathum', 'iit20046@std.uwu.ac.lk', 'Thilina', '$2y$10$8sFt.8akkqvQBYtEHGurbOhTK1lZR1YjZvUo0O6xCarXMnpVEEN4.', '218376');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `report_date` date NOT NULL,
  `report_filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tempory_u_data`
--

CREATE TABLE `tempory_u_data` (
  `customer_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_report`
--

CREATE TABLE `temp_report` (
  `temp_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `appointment_id` varchar(255) NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_report`
--

INSERT INTO `temp_report` (`temp_id`, `test_id`, `appointment_id`, `data`) VALUES
(1, 2, '1094997474', 'a:5:{s:6:\"urineR\";s:5:\"Trace\";s:6:\"urineP\";s:5:\"Trace\";s:6:\"urineG\";s:8:\"Negative\";s:7:\"urineGr\";s:5:\"1.025\";s:7:\"urineCo\";s:5:\"Amber\";}'),
(5, 2, '7768853725', 'a:5:{s:6:\"urineR\";s:5:\"Trace\";s:6:\"urineP\";s:8:\"Negative\";s:6:\"urineG\";s:8:\"Negative\";s:7:\"urineGr\";s:5:\"1.025\";s:7:\"urineCo\";s:5:\"Amber\";}'),
(6, 2, '1285978821', 'a:5:{s:6:\"urineR\";s:2:\"25\";s:6:\"urineP\";s:2:\"15\";s:6:\"urineG\";s:2:\"35\";s:7:\"urineGr\";s:4:\"1.00\";s:7:\"urineCo\";s:6:\"Yellow\";}');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(50) NOT NULL,
  `test_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `test_name`, `test_price`) VALUES
(1, 'Full Blood Report', 850.00),
(2, 'Urinalysis Report', 450.00),
(3, 'Lipid Profile Report', 950.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `lab_technician`
--
ALTER TABLE `lab_technician`
  ADD PRIMARY KEY (`labtec_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`receptionist_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `temp_report`
--
ALTER TABLE `temp_report`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lab_technician`
--
ALTER TABLE `lab_technician`
  MODIFY `labtec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `receptionist`
--
ALTER TABLE `receptionist`
  MODIFY `receptionist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_report`
--
ALTER TABLE `temp_report`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
