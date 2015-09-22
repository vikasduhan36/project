-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2015 at 01:55 AM
-- Server version: 5.1.59-rel13.0-log
-- PHP Version: 5.4.23

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
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(255) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=256 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_code`, `country_name`) VALUES
(1, 'FR ', 'France'),
(4, 'DE ', 'Germany'),
(5, 'IE ', 'Ireland'),
(6, 'ES ', 'Spain'),
(7, 'GB ', 'United Kingdom'),
(8, 'US ', 'United States'),
(9, 'AF ', 'Afghanistan'),
(10, 'AL ', 'Albania'),
(11, 'DZ ', 'Algeria'),
(12, 'AS ', 'American samoa'),
(13, 'AD ', 'Andorra'),
(14, 'AO ', 'Angola'),
(15, 'AI ', 'Anguilla'),
(16, 'AQ ', 'Antarctica'),
(17, 'AG ', 'Antigua and Barbuda'),
(18, 'AR ', 'Argentina'),
(19, 'AM ', 'Armenia'),
(20, 'AW ', 'Aruba'),
(21, 'AU ', 'Australia'),
(22, 'AT ', 'Austria'),
(23, 'AZ ', 'Azerbaijan'),
(24, 'BS ', 'Bahamas'),
(25, 'BH ', 'Bahrain'),
(26, 'BD ', 'Bangladesh'),
(27, 'BB ', 'Barbados'),
(28, 'BY ', 'Belarus'),
(29, 'BE ', 'Belgium'),
(30, 'BZ ', 'Belize'),
(31, 'BJ ', 'Benin'),
(32, 'BM ', 'Bermuda'),
(33, 'BT ', 'Bhutan'),
(34, 'BO ', 'Bolivia'),
(35, 'BA ', 'Bosnia and Herzegovina'),
(36, 'BW ', 'Botswana'),
(37, 'BV ', 'Bouvet Island'),
(38, 'BR ', 'Brazil'),
(39, 'IO ', 'British Indian Ocean Territory'),
(40, 'BN ', 'Brunei Darussalam'),
(41, 'BG ', 'Bulgaria'),
(42, 'BF ', 'Burkina Faso'),
(43, 'BI ', 'Burundi'),
(44, 'KH ', 'Cambodia'),
(45, 'CM ', 'Cameroon'),
(46, 'CA ', 'Canada'),
(47, 'CV ', 'Cape Verde'),
(48, 'KY ', 'Cayman Islands'),
(49, 'CF ', 'Central African Republic'),
(50, 'TD ', 'Chad'),
(51, 'CL ', 'Chile'),
(52, 'CN ', 'China'),
(53, 'CX ', 'Christmas Island'),
(54, 'CC ', 'Cocos (Keeling) Islands'),
(55, 'CO ', 'Colombia'),
(56, 'KM ', 'Comoros'),
(57, 'CG ', 'Congo'),
(58, 'CK ', 'Cook Islands'),
(59, 'CR ', 'Costa Rica'),
(60, 'HR ', 'Croatia'),
(61, 'CU ', 'Cuba'),
(62, 'CY ', 'Cyprus'),
(63, 'CS ', 'Czech Republic'),
(64, 'DK ', 'Denmark'),
(65, 'DJ ', 'Djibouti'),
(66, 'DM ', 'Dominica'),
(67, 'DO ', 'Dominican Republic'),
(68, 'TP ', 'East Timor'),
(69, 'EC ', 'Ecuador'),
(70, 'EG ', 'Egypt'),
(71, 'SV ', 'El Salvador'),
(72, 'GQ ', 'Equatorial guinea'),
(73, 'ER ', 'Eritrea'),
(74, 'EE ', 'Estonia'),
(75, 'ET ', 'Ethiopia'),
(76, 'FK ', 'Falkland Islands (Malvinas)'),
(77, 'FO ', 'Faroe Islands'),
(78, 'FJ ', 'Fiji'),
(79, 'FI ', 'Finland'),
(80, 'GF ', 'French Guiana'),
(81, 'PF ', 'French Polynesia'),
(82, 'TF ', 'French Southern Territories'),
(83, 'GA ', 'Gabon'),
(84, 'GM ', 'Gambia'),
(85, 'GE ', 'Georgia'),
(86, 'GH ', 'Ghana'),
(87, 'GI ', 'Gibraltar'),
(88, 'GR ', 'Greece'),
(89, 'GL ', 'Greenland'),
(90, 'GD ', 'Grenada'),
(91, 'GP ', 'Guadeloupe'),
(92, 'GU ', 'Guam'),
(93, 'GT ', 'Guatemala'),
(94, 'GN ', 'Guinea'),
(95, 'GW ', 'Guinea-Bissau'),
(96, 'GY ', 'Guyana'),
(97, 'HT ', 'Haiti'),
(98, 'HM ', 'Heard Island and Mcdonald Islands'),
(99, 'VA ', 'Holy See (Vatican City State)'),
(100, 'HN ', 'Honduras'),
(101, 'HK ', 'Hong Kong'),
(102, 'HU ', 'Hungary'),
(103, 'IS ', 'Iceland'),
(104, 'IN ', 'India'),
(105, 'ID ', 'Indonesia'),
(106, 'IR ', 'Iran, Islamic Republic of'),
(107, 'IQ ', 'Iraq'),
(108, 'IL ', 'Israel'),
(109, 'IT ', 'Italy'),
(110, 'JM ', 'Jamaica'),
(111, 'JP ', 'Japan'),
(112, 'JO ', 'Jordan'),
(113, 'KZ ', 'Kazakstan'),
(114, 'KE ', 'Kenya'),
(115, 'KI ', 'Kiribati'),
(116, 'KP ', 'Korea, Democratic People''s Republic of'),
(117, 'KR ', 'Korea, Republic of'),
(118, 'KW ', 'Kuwait'),
(119, 'KG ', 'Kyrgyzstan'),
(120, 'LA ', 'Lao People''s Democratic Republic'),
(121, 'LV ', 'Latvia'),
(122, 'LB ', 'Lebanon'),
(123, 'LS ', 'Lesotho'),
(124, 'LR ', 'Liberia'),
(125, 'LY ', 'Libyan Arab Jamahiriya'),
(126, 'LI ', 'Liechtenstein'),
(127, 'LT ', 'Lithuania'),
(128, 'LU ', 'Luxembourg'),
(129, 'MO ', 'Macau'),
(130, 'MK ', 'Macedonia'),
(131, 'MG ', 'Madagascar'),
(132, 'MW ', 'Malawi'),
(133, 'MY ', 'Malaysia'),
(134, 'MV ', 'Maldives'),
(135, 'ML ', 'Mali'),
(136, 'MT ', 'Malta'),
(137, 'MH ', 'Marshall Islands'),
(138, 'MQ ', 'Martinique'),
(139, 'MR ', 'Mauritania'),
(140, 'MU ', 'Mauritius'),
(141, 'YT ', 'Mayotte'),
(142, 'MX ', 'Mexico'),
(143, 'FM ', 'Micronesia, Federated States of'),
(144, 'MD ', 'Moldova, Republic of'),
(145, 'MC ', 'Monaco'),
(146, 'MN ', 'Mongolia'),
(147, 'MS ', 'Montserrat'),
(148, 'MA ', 'Morocco'),
(149, 'MZ ', 'Mozambique'),
(150, 'MM ', 'Myanmar'),
(151, 'NA ', 'Namibia'),
(152, 'NR ', 'Nauru'),
(153, 'NP ', 'Nepal'),
(154, 'NL ', 'Netherlands'),
(155, 'AN ', 'Netherlands Antilles'),
(156, 'NC ', 'New Caledonia'),
(157, 'NZ ', 'New Zealand'),
(158, 'NI ', 'Nicaragua'),
(159, 'NE ', 'Niger'),
(160, 'NG ', 'Nigeria'),
(161, 'NU ', 'Niue'),
(162, 'NF ', 'Norfolk Island'),
(163, 'MP ', 'Northern Mariana Islands'),
(164, 'NO ', 'Norway'),
(165, 'OM ', 'Oman'),
(166, 'PK ', 'Pakistan'),
(167, 'PW ', 'Palau'),
(168, 'PA ', 'Panama'),
(169, 'PG ', 'Papua New Guinea'),
(170, 'PY ', 'Paraguay'),
(171, 'PE ', 'Peru'),
(172, 'PH ', 'Philippines'),
(173, 'PN ', 'Pitcairn'),
(174, 'PL ', 'Poland'),
(175, 'PT ', 'Portugal'),
(176, 'PR ', 'Puerto Rico'),
(177, 'QA ', 'Qatar'),
(178, 'RE ', 'Reunion'),
(179, 'RO ', 'Romania'),
(180, 'RU ', 'Russian Federation'),
(181, 'RW ', 'Rwanda'),
(182, 'SH ', 'Saint Helena'),
(183, 'KN ', 'Saint Kitts and Nevis'),
(184, 'LC ', 'Saint Lucia'),
(185, 'PM ', 'Saint Pierre and Miquelon'),
(186, 'VC ', 'Saint Vincent and the Grenadines'),
(187, 'WS ', 'Samoa (US)'),
(188, 'SM ', 'San Marino'),
(189, 'ST ', 'Sao Tome and Principe'),
(190, 'SA ', 'Saudi Arabia'),
(191, 'SN ', 'Senegal'),
(192, 'SC ', 'Seychelles'),
(193, 'SL ', 'Sierra Leone'),
(194, 'SG ', 'Singapore'),
(195, 'SK ', 'Slovakia'),
(196, 'SI ', 'Slovenia'),
(197, 'SB ', 'Solomon Islands'),
(198, 'SO ', 'Somalia'),
(199, 'GS ', 'South Georgia'),
(200, 'ZA ', 'South Africa'),
(201, 'LK ', 'Sri Lanka'),
(202, 'SD ', 'Sudan'),
(203, 'SR ', 'Suriname'),
(204, 'SJ ', 'Svalbard and Jan Mayen'),
(205, 'SZ ', 'Swaziland'),
(206, 'SE ', 'Sweden'),
(207, 'CH ', 'Switzerland'),
(208, 'SY ', 'Syrian Arab Republic'),
(209, 'TW ', 'Taiwan, Province of China'),
(210, 'TJ ', 'Tajikistan'),
(211, 'TZ ', 'Tanzania, United Republic of'),
(212, 'TH ', 'Thailand'),
(213, 'TG ', 'Togo'),
(214, 'TK ', 'Tokelau'),
(215, 'TO ', 'Tonga'),
(216, 'TT ', 'Trinidad and Tobago'),
(217, 'TN ', 'Tunisia'),
(218, 'TR ', 'Turkey'),
(219, 'TM ', 'Turkmenistan'),
(220, 'TC ', 'Turks and Caicos Islands'),
(221, 'TV ', 'Tuvalu'),
(222, 'UG ', 'Uganda'),
(223, 'UA ', 'Ukraine'),
(224, 'AE ', 'United Arab Emirates'),
(225, 'UM ', 'United States Minor Outlying Islands'),
(226, 'UY ', 'Uruguay'),
(227, 'UZ ', 'Uzbekistan'),
(228, 'VU ', 'Vanuatu'),
(229, 'VE ', 'Venezuela'),
(230, 'VN ', 'Vietnam'),
(231, 'VG ', 'Virgin Islands, British'),
(232, 'VI ', 'Virgin Islands, U.S.'),
(233, 'WF ', 'Wallis and Futuna'),
(234, 'EH ', 'Western Sahara'),
(235, 'YE ', 'Yemen'),
(236, 'YU ', 'Yugoslavia'),
(237, 'ZM ', 'Zambia'),
(238, 'ZW ', 'Zimbabwe'),
(239, 'AX', 'Aland Islands'),
(240, 'FR', 'Corsica, France'),
(241, 'IT', 'Sardinia, Italy'),
(242, 'IT', 'Vatican City, Italy'),
(243, 'NO', 'Spitzbergen, Norway'),
(244, 'ES', 'Azores, Spain'),
(245, 'ES', 'Madeira, Spain'),
(246, 'ES', 'Majorca, Spain'),
(247, 'ES', 'Menorca, Spain'),
(248, 'ES', 'Ibiza, Spain'),
(249, 'ES', 'Formentera, Spain'),
(250, 'ES', 'Canary Islands, Spain'),
(251, 'NO', 'Spitsbergen, Norway'),
(252, 'HLD', 'UK(Scottish Highlands)'),
(253, 'NIUK', 'UK(Northern Ireland)'),
(254, 'CI', 'UK(Channel Islands)'),
(255, 'IMUK', 'UK(Isle Of Man)');

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
(1, '1', 'English', 'en'),
(2, '1', 'German', 'de'),
(3, '1', 'French', 'fr'),
(4, '1', 'Dutch', 'nl'),
(5, '1', 'Italian', 'it'),
(6, '1', 'Spanish', 'es'),
(7, '1', 'Polish', 'pl'),
(8, '1', 'Russian', 'ru'),
(9, '1', 'Japanese', 'ja'),
(10, '1', 'Portuguese', 'pt'),
(11, '1', 'Swedish', 'sv'),
(12, '1', 'Chinese', 'zh'),
(13, '1', 'Catalan', 'ca'),
(14, '1', 'Ukrainian', 'uk'),
(15, '1', 'Norwegian (Bokmål)', 'no'),
(16, '1', 'Finnish', 'fi'),
(17, '1', 'Vietnamese', 'vi'),
(18, '1', 'Czech', 'cs'),
(19, '1', 'Hungarian', 'hu'),
(20, '1', 'Korean', 'ko'),
(21, '1', 'Indonesian', 'id'),
(22, '1', 'Turkish', 'tr'),
(23, '1', 'Romanian', 'ro'),
(24, '1', 'Persian', 'fa'),
(25, '1', 'Arabic', 'ar'),
(26, '1', 'Danish', 'da'),
(27, '1', 'Esperanto', 'eo'),
(28, '1', 'Serbian', 'sr'),
(29, '1', 'Lithuanian', 'lt'),
(30, '1', 'Slovak', 'sk'),
(31, '1', 'Malay', 'ms'),
(32, '1', 'Hebrew', 'he'),
(33, '1', 'Bulgarian', 'bg'),
(34, '1', 'Slovenian', 'sl'),
(35, '1', 'Volapük', 'vo'),
(36, '1', 'Kazakh', 'kk'),
(37, '1', 'Waray-Waray', 'war'),
(38, '1', 'Basque', 'eu'),
(39, '1', 'Croatian', 'hr'),
(40, '1', 'Hindi', 'hi'),
(41, '1', 'Estonian', 'et'),
(42, '1', 'Azerbaijani', 'az'),
(43, '1', 'Galician', 'gl'),
(44, '1', 'Simple English', 'simple'),
(45, '1', 'Norwegian (Nynorsk)', 'nn'),
(46, '1', 'Thai', 'th'),
(47, '1', 'Newar / Nepal Bhasa', 'new'),
(48, '1', 'Greek', 'el'),
(49, '1', 'Aromanian', 'roa-rup'),
(50, '1', 'Latin', 'la'),
(51, '1', 'Occitan', 'oc'),
(52, '1', 'Tagalog', 'tl'),
(53, '1', 'Haitian', 'ht'),
(54, '1', 'Macedonian', 'mk'),
(55, '1', 'Georgian', 'ka'),
(56, '1', 'Serbo-Croatian', 'sh'),
(57, '1', 'Telugu', 'te'),
(58, '1', 'Piedmontese', 'pms'),
(59, '1', 'Cebuano', 'ceb'),
(60, '1', 'Tamil', 'ta'),
(61, '1', 'Belarusian (Taraškievica)', 'be-x-old'),
(62, '1', 'Breton', 'br'),
(63, '1', 'Latvian', 'lv'),
(64, '1', 'Javanese', 'jv'),
(65, '1', 'Albanian', 'sq'),
(66, '1', 'Belarusian', 'be'),
(67, '1', 'Marathi', 'mr'),
(68, '1', 'Welsh', 'cy'),
(69, '1', 'Luxembourgish', 'lb'),
(70, '1', 'Icelandic', 'is'),
(71, '1', 'Bosnian', 'bs'),
(72, '1', 'Yoruba', 'yo'),
(73, '1', 'Malagasy', 'mg'),
(74, '1', 'Aragonese', 'an'),
(75, '1', 'Bishnupriya Manipuri', 'bpy'),
(76, '1', 'Lombard', 'lmo'),
(77, '1', 'West Frisian', 'fy'),
(78, '1', 'Bengali', 'bn'),
(79, '1', 'Ido', 'io'),
(80, '1', 'Swahili', 'sw'),
(81, '1', 'Gujarati', 'gu'),
(82, '1', 'Malayalam', 'ml'),
(83, '1', 'Western Panjabi', 'pnb'),
(84, '1', 'Afrikaans', 'af'),
(85, '1', 'Low Saxon', 'nds'),
(86, '1', 'Sicilian', 'scn'),
(87, '1', 'Urdu', 'ur'),
(88, '1', 'Kurdish', 'ku'),
(89, '1', 'Cantonese', 'zh-yue'),
(90, '1', 'Armenian', 'hy'),
(91, '1', 'Quechua', 'qu'),
(92, '1', 'Sundanese', 'su'),
(93, '1', 'Nepali', 'ne'),
(94, '1', 'Zazaki', 'diq'),
(95, '1', 'Asturian', 'ast'),
(96, '1', 'Tatar', 'tt'),
(97, '1', 'Neapolitan', 'nap'),
(98, '1', 'Irish', 'ga'),
(99, '1', 'Chuvash', 'cv'),
(100, '1', 'Samogitian', 'bat-smg'),
(101, '1', 'Walloon', 'wa'),
(102, '1', 'Amharic', 'am'),
(103, '1', 'Kannada', 'kn'),
(104, '1', 'Alemannic', 'als'),
(105, '1', 'Buginese', 'bug'),
(106, '1', 'Burmese', 'my'),
(107, '1', 'Interlingua', 'ia');

-- --------------------------------------------------------

--
-- Table structure for table `partner_category`
--

CREATE TABLE IF NOT EXISTS `partner_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `partner_category`
--

