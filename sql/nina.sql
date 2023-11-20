-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 03:34 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAppeal` (IN `inputAppeal` INT)   BEGIN
    DELETE FROM tbappeal WHERE appealid = inputAppeal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteViolationReport` (IN `inputViolationID` INT)   BEGIN
    DELETE FROM tbviolationreport WHERE violationid = inputViolationID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAdminAccount` (IN `inputAdminUsername` VARCHAR(255))   BEGIN
SELECT tbadminaccount.adminid, tbadminaccount.empid, tbadminaccount.username, tbempinfo.firstname, tbempinfo.lastname, tbadminaccount.passwordencrypted FROM tbadminaccount INNER JOIN tbempinfo ON tbadminaccount.empid = tbempinfo.empid
WHERE tbadminaccount.username = inputAdminUsername;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAppeals` (IN `sortOption` VARCHAR(255))   BEGIN
SELECT tbappeal.appealid,  tbviolationreport.violationid, tb_studinfo.studid, CONCAT(tb_studinfo.firstname, ' ',  tb_studinfo.lastname) AS name, tbviolationtypes.violationame, tbstudentdepartment.department, tb_studinfo.course, tbappeal.date AS appealdate, tbviolationtypes.violationame, tbviolationreport.violationdate, tbviolationreport.violationtime, CONCAT(tbempinfo.firstname, ' ', tbempinfo.lastname) AS staffname, tbviolationreport.remarks, tbappeal.appeal, tbviolationreport.evidence, tbviolationreport.status
    FROM tbappeal
    INNER JOIN tbviolationreport ON tbappeal.violationid = tbviolationreport.violationid
    INNER JOIN tb_studinfo ON tbviolationreport.studid = tb_studinfo.studid
    INNER JOIN tbviolationtypes ON tbviolationreport.violationtypeid = tbviolationtypes.violationtypeid
    INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course
    INNER JOIN tbempinfo ON tbviolationreport.empid = tbempinfo.empid
    ORDER BY
        CASE
            WHEN sortOption = 'option1' THEN tbviolationtypes.violationame
            WHEN sortOption = 'option2' THEN name
            ELSE tbappeal.appealid
        END;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetFirstOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT tbviolationtypes.firstoffense
    FROM tbviolationtypes
    WHERE tbviolationtypes.violationtypeid = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetSecondOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT tbviolationtypes.secondoffense
    FROM tbviolationtypes
    WHERE tbviolationtypes.violationtypeid = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentAccount` (IN `id` INT)   BEGIN
    SELECT 
       tbstudentaccount.userid,
       tbstudentaccount.studid,
       tbstudentaccount.passwordencrypted,
       tb_studinfo.firstname,
       tb_studinfo.lastname,
       tbstudentdepartment.course,
       tbstudentdepartment.department
    FROM tbstudentaccount
    INNER JOIN tb_studinfo ON tbstudentaccount.studid = tb_studinfo.studid
    INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course
    WHERE tbstudentaccount.studid = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentData` (IN `srCodeParam` INT)   BEGIN
    SELECT CONCAT(tb_studinfo.firstname, ' ', tb_studinfo.lastname) AS name, tb_studinfo.course, tbstudentdepartment.department
    FROM tb_studinfo
    INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course
    WHERE tb_studinfo.studid = srCodeParam;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetStudentInfoByStudID` (IN `inStudId` INT)   BEGIN
    SELECT CONCAT(tb_studinfo.firstname, ' ', tb_studinfo.lastname) AS name, tb_studinfo.course, tbstudentdepartment.department
    FROM tb_studinfo
    INNER JOIN tbstudentdepartment ON tb_studinfo.course = tbstudentdepartment.course
    WHERE tb_studinfo.studid = inStudId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetThirdOffense` (IN `p_ViolationTypeID` INT)   BEGIN
    SELECT tbviolationtypes.thirdoffense
    FROM tbviolationtypes
    WHERE tbviolationtypes.violationtypeid = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetViolationReport` (IN `p_SRCode` INT, IN `p_ViolationTypeID` INT)   BEGIN
    SELECT *
    FROM tbviolationreport
    WHERE tbviolationreport.studid = p_SRCode AND tbviolationreport.violationtypeid = p_ViolationTypeID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetViolationTypes` ()   BEGIN
    SELECT tbviolationtypes.violationtypeid, tbviolationtypes.violationame FROM tbviolationtypes;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_InsertViolationReport` (IN `p_SRCode` INT, IN `p_StaffID` INT, IN `p_ViolationTypeID` INT, IN `p_ViolationDate` DATE, IN `p_ViolationTime` TIME, IN `p_Remarks` VARCHAR(255), IN `p_Evidence` VARCHAR(255), IN `p_Status` VARCHAR(255))   BEGIN
    INSERT INTO tbviolationreport (tbviolationreport.studid, tbviolationreport.empid, tbviolationreport.violationtypeid, tbviolationreport.violationdate, tbviolationreport.violationtime, tbviolationreport.remarks, tbviolationreport.evidence, tbviolationreport.status)
    VALUES (p_SRCode, p_StaffID, p_ViolationTypeID, p_ViolationDate, p_ViolationTime, p_Remarks, p_Evidence, p_Status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentAppeal` (IN `id` INT, IN `date` DATE, IN `message` VARCHAR(255))   INSERT INTO tbappeal (violationid, date, appeal)
