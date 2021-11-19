-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2021 at 04:07 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skpa_partner_notification`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int NOT NULL,
  `from_email` varchar(255) NOT NULL,
  `from_name` varchar(255) NOT NULL,
  `email_password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `header` varchar(255) DEFAULT NULL,
  `footer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `from_email`, `from_name`, `email_password`, `name`, `subject`, `message`, `logo`, `header`, `footer`) VALUES
(1, 'skpaloveyourself@gmail.com', 'skpaloveyourself', 'skpaloveyourself!123', 'test', 'subject', ' <b>Hello {{name}},</b><br>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                        This is an important healthcare message from the SKPA Love Yourself. {{sender}} used our free notification service to let you know you may have been exposed to {{sti}}. We recommend you contact a doctor or sexual health service to help you get tested and stay healthy.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                    </p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                    \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                    <p style=\"font-size:14px;font-weight:300;color: #000;line-height: 24px;\">\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n														SKPA Love Yourself provides sexual health information for gay, bisexual and other men who have sex with men. Learn more about STIs and testing services at  http://safespaces.dev-lilypad.xyz/\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n                                                    </p>', '', 'header', 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message`, `status`) VALUES
(1, 'THANK YOU FOR LETTING YOUR SEXUAL PARTNER(S) KNOW THEY NEED TO GET TESTED.<br>\r\n	THEY WILL BE SENT A NOTIFICATION.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person_information`
--

CREATE TABLE `person_information` (
  `id` int NOT NULL,
  `participant_id` int DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int NOT NULL,
  `title` varchar(500) NOT NULL,
  `options` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `question_input` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `question_radio` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `step_id` int NOT NULL,
  `sub_quesion_id` int DEFAULT NULL,
  `sort_order` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `is_multiple` int NOT NULL DEFAULT '0',
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `title`, `options`, `question_input`, `question_radio`, `message`, `step_id`, `sub_quesion_id`, `sort_order`, `status`, `is_multiple`, `class_name`) VALUES
(1, 'Person Information', NULL, '[\"Name\",\"Email Address\"]', '', NULL, 1, NULL, 1, 1, 0, ''),
(2, 'Select STIs', '[\"Chlamydia\",\"Crabs\",\"Donovanosis\",\"Gonorrhoea\",\"Genital Warts\",\"Hepatitis A\",\"Hepatitis B\",\"Hepatitis C\",\"LGV\",\"Meningococcal C\",\"Mycoplasma Genitalium\",\"Scabies\",\"Shigella\",\"Syphilis\"]', '', '', NULL, 2, NULL, 2, 1, 1, 'sti'),
(3, 'Do you want to let then know the message was from you?', '', '', '[\"Yes\", \"No\"]', NULL, 3, 1, 3, 1, 0, 'notify_partner');

-- --------------------------------------------------------

--
-- Table structure for table `step`
--

CREATE TABLE `step` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `step`
--

INSERT INTO `step` (`id`, `name`, `description`, `status`) VALUES
(1, 'User Information', 'Enter the information of the person(s) you want to notify.', 1),
(2, 'STIs', 'Select the STI(s) you\'ve been diagnosed with and we\'ll notify your sexual partner(s) to get tested.', 1),
(3, 'Your Details', 'Do you want to let them know the message was from you?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_question`
--

CREATE TABLE `sub_question` (
  `id` int NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `sub_options` varchar(255) NOT NULL,
  `sub_input` varchar(255) NOT NULL,
  `sub_class_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sub_question`
--

INSERT INTO `sub_question` (`id`, `sub_title`, `sub_options`, `sub_input`, `sub_class_name`) VALUES
(1, 'Name', '', '[\"Full name\"]', 'full_name');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_information`
--
ALTER TABLE `person_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `step`
--
ALTER TABLE `step`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_question`
--
ALTER TABLE `sub_question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_information`
--
ALTER TABLE `person_information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `step`
--
ALTER TABLE `step`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_question`
--
ALTER TABLE `sub_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
