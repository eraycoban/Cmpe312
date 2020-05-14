-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 12:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emu_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`) VALUES
(1, 50000054);

-- --------------------------------------------------------

--
-- Table structure for table `advises`
--

CREATE TABLE `advises` (
  `i_id` int(8) NOT NULL,
  `s_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advises`
--

INSERT INTO `advises` (`i_id`, `s_id`) VALUES
(21345678, 17450019),
(23456789, 16000070),
(23456789, 17700283);

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`id`, `user_id`) VALUES
(1, 20000051);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(5) NOT NULL,
  `group_id` int(5) NOT NULL,
  `course_code` varchar(25) DEFAULT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `credit_hours` int(2) DEFAULT NULL,
  `lecture_hrs` int(2) DEFAULT NULL,
  `labs` int(2) DEFAULT NULL,
  `tutorial` int(2) DEFAULT NULL,
  `course_info` varchar(255) DEFAULT NULL,
  `department` varchar(25) DEFAULT NULL,
  `sem_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `group_id`, `course_code`, `course_name`, `credit_hours`, `lecture_hrs`, `labs`, `tutorial`, `course_info`, `department`, `sem_id`) VALUES
(211, 1, 'CMSE 211', 'Introduction', 4, 4, 1, 0, 'Introduction to fundamentals', 'Software Engineering', 2),
(211, 2, 'CMSE 211', 'Introduction', 4, 4, 1, 0, 'Introduction to fundamentals', 'Software Engineering', 2),
(344, 1, 'CMPE 344', 'Computer Networks', 4, 4, 1, 0, 'Basic concepts of data tr', 'Computer Engineering', 0),
(344, 2, 'CMPE 344', 'Computer Networks', 4, 4, 1, 0, 'Basic concepts of data tr', 'Computer Engineering', 0),
(1101, 1, 'MGMT101', 'Introduction to Business - I ', 3, 3, 0, 0, 'Understanding the business system. Understanding the global context of business. Conducting business ethically and responsibly. Entrepreneurship and the small business. Managing the business enterprise. Organizing the business enterprise.', 'Business Administration', 1),
(1102, 1, 'MGMT102', ' Introduction to Business - II ', 3, 3, 0, 0, 'A basic introduction to business matters. Topics include: motivation and leadership; human resources and labor relations; marketing, information systems; money and banking; and securities and investments.', 'Business Administration', 2),
(1171, 1, 'MGMT171', 'Introduction to Information Technology - I ', 3, 3, 1, 1, 'Introduction to information technology and its significance for business, economics, and society. Understanding how computers work, introducing fundamental concepts relating to hardware, software, central processing unit, input and output, storage, networ', 'Business Administration', 1),
(25711, 1, 'CMPE 107', 'Foundations of Computer Engineering', 4, 4, 1, 0, 'Design of computer algorithms with pseudo-code to solve problems, analyze engineering related\r\nproblems using computer. Basic elements of a high level computer programming language: Data types,\r\nconstants and variables, arithmetic and logical operators an', 'Computer Engineering', 1),
(25712, 1, 'MATH 163', 'Discrete Mathematics', 3, 3, 0, 1, 'Discrete Mathematics', 'Faculty of Arts & Science', 1),
(25712, 2, 'MATH 163', 'Discrete Mathematics', 3, 3, 0, 1, 'Discrete Mathematics', 'Faculty of Arts & Science', 0),
(25713, 2, 'CMPE 107', 'Foundations of Computer Engineering', 4, 4, 1, 0, 'Design of computer algorithms with pseudo-code to solve problems, analyze engineering related\r\nproblems using computer. Basic elements of a high level computer programming language: Data types,\r\nconstants and variables, arithmetic and logical operators an', 'Computer Engineering', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `faculty_id` int(111) NOT NULL,
  `department_id` int(111) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `department_id`, `department`) VALUES
