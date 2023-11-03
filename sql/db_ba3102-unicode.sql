-- Written in utf8mb4_unicode_ci in case the official one doesnt work.


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 24, 2023 at 08:34 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

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
-- Table structure for table `tbl_adminaccount`
--

DROP TABLE IF EXISTS `tbl_adminaccount`;
CREATE TABLE IF NOT EXISTS `tbl_adminaccount` (
  `AdminID` int NOT NULL AUTO_INCREMENT,
  `StaffID` varchar(30) NOT NULL,
  `PasswordEncrypted` varchar(255) NOT NULL,
  `PermissionLevel` varchar(10) NOT NULL,
  PRIMARY KEY (`AdminID`),
  KEY `StaffID_fk_AdminAccount` (`StaffID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_adminaccount`
--

INSERT INTO `tbl_adminaccount` (`AdminID`, `StaffID`, `PasswordEncrypted`, `PermissionLevel`) VALUES
(1, 's1-23', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'High'),
(2, 's2-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Admin'),
(3, 's3-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Low'),
(4, 's4-21', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'High'),
(5, 's5-28', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_callslip`
--

DROP TABLE IF EXISTS `tbl_callslip`;
CREATE TABLE IF NOT EXISTS `tbl_callslip` (
  `CallSlipID` int NOT NULL AUTO_INCREMENT,
  `SRCode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `CreationDate` date NOT NULL,
  `CallDate` date NOT NULL,
  `CallTime` time NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`CallSlipID`),
  KEY `SRCode_fk_CallSlip` (`SRCode`),
  KEY `StaffID_fk_CallSlip` (`StaffID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_callslip`
--

INSERT INTO `tbl_callslip` (`CallSlipID`, `SRCode`, `StaffID`, `CreationDate`, `CallDate`, `CallTime`, `Action`, `Remarks`) VALUES
(1, '21-31092', 's1-23', '2023-10-24', '2023-10-25', '12:05:34', 'Three- to five-day suspension', ''),
(2, '21-35876', 's2-22', '2023-10-24', '2023-10-25', '10:05:34', 'Five- to seven-day suspension, may include re-admission probation', ''),
(3, '21-39479', 's3-22', '2023-10-23', '2023-10-24', '10:08:10', 'Seven- to nine-day suspension, may\r\ninclude Non-readmission', ''),
(4, '21-39841', 's4-21', '2023-10-22', '2023-10-23', '15:08:10', 'Written Warning', ''),
(5, '21-87123', 's5-28', '2023-10-17', '2023-10-18', '11:09:19', 'Written Reprimand', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

DROP TABLE IF EXISTS `tbl_course`;
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `CourseID` int NOT NULL AUTO_INCREMENT,
  `CourseName` varchar(255) NOT NULL,
  `Department` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`CourseID`, `CourseName`, `Department`) VALUES
(1, 'Information Technology', 'CICS'),
(2, 'Computer Science', 'CICS'),
(3, 'Marketing Management', 'CABE'),
(4, 'Psychology', 'CAS'),
(5, 'Education', 'CTE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

DROP TABLE IF EXISTS `tbl_staff`;
CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `StaffID` varchar(30) NOT NULL,
  `FirstName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MiddleName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Position` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`StaffID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`StaffID`, `FirstName`, `MiddleName`, `LastName`, `ContactNumber`, `Position`) VALUES
('s1-23', 'Bjorn', 'Jandel', 'Altemion', '09879065412', 'Lecturer'),
('s2-22', 'Bianca', 'Solares', 'Bustamante', '09126576871', 'Lecturer'),
('s3-22', 'Rick', 'Lopez', 'Mentoy', '09675455211', 'Lecturer'),
('s4-21', 'Juan', 'Dela Cruz', 'Cruz', '09099292131', 'Lecturer'),
('s5-28', 'Melissa', 'Escueta', 'Tapalla', '09080706051', 'Lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentaccount`
--

DROP TABLE IF EXISTS `tbl_studentaccount`;
CREATE TABLE IF NOT EXISTS `tbl_studentaccount` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `SRCode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `PasswordEncrypted` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`UserID`),
  KEY `SRCode_fk_User` (`SRCode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_studentaccount`
--

INSERT INTO `tbl_studentaccount` (`UserID`, `SRCode`, `PasswordEncrypted`) VALUES
(1, '21-31092', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(2, '21-35876', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(3, '21-39479', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(4, '21-39841', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(5, '21-87123', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

DROP TABLE IF EXISTS `tbl_students`;
CREATE TABLE IF NOT EXISTS `tbl_students` (
  `SRCode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MiddleName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CourseID` int NOT NULL,
  PRIMARY KEY (`SRCode`),
  KEY `CourseID_fk_Students` (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`SRCode`, `FirstName`, `MiddleName`, `LastName`, `CourseID`) VALUES
('21-31092', 'Schwartz', 'Sevilla', 'Hirang', 2),
('21-35876', 'Santiago', 'Dela Cruz', 'Ensaimada', 4),
('21-39479', 'Cyrus', 'Escueta', 'Tapalla', 1),
('21-39841', 'Kim Paolo', 'Roxas', 'Cuenca', 1),
('21-87123', 'Jose', 'Escobar', 'Feliz', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_violationreport`
--

DROP TABLE IF EXISTS `tbl_violationreport`;
CREATE TABLE IF NOT EXISTS `tbl_violationreport` (
  `ViolationID` int NOT NULL AUTO_INCREMENT,
  `SRCode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `ViolationTypeID` int NOT NULL,
  `ViolationDate` date NOT NULL,
  `ViolationTime` time NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Evidence` blob NOT NULL,
  PRIMARY KEY (`ViolationID`),
  KEY `ViolationTypeID_fk_ViolationReport` (`ViolationTypeID`),
  KEY `StaffID_fk_ViolationReport` (`StaffID`),
  KEY `SRCode_fk_ViolationReport` (`SRCode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_violationreport`
--

INSERT INTO `tbl_violationreport` (`ViolationID`, `SRCode`, `StaffID`, `ViolationTypeID`, `ViolationDate`, `ViolationTime`, `Remarks`, `Evidence`) VALUES
(1, '21-31092', 's1-23', 1, '2023-10-11', '13:19:12', '', ''),
(2, '21-35876', 's2-22', 2, '2023-10-04', '08:02:19', 'Smoke 3 cigarettes in total\r\n', ''),
(3, '21-39479', 's3-22', 3, '2023-10-18', '10:03:11', 'Conduct a mass gambling inside the school', ''),
(4, '21-39841', 's4-21', 4, '2023-10-20', '13:03:11', '', ''),
(5, '21-87123', 's5-28', 5, '2023-10-23', '17:04:16', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_violationtypes`
--

DROP TABLE IF EXISTS `tbl_violationtypes`;
CREATE TABLE IF NOT EXISTS `tbl_violationtypes` (
  `ViolationTypeID` int NOT NULL AUTO_INCREMENT,
  `ViolationName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ViolationLevel` varchar(10) NOT NULL,
  `Description` varchar(255) NOT NULL,
  PRIMARY KEY (`ViolationTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_violationtypes`
--

INSERT INTO `tbl_violationtypes` (`ViolationTypeID`, `ViolationName`, `ViolationLevel`, `Description`) VALUES
(1, 'Intoxication of Alcohol', 'Major', 'Possession of and/or intoxication with alcoholic\r\nbeverages within University premises or during any\r\noff-campus University-sponsored activities.'),
(2, 'Smoking', 'Major', 'Smoking anytime within University premises. '),
(3, 'Gambling', 'Major', 'Possession of any gambling paraphernalia and/or\r\nengaging in any form of gambling within University\r\npremises or outside within a 50-meter radius from the campus perimeter or during any off-campus University sponsored activities.'),
(4, 'Cutting Class', 'Minor', 'Violation of the usual classroom rules and regulations, such as cutting of classes set by the instructor.'),
(5, 'Public Display of Affection', 'Minor', 'Something such as a kiss or loving touch that is conducted in the school premise.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_adminaccount`
--
ALTER TABLE `tbl_adminaccount`
  ADD CONSTRAINT `StaffID_fk_AdminAccount` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_callslip`
--
ALTER TABLE `tbl_callslip`
  ADD CONSTRAINT `SRCode_fk_CallSlip` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `StaffID_fk_CallSlip` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_studentaccount`
--
ALTER TABLE `tbl_studentaccount`
  ADD CONSTRAINT `SRCode_fk_User` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `CourseID_fk_Students` FOREIGN KEY (`CourseID`) REFERENCES `tbl_course` (`CourseID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_violationreport`
--
ALTER TABLE `tbl_violationreport`
  ADD CONSTRAINT `SRCode_fk_ViolationReport` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `StaffID_fk_ViolationReport` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ViolationTypeID_fk_ViolationReport` FOREIGN KEY (`ViolationTypeID`) REFERENCES `tbl_violationtypes` (`ViolationTypeID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
