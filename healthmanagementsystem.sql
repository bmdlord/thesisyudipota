-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 22, 2020 at 03:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthmanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `patient_name` text NOT NULL,
  `doctor` int(11) NOT NULL,
  `doctor_name` text NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `status` text NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient`, `patient_name`, `doctor`, `doctor_name`, `date`, `time`, `status`) VALUES
(1, 2, 'Bill Gates', 1, 'Kim Nicole Sabordo', '14/11/2020', '3:00 PM', 'approve'),
(2, 2, 'bill gates', 1, 'kim nicole sabordo', '10/16/2020', '02:22 pm', 'cancel'),
(3, 2, 'bill gates', 1, 'kim nicole sabordo', '10/16/2020', '05:26 pm', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `chat_id`
--

CREATE TABLE `chat_id` (
  `id` int(11) NOT NULL,
  `conversation_id` text NOT NULL,
  `patient` int(11) NOT NULL,
  `doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat_id`
--

INSERT INTO `chat_id` (`id`, `conversation_id`, `patient`, `doctor`) VALUES
(1, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 2, 1),
(2, 'WGm4J0DUCtSjdkGMyC9J4Yp2vWCypHxbXVf9y3fcBTVeXgWpwlG', 2, 2),
(3, 'KEAOVpWJ54C81BD2mcf2FRhVdrQ7DsBMC22U64602jnGJudnb67', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(11) NOT NULL,
  `chat_id` text NOT NULL,
  `conversation` longtext NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`id`, `chat_id`, `conversation`, `user`) VALUES
(1, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'test', 2),
(2, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'how are you?', 2),
(4, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'hello doctor?', 2),
(5, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'do you have a problem?', 1),
(6, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'yes doc how are you?', 2),
(7, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'so tell me.', 1),
(8, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'how are you?', 1),
(9, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'set appointment', 2),
(10, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'test', 1),
(11, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'test 123', 1),
(12, 'F77ANugU1lHot5cUECRa4l25izDqiDtCRJ6J0ntkWyZ6ddBYCXt', 'whats up?', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_patient_relation`
--

CREATE TABLE `doctor_patient_relation` (
  `id` int(11) NOT NULL,
  `patient` int(11) DEFAULT NULL,
  `doctor` int(11) DEFAULT NULL,
  `status` text NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor_patient_relation`
--

INSERT INTO `doctor_patient_relation` (`id`, `patient`, `doctor`, `status`) VALUES
(1, 2, 1, 'approve'),
(2, 2, 3, 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `patients_journal`
--

CREATE TABLE `patients_journal` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `mood` text NOT NULL,
  `journal` text DEFAULT NULL,
  `date` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients_journal`
--

INSERT INTO `patients_journal` (`id`, `user`, `title`, `mood`, `journal`, `date`) VALUES
(1, 2, 'test', 'sad', 'test', 'Nov 04, 2020 07:36 am'),
(2, 2, 'good', 'Happy', 'nice try', 'Nov 11, 2020 12:19 am'),
(3, 2, 'hdhdhs', 'Sad', 'sample', 'Nov 11, 2020 12:27 am'),
(4, 2, 'nothing', 'Sad', 'i just want to be happy.', 'Nov 14, 2020 08:10 am');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `question` text DEFAULT NULL,
  `a` text NOT NULL,
  `b` text NOT NULL,
  `c` text NOT NULL,
  `d` text NOT NULL,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `userid`, `title`, `question`, `a`, `b`, `c`, `d`, `answer`) VALUES
(1, 1, 'test', 'asdfasdfasdf', 'a', 'b', 'c', 'd', 'a'),
(2, 1, 'EVAULATION TEST 1', 'WHAT IS THE MOST ATTRACTIVE TO YOUR EYES?', 'COMPUTER', 'LAPTOP', 'PHONE', 'CHICKS', 'd'),
(3, 1, 'EVALUATION TEST 2', 'WHAT IS THE MOST IMPORTANT TO YOU?', 'LIFE', 'FAMILY', 'MONEY', 'NONE', 'd'),
(4, 1, 'EVALUATION TEST 2', 'HOW OLD ARE YOU RIGHT NOW?', '13', '12', '27', '28', 'c'),
(5, 1, 'EVALUATION TEST 2', 'HOW TO TEST YOUR FAITH?', 'DIE', 'LIE', 'BIE', 'BOO', 'a'),
(6, 1, 'evaluation performance module 25', 'what is your name?', 'kim', 'natalia', 'venge', 'none', 'd'),
(7, 1, 'evaluation performance module 25', 'test your self', 'bla', 'blabla', 'blabla', 'blblblalalala', 'a'),
(8, 1, 'evaluation performance module 25', 'what food are you?', 'test', 'test1', 'test2', 'test3', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `patient` int(11) NOT NULL,
  `task` text NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0,
  `status` text NOT NULL DEFAULT 'not validate',
  `month` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `patient`, `task`, `score`, `total`, `status`, `month`) VALUES
(1, 2, 'test', 0, 1, 'taken', 'Nov'),
(2, 2, 'EVAULATION TEST 1', 1, 1, 'taken', 'Oct'),
(3, 2, 'EVALUATION TEST 2', 3, 3, 'taken', 'Oct'),
(4, 2, 'evaluation performance module 25', 1, 3, 'taken', 'Nov');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `fullname` text NOT NULL,
  `address` text NOT NULL,
  `birthdate` text NOT NULL,
  `attainment` longtext DEFAULT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `level` int(2) NOT NULL DEFAULT 0,
  `popularity` int(11) NOT NULL DEFAULT 0,
  `status` text NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `fullname`, `address`, `birthdate`, `attainment`, `email`, `password`, `level`, `popularity`, `status`) VALUES
(1, 'kim_nicole_sabordo_10292020023853..', 'kim nicole sabordo', 'bacolod city', '1970-01-01', NULL, 'kimnicole.dev@gmail.com', '$2y$12$dxZjKluEw.0F5VBbjzv.M.hI6QJMUeFSDp5A90rqrwjWHwXZax/yC', 1, 31, 'active'),
(2, NULL, 'bill gates', 'bacolod city', '1970-01-01', NULL, 'billgates@gmail.com', '$2y$12$DFGvG5AzclmTCjCq/fGmQeUOGnmwb/BpwBLftmjLECA1VKzXM03fW', 2, 0, 'active'),
(3, 'keyla_ianelle_sabordo_11222020133727..', 'keyla ianelle sabordo', 'bacolod ', '1970-01-01', 'N/A', 'keyla@gmail.com', '$2y$12$hslhTJCGHB7XgjO4M4eEYO44jgrLG1cnWAXVpo0NHVq9WSXPdg7V2', 1, 0, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_id`
--
ALTER TABLE `chat_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_patient_relation`
--
ALTER TABLE `doctor_patient_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_journal`
--
ALTER TABLE `patients_journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_id`
--
ALTER TABLE `chat_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `doctor_patient_relation`
--
ALTER TABLE `doctor_patient_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients_journal`
--
ALTER TABLE `patients_journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
