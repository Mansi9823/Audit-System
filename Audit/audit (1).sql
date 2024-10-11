-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 07:48 AM
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
-- Database: `audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `slno` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`slno`, `name`, `email`, `password`, `status`, `user_type`, `location`) VALUES
(1, 'Mansi', 'mansiyadav2962000@gmail.com', '123', '1', 'Admin', 'Head Office'),
(4, 'Pankaj', 'pankj2906@gmail.com', '123', 'Active', 'Admin', 'gondia');

-- --------------------------------------------------------

--
-- Table structure for table `all_data`
--

CREATE TABLE `all_data` (
  `id` int(11) NOT NULL,
  `sr_no` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `place` varchar(100) NOT NULL,
  `district_address` text NOT NULL,
  `zone` varchar(100) NOT NULL,
  `crm_no` varchar(255) NOT NULL,
  `prepared_by` varchar(100) NOT NULL,
  `testing_date` date DEFAULT NULL,
  `tested_by` varchar(100) DEFAULT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `cft_no` varchar(100) DEFAULT NULL,
  `frequency` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `print_date` date DEFAULT NULL,
  `occupier_name` varchar(255) DEFAULT NULL,
  `factory_address` text DEFAULT NULL,
  `vessel_description` text DEFAULT NULL,
  `manufacturer` text DEFAULT NULL,
  `process_nature` text DEFAULT NULL,
  `construction_date` date DEFAULT NULL,
  `wall_thickness` varchar(100) DEFAULT NULL,
  `first_use_date` date DEFAULT NULL,
  `safe_pressure` varchar(100) DEFAULT NULL,
  `design_pressure` varchar(100) DEFAULT NULL,
  `last_test_date` date DEFAULT NULL,
  `exposure` text DEFAULT NULL,
  `inaccessible_parts` text DEFAULT NULL,
  `examinations_tests` text DEFAULT NULL,
  `fittings` text DEFAULT NULL,
  `maintenance` text DEFAULT NULL,
  `repairs` text DEFAULT NULL,
  `calculated_pressure` text DEFAULT NULL,
  `repair_pressure` text DEFAULT NULL,
  `observations` text DEFAULT NULL,
  `distinguishing_number_description` varchar(255) DEFAULT NULL,
  `first_usedate` date DEFAULT NULL,
  `test_certificate_date` varchar(255) DEFAULT NULL,
  `periodic_examination_date` date DEFAULT NULL,
  `annealing_date` date DEFAULT NULL,
  `defects_found_description` text DEFAULT NULL,
  `use_start_date` date DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `mfg_first_use` varchar(255) NOT NULL,
  `service_used_for` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `pressure_opening` varchar(255) NOT NULL,
  `pressure_closing` varchar(255) NOT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_data`
--

INSERT INTO `all_data` (`id`, `sr_no`, `issue_date`, `company_name`, `place`, `district_address`, `zone`, `crm_no`, `prepared_by`, `testing_date`, `tested_by`, `equipment`, `quantity`, `cft_no`, `frequency`, `due_date`, `print_date`, `occupier_name`, `factory_address`, `vessel_description`, `manufacturer`, `process_nature`, `construction_date`, `wall_thickness`, `first_use_date`, `safe_pressure`, `design_pressure`, `last_test_date`, `exposure`, `inaccessible_parts`, `examinations_tests`, `fittings`, `maintenance`, `repairs`, `calculated_pressure`, `repair_pressure`, `observations`, `distinguishing_number_description`, `first_usedate`, `test_certificate_date`, `periodic_examination_date`, `annealing_date`, `defects_found_description`, `use_start_date`, `size`, `serial_number`, `mfg_first_use`, `service_used_for`, `location`, `pressure_opening`, `pressure_closing`, `remark`) VALUES
(113, 1, '2024-10-01', 'pankaj', 'Maharashtra', 'Gondia maharashtra', '2', '111', 'mansi', '2024-10-07', 'mansi', 'Bulker', 1, '0', 2, '2024-12-11', '2024-10-11', 'asd', 'a', 'sd', 'asd', 'sd', '2024-10-08', 'awsd', '2024-10-08', 'sad', 'asd', '2024-10-10', 'asd', 'asd', 'd', 'as', 'd', 'asd', 'asd', 'asd', 'khkj', 'khkjh', NULL, '2024-10-09', '2024-10-09', '2024-10-09', 'jhjhg', '2024-10-09', '5', '2', 'jhghj', 'jhg', 'kjh', 'jhgj', 'jhghj', 'lkjlk'),
(114, 1, '2024-10-01', 'Sahayog Multistate Co operative society ', 'Maharashtra', 'Gondia maharashtra', '2', '111', 'mansi', '2024-10-07', 'mansi', 'Bulker', 1, '0', 2, '2024-12-11', '2024-10-11', 'asd', 'a', 'sd', 'asd', 'sd', '2024-10-08', 'awsd', '2024-10-08', 'sad', 'asd', '2024-10-10', 'asd', 'asd', 'd', 'as', 'd', 'asd', 'asd', 'asd', 'khkj', 'khkjh', NULL, '2024-10-09', '2024-10-09', '2024-10-09', 'jhjhg', '2024-10-09', '5', '2', 'jhghj', 'jhg', 'kjh', 'jhgj', 'jhghj', 'lkjlk');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(30) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_address` text NOT NULL,
  `sender_contact` text NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 = Deliver, 2 = Pickup',
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `width` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`slno`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `all_data`
--
ALTER TABLE `all_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `slno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `all_data`
--
ALTER TABLE `all_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
