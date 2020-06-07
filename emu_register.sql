-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2020 at 08:21 AM
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
(1, 20000051),
(16, 20000090),
(17, 20000097),
(18, 20000099),
(19, 23456789);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_id` int(5) NOT NULL,
  `group_id` int(5) NOT NULL,
  `group_names` varchar(255) NOT NULL,
  `course_code` varchar(25) DEFAULT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `credit_hours` int(2) DEFAULT NULL,
  `lecture_hrs` int(2) DEFAULT NULL,
  `labs` int(2) DEFAULT NULL,
  `tutorial` int(2) DEFAULT NULL,
  `department` varchar(25) DEFAULT NULL,
  `sem_id` int(5) NOT NULL,
  `program_id` int(5) NOT NULL,
  `group_number` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_elective` int(111) NOT NULL,
  `credit` int(111) NOT NULL,
  `programs` varchar(255) NOT NULL,
  `faculties` varchar(255) NOT NULL,
  `departments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_id`, `group_id`, `group_names`, `course_code`, `course_name`, `credit_hours`, `lecture_hrs`, `labs`, `tutorial`, `department`, `sem_id`, `program_id`, `group_number`, `description`, `is_elective`, `credit`, `programs`, `faculties`, `departments`) VALUES
(1, 35, 1, 'CMPE107-1, CMPE107-2', 'CMPE107', 'Fundamentals of Computer Engineering ', 4, NULL, NULL, NULL, 'Computer Engineering ', 1, 12, '2', 'The basic fundamental course that will teach you how to think as a computer engineer, how to write codes, declare variables, create loops, make some operations andhow to solve problems that you may face.', 0, 0, '', '', ''),
(2, 36, 0, 'MATH163x1, MATH163x2', 'MATH163', 'Discrete Mathematics ', 3, 4, 0, 4, 'Computer Engineering', 1, 12, '2', 'Set theory, functions and relations; introduction to set theory, functions and relations, inductive proofs and recursive definitions. Combinatorics; basic counting rules, permutations, combinations, allocation problems, selection problems, the pigeonhole ', 0, 0, '9, 10, 11, 12', '2, 9', ''),
(3, 37, 0, '', 'ENGL191', 'Communication in English - I ', 3, NULL, NULL, NULL, 'Computer Engineering', 1, 12, '4', 'ENGL191 is a first-semester freshman academic English course. It is designed to help students improve the level of their English to B1+ level, as specified in the Common European Framework of Reference for Languages. The course connects critical thinking ', 0, 0, '9, 10, 11, 12', '2, 9', ''),
(5, 39, 0, '', 'PHYS101', 'Physics - I ', 4, NULL, NULL, NULL, 'Computer Engineering', 1, 12, '4', 'Physical quantities and units. Vector calculus. Kinematics of motion. Newton`s laws of motion and their applications. Work-energy theorem. Impulse and momentum. Rotational kinematics and dynamics. Static equilibrium.', 0, 0, '', '', ''),
(6, 40, 0, '', 'CMPE100', 'Introduction to Profession ', 0, NULL, NULL, NULL, 'Computer Engineering', 1, 12, '1', 'A series of seminars are held in current topics and areas of specialization in Computer Engineering. ', 0, 0, '', '', ''),
(7, 41, 0, '', 'CMPE112', 'Programming Fundamentals', 4, NULL, NULL, NULL, 'Computer Engineering', 2, 12, '2', 'An overview of C programming language, Sequential structure Data types and classes of data, arithmetic operators and expressions, assignment statements, type conversions, simple I/O functions (printf, scanf, fprintf, fscanf, gets, puts, fgets, fputs).', 0, 0, '9, 10, 11, 12', '', '6, 7, 8, 12'),
(8, 42, 0, '', 'ENGL192', 'Communication in English - II', 3, NULL, NULL, NULL, 'Computer Engineering', 2, 12, '4', 'ENGL192 is a second-semester freshman academic English course. It is designed to help students improve the level of their English to B2 level, as specified in the Common European Framework of Reference for Languages.', 0, 0, '', '', ''),
(9, 43, 0, '', 'MATH152', 'Calculus - II ', 4, NULL, NULL, NULL, 'Computer Engineering', 2, 12, '4', 'Vectors in R3. Lines and Planes. Functions of several variables. Limit and continuity. Partial differentiation. Chain rule. Tangent plane.', 0, 0, '', '', ''),
(10, 44, 0, 'PHYS102x1, PHYS102x2, PHYS102x3, PHYS102x4', 'PHYS102', 'Physics - II', 4, NULL, NULL, NULL, 'Computer Engineering', 2, 12, '4', 'Kinetic theory of ideal gases. Equipartition of energy. Heat, heat transfer and heat conduction.', 0, 0, '', '', ''),
(11, 45, 0, '', 'HIST280', 'Atatürk İlkeleri ve İnkilap Tarihi', 2, NULL, NULL, NULL, 'Computer Engineering', 2, 12, '2', 'Tarih', 0, 0, '', '', ''),
(12, 46, 0, 'CMPE223x1, CMPE223x2', 'CMPE223', 'Digital Logic Design ', 4, NULL, NULL, NULL, 'Computer Engineering', 3, 12, '2', 'Binary Systems (Binary Numbers, Octal and Hexadecimal Numbers, Number Base Conversions, Complements, Signed Binary Numbers, Binary Codes, Binary Logic).', 0, 0, '9, 10, 11', '', '6, 7, 8, 12'),
(13, 47, 0, '', 'CMPE231', 'Data Structures ', 4, NULL, NULL, NULL, 'Computer Engineering', 3, 12, '2', 'Data types and basic operations on data structures. Arrays, strings, stacks, queues, linked list structures and tree structures. ', 0, 0, '9, 10, 11', '', '6, 7, 8, 12'),
(14, 48, 0, '', 'CMPE211', 'Object Oriented Programming', 4, NULL, NULL, NULL, 'Computer Engineering', 3, 12, '2', 'Basics of Java programming language. ', 0, 0, '9, 10, 11', '', '6, 7, 8, 12'),
(15, 49, 0, '', 'ENGL201', 'Communication Skills in English III - Technical Re', 3, NULL, NULL, NULL, 'Computer Engineering', 3, 12, '4', 'ENGL 201 is a Communication Skills course for students at the Faculty of Engineering.', 0, 0, '', '', ''),
(16, 50, 0, '', 'MATH241', 'LINEAR ALGEBRA AND ORDINARY DIFFERENTIAL EQUATIONS', 4, NULL, NULL, NULL, 'Computer Engineering', 3, 12, '4', 'Systems of linear equations, Echelon forms. Matrix Algebra, Determinants, and Inverse matrices.', 0, 0, '', '', ''),
(17, 51, 0, '', 'CMPE224', 'Digital Logic Systems', 4, NULL, NULL, NULL, 'Computer Engineering', 4, 12, '1', 'Algorithmic state machines. Asynchronous sequential logic.', 0, 0, '', '', ''),
(18, 52, 0, '', 'CMPE226', 'Electronics for Computer Engineers', 4, NULL, NULL, NULL, 'Computer Engineering', 4, 12, '1', 'Circuits, currents and voltages, power and energy, Kirchoff\'s current and voltage laws.', 0, 0, '', '', '6, 7, 8, 12'),
(19, 53, 0, '', 'CMPE242', 'Operating Systems ', 4, NULL, NULL, NULL, 'Computer Engineering', 4, 12, '2', 'Operating system definition, simple batch systems, multiprogramming, time-sharing, personal computer systems, parallel systems.', 0, 0, '', '', '6, 7, 8, 12'),
(20, 54, 0, '', 'MATH373', 'Numerical Analysis for Engineers', 3, NULL, NULL, NULL, 'Computer Engineering', 4, 12, '4', 'Numerical error. ', 0, 0, '', '', ''),
(21, 55, 0, '', 'UE-AH01', 'Uni.Elecitive - Arts & Humanities- I', 3, NULL, NULL, NULL, 'Computer Engineering', 4, 12, '1', 'Uni. Elective - Art & Humanities - II', 1, 0, '', '', ''),
(22, 56, 0, '', 'CMPE325', 'Computer Architecture and Organization', 4, NULL, NULL, NULL, 'Computer Engineering', 5, 12, '1', 'Pipelining and enhancing performance with pipelining.', 0, 0, '', '', ''),
(23, 57, 0, '', 'CMPE353', 'Database Management Systems', 4, NULL, NULL, NULL, 'Computer Engineering', 5, 0, '1', 'Database SQL language.', 0, 0, '', '', ''),
(24, 58, 0, '', 'CMPE371', 'Analysis of Algorithms', 4, NULL, NULL, NULL, 'Computer Engineering', 5, 12, '2', 'Design, analysis and representation of algorithms.', 0, 0, '', '', ''),
(25, 59, 0, '', 'CMPE321', 'Signals and Systems for Computer Engineers', 4, NULL, NULL, NULL, 'Computer Engineering', 5, 12, '1', 'Fundamental concepts of signals and systems for computer engineers with focus on discrete-time systems. Sinusoids, complex numbers, spectrum representation, sampling, frequency response, filters, and the z-Transform.', 0, 0, '', '', ''),
(26, 60, 0, '', 'MATH322', 'Probability and Statistical Methods', 3, NULL, NULL, NULL, 'Computer Engineering', 5, 12, '4', 'Introduction to probability and statistics. ', 0, 0, '', '', ''),
(26, 62, 0, '', 'CMPE320', 'High End Embedded Systems ', 4, NULL, NULL, NULL, 'Computer Engineering', 6, 12, '1', 'High End Embedded Systems ', 0, 0, '', '', ''),
(27, 63, 0, '', 'CMPE344', 'Computer Networks ', 4, NULL, NULL, NULL, 'Computer Engineering', 6, 12, '2', 'Basic concepts of data transmission. ', 0, 0, '', '', ''),
(28, 64, 0, '', 'CMPE342', 'Client/Server Programming', 4, NULL, NULL, NULL, 'Computer Engineering', 6, 12, '1', 'Client/Server Programming', 0, 0, '', '', ''),
(29, 65, 0, '', 'CMPE312', 'Software Engineering', 4, NULL, NULL, NULL, 'Computer Engineering', 6, 12, '1', 'Software Engineering', 0, 0, '', '', ''),
(30, 66, 0, '', 'UE-AH02', 'Uni.Elecitive - Arts & Humanities - II', 4, NULL, NULL, NULL, 'Computer Engineering', 6, 12, '1', 'Uni.Elecitive - Arts & Humanities - II', 1, 0, '', '', ''),
(31, 67, 0, '', 'CMPE400', 'Summer Training', 0, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '1', 'As a part of the fulfilment of the graduation requirements, all students must complete 40 work days of summer training after the second and/or third year, during summer vacations.', 0, 0, '', '', ''),
(32, 68, 0, '', 'CMPE455', 'Security of Computer System and Networks', 4, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '2', 'Security of Computer System and Networks', 0, 0, '', '', ''),
(33, 69, 0, '', 'AE01', 'Area Elective I', 3, 4, NULL, NULL, 'Computer Engineering', 7, 12, '1', 'Area Elective I', 1, 0, '', '', ''),
(34, 70, 0, '', 'AE02', 'Area Elective II', 3, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '1', 'Area Elective II', 1, 0, '', '', ''),
(35, 71, 0, '', 'CMPE471', 'Automata Theory ', 4, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '1', 'Mathematical preliminaries and basic concepts. Strings, Languages and Grammars. ', 0, 0, '', '', ''),
(36, 72, 0, '', 'CMPE405', 'Graduation Project - I/II', 1, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '1', 'Graduation Project - I/II', 0, 0, '', '', ''),
(37, 73, 0, '', 'IENG355', 'Ethics in Engineering ', 3, NULL, NULL, NULL, 'Computer Engineering', 7, 12, '2', 'This course is designed to introduce moral rights and responsibilities of engineers in relation to society, employers, colleagues and clients.', 0, 0, '', '', ''),
(38, 74, 0, '', 'CMPE410', 'Principles of Programming Languages', 4, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '2', 'Principles of Programming Languages', 0, 0, '', '', ''),
(39, 75, 0, '', 'CMPE412', 'Software Engineering', 4, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '1', 'The software life cycle and the phases in software development: Project scheduling, feasibility study, analysis, specification, design, implementation, testing, quality assurance, documentation, maintenance.', 0, 0, '', '', ''),
(40, 76, 0, '', 'AE03', 'Area Elective III ', 4, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '1', 'Area Elective III ', 1, 0, '', '', ''),
(41, 77, 0, '', 'UE-AH03', 'Uni. Elective - Art & Humanities - III', 3, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '1', 'Uni. Elective - Art & Humanities - III', 1, 0, '', '', ''),
(42, 78, 0, '', 'UE-AH04', 'Uni. Elective - Art & Humanities - IV', 3, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '1', 'Uni. Elective - Art & Humanities - IV', 1, 0, '', '', ''),
(43, 79, 0, '', 'CMPE406', 'Graduation Project - II', 3, NULL, NULL, NULL, 'Computer Engineering', 8, 12, '1', 'Graduation Project - II', 0, 0, '', '', ''),
(0, 25717, 0, '', 'MATH151', 'Calculus - I', 3, NULL, NULL, NULL, 'Computer Engineering', 1, 12, '2', '', 0, 0, '', '', ''),
(0, 25718, 0, 'CMPE000-1', 'CMPE000', 'Zero', NULL, NULL, NULL, NULL, NULL, 2, 0, '', 'descr', 0, 2, '12', '2', '6'),
(0, 25719, 0, 'CMPE000-1', 'CMPE000', 'Zero', NULL, NULL, NULL, NULL, NULL, 2, 0, '', 'descr', 0, 2, '12', '2', '6'),
(0, 25720, 0, 'CMPE000-1', 'CMPE000', 'Zero', NULL, NULL, NULL, NULL, NULL, 2, 0, '', 'descr', 0, 2, '12', '2', '6');

