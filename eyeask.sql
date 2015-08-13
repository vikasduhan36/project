-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2015 at 05:54 PM
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
CREATE DATABASE IF NOT EXISTS `eyeask` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eyeask`;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created`, `modified`) VALUES
(1, 'Marketing', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Financial', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Financial', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Legal', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Strategy', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Sales', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Coaching and training', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Tech', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Other', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('0','1') NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `status`, `name`, `short_code`) VALUES
(1, '0', 'English', 'en'),
(2, '0', 'German', 'de'),
(3, '0', 'French', 'fr'),
(4, '0', 'Dutch', 'nl'),
(5, '0', 'Italian', 'it'),
(6, '0', 'Spanish', 'es'),
(7, '0', 'Polish', 'pl'),
(8, '0', 'Russian', 'ru'),
(9, '0', 'Japanese', 'ja'),
(10, '0', 'Portuguese', 'pt'),
(11, '0', 'Swedish', 'sv'),
(12, '0', 'Chinese', 'zh'),
(13, '0', 'Catalan', 'ca'),
(14, '0', 'Ukrainian', 'uk'),
(15, '0', 'Norwegian (Bokmål)', 'no'),
(16, '0', 'Finnish', 'fi'),
(17, '0', 'Vietnamese', 'vi'),
(18, '0', 'Czech', 'cs'),
(19, '0', 'Hungarian', 'hu'),
(20, '0', 'Korean', 'ko'),
(21, '0', 'Indonesian', 'id'),
(22, '0', 'Turkish', 'tr'),
(23, '0', 'Romanian', 'ro'),
(24, '0', 'Persian', 'fa'),
(25, '0', 'Arabic', 'ar'),
(26, '0', 'Danish', 'da'),
(27, '0', 'Esperanto', 'eo'),
(28, '0', 'Serbian', 'sr'),
(29, '0', 'Lithuanian', 'lt'),
(30, '0', 'Slovak', 'sk'),
(31, '0', 'Malay', 'ms'),
(32, '0', 'Hebrew', 'he'),
(33, '0', 'Bulgarian', 'bg'),
(34, '0', 'Slovenian', 'sl'),
(35, '0', 'Volapük', 'vo'),
(36, '0', 'Kazakh', 'kk'),
(37, '0', 'Waray-Waray', 'war'),
(38, '0', 'Basque', 'eu'),
(39, '0', 'Croatian', 'hr'),
(40, '0', 'Hindi', 'hi'),
(41, '0', 'Estonian', 'et'),
(42, '0', 'Azerbaijani', 'az'),
(43, '0', 'Galician', 'gl'),
(44, '0', 'Simple English', 'simple'),
(45, '0', 'Norwegian (Nynorsk)', 'nn'),
(46, '0', 'Thai', 'th'),
(47, '0', 'Newar / Nepal Bhasa', 'new'),
(48, '0', 'Greek', 'el'),
(49, '0', 'Aromanian', 'roa-rup'),
(50, '0', 'Latin', 'la'),
(51, '0', 'Occitan', 'oc'),
(52, '0', 'Tagalog', 'tl'),
(53, '0', 'Haitian', 'ht'),
(54, '0', 'Macedonian', 'mk'),
(55, '0', 'Georgian', 'ka'),
(56, '0', 'Serbo-Croatian', 'sh'),
(57, '0', 'Telugu', 'te'),
(58, '0', 'Piedmontese', 'pms'),
(59, '0', 'Cebuano', 'ceb'),
(60, '0', 'Tamil', 'ta'),
(61, '0', 'Belarusian (Taraškievica)', 'be-x-old'),
(62, '0', 'Breton', 'br'),
(63, '0', 'Latvian', 'lv'),
(64, '0', 'Javanese', 'jv'),
(65, '0', 'Albanian', 'sq'),
(66, '0', 'Belarusian', 'be'),
(67, '0', 'Marathi', 'mr'),
(68, '0', 'Welsh', 'cy'),
(69, '0', 'Luxembourgish', 'lb'),
(70, '0', 'Icelandic', 'is'),
(71, '0', 'Bosnian', 'bs'),
(72, '0', 'Yoruba', 'yo'),
(73, '0', 'Malagasy', 'mg'),
(74, '0', 'Aragonese', 'an'),
(75, '0', 'Bishnupriya Manipuri', 'bpy'),
(76, '0', 'Lombard', 'lmo'),
(77, '0', 'West Frisian', 'fy'),
(78, '0', 'Bengali', 'bn'),
(79, '0', 'Ido', 'io'),
(80, '0', 'Swahili', 'sw'),
(81, '0', 'Gujarati', 'gu'),
(82, '0', 'Malayalam', 'ml'),
(83, '0', 'Western Panjabi', 'pnb'),
(84, '0', 'Afrikaans', 'af'),
(85, '0', 'Low Saxon', 'nds'),
(86, '0', 'Sicilian', 'scn'),
(87, '0', 'Urdu', 'ur'),
(88, '0', 'Kurdish', 'ku'),
(89, '0', 'Cantonese', 'zh-yue'),
(90, '0', 'Armenian', 'hy'),
(91, '0', 'Quechua', 'qu'),
(92, '0', 'Sundanese', 'su'),
(93, '0', 'Nepali', 'ne'),
(94, '0', 'Zazaki', 'diq'),
(95, '0', 'Asturian', 'ast'),
(96, '0', 'Tatar', 'tt'),
(97, '0', 'Neapolitan', 'nap'),
(98, '0', 'Irish', 'ga'),
(99, '0', 'Chuvash', 'cv'),
(100, '0', 'Samogitian', 'bat-smg'),
(101, '0', 'Walloon', 'wa'),
(102, '0', 'Amharic', 'am'),
(103, '0', 'Kannada', 'kn'),
(104, '0', 'Alemannic', 'als'),
(105, '0', 'Buginese', 'bug'),
(106, '0', 'Burmese', 'my'),
(107, '0', 'Interlingua', 'ia');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exp_applied_id` int(11) NOT NULL,
  `type` enum('request','schedule') NOT NULL,
  `duration` int(11) NOT NULL,
  `session_datetime` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `tag_id` varchar(100) NOT NULL COMMENT 'comma separated ids',
  `language_id` varchar(100) NOT NULL COMMENT 'comma separated ids',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `question` text NOT NULL,
  `other` text NOT NULL,
  `attachment_id` varchar(100) NOT NULL COMMENT 'comma separated values',
  `status` enum('0','1','2','3') NOT NULL COMMENT '''0''=>inactive,''1''=>active,''2''=>applied,''3''=>completed',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `session_review`
--

CREATE TABLE IF NOT EXISTS `session_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `review_from` int(11) NOT NULL,
  `review_to` int(11) NOT NULL,
  `extertise` int(11) NOT NULL,
  `advice` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `session_time`
