-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 08:35 AM
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
-- Table structure for table `tbl_players_categories`
--

CREATE TABLE `tbl_players_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_status` enum('A','B') NOT NULL DEFAULT 'A',
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_players_categories`
--

INSERT INTO `tbl_players_categories` (`category_id`, `category_name`, `category_status`, `createdDate`) VALUES
(1, 'Leg Spinner', 'A', '2022-10-18 15:03:43'),
(2, 'Fast Bowler', 'A', '2022-10-18 15:03:54'),
(3, 'Medium Pacer Bowler', 'A', '2022-10-18 15:04:06'),
(5, 'Batsman', 'A', '2022-10-18 15:04:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_players_categories`
--
ALTER TABLE `tbl_players_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_players_categories`
--
ALTER TABLE `tbl_players_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
