-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2016 at 09:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demotracks`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_message` text NOT NULL,
  `feedback_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

 
--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `music_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_label` text NOT NULL,
  `music_link` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `musiccategory_id` int(11) NOT NULL,
  `recordstudio_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`music_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

 

CREATE TABLE IF NOT EXISTS `musiccategory` (
  `musiccategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `musiccategory_name` text NOT NULL,
  PRIMARY KEY (`musiccategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `musiccategory`
--

INSERT INTO `musiccategory` (`musiccategory_id`, `musiccategory_name`) VALUES
(1, 'HipHop'),
(2, 'Masikandi'),
(3, 'Jazz'),
(4, 'Gospel'),
(5, 'RnB');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int(11) NOT NULL AUTO_INCREMENT,
  `province_name` text NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(1, 'The Eastern Cape'),
(2, 'The Free State'),
(3, 'Gauteng'),
(4, 'KwaZulu-Natal'),
(5, 'Limpopo'),
(6, 'Mpumalanga'),
(7, 'The Northern Cape'),
(8, 'North West'),
(9, 'The Western Cape');

-- --------------------------------------------------------

--
-- Table structure for table `recommendation`
--

CREATE TABLE IF NOT EXISTS `recommendation` (
  `recommendation_id` int(11) NOT NULL AUTO_INCREMENT,
  `music_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recommendation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `recommendation`
--
 
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `province_id` int(11) NOT NULL,
  `hash` text NOT NULL,
  `activation_code` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `usercategory_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--
 
-- --------------------------------------------------------

--
-- Table structure for table `usercategory`
--

CREATE TABLE IF NOT EXISTS `usercategory` (
  `usercategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `usercategory_name` text NOT NULL,
  PRIMARY KEY (`usercategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usercategory`
--

INSERT INTO `usercategory` (`usercategory_id`, `usercategory_name`) VALUES
(1, 'Artist'),
(2, 'Other');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
