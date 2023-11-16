-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:17 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CreateStaff` (IN `id` VARCHAR(30), IN `fname` VARCHAR(50), IN `mname` VARCHAR(50), IN `lname` VARCHAR(50), IN `number` VARCHAR(13), IN `position` VARCHAR(100))   INSERT INTO tbl_staff (StaffID, FirstName, MiddleName, LastName, ContactNumber, Position)
VALUES (id, fname, mname, lname, number, position)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteViolationReport` (IN `inputViolationID` INT)   BEGIN
    DELETE FROM tbl_violationreport WHERE ViolationID = inputViolationID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAdminAccount` (IN `inputStaffId` VARCHAR(255))   BEGIN
    SELECT 
        tbl_adminaccount.AdminID, 
        tbl_adminaccount.StaffID, 
        tbl_staff.FirstName, 
        tbl_staff.MiddleName, 
        tbl_staff.LastName, 
        tbl_staff.ContactNumber, 
        tbl_staff.Position, 
        tbl_adminaccount.PasswordEncrypted 
    FROM tbl_adminaccount
    INNER JOIN tbl_staff ON tbl_adminaccount.StaffID = tbl_staff.StaffID
    WHERE tbl_adminaccount.StaffId = inputStaffId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAppeals` (IN `sortOption` VARCHAR(255))   BEGIN
SELECT AppealID,  tbl_violationreport.ViolationID, tbl_students.SRCode, CONCAT(tbl_students.FirstName, ' ', SUBSTRING(tbl_students.MiddleName, 1, 1), '. ', tbl_students.LastName) AS Name, ViolationName, Department, CourseName, tbl_appeal.Date AS AppealDate, ViolationName, ViolationDate, ViolationTime, CONCAT(tbl_staff.FirstName, ' ', SUBSTRING(tbl_staff.MiddleName, 1, 1), '. ', tbl_staff.LastName) AS StaffName, Remarks, Appeal, Evidence, Status
    FROM tbl_appeal
    INNER JOIN tbl_violationreport ON tbl_appeal.ViolationID = tbl_violationreport.ViolationID
    INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode
    INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID
    INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID
    INNER JOIN tbl_staff ON tbl_violationreport.StaffID = tbl_staff.StaffID
    ORDER BY
        CASE
            WHEN sortOption = 'option1' THEN ViolationName
            WHEN sortOption = 'option2' THEN Name
            ELSE AppealID
        END;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetFirstOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT FirstOffense
    FROM tbl_violationtypes
    WHERE ViolationTypeID = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSecondOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT SecondOffense
    FROM tbl_violationtypes
    WHERE ViolationTypeID = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentAccount` (IN `inputSRCode` VARCHAR(255))   BEGIN
    SELECT 
        tbl_studentaccount.UserID, 
        tbl_studentaccount.SRCode, 
        tbl_studentaccount.PasswordEncrypted, 
        tbl_students.FirstName, 
        tbl_students.MiddleName, 
        tbl_students.LastName, 
        tbl_course.CourseName, 
        tbl_course.Department 
    FROM tbl_studentaccount
    INNER JOIN tbl_students ON tbl_studentaccount.SRCode = tbl_students.SRCode
    INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID
    WHERE tbl_studentaccount.SRCode = inputSRCode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentData` (IN `srCodeParam` VARCHAR(255))   BEGIN
    SELECT CONCAT(FirstName, ' ', LEFT(MiddleName, 1), '. ', LastName) AS Name, CourseName, Department 
    FROM tbl_students 
    INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID 
    WHERE SRCode = srCodeParam;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentwithViolation` (IN `id` VARCHAR(30), IN `password` VARCHAR(255))   SELECT 
    tbl_studentaccount.UserID, 
    tbl_studentaccount.SRCode, 
    tbl_studentaccount.PasswordEncrypted, 
    tbl_students.FirstName, 
    tbl_students.MiddleName, 
    tbl_students.LastName, 
    tbl_course.CourseName, 
    tbl_course.Department, 
    tbl_violationtypes.ViolationLevel 
FROM 
    tbl_studentaccount 
INNER JOIN 
    tbl_students ON tbl_studentaccount.SRCode = tbl_students.SRCode 
INNER JOIN 
    tbl_course ON tbl_students.CourseID = tbl_course.CourseID 
INNER JOIN 
    tbl_violationreport ON tbl_students.SRCode = tbl_violationreport.SRCode 
INNER JOIN 
    tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID 
WHERE 
    tbl_studentaccount.SRCode = id 
AND 
    tbl_studentaccount.PasswordEncrypted = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentwithViolation2` (IN `id` VARCHAR(30), IN `password` VARCHAR(255))   SELECT DISTINCT
    tbl_studentaccount.UserID, 
    tbl_studentaccount.SRCode, 
    tbl_studentaccount.PasswordEncrypted, 
    tbl_students.FirstName, 
    tbl_students.MiddleName, 
    tbl_students.LastName, 
    tbl_course.CourseName, 
    tbl_course.Department, 
    tbl_violationtypes.ViolationLevel 
