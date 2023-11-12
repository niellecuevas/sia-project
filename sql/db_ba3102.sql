-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 11:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ba3102`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appeal`
--

CREATE TABLE `tbl_appeal` (
  `AppealID` int(11) NOT NULL,
  `ViolationID` int(11) NOT NULL,
  `Appeal` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_appeal`
--

INSERT INTO `tbl_appeal` (`AppealID`, `ViolationID`, `Appeal`, `Status`) VALUES
(1, 1, 'I love you papi!', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  ADD PRIMARY KEY (`AppealID`),
  ADD KEY `ViolationID_fk_Appeal` (`ViolationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  MODIFY `AppealID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  ADD CONSTRAINT `ViolationID_fk_Appeal` FOREIGN KEY (`ViolationID`) REFERENCES `tbl_violationreport` (`ViolationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