VALUES (id, date, message)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentViolationCarousel` (IN `id` INT)   SELECT 
	tbviolationreport.violationid,
    tbviolationtypes.violationame,
    tbviolationtypes.violationlevel,
    tbviolationreport.violationdate,
    tbviolationreport.violationtime,
    tbviolationreport.remarks,
    tbviolationreport.status,
    tbviolationreport.evidence
   
FROM tbviolationreport
INNER JOIN tbviolationtypes ON tbviolationreport.violationtypeid = tbviolationtypes.violationtypeid
INNER JOIN tb_studinfo ON tbviolationreport.studid = tb_studinfo.studid

WHERE tb_studinfo.studid = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_StudentViolationTypeCounter` (IN `id` INT)   SELECT
	SUM(CASE WHEN ViolationLevel = 'Minor' THEN 1 ELSE 0 END) AS MinorViolations,
	SUM(CASE WHEN ViolationLevel = 'Major' THEN 1 ELSE 0 END) AS MajorViolations
FROM
	tbviolationtypes
INNER JOIN tbviolationreport ON tbviolationtypes.violationtypeid = tbviolationreport.violationtypeid
INNER JOIN tb_studinfo ON tbviolationreport.studid = tb_studinfo.studid

WHERE
	tb_studinfo.studid = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbadminaccount`
--

CREATE TABLE `tbadminaccount` (
  `adminid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `passwordencrypted` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbadminaccount`
--

INSERT INTO `tbadminaccount` (`adminid`, `empid`, `passwordencrypted`, `username`) VALUES
(1, 1, '$2y$10$n0pZWJxXGQUkTZpOevB5/u48DIBglIqgp3zJk7CREuGtZ7fyjS3MO', 'aguila');

-- --------------------------------------------------------

--
-- Table structure for table `tbappeal`
--

CREATE TABLE `tbappeal` (
  `appealid` int(11) NOT NULL,
  `violationid` int(11) NOT NULL,
  `date` date NOT NULL,
  `appeal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbappeal`
--

INSERT INTO `tbappeal` (`appealid`, `violationid`, `date`, `appeal`) VALUES
(1, 1, '2023-11-20', 'Hi');

-- --------------------------------------------------------

--
-- Table structure for table `tbappstatus`
--

CREATE TABLE `tbappstatus` (
  `statusid` varchar(10) NOT NULL,
  `statusname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbappstatus`
--

INSERT INTO `tbappstatus` (`statusid`, `statusname`) VALUES
('SI0004', 'Congratulions! You are hired. We are looking forward to work with you!'),
('SI0005', 'Sorry, your application was rejected.'),
('SI0003', 'We are pleased to inform you that you have been selected as one of the candidates for a FACE-TO-FACE INTERVIEW.'),
('SI0001', 'We have successfully RECEIVED your application.'),
('SI0002', 'Your application is UNDER REVIEW. Please wait for the next update.');

-- --------------------------------------------------------

--
-- Table structure for table `tbdepartment`
--

CREATE TABLE `tbdepartment` (
  `deptid` varchar(10) NOT NULL,
  `deptname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbdepartment`
--

INSERT INTO `tbdepartment` (`deptid`, `deptname`) VALUES
('DI0010', 'Accounting Office'),
('DI0003', 'College of Accountancy, Business and Economics'),
('DI0009', 'College of Agriculture and Forestry'),
('DI0001', 'College of Arts and Sciences'),
('DI0005', 'College of Engineering, Architecture and Fine Arts'),
('DI0008', 'College of Industrial Technology'),
('DI0002', 'College of Informatics and Computing Sciences'),
('DI0006', 'College of Nursing'),
('DI0007', 'College of Nutrition and Dietetics'),
('DI0004', 'College of Teacher Education'),
('DI0016', 'External Affairs Office'),
('DI0018', 'Health Services'),
('DI0015', 'Human Resource Management Office'),
('DI0017', 'ICT Services'),
('DI0011', 'Library Services'),
('DI0014', 'Office of the Guidance and Counseling'),
('DI0012', 'Registrar Office'),
('DI0013', 'Testing and Admission Office');

-- --------------------------------------------------------

--
-- Table structure for table `tbempinfo`
--

CREATE TABLE `tbempinfo` (
  `empid` int(11) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `department` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbempinfo`
