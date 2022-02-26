-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 26, 2022 at 01:27 AM
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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `solved_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'ss'),
(2, 'dd'),
(3, 'ddd'),
(4, 'Ù‚Ù‚'),
(5, 'Ø³Ø³');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_phone` varchar(255) NOT NULL,
  `client_address` varchar(255) NOT NULL,
  `client_category` varchar(255) NOT NULL,
  `client_description` varchar(255) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `client_email`, `client_phone`, `client_address`, `client_category`, `client_description`) VALUES
(1, 'jj', 'mkjb@mfoe.com', '2592592598', 'dd', 'dd', ' dd'),
(25, 'Mouaiad Hejazi', 'mkjb@mfoe.com', 'mkjb@mfoe.com', 'dd', 'dd', ' Ø¦Ø¦Ø¦'),
(24, 'jj', 'mkjb@mfoe.com', 'mkjb@mfoe.com', 'dd', 'dd', ' Ù‚Ù‚Ù‚'),
(23, 'jj', 'mkjb@mfoe.com', 'mkjb@mfoe.com', 'dd', 'ddfff', ' fff'),
(22, 'jj', 'mkjb@mfoe.com', '2592592598', 'dd', 'dd', ' ss');

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_title` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `question_type` enum('TEXT','CHECKBOX','RADIOBOX') NOT NULL,
  `question_value` json DEFAULT NULL,
  `question_solved` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
