-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2024 at 10:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hris_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'HR'),
(2, 'IT'),
(3, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `phone`, `hire_date`, `job_title`, `department_id`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '1234567890', '2020-01-15', 'Software Engineer', 2),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '0987654321', '2019-07-30', 'HR Manager', 1),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', '1112223333', '2018-03-12', 'Accountant', 3);

-- --------------------------------------------------------

--
-- Table structure for table `leavequotas`
--

CREATE TABLE `leavequotas` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `year` year NOT NULL,
  `total_days` int NOT NULL,
  `used_days` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leavequotas`
--

INSERT INTO `leavequotas` (`id`, `employee_id`, `year`, `total_days`, `used_days`) VALUES
(1, 1, 2024, 20, 22),
(2, 2, 2024, 25, 25),
(3, 3, 2024, 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employee_id`, `start_date`, `end_date`, `location`, `status`) VALUES
(11, 1, '2024-06-29', '2024-06-30', 'https://www.google.com/maps/search/?api=1&query=-6.9557311,107.683612', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `leavequotas`
--
ALTER TABLE `leavequotas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leavequotas`
--
ALTER TABLE `leavequotas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `leavequotas`
--
ALTER TABLE `leavequotas`
  ADD CONSTRAINT `leavequotas_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
