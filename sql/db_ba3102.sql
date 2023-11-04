-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 02:34 PM
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
-- Database: `sia`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CreateStaff` (IN `id` VARCHAR(30), IN `fname` VARCHAR(50), IN `mname` VARCHAR(50), IN `lname` VARCHAR(50), IN `number` VARCHAR(13), IN `position` VARCHAR(100))   INSERT INTO tbl_staff (StaffID, FirstName, MiddleName, LastName, ContactNumber, Position)
VALUES (id, fname, mname, lname, number, position)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAdminAccount` (IN `id` INT, IN `password` VARCHAR(255))   SELECT AdminID, tbl_adminaccount.StaffID, PermissionLevel, tbl_staff.FirstName, tbl_staff.MiddleName, tbl_staff.LastName, tbl_staff.ContactNumber, tbl_staff.Position, PasswordEncrypted FROM tbl_adminaccount INNER JOIN tbl_staff ON tbl_adminaccount.StaffID = tbl_staff.StaffID WHERE tbl_adminaccount.StaffId = id AND PasswordEncrypted = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentAccount` (IN `id` INT, IN `password` VARCHAR(255))   SELECT UserID, tbl_studentaccount.SRCode, PasswordEncrypted, tbl_students.FirstName, tbl_students.MiddleName, tbl_students.LastName,  tbl_course.CourseName, tbl_course.Department FROM tbl_studentaccount INNER JOIN tbl_students ON tbl_studentaccount.SRCode = tbl_students.SRCode INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID WHERE tbl_studentaccount.SRCode = id AND PasswordEncrypted = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Student` (IN `sr` VARCHAR(30))   SELECT 
    CONCAT(FirstName, ' ', IF(LENGTH(MiddleName) > 0, CONCAT(SUBSTRING(MiddleName, 1, 1), '.'), ''), ' ', LastName) AS `FullName`,
    tbl_students.SRCode
FROM tbl_students
WHERE tbl_students.SRCode = sr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudHomepage` (IN `sr` VARCHAR(30))   SELECT 
    CONCAT(FirstName, ' ', IF(LENGTH(MiddleName) > 0, CONCAT(SUBSTRING(MiddleName, 1, 1), '.'), ''), ' ', LastName) AS `FullName`,
    tbl_students.SRCode, tbl_course.CourseName, tbl_course.Department
FROM tbl_students
INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID
WHERE tbl_students.SRCode = sr$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminaccount`
--