--

CREATE TABLE IF NOT EXISTS `session_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `short_name`, `status`, `created`, `modified`) VALUES
(1, 'SEO (Search Engine Optimization)', 'seo', '1', '2015-08-13 17:18:18', '0000-00-00 00:00:00'),
(2, 'Marketing Strategy', 'marketingstrategy', '1', '2015-08-13 17:19:09', '0000-00-00 00:00:00'),
(3, 'Online marketing', 'onlinemarketing', '1', '2015-08-13 17:19:39', '0000-00-00 00:00:00'),
(4, 'Marketing', 'marketing', '1', '2015-08-13 17:19:57', '0000-00-00 00:00:00'),
(5, 'Social Media Marketing', 'socialmediamarketing', '1', '2015-08-13 17:20:16', '0000-00-00 00:00:00'),
(6, 'Business Strategy', 'businessstrategy', '1', '2015-08-13 17:20:38', '0000-00-00 00:00:00'),
(7, 'Social Media', 'socialmedia', '1', '2015-08-13 17:20:54', '0000-00-00 00:00:00'),
(8, 'Startups', 'startups', '1', '2015-08-13 17:21:08', '0000-00-00 00:00:00'),
(9, 'WordPress', 'wordPress', '1', '2015-08-13 17:21:20', '0000-00-00 00:00:00'),
(10, 'Business Development', 'businessdevelopment', '1', '2015-08-13 17:23:28', '0000-00-00 00:00:00'),
(11, 'Entrepreneurship', 'entrepreneurship', '1', '2015-08-13 17:23:41', '0000-00-00 00:00:00'),
(12, 'Web Development', 'webdevelopment', '1', '2015-08-13 17:23:59', '0000-00-00 00:00:00'),
(13, 'Webdesign', 'webdesign', '1', '2015-08-13 17:24:13', '0000-00-00 00:00:00'),
(14, 'Social Media Strategy', 'socialmediastrategy', '1', '2015-08-13 17:24:39', '0000-00-00 00:00:00'),
(15, 'Sales', 'sales', '1', '2015-08-13 17:25:02', '0000-00-00 00:00:00'),
(16, 'Financial', 'financial', '1', '2015-08-13 18:50:48', '0000-00-00 00:00:00'),
(17, 'Project Managemen', 'projectmanagement', '1', '2015-08-13 18:52:03', '0000-00-00 00:00:00'),
(18, 'Content Marketing', 'contentmarketing', '1', '2015-08-13 18:53:36', '0000-00-00 00:00:00'),
(19, 'Digital Marketing', 'digitalmarketing', '1', '2015-08-13 18:54:33', '0000-00-00 00:00:00'),
(20, 'Search Engine Marketing (SEM)', 'searchenginemarketing', '1', '2015-08-13 18:55:09', '0000-00-00 00:00:00'),
(21, 'Digital Strategy', 'digitalstrategy', '1', '2015-08-13 18:56:32', '0000-00-00 00:00:00'),
(22, 'Coaching', 'coaching', '1', '2015-08-13 18:57:37', '0000-00-00 00:00:00'),
(23, 'Google Analytics', 'googleanalytics', '1', '2015-08-13 18:58:16', '0000-00-00 00:00:00'),
(24, 'Content Strategy', 'contentstrategy', '1', '2015-08-13 18:59:10', '0000-00-00 00:00:00'),
(25, 'Online Advertising', 'onlineadvertising', '1', '2015-08-13 18:59:39', '0000-00-00 00:00:00'),
(26, 'Lean startup', 'leanstartup', '1', '2015-08-13 19:00:32', '0000-00-00 00:00:00'),
(27, 'Startup Consulting', 'startupconsulting', '1', '2015-08-13 19:01:15', '0000-00-00 00:00:00'),
(28, 'Web Analytics', 'webanalytics', '1', '2015-08-13 19:01:57', '0000-00-00 00:00:00'),
(29, 'Email Marketing', 'emailmarketing', '1', '2015-08-13 19:02:29', '0000-00-00 00:00:00'),
(30, 'User Experience (UX)', 'userexperienceux', '1', '2015-08-13 19:03:46', '0000-00-00 00:00:00'),
(31, 'Facebook', 'facebook', '1', '2015-08-13 19:04:09', '0000-00-00 00:00:00'),
(32, 'Innovation', 'innovation', '1', '2015-08-13 19:04:41', '0000-00-00 00:00:00'),
(33, 'Conversion Optimization', 'conversionoptimization', '1', '2015-08-13 19:05:24', '0000-00-00 00:00:00'),
(34, 'Communication', 'communication', '1', '2015-08-13 19:07:18', '0000-00-00 00:00:00'),
(35, 'New Business Development', 'newbusinessdevelopment', '1', '2015-08-13 19:08:01', '0000-00-00 00:00:00'),
(36, 'Social business', 'socialbusiness', '1', '2015-08-13 19:08:53', '0000-00-00 00:00:00'),
(37, 'JavaScript', 'javascript', '1', '2015-08-13 19:09:44', '0000-00-00 00:00:00'),
(38, 'Executive Coaching', 'executivecoaching', '1', '2015-08-13 19:10:34', '0000-00-00 00:00:00'),
(39, 'Business Coaching', 'businesscoaching', '1', '2015-08-13 19:11:05', '0000-00-00 00:00:00'),
(40, 'HTML5', 'html5', '1', '2015-08-13 19:11:52', '0000-00-00 00:00:00'),
(41, 'Search Engine Advertising (SEA)', 'searchengineadvertisingsea', '1', '2015-08-13 19:12:49', '0000-00-00 00:00:00'),
(42, 'Online Lead Generation', 'onlineleadgeneration', '1', '2015-08-13 19:13:39', '0000-00-00 00:00:00'),
(43, 'Google AdWords', 'googleadwords', '1', '2015-08-13 19:14:26', '0000-00-00 00:00:00'),
(44, 'Web Applications', 'webapplications', '1', '2015-08-13 19:15:00', '0000-00-00 00:00:00'),
(45, 'PHP', 'php', '1', '2015-08-13 19:16:03', '0000-00-00 00:00:00'),
(46, 'Product Development', 'productdevelopment', '1', '2015-08-13 19:16:31', '0000-00-00 00:00:00'),
(47, 'Consulting', 'consulting', '1', '2015-08-13 19:17:28', '0000-00-00 00:00:00'),
(48, 'Sales Management', 'salesmanagement', '1', '2015-08-13 19:17:59', '0000-00-00 00:00:00'),
(49, 'Business Modeling', 'businessmodeling', '1', '2015-08-13 19:18:24', '0000-00-00 00:00:00'),
(50, 'Business Modeling', 'businessmodeling', '1', '2015-08-13 19:18:24', '0000-00-00 00:00:00'),
(51, 'Social Media Monitoring', 'socialmediamonitoring', '1', '2015-08-13 19:18:47', '0000-00-00 00:00:00'),
(52, 'Branding', 'branding', '1', '2015-08-13 19:19:23', '0000-00-00 00:00:00'),
(53, 'Customer Service', 'customerservice', '1', '2015-08-13 19:19:51', '0000-00-00 00:00:00'),
(54, 'Blogging', 'blogging', '1', '2015-08-13 19:20:18', '0000-00-00 00:00:00'),
(55, 'Marketing Communications', 'marketingcommunications', '1', '2015-08-13 19:20:52', '0000-00-00 00:00:00'),
(56, 'Community Management', 'communitymanagement', '1', '2015-08-13 19:21:18', '0000-00-00 00:00:00'),
(57, 'Mobile Applications', 'mobileapplications', '1', '2015-08-13 19:22:14', '0000-00-00 00:00:00'),
(58, 'B2B Marketing', 'b2bmarketing', '1', '2015-08-13 19:28:58', '0000-00-00 00:00:00'),
(59, 'Internet marketing', 'internetmarketing', '1', '2015-08-13 19:29:28', '0000-00-00 00:00:00'),
(60, 'Software Development', 'softwaredevelopment', '1', '2015-08-13 19:30:05', '0000-00-00 00:00:00'),
(61, 'Interaction Design', 'interactiondesign', '1', '2015-08-13 19:30:45', '0000-00-00 00:00:00'),
(62, 'LinkedIn', 'linkedin', '1', '2015-08-13 19:31:17', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `linkedin_id` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
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
  `exp_expertise` varchar(100) NOT NULL COMMENT 'comma separated category ids',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_availability`
--

CREATE TABLE IF NOT EXISTS `user_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `wished_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
