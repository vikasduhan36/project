-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2015 at 06:50 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
  `exp_reschedule` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0''=>NO,''1''=>YES',
  `user_reschedule` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0''=>NO,''1''=>YES',
  `status` enum('0','1','2','3') NOT NULL COMMENT '''0''=>inactive,''1''=>active,''2''=>applied,''3''=>completed',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `exp_applied_id`, `type`, `duration`, `session_datetime`, `category_id`, `tag_id`, `language_id`, `title`, `description`, `question`, `other`, `attachment_id`, `exp_reschedule`, `user_reschedule`, `status`, `created`, `modified`) VALUES
(3, 1, 2, 'schedule', 20, '0000-00-00 00:00:00', 0, '', '', 'test', 'test', 'test', 'test', '', '0', '0', '1', '2015-08-13 07:34:11', '0000-00-00 00:00:00'),
(4, 1, 2, 'schedule', 10, '0000-00-00 00:00:00', 0, '', '', 'new new ', 'new new new new new new new new new new new new new new new new new ', 'new new new new ', 'new new new new ', '', '0', '0', '1', '2015-08-14 06:30:07', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `session_time`
--

INSERT INTO `session_time` (`id`, `user_id`, `session_id`, `datetime`) VALUES
(1, 1, 3, '2015-08-21 04:30:00'),
(2, 1, 4, '2015-08-14 03:30:00');

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
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
  `id` int(11) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `timezone` time DEFAULT NULL,
  `timezone_dst` varchar(100) DEFAULT NULL,
  `abbrevation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `country_id`, `name`, `timezone`, `timezone_dst`, `abbrevation`) VALUES
(2, NULL, 'Adelaide', '09:30:00', NULL, 'Australia/Adelaide'),
(3, NULL, 'Beijing, Chonging, Hong Kong, Urumqi', '08:00:00', NULL, 'Asia/Hong_Kong'),
(4, NULL, 'Brasilia', '-03:00:00', NULL, 'America/Sao_Paulo'),
(6, NULL, 'Brisbane', '10:00:00', NULL, 'Australia/Brisbane'),
(7, NULL, 'Kabul', '04:30:00', NULL, 'Asia/Kabul'),
(8, NULL, 'Baja California', '-08:00:00', NULL, 'America/Ensenada'),
(9, NULL, 'Alaska', '-09:00:00', NULL, 'US/Alaska'),
(10, NULL, 'Buenos Airies', '-03:00:00', NULL, 'America/Buenos_Aires'),
(11, NULL, 'Ashgabat, Tashkent', '05:00:00', NULL, 'Asia/Ashgabat'),
(12, NULL, 'Asuncion', '-04:00:00', NULL, 'America/Asuncion'),
(13, NULL, 'Abu Dhabi, Muscat', '04:00:00', NULL, 'Asia/Muscat'),
(14, NULL, 'Cayenne, Fortaleza', '-03:00:00', NULL, 'America/Cayenne'),
(15, NULL, 'Baghdad', '03:00:00', NULL, 'Asia/Baghdad'),
(16, NULL, 'Atlantic Time (Canada)', '-04:00:00', NULL, 'Canada/Atlantic'),
(17, NULL, 'Osaka, Sapparo, Tokyo', '09:00:00', NULL, 'Asia/Tokyo'),
(18, NULL, 'Irkutsk (RT 7)', '08:00:00', NULL, 'Asia/Irkutsk'),
(19, NULL, 'Azores', '-01:00:00', NULL, 'Atlantic/Azores'),
(20, NULL, 'Baku', '04:00:00', NULL, 'Asia/Baku'),
(21, NULL, 'Kuala Lumpur, Singapore', '08:00:00', NULL, 'Asia/Kuala_Lumpur'),
(22, NULL, 'Astana', '06:00:00', NULL, 'Asia/Dhaka'),
(24, NULL, 'Cuiaba', '-04:00:00', NULL, 'America/Cuiaba'),
(25, NULL, 'Greenland', '-03:00:00', NULL, 'America/Godthab'),
(26, NULL, 'Dhaka', '06:00:00', NULL, 'Asia/Dhaka'),
(27, NULL, 'Amsterdam, Berlin, Bern, Rome, Stockholm', '01:00:00', NULL, 'Europe/Amsterdam'),
(28, NULL, 'Novosibirsk (RTZ 5)', '06:00:00', NULL, 'Asia/Novosibirsk'),
(29, NULL, 'Amman', '02:00:00', NULL, 'Asia/Amman'),
(30, NULL, 'Yangon (Rangoon)', '06:30:00', NULL, 'Asia/Rangoon'),
(31, NULL, 'Bogota, Lima, Quito, Rio Branco', '-05:00:00', NULL, 'America/Bogota'),
(32, NULL, 'Georgetown, La Paz, Manaus, San Juan', '-04:00:00', NULL, 'America/Manaus'),
(33, NULL, 'Athens, Bucharest', '02:00:00', NULL, 'Europe/Athens'),
(34, NULL, 'Beirut', '02:00:00', NULL, 'Asia/Beirut'),
(35, NULL, 'Beldgrade, Bradislava, Budapest, Prague', '01:00:00', NULL, 'Europe/Budapest'),
(37, NULL, 'CHAST', '12:45:00', NULL, 'Pacific/Chatham'),
(38, NULL, 'Perth', '08:00:00', NULL, 'Australia/Perth'),
(39, NULL, 'Canberra, Melbourne, Sydney', '10:00:00', NULL, 'Australia/Canberra'),
(40, NULL, 'Guam, Port Moresby', '10:00:00', NULL, 'Pacific/Guam'),
(42, NULL, 'Taipei', '08:00:00', NULL, 'Asia/Taipei'),
(44, NULL, 'Montevideo', '-03:00:00', NULL, 'America/Montevideo'),
(45, NULL, 'Santiago', '-04:00:00', NULL, 'America/Santiago'),
(48, NULL, 'Central America', '-06:00:00', NULL, 'US/Central'),
(49, NULL, 'Ulaanbaatar', '08:00:00', NULL, 'Asia/Ulaanbaatar'),
(50, NULL, 'Darwin', '09:30:00', NULL, 'Australia/Darwin'),
(52, NULL, 'Indiana (East)', '-05:00:00', NULL, 'US/East-Indiana'),
(54, NULL, 'Cape Verde Is.', '-01:00:00', NULL, 'Atlantic/Cape_Verde'),
(56, NULL, 'Bangkok, Hanoi, Jakarta', '07:00:00', NULL, 'Asia/Bangkok'),
(57, NULL, 'Krasnoyarsk, (RTZ 6)', '07:00:00', NULL, 'Asia/Krasnoyarsk'),
(58, NULL, 'Hobart', '10:00:00', NULL, 'Australia/Hobart'),
(59, NULL, 'Brussels, Copenhagen, Madrid, Paris', '01:00:00', NULL, 'Europe/Brussels'),
(61, NULL, 'Central Time (US & Canada)', '-06:00:00', NULL, 'US/Central'),
(62, NULL, 'Kuwait, Riyadh', '03:00:00', NULL, 'Asia/Kuwait'),
(66, NULL, 'Minsk', '03:00:00', NULL, 'Europe/Minsk'),
(67, NULL, 'Moscow, St. Petersburg, Volgograd (RTZ 2)', '03:00:00', NULL, 'Europe/Moscow'),
(68, NULL, 'Cairo', '02:00:00', NULL, 'Africa/Cairo'),
(71, NULL, 'Seoul', '09:00:00', NULL, 'Asia/Seoul'),
(72, NULL, 'Eastern Time (US and Canada)', '-05:00:00', NULL, 'US/Eastern'),
(73, NULL, 'Magadan', '10:00:00', NULL, 'Asia/Magadan'),
(74, NULL, 'Nairobi', '03:00:00', NULL, 'Africa/Nairobi'),
(75, NULL, 'Anadyr, Petropavlovsk - Kamchatsky (RTZ 11)', '12:00:00', NULL, 'Asia/Anadyr'),
(76, NULL, 'Salvador', '-03:00:00', NULL, 'America/El_Salvador'),
(80, NULL, 'Guadalajara, Mexico City, Monterry', '-06:00:00', NULL, 'America/Mexico_City'),
(82, NULL, 'Izhevsk, Samara (RTZ 3)', '04:00:00', NULL, 'Europe/Samara'),
(84, NULL, 'Auckland, Wellington', '12:00:00', NULL, 'Pacific/Auckland'),
(86, NULL, 'Casablanca', '00:00:00', NULL, 'Africa/Casablanca'),
(88, NULL, 'Port Louis', '04:00:00', NULL, NULL),
(91, NULL, 'Damascus', '02:00:00', NULL, 'Asia/Damascus'),
(94, NULL, 'Ekaterinburg (RTZ 4)', '05:00:00', NULL, 'Asia/Yekaterinburg'),
(96, NULL, 'Hawaii', '-10:00:00', NULL, 'US/Hawaii'),
(101, NULL, 'Yakutsk (RTZ 8)', '09:00:00', NULL, 'Asia/Yakutsk'),
(102, NULL, 'Tehran', '03:30:00', NULL, 'Asia/Tehran'),
(103, NULL, 'Chennai, Kolkata, Mumbai, New Delhi', '05:30:00', NULL, 'Asia/Kolkata'),
(104, NULL, 'Sarejavo, Skopje, Warsaw, Zagreb', '01:00:00', NULL, 'Europe/Skopje'),
(105, NULL, 'East Europe', '02:00:00', NULL, NULL),
(108, NULL, 'Solomon Is, New Caledonia', '11:00:00', NULL, 'Asia/Magadan'),
(113, NULL, 'Kritimati Island', '00:00:00', NULL, NULL),
(116, NULL, 'Islamabad, Karachi', '05:00:00', NULL, 'Asia/Karachi'),
(117, NULL, 'Saskatchewan', '-06:00:00', NULL, 'Canada/Saskatchewan'),
(118, NULL, 'West Central Africa', '01:00:00', NULL, 'Africa/Lagos'),
(119, NULL, 'Harare, Pretoria', '02:00:00', NULL, 'Africa/Harare'),
(120, NULL, 'Fiji', '12:00:00', NULL, 'Pacific/Fiji'),
(124, NULL, 'Tbilisi', '04:00:00', NULL, 'Asia/Tbilisi'),
(126, NULL, 'Mountain Time (US and Canada)', '-07:00:00', NULL, 'US/Mountain'),
(128, NULL, 'Yerevan', '04:00:00', NULL, 'Asia/Yerevan'),
(134, NULL, 'Kathmandu', '05:45:00', NULL, 'Asia/Kathmandu'),
(135, NULL, 'Newfoundland', '-03:30:00', NULL, 'Canada/Newfoundland'),
(138, NULL, 'Nuku''alofa', '13:00:00', NULL, 'Pacific/Tongatapu'),
(142, NULL, 'Arizona', '-07:00:00', NULL, 'US/Arizona'),
(145, NULL, 'Vladivostok, Magadan (RTZ 9)', '10:00:00', NULL, 'Asia/Vladivostok'),
(146, NULL, 'Samoa', '13:00:00', NULL, 'Pacific/Samoa'),
(151, NULL, 'Pacific Time (US and Canada)', '-08:00:00', NULL, 'US/pacific'),
(159, NULL, 'Helsinki, Kyiv, Riga, Sofia, Talinn, Vilnius', '02:00:00', NULL, 'Europe/Helsinki'),
(163, NULL, 'Sri Jayawardenepura', '05:30:00', NULL, 'Asia/Colombo'),
(179, NULL, 'Dublin, Edinburgh, Lisbon, London', '00:00:00', NULL, 'Europe/Dublin'),
(183, NULL, 'Caracas', '-04:30:00', NULL, 'America/Caracas'),
(189, NULL, 'Istanbul', '02:00:00', NULL, 'Asia/Istanbul'),
(190, NULL, 'Windhoek', '01:00:00', NULL, 'Africa/Windhoek'),
(193, NULL, 'Monrovia, Reykjavik', '00:00:00', NULL, 'Africa/Monrovia');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `linkedin_id`, `email`, `password`, `fname`, `lname`, `profile_image`, `city`, `country_id`, `timezone_id`, `language_id`, `dob`, `phone`, `linkedin_url`, `twitter_url`, `google_url`, `facebook_url`, `is_expert`, `exp_description`, `exp_help`, `exp_expertise`, `exp_rate`, `exp_about`, `exp_experience`, `exp_education`, `exp_interest`, `exp_award`, `status`, `created`, `modified`) VALUES
(1, '', 'test@mail.com', '123456', 'test', 'test', 'test', 'test', 1, 103, '1', '2015-08-03', '123', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '0', '2015-08-04 00:00:00', '0000-00-00 00:00:00'),
(2, '', 'exp@mail.com', '123456', 'exp', 'exp', 'exp', 'exp', 1, 103, '1', '2015-08-04', '123', '', '', '', '', '1', 'exp', 'exp', 'exp', '20', 'exp', 'exp', 'exp', 'exp', 'exp', '1', '2015-08-12 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_availability`
--

INSERT INTO `user_availability` (`id`, `user_id`, `from`, `to`, `status`, `created`) VALUES
(6, 2, '2015-08-21 04:30:00', '2015-08-21 05:30:00', '1', '2015-08-13 04:57:18'),
(7, 2, '2015-08-14 03:30:00', '2015-08-14 11:30:00', '1', '2015-08-14 06:17:32'),
(8, 2, '2015-08-14 03:30:00', '2015-08-14 11:30:00', '1', '2015-08-14 06:17:55'),
(9, 2, '2015-08-21 03:30:00', '2015-08-21 11:30:00', '1', '2015-08-14 16:44:27');

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
