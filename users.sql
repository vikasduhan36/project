-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2015 at 06:32 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eyeask`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_type` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country_id` varchar(100) NOT NULL,
  `timezone_id` int(11) NOT NULL,
  `language_id` varchar(255) NOT NULL COMMENT 'comma separated language ids',
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `linkedin_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `google_url` varchar(255) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `is_expert` enum('0','1') NOT NULL COMMENT '''0''=>no,''1''=>yes',
  `exp_description` text NOT NULL,
  `exp_help` text NOT NULL,
  `exp_category_id` varchar(100) NOT NULL COMMENT 'comma separated category ids',
  `exp_tag_id` varchar(255) NOT NULL COMMENT 'comma separated tag ids',
  `exp_rate` varchar(15) NOT NULL COMMENT '''free'',''int value''',
  `exp_about` text NOT NULL,
  `exp_experience` text NOT NULL,
  `exp_education` text NOT NULL,
  `exp_interest` text NOT NULL,
  `exp_award` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_type`, `email`, `password`, `fname`, `lname`, `username`, `gender`, `profile_image`, `city`, `country_id`, `timezone_id`, `language_id`, `dob`, `phone`, `linkedin_url`, `twitter_url`, `google_url`, `facebook_url`, `is_expert`, `exp_description`, `exp_help`, `exp_category_id`, `exp_tag_id`, `exp_rate`, `exp_about`, `exp_experience`, `exp_education`, `exp_interest`, `exp_award`, `status`, `created`, `modified`) VALUES
(1, '', 'test@mail.com', '123456', 'test', 'test', '', 'male', 'test', 'test', '1', 103, '1', '2015-08-03', '123', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '0', '2015-08-04 00:00:00', '0000-00-00 00:00:00'),
(2, '', 'exp@mail.com', '123456', 'exp', 'exp', '', 'male', 'exp', 'exp', '1', 103, '1', '2015-08-04', '123', '', '', '', '', '1', 'exp', 'exp', 'exp', '', '20', 'exp', 'exp', 'exp', 'exp', 'exp', '1', '2015-08-12 00:00:00', '0000-00-00 00:00:00'),
(3, '', 'use2@mail.com', 'use2', 'use2', 'use2', '', 'male', '', '', '0', 0, '', '0000-00-00', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'google', 'sricky555@gmail.com', '', 'Ricky', 'Sharma', 'Ricky Sharma', 'male', 'http://localhost/project/profile_pic/1440158632.jpg', '', 'US', 103, '1', '0000-00-00', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'static', 'vivek_choudhary@hotmail.com', 'ram', '', '', 'Vivek Kumar', 'male', 'http://localhost/project/profile_pic/1440179624ne.png', 'Chandigarh', 'GB', 27, '25,84', '1990-03-08', '9023805175', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '0', '2015-08-21 12:20:30', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
