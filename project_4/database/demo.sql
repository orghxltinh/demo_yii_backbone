-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 12, 2014 at 02:25 PM
-- Server version: 5.6.14-log
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf8 NOT NULL,
  `other` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `answer`, `other`) VALUES
(1, 'mr Ty', '1-0;2-1', ''),
(2, 'mr Teo', '1-1;2-0', 'javascript'),
(3, 'aaax', '', '334'),
(4, 'ku Ty', '', 'html'),
(5, 'ku Tèo', '', ''),
(6, 'Hoa', '', 'php'),
(7, 'My', '', 'html'),
(8, 'KKK', '', 'fdsfsd'),
(9, 'aaa', '', ''),
(10, 'dsds', '', ''),
(11, 'vvv', '', ''),
(12, 'ddd', '', ''),
(13, 'dsada', '', ''),
(14, 'dsds', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_question`
--

CREATE TABLE IF NOT EXISTS `customer_question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `question_id` int(10) unsigned NOT NULL,
  `value` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `customer_question`
--

INSERT INTO `customer_question` (`id`, `customer_id`, `question_id`, `value`) VALUES
(4, 4, 4, 1),
(7, 5, 4, 1),
(8, 5, 11, 1),
(9, 5, 12, 1),
(10, 6, 1, 1),
(11, 6, 11, 1),
(12, 6, 12, 1),
(13, 7, 1, 1),
(14, 7, 4, 1),
(15, 7, 12, 1),
(16, 8, 4, 1),
(17, 8, 11, 1),
(18, 9, 1, 1),
(19, 9, 11, 1),
(20, 9, 12, 1),
(21, 10, 11, 1),
(22, 10, 12, 1),
(23, 11, 4, 1),
(24, 11, 11, 1),
(25, 11, 12, 1),
(26, 12, 1, 1),
(27, 12, 12, 1),
(28, 13, 11, 1),
(29, 14, 4, 1),
(30, 14, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_authassignment`
--

CREATE TABLE IF NOT EXISTS `ecom_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` int(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecom_authassignment`
--

INSERT INTO `ecom_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', 1, NULL, 'N;'),
('admin', 86, NULL, 'N;'),
('admin', 87, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_authitem`
--

CREATE TABLE IF NOT EXISTS `ecom_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ecom_authitem`
--

INSERT INTO `ecom_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', NULL, 'N;'),
('adminsupport', 2, '', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `ecom_authitemchild`
--

CREATE TABLE IF NOT EXISTS `ecom_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ecom_session`
--

CREATE TABLE IF NOT EXISTS `ecom_session` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ecom_session`
--

INSERT INTO `ecom_session` (`id`, `expire`, `data`) VALUES
('fj4qemee9q7t62ik744a436sp1', 1405165931, 0x35623632663133623866666136303738386237313339306262396363633033365f5f72657475726e55726c7c733a35303a222f61707048352f4170704835546573742f64656d6f5f7969695f6261636b626f6e652f70726f6a6563745f342f61646d696e223b35623632663133623866666136303738386237313339306262396363633033365f5f69647c733a313a2231223b35623632663133623866666136303738386237313339306262396363633033365f5f6e616d657c733a353a2261646d696e223b35623632663133623866666136303738386237313339306262396363633033365f5f7374617465737c613a303a7b7d6769695f5f72657475726e55726c7c733a34383a222f61707048352f4170704835546573742f64656d6f5f7969695f6261636b626f6e652f70726f6a6563745f342f676969223b6769695f5f69647c733a353a227969696572223b6769695f5f6e616d657c733a353a227969696572223b6769695f5f7374617465737c613a303a7b7d);

-- --------------------------------------------------------

--
-- Table structure for table `ecom_users`
--

CREATE TABLE IF NOT EXISTS `ecom_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `DateCreated` datetime NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

--
-- Dumping data for table `ecom_users`
--

INSERT INTO `ecom_users` (`id`, `username`, `password`, `DateCreated`, `LastUpdate`, `role_id`) VALUES
(1, 'admin', '77ec28115c2bc02b22bcff96e2306293811191eac332f12b10124b5ad15c1c34', '2013-12-10 00:00:00', '0000-00-00 00:00:00', 1),
(86, 'bebu', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(87, 'abc', 'f707fdda7c874ff49ebfb2c88a2860c5ff4ce3d94a21efb76566ad0f92c9ad57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 NOT NULL,
  `color` varchar(255) NOT NULL,
  `highlight` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `text`, `color`, `highlight`) VALUES
(1, 'C#', 'E375FF', 'FF4DDB'),
(4, 'java', '2B41FF', '5257FF'),
(11, 'python', 'FFDA24', 'FFF242'),
(12, 'Ruby', 'FF2D0D', 'FF6842');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_question`
--
ALTER TABLE `customer_question`
  ADD CONSTRAINT `customer_question_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_question_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
