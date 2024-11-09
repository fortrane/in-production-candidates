-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2024 at 08:38 PM
-- Server version: 8.0.39-0ubuntu0.22.04.1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5_8_18_120`
--

-- --------------------------------------------------------

--
-- Table structure for table `gb_users`
--

CREATE TABLE `gb_users` (
  `id` int NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `full_name` text,
  `telegram` text,
  `role` varchar(32) NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `gb_users`
--

INSERT INTO `gb_users` (`id`, `login`, `password`, `full_name`, `telegram`, `role`, `created_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Павел Павлович', '@durov', 'admin', '09.11.2024 00:01:21'),
(5, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Петр Петров', '@paul', 'user', '09.11.2024 00:01:21'),
(8, 'gsdfgfdgdfs', '724a0e4ab1cee4516d36cf73bde251e1', NULL, NULL, 'admin', '09.11.2024 16:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `in_prod_analytics`
--

CREATE TABLE `in_prod_analytics` (
  `id` int NOT NULL,
  `card_id` int NOT NULL,
  `score` text NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `in_prod_card`
--

CREATE TABLE `in_prod_card` (
  `id` int NOT NULL,
  `card_name` text NOT NULL,
  `video_path` text NOT NULL,
  `user_id` int NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `in_prod_professions`
--

CREATE TABLE `in_prod_professions` (
  `id` int NOT NULL,
  `profession_name` text NOT NULL,
  `ocean_json` text NOT NULL,
  `created_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `in_prod_professions`
--

INSERT INTO `in_prod_professions` (`id`, `profession_name`, `ocean_json`, `created_at`) VALUES
(7, 'Data Analyst', '{\"openness\":0.2,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.3}', '09.11.2024 13:19:23'),
(8, 'Project Manager', '{\"openness\":0.15,\"conscientiousness\":0.3,\"extraversion\":0.25,\"agreeableness\":0.2,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(9, 'UX Designer', '{\"openness\":0.3,\"conscientiousness\":0.2,\"extraversion\":0.2,\"agreeableness\":0.2,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(10, 'Financial Analyst', '{\"openness\":0.15,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.2,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(11, 'Teacher', '{\"openness\":0.2,\"conscientiousness\":0.25,\"extraversion\":0.2,\"agreeableness\":0.25,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(12, 'Architect', '{\"openness\":0.4,\"conscientiousness\":0.25,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(13, 'Operations Manager', '{\"openness\":0.15,\"conscientiousness\":0.35,\"extraversion\":0.25,\"agreeableness\":0.15,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(14, 'Clinical Psychologist', '{\"openness\":0.25,\"conscientiousness\":0.3,\"extraversion\":0.15,\"agreeableness\":0.25,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(15, 'Lawyer', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(16, 'Business Analyst', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.15,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(17, 'Graphic Designer', '{\"openness\":0.5,\"conscientiousness\":0.2,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(18, 'Sales Representative', '{\"openness\":0.2,\"conscientiousness\":0.2,\"extraversion\":0.4,\"agreeableness\":0.15,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(19, 'Mechanical Engineer', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(20, 'Content Writer', '{\"openness\":0.4,\"conscientiousness\":0.25,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(21, 'Human Resources Specialist', '{\"openness\":0.2,\"conscientiousness\":0.25,\"extraversion\":0.25,\"agreeableness\":0.25,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(22, 'Pharmacist', '{\"openness\":0.1,\"conscientiousness\":0.4,\"extraversion\":0.15,\"agreeableness\":0.25,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(23, 'Social Worker', '{\"openness\":0.25,\"conscientiousness\":0.2,\"extraversion\":0.2,\"agreeableness\":0.3,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(24, 'Economist', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.25}', '09.11.2024 13:19:23'),
(25, 'Civil Engineer', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.2,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(26, 'Customer Service Representative', '{\"openness\":0.15,\"conscientiousness\":0.2,\"extraversion\":0.3,\"agreeableness\":0.3,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(27, 'Electrical Engineer', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(28, 'Veterinarian', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.15,\"agreeableness\":0.2,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(29, 'Software Product Designer', '{\"openness\":0.4,\"conscientiousness\":0.25,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(30, 'Digital Marketing Specialist', '{\"openness\":0.3,\"conscientiousness\":0.2,\"extraversion\":0.25,\"agreeableness\":0.15,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(31, 'Data Engineer', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(32, 'Fitness Trainer', '{\"openness\":0.25,\"conscientiousness\":0.2,\"extraversion\":0.3,\"agreeableness\":0.2,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(33, 'Real Estate Agent', '{\"openness\":0.2,\"conscientiousness\":0.2,\"extraversion\":0.35,\"agreeableness\":0.15,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(34, 'Customer Success Manager', '{\"openness\":0.2,\"conscientiousness\":0.25,\"extraversion\":0.3,\"agreeableness\":0.2,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(35, 'Research Assistant', '{\"openness\":0.25,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(36, 'Nurse', '{\"openness\":0.15,\"conscientiousness\":0.3,\"extraversion\":0.2,\"agreeableness\":0.3,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(37, 'Industrial Designer', '{\"openness\":0.4,\"conscientiousness\":0.2,\"extraversion\":0.2,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(38, 'Environmental Scientist', '{\"openness\":0.3,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(39, 'Public Relations Specialist', '{\"openness\":0.25,\"conscientiousness\":0.2,\"extraversion\":0.35,\"agreeableness\":0.15,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(40, 'Mechanical Technician', '{\"openness\":0.15,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.2,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(41, 'Travel Consultant', '{\"openness\":0.25,\"conscientiousness\":0.2,\"extraversion\":0.3,\"agreeableness\":0.2,\"neuroticism\":0.05}', '09.11.2024 13:19:23'),
(42, 'Cybersecurity Specialist', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(43, 'Political Analyst', '{\"openness\":0.3,\"conscientiousness\":0.25,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(44, 'Front-End Developer', '{\"openness\":0.3,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(45, 'Back-End Developer', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.25}', '09.11.2024 13:19:23'),
(46, 'DevOps Engineer', '{\"openness\":0.25,\"conscientiousness\":0.3,\"extraversion\":0.2,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(47, 'Data Scientist', '{\"openness\":0.35,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(48, 'Cloud Architect', '{\"openness\":0.3,\"conscientiousness\":0.3,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(49, 'Cybersecurity Analyst', '{\"openness\":0.25,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(50, 'Database Administrator', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(51, 'UX/UI Designer', '{\"openness\":0.4,\"conscientiousness\":0.25,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(52, 'Mobile Application Developer', '{\"openness\":0.3,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(53, 'Machine Learning Engineer', '{\"openness\":0.35,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.15}', '09.11.2024 13:19:23'),
(54, 'Blockchain Developer', '{\"openness\":0.3,\"conscientiousness\":0.3,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(55, 'IT Project Manager', '{\"openness\":0.25,\"conscientiousness\":0.3,\"extraversion\":0.25,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(56, 'Systems Analyst', '{\"openness\":0.2,\"conscientiousness\":0.35,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(57, 'Game Developer', '{\"openness\":0.4,\"conscientiousness\":0.25,\"extraversion\":0.15,\"agreeableness\":0.1,\"neuroticism\":0.1}', '09.11.2024 13:19:23'),
(58, 'Network Administrator', '{\"openness\":0.15,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.15,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(59, 'QA Engineer', '{\"openness\":0.2,\"conscientiousness\":0.4,\"extraversion\":0.1,\"agreeableness\":0.1,\"neuroticism\":0.2}', '09.11.2024 13:19:23'),
(60, 'Dev1', '{\"openness\":0.1,\"conscientiousness\":0.4,\"extraversion\":0.2,\"agreeableness\":0.2,\"neuroticism\":0.1}', '09.11.2024 18:41:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gb_users`
--
ALTER TABLE `gb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_prod_analytics`
--
ALTER TABLE `in_prod_analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_prod_card`
--
ALTER TABLE `in_prod_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_prod_professions`
--
ALTER TABLE `in_prod_professions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gb_users`
--
ALTER TABLE `gb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `in_prod_analytics`
--
ALTER TABLE `in_prod_analytics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_prod_card`
--
ALTER TABLE `in_prod_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_prod_professions`
--
ALTER TABLE `in_prod_professions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