(1, 1, 1, 'Business Administration'),
(2, 1, 2, 'Political Science and International Relations'),
(3, 1, 3, 'Economics'),
(4, 1, 4, 'Banking and Finance'),
(9, 2, 5, 'Civil Engineering'),
(10, 2, 6, 'Computer Engineering'),
(11, 2, 7, 'Electrical and Electronic Engineering'),
(12, 2, 8, 'Industrial Engineering'),
(13, 2, 9, 'Mechanical Engineering'),
(14, 3, 10, 'Mathematics'),
(15, 3, 11, 'Arts, Humanities and Social Sciences'),
(16, 3, 12, 'Biological Sciences'),
(17, 3, 13, 'Translation and Interpretation'),
(18, 3, 14, 'Psychology'),
(19, 3, 15, 'Turkish Language and Literature'),
(20, 3, 16, 'Physics'),
(21, 3, 17, 'Chemistry'),
(22, 4, 18, 'Law'),
(23, 5, 19, 'Architecture'),
(24, 5, 20, 'Interior Architecture'),
(25, 6, 21, 'Cinema and Television'),
(26, 6, 22, 'New Media and Journalism'),
(27, 6, 23, 'Visual Arts and Visual Communication Design'),
(28, 6, 24, 'Public Relations and Advertising'),
(29, 7, 25, 'Computer Education and Instructional Technology'),
(30, 7, 26, 'Elementary Education'),
(31, 7, 27, 'Foreign Language Education'),
(32, 7, 28, 'Mathematics and Science Education'),
(33, 7, 29, 'Educational Sciences'),
(34, 7, 30, 'Special Education'),
(35, 7, 31, 'Fine Arts Education'),
(36, 7, 32, 'Turkish and Social Sciences Education\r\n'),
(37, 8, 33, 'Nutrition and Dietetics'),
(38, 8, 34, 'Physiotherapy and Rehabilitation'),
(39, 8, 35, 'Nursing'),
(40, 8, 36, 'Health Management'),
(41, 8, 37, 'Sports Sciences'),
(42, 9, 38, 'Pharmacy'),
(43, 10, 39, 'Medicine'),
(44, 11, 40, 'Dentistry'),
(45, 12, 41, 'Tourism');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `faculty_id` int(111) NOT NULL,
  `faculty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_id`, `faculty`) VALUES
(1, 1, 'Faculty of Business and Economics'),
(2, 2, 'Faculty of Engineering'),
(3, 3, 'Faculty of Arts and Sciences'),
(4, 4, 'Faculty of Law'),
(5, 5, 'Faculty of Architecture'),
(6, 6, 'Faculty of Communication and Media Studies'),
(7, 7, 'Faculty of Education'),
(8, 8, 'Faculty of Health Sciences'),
(9, 9, 'Faculty of Pharmacy'),
(10, 10, 'Faculty of Medicine'),
(11, 11, 'Faculty of Dentistry'),
(12, 12, 'Faculty of Tourism');

-- --------------------------------------------------------

--
-- Table structure for table `groupst`
--

