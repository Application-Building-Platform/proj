-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 07:28 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `solved_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(7, 'Bars'),
(6, 'Resturants');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_category` varchar(255) NOT NULL,
  `client_description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_email`, `client_phone`, `client_address`, `client_category`, `client_description`) VALUES
(28, 'Jane Doe', 'JaneDoe@example.com', '0123456789', 'Hamilton, ON', '', 'In her early thirties. She has a full-bodied, feminine figure, is quite muscular and grounded in her body'),
(25, 'Mouaiad Hejazi', 'mkjb@mfoe.com', 'mkjb@mfoe.com', 'dd', 'dd', ' Ø¦Ø¦Ø¦'),
(26, 'Salih Salih', 'salih.salih@mohawkcollege.ca', '4372199433', '40 OXford St.', 'Cafe', ' 123');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `poll_id` int(11) NOT NULL,
  `poll_title` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `question_type` enum('TEXT','CHECKBOX','RADIOBOX') NOT NULL,
  `question_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`question_value`)),
  `question_solved` tinyint(1) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `poll_id`, `question_type`, `question_value`, `question_solved`, `category_id`) VALUES
(1, 0, '', '{\"q\":\"What is the name of your restaurant?\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Resturants\"}', 0, 1),
(2, 0, '', '{\"q\":\"What is the name of the owner?\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Resturants\"}', 0, 1),
(3, 0, '', '{\"q\":\"What is the name of your bar?\",\"choices\":[\"\",\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Bars\"}', 0, 1),
(4, 0, '', '{\"q\":\"Where is the bar located?\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Bars\"}', 0, 1),
(5, 0, '', '{\"q\":\"How long have you been in business?\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Bars\"}', 0, 1),
(6, 0, '', '{\"q\":\"How long at this location?\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Bars\"}', 0, 1),
(7, 0, 'CHECKBOX', '{\"q\":\"Is this location owner operated?\",\"choices\":[\"Yes\",\"No\"],\"q_type\":\"checkBox\",\"q_category\":\"Bars\"}', 0, 1),
(18, 0, 'CHECKBOX', '{\"q\":\"Does your restaurant make deliveries?\",\"choices\":[\"Yes\",\"No\"],\"q_type\":\"checkBox\",\"q_category\":\"Resturants\"}', 0, 1),
(16, 0, 'CHECKBOX', '{\"q\":\"Does your restaurant serve alcohol?\",\"choices\":[\"Yes\",\"No\"],\"q_type\":\"checkBox\",\"q_category\":\"Resturants\"}', 0, 1),
(15, 0, 'CHECKBOX', '{\"q\":\"In the past 5 years, have you ever been cited for violations of any health or safety codes?\",\"choices\":[\"Yes\",\"No\"],\"q_type\":\"checkBox\",\"q_category\":\"Resturants\"}', 0, 1),
(19, 0, '', '{\"q\":\"Please provide details:\",\"choices\":[\"\"],\"q_type\":\"shortAnswer\",\"q_category\":\"Resturants\"}', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`poll_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `poll_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
