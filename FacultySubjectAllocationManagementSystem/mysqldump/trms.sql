-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 01:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trms`
--
DROP DATABASE trms;
CREATE DATABASE trms;
-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) AUTO_INCREMENT PRIMARY KEY ,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555556, 'adminuser@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-04 06:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY ,
  `DepartmentName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldepartment`
--

INSERT INTO `tbldepartment` (`ID`, `DepartmentName`) VALUES
(1, 'Computer Science'),
(2, 'Information Science');

-- --------------------------------------------------------

--
-- Table structure for table `tblhod`
--

CREATE TABLE `tblhod` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY ,
  `Name` varchar(64) DEFAULT NULL,
  `DeptId` int(11) DEFAULT NULL REFERENCES tbldepartment(ID),
  `UserName` varchar(64) DEFAULT NULL,
  `Password` varchar(64) DEFAULT NULL,
  `Picture` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `Email` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Qualifications` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `Address` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `TeacherSub` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `JoiningDate` varchar(120) CHARACTER SET latin1 DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblhod`
--

INSERT INTO `tblhod` (`ID`, `Name`, `DeptId`, `UserName`, `Password`, `Picture`, `Email`, `MobileNumber`, `Qualifications`, `Address`, `TeacherSub`, `JoiningDate`, `RegDate`) VALUES
(1, 'Nithya B', 1, 'teja', 'fce63142cacdb8b04ce6685c5e5538c0', NULL, 'nithyabussety16@gmail.com', 7019400522, 'M.Tech(IT)', 'Ballari', 'Chemistry', '2019-10-09', '2020-05-22 13:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblpriority`
--

CREATE TABLE `tblpriority` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY ,
  `FacultyId` int(11) DEFAULT NULL REFERENCES tblteacher(ID),
  `Priority` int(10) DEFAULT NULL,
  `SubId` int(10) DEFAULT NULL REFERENCES tblsubjects(ID),
  `Alloted` bool DEFAULT false
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpriority`
--

INSERT INTO `tblpriority` (`ID`, `FacultyId`, `Priority`, `SubId`,`Alloted`) VALUES
(1, 1, 3, NULL, false);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `ID` int(11) AUTO_INCREMENT PRIMARY KEY ,
  `SemName` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`ID`, `SemName`) VALUES
(1, 'Semester1'),
(2, 'Semester2'),
(3, 'Semester3'),
(4, 'Semester4'),
(5, 'Semester5'),
(6, 'Semester6'),
(7, 'Semester7'),
(8, 'Semester8');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
  `Subject` varchar(120) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `SemId` int(11) DEFAULT NULL  REFERENCES tblsemester(ID),
  `DeptId` int(11) DEFAULT NULL  REFERENCES tbldepartment(ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`ID`, `Subject`, `CreationDate`, `SemId`,`DeptId`) VALUES
(1, 'Mathmetics', '2019-10-07 06:11:06', 1,1),
(2, 'Physics', '2019-10-07 06:11:19', 1,2),
(3, 'Chemistry', '2019-10-07 06:11:32', 2,1),
(4, 'Biology', '2019-10-07 06:11:41', 2,2),
(5, 'Hindi', '2019-10-07 06:11:49', 1,1),
(6, 'English', '2019-10-07 06:11:56', 2,2),
(7, 'Science', '2019-10-07 06:12:06', 2,1),
(8, 'Social Science', '2019-10-07 06:12:19', 2,1),
(9, 'Accounts', '2019-10-07 06:12:32', 3,2),
(10, 'Arts', '2019-10-07 06:12:44', 3,1),
(11, 'Musics', '2019-10-07 06:12:53', 4,2),
(12, 'Sanskrit', '2019-10-07 06:13:08', 4,1),
(13, 'Operating System (OS)', '2019-10-13 19:00:22', 5,2);

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `ID` int(10) AUTO_INCREMENT PRIMARY KEY,
  `Name` varchar(120) DEFAULT NULL,
  `Picture` varchar(200) NOT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Qualifications` varchar(120) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `TeacherSub` varchar(120) DEFAULT NULL,
  `JoiningDate` varchar(120) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UserName` varchar(64) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `DeptId` int(10) DEFAULT NULL REFERENCES tbldepartment(ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`ID`, `Name`, `Picture`, `Email`, `MobileNumber`, `Qualifications`, `Address`, `TeacherSub`, `JoiningDate`, `RegDate`, `UserName`, `Password`, `DeptId`) VALUES
(1, 'Abir Singh ', '7fdc1a630c238af0815181f9faa190f51570433828.jpg', 'abir@gmail.com', 4654654345, 'M.Tech(IT)', 'Flat No=646, Mayur Vihar Phase 1 New Delhi', 'Mathmetics', '2019-10-07', '2019-10-07 07:37:08', 'abir', '9ab209d66a9bf2250d7f56cc4b3b125d', 1),
(2, 'Gyan Tripathi', 'e9db84d0e11b5c26723e9951e4f7204b1570445433.jpg', 'gyan@gmail.com', 8989898988, 'B.TECH', 'H.No=B 3/4 Shivala Varanasi 221001', 'Accounts', '2019-10-02', '2019-10-07 07:45:52', '', '', 1),
(3, 'Nikhil Singh', '2d99ae9e904f880eef8feb4e61882b791570445365.jpg', 'nik@gmail.com', 1213123213, 'B.ED(Commerce)', 'JK block H.no 3156 Laxmi Nagar', 'Arts', '2019-10-01', '2019-10-07 07:47:20', '', '', 2),
(4, 'Anuj Kumar', '3640809ea9da2fb83a3f8ac12432d8551570993351.png', 'phpgurukulofficial@gmail.com', 9864723742, 'B.Tech, MBA', 'New Delhi India 110091', 'Operating System (OS)', '2019-10-01', '2019-10-13 19:01:45', '', '',2),
(5, 'Nithya B', '234ec1abaf791d9eaf5248c3e02a5fce1589876230.jpg', 'nithyabussety16@gmail.com', 7019400522, 'asst, Professor', 'Millerpet, ballari 583101', 'Mathmetics', '2020-01-17', '2020-05-19 08:17:10', 'nithya', 'ed2c24a8577c6ffa2661410a6d6f27d2', 1);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
