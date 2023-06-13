-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 03:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aporka`
--

-- --------------------------------------------------------

--
-- Table structure for table `kerdesek`
--

CREATE TABLE `kerdesek` (
  `kerdes_id` int(11) NOT NULL,
  `kerdes` varchar(30) NOT NULL,
  `validity` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kerdesek`
--

INSERT INTO `kerdesek` (`kerdes_id`, `kerdes`, `validity`) VALUES
(1, 'Hany eves vagy?', '2023-06-13 09:47:10'),
(2, 'Mit ittal ma?', '2023-06-13 09:47:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kerdesek`
--
ALTER TABLE `kerdesek`
  ADD PRIMARY KEY (`kerdes_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kerdesek`
--
ALTER TABLE `kerdesek`
  MODIFY `kerdes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