-- --------------------------------------------------------

--
-- Table structure for table `course_group`
--

CREATE TABLE `course_group` (
  `ref` int(5) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `group_names` varchar(255) NOT NULL,
  `group_id` int(5) DEFAULT NULL,
  `i_id` int(8) DEFAULT NULL,
  `instructor_name` varchar(255) NOT NULL,
  `quota` int(5) DEFAULT NULL,
  `quota_left` int(5) DEFAULT NULL,
  `clash` int(5) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `classroom` varchar(255) DEFAULT NULL,
  `lecture_days` varchar(255) NOT NULL,
  `lecture_classes` varchar(255) NOT NULL,
  `lecture_hours` varchar(255) NOT NULL,
  `is_lab` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_group`
--

INSERT INTO `course_group` (`ref`, `course_code`, `group_names`, `group_id`, `i_id`, `instructor_name`, `quota`, `quota_left`, `clash`, `period`, `classroom`, `lecture_days`, `lecture_classes`, `lecture_hours`, `is_lab`) VALUES
(1, 'MATH163', 'MATH163x1', 1, 209876543, 'Math Instructor', 30, 26, NULL, '00, 10, 42, 52', 'AS G14, AS 414, CLA 11, CLA 11', '', '', '', ''),
(2, 'MATH163', 'MATH163x2', 2, 200876543, 'Second Math Instructor', 30, 29, NULL, '11, 16, 14, 19', 'CLA 13, CLA 13, CLA 13, CLA 13', '', '', '', ''),
(3, 'CMPE223', 'CMPE223x1', 1, 20202020, 'Adnan Acan', 30, -5, NULL, '41, 51, 02, 12, 42, 52', 'CMPE127, CMPE127, CMPE126, CMPE126, CMPE237, CMPE237', '', '', '', ''),
(4, 'CMPE223', 'CMPE223x2', 2, 22223333, 'Marifi Guler', 15, 11, NULL, '00, 10, 21, 31, 44, 54', 'CMPE033, CMPE033, CMPE134, CMPE134, CMPE036, CMPE036 ', '', '', '', ''),
(5, 'PHYS102', 'PHYS102x1', 1, 20192019, 'Physics Instructor', 60, 60, NULL, '02, 12, 04, 14, 23, 33', 'AS A, AS A, AS G11, AS G11, CLA 13, CLA 13', '', '', '', ''),
(6, 'PHYS102', 'PHYS102x2', 2, 20182018, 'Second Physics Instructor', 60, 60, NULL, '40, 50, 22, 32, 03, 13', 'ASG14, ASG14, CLA11, CLA11, CLA12, CLA12', '', '', '', ''),
(7, 'PHYS102', 'PHYS102x3', 3, 20172017, 'Third Physics Instructor', 60, 60, NULL, '41, 51, 23, 33, 24, 34', 'ASG14, ASG14, CLA11, CLA11, CLA12, CLA12', '', '', '', ''),
(8, 'PHYS102', 'PHYS102x4', 4, 20162016, 'Fourth Physics Instructor', 60, 60, NULL, '03, 13, 04, 14, 60, 70', 'ASxx, ASxx, CLAxx, CLAxx, CLAxx, CLAxx', '', '', '', ''),
(9, NULL, 'CMPE000-1', NULL, 23456789, '', 60, 60, NULL, '00', NULL, 'monday', 'CMPE306', '08:30-09:20', '0');

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
(20162016, 'Fourth Physics Instructor', NULL, 'Instructor', 'physics4@gmail.com'),
(20172017, 'Third Physics Instructor', NULL, 'Instructor', 'physics3@gmail.com'),
(20182018, 'Second Physics Instructor', NULL, 'Instructor', 'physics2@gmail.com'),
(20192019, 'Physics Instructor', NULL, 'Instructor', 'physics@gmail.com'),
(20202020, 'Adnan Acan', 'Computer Engineering', 'Instructor', 'profacan@email.com'),
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
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `s_id` int(8) NOT NULL,
  `periods` varchar(255) DEFAULT NULL,
  `classroom` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `confirmed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`s_id`, `periods`, `classroom`, `course_code`, `confirmed`) VALUES