CREATE TABLE `tbl_adminaccount` (
  `AdminID` int(11) NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `PasswordEncrypted` varchar(255) NOT NULL,
  `PermissionLevel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_adminaccount`
--

INSERT INTO `tbl_adminaccount` (`AdminID`, `StaffID`, `PasswordEncrypted`, `PermissionLevel`) VALUES
(1, 's1-23', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\n', 'High'),
(2, 's2-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Admin'),
(3, 's3-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Low'),
(4, 's4-21', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'High'),
(5, 's5-28', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n', 'Admin'),
(7, 's1-23', 'pogi', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_callslip`
--

CREATE TABLE `tbl_callslip` (
  `CallSlipID` int(11) NOT NULL,
  `SRCode` varchar(30) NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `CreationDate` date NOT NULL,
  `CallDate` date NOT NULL,
  `CallTime` time NOT NULL,
  `Action` varchar(255) NOT NULL,
  `Remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `tbl_course` (
  `CourseID` int(11) NOT NULL,
  `CourseName` varchar(255) NOT NULL,
  `Department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `tbl_staff` (
  `StaffID` varchar(30) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `ContactNumber` varchar(13) NOT NULL,
  `Position` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`StaffID`, `FirstName`, `MiddleName`, `LastName`, `ContactNumber`, `Position`) VALUES
('s1-23', 'Bjorn', 'Jandel', 'Altemion', '09879065412', 'Lecturer'),
('s2-22', 'Bianca', 'Solares', 'Bustamante', '09126576871', 'Lecturer'),
('s3-22', 'Rick', 'Lopez', 'Mentoy', '09675455211', 'Lecturer'),
('s4-21', 'Juan', 'Dela Cruz', 'Cruz', '09099292131', 'Lecturer'),
('s5-28', 'Melissa', 'Escueta', 'Tapalla', '09080706051', 'Lecturer'),
('s6-20', 'John', 'Doe', 'Morgan', '09090807123', 'Dean');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studentaccount`
--

CREATE TABLE `tbl_studentaccount` (
  `UserID` int(11) NOT NULL,
  `SRCode` varchar(30) NOT NULL,
  `PasswordEncrypted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_studentaccount`
--

INSERT INTO `tbl_studentaccount` (`UserID`, `SRCode`, `PasswordEncrypted`) VALUES
(1, '21-31092', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(2, '21-35876', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(3, '21-39479', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\n'),
(4, '21-39841', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\n'),
(5, '21-87123', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(6, '21-39479', 'pogi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `SRCode` varchar(30) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `CourseID` int(11) NOT NULL
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

CREATE TABLE `tbl_violationreport` (
  `ViolationID` int(11) NOT NULL,
  `SRCode` varchar(30) NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `ViolationTypeID` int(11) NOT NULL,
  `ViolationDate` date NOT NULL,
  `ViolationTime` time NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `Evidence` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

CREATE TABLE `tbl_violationtypes` (
  `ViolationTypeID` int(11) NOT NULL,
  `ViolationName` varchar(100) NOT NULL,
  `ViolationLevel` varchar(10) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_adminaccount`
--
ALTER TABLE `tbl_adminaccount`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `StaffID_fk_AdminAccount` (`StaffID`);

--
-- Indexes for table `tbl_callslip`
--
ALTER TABLE `tbl_callslip`
  ADD PRIMARY KEY (`CallSlipID`),
  ADD KEY `SRCode_fk_CallSlip` (`SRCode`),
  ADD KEY `StaffID_fk_CallSlip` (`StaffID`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`CourseID`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `tbl_studentaccount`
--
ALTER TABLE `tbl_studentaccount`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `SRCode_fk_User` (`SRCode`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`SRCode`),
  ADD KEY `CourseID_fk_Students` (`CourseID`);

--
-- Indexes for table `tbl_violationreport`
--
ALTER TABLE `tbl_violationreport`
  ADD PRIMARY KEY (`ViolationID`),
  ADD KEY `ViolationTypeID_fk_ViolationReport` (`ViolationTypeID`),
  ADD KEY `StaffID_fk_ViolationReport` (`StaffID`),
  ADD KEY `SRCode_fk_ViolationReport` (`SRCode`);

--
-- Indexes for table `tbl_violationtypes`
--
ALTER TABLE `tbl_violationtypes`
  ADD PRIMARY KEY (`ViolationTypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_adminaccount`
--
ALTER TABLE `tbl_adminaccount`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_callslip`
--
ALTER TABLE `tbl_callslip`
  MODIFY `CallSlipID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_studentaccount`
--
ALTER TABLE `tbl_studentaccount`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_violationreport`
--
ALTER TABLE `tbl_violationreport`
  MODIFY `ViolationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_violationtypes`
--
ALTER TABLE `tbl_violationtypes`
  MODIFY `ViolationTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_adminaccount`
--
ALTER TABLE `tbl_adminaccount`
  ADD CONSTRAINT `StaffID_fk_AdminAccount` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`);

--
-- Constraints for table `tbl_callslip`
--
ALTER TABLE `tbl_callslip`
  ADD CONSTRAINT `SRCode_fk_CallSlip` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`),
  ADD CONSTRAINT `StaffID_fk_CallSlip` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`);

--
-- Constraints for table `tbl_studentaccount`
--
ALTER TABLE `tbl_studentaccount`
  ADD CONSTRAINT `SRCode_fk_User` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`);

--
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `CourseID_fk_Students` FOREIGN KEY (`CourseID`) REFERENCES `tbl_course` (`CourseID`);

--
-- Constraints for table `tbl_violationreport`
--
ALTER TABLE `tbl_violationreport`
  ADD CONSTRAINT `SRCode_fk_ViolationReport` FOREIGN KEY (`SRCode`) REFERENCES `tbl_students` (`SRCode`),
  ADD CONSTRAINT `StaffID_fk_ViolationReport` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`),
  ADD CONSTRAINT `ViolationTypeID_fk_ViolationReport` FOREIGN KEY (`ViolationTypeID`) REFERENCES `tbl_violationtypes` (`ViolationTypeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;