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
-- Table structure for table `kliens`
--

CREATE TABLE `kliens` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `valasz_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kliens`
--

INSERT INTO `kliens` (`username`, `email`, `password`, `valasz_id`, `id`) VALUES
('Jnacsi', 'jancsi@ljb.vd', 'feltorheto', NULL, 8),
('John Doe', 'john@ljb.vd', 'valami', NULL, 10),
('BAPOr', 'ikhbh@ljb.vd', 'asdasd', NULL, 11),
('BAPOr', 'ikhbh@ljb.vd', 'asdasd', NULL, 12),
('John Doe', 'john@ljb.vd', 'valami', NULL, 13),
('John Doe', 'john@ljb.vd', 'valami', NULL, 14),
('Rozsi', 'rozsi@ljb.vd', 'feltorhetetlen', NULL, 23),
('Rozsi', 'rozsi@ljb.vd', 'feltorhetetlen', NULL, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kliens`
--
ALTER TABLE `kliens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kliens`
--
ALTER TABLE `kliens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