INSERT INTO `partner_category` (`id`, `name`) VALUES
(1, 'PRDESQ Academy'),
(2, 'Marketingfacts'),
(3, 'Springest'),
(4, 'WeTalent'),
(5, 'ZEEF.com'),
(6, 'NexusThemes'),
(7, 'Your Website');

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
  `time_requested` enum('0','1') NOT NULL DEFAULT '0',
  `video_duration` int(11) NOT NULL DEFAULT '0',
  `video_start_time` datetime NOT NULL,
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
  `exp_hired` int(11) NOT NULL DEFAULT '0',
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
  `tokbox_id` text NOT NULL,
  `exp_description` text NOT NULL,
  `exp_help` text NOT NULL,
  `exp_category_id` varchar(100) NOT NULL COMMENT 'comma separated category ids',
  `exp_tag_id` varchar(255) NOT NULL COMMENT 'comma separated tag ids',
  `exp_rate` int(11) NOT NULL COMMENT '''int value''',
  `exp_about` text NOT NULL,
  `exp_experience` text NOT NULL,
  `exp_education` text NOT NULL,
  `exp_interest` text NOT NULL,
  `exp_award` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login_type`, `email`, `password`, `fname`, `lname`, `username`, `gender`, `profile_image`, `city`, `country_id`, `timezone_id`, `language_id`, `dob`, `phone`, `linkedin_url`, `twitter_url`, `google_url`, `facebook_url`, `is_expert`, `tokbox_id`, `exp_description`, `exp_help`, `exp_category_id`, `exp_tag_id`, `exp_rate`, `exp_about`, `exp_experience`, `exp_education`, `exp_interest`, `exp_award`, `status`, `created`, `modified`) VALUES
(1, 'static', 'vikasduhan36@gmail.com', '123456', 'vikas', 'duhan', 'vikas duhan', 'male', 'http://www.techcreatures.com/profile_pic/144173857017034-tumblr-nlkz9e4qmc1t0jzb1o1-1280.jpg', 'chandigarh', 'IN', 103, '1,40', '1989-03-07', '', '', '', '', '', '1', '1_MX40NTMzMTUzMn5-MTQ0MTczODcwODgwNH5wSzhwNitBWFNkeTZGMFdROUhFdlRyN2V-fg', '', '', '', '', 0, '', '', '', '', '', '0', '2015-09-08 18:55:32', '0000-00-00 00:00:00'),
(2, 'static', 'vivek_choudhary@hotmail.com', 'vivek', '', '', '', 'male', 'http://www.techcreatures.com/profile_pic/1442802509.jpg', '', '', 0, '', '0000-00-00', '', '', '', '', '', '0', '', '', '', '', '', 0, '', '', '', '', '', '0', '2015-09-21 02:24:35', '0000-00-00 00:00:00'),
(3, 'google', 'sricky555@gmail.com', 'z1r8441v8r', 'Ricky', 'Sharma', 'Ricky Sharma', 'male', 'https://lh4.googleusercontent.com/-7ISVt0LQyyY/AAAAAAAAAAI/AAAAAAAAABo/XiRkfsJISqk/photo.jpg?sz=50', '', '', 0, '', '0000-00-00', '', '', 'https://twitter.com/ChvivekKumar', '', '', '1', '1_MX40NTMzMTUzMn5-MTQ0Mjg4NTYzOTQyM35UNXVDQU82QVl2NDFoTG9ldTZpME5LSzZ-fg', 'I''m a web developer .', 'I''m a web developer .', '2', '2,45', 5, '', '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_availability`
--

CREATE TABLE IF NOT EXISTS `user_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `from` time NOT NULL,
  `to` time NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '''0''=>inactive,''1''=>active',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `user_availability`
--

INSERT INTO `user_availability` (`id`, `user_id`, `day`, `from`, `to`, `status`, `created`) VALUES
(31, 1, 'Monday', '03:30:00', '11:30:00', '1', '2015-09-20 14:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_website`
--

CREATE TABLE IF NOT EXISTS `user_website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
