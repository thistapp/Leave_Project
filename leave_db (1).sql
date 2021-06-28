-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 10:09 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leave_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `Em_ID` int(11) NOT NULL,
  `Em_Number` varchar(150) COLLATE utf8_bin NOT NULL,
  `Em_Fname` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Lname` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Nickname` varchar(150) COLLATE utf8_bin NOT NULL,
  `Em_Age` varchar(50) COLLATE utf8_bin NOT NULL,
  `Em_Blood` varchar(3) COLLATE utf8_bin NOT NULL,
  `Em_Gender` varchar(3) COLLATE utf8_bin NOT NULL,
  `Em_Address` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Postal_Code` varchar(15) COLLATE utf8_bin NOT NULL,
  `Em_Mail` varchar(155) COLLATE utf8_bin NOT NULL,
  `Em_Tel` varchar(11) COLLATE utf8_bin NOT NULL,
  `Em_Salary` int(155) NOT NULL,
  `Em_Login_ID` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Login_PASSWORD` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Image` varchar(255) COLLATE utf8_bin NOT NULL,
  `Em_Startwork` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Em_Pass_Status` int(3) NOT NULL,
  `Job_Type_ID` int(20) NOT NULL,
  `Active_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Delete_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Em_Birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`Em_ID`, `Em_Number`, `Em_Fname`, `Em_Lname`, `Em_Nickname`, `Em_Age`, `Em_Blood`, `Em_Gender`, `Em_Address`, `Em_Postal_Code`, `Em_Mail`, `Em_Tel`, `Em_Salary`, `Em_Login_ID`, `Em_Login_PASSWORD`, `Em_Image`, `Em_Startwork`, `Em_Pass_Status`, `Job_Type_ID`, `Active_STATUS`, `Delete_STATUS`, `Em_Birthday`) VALUES
(1, '6', 'นนทก', 'ยักล้างเท้า', '', '102', '', '', '', '', 'nonton@gmail.com', '0215486658', 15000, 'nonton', '1150', '', '2021-06-15 09:00:16', 1, 6, '1', '0', '0000-00-00'),
(2, '1', 'head', 'หัวหน้า', '', '25', '', '', '', '', 'head_pos_1@gmail.com', '0123456789', 25400, 'headpos1', '123456', '', '2021-06-15 09:00:09', 1, 1, '1', '0', '0000-00-00'),
(3, '2', 'head', 'รองหัวหน้า', '', '25', '', '', '', '', 'head_pos_2@gmail.com', '0123456789', 25400, 'headpos2', '123456', '', '2021-06-15 09:00:10', 1, 2, '1', '0', '0000-00-00'),
(4, '3', 'head', 'รองของรองหัวหน้า', '', '25', '', '', '', '', 'head_pos_3@gmail.com', '0123456789', 25400, 'headpos3', '123456', '', '2021-06-15 09:00:12', 1, 3, '1', '0', '0000-00-00'),
(5, '4', 'admin', 'numsuad', '', '50', '', '', '', '', 'admin@gmail.com', '0123456789', 25100, 'admin', '123456', '', '2021-06-15 09:00:14', 1, 4, '1', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `Job_Type_ID` int(100) NOT NULL,
  `Job_Type_Name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Active_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Delete_STATUS` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`Job_Type_ID`, `Job_Type_Name`, `Active_STATUS`, `Delete_STATUS`) VALUES
(1, 'หัวหน้า1', '1', '0'),
(2, 'หัวหน้า2', '1', '0'),
(3, 'หัวหน้า3', '1', '0'),
(4, 'admin', '1', '0'),
(6, 'คนล้างเท้า', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `leave_log`
--

CREATE TABLE `leave_log` (
  `Leave_Log_ID` int(11) NOT NULL,
  `Leave_Type_ID` int(11) NOT NULL,
  `Em_ID` int(11) NOT NULL,
  `Leave_Type_DATE` int(5) NOT NULL,
  `Leave_Log_Count` varchar(20) COLLATE utf8_bin NOT NULL,
  `Leave_Start_Date` date NOT NULL,
  `Leave_End_Date` date NOT NULL,
  `Leave_Start_Time` time NOT NULL,
  `Leave_End_Time` time NOT NULL,
  `Leave_DATETIMES` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Leave_Log_Reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `Leave_Head_1_ID` int(11) NOT NULL,
  `Leave_Head_1_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Leave_Head_1_Reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `Leave_Head_2_ID` int(11) NOT NULL,
  `Leave_Head_2_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Leave_Head_2_Reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `Leave_Head_3_ID` int(11) NOT NULL,
  `Leave_Head_3_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Leave_Head_3_Reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `Leave_Log_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `DELETE_STATUS` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `leave_log`
--

INSERT INTO `leave_log` (`Leave_Log_ID`, `Leave_Type_ID`, `Em_ID`, `Leave_Type_DATE`, `Leave_Log_Count`, `Leave_Start_Date`, `Leave_End_Date`, `Leave_Start_Time`, `Leave_End_Time`, `Leave_DATETIMES`, `Leave_Log_Reason`, `Leave_Head_1_ID`, `Leave_Head_1_STATUS`, `Leave_Head_1_Reason`, `Leave_Head_2_ID`, `Leave_Head_2_STATUS`, `Leave_Head_2_Reason`, `Leave_Head_3_ID`, `Leave_Head_3_STATUS`, `Leave_Head_3_Reason`, `Leave_Log_STATUS`, `DELETE_STATUS`) VALUES
(18, 3, 1, 1, '4', '2021-05-28', '2021-05-31', '00:00:00', '00:00:00', '2021-06-09 09:16:49', 'ewqeqw', 2, '1', '', 3, '1', '', 4, '1', '', '1', '0'),
(19, 2, 1, 1, '23', '2021-06-07', '2021-06-29', '00:00:00', '00:00:00', '2021-06-07 09:01:53', 'ewqewqewqew', 4, '1', '', 0, '', '', 0, '', '', '1', '0'),
(20, 3, 1, 1, '7', '2021-06-07', '2021-06-13', '00:00:00', '00:00:00', '2021-06-09 09:22:48', 'ewqewqewqe', 4, '3', '', 2, '', '', 0, '', '', '3', '0'),
(21, 3, 1, 1, '4', '2021-06-07', '2021-06-10', '00:00:00', '00:00:00', '2021-06-07 08:39:28', 'eqwewq', 2, '', '', 3, '', '', 4, '', '', '2', '0'),
(22, 1, 1, 1, '3', '2021-06-07', '2021-06-09', '00:00:00', '00:00:00', '2021-06-07 08:39:36', 'sdasdasd', 3, '', '', 0, '', '', 0, '', '', '2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `Leave_Type_ID` int(11) NOT NULL,
  `Leave_Type_Name` varchar(255) COLLATE utf8_bin NOT NULL,
  `Leave_Type_Count` int(50) NOT NULL,
  `Active_STATUS` varchar(3) COLLATE utf8_bin NOT NULL,
  `Delete_STATUS` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`Leave_Type_ID`, `Leave_Type_Name`, `Leave_Type_Count`, `Active_STATUS`, `Delete_STATUS`) VALUES
(1, 'test', 15, '1', '0'),
(2, 'test2', 10, '1', '0'),
(3, 'tset3', 13, '1', '0'),
(4, 'weqw', 12, '0', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`Em_ID`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`Job_Type_ID`);

--
-- Indexes for table `leave_log`
--
ALTER TABLE `leave_log`
  ADD PRIMARY KEY (`Leave_Log_ID`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`Leave_Type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `Em_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `Job_Type_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leave_log`
--
ALTER TABLE `leave_log`
  MODIFY `Leave_Log_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `Leave_Type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