FROM 
    tbl_studentaccount 
INNER JOIN 
    tbl_students ON tbl_studentaccount.SRCode = tbl_students.SRCode 
INNER JOIN 
    tbl_course ON tbl_students.CourseID = tbl_course.CourseID 
INNER JOIN 
    tbl_violationreport ON tbl_students.SRCode = tbl_violationreport.SRCode 
INNER JOIN 
    tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID 
WHERE 
    tbl_studentaccount.SRCode = id
AND 
    tbl_studentaccount.PasswordEncrypted = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetThirdOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT ThirdOffense
    FROM tbl_violationtypes
    WHERE ViolationTypeID = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetViolationReport` (IN `p_SRCode` VARCHAR(255), IN `p_ViolationTypeID` INT)   BEGIN
    SELECT *
    FROM tbl_violationreport
    WHERE SRCode = p_SRCode AND ViolationTypeID = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetViolationTypes` ()   BEGIN
    SELECT ViolationTypeID, ViolationName FROM tbl_violationtypes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertViolationReport` (IN `p_SRCode` VARCHAR(255), IN `p_StaffID` VARCHAR(255), IN `p_ViolationTypeID` INT, IN `p_ViolationDate` DATE, IN `p_ViolationTime` TIME, IN `p_Remarks` VARCHAR(255), IN `p_Evidence` VARCHAR(255), IN `p_Status` VARCHAR(255))   BEGIN
    INSERT INTO tbl_violationreport (SRCode, StaffID, ViolationTypeID, ViolationDate, ViolationTime, Remarks, Evidence, Status)
    VALUES (p_SRCode, p_StaffID, p_ViolationTypeID, p_ViolationDate, p_ViolationTime, p_Remarks, p_Evidence, p_Status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Student` (IN `sr` VARCHAR(30))   SELECT 
    CONCAT(FirstName, ' ', IF(LENGTH(MiddleName) > 0, CONCAT(SUBSTRING(MiddleName, 1, 1), '.'), ''), ' ', LastName) AS `FullName`,
    tbl_students.SRCode
FROM tbl_students
WHERE tbl_students.SRCode = sr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentAppeal` (IN `id` INT, IN `date` DATE, IN `message` VARCHAR(255))   INSERT INTO tbl_appeal (ViolationID, Date, Appeal)
VALUES (id, date, message)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentViolationCarousel` (IN `sr` VARCHAR(30))   SELECT 
	tbl_violationreport.ViolationID,
    tbl_violationtypes.ViolationName,
    tbl_violationtypes.ViolationLevel,
    tbl_violationreport.ViolationDate, 
    tbl_violationreport.ViolationTime, 
    tbl_violationreport.Remarks, 
    tbl_violationreport.Evidence 
FROM tbl_violationreport
INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID
INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode
WHERE tbl_students.SRCode = sr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentViolationTypeCounter` (IN `sr` VARCHAR(30))   SELECT
	SUM(CASE WHEN ViolationLevel = 'Minor' THEN 1 ELSE 0 END) AS MinorViolations,
	SUM(CASE WHEN ViolationLevel = 'Major' THEN 1 ELSE 0 END) AS MajorViolations
FROM
	tbl_violationtypes
INNER JOIN tbl_violationreport ON tbl_violationtypes.ViolationTypeID = tbl_violationreport.ViolationTypeID
INNER JOIN tbl_students ON tbl_violationreport.SRCode = tbl_students.SRCode
WHERE
	tbl_students.SRCode = sr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudHomepage` (IN `sr` VARCHAR(30))   SELECT 
    CONCAT(FirstName, ' ', IF(LENGTH(MiddleName) > 0, CONCAT(SUBSTRING(MiddleName, 1, 1), '.'), ''), ' ', LastName) AS `FullName`,
    tbl_students.SRCode, tbl_course.CourseName, tbl_course.Department
