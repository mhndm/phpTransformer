-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 18, 2014 at 09:56 ص
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cyberaman`
--

-- --------------------------------------------------------

--
-- Table structure for table `cclang`
--

CREATE TABLE IF NOT EXISTS `cclang` (
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `Contry` varchar(50) NOT NULL COMMENT 'اسم البلد',
  `Langcc` varchar(10) NOT NULL COMMENT 'لغة البلد',
  `rank` bigint(11) NOT NULL,
  `ccode` int(5) NOT NULL,
  PRIMARY KEY (`cc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لغة البلدان على اساس كود البلد';

--
-- Dumping data for table `cclang`
--

INSERT INTO `cclang` (`cc`, `Contry`, `Langcc`, `rank`, `ccode`) VALUES
('AF', 'Afghanistan (افغانستان)', 'English', 1, 93),
('AL', 'Albania (Shqipëria)', 'English', 1, 355),
('DZ', 'Algeria (الجمهورية الجزائرية)', 'Arabic', 1, 213),
('AS', 'American Samoa', 'English', 1, 684),
('AD', 'Andorra', 'English', 1, 376),
('AO', 'Angola', 'English', 1, 244),
('AI', 'Anguilla', 'English', 1, 1264),
('AQ', 'Antarctica', 'English', 1, 672),
('AG', 'Antigua and Barbuda', 'English', 1, 1268),
('AR', 'Argentina', 'English', 1, 54),
('AM', 'Armenia ( Հայաստանի Հանրապետություն )', 'English', 1, 374),
('AW', 'Aruba', 'English', 1, 297),
('AP', 'Asia/Pacific Region', 'English', 1, 0),
('AU', 'Australia', 'English', 1, 61),
('AT', 'Austria (?sterreich)', 'English', 1, 43),
('AZ', 'Azerbaijan (Az?rbaycan)', 'English', 1, 994),
('BS', 'Bahamas', 'English', 1, 1242),
('BH', 'Bahrain (بحرين)', 'Arabic', 1, 973),
('BD', 'Bangladesh  ( গণপ্রজাতন্ত্রী বাংলাদেশ )', 'English', 1, 880),
('BB', 'Barbados', 'English', 1, 1246),
('BY', 'Belarus ( Рэспубліка Беларусь )', 'English', 1, 375),
('BE', 'Belgium (België)', 'English', 1, 32),
('BZ', 'Belize', 'English', 1, 501),
('BJ', 'Benin (Bénin)', 'English', 1, 229),
('BM', 'Bermuda', 'English', 1, 1441),
('BT', 'Bhutan ( འབྲུག་རྒྱལ་ཁབ་ )', 'English', 1, 975),
('BO', 'Bolivia', 'English', 1, 591),
('BA', 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'English', 1, 387),
('BW', 'Botswana', 'English', 1, 267),
('BR', 'Brazil (Brasil)', 'English', 1, 55),
('IO', 'British Indian Ocean Territory', 'English', 1, 246),
('BN', 'Brunei (Brunei Darussalam)', 'English', 1, 673),
('BG', 'Bulgaria ( Република България )', 'English', 1, 359),
('BF', 'Burkina Faso', 'English', 1, 226),
('BI', 'Burundi (Uburundi)', 'English', 1, 257),
('KH', 'Cambodia (Kampuchea)', 'English', 1, 855),
('CM', 'Cameroon (Cameroun)', 'English', 1, 237),
('CA', 'Canada', 'English', 1, 1),
('CV', 'Cape Verde (Cabo Verde)', 'English', 1, 238),
('KY', 'Cayman Islands', 'English', 1, 1345),
('CF', 'Central African Republic (République Centrafricain', 'English', 1, 236),
('TD', 'Chad (Tchad)', 'English', 1, 235),
('CL', 'Chile', 'English', 1, 56),
('CN', 'China ( 中华人民共和国 )', 'English', 1, 86),
('CO', 'Colombia', 'English', 1, 57),
('KM', 'Comoros (Comores)', 'English', 1, 269),
('CG', 'Congo', 'English', 1, 242),
('CD', 'Congo, The Democratic Republic of the', 'English', 1, 243),
('CK', 'Cook Islands', 'English', 1, 682),
('CR', 'Costa Rica', 'English', 1, 506),
('CI', 'Côte D''Ivoire', 'English', 1, 225),
('HR', 'Croatia (Hrvatska)', 'English', 1, 385),
('CU', 'Cuba', 'English', 1, 53),
('CY', 'Cyprus ( Κυπριακή Δημοκρατία )', 'English', 1, 357),
('CZ', 'Czech Republic (?esko)', 'English', 1, 420),
('DK', 'Denmark (Danmark)', 'English', 1, 45),
('DJ', 'Djibouti', 'English', 1, 253),
('DM', 'Dominica', 'English', 1, 1767),
('DO', 'Dominican Republic', 'English', 1, 809),
('EC', 'Ecuador', 'English', 1, 593),
('EG', 'Egypt (مصر)', 'Arabic', 1, 20),
('SV', 'El Salvador', 'English', 1, 503),
('GQ', 'Equatorial Guinea (Guinea Ecuatorial)', 'English', 1, 240),
('ER', 'Eritrea (Ertra)', 'English', 1, 291),
('EE', 'Estonia (Eesti)', 'English', 1, 372),
('ET', 'Ethiopia ( ye-Ītyōṗṗyā )', 'English', 1, 251),
('EU', 'Europe', 'English', 1, 0),
('FK', 'Falkland Islands (Malvinas)', 'English', 1, 500),
('FO', 'Faroe Islands', 'English', 1, 298),
('FJ', 'Fiji', 'English', 1, 679),
('FI', 'Finland (Suomi)', 'English', 1, 358),
('FR', 'France', 'English', 1, 33),
('GF', 'French Guiana', 'English', 1, 594),
('PF', 'French Polynesia', 'English', 1, 689),
('GA', 'Gabon', 'English', 1, 241),
('GM', 'Gambia', 'English', 1, 220),
('GE', 'Georgia ( საქართველო )', 'English', 1, 995),
('DE', 'Germany (Deutschland)', 'English', 1, 49),
('GH', 'Ghana', 'English', 1, 233),
('GI', 'Gibraltar', 'English', 1, 350),
('GR', 'Greece ( Ελληνική Δημοκρατία )', 'English', 1, 30),
('GL', 'Greenland', 'English', 1, 299),
('GD', 'Grenada', 'English', 1, 1473),
('GP', 'Guadeloupe', 'English', 1, 590),
('GU', 'Guam', 'English', 1, 1671),
('GT', 'Guatemala', 'English', 1, 502),
('GN', 'Guinea (Guinée)', 'English', 1, 224),
('GW', 'Guinea-Bissau (Guiné-Bissau)', 'English', 1, 245),
('GY', 'Guyana', 'English', 1, 592),
('HT', 'Haiti (Haïti)', 'English', 1, 509),
('VA', 'Holy See (Vatican City State)', 'English', 1, 39),
('HN', 'Honduras', 'English', 1, 504),
('HK', 'Hong Kong', 'English', 1, 852),
('HU', 'Hungary (Magyarorsz?g)', 'English', 1, 36),
('IS', 'Iceland (?sland)', 'English', 1, 354),
('IN', 'India', 'English', 1, 91),
('ID', 'Indonesia', 'English', 1, 62),
('IR', 'Iran,  (الجمهورية الاسلامية في ايران)', 'Arabic', 1, 98),
('IQ', 'Iraq (العراق)', 'Arabic', 1, 964),
('IE', 'Ireland', 'English', 1, 353),
('IL', 'Other', 'English', 1, 972),
('IT', 'Italy (Italia)', 'English', 1, 39),
('JM', 'Jamaica', 'English', 1, 1876),
('JP', 'Japan', 'English', 1, 81),
('JO', 'Jordan (الأردن)', 'Arabic', 1, 962),
('KZ', 'Kazakhstan ( قازاقستان )', 'English', 1, 7),
('KE', 'Kenya', 'English', 1, 254),
('KI', 'Kiribati', 'English', 1, 686),
('EH', 'Western Sahara (صحراوية)', 'English', 1, 212),
('KR', 'South Korea (??)', 'English', 1, 82),
('KW', 'Kuwait (الكويت)', 'Arabic', 1, 965),
('KG', 'Kyrgyzstan ( Кыргыз Республикасы )', 'English', 1, 996),
('LA', 'Lao People''s Democratic Republic ( ສາທາລະນະລັດປະຊາ', 'English', 1, 856),
('LV', 'Latvia (Latvija)', 'English', 1, 371),
('LB', 'Lebanon (لبنان)', 'Arabic', 1, 961),
('LS', 'Lesotho', 'English', 1, 266),
('LR', 'Liberia', 'English', 1, 231),
('LY', 'Libyan Arab Jamahiriya (ليبيا)', 'Arabic', 1, 218),
('LI', 'Liechtenstein', 'English', 1, 423),
('LT', 'Lithuania (Lietuva)', 'English', 1, 370),
('LU', 'Luxembourg (Lëtzebuerg)', 'English', 1, 352),
('MO', 'Macau', 'English', 1, 853),
('MK', 'Macedonia ( Република Македонија )', 'English', 1, 389),
('MG', 'Madagascar (Madagasikara)', 'English', 1, 261),
('MW', 'Malawi', 'English', 1, 265),
('MY', 'Malaysia', 'English', 1, 60),
('MV', 'Maldives ( ދިވެހިރާއްޖޭގެ ޖުމްހޫރިއްޔާ )', 'English', 1, 960),
('ML', 'Mali', 'English', 1, 223),
('MT', 'Malta', 'English', 1, 356),
('MH', 'Marshall Islands', 'English', 1, 692),
('MQ', 'Martinique', 'English', 1, 596),
('MR', 'Mauritania (موريتانية)', 'Arabic', 1, 222),
('MU', 'Mauritius', 'English', 1, 230),
('YT', 'Mayotte', 'English', 1, 269),
('MX', 'Mexico (México)', 'English', 1, 52),
('FM', 'Micronesia, Federated States of', 'English', 1, 691),
('MD', 'Moldova, Republic of', 'English', 1, 373),
('MC', 'Monaco', 'English', 1, 377),
('MN', 'Mongolia ( Монгол улс )', 'English', 1, 976),
('ME', 'Montenegro ( Црна Гора )', 'English', 1, 382),
('MS', 'Montserrat', 'English', 1, 1664),
('MA', 'Morocco (المغرب)', 'Arabic', 1, 212),
('MZ', 'Mozambique (Moçambique)', 'English', 1, 258),
('MM', 'Myanmar ( Pyidaunzu Thanmăda Myăma Nainngandaw)', 'English', 1, 95),
('NA', 'Namibia', 'English', 1, 264),
('NR', 'Nauru (Naoero)', 'English', 1, 674),
('NP', 'Nepal (  सङ्घीय लोकतान्त्रिक गणतन्त्र नेपाल )', 'English', 1, 977),
('NL', 'Netherlands (Nederland)', 'English', 1, 31),
('AN', 'Netherlands Antilles', 'English', 1, 599),
('NC', 'New Caledonia', 'English', 1, 687),
('NZ', 'New Zealand', 'English', 1, 64),
('NI', 'Nicaragua', 'English', 1, 505),
('NE', 'Niger', 'English', 1, 227),
('NG', 'Nigeria', 'English', 1, 234),
('NU', 'Niue', 'English', 1, 683),
('NF', 'Norfolk Island', 'English', 1, 672),
('MP', 'Northern Mariana Islands', 'English', 1, 670),
('NO', 'Norway (Norge)', 'English', 1, 47),
('OM', 'Oman (عمان)', 'Arabic', 1, 968),
('PK', 'Pakistan (پاکستان)', 'English', 1, 92),
('PW', 'Palau', 'English', 1, 680),
('PS', 'Other', 'English', 1, 0),
('PA', 'Panama ( República de Panamá )', 'English', 1, 507),
('PG', 'Papua New Guinea', 'English', 1, 675),
('PY', 'Paraguay', 'English', 1, 595),
('PE', 'Peru (Per?)', 'English', 1, 51),
('PH', 'Philippines (Pilipinas)', 'English', 1, 63),
('PL', 'Poland (Polska)', 'English', 1, 48),
('PT', 'Portugal', 'English', 1, 351),
('PR', 'Puerto Rico', 'English', 1, 1787),
('QA', 'Qatar (قطر)', 'Arabic', 1, 974),
('RE', 'Reunion', 'English', 1, 262),
('RO', 'Romania (România)', 'English', 1, 40),
('RU', 'Russia ( Российская Федерация )', 'English', 1, 7),
('RW', 'Rwanda', 'English', 1, 250),
('KN', 'Saint Kitts and Nevis', 'English', 1, 1869),
('LC', 'Saint Lucia', 'English', 1, 1758),
('VC', 'Saint Vincent and the Grenadines', 'English', 1, 1784),
('WS', 'Samoa', 'English', 1, 684),
('SM', 'San Marino', 'English', 1, 378),
('ST', 'Sao Tome and Principe', 'English', 1, 239),
('SA', 'Saudi Arabia (المملكة العربية السعودية)', 'Arabic', 1, 966),
('SN', 'Senegal (Sénégal)', 'English', 1, 221),
('RS', 'Serbia ( Република Србија )', 'English', 1, 381),
('SC', 'Seychelles', 'English', 1, 248),
('SL', 'Sierra Leone', 'English', 1, 232),
('SG', 'Singapore (Singapura)', 'English', 1, 65),
('SK', 'Slovakia (Slovensko)', 'English', 1, 421),
('SI', 'Slovenia (Slovenija)', 'English', 1, 386),
('SB', 'Solomon Islands', 'English', 1, 677),
('SO', 'Somalia (Soomaaliya)', 'English', 1, 252),
('ZA', 'South Africa', 'English', 1, 27),
('ES', 'Spain ( Reino de España )', 'English', 1, 34),
('LK', 'Sri Lanka', 'English', 1, 94),
('SD', 'Sudan (السودان)', 'Arabic', 1, 249),
('SR', 'Suriname', 'English', 1, 597),
('SZ', 'Swaziland', 'English', 1, 268),
('SE', 'Sweden (Sverige)', 'English', 1, 46),
('CH', 'Switzerland (Schweiz)', 'English', 1, 41),
('SY', 'Syria (سورية)', 'Arabic', 1, 963),
('TW', 'Taiwan ( 中華民國 )', 'English', 1, 886),
('TJ', 'Tajikistan ( Ҷумҳурии Тоҷикистон )', 'English', 1, 992),
('TZ', 'Tanzania, United Republic of', 'English', 1, 255),
('TH', 'Thailand ( ราชอาณาจักรไทย )', 'English', 1, 66),
('TG', 'Togo', 'English', 1, 228),
('TK', 'Tokelau', 'English', 1, 690),
('TO', 'Tonga', 'English', 1, 676),
('TT', 'Trinidad and Tobago', 'English', 1, 1868),
('TN', 'Tunisia (تونس)', 'Arabic', 1, 216),
('TR', 'Turkey (Türkiye)', 'English', 1, 90),
('TM', 'Turkmenistan (Türkmenistan)', 'English', 1, 993),
('TC', 'Turks and Caicos Islands', 'English', 1, 1649),
('TV', 'Tuvalu', 'English', 1, 688),
('UG', 'Uganda', 'English', 1, 256),
('UA', 'Ukraine ( Україна )', 'English', 1, 380),
('AE', 'United Arab Emirates (الإمارات العربية المتحدة)', 'English', 1, 971),
('GB', 'United Kingdom', 'English', 1, 44),
('US', 'United States', 'English', 1, 1),
('UM', 'United States Minor Outlying Islands', 'English', 1, 1684),
('UY', 'Uruguay', 'English', 1, 598),
('UZ', 'Uzbekistan ( Ўзбекистон Республикаси )', 'English', 1, 998),
('VU', 'Vanuatu', 'English', 1, 678),
('VE', 'Venezuela', 'English', 1, 58),
('VN', 'Vietnam ( Cộng hòa xã hội chủ nghĩa Việt Nam )', 'English', 1, 84),
('VG', 'Virgin Islands, British', 'English', 1, 1284),
('VI', 'Virgin Islands, U.S.', 'English', 1, 1340),
('YE', 'Yemen (اليمن)', 'Arabic', 1, 967),
('ZM', 'Zambia', 'English', 1, 260),
('ZW', 'Zimbabwe', 'English', 1, 263),
('TL', 'East Timor (Timor-Leste)', 'English', 1, 670),
('KP', 'North Korea ( 조선민주주의인민공화국 )', 'English', 1, 850),
('XX', 'UnKnow', 'English', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;