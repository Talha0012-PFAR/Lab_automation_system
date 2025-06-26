-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 11:45 AM
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
-- Database: `lab_automation_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `NAME`, `description`) VALUES
(1, 'Electrical Testing', 'Handles voltage, current, load, insulation, short circuit, etc.'),
(2, 'Technician', 'Handles voltage, current, load, insulation, short circuit, etc.'),
(3, 'Mechanics', 'They commonly test fuses in automotive electrical systems to troubleshoot problems with various vehicle components');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `revision` varchar(10) DEFAULT NULL,
  `manufacture_number` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `revision`, `manufacture_number`, `created_at`) VALUES
(1, 'cap1234tal', 'Capacitor', 'Rev A', 'C0012A', '2025-06-13 20:04:00'),
(3, 'Bul1234tal', 'Bulb', 'Rev B', 'B0012A', '2025-06-14 03:22:40'),
(4, 'Fus1234tal', 'Fuses', 'Rev C', 'F0012C', '2025-06-15 05:31:45'),
(5, 'sur1234tal', 'Surge Protector', 'Rev C', 'S0012C', '2025-06-25 14:37:45'),
(6, 'pow1234tal', 'Power Inverter', 'Rev D', 'P0012D', '2025-06-25 14:38:36'),
(7, 'F1234tal', 'Flood Light', 'Rev A', 'F0012A', '2025-06-25 14:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `product_tests`
--

CREATE TABLE `product_tests` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `test_id` varchar(12) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_tests`
--

INSERT INTO `product_tests` (`id`, `product_id`, `test_id`, `department_id`) VALUES
(1, 'cap1234tal', 'TST001', 1),
(2, 'Bul1234tal', 'TST002', 2),
(4, 'Fus1234tal', 'TST003', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_id` varchar(12) NOT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `test_type_id` int(11) DEFAULT NULL,
  `tested_by` varchar(100) DEFAULT NULL,
  `STATUS` enum('Passed','Failed','Pending') DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `criteria` text DEFAULT NULL,
  `observed_output` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_id`, `product_id`, `test_type_id`, `tested_by`, `STATUS`, `remarks`, `criteria`, `observed_output`, `created_at`) VALUES
(1, 'TST001', 'cap1234tal', 1, 'Engr Talha', 'Passed', '\"Continuity confirmed successfully without interruption or fluctuation.\"', '\"Capacitor should allow momentary current flow during continuity check, indicating internal connectivity.\"', '\"Multimeter showed continuity beep with stable reading; internal circuit is connected properly.\"', '2025-06-15 01:01:30'),
(2, 'TST002', 'Bul1234tal', 2, 'kamran', 'Pending', '\"Bulb failed to illuminate during testing; possible internal filament break or manufacturing defected.\"', '\"Bulb should glow dimly under normal current conditions during the dim-bulb test, indicating proper circuit behavior and load presence.\"', '\"No illumination observed. Dim-bulb tester remained bright, indicating the bulb drew excessive or no current.\"', '2025-06-15 01:09:41'),
(3, 'TST003', 'Fus1234tal', 3, 'jhon', 'Passed', 'Fuse passed continuity and overload blow tests.', 'Be tested under standard room temperature (25°C ± 5°C)', 'Fuse remained intact at 1.5A, blew in 1.3s at 2.5A, no continuity at 3A — meets performance criteria.\r\n', '2025-06-15 05:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `test_types`
--

CREATE TABLE `test_types` (
  `id` int(11) NOT NULL,
  `test_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_types`
--

INSERT INTO `test_types` (`id`, `test_name`, `description`) VALUES
(1, 'Continuity Test', 'This test can be done with the multimeter set to continuity mode or by using an ohmmeter'),
(2, 'Dim-Bulb Tester', 'In some cases, a dim-bulb tester is used with AC power to test for potential shorts in electrical equipment, like radios, without causing damage to the device'),
(3, 'resistance mode', 'use a multimeter in continuity and Ensure optimal conductivity with precise Resistance Mode testing for your electrical appliances.'),
(4, 'Voltage Test (AC/DC)', 'Measure operating voltages to confirm stable power delivery. Prevents component damage due to overvoltage or undervoltage.'),
(5, 'Dielectric Withstand Test (HiPot)', 'Assess high voltage endurance to ensure safety under stress. Verifies that insulation wont break down during voltage surges'),
(6, 'Leakage Current Test', 'Detect unintended current flow for user safety and compliance. Helps identify insulation faults before they become dangerous.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Talha', 'talhasajjad1211@gmail.com', 'Huzaifa0012.'),
(2, 'Talha', 'talhasajjad1211@gmail.com', 'Huzaifa0012.'),
(3, 'Talha', 'talhasajjad1211@gmail.com', 'Huzaifa0012.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_tests`
--
ALTER TABLE `product_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_id` (`test_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `test_type_id` (`test_type_id`);

--
-- Indexes for table `test_types`
--
ALTER TABLE `test_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_tests`
--
ALTER TABLE `product_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test_types`
--
ALTER TABLE `test_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_tests`
--
ALTER TABLE `product_tests`
  ADD CONSTRAINT `product_tests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`),
  ADD CONSTRAINT `product_tests_ibfk_3` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`test_type_id`) REFERENCES `test_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
