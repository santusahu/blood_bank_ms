-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2023 at 04:14 AM
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
-- Table structure for table `abms_users`
--

CREATE TABLE `abms_users` (
  `user_id` int(11) NOT NULL,
  `user_type` tinyint(1) NOT NULL COMMENT '1 for admin , 2 for user',
  `user_name` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `area_id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `old_password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `old_salt` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for active 1 for inactive',
  `delete_status` tinyint(1) NOT NULL COMMENT '1 for deleted , 0 for not deleted',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `abms_users`
--

INSERT INTO `abms_users` (`user_id`, `user_type`, `user_name`, `email`, `mobile`, `area_id`, `area_name`, `password`, `old_password`, `salt`, `old_salt`, `status`, `delete_status`, `create_date`, `update_date`, `delete_date`) VALUES
(1, 1, 'Admin', 'santu.sahu001@gmail.com', '9893324131', 0, '', '123', '123', '123', '123', 0, 0, '2022-07-06 09:46:08', '2022-07-06 09:46:08', '2022-07-06 09:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `ac_voucher_series`
--

CREATE TABLE `ac_voucher_series` (
  `series_id` int(11) NOT NULL,
  `voucher_type` varchar(5) NOT NULL,
  `prefix` varchar(10) NOT NULL,
  `series_start` varchar(11) NOT NULL,
  `session_end` tinyint(1) NOT NULL COMMENT '1 for Series start from 1 Yearly',
  `back_date` tinyint(1) NOT NULL COMMENT '0 for No and 1 For Yes',
  `company_id` int(11) NOT NULL,
  `company_name` varchar(300) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(300) NOT NULL,
  `session` varchar(50) NOT NULL,
  `continue_previous` tinyint(1) NOT NULL COMMENT '0 for continue previous  1 for new series'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ac_voucher_series`
--

INSERT INTO `ac_voucher_series` (`series_id`, `voucher_type`, `prefix`, `series_start`, `session_end`, `back_date`, `company_id`, `company_name`, `branch_id`, `branch_name`, `session`, `continue_previous`) VALUES
(1, 'DR', 'MD', '0003', 0, 0, 0, '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `area_master`
--

CREATE TABLE `area_master` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(50) NOT NULL,
  `head_quarter_id` int(11) NOT NULL,
  `head_quarter_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for active , 1 for inactive',
  `delete_status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area_master`
--

INSERT INTO `area_master` (`area_id`, `area_name`, `head_quarter_id`, `head_quarter_name`, `status`, `delete_status`, `create_date`, `update_date`) VALUES
(1, 'Kota', 1, 'Raipur', 0, 0, '2022-07-06 13:25:52', '2022-07-06 13:26:07'),
(2, 'Tatibandh', 1, 'Raipur', 0, 0, '2022-07-06 13:29:39', '0000-00-00 00:00:00'),
(3, 'Supela', 2, 'Bhilai', 0, 0, '2022-08-26 19:01:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donation`
--

CREATE TABLE `blood_donation` (
  `id` int(11) NOT NULL,
  `donar_id` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 for pending , 1 for approve , 2 for rejected',
  `blood_group` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_donation`
--

INSERT INTO `blood_donation` (`id`, `donar_id`, `unit`, `status`, `blood_group`) VALUES
(1, 4, 50, 1, 'B+'),
(13, 13, 3, 2, 'O+'),
(14, 4, 2, 0, 'AB-'),
(16, 5, 5, 1, 'O+'),
(20, 11, 3, 0, ''),
(22, 15, 7, 0, ''),
(23, 12, 8, 0, ''),
(24, 16, 12, 0, ''),
(25, 13, 12, 0, ''),
(26, 3, 12, 0, ''),
(27, 0, 4, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `blood_enquiry`
--

CREATE TABLE `blood_enquiry` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `unit` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_enquiry`
--

INSERT INTO `blood_enquiry` (`id`, `patient_name`, `blood_group`, `unit`, `create_date`, `update_date`) VALUES
(1, '', '', 0, '2023-01-24 19:40:34', '0000-00-00 00:00:00');

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
(1, 'A+', 0, 1, '2023-01-14 07:35:00', '2023-01-14 07:57:37'),
(2, 'A-', 4, 1, '2023-01-14 07:39:32', '2023-01-14 07:57:46'),
(3, 'B+', 60, 1, '2023-01-14 07:53:27', '2023-01-14 07:53:27'),
(4, 'B-', 0, 1, '2023-01-14 07:57:59', '2023-01-14 07:57:59'),
(5, 'O+', 5, 1, '2023-01-14 08:41:02', '2023-01-16 23:36:20'),
(6, 'O-', 0, 1, '2023-01-14 11:39:05', '2023-01-14 11:39:05'),
(7, 'AB+', 0, 1, '2023-01-20 16:44:15', '2023-01-20 16:44:15'),
(8, 'AB-', 0, 1, '2023-01-14 11:40:00', '2023-01-14 11:40:00');

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
(3, 'Srs biop', 'B+', '99999 xd', 'aa@qq.dd', 'sdsd', 0, '0000-00-00 00:00:00', '2023-01-23 23:25:14'),
(4, 'ms', 'B+', '7878787 54435', 'sdssd', 'sdxvdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, ' jitu', 'O+', 'ds', 'dsad', 'ads', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'ds', 'AB-', '9876543', 'czad13@', 'kioil', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'saur sahu', 'AB+', '62665437890', 'sawq@134', 'kota', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'gs', 'O+', '9876543', 'acad212@', 'kota', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'user1', 'AB+', '987654', 'xew@34', 'xhsx', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Bhi', 'B+', '43434', 'ass@dfgf.com', 'fsdfsd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'srs', 'A-', '896735623', 'srs@1232', 'loue', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'fdsf', 'AB+', '23232323', 'dsf', 'sdfdf', 0, '2023-01-23 22:21:37', '2023-01-23 22:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `month_master`
--

CREATE TABLE `month_master` (
  `month_id` int(11) NOT NULL,
  `month_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `month_master`
--

INSERT INTO `month_master` (`month_id`, `month_name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

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
(9, 'p1', 'A-', '987654321', 'aw213ERF', 'lop', '2023-01-24 19:14:17', '2023-01-24 19:14:17'),
(10, 'p1', 'A-', '987654321', 'aw213ERF', 'lop', '2023-01-25 08:35:08', '2023-01-25 08:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `sales_record_summry`
--

CREATE TABLE `sales_record_summry` (
  `sales_summry_id` int(11) NOT NULL,
  `dr_id` int(11) NOT NULL,
  `dr_name` int(11) NOT NULL,
  `task_complete_status` tinyint(1) NOT NULL,
  `planned_sale_amt` int(11) NOT NULL,
  `month_of_sale` int(11) NOT NULL,
  `session_year` int(11) NOT NULL,
  `sales_amount` int(11) NOT NULL,
  `grand_total_of_month` int(11) NOT NULL,
  `total_sale_amount` int(11) NOT NULL,
  `balance_amount` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abms_users`
--
ALTER TABLE `abms_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ac_voucher_series`
--
ALTER TABLE `ac_voucher_series`
  ADD PRIMARY KEY (`series_id`);

--
-- Indexes for table `area_master`
--
ALTER TABLE `area_master`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `area_name` (`area_name`);

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
-- Indexes for table `month_master`
--
ALTER TABLE `month_master`
  ADD PRIMARY KEY (`month_id`);

--
-- Indexes for table `patient_registration`
--
ALTER TABLE `patient_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_record_summry`
--
ALTER TABLE `sales_record_summry`
  ADD PRIMARY KEY (`sales_summry_id`),
  ADD KEY `dr_name` (`dr_name`),
  ADD KEY `dr_id` (`dr_id`),
  ADD KEY `month_of_sale` (`month_of_sale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abms_users`
--
ALTER TABLE `abms_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ac_voucher_series`
--
ALTER TABLE `ac_voucher_series`
  MODIFY `series_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area_master`
--
ALTER TABLE `area_master`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blood_donation`
--
ALTER TABLE `blood_donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `blood_enquiry`
--
ALTER TABLE `blood_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_group_master`
--
ALTER TABLE `blood_group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `donar_registration`
--
ALTER TABLE `donar_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `month_master`
--
ALTER TABLE `month_master`
  MODIFY `month_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_registration`
--
ALTER TABLE `patient_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
