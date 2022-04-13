-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2022 at 04:15 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xavierGym`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `bookName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `bookName`) VALUES
(1, 'more info'),
(2, 'more info'),
(3, 'more info');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `className` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `className`) VALUES
(1, 'class1'),
(2, 'class');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customerName`) VALUES
(1, 'customer1'),
(2, 'customer2');

-- --------------------------------------------------------

--
-- Table structure for table `customerToClass`
--

CREATE TABLE `customerToClass` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `classId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerToClass`
--

INSERT INTO `customerToClass` (`id`, `customerId`, `classId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customerToRoutine`
--

CREATE TABLE `customerToRoutine` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `routineId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerToRoutine`
--

INSERT INTO `customerToRoutine` (`id`, `customerId`, `routineId`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customerToStaff`
--

CREATE TABLE `customerToStaff` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `staffId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customerToStaff`
--

INSERT INTO `customerToStaff` (`id`, `customerId`, `staffId`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `routines`
--

CREATE TABLE `routines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `exercise` varchar(100) NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `sets` varchar(100) NOT NULL,
  `reps` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routines`
--

INSERT INTO `routines` (`id`, `name`, `exercise`, `equipment`, `sets`, `reps`) VALUES
(1, '1', '1', '1', '1', '1'),
(2, '2', '2', '2', '2', '2'),
(3, '3', '3', '3', '3', '3'),
(4, '4', '4', '4', '4', '4'),
(5, '5', '5', '5', '5', '5'),
(6, '6', '6', '6', '6', '6'),
(7, '7', '7', '7', '7', '7');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `staffName` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staffName`, `position`) VALUES
(1, 'admin', ''),
(2, 'staff1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staffToClass`
--

CREATE TABLE `staffToClass` (
  `id` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `classId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffToClass`
--

INSERT INTO `staffToClass` (`id`, `staffId`, `classId`) VALUES
(1, 2, 2),
(2, 1, 1),
(3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffToRoutine`
--

CREATE TABLE `staffToRoutine` (
  `id` int(11) NOT NULL,
  `staffId` int(11) NOT NULL,
  `routineId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerToClass`
--
ALTER TABLE `customerToClass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerToRoutine`
--
ALTER TABLE `customerToRoutine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerToStaff`
--
ALTER TABLE `customerToStaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routines`
--
ALTER TABLE `routines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffToClass`
--
ALTER TABLE `staffToClass`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customerToClass`
--
ALTER TABLE `customerToClass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerToRoutine`
--
ALTER TABLE `customerToRoutine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customerToStaff`
--
ALTER TABLE `customerToStaff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `routines`
--
ALTER TABLE `routines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staffToClass`
--
ALTER TABLE `staffToClass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