(16000070, NULL, '', '', 1),
(17450019, NULL, '', '', 1),
(17700283, '       00, 01, 02, 03, 04', '           cla, cla, cla, cla, cla', 'cc, cc, cc, cc, cc', 0);

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
  `current_sem` int(5) NOT NULL,
  `advisor_id` int(111) DEFAULT NULL,
  `reg_status` int(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `name`, `surname`, `department`, `GPA`, `CGPA`, `current_sem`, `advisor_id`, `reg_status`) VALUES
(10000078, NULL, '', NULL, NULL, NULL, 0, 20000090, 0),
(10000084, NULL, '', NULL, NULL, NULL, 0, 20000090, 0),
(10000091, NULL, '', NULL, NULL, NULL, 0, 20000097, 0),
(16000070, 'Berkan', 'Ergil', 'Computer Engineering', 4.00, 4.00, 7, NULL, 0),
(17450019, 'Mehmet', 'Tacyildiz', 'Computer Engineering', 4.00, 4.00, 6, NULL, 0),
(17700283, 'Amina', ' Ait', 'Computer Engineering', 3.30, 3.30, 2, 23456789, 0),
(17700284, 'Submitted', 'Student', 'Computer Engineering', 3.30, 3.30, 2, 23456789, 1);

-- --------------------------------------------------------

