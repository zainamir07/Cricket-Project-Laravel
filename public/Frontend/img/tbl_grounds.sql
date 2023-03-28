-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 08:45 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cricketproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grounds`
--

CREATE TABLE `tbl_grounds` (
  `ground_id` int(11) NOT NULL,
  `ground_cityID` int(11) DEFAULT NULL,
  `ground_name` varchar(255) DEFAULT NULL,
  `ground_description` text DEFAULT NULL,
  `ground_address` text DEFAULT NULL,
  `ground_image` varchar(255) DEFAULT NULL,
  `ground_status` enum('A','B') NOT NULL DEFAULT 'A',
  `ground_perDayFee` int(11) NOT NULL,
  `ground_perWeekFee` int(11) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_grounds`
--

INSERT INTO `tbl_grounds` (`ground_id`, `ground_cityID`, `ground_name`, `ground_description`, `ground_address`, `ground_image`, `ground_status`, `ground_perDayFee`, `ground_perWeekFee`, `createdDate`) VALUES
(1, 48, 'AJK Main Ground', 'This is dummy data', 'Bagh AJK, Pakistan', 'uploads/1666082872-1665644228-slider-1.jpg', 'A', 1500, 5050, '2022-10-18 13:47:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_grounds`
--
ALTER TABLE `tbl_grounds`
  ADD PRIMARY KEY (`ground_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_grounds`
--
ALTER TABLE `tbl_grounds`
  MODIFY `ground_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
