-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2015 at 07:17 AM
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
