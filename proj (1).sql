-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2022 at 02:12 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE IF NOT EXISTS `applications` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_title` varchar(255) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `responded_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`application_id`),
  KEY `category_id` (`category_id`),
  KEY `client_id` (`client_id`),
  KEY `responded_at` (`responded_at`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `application_title`, `client_id`, `created_at`, `category_id`, `responded_at`) VALUES
(5, 'First AppY', 1, NULL, 1, NULL),
(6, 'First App', 1, NULL, 1, NULL),
(7, 'First App', 1, NULL, 1, NULL),
(8, 'First App', 1, NULL, 1, NULL),
(9, 'First App', 1, NULL, 1, NULL),
(11, 'Y', 1, NULL, 1, NULL),
(12, 'u', 1, NULL, 1, NULL),
(13, 'r', 1, NULL, 1, NULL),
(14, 'Alex', 2, NULL, 1, NULL),
(15, 'Alex', 1, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_questions`
--

DROP TABLE IF EXISTS `application_questions`;
CREATE TABLE IF NOT EXISTS `application_questions` (
  `question_id` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `solved_value` varchar(255) DEFAULT NULL,
  `solved_at` date DEFAULT NULL,
  UNIQUE KEY `question_id` (`question_id`,`application_id`),
  KEY `application_id` (`application_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_questions`
--

INSERT INTO `application_questions` (`question_id`, `application_id`, `solved_value`, `solved_at`) VALUES
(1, 15, NULL, NULL),
(2, 15, NULL, NULL),
(11, 15, NULL, NULL),
(12, 15, NULL, NULL),
(4, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Coffee__');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `client_address` varchar(255) DEFAULT NULL,
  `client_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_email`, `client_phone`, `client_address`, `client_description`) VALUES
(1, 'Mouaiad Hejazi', 'moyadhijazi@gmail.com', '2592592598', 'main st, Hamilton ON', 'ddd'),
(2, 'admin', 'mkjb@mfoe.comm', 'mkjb@mfoe.com', 'dd', 'Ø§Ø§Ø§');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

DROP TABLE IF EXISTS `conditions`;
CREATE TABLE IF NOT EXISTS `conditions` (
  `condition_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `condition_value` varchar(255) DEFAULT NULL,
  `condition_question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`condition_id`),
  KEY `application_id` (`application_id`),
  KEY `question_id` (`question_id`),
  KEY `condition_question_id` (`condition_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`condition_id`, `application_id`, `question_id`, `condition_value`, `condition_question_id`) VALUES
(33, 15, 12, '1', 11),
(32, 15, 12, '0', 2),
(31, 15, 2, '0', 0),
(30, 15, 12, '2', 1),
(29, 15, 12, '1', 0),
(28, 15, 12, '0', 4),
(27, 15, 12, '2', 11),
(26, 15, 12, '1', 1),
(25, 15, 12, '0', 0),
(24, 15, 2, '0', 0),
(22, 15, 12, '1', 1),
(23, 15, 12, '2', 11),
(21, 15, 12, '0', 0),
(34, 15, 12, '2', 11);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_type` enum('CHECKBOX','TEXT','RADIO') NOT NULL,
  `question_value` json DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_type`, `question_value`, `category_id`) VALUES
(2, 'RADIO', '{\"q\": \"How old are you?\", \"q_type\": \"radio\", \"choices\": [\"1111\"], \"category_id\": \"1\"}', 1),
(4, 'CHECKBOX', '{\"q\": \"text\", \"q_type\": \"checkBox\", \"choices\": [\"555\", \"666\", \"\"], \"category_id\": \"1\"}', 1),
(12, 'RADIO', '{\"q\": \"Hello\", \"q_type\": \"radio\", \"choices\": [\"a\", \"b\", \"c\"], \"category_id\": \"1\"}', 1),
(11, 'TEXT', '{\"q\": \"shortanswer\", \"q_type\": \"TEXT\", \"choices\": [\"\"], \"category_id\": \"1\"}', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