FROM tbl_students
INNER JOIN tbl_course ON tbl_students.CourseID = tbl_course.CourseID
WHERE tbl_students.SRCode = sr$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudViolationCarousel` (IN `sr` VARCHAR(30))   SELECT 
	tbl_violationreport.ViolationID,
    tbl_violationtypes.ViolationName,
    tbl_violationtypes.ViolationLevel,
    tbl_callslip.Action,
    tbl_violationreport.ViolationDate,
    tbl_violationreport.ViolationTime,
    tbl_violationreport.Remarks,
    tbl_violationreport.Evidence
FROM tbl_violationreport
INNER JOIN tbl_violationtypes ON tbl_violationreport.ViolationTypeID = tbl_violationtypes.ViolationTypeID
INNER JOIN tbl_students ON tbl_students.SRCode = tbl_violationreport.SRCode
INNER JOIN tbl_callslip ON tbl_callslip.ViolationID = tbl_violationreport.ViolationID
WHERE tbl_students.SRCode = sr$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminaccount`
--

CREATE TABLE `tbl_adminaccount` (
  `AdminID` int(11) NOT NULL,
  `StaffID` varchar(30) NOT NULL,
  `PasswordEncrypted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_adminaccount`
--

INSERT INTO `tbl_adminaccount` (`AdminID`, `StaffID`, `PasswordEncrypted`) VALUES
(2, 's2-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(3, 's3-22', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(4, 's4-21', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(5, 's5-28', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(8, 's1-23', '$2y$10$n0pZWJxXGQUkTZpOevB5/u48DIBglIqgp3zJk7CREuGtZ7fyjS3MO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appeal`
--

CREATE TABLE `tbl_appeal` (
  `AppealID` int(11) NOT NULL,
  `ViolationID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Appeal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_appeal`
--

INSERT INTO `tbl_appeal` (`AppealID`, `ViolationID`, `Date`, `Appeal`) VALUES
(1, 6, '2023-11-12', 'Di naman po ako yan! Fake News!!!!'),
(2, 5, '2023-11-03', 'Good day po! Concern ko lang po na baka sala po ang type nyo ng SR Code. Di po ako ang nabigyan ng violation kanina'),
(3, 2, '2023-11-03', 'I believe po ay mali po ang verdict sa akin regarding sa case na ito'),
(4, 7, '2023-11-03', 'Mali po ang nabigay sa akin na violation'),
(7, 3, '2023-11-14', 'Culture');

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
(4, '21-39841', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\n'),
(5, '21-87123', '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a\r\n'),
(10, '21-39479', '$2y$10$n0pZWJxXGQUkTZpOevB5/u48DIBglIqgp3zJk7CREuGtZ7fyjS3MO'),
(11, '21-36339', '$2y$10$q.9QnTuJWpDAeyTA0/uNX.WVePihuZC1QeUCjtVp47BXr4nZz33p6');

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
('21-31662', 'Sofia Mae', '', 'Pepito', 1),
('21-33470', 'Emjay', 'A', 'Rongavilla', 1),
('21-35876', 'Santiago', 'Dela Cruz', 'Ensaimada', 4),
('21-36339', 'Jhon Kyle', 'Pardillo', 'Ilao', 1),
('21-38628', 'Raniella', 'R', 'Cuevas', 1),
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
  `Evidence` varchar(100) NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_violationreport`
--

INSERT INTO `tbl_violationreport` (`ViolationID`, `SRCode`, `StaffID`, `ViolationTypeID`, `ViolationDate`, `ViolationTime`, `Remarks`, `Evidence`, `Status`) VALUES
(1, '21-39479', 's1-23', 1, '2023-10-18', '23:18:00', 'Three- to five-day suspension (3-5)', '6550d16d20d71.jpg', 'Done'),
(2, '21-87123', 's1-23', 4, '2023-11-12', '21:21:00', 'Written Warning', '6550d24a63bf4.jpg', 'Done'),
(3, '21-39479', 's1-23', 6, '2023-11-12', '21:27:00', 'Written Reprimand', '6550d2c6623a9.jpg', 'Ongoing'),
(4, '21-39479', 's1-23', 6, '2023-11-12', '21:27:00', 'Written Reprimand to One-day suspension', '6550d2d46a0c2.jpg', 'Ongoing'),
(5, '21-31662', 's1-23', 7, '2023-11-12', '21:29:00', 'Written Reprimand', '6550d34889972.png', 'Done'),
(6, '21-38628', 's1-23', 7, '2023-11-12', '21:29:00', 'Written Reprimand', '6550d3b30990a.png', 'Ongoing'),
(7, '21-39841', 's1-23', 2, '2023-11-12', '21:31:00', 'Three- to five-day suspension (3-5)', '6550d3f713438.jpg', 'Done'),
(8, '21-39479', 's1-23', 3, '2023-11-12', '21:32:00', 'Three- to five-day suspension (3-5)', '6550d445b42cb.jpg', 'Ongoing'),
(23, '21-36339', 's1-23', 6, '2023-11-13', '11:31:00', 'Written Reprimand', '655198b18a0bb.jpg', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_violationtypes`
--

CREATE TABLE `tbl_violationtypes` (
  `ViolationTypeID` int(11) NOT NULL,
  `ViolationName` varchar(100) NOT NULL,
  `ViolationLevel` varchar(10) NOT NULL,
  `FirstOffense` varchar(255) NOT NULL,
  `SecondOffense` varchar(255) DEFAULT NULL,
  `ThirdOffense` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_violationtypes`
--

INSERT INTO `tbl_violationtypes` (`ViolationTypeID`, `ViolationName`, `ViolationLevel`, `FirstOffense`, `SecondOffense`, `ThirdOffense`) VALUES
(1, 'Intoxication of Alcohol', 'Major', 'Three- to five-day suspension (3-5)', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission'),
(2, 'Smoking', 'Major', 'Three- to five-day suspension (3-5)\r\n', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission '),
(3, 'Gambling', 'Major', 'Three- to five-day suspension (3-5)', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission '),
(4, 'Cutting Class', 'Minor', 'Written Warning', 'Written Reprimand', 'One-day suspension'),
(5, 'Public Display of Affection', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension may include Disciplinary Probation\r\n'),
(6, 'Improper Uniform / Dress Code', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(7, 'Misbehavior', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(8, 'Provocation to a fight (quarrel or fistfight).', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(9, 'Making all forms of disturbances', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(10, 'Unauthorized removal of official notices, posters, \r\nstreamers, tarpaulins', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(11, 'Breaking into a class or College-sponsored activities without the permission of the organizer', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(12, 'Membership to fraternities or sororities which are not duly recognized by the University.', 'Major', 'Three- to six-day suspension (3-6)', 'Six- to eight-day suspension (6-8), may include \r\nRe-admission Probation', 'Eight- to ten-day suspension (8-10), may \r\ninclude Non-readmission'),
(13, 'Destructive acts, due to vandalism or drunkenness or \r\nrecklessness', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(14, 'Bringing bladed objects and similar objects', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(15, 'Acts that result to slight physical injury against any individual within the University premises', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(16, 'Bribery of any nature given to any employee of the University ', 'Major', 'Six- to ten-day suspension (6-10), may include Non-readmission', 'Ten- to twelve-day suspension (10-12), may include Non-readmission', 'Twelve- to fourteen-day suspension (12-14), may include Non-readmission\r\n'),
(17, 'Acts that cause serious physical injury which may include damage to property', 'Major', 'Eight- to twelve-day suspension (8-12), may include Non-readmission', 'Twelve- fourteen-day suspension (12-14), may include Non-readmission', 'Fourteen- to sixteen-day suspension (14-16), may include Non-readmission'),
(18, 'Student protests whose distinctive character is intimidation, obstruction and/or destruction.', 'Major', 'Ten to fourteen day suspension (10 -14), may \r\ninclude Non-readmission', 'Fifteen to seventeen day suspension (15-17), may include Non-readmission', 'Eighteen to twenty day suspension (18-20), may include Non-readmission '),
(19, 'Academic dishonesty or cheating during examination', 'Major', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension');

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
-- Indexes for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  ADD PRIMARY KEY (`AppealID`),
  ADD KEY `ViolationID_fk_Appeal` (`ViolationID`);

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
  ADD KEY `SRCode_fk_ViolationReport` (`SRCode`),
  ADD KEY `StaffID_fk_ViolationReport` (`StaffID`);

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
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  MODIFY `AppealID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_studentaccount`
--
ALTER TABLE `tbl_studentaccount`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_violationreport`
--
ALTER TABLE `tbl_violationreport`
  MODIFY `ViolationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_violationtypes`
--
ALTER TABLE `tbl_violationtypes`
  MODIFY `ViolationTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_adminaccount`
--
ALTER TABLE `tbl_adminaccount`
  ADD CONSTRAINT `StaffID_fk_AdminAccount` FOREIGN KEY (`StaffID`) REFERENCES `tbl_staff` (`StaffID`);

--
-- Constraints for table `tbl_appeal`
--
ALTER TABLE `tbl_appeal`
  ADD CONSTRAINT `ViolationID_fk_Appeal` FOREIGN KEY (`ViolationID`) REFERENCES `tbl_violationreport` (`ViolationID`);

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
