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
-- Table structure for table `szavazatok`
--

CREATE TABLE `szavazatok` (
  `valasz_id` int(11) NOT NULL,
  `szavazoNeve` varchar(20) NOT NULL,
  `valasz` varchar(30) NOT NULL,
  `kerdes_id` int(11) NOT NULL,
  `kerdes` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `szavazatok`
--

INSERT INTO `szavazatok` (`valasz_id`, `szavazoNeve`, `valasz`, `kerdes_id`, `kerdes`) VALUES
(1, 'John Doe', '23', 1, 'Hany eves vagy?'),
(2, 'Lajos', 'meg semit', 2, 'Mit ittal ma?'),
(3, 'Martonka', 'Sult krumpli', 3, 'Mi a kedvenc eteled?'),
(4, 'Miltiadesz Rezmuves', 'Lila', 4, 'Mi a kedvenc szined?'),
(5, 'Rozsi', 'Narancs', 3, 'Mi a kedvenc eteled?'),
(6, 'Janos', 'zold', 3, 'Mi a kedvenc eteled?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `szavazatok`
--
ALTER TABLE `szavazatok`
  ADD PRIMARY KEY (`valasz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `szavazatok`
--
ALTER TABLE `szavazatok`
  MODIFY `valasz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