CREATE TABLE `groupst` (
  `ref` int(5) NOT NULL,
  `group_id` int(5) DEFAULT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `i_id` int(8) DEFAULT NULL,
  `days` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `hrs` int(5) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupst`
--

INSERT INTO `groupst` (`ref`, `group_id`, `course_code`, `i_id`, `days`, `time`, `hrs`) VALUES
(1, 1, 'CMPE 344', 23456789, 'Monday, Tuesday, Wednesday', '08:30-10:30, 08:30-10:30, 12:30-14:30 ', 2),
(2, 2, 'CMPE 344', 23456789, 'Tuesday, Wednesday, Thursday', '12:30-14:30, 08:30-10:30, 12:30-14:30', 2),
(3, 1, 'CMSE 211', 21345678, 'Tueday, Wednesday, Friday', '08:30-10:30, 08:30-10:30, 16:30-18:30', 2),
(4, 1, 'MATH 163', 209876543, 'Tuesday, Thursday', '10:30-12:30, 10:30-12:30', 2),
(5, 2, 'MATH 163', 200876543, 'Wednesday, Friday', '08:30-10:30, 08:30-10:30', 2),
(6, 2, 'CMSE 211', 21345678, 'Monday, Wednesday, Thursday', '08:30-10:30, 08:30-10:30, 12:30-14:30', 2),
(7, 1, 'CMPE 107', 22223333, 'Monday, Wednesday, Friday', '08:30-10:30, 08:30-10:30, 12:30-14:30', 2);

-- --------------------------------------------------------

--
-- Table structure for table `group_schedule`
--

CREATE TABLE `group_schedule` (
  `schedule_id` int(5) NOT NULL,
  `period` varchar(50) DEFAULT NULL,
  `start_time` varchar(50) DEFAULT NULL,
  `end_time` varchar(50) DEFAULT NULL,
  `course_code` varchar(25) DEFAULT NULL,
  `dayName` varchar(25) DEFAULT NULL,
  `class` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_schedule`
--

INSERT INTO `group_schedule` (`schedule_id`, `period`, `start_time`, `end_time`, `course_code`, `dayName`, `class`) VALUES
(4, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(5, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(6, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(7, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(8, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(9, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(10, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(11, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(12, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(13, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(14, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(15, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(16, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(17, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(18, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(19, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(20, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(21, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(22, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(23, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(24, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(25, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(26, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(27, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(28, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(29, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(30, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(31, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127'),
(32, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Tuesday', 'CMPE 127'),
(33, '10:30-12:30', '10:30', '12:30', 'MATH 163', 'Thursday', 'CMPE 127');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `i_id` int(8) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`i_id`, `name`, `department`, `role`, `email`) VALUES
(21345678, 'Alexander Chefranov', 'Software Engineering', 'Academic Instructor', 'alexanderchefranov@emu.edu.tr'),
(22223333, 'Marifi Guler', 'Computer Engineering', 'Instructor', 'marifiguler@emu.edu.tr'),
(23456789, 'Mehmet Bodur', 'Computer Engineering', 'Academic Instructor', 'mehmetbodur@emu.edu.tr'),
(200876543, 'Second Math Instructor', 'Arts and Science', 'Instructor', 'example@email.com'),
(209876543, 'Math Instructor', 'Arts and Science', 'Instructor', 'math@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `department_id` int(111) NOT NULL,
  `program_id` int(111) NOT NULL,
  `program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `department_id`, `program_id`, `program`) VALUES
(1, 1, 1, 'Business Administration (Turkish)'),
(2, 1, 2, 'Business Administration'),
(3, 1, 3, 'Public Administration'),
(4, 2, 4, 'International Relations'),
(5, 2, 5, 'Political Science'),
(6, 3, 6, 'Economics'),
(7, 5, 7, 'Civil Engineering (Turkish)'),
(8, 5, 8, 'Civil Engineering'),
(9, 6, 9, 'Computer Engineering (Turkish)'),
(10, 6, 10, 'Computer Engineering - Information System Engineering Double Major'),
(11, 6, 11, 'Computer Engineering - Software Engineering Double Major'),
(12, 6, 12, 'Computer Engineering'),
(13, 6, 13, 'Information System Engineering - Computer Engineering Double Major'),
(14, 6, 14, 'Software Engineering - Computer Engineering Double Major'),
(15, 6, 15, 'Software Engineering'),
(16, 7, 16, 'Biomedical Engineering'),
(17, 7, 17, 'Computer Engineering - Information System Engineering Double Major'),
(18, 7, 18, 'Electrical and Electronic Engineering - Information Systems Engineering Double Major'),
(19, 7, 19, 'Electrical and Electronic Engineering - Mechatronics Engineering Double Major'),
(20, 7, 20, 'Electrical and Electronic Engineering'),
(21, 7, 21, 'Information System Engineering - Computer Engineering Double Major'),
(22, 7, 22, 'Information Systems Engineering - Electrical and Electronic Engineering Double Major'),
(23, 7, 23, 'Information Systems Engineering'),
(24, 8, 24, 'Industrial Engineering - Business Administration Double Major'),
(25, 8, 25, 'Industrial Engineering - Mechanical Engineering Double Major'),
(26, 8, 26, 'Industrial Engineering'),
(27, 8, 27, 'Management Engineering'),
(28, 8, 28, 'Mechanical Engineering - Industrial Engineering Double Major'),
(29, 9, 29, 'Electrical and Electronic Engineering - Mechatronics Engineering Double Major'),
(30, 9, 30, 'Industrial Engineering - Mechanical Engineering Double Major'),
(31, 9, 31, 'Mechanical Engineering - Industrial Engineering Double Major'),
(32, 9, 32, 'Mechanical Engineering'),
(33, 9, 33, 'Mechatronics Engineering'),
(34, 10, 34, 'Actuarial Science - Banking and Finance Double Major'),
(35, 10, 35, 'Actuarial Science - Mathematics and Computer Science Double Major'),
(36, 10, 36, 'Actuarial Science'),
(37, 10, 37, 'Mathematics and Computer Science - Actuarial Science Double Major'),
(38, 10, 38, 'Mathematics and Computer Science'),
(39, 12, 39, 'Molecular Biology and Genetics'),
(40, 13, 40, 'Translation and Interpretation'),
(41, 14, 41, 'Psychology (Turkish)'),
(42, 14, 42, 'Psychology'),
(43, 15, 43, 'Turkish Language and Literature (Turkish)'),
(44, 18, 44, 'Law (Turkish)'),
(45, 19, 45, 'Architecture'),
(46, 20, 46, 'Interior Architecture (Turkish)'),
(47, 20, 47, 'Interior Architecture'),
(48, 21, 48, 'Tv and Film Studies (Turkish)'),
(49, 21, 49, 'Tv and Film Studies'),
(50, 22, 50, 'New Media and Journalism (Turkish)'),
(51, 22, 51, 'New Media and Journalism'),
(52, 23, 52, 'Animation and Game Design'),
(53, 23, 53, 'Visual Arts and Visual Communication Design'),
(54, 24, 54, 'Public Relations and Advertising (Turkish)'),
(55, 24, 55, 'Public Relations and Advertising'),
(56, 25, 56, 'Computer Education and Instructional Technology (Turkish)'),
(57, 26, 57, 'Elementary School Teacher Education (Turkish)'),
(58, 26, 58, 'Pre-School Teacher Education (Turkish)'),
(59, 27, 59, 'English Language Teaching (Joint Program with Gazi University) *'),
(60, 27, 60, 'English Language Teaching'),
(61, 28, 61, 'Elementary School Mathematics Teacher Education (Turkish)'),
(62, 28, 62, 'Secondary School Mathematics Teacher Education (Turkish) *'),
(63, 29, 63, 'Guidance and Psychological Counseling (Turkish)'),
(64, 29, 64, 'Guidance and Psychological Counseling'),
(65, 30, 65, 'Special Education Teaching (Turkish)'),
(66, 30, 66, 'Teaching the Mentally Handicapped (Turkish) *'),
(67, 31, 67, 'Music Teaching (Turkish)'),
(68, 32, 68, 'Social Sciences Teacher Education (Turkish)'),
(69, 32, 69, 'Turkish Language and Literature Teacher Education (Turkish) *'),
(70, 32, 70, 'Turkish Language Teaching'),
(71, 33, 71, 'Nutrition & Dietetics (Turkish)'),
(72, 33, 72, 'Nutrition & Dietetics'),
(73, 34, 73, 'Physiotherapy and Rehabilitation (Turkish)'),
(74, 34, 74, 'Physiotherapy and Rehabilitation'),
(75, 35, 75, 'Nursing (English)'),
(76, 35, 76, 'Nursing (Turkish)'),
(77, 36, 77, 'Health Management (Turkish)'),
(78, 37, 78, 'Sports Sciences (Turkish)'),
(79, 38, 79, 'Pharmacy (B.Pharm.)'),
(80, 38, 80, 'Pharmacy (Pharm.D.) (Joint Program with Kerman University of Medical Sciences)'),
(81, 38, 81, 'Pharmacy (Pharm.D.)'),
(82, 39, 82, 'Medicine (Joint Program with Iran University of Medical Sciences)'),
(83, 39, 83, 'Medicine (Joint Program with Marmara University, Turkey)'),
(84, 40, 84, 'Dental Medicine (Joint Program with IUMS/Iran)'),
(85, 40, 85, 'Dental Medicine (Joint program with University of Health Sciences/Turkey)');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(8) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `GPA` float(3,2) DEFAULT NULL,
  `CGPA` float(3,2) DEFAULT NULL,
  `current_sem` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `name`, `surname`, `department`, `GPA`, `CGPA`, `current_sem`) VALUES
(16000070, 'Berkan', 'Ergil', 'Computer Engineering', 4.00, 4.00, 7),
(17450019, 'Mehmet', 'Tacyildiz', 'Computer Engineering', 4.00, 4.00, 6),
(17700283, 'Amina', ' Ait', 'Computer Engineering', 3.30, 3.30, 6);

-- --------------------------------------------------------

--
-- Table structure for table `takes`
--

CREATE TABLE `takes` (
  `s_id` int(8) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `group_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `takes`
--

INSERT INTO `takes` (`s_id`, `course_code`, `group_id`) VALUES
(17700283, 'CMPE 344', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(16) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `password` int(15) DEFAULT NULL,
  `phone_number` int(20) NOT NULL,
  `country` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `surname`, `password`, `phone_number`, `country`, `email`, `role`, `faculty`, `department`, `program`) VALUES
(1, 17700283, 'Amina', 'Ait', 1234, 533874573, 'Morocco', 'amina@email.com', 'Student', 'Engineering', 'Computer Engineering', 'Computer Engineering (English)'),
(2, 17450019, 'Mehmet', 'Tacyildiz', 1234, 0, '', '', '', '', '', ''),
(3, 16000070, 'Berkan', 'Ergil', NULL, 0, '', '', '', '', '', ''),
(4, 23456789, 'mehmetb', '', 1234, 0, '', '', '', '', '', ''),
(5, 52345678, 'Admin', 'McAd', 1234, 2147483647, 'kktc', 'admin@email.com', 'A', '-', '-', '-'),
(6, 41235678, 'Vice ', 'Dean', 1234, 533909090, 'Cyprus', 'example1@email.com', 'Vice Dean', 'CMPE', 'Engineering', 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `vice_chairs`
--

CREATE TABLE `vice_chairs` (
  `id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vice_chairs`
--

INSERT INTO `vice_chairs` (`id`, `user_id`) VALUES
(1, 30000052);

-- --------------------------------------------------------

--
-- Table structure for table `vice_deans`
--

CREATE TABLE `vice_deans` (
  `id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vice_deans`
--

INSERT INTO `vice_deans` (`id`, `user_id`) VALUES
(1, 40000053);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advises`
--
ALTER TABLE `advises`
  ADD PRIMARY KEY (`i_id`,`s_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`,`group_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupst`
--
ALTER TABLE `groupst`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `group_schedule`
--
ALTER TABLE `group_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`i_id`),
  ADD KEY `i_id` (`i_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `takes`
--
ALTER TABLE `takes`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `vice_chairs`
--
ALTER TABLE `vice_chairs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vice_deans`
--
ALTER TABLE `vice_deans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advises`
--
ALTER TABLE `advises`
  MODIFY `i_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23456790;

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25714;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `groupst`
--
ALTER TABLE `groupst`
  MODIFY `ref` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `group_schedule`
--
ALTER TABLE `group_schedule`
  MODIFY `schedule_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `i_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209876544;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17700284;

--
-- AUTO_INCREMENT for table `takes`
--
ALTER TABLE `takes`
  MODIFY `s_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17700284;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vice_chairs`
--
ALTER TABLE `vice_chairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vice_deans`
--
ALTER TABLE `vice_deans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advises`
--
ALTER TABLE `advises`
  ADD CONSTRAINT `advises_ibfk_1` FOREIGN KEY (`i_id`) REFERENCES `instructor` (`i_id`),
  ADD CONSTRAINT `advises_ibfk_2` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`);

--
-- Constraints for table `groupst`
--
ALTER TABLE `groupst`
  ADD CONSTRAINT `groupst_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `course` (`group_id`),
  ADD CONSTRAINT `groupst_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`);

--
-- Constraints for table `takes`
--
ALTER TABLE `takes`
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `groupst` (`course_code`),
  ADD CONSTRAINT `takes_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groupst` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