--
-- Table structure for table `takes`
--

CREATE TABLE `takes` (
  `ref` int(5) NOT NULL,
  `s_id` int(8) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `group_id` int(5) DEFAULT NULL,
  `isTaken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transcript`
--

CREATE TABLE `transcript` (
  `ref` int(5) NOT NULL,
  `s_id` int(20) DEFAULT NULL,
  `course_code_t` varchar(255) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transcript`
--

INSERT INTO `transcript` (`ref`, `s_id`, `course_code_t`, `grade`) VALUES
(1, 17700283, 'MATH151', 'B'),
(3, 17700283, 'CMPE107', 'A'),
(5, 17700283, 'ENGL191', 'B'),
(7, 17700283, 'MATH163', 'B'),
(8, 17700283, 'PHYS101', 'A'),
(11, 17700283, 'CMPE112', 'F'),
(12, 17700283, 'MATH152', 'A'),
(13, 17700283, 'CMPE100', 'A'),
(14, 17700283, 'PHYS102', 'W'),
(15, 17700283, 'ENGL192', 'B');

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
  `faculty_id` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `program_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `surname`, `password`, `phone_number`, `country`, `email`, `role`, `faculty_id`, `department_id`, `program_id`) VALUES
(1, 17700283, 'Amina', 'Ait', 1234, 533874573, 'Morocco', 'amina@email.com', 'student', '2', '6', '12'),
(2, 17450019, 'Mehmet', 'Tacyildiz', 1234, 0, '', '', 'student', '2', '6', '12'),
(3, 16000070, 'Berkan', 'Ergil', NULL, 0, '', '', 'student', '2', '6', '12'),
(4, 23456789, 'Sample', 'Advisor', 1234, 0, '', '', 'advisor', '2', '6', '12'),
(5, 52345678, 'Admin', 'McAd', 1234, 2147483647, 'kktc', 'admin@email.com', 'A', '-', '-', '-'),
(6, 41235678, 'Vice ', 'Dean', 1234, 533909090, 'Cyprus', 'example1@email.com', 'Vice Dean', 'CMPE', 'Engineering', 'Engineering'),
(8, 30000000, 'Vice', 'Chair', 1234, 533533535, 'KKTC', 'vicechair@email.com', 'Vice Chair', '2', '6', '12'),
(60, 10000060, 'Berkan', 'Ergil', 123, 90, 'Turkey', 'berkan@gmail.com', '', '0', '0', '0'),
(71, 30000071, 'Mehmet ', 'Tacyildiz', 123, 90, 'Turkey', 'memo@gmail.com', 'vice chair', '2', '5', '0'),
(78, 10000078, 'Berkan', 'Ergil', 123, 90, 'Turkey', 'berkan@gmail.com', 'student', '2', '6', '12'),
(89, 10000084, 'Hasan', 'Furun', 123, 90, 'Turkey', 'hasan@gmail.com', 'student', '2', '6', '12'),
(90, 20000090, 'Ferman', 'Kilic', 123, 90, 'Turkey', 'ferman@gmail.com', 'advisor', '2', '6', '12'),
(91, 10000091, 'Hatice', 'Canatan', 123, 90, 'Turkey', 'hatice@gmail.com', 'student', '2', '6', '12'),
(92, 10000092, 'Mahmut', 'Hokka', 123, 90, 'Turkey', 'mahmut@gmail.com', 'student', '2', '5', '8'),
(93, 10000093, 'Fazil', 'Kisakurek', 123, 90, 'Turkey', 'fazil@gmail.com', 'student', '2', '5', '7'),
(94, 10000094, 'Kezban', 'Embesilo', 123, 90, 'Turkey', 'kezban@gmail.com', 'student', '9', '38', '79'),
(96, 30000096, 'Haluk', 'Bilginer', 123, 90, 'Turkey', 'haluk@gmail.com', 'vice chair', '2', '6', '0'),
(98, 20000097, 'Sebnem', 'Ferah', 123, 90, 'Turkey', 'sebnem@gmail.com', 'advisor', '2', '6', '12'),
(99, 20000099, 'Tansu', 'Ciller', 123, 90, 'Turkey', 'tansu@gmail.com', 'advisor', '2', '5', '8'),
(100, 17700284, 'Submitted', 'Student', 1234, 99999999, 'Turkey', 'email@email.com', 'student', '2', '6', '12');

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
(1, 30000052),
(7, 30000096),
(8, 30000071);

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
  ADD KEY `group_id` (`group_id`),
  ADD KEY `group_id_2` (`group_id`),
  ADD KEY `course_name` (`course_name`);

--
-- Indexes for table `course_group`
--
ALTER TABLE `course_group`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `i_id` (`i_id`);

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
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `takes`
--
ALTER TABLE `takes`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `course_name` (`course_name`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `transcript`
--
ALTER TABLE `transcript`
  ADD PRIMARY KEY (`ref`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `course_code` (`course_code_t`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25721;

--
-- AUTO_INCREMENT for table `course_group`
--
ALTER TABLE `course_group`
  MODIFY `ref` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `s_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17700285;

--
-- AUTO_INCREMENT for table `takes`
--
ALTER TABLE `takes`
  MODIFY `ref` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `transcript`
--
ALTER TABLE `transcript`
  MODIFY `ref` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `vice_chairs`
--
ALTER TABLE `vice_chairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `course_group`
--
ALTER TABLE `course_group`
  ADD CONSTRAINT `course_group_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `course_group_ibfk_2` FOREIGN KEY (`i_id`) REFERENCES `instructor` (`i_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`);

--
-- Constraints for table `takes`
--
ALTER TABLE `takes`
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`),
  ADD CONSTRAINT `takes_ibfk_3` FOREIGN KEY (`course_name`) REFERENCES `course` (`course_name`),
  ADD CONSTRAINT `takes_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `course` (`group_id`);

--
-- Constraints for table `transcript`
--
ALTER TABLE `transcript`
  ADD CONSTRAINT `transcript_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `student` (`s_id`),
  ADD CONSTRAINT `transcript_ibfk_2` FOREIGN KEY (`course_code_t`) REFERENCES `course` (`course_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