--

INSERT INTO `tbempinfo` (`empid`, `lastname`, `firstname`, `department`) VALUES
(1, 'aguila', 'nina', 'cics');

-- --------------------------------------------------------

--
-- Table structure for table `tbjobapplication`
--

CREATE TABLE `tbjobapplication` (
  `appno` varchar(15) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `contactno` varchar(12) NOT NULL,
  `emailadd` varchar(255) NOT NULL,
  `appadd` varchar(255) NOT NULL,
  `appeducation` varchar(255) NOT NULL,
  `appeligibility` text NOT NULL,
  `appworkexp` text NOT NULL,
  `fileresume` varchar(90) NOT NULL,
  `fileletter` varchar(90) NOT NULL,
  `filediploma` varchar(90) NOT NULL,
  `filecert` varchar(90) NOT NULL,
  `appdate` date NOT NULL,
  `appstatus` varchar(200) DEFAULT NULL,
  `statusdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbjobapplication`
--

INSERT INTO `tbjobapplication` (`appno`, `jobtitle`, `fname`, `mname`, `lname`, `birthday`, `sex`, `contactno`, `emailadd`, `appadd`, `appeducation`, `appeligibility`, `appworkexp`, `fileresume`, `fileletter`, `filediploma`, `filecert`, `appdate`, `appstatus`, `statusdate`) VALUES
('CV20232300', 'IT Lecturer', 'Carla Eliza', 'Magcawas', 'Villanueva', '2003-06-29', 'Female', '0987654321', 'carlaeliza@gmail.com', 'Sabang', 'College', 'None Required', 'Virtual Assistant', 'attachments/Activity-4_UI.pdf', 'attachments/Activity-4_UI.pdf', 'attachments/Activity-4_UI.pdf', 'attachments/Activity-4_UI.pdf', '2023-11-19', 'Your application is UNDER REVIEW. Please wait for the next update.', '2023-11-20'),
('KA20239178', 'Medical Services Assistant', 'Kate', 'Rosal', 'Atienza', '2003-09-04', 'Female', '09655820186', 'karatienza@gmail.com', 'lumbang', 'College', 'BSIT', 'lazada', 'attachments/1x1 and posters.pdf', 'attachments/id sy 2023-2024.pdf', 'attachments/Kate_2ndyr_2ndsem-grades.pdf', 'attachments/Kate_3rd year_COR.pdf', '2023-11-13', 'We are pleased to inform you that you have been selected as one of the candidates for a FACE-TO-FACE INTERVIEW.', '2023-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `tbjobs`
--

CREATE TABLE `tbjobs` (
  `jobid` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `departmentname` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateposted` date NOT NULL,
  `education` varchar(255) DEFAULT NULL,
  `experience` text NOT NULL,
  `expertise` text NOT NULL,
  `competency` text NOT NULL,
  `eligibility` text NOT NULL,
  `dutres` text DEFAULT NULL,
  `hiringstatus` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbjobs`
--

INSERT INTO `tbjobs` (`jobid`, `jobtitle`, `departmentname`, `quantity`, `dateposted`, `education`, `experience`, `expertise`, `competency`, `eligibility`, `dutres`, `hiringstatus`) VALUES
('JI0001', 'Guidance Counselor III', 'Office of the Guidance and Counseling', 3, '2023-08-27', 'Graduate of Master in Guidance and Counseling', 'At least 1-year relevant experience', 'Counseling Skills; Intervention Planning and Development Skills; Stress Management Skills; Psychological Report Writing; Group and Activity Facilitation; Problem Solving and Decision Making; Communication Skills; Interpersonal Skills; Technology Skills; Professional Integrity; and Records and Data Management', 'Counseling Skills; Intervention Planning and Development Skills; Stress Management Skills; Psychological Report Writing; Group and Activity Facilitation; Problem Solving and Decision Making; Communication Skills; Interpersonal Skills; Technology Skills; Professional Integrity; and Records and Data Management', 'Registered Guidance Counselor', 'true', 'Full'),
('JI0002', 'IT Lecturer', 'College of Informatics and Computing Sciences', 5, '2023-02-22', 'Candidates should have at least master’s degree and/or units and possess an undergraduate degree in IT/CS or any allied field', 'With at least experience in working IT industry, or handles project related to IT', 'Possesses competent knowledge in the field of IT/CS, can handle system administration and maintenance and system integration and Object-Oriented Programming', 'Possesses competent knowledge in the field of IT/CS, can handle system administration and maintenance and system integration and Object-Oriented Programming', 'None Required', 'True', 'Active'),
('JI0009', 'Librarian', 'Library Services', 1, '2023-11-19', 'Librarian', 'At least 1-year relevant experience', 'Librarian', 'Librarian', 'None Required', 'true', 'Active'),
('JI0004', 'Management Accounting Lecturer', 'College of Accountancy, Business and Economics', 1, '2023-06-29', 'Bachelor of Science in Management Accounting with knowledge in Business Analytics', 'At least one (1) year experience in the Academe or in the industry', 'Business Analytics', 'Business Analytics', 'None Required', 'True', 'Active'),
('JI0003', 'Medical Services Assistant', 'Health Services', 2, '2023-09-04', 'Graduate of Bachelor of Science in Nursing (BSN)', 'Two (2) years of relevant experience', 'With Basic Life Support(BLS) / Advance Cardiovascular Life Support(ACLS) Training', 'With Basic Life Support(BLS) / Advance Cardiovascular Life Support(ACLS) Training', 'None Required', 'True', 'Active'),
('JI0005', 'Psychology Instructor', 'College of Arts and Sciences', 3, '2023-01-30', 'Bachelor of Science in Psychology or other related Bachelor’s Degree with Relevant Master’s Degree', 'None Required', 'Proficient in the field of Psycholgy; possess critical thinking skills, communication skills and interpersonal skills', 'Proficient in the field of Psycholgy; possess critical thinking skills, communication skills and interpersonal skills', 'RA 1080', 'Terms and conditions of employment will be discussed during interview', 'Active'),
('JI0008', 'School Dentist', 'Health Services', 1, '2023-11-19', 'Graduate of BS Dentistry', 'At least 1-year relevant experience', 'Dentistry', 'Dentistry', 'None Required', 'false', 'Full'),
('JI0006', 'Social Science Lecturers', 'College of Teacher Education', 3, '2023-01-01', 'Bachelor of Arts in Social Science or any related Bachelor\'s Degree with relevant Master\'s Degree', 'Two (2) years of relevant experience', 'None Required', 'Possess competent knowledge in the field of Social Science; good at communication, listening, collaboration, and adaptability', 'None Required', 'Terms and conditions of employment will be discussed during interview', 'Active'),
('JI0007', 'System Admin', 'ICT Services', 2, '2023-11-19', 'Graduate of Bachelor of Science in Information Technology or Computer Science', 'With at least experience in working IT industry, or handles project related to IT', 'IT', 'IT', 'None Required', 'true', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbstudentaccount`
--

CREATE TABLE `tbstudentaccount` (
  `userid` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `passwordencrypted` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbstudentaccount`
--

INSERT INTO `tbstudentaccount` (`userid`, `studid`, `passwordencrypted`) VALUES
(3, 14, '$2y$10$n0pZWJxXGQUkTZpOevB5/u48DIBglIqgp3zJk7CREuGtZ7fyjS3MO'),
(6, 13, '$2y$10$IIbKG2lFI7/67AD/aThIquwHm9.OuAPa/xR4f8iXPPNEL94bfDqW2');

-- --------------------------------------------------------

--
-- Table structure for table `tbstudentdepartment`
--

CREATE TABLE `tbstudentdepartment` (
  `course` varchar(255) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbstudentdepartment`
--

INSERT INTO `tbstudentdepartment` (`course`, `department`) VALUES
('BA Communication', 'College of Arts and Sciences'),
('BS Computer Science', 'College of Informatics and Computing Sciences'),
('BS Information Techonlogy', 'College of Informatics and Computing Sciences');

-- --------------------------------------------------------

--
-- Table structure for table `tbviolationreport`
--

CREATE TABLE `tbviolationreport` (
  `violationid` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `empid` int(11) NOT NULL,
  `violationtypeid` int(11) NOT NULL,
  `violationdate` date NOT NULL,
  `violationtime` time NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `evidence` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbviolationreport`
--

INSERT INTO `tbviolationreport` (`violationid`, `studid`, `empid`, `violationtypeid`, `violationdate`, `violationtime`, `remarks`, `evidence`, `status`) VALUES
(1, 14, 1, 2, '2023-11-07', '08:04:10', 'Three- to five-day suspension (3-5)', '6550d16d20d71.jpg', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `tbviolationtypes`
--

CREATE TABLE `tbviolationtypes` (
  `violationtypeid` int(11) NOT NULL,
  `violationame` varchar(100) NOT NULL,
  `violationlevel` varchar(20) NOT NULL,
  `firstoffense` varchar(255) NOT NULL,
  `secondoffense` varchar(255) NOT NULL,
  `thirdoffense` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbviolationtypes`
--

INSERT INTO `tbviolationtypes` (`violationtypeid`, `violationame`, `violationlevel`, `firstoffense`, `secondoffense`, `thirdoffense`) VALUES
(1, 'Intoxication of Alcohol', 'Major', 'Three- to five-day suspension (3-5)', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission'),
(2, 'Smoking', 'Major', 'Three- to five-day suspension (3-5)\r\n', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission '),
(3, 'Gambling', 'Major', 'Three- to five-day suspension (3-5)', 'Five- to seven-day suspension (5-7), may include Re-admission Probation', 'Seven- to nine-day suspension (7-9), may include Non-readmission '),
(4, 'Cutting Class', 'Minor', 'Written Warning', 'Written Reprimand', 'One-day suspension'),
(5, 'Public Display of Affection', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension may include Disciplinary Probation\r\n'),
(6, 'Improper Uniform / Dress Code', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(7, 'Misbehavior', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(8, 'Provocation to a fight ', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(9, 'Disturbance', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(10, 'Unauthorized removals', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(11, 'Breaking into a class', 'Minor', 'Written Reprimand', 'Written Reprimand to One-day suspension', 'Two-day suspension, may include Disciplinary Probation\r\n'),
(12, 'Membership to unrecognized organization', 'Major', 'Three- to six-day suspension (3-6)', 'Six- to eight-day suspension (6-8), may include \r\nRe-admission Probation', 'Eight- to ten-day suspension (8-10), may \r\ninclude Non-readmission'),
(13, 'Destructive acts', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(14, 'Bringing bladed objects', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(15, 'Acts with slight physical injury', 'Major', 'Four- to eight-day suspension (4-8)', 'Eight- to ten-day suspension (8-10), may include Re-admission Probation', 'Ten- to twelve-day suspension (10-12), may include Non-readmission'),
(16, 'Bribery', 'Major', 'Six- to ten-day suspension (6-10), may include Non-readmission', 'Ten- to twelve-day suspension (10-12), may include Non-readmission', 'Twelve- to fourteen-day suspension (12-14), may include Non-readmission\r\n'),
(17, 'Acts with serious physical injury', 'Major', 'Eight- to twelve-day suspension (8-12), may include Non-readmission', 'Twelve- fourteen-day suspension (12-14), may include Non-readmission', 'Fourteen- to sixteen-day suspension (14-16), may include Non-readmission'),
(18, 'Obstructive Protesting', 'Major', 'Ten to fourteen day suspension (10 -14), may \r\ninclude Non-readmission', 'Fifteen to seventeen day suspension (15-17), may include Non-readmission', 'Eighteen to twenty day suspension (18-20), may include Non-readmission '),
(19, 'Academic dishonesty', 'Major', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension', 'Grade of zero (0) in the test/exam/requirement and one-day (1) suspension');

-- --------------------------------------------------------

--
-- Table structure for table `tb_studinfo`
--

CREATE TABLE `tb_studinfo` (
  `studid` int(11) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_studinfo`
--

INSERT INTO `tb_studinfo` (`studid`, `lastname`, `firstname`, `course`) VALUES
(13, 'parker', 'peter', 'BS Information Techonlogy'),
(14, 'kent', 'clark', 'BS Computer Science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbadminaccount`
--
ALTER TABLE `tbadminaccount`
  ADD PRIMARY KEY (`adminid`),
  ADD KEY `empid_fk_adminaccount` (`empid`);

--
-- Indexes for table `tbappeal`
--
ALTER TABLE `tbappeal`
  ADD PRIMARY KEY (`appealid`),
  ADD KEY `violationid_fk_appeal` (`violationid`);

--
-- Indexes for table `tbappstatus`
--
ALTER TABLE `tbappstatus`
  ADD PRIMARY KEY (`statusname`);

--
-- Indexes for table `tbdepartment`
--
ALTER TABLE `tbdepartment`
  ADD PRIMARY KEY (`deptname`);

--
-- Indexes for table `tbempinfo`
--
ALTER TABLE `tbempinfo`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `tbjobapplication`
--
ALTER TABLE `tbjobapplication`
  ADD PRIMARY KEY (`appno`),
  ADD KEY `title` (`jobtitle`),
  ADD KEY `status` (`appstatus`);

--
-- Indexes for table `tbjobs`
--
ALTER TABLE `tbjobs`
  ADD PRIMARY KEY (`jobtitle`),
  ADD KEY `Jobs` (`departmentname`);

--
-- Indexes for table `tbstudentaccount`
--
ALTER TABLE `tbstudentaccount`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `studid_fk_studentaccount` (`studid`);

--
-- Indexes for table `tbstudentdepartment`
--
ALTER TABLE `tbstudentdepartment`
  ADD PRIMARY KEY (`course`);

--
-- Indexes for table `tbviolationreport`
--
ALTER TABLE `tbviolationreport`
  ADD PRIMARY KEY (`violationid`),
  ADD KEY `studid_fk_violationreport` (`studid`),
  ADD KEY `empid_fk_violationreport` (`empid`),
  ADD KEY `violationtypeid_fk_violationreport` (`violationtypeid`);

--
-- Indexes for table `tbviolationtypes`
--
ALTER TABLE `tbviolationtypes`
  ADD PRIMARY KEY (`violationtypeid`);

--
-- Indexes for table `tb_studinfo`
--
ALTER TABLE `tb_studinfo`
  ADD PRIMARY KEY (`studid`),
  ADD KEY `course_fk_studinfo` (`course`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbadminaccount`
--
ALTER TABLE `tbadminaccount`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbappeal`
--
ALTER TABLE `tbappeal`
  MODIFY `appealid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbempinfo`
--
ALTER TABLE `tbempinfo`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbstudentaccount`
--
ALTER TABLE `tbstudentaccount`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbviolationreport`
--
ALTER TABLE `tbviolationreport`
  MODIFY `violationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbviolationtypes`
--
ALTER TABLE `tbviolationtypes`
  MODIFY `violationtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_studinfo`
--
ALTER TABLE `tb_studinfo`
  MODIFY `studid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbadminaccount`
--
ALTER TABLE `tbadminaccount`
  ADD CONSTRAINT `empid_fk_adminaccount` FOREIGN KEY (`empid`) REFERENCES `tbempinfo` (`empid`);

--
-- Constraints for table `tbappeal`
--
ALTER TABLE `tbappeal`
  ADD CONSTRAINT `violationid_fk_appeal` FOREIGN KEY (`violationid`) REFERENCES `tbviolationreport` (`violationid`);

--
-- Constraints for table `tbjobapplication`
--
ALTER TABLE `tbjobapplication`
  ADD CONSTRAINT `appstatus_fk_jobapplication` FOREIGN KEY (`appstatus`) REFERENCES `tbappstatus` (`statusname`),
  ADD CONSTRAINT `jobtitle_fk_jobapplication` FOREIGN KEY (`jobtitle`) REFERENCES `tbjobs` (`jobtitle`);

--
-- Constraints for table `tbjobs`
--
ALTER TABLE `tbjobs`
  ADD CONSTRAINT `departmentname_fk_jobs` FOREIGN KEY (`departmentname`) REFERENCES `tbdepartment` (`deptname`);

--
-- Constraints for table `tbstudentaccount`
--
ALTER TABLE `tbstudentaccount`
  ADD CONSTRAINT `studid_fk_studentaccount` FOREIGN KEY (`studid`) REFERENCES `tb_studinfo` (`studid`);

--
-- Constraints for table `tbviolationreport`
--
ALTER TABLE `tbviolationreport`
  ADD CONSTRAINT `empid_fk_violationreport` FOREIGN KEY (`empid`) REFERENCES `tbempinfo` (`empid`),
  ADD CONSTRAINT `studid_fk_violationreport` FOREIGN KEY (`studid`) REFERENCES `tb_studinfo` (`studid`),
  ADD CONSTRAINT `violationtypeid_fk_violationreport` FOREIGN KEY (`violationtypeid`) REFERENCES `tbviolationtypes` (`violationtypeid`);

--
-- Constraints for table `tb_studinfo`
--
ALTER TABLE `tb_studinfo`
  ADD CONSTRAINT `course_fk_studinfo` FOREIGN KEY (`course`) REFERENCES `tbstudentdepartment` (`course`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
