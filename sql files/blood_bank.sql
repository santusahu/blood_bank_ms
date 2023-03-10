-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2023 at 04:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation`
--

CREATE TABLE `blood_donation` (
  `id` int(11) NOT NULL,
  `donar_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `approved_unit` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for pending , 1 for approve , 2 for rejected',
  `blood_group` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_donation`
--

INSERT INTO `blood_donation` (`id`, `donar_id`, `unit`, `approved_unit`, `status`, `blood_group`, `create_date`, `update_date`) VALUES
(1, 1, 2, 0, 0, 'A+', '2023-01-25 22:07:49', '2023-01-25 22:12:28'),
(2, 3, 3, 0, 1, 'A-', '2023-01-25 22:19:09', '2023-01-25 22:19:21'),
(3, 3, 2, 0, 2, 'A-', '2023-01-25 22:21:09', '2023-01-25 22:21:09'),
(4, 4, 5, 0, 2, 'O-', '2023-01-26 07:54:20', '2023-01-26 07:54:20'),
(5, 3, 3, 3, 1, 'A-', '2023-01-26 16:54:40', '2023-01-26 16:54:40'),
(6, 2, 3, 2, 1, 'B+', '2023-01-26 16:55:20', '2023-01-26 16:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `blood_enquiry`
--

CREATE TABLE `blood_enquiry` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `unit` int(11) NOT NULL,
  `approved_unit` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_enquiry`
--

INSERT INTO `blood_enquiry` (`id`, `patient_id`, `blood_group`, `unit`, `approved_unit`, `status`, `create_date`, `update_date`) VALUES
(1, 1, 'A+', 2, 1, 1, '2023-01-25 22:26:14', '2023-01-25 22:26:14'),
(2, 2, 'A-', 2, 0, 2, '2023-01-25 22:26:24', '2023-01-25 22:26:24'),
(3, 1, 'A+', 2, 2, 2, '2023-01-26 16:53:13', '2023-01-26 16:53:13'),
(4, 1, 'A-', 2, 0, 0, '2023-01-26 17:12:36', '2023-01-26 17:12:36'),
(5, 2, 'O+', 7, 0, 0, '2023-02-10 21:25:05', '2023-02-10 21:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group_master`
--

CREATE TABLE `blood_group_master` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `stock` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 available ,o not available',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_group_master`
--

INSERT INTO `blood_group_master` (`id`, `blood_group`, `stock`, `status`, `create_date`, `update_date`) VALUES
(1, 'A+', 4, 1, '2023-01-14 07:35:00', '2023-01-14 07:57:37'),
(2, 'A-', 11, 1, '2023-01-14 07:39:32', '2023-01-14 07:57:46'),
(3, 'B+', 7, 1, '2023-01-14 07:53:27', '2023-01-14 07:53:27'),
(4, 'B-', 5, 1, '2023-01-14 07:57:59', '2023-01-14 07:57:59'),
(5, 'O+', 5, 1, '2023-01-14 08:41:02', '2023-01-16 23:36:20'),
(6, 'O-', 5, 1, '2023-01-14 11:39:05', '2023-01-14 11:39:05'),
(7, 'AB+', 5, 1, '2023-01-20 16:44:15', '2023-01-20 16:44:15'),
(8, 'AB-', 5, 1, '2023-01-14 11:40:00', '2023-01-14 11:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `donar_registration`
--

CREATE TABLE `donar_registration` (
  `id` int(11) NOT NULL,
  `donar_name` varchar(50) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for pending, 1 for approved',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donar_registration`
--

INSERT INTO `donar_registration` (`id`, `donar_name`, `blood_group`, `mobile_number`, `email`, `address`, `status`, `create_date`, `update_date`) VALUES
(1, 'Jay', 'A+', '9887654213', 'aa2', 'sd', 0, '2023-01-25 22:05:36', '2023-01-26 17:03:20'),
(2, 'Ram', 'B+', '9890987655', 'FDFSD', 'XCZVX', 0, '2023-01-25 22:05:57', '2023-01-26 17:03:42'),
(3, 'Ajay', 'A-', '9763235256', '12', '12', 0, '2023-01-25 22:18:55', '2023-01-26 17:03:55'),
(4, 'kamal', 'O-', '6876867867', 'd4@565', 'aarang', 0, '2023-01-26 07:53:21', '2023-01-26 17:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `patient_registration`
--

CREATE TABLE `patient_registration` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_registration`
--

INSERT INTO `patient_registration` (`id`, `patient_name`, `blood_group`, `mobile_number`, `email`, `address`, `create_date`, `update_date`) VALUES
(1, 'Sanjay', 'A+', '9888888989', 'dsxxzz', '12', '2023-01-25 22:25:44', '2023-01-26 17:11:32'),
(2, 'Ajay', 'A-', '9893324131', 'ajay@gmail.com', 'Raipur', '2023-01-25 22:26:03', '2023-01-26 17:11:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1 for admin , 2 for user',
  `user_name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for active 1 for inactive',
  `delete_status` tinyint(1) NOT NULL COMMENT '1 for deleted , 0 for not deleted',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_type`, `user_name`, `email`, `mobile`, `password`, `status`, `delete_status`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 1, 'Admin', 'santu.sahu001@gmail.com', '7089886905', '123', 0, 0, '2022-07-06 09:46:08', '2022-07-06 09:46:08', '2022-07-06 09:46:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_donation`
--
ALTER TABLE `blood_donation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_enquiry`
--
ALTER TABLE `blood_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group_master`
--
ALTER TABLE `blood_group_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donar_registration`
--
ALTER TABLE `donar_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_registration`
--
ALTER TABLE `patient_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_donation`
--
ALTER TABLE `blood_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blood_enquiry`
--
ALTER TABLE `blood_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_group_master`
--
ALTER TABLE `blood_group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donar_registration`
--
ALTER TABLE `donar_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patient_registration`
--
ALTER TABLE `patient_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
