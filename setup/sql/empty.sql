-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2011 at 12:03 ?- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpTransformer`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE IF NOT EXISTS `adminlog` (
  `TryName` varchar(15) NOT NULL COMMENT 'الاسم المحاول الدخول فيه',
  `TryPassword` varchar(35) NOT NULL COMMENT 'كلمة سر المحاولة',
  `TryDate` datetime NOT NULL COMMENT 'الوقت حسب غريبتش',
  `tryIp` varchar(15) NOT NULL COMMENT 'رقم الايبي المحاول منه'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlog`
--


-- --------------------------------------------------------

--
-- Table structure for table `adminperm`
--

CREATE TABLE IF NOT EXISTS `adminperm` (
  `AdminID` varchar(11) NOT NULL COMMENT 'رقم المدير',
  `constName` varchar(100) NOT NULL COMMENT 'النوع قلب البرنامج او برنامج او بلوك',
  `varName` varchar(100) NOT NULL COMMENT 'اسم المتغير',
  `varValue` varchar(100) NOT NULL COMMENT 'قيمة المتغير',
  `perm` int(1) NOT NULL COMMENT 'له صلاحية'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول صلاحيات المدراء';

--
-- Dumping data for table `adminperm`
--


-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `AdminId` varchar(11) NOT NULL COMMENT 'رقم المدير',
  `AdminMail` varchar(50) NOT NULL COMMENT 'بريد المدير',
  `LastLogin` datetime NOT NULL COMMENT 'اخر مرة سجل دخوله',
  `LastIp` varchar(15) NOT NULL COMMENT 'آخر ايبي دخل منه',
  `Note` text NOT NULL COMMENT 'ملاحظة المدير',
  `AdminSign` text NOT NULL COMMENT 'توقيع المدير في الرسائل',
  `BackupFolder` longtext NOT NULL COMMENT 'مجلد حفظ نسخ الاحتياط من قاعدة البيانات',
  `Stopped` datetime NOT NULL COMMENT 'تاريخ ايقافه',
  `IsAdam` int(1) NOT NULL COMMENT 'هل هو المدير العام',
  PRIMARY KEY (`AdminId`),
  UNIQUE KEY `AdminId` (`AdminId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول المدير';

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminId`, `AdminMail`, `LastLogin`, `LastIp`, `Note`, `AdminSign`, `BackupFolder`, `Stopped`, `IsAdam`) VALUES
('200700000-1', 'user@domain.com', '2011-06-23 08:31:59', '127.0.0.1', '', '', 'admin/todo/support/backups/', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bancltrans`
--

CREATE TABLE IF NOT EXISTS `bancltrans` (
  `IdTrans` varchar(11) NOT NULL COMMENT 'رقم الحركة',
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم المعلن',
  `Debit` double NOT NULL COMMENT 'مدين',
  `Credit` double NOT NULL COMMENT 'دائن',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `ValueDate` datetime NOT NULL COMMENT 'تاريخ الاستحقاق',
  `Desc` varchar(100) NOT NULL COMMENT 'البيان',
  PRIMARY KEY (`IdTrans`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='حركة زبون الاعلان المتعلقة بالتح';

--
-- Dumping data for table `bancltrans`
--


-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `IdBanner` varchar(11) NOT NULL COMMENT 'رقم البانر',
  `IdComp` varchar(11) NOT NULL COMMENT 'رقم الحملة',
  `BanName` varchar(35) NOT NULL COMMENT 'اسم الاعلان',
  `ViewMade` double NOT NULL COMMENT 'عدد المشاهدات',
  `ClicksMade` double NOT NULL COMMENT 'عدد النقرات',
  `CodeBan` varchar(1024) NOT NULL COMMENT 'كود الاعلان',
  `ClickUrl` varchar(1024) NOT NULL COMMENT 'وجهة الاعلان',
  `altTxt` varchar(35) NOT NULL COMMENT 'النص الظاهر',
  `Position` varchar(1) NOT NULL COMMENT 'مكان الاعلان',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا او محذوف',
  `Cost` double NOT NULL COMMENT 'الكلفة الحالية للمعلن',
  UNIQUE KEY `IdBanner` (`IdBanner`),
  UNIQUE KEY `BanName` (`BanName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لاعلانات';

--
-- Dumping data for table `banner`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannerclients`
--

CREATE TABLE IF NOT EXISTS `bannerclients` (
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم زبون الاعلان',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `AdminOk` varchar(1) NOT NULL COMMENT 'تم الموافقة على حساب المعلن من قبل المدير نعم او لا',
  `adsPayment` varchar(20) NOT NULL COMMENT 'طريقة الدفع',
  UNIQUE KEY `idBanClnt` (`idBanClnt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='المستخدمين المعلينين';

--
-- Dumping data for table `bannerclients`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannerplans`
--

CREATE TABLE IF NOT EXISTS `bannerplans` (
  `IdBanPlan` varchar(11) NOT NULL COMMENT 'رقم خطة الاعلان',
  `BPActive` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `BPName` varchar(15) NOT NULL COMMENT 'اسم الخطة',
  `BPDesc` varchar(35) NOT NULL COMMENT 'تفصيل الخطة',
  `ViewPrice` float NOT NULL COMMENT 'سعر المشاهدة',
  `ClickPrice` float NOT NULL COMMENT 'سعر النقرة',
  `LinksNbr` varchar(10) NOT NULL COMMENT 'عدد الارتباطات',
  `planStart` datetime NOT NULL COMMENT 'بداية العرض لهذه الخطة',
  `planEnd` datetime NOT NULL COMMENT 'نهاية العرض لهذه الخطة',
  UNIQUE KEY `IdBanPlan` (`IdBanPlan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خطط الاعلان';

--
-- Dumping data for table `bannerplans`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannerpositions`
--

CREATE TABLE IF NOT EXISTS `bannerpositions` (
  `IdBanPos` varchar(11) NOT NULL COMMENT 'رقم موضع الاعلان',
  `PositionNbr` varchar(2) NOT NULL COMMENT 'مكان الاعلان كرقم',
  `PositionName` varchar(15) NOT NULL COMMENT 'اسم الموضع',
  `PosWidth` varchar(11) NOT NULL COMMENT 'عرض مكان الاعلان',
  `PosHeight` varchar(11) NOT NULL COMMENT 'طول مكان الاعلان',
  UNIQUE KEY `IdBanPos` (`IdBanPos`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مواضع الاعلانات في الموق';

--
-- Dumping data for table `bannerpositions`
--

INSERT INTO `bannerpositions` (`IdBanPos`, `PositionNbr`, `PositionName`, `PosWidth`, `PosHeight`) VALUES
('20070000001', '1', 'Ads Block', '160', '250');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `BlackWord` varchar(100) NOT NULL COMMENT 'الكلمة المحظورة',
  `BlockReason` varchar(1024) NOT NULL COMMENT 'سبب الحظر',
  `BlockDate` datetime NOT NULL COMMENT 'تاريخ الحظر'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الكلمات المحظورة للاستعمال في ال';

--
-- Dumping data for table `blacklist`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocklang`
--

CREATE TABLE IF NOT EXISTS `blocklang` (
  `idblocklang` varchar(11) NOT NULL COMMENT 'رقم الجدول',
  `BlockName` varchar(35) NOT NULL COMMENT 'اسم البلوك',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BlockTitle` varchar(35) NOT NULL COMMENT 'عنوان البلوك بهذه اللغة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocklang`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `BlockName` varchar(35) NOT NULL DEFAULT '',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `View` varchar(1) NOT NULL COMMENT 'يمكن مشاهدته نعم او لا',
  `MainSec` varchar(2) NOT NULL COMMENT 'مكانه على اليمين او يسار',
  `Order` int(2) NOT NULL COMMENT 'ترتيبه من الاعلى',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقمه المرتبط بالسيكيوريتي',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل البلوك محذوف؟',
  `License` text NOT NULL,
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  PRIMARY KEY (`BlockName`),
  UNIQUE KEY `BlockName` (`BlockName`),
  UNIQUE KEY `BlockName_2` (`BlockName`),
  UNIQUE KEY `BlockName_3` (`BlockName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البلوكات';

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`BlockName`, `Active`, `View`, `MainSec`, `Order`, `ObjectId`, `Deleted`, `License`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`) VALUES
('MainMenu', '1', '1', 'S', 1, '20070000001', '', '', '0000-00-00 00:00:00', 0, ''),
('AccountBlock', '1', '1', 'M', 1, '20070000002', '', '', '0000-00-00 00:00:00', 0, ''),
('Statistics', '1', '1', 'S', 2, '20070000003', '', '', '0000-00-00 00:00:00', 0, ''),
('Ads', '1', '1', 'M', 4, '20070000004', '', '', '0000-00-00 00:00:00', 0, ''),
('Gsearch', '1', '1', 'S', 1, '20070000005', '', '', '0000-00-00 00:00:00', 0, ''),
('Language', '1', '1', 'M', 2, '20070000006', '', '', '0000-00-00 00:00:00', 0, ''),
('Pool', '1', '1', 'S', 3, '20070000008', '', '', '0000-00-00 00:00:00', 0, ''),
('FreeBlock', '1', '1', 'M', 3, '20110000002', '0', '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `IdComp` varchar(11) NOT NULL COMMENT 'ؤقم الحملة الاعلانية',
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم الزبون',
  `CampName` varchar(35) NOT NULL COMMENT 'اسم الحملة الاعلانية',
  `CompStart` datetime NOT NULL COMMENT 'تاريخ بدء الحملة',
  `CompEnd` datetime NOT NULL COMMENT 'تاريخ نهاية الحملة',
  `MaxView` double NOT NULL COMMENT 'العدد الاقصى للمشاهدات',
  `MaxClick` double NOT NULL COMMENT 'العدد الاقصى للنقر',
  `Activity` varchar(1) NOT NULL COMMENT 'نشط او لا او محذوف',
  `Budget` double NOT NULL COMMENT 'الميزانية لهذه الحملة',
  UNIQUE KEY `IdComp` (`IdComp`),
  UNIQUE KEY `CampName` (`CampName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الحملات الاعلانية';

--
-- Dumping data for table `campaign`
--


-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ThemName` varchar(7) NOT NULL COMMENT 'اسم الشكل',
  PRIMARY KEY (`IdCat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--


-- --------------------------------------------------------

--
-- Table structure for table `catlang`
--

CREATE TABLE IF NOT EXISTS `catlang` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `CatName` varchar(15) NOT NULL COMMENT 'اسم المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل نوع الخير محذوف',
  PRIMARY KEY (`IdCat`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catlang`
--

INSERT INTO `catlang` (`IdCat`, `IdLang`, `CatName`, `Deleted`) VALUES
('20100000000', '20070000001', 'أخبار عامة', ''),
('20100000000', '20070000002', 'Public News', '');

-- --------------------------------------------------------

--
-- Table structure for table `cclang`
--

CREATE TABLE IF NOT EXISTS `cclang` (
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `Contry` varchar(50) NOT NULL COMMENT 'اسم البلد',
  `Langcc` varchar(10) NOT NULL COMMENT 'لغة البلد',
  `rank` bigint(11) NOT NULL,
  PRIMARY KEY (`cc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لغة البلدان على اساس كود البلد';

--
-- Dumping data for table `cclang`
--

INSERT INTO `cclang` (`cc`, `Contry`, `Langcc`, `rank`) VALUES
('AF', 'Afghanistan (افغانستان)', 'English', 1),
('AL', 'Albania (Shqipëria)', 'English', 1),
('DZ', 'Algeria (الجمهورية الجزائرية)', 'Arabic', 1),
('AS', 'American Samoa', 'English', 1),
('AD', 'Andorra', 'English', 1),
('AO', 'Angola', 'English', 1),
('AI', 'Anguilla', 'English', 1),
('AQ', 'Antarctica', 'English', 1),
('AG', 'Antigua and Barbuda', 'English', 1),
('AR', 'Argentina', 'English', 1),
('AM', 'Armenia (????????)', 'English', 1),
('AW', 'Aruba', 'English', 1),
('AP', 'Asia/Pacific Region', 'English', 1),
('AU', 'Australia', 'English', 1),
('AT', 'Austria (?sterreich)', 'English', 1),
('AZ', 'Azerbaijan (Az?rbaycan)', 'English', 1),
('BS', 'Bahamas', 'English', 1),
('BH', 'Bahrain (بحرين)', 'Arabic', 1),
('BD', 'Bangladesh (????????)', 'English', 1),
('BB', 'Barbados', 'English', 1),
('BY', 'Belarus (?????????)', 'English', 1),
('BE', 'Belgium (België)', 'English', 1),
('BZ', 'Belize', 'English', 1),
('BJ', 'Benin (Bénin)', 'English', 1),
('BM', 'Bermuda', 'English', 1),
('BT', 'Bhutan (?????????)', 'English', 1),
('BO', 'Bolivia', 'English', 1),
('BA', 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'English', 1),
('BW', 'Botswana', 'English', 1),
('BR', 'Brazil (Brasil)', 'English', 1),
('IO', 'British Indian Ocean Territory', 'English', 1),
('BN', 'Brunei (Brunei Darussalam)', 'English', 1),
('BG', 'Bulgaria (????????)', 'English', 1),
('BF', 'Burkina Faso', 'English', 1),
('BI', 'Burundi (Uburundi)', 'English', 1),
('KH', 'Cambodia (Kampuchea)', 'English', 1),
('CM', 'Cameroon (Cameroun)', 'English', 1),
('CA', 'Canada', 'English', 1),
('CV', 'Cape Verde (Cabo Verde)', 'English', 1),
('KY', 'Cayman Islands', 'English', 1),
('CF', 'Central African Republic (République Centrafricain', 'English', 1),
('TD', 'Chad (Tchad)', 'English', 1),
('CL', 'Chile', 'English', 1),
('CN', 'China (??)', 'English', 1),
('CO', 'Colombia', 'English', 1),
('KM', 'Comoros (Comores)', 'English', 1),
('CG', 'Congo', 'English', 1),
('CD', 'Congo, The Democratic Republic of the', 'English', 1),
('CK', 'Cook Islands', 'English', 1),
('CR', 'Costa Rica', 'English', 1),
('CI', 'Côte D''Ivoire', 'English', 1),
('HR', 'Croatia (Hrvatska)', 'English', 1),
('CU', 'Cuba', 'English', 1),
('CY', 'Cyprus (??????)', 'English', 1),
('CZ', 'Czech Republic (?esko)', 'English', 1),
('DK', 'Denmark (Danmark)', 'English', 1),
('DJ', 'Djibouti', 'English', 1),
('DM', 'Dominica', 'English', 1),
('DO', 'Dominican Republic', 'English', 1),
('EC', 'Ecuador', 'English', 1),
('EG', 'Egypt (مصر)', 'Arabic', 1),
('SV', 'El Salvador', 'English', 1),
('GQ', 'Equatorial Guinea (Guinea Ecuatorial)', 'English', 1),
('ER', 'Eritrea (Ertra)', 'English', 1),
('EE', 'Estonia (Eesti)', 'English', 1),
('ET', 'Ethiopia (Ityop&#39;iya)', 'English', 1),
('EU', 'Europe', 'English', 1),
('FK', 'Falkland Islands (Malvinas)', 'English', 1),
('FO', 'Faroe Islands', 'English', 1),
('FJ', 'Fiji', 'English', 1),
('FI', 'Finland (Suomi)', 'English', 1),
('FR', 'France', 'English', 1),
('GF', 'French Guiana', 'English', 1),
('PF', 'French Polynesia', 'English', 1),
('GA', 'Gabon', 'English', 1),
('GM', 'Gambia', 'English', 1),
('GE', 'Georgia (??????????)', 'English', 1),
('DE', 'Germany (Deutschland)', 'English', 1),
('GH', 'Ghana', 'English', 1),
('GI', 'Gibraltar', 'English', 1),
('GR', 'Greece (&#39;E????)', 'English', 1),
('GL', 'Greenland', 'English', 1),
('GD', 'Grenada', 'English', 1),
('GP', 'Guadeloupe', 'English', 1),
('GU', 'Guam', 'English', 1),
('GT', 'Guatemala', 'English', 1),
('GN', 'Guinea (Guinée)', 'English', 1),
('GW', 'Guinea-Bissau (Guiné-Bissau)', 'English', 1),
('GY', 'Guyana', 'English', 1),
('HT', 'Haiti (Haïti)', 'English', 1),
('VA', 'Holy See (Vatican City State)', 'English', 1),
('HN', 'Honduras', 'English', 1),
('HK', 'Hong Kong', 'English', 1),
('HU', 'Hungary (Magyarorsz?g)', 'English', 1),
('IS', 'Iceland (?sland)', 'English', 1),
('IN', 'India', 'English', 1),
('ID', 'Indonesia', 'English', 1),
('IR', 'Iran,  (الجمهورية الاسلامية في ايران)', 'Arabic', 1),
('IQ', 'Iraq (العراق)', 'Arabic', 1),
('IE', 'Ireland', 'English', 1),
('IL', 'Israel Enemy (?????)', 'English', 1),
('IT', 'Italy (Italia)', 'English', 1),
('JM', 'Jamaica', 'English', 1),
('JP', 'Japan', 'English', 1),
('JO', 'Jordan (الأردن)', 'Arabic', 1),
('KZ', 'Kazakhstan (?????????)', 'English', 1),
('KE', 'Kenya', 'English', 1),
('KI', 'Kiribati', 'English', 1),
('EH', 'Western Sahara (صحراوية)', 'English', 1),
('KR', 'South Korea (??)', 'English', 1),
('KW', 'Kuwait (الكويت)', 'Arabic', 1),
('KG', 'Kyrgyzstan (??????????)', 'English', 1),
('LA', 'Lao People''s Democratic Republic (????)', 'English', 1),
('LV', 'Latvia (Latvija)', 'English', 1),
('LB', 'Lebanon (لبنان)', 'Arabic', 1),
('LS', 'Lesotho', 'English', 1),
('LR', 'Liberia', 'English', 1),
('LY', 'Libyan Arab Jamahiriya (ليبيا)', 'Arabic', 1),
('LI', 'Liechtenstein', 'English', 1),
('LT', 'Lithuania (Lietuva)', 'English', 1),
('LU', 'Luxembourg (Lëtzebuerg)', 'English', 1),
('MO', 'Macau', 'English', 1),
('MK', 'Macedonia (??????????)', 'English', 1),
('MG', 'Madagascar (Madagasikara)', 'English', 1),
('MW', 'Malawi', 'English', 1),
('MY', 'Malaysia', 'English', 1),
('MV', 'Maldives (???????? ???????????)', 'English', 1),
('ML', 'Mali', 'English', 1),
('MT', 'Malta', 'English', 1),
('MH', 'Marshall Islands', 'English', 1),
('MQ', 'Martinique', 'English', 1),
('MR', 'Mauritania (موريتانية)', 'Arabic', 1),
('MU', 'Mauritius', 'English', 1),
('YT', 'Mayotte', 'English', 1),
('MX', 'Mexico (México)', 'English', 1),
('FM', 'Micronesia, Federated States of', 'English', 1),
('MD', 'Moldova, Republic of', 'English', 1),
('MC', 'Monaco', 'English', 1),
('MN', 'Mongolia (?????? ???)', 'English', 1),
('ME', 'Montenegro (???? ????)', 'English', 1),
('MS', 'Montserrat', 'English', 1),
('MA', 'Morocco (المغرب)', 'Arabic', 1),
('MZ', 'Mozambique (Moçambique)', 'English', 1),
('MM', 'Myanmar (???????? ???????)', 'English', 1),
('NA', 'Namibia', 'English', 1),
('NR', 'Nauru (Naoero)', 'English', 1),
('NP', 'Nepal (?????)', 'English', 1),
('NL', 'Netherlands (Nederland)', 'English', 1),
('AN', 'Netherlands Antilles', 'English', 1),
('NC', 'New Caledonia', 'English', 1),
('NZ', 'New Zealand', 'English', 1),
('NI', 'Nicaragua', 'English', 1),
('NE', 'Niger', 'English', 1),
('NG', 'Nigeria', 'English', 1),
('NU', 'Niue', 'English', 1),
('NF', 'Norfolk Island', 'English', 1),
('MP', 'Northern Mariana Islands', 'English', 1),
('NO', 'Norway (Norge)', 'English', 1),
('OM', 'Oman (عمان)', 'Arabic', 1),
('PK', 'Pakistan (پاکستان)', 'English', 1),
('PW', 'Palau', 'English', 1),
('PS', 'Palestinian Territory, Occupied', 'English', 1),
('PA', 'Panama (Panam?)', 'English', 1),
('PG', 'Papua New Guinea', 'English', 1),
('PY', 'Paraguay', 'English', 1),
('PE', 'Peru (Per?)', 'English', 1),
('PH', 'Philippines (Pilipinas)', 'English', 1),
('PL', 'Poland (Polska)', 'English', 1),
('PT', 'Portugal', 'English', 1),
('PR', 'Puerto Rico', 'English', 1),
('QA', 'Qatar (قطر)', 'Arabic', 1),
('RE', 'Reunion', 'English', 1),
('RO', 'Romania (România)', 'English', 1),
('RU', 'Russia (??????)', 'English', 1),
('RW', 'Rwanda', 'English', 1),
('KN', 'Saint Kitts and Nevis', 'English', 1),
('LC', 'Saint Lucia', 'English', 1),
('VC', 'Saint Vincent and the Grenadines', 'English', 1),
('WS', 'Samoa', 'English', 1),
('SM', 'San Marino', 'English', 1),
('ST', 'Sao Tome and Principe', 'English', 1),
('SA', 'Saudi Arabia (المملكة العربية السعودية)', 'Arabic', 1),
('SN', 'Senegal (Sénégal)', 'English', 1),
('RS', 'Serbia (??????)', 'English', 1),
('SC', 'Seychelles', 'English', 1),
('SL', 'Sierra Leone', 'English', 1),
('SG', 'Singapore (Singapura)', 'English', 1),
('SK', 'Slovakia (Slovensko)', 'English', 1),
('SI', 'Slovenia (Slovenija)', 'English', 1),
('SB', 'Solomon Islands', 'English', 1),
('SO', 'Somalia (Soomaaliya)', 'English', 1),
('ZA', 'South Africa', 'English', 1),
('ES', 'Spain (Espa?a)', 'English', 1),
('LK', 'Sri Lanka', 'English', 1),
('SD', 'Sudan (السودان)', 'Arabic', 1),
('SR', 'Suriname', 'English', 1),
('SZ', 'Swaziland', 'English', 1),
('SE', 'Sweden (Sverige)', 'English', 1),
('CH', 'Switzerland (Schweiz)', 'English', 1),
('SY', 'Syria (سورية)', 'Arabic', 1),
('TW', 'Taiwan (??)', 'English', 1),
('TJ', 'Tajikistan (??????????)', 'English', 1),
('TZ', 'Tanzania, United Republic of', 'English', 1),
('TH', 'Thailand (??????????????)', 'English', 1),
('TG', 'Togo', 'English', 1),
('TK', 'Tokelau', 'English', 1),
('TO', 'Tonga', 'English', 1),
('TT', 'Trinidad and Tobago', 'English', 1),
('TN', 'Tunisia (تونس)', 'Arabic', 1),
('TR', 'Turkey (Türkiye)', 'English', 1),
('TM', 'Turkmenistan (Türkmenistan)', 'English', 1),
('TC', 'Turks and Caicos Islands', 'English', 1),
('TV', 'Tuvalu', 'English', 1),
('UG', 'Uganda', 'English', 1),
('UA', 'Ukraine (???????)', 'English', 1),
('AE', 'United Arab Emirates (الإمارات العربية المتحدة)', 'English', 1),
('GB', 'United Kingdom', 'English', 1),
('US', 'United States', 'English', 1),
('UM', 'United States Minor Outlying Islands', 'English', 1),
('UY', 'Uruguay', 'English', 1),
('UZ', 'Uzbekistan (O&#39;zbekiston)', 'English', 1),
('VU', 'Vanuatu', 'English', 1),
('VE', 'Venezuela', 'English', 1),
('VN', 'Vietnam (Vi?t Nam) ', 'English', 1),
('VG', 'Virgin Islands, British', 'English', 1),
('VI', 'Virgin Islands, U.S.', 'English', 1),
('YE', 'Yemen (اليمن)', 'Arabic', 1),
('ZM', 'Zambia', 'English', 1),
('ZW', 'Zimbabwe', 'English', 1),
('TL', 'East Timor (Timor-Leste)', 'English', 1),
('KP', 'North Korea (??)', 'English', 1),
('XX', 'UnKnow', 'English', 2);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `IdDep` varchar(11) NOT NULL,
  `DepEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`IdDep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactus`
--


-- --------------------------------------------------------

--
-- Table structure for table `contactuslang`
--

CREATE TABLE IF NOT EXISTS `contactuslang` (
  `IdDep` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `DepName` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactuslang`
--


-- --------------------------------------------------------

--
-- Table structure for table `errlog`
--

CREATE TABLE IF NOT EXISTS `errlog` (
  `IdErr` double NOT NULL AUTO_INCREMENT COMMENT 'رقم الجدول',
  `errno` double NOT NULL COMMENT 'رقم الخطأ',
  `errmsg` longtext NOT NULL COMMENT 'رسالة الخطأ',
  `filename` longtext NOT NULL COMMENT 'اسم الملف',
  `linenum` double NOT NULL COMMENT 'رقم السطر',
  `DateErr` datetime NOT NULL COMMENT 'تاريخ الخطأ',
  PRIMARY KEY (`IdErr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول اخطاء البرنامج' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `errlog`
--


-- --------------------------------------------------------

--
-- Table structure for table `errpages`
--

CREATE TABLE IF NOT EXISTS `errpages` (
  `ErrNumber` varchar(4) NOT NULL COMMENT 'رقم صفحة الخطأ',
  `ErrPage` longtext NOT NULL COMMENT 'صفحة الخطأ',
  PRIMARY KEY (`ErrNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='أخطاء المستخدم في طلب الموقع';

--
-- Dumping data for table `errpages`
--

INSERT INTO `errpages` (`ErrNumber`, `ErrPage`) VALUES
('400', '<div align="center"><font size="7">400&nbsp;</font></div>'),
('401', '<div align="center"><font size="7">401</font></div>'),
('403', '<div align="center"><font size="7">403</font></div>'),
('404', '<div align="center"><font size="7">404</font> <br /></div>'),
('500', '<div align="center"><font size="7">500</font></div>');

-- --------------------------------------------------------

--
-- Table structure for table `externallinks`
--

CREATE TABLE IF NOT EXISTS `externallinks` (
  `Id` varchar(11) NOT NULL COMMENT 'رقم اللنك',
  `Link` text NOT NULL COMMENT 'عنوان اللنك',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الروابط الخارجية';

--
-- Dumping data for table `externallinks`
--


-- --------------------------------------------------------

--
-- Table structure for table `floodprotection`
--

CREATE TABLE IF NOT EXISTS `floodprotection` (
  `IP` varchar(32) NOT NULL COMMENT 'رقم ايبي المسجل للفلود',
  `TIME` varchar(22) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'الوقت للفلود'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='من اجل الحماية من اللب الزائد على';

--
-- Dumping data for table `floodprotection`
--

INSERT INTO `floodprotection` (`IP`, `TIME`) VALUES
(' fe80::a998:ae3:15d7:3f0', '1308819684.1224');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `IdMedia` varchar(11) NOT NULL,
  `Path` text NOT NULL,
  `AddDate` datetime NOT NULL,
  `MapLocation` text NOT NULL,
  `MediaRank` varchar(11) NOT NULL,
  `MediaType` varchar(10) NOT NULL,
  PRIMARY KEY (`IdMedia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول المكتبة';

--
-- Dumping data for table `gallery`
--


-- --------------------------------------------------------

--
-- Table structure for table `galleryfav`
--

CREATE TABLE IF NOT EXISTS `galleryfav` (
  `IdCmnt` varchar(11) NOT NULL,
  `IdMedia` varchar(11) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`IdCmnt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تفضيلات و تعليقات الزوار';

--
-- Dumping data for table `galleryfav`
--


-- --------------------------------------------------------

--
-- Table structure for table `gallerylang`
--

CREATE TABLE IF NOT EXISTS `gallerylang` (
  `IdMedia` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `Caption` text NOT NULL,
  `Desc` longtext NOT NULL,
  `Place` text NOT NULL,
  `Tags` text NOT NULL,
  PRIMARY KEY (`IdMedia`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لغة المكتبة';

--
-- Dumping data for table `gallerylang`
--


-- --------------------------------------------------------

--
-- Table structure for table `galleryparams`
--

CREATE TABLE IF NOT EXISTS `galleryparams` (
  `ThumbsWidth` int(11) NOT NULL,
  `ThumbsHeight` int(11) NOT NULL,
  `ColumsNbr` int(11) NOT NULL,
  `CellWidthMax` int(11) NOT NULL,
  `CellHeightMax` int(11) NOT NULL,
  `PrintFilenames` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خصائص المعرض';

--
-- Dumping data for table `galleryparams`
--

INSERT INTO `galleryparams` (`ThumbsWidth`, `ThumbsHeight`, `ColumsNbr`, `CellWidthMax`, `CellHeightMax`, `PrintFilenames`) VALUES
(200, 200, 4, 200, 160, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gballonlang`
--

CREATE TABLE IF NOT EXISTS `gballonlang` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BallonTitle` text NOT NULL COMMENT 'عنوان البالون',
  `BallonDesk` mediumtext NOT NULL COMMENT 'شرح البالون',
  PRIMARY KEY (`BallonId`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البالون حسب اللغة';

--
-- Dumping data for table `gballonlang`
--


-- --------------------------------------------------------

--
-- Table structure for table `gballons`
--

CREATE TABLE IF NOT EXISTS `gballons` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `BallonX` double NOT NULL COMMENT 'مكان البالون X',
  `BallonY` double NOT NULL COMMENT 'مكان البالون Y',
  `BallonIcon` text NOT NULL COMMENT 'ايقونة البالون',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف ؟',
  PRIMARY KEY (`BallonId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تحديد موقع على الخريطة';

--
-- Dumping data for table `gballons`
--


-- --------------------------------------------------------

--
-- Table structure for table `googlemap`
--

CREATE TABLE IF NOT EXISTS `googlemap` (
  `key` text NOT NULL COMMENT 'كود جوجل',
  `MapWidth` int(11) NOT NULL COMMENT 'عرض الخريطة',
  `MapHeight` int(11) NOT NULL COMMENT 'طول الخريطة',
  `EarthX` double NOT NULL COMMENT 'مكان الخريطة x',
  `EarthY` double NOT NULL COMMENT 'مكان الخريطة y',
  `MapType` varchar(10) NOT NULL COMMENT 'نوع الخريطة',
  `Altitude` tinyint(4) NOT NULL COMMENT 'الارتفاع عن الارض بين 18 و 1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خريطة جوجل';

--
-- Dumping data for table `googlemap`
--

INSERT INTO `googlemap` (`key`, `MapWidth`, `MapHeight`, `EarthX`, `EarthY`, `MapType`, `Altitude`) VALUES
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `GroupName` varchar(15) NOT NULL COMMENT 'اسم المجموعة',
  `Desc` varchar(50) NOT NULL COMMENT 'شرح المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف؟',
  UNIQUE KEY `GroupId` (`GroupId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مجموعات المستخدمين';

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupId`, `GroupName`, `Desc`, `Deleted`) VALUES
('20070000000', 'Guests', 'الزوار عادة يكون لهم صلاحية القراءة فقط', ''),
('20070000001', 'Users', 'المستخدمين المسجلين', ''),
('200700000-1', 'Admins', 'المدراء', '');

-- --------------------------------------------------------

--
-- Table structure for table `gsearch`
--

CREATE TABLE IF NOT EXISTS `gsearch` (
  `URL` varchar(7) NOT NULL COMMENT 'لون الرابط',
  `Border` varchar(7) NOT NULL COMMENT 'لون الحدود',
  `VisitedURL` varchar(7) NOT NULL COMMENT 'لون الروابط التي تم زيارتها',
  `Background` varchar(7) NOT NULL COMMENT 'لون الخلفية',
  `LogoBackground` varchar(7) NOT NULL COMMENT 'لون خلفية اللوغو',
  `Title` varchar(7) NOT NULL COMMENT 'لون العنوان',
  `Text` varchar(7) NOT NULL COMMENT 'لون النص',
  `LightURL` varchar(7) NOT NULL COMMENT 'لون الرابط الفاتح',
  `clientKey` varchar(50) NOT NULL COMMENT 'مفتاح رخصة الموقع',
  `target` varchar(15) NOT NULL COMMENT 'هل سيفتح بنفس المستعرض ؟'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البحث عبر خدمة جوجل';

--
-- Dumping data for table `gsearch`
--

INSERT INTO `gsearch` (`URL`, `Border`, `VisitedURL`, `Background`, `LogoBackground`, `Title`, `Text`, `LightURL`, `clientKey`, `target`) VALUES
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window');

-- --------------------------------------------------------

--
-- Table structure for table `ipbanned`
--

CREATE TABLE IF NOT EXISTS `ipbanned` (
  `idip` double NOT NULL AUTO_INCREMENT COMMENT ' رقم الطرد',
  `ipStart` varchar(15) NOT NULL COMMENT 'بداية الايبي',
  `ipEnd` varchar(15) NOT NULL COMMENT 'نهاية الايبي',
  `reason` varchar(256) NOT NULL COMMENT 'السبب',
  `date` datetime NOT NULL COMMENT 'التاريخ',
  PRIMARY KEY (`idip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='طرد الزوار المزعجين' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ipbanned`
--


-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `LangName` varchar(15) NOT NULL COMMENT 'اسم اللغة',
  `Hits` varchar(7) NOT NULL COMMENT 'احصائيات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل اللغة محذوفة؟',
  UNIQUE KEY `IdLang` (`IdLang`),
  UNIQUE KEY `LangName` (`LangName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='اللغات';

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`IdLang`, `LangName`, `Hits`, `Deleted`) VALUES
('20070000001', 'Arabic', '4', '0'),
('20070000002', 'English', '3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `layersmenu`
--

CREATE TABLE IF NOT EXISTS `layersmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '1',
  `text` text CHARACTER SET utf8,
  `href` text CHARACTER SET utf8,
  `title` text CHARACTER SET utf8,
  `icon` text CHARACTER SET utf8,
  `target` text CHARACTER SET utf8,
  `orderfield` int(11) DEFAULT '0',
  `expanded` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=311 ;

--
-- Dumping data for table `layersmenu`
--

INSERT INTO `layersmenu` (`id`, `parent_id`, `text`, `href`, `title`, `icon`, `target`, `orderfield`, `expanded`) VALUES
(10, 1, 'Home Page', 'Prog-pages.pt', 'Home Page', 'kfm_home.png', '', 30, 0);

-- --------------------------------------------------------

--
-- Table structure for table `layersmenulang`
--

CREATE TABLE IF NOT EXISTS `layersmenulang` (
  `language` varchar(15) CHARACTER SET utf8 NOT NULL,
  `id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8,
  `title` text CHARACTER SET utf8,
  PRIMARY KEY (`language`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `layersmenulang`
--

INSERT INTO `layersmenulang` (`language`, `id`, `text`, `title`) VALUES
('Arabic', 10, 'الصفحة الرئيسية', 'عنوان الرئيسية'),
('English', 10, ' Home Page', 'Home Page');

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE IF NOT EXISTS `letters` (
  `idLetter` varchar(11) CHARACTER SET utf8 NOT NULL COMMENT 'رقم الرسالة',
  `LatterName` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'اسم الرسالة',
  `Deleted` varchar(1) CHARACTER SET utf8 NOT NULL COMMENT 'هل هو محذوف؟',
  PRIMARY KEY (`idLetter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci COMMENT='الرسائل النموذجية';

--
-- Dumping data for table `letters`
--


-- --------------------------------------------------------

--
-- Table structure for table `letterslang`
--

CREATE TABLE IF NOT EXISTS `letterslang` (
  `idLetter` varchar(11) NOT NULL COMMENT 'رقم الرسالة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleLetter` varchar(256) NOT NULL COMMENT 'عنوان الرسالة',
  `BodyLetter` longtext NOT NULL COMMENT 'الرسالة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='رسائل نموذجية';

--
-- Dumping data for table `letterslang`
--


-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `IdMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `Target` varchar(256) NOT NULL COMMENT 'وجهة النك',
  `Order` int(2) NOT NULL COMMENT 'ترتيبه من الاعلى',
  `External` varchar(1) NOT NULL COMMENT 'هل هذا الرابط خارجي؟',
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الصفحة المرتبطة بها ',
  UNIQUE KEY `IdMM` (`IdMM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='عناصر الائحة الرئيسية';

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`IdMM`, `Link`, `Target`, `Order`, `External`, `IdPage`) VALUES
('20100000000', 'Prog-pages_pagenbr-1_Lang-English_nl-1.pt', '', 1, '0', '20100000001');

--
-- Table structure for table `marqlang`
--

CREATE TABLE IF NOT EXISTS `marqlang` (
  `idmarque` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Message` varchar(125) NOT NULL COMMENT 'الرسالة',
  UNIQUE KEY `idmarque` (`idmarque`,`idLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شريط الاخبار حسب اللغة';

--
-- Dumping data for table `marqlang`
--


-- --------------------------------------------------------

--
-- Table structure for table `marques`
--

CREATE TABLE IF NOT EXISTS `marques` (
  `idMarque` varchar(11) NOT NULL COMMENT 'رقم الخبر ',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `StartDate` datetime NOT NULL COMMENT 'تاريخ البدء',
  `EndDate` datetime NOT NULL COMMENT 'تاريخ الانتهاء',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف؟',
  UNIQUE KEY `idMarque` (`idMarque`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شريط الاخبار';

--
-- Dumping data for table `marques`
--


-- --------------------------------------------------------

--
-- Table structure for table `menlang`
--

CREATE TABLE IF NOT EXISTS `menlang` (
  `idMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleElement` varchar(35) NOT NULL COMMENT 'اسم العنصر بهذه اللغة',
  UNIQUE KEY `idMM` (`idMM`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='اسماء عناصر الائحة الرئيسية حسب ?';

--
-- Dumping data for table `menlang`
--

INSERT INTO `menlang` (`idMM`, `IdLang`, `TitleElement`) VALUES
('20100000000', '20070000001', 'الصفحة الأولى'),
('20100000000', '20070000002', 'Page One');

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE IF NOT EXISTS `moderators` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `Permission` varchar(1) NOT NULL COMMENT 'الصلاحية',
  UNIQUE KEY `GroupId` (`GroupId`,`ObjectId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاشراف';

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`) VALUES
('200700000-1', '20110000000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `IdUserName` varchar(11) NOT NULL COMMENT 'رقم الكاتب',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `Hits` varchar(7) NOT NULL COMMENT 'زيارة',
  `NewsPic` varchar(50) NOT NULL COMMENT 'صورة للخبر',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف ؟',
  PRIMARY KEY (`IdNews`),
  UNIQUE KEY `IdNews` (`IdNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاخبار';

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `newscategoies`
--

CREATE TABLE IF NOT EXISTS `newscategoies` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقمم الخبر',
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  UNIQUE KEY `IdNews` (`IdNews`,`IdCat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ربط الخبر بمجموعة';

--
-- Dumping data for table `newscategoies`
--


-- --------------------------------------------------------

--
-- Table structure for table `newscomment`
--

CREATE TABLE IF NOT EXISTS `newscomment` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `CommentTitle` varchar(100) NOT NULL COMMENT 'عنوان التعليق',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `CommentDate` datetime NOT NULL COMMENT 'تاريخ التعليق',
  `theComment` varchar(500) NOT NULL COMMENT 'نص التعليق',
  `idComment` varchar(11) NOT NULL COMMENT 'رقم التعليق',
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تعليقات على الخبر';

--
-- Dumping data for table `newscomment`
--


-- --------------------------------------------------------

--
-- Table structure for table `newslang`
--

CREATE TABLE IF NOT EXISTS `newslang` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقمم اللغة',
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `Tilte` varchar(125) DEFAULT NULL,
  `SubTitle` varchar(35) NOT NULL COMMENT 'العنوان الفرعي للخبر',
  `Breif` text NOT NULL COMMENT 'مختصر الخبر',
  `FullMessage` longtext NOT NULL COMMENT 'الخبر كاملا',
  `Note` varchar(200) NOT NULL COMMENT 'ملاحظة',
  PRIMARY KEY (`IdLang`,`IdNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاخبار حسب اللغة';

--
-- Dumping data for table `newslang`
--


-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `ObjectName` varchar(35) NOT NULL COMMENT 'اسم العنصر',
  UNIQUE KEY `ObjectId` (`ObjectId`,`ObjectName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='عناصر يتم التحكم بالوصول اليها ه?';

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`ObjectId`, `ObjectName`) VALUES
('20100000001', '{PageNumber} 1');

-- --------------------------------------------------------

--
-- Table structure for table `oldstatistics`
--

CREATE TABLE IF NOT EXISTS `oldstatistics` (
  `MonthDate` varchar(8) NOT NULL COMMENT 'الشهر و السنة',
  `IPNbr` varchar(15) NOT NULL COMMENT 'ايبي بلد الزيارة',
  `Hits` varchar(7) NOT NULL COMMENT 'عدد الزيارات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='في الاحصاءات للاشهرو السنوات الق';

--
-- Dumping data for table `oldstatistics`
--


-- --------------------------------------------------------

--
-- Table structure for table `opstatistics`
--

CREATE TABLE IF NOT EXISTS `opstatistics` (
  `MSIE` varchar(7) NOT NULL COMMENT 'انترنت اكسبلورر',
  `Opera` varchar(7) NOT NULL COMMENT 'اوبرا',
  `Konqueror` varchar(7) NOT NULL COMMENT 'كونكيور',
  `Netscape` varchar(7) NOT NULL COMMENT 'نتسكايب',
  `FireFox` varchar(7) NOT NULL COMMENT 'فايرفوكس',
  `Bot` varchar(7) NOT NULL COMMENT 'بوت',
  `Windows` varchar(7) NOT NULL COMMENT 'زيندوز',
  `Linux` varchar(7) NOT NULL COMMENT 'لينكس',
  `Mac` varchar(7) NOT NULL COMMENT 'ماكنتوش',
  `FreeBsd` varchar(7) NOT NULL COMMENT 'فري باسدي',
  `Other` varchar(7) NOT NULL COMMENT 'اخر'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مستعرضات و انظمة تشغيل الزوار';

--
-- Dumping data for table `opstatistics`
--

INSERT INTO `opstatistics` (`MSIE`, `Opera`, `Konqueror`, `Netscape`, `FireFox`, `Bot`, `Windows`, `Linux`, `Mac`, `FreeBsd`, `Other`) VALUES
('1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pagelang`
--

CREATE TABLE IF NOT EXISTS `pagelang` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `PageTitle` varchar(256) NOT NULL COMMENT 'عنوان الصفحة',
  `Content` longtext NOT NULL COMMENT 'محتوى الصفحة',
  PRIMARY KEY (`IdPage`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagelang`
--

INSERT INTO `pagelang` (`IdPage`, `IdLang`, `PageTitle`, `Content`) VALUES
('20100000001', '20070000001', 'عنوان الصفحة الأولى', '<p>مضمون <strong>الصفحة </strong>الأولى</p>\r\n<p><img src="images/phpTransformer-software-box-2.0.png" alt="" /></p>'),
('20100000001', '20070000002', 'Page Title', '<p>Page number <strong>one </strong>content</p>\r\n<p><img src="images/phpTransformer-software-box-2.0.png" alt="" /></p>');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `PageNbr` bigint(11) DEFAULT NULL,
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر للصلاحيات',
  `Hits` double NOT NULL COMMENT 'عدد الزيارات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هذه الصفحة محذوفة ؟',
  PRIMARY KEY (`IdPage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`IdPage`, `PageNbr`, `ObjectId`, `Hits`, `Deleted`) VALUES
('20100000001', 1, '', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `params`
--

CREATE TABLE IF NOT EXISTS `params` (
  `MainPrograms` varchar(15) NOT NULL COMMENT 'البرنامج الافتراضي',
  `DefaultLang` varchar(15) NOT NULL COMMENT 'اللغة الافتراضية',
  `DefaultThem` varchar(15) NOT NULL COMMENT 'الشكل الافتراضي',
  `AutoLang` varchar(1) NOT NULL COMMENT 'استعمال خيار فحص اللغة الاتوماتي',
  `ConvertAt` varchar(1) NOT NULL COMMENT 'تحويل @الى صورة',
  `ExternalLinks` varchar(1) NOT NULL COMMENT 'السماح بالروابط الخارجية',
  `UseRew` varchar(1) NOT NULL COMMENT 'استعمال url rew',
  `CookieAge` varchar(15) NOT NULL COMMENT 'عمر الكوكيز الافتراضي',
  `IsOpen` varchar(1) NOT NULL COMMENT 'هل الموقع مفتوح نعم او لا',
  `DateGmt` varchar(3) NOT NULL COMMENT 'وقت الموقع بالنسبة لغرينتش',
  `ViewTopCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMarqueeCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMenuCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMainCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewSecCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewFootCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewProgCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `OpenRegister` varchar(1) NOT NULL COMMENT 'الموقع سامح لتسجيل اعضاء جدد او لا',
  `GeoIpService` varchar(255) NOT NULL COMMENT 'الموقع الذي سيقدم خدمة تحديد بلد الايبي المتصل بالموقع',
  `AdminRegOk` varchar(1) NOT NULL COMMENT 'يجب ان يوافق المدير على تفعيل تسجيل الاعضاء الجدد',
  `MaxNbrPost` varchar(2) NOT NULL COMMENT 'العدد الاقصى لمحاولة ارسال معلومات خطأ',
  `DefaulPageNbr` varchar(3) NOT NULL COMMENT 'رقم الصفحة الافتراضية لبرنام الصفحات',
  `NewsMaxNbr` varchar(3) NOT NULL COMMENT 'العدد الاقصى للاخبار في صفحة الاخبار',
  `FloodSec` varchar(5) NOT NULL COMMENT 'عدد الثواني بين طلب كل صفحة من نفس المستخدم',
  `GuestCanWrite` varchar(1) NOT NULL COMMENT 'هل يسمح للزوار بالمشاركة دون تسجيل',
  `RobotAdmin` varchar(1) NOT NULL COMMENT 'استعمال المدير الالي',
  `MailList` varchar(11) NOT NULL COMMENT 'عدد الاعضاء الذين سيرسلهم لهم اخر بريد',
  `License` text NOT NULL COMMENT 'مفتاح الترخيص',
  `LastProg` varchar(35) NOT NULL COMMENT 'اخر برنامج تمت ادارته من لوحة تحكم المدير',
  `LastBlock` varchar(35) NOT NULL COMMENT 'اخر بلوك تمت ادارته من لوحة تحكم المدير',
  `EmailMethode` varchar(35) NOT NULL COMMENT 'smtp or sendmail',
  `CacheEnabled` int(1) NOT NULL,
  `TimeCache` int(100) NOT NULL,
  `IgnoreList` longtext NOT NULL,
  `WebSiteFullName` text NOT NULL,
  `GoogleCode` varchar(26) NOT NULL COMMENT 'Google analytics pageTracker ',
  `EnableStatistics` tinyint(1) NOT NULL COMMENT 'هل نظام الاحصائيات مفعل',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  `UpdateName` text NOT NULL COMMENT 'اسم الاصدارة الجديدة',
  PRIMARY KEY (`MainPrograms`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خصائص الوقع الافتراضية';

--
-- Dumping data for table `params`
--

INSERT INTO `params` (`MainPrograms`, `DefaultLang`, `DefaultThem`, `AutoLang`, `ConvertAt`, `ExternalLinks`, `UseRew`, `CookieAge`, `IsOpen`, `DateGmt`, `ViewTopCont`, `ViewMarqueeCont`, `ViewMenuCont`, `ViewMainCont`, `ViewSecCont`, `ViewFootCont`, `ViewProgCont`, `OpenRegister`, `GeoIpService`, `AdminRegOk`, `MaxNbrPost`, `DefaulPageNbr`, `NewsMaxNbr`, `FloodSec`, `GuestCanWrite`, `RobotAdmin`, `MailList`, `License`, `LastProg`, `LastBlock`, `EmailMethode`, `CacheEnabled`, `TimeCache`, `IgnoreList`, `WebSiteFullName`, `GoogleCode`, `EnableStatistics`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`, `UpdateName`) VALUES
('pages', 'English', 'Default', '0', '1', '1', '1', 'Month', '1', '2', '1', '1', '1', '1', '1', '1', '1', '1', '//phptransformer.com/GeoIpDectecter/index.php?ip=', '0', '5', '1', '10', '0.06', '1', '0', '6', '', 'pages', 'Pool', 'sendmail', 0, 86400, '', 'This is my site Name !', '', 1, '2011-06-23 08:30:44', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` varchar(11) NOT NULL COMMENT 'رقم الاضافة',
  `name` varchar(1024) NOT NULL COMMENT 'اسم الاضافة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول الاضافات المفعلة';

--
-- Dumping data for table `plugins`
--


-- --------------------------------------------------------

--
-- Table structure for table `poolchoices`
--

CREATE TABLE IF NOT EXISTS `poolchoices` (
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار',
  `idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `cheked` varchar(1) NOT NULL COMMENT 'هل هو معلم',
  PRIMARY KEY (`idpc`,`idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خيارت التصويت';

--
-- Dumping data for table `poolchoices`
--

INSERT INTO `poolchoices` (`idpc`, `idpt`, `cheked`) VALUES
('20100000000', '20100000000', '0'),
('20100000001', '20100000000', '1'),
('20100000002', '20100000000', '0'),
('20100000003', '20100000000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `poollangchoices`
--

CREATE TABLE IF NOT EXISTS `poollangchoices` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم خيار التصويت',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان الخيار',
  `Choise` varchar(100) NOT NULL COMMENT 'الخيار بهذه اللغة',
  PRIMARY KEY (`IdLang`,`idpc`,`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خيارات التصويت بلغة معينة';

--
-- Dumping data for table `poollangchoices`
--

INSERT INTO `poollangchoices` (`IdLang`, `idpc`, `Idpt`, `Choise`) VALUES
('20070000001', '20100000000', '20100000000', 'سعر قليل أو مجاني'),
('20070000001', '20100000001', '20100000000', 'حر مفتوح المصدر'),
('20070000001', '20100000002', '20100000000', 'سهولة استعماله'),
('20070000001', '20100000003', '20100000000', 'إنتشاره بشكل واسع'),
('20070000002', '20100000000', '20100000000', 'low cost or Free'),
('20070000002', '20100000001', '20100000000', 'Free Open source'),
('20070000002', '20100000002', '20100000000', 'Easy of use'),
('20070000002', '20100000003', '20100000000', 'Spread widely');

-- --------------------------------------------------------

--
-- Table structure for table `poollangtitles`
--

CREATE TABLE IF NOT EXISTS `poollangtitles` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم العنوان',
  `Title` varchar(100) NOT NULL COMMENT 'العنوان بهذه اللغة',
  PRIMARY KEY (`IdLang`,`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='نص عنوان باللغات';

--
-- Dumping data for table `poollangtitles`
--

INSERT INTO `poollangtitles` (`IdLang`, `Idpt`, `Title`) VALUES
('20070000001', '20100000000', 'ماالذي يؤثر على اختيارك لبرنامج موقعك ؟'),
('20070000002', '20100000000', 'What affect the decision to choose your website program?');

-- --------------------------------------------------------

--
-- Table structure for table `pooltitle`
--

CREATE TABLE IF NOT EXISTS `pooltitle` (
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `poolstart` datetime NOT NULL COMMENT 'تاريخ بدء التصويت',
  `poolend` datetime NOT NULL COMMENT 'تاريخ نهاية التصويت',
  `multichoice` varchar(1) NOT NULL COMMENT 'هل يسمح بتعدد الخيارات',
  `published` varchar(1) NOT NULL COMMENT 'هل مجهز للنشر',
  `lastpol` varchar(1) NOT NULL COMMENT 'هل هو ىخر تصويت',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل التصويت محذوف؟',
  PRIMARY KEY (`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='التصويتات';

--
-- Dumping data for table `pooltitle`
--

INSERT INTO `pooltitle` (`Idpt`, `poolstart`, `poolend`, `multichoice`, `published`, `lastpol`, `Deleted`) VALUES
('20100000000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `poolusers`
--

CREATE TABLE IF NOT EXISTS `poolusers` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان التصويت',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار المصوت له',
  `IpPool` varchar(15) NOT NULL COMMENT 'رقم ايبي التصويت',
  `Comment` varchar(250) NOT NULL COMMENT 'تعليق المستخدم'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تصويت المستخدمين';

--
-- Dumping data for table `poolusers`
--


-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `IdProgram` varchar(11) NOT NULL COMMENT 'رقم البرنامج',
  `ProgramName` varchar(35) NOT NULL COMMENT 'اسم البرنامج',
  `Permission` varchar(1) NOT NULL COMMENT 'صلاحية للجميع ',
  `ViewTopCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMarqueeCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMenuCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMainCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewSecCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewFootCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewProgCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقمه المرتبط بالسيكيوريتي',
  `Hits` double NOT NULL DEFAULT '0' COMMENT 'عدد المشاهدات',
  `Deleted` varchar(2) NOT NULL COMMENT 'محذوف الى سلة المحذوفات؟',
  `License` text NOT NULL COMMENT 'مفتاح الترخيص',
  `cached` int(1) NOT NULL,
  `cachetime` int(100) NOT NULL COMMENT 'وقت الحفظ',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  UNIQUE KEY `IdProgram` (`IdProgram`,`ProgramName`),
  UNIQUE KEY `ProgramName` (`ProgramName`),
  UNIQUE KEY `ProgramName_2` (`ProgramName`),
  UNIQUE KEY `ProgramName_3` (`ProgramName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`IdProgram`, `ProgramName`, `Permission`, `ViewTopCont`, `ViewMarqueeCont`, `ViewMenuCont`, `ViewMainCont`, `ViewSecCont`, `ViewFootCont`, `ViewProgCont`, `ObjectId`, `Hits`, `Deleted`, `License`, `cached`, `cachetime`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`) VALUES
('20070000000', 'pages', '1', '1', '1', '1', '1', '1', '1', '1', '20070000000', 2, '0', '', 1, 86400, '0000-00-00 00:00:00', 0, ''),
('20070000001', 'account', '1', '1', '1', '1', '1', '1', '1', '1', '20070000001', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000003', 'tellfriend', '1', '1', '1', '1', '1', '1', '1', '1', '20070000003', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000004', 'pool', '1', '1', '1', '1', '1', '1', '1', '1', '20070000009', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000005', 'usercp', '1', '1', '1', '1', '1', '1', '1', '1', '20070000010', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000007', 'news', '1', '1', '1', '1', '1', '1', '1', '1', '20070000001', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000008', 'ads', '1', '1', '1', '1', '1', '1', '1', '1', '20070000012', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000009', 'exlink', '1', '1', '1', '1', '1', '1', '1', '1', '20070000016', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20080000012', 'contactus', '1', '1', '1', '1', '1', '1', '1', '1', '20080000018', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20080000020', 'rss', '1', '0', '0', '0', '0', '0', '0', '1', '20080000029', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20110000001', 'gallery', '1', '1', '1', '1', '1', '1', '1', '1', '20110000003', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE IF NOT EXISTS `screens` (
  `ScreenXY` varchar(10) NOT NULL COMMENT 'ارتفاع و عرض الشاشة',
  `Hits` bigint(7) NOT NULL COMMENT 'عدد الشاشات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='احصائيات شاشات الزوار';

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`ScreenXY`, `Hits`) VALUES
('Anknow', 1),
('1024x768', 1),
('1440x900', 1),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1);

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `ThemeName` varchar(100) NOT NULL COMMENT 'اسم مجلد الشكل',
  `Active` varchar(1) NOT NULL COMMENT '  او محذوف نشط او لا',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `License` text NOT NULL COMMENT 'رقم ترخيص الدعم الفني',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  PRIMARY KEY (`ThemeName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`ThemeName`, `Active`, `LastChekUpdate`, `UpdateAvailble`, `License`, `UpdateDesc`) VALUES
('Default', '1', '0000-00-00 00:00:00', 0, '', ''),
('tech', '1', '0000-00-00 00:00:00', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة التي ينتسب اليها',
  `TimeFormat` varchar(12) NOT NULL COMMENT 'رقم شكل اظهار الوقت',
  `UserName` varchar(20) NOT NULL COMMENT 'اسم المستخدم',
  `NickName` varchar(20) NOT NULL COMMENT 'الاسم المستعار',
  `ParentName` varchar(20) NOT NULL COMMENT 'اسم الوالد',
  `FamName` varchar(20) NOT NULL COMMENT 'اسم العائلة',
  `BirthDate` date NOT NULL COMMENT 'تاريخ الميلاد',
  `Sex` varchar(1) NOT NULL COMMENT 'الجنس',
  `Gmt` varchar(3) NOT NULL COMMENT 'وقته بالنسبة لغرينتش',
  `Contry` varchar(15) NOT NULL COMMENT 'البلد',
  `town` varchar(15) NOT NULL COMMENT 'البلدة او المدينة',
  `Rue` varchar(15) NOT NULL COMMENT 'الشارع',
  `AddDetails` varchar(35) NOT NULL COMMENT 'العنوان مفصل',
  `CodePostal` varchar(4) NOT NULL COMMENT 'صندوق البريد',
  `ZipCode` varchar(4) NOT NULL COMMENT 'الرمز البريدي',
  `PhoneNbr` varchar(20) NOT NULL COMMENT 'رقم الهاتف',
  `CellNbr` varchar(20) NOT NULL COMMENT 'رقم الموبايل',
  `PassWord` varchar(35) NOT NULL COMMENT 'كلمة السر',
  `LastLogin` datetime NOT NULL COMMENT 'اخر دخول',
  `LastIP` varchar(15) NOT NULL COMMENT 'اخر رقم ايبي دخل منه',
  `Hobies` varchar(15) NOT NULL COMMENT 'الهوايات',
  `Job` varchar(15) NOT NULL COMMENT 'الوظيفة',
  `Education` varchar(15) NOT NULL COMMENT 'التعليم',
  `PrefLang` varchar(15) NOT NULL COMMENT 'اللغة المفضلة',
  `PrefTime` varchar(12) NOT NULL COMMENT 'الوقت المفضل للاتصال بالمستخدم بين كذا و كذا',
  `CookieLife` varchar(8) NOT NULL COMMENT 'عمر الكوكيز',
  `UserPic` text NOT NULL COMMENT 'اسم ملف صورة المستخدم',
  `UserMail` varchar(50) NOT NULL COMMENT 'بريد المستخدم',
  `UserSite` varchar(50) NOT NULL COMMENT 'موقع المستخدم',
  `Banned` varchar(1) NOT NULL COMMENT 'مطرود نعم او لا',
  `PrefThem` varchar(15) NOT NULL COMMENT 'الشكل المفضل',
  `UserSign` text NOT NULL COMMENT 'توقيعه',
  `Points` varchar(4) NOT NULL COMMENT 'نقاطه',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم اولا',
  `RegDate` datetime NOT NULL COMMENT 'تاريخ تسجيله',
  `allowHtml` varchar(1) NOT NULL COMMENT 'سماح بكود html',
  `allowBBcode` varchar(1) NOT NULL COMMENT 'سماح بكود bbcode',
  `allowSmiles` varchar(1) NOT NULL COMMENT 'السماح بتعابير',
  `allowAvatar` varchar(1) NOT NULL COMMENT 'السماح بصورة رمزية',
  `ConfirmCode` varchar(35) NOT NULL COMMENT 'كود تاكيد الاشتراك',
  `Mailed` varchar(2) NOT NULL COMMENT 'هل تم ارسال رسالة له اخر مرة؟',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف؟',
  `LastSession` varchar(35) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId` (`UserId`),
  UNIQUE KEY `NickName` (`NickName`),
  UNIQUE KEY `UserMail` (`UserMail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='اسماء المستخدمين للموقع';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `GroupId`, `TimeFormat`, `UserName`, `NickName`, `ParentName`, `FamName`, `BirthDate`, `Sex`, `Gmt`, `Contry`, `town`, `Rue`, `AddDetails`, `CodePostal`, `ZipCode`, `PhoneNbr`, `CellNbr`, `PassWord`, `LastLogin`, `LastIP`, `Hobies`, `Job`, `Education`, `PrefLang`, `PrefTime`, `CookieLife`, `UserPic`, `UserMail`, `UserSite`, `Banned`, `PrefThem`, `UserSign`, `Points`, `Active`, `RegDate`, `allowHtml`, `allowBBcode`, `allowSmiles`, `allowAvatar`, `ConfirmCode`, `Mailed`, `Deleted`, `LastSession`) VALUES
('20070000000', '20070000000', 'Y-m-d H:i:s', 'Guest', 'Guest', 'parent', 'family', '0000-00-00', '1', '+2', 'US', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2010-11-25 14:51:20', 'fe80::a998:ae3:', 'None', 'None', 'None', 'English', '12:00-16:00', '8640', '', 'None', 'None', '0', 'Default', 'Guest', '1', '1', '0000-00-00 00:00:00', '0', '0', '0', '0', '', '1', '0', '96jlqqiqds24us569dkodr9hu0'),
('200700000-1', '200700000-1', 'Y-m-d H:i:s', 'admin', 'admin', 'admin', 'admin', '1900-05-10', '1', '+2', 'LB', 'beiruth', '', '', '', '', '', '', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2011-06-23 10:34:48', 'fe80::a998:ae3:', 'Computer', 'Administrator', 'IT', 'Arabic', '12:00-16:00', '8640', 'images/avatars/mybrain.jpg', 'user@phptransformer.com', 'www.phptransformer.com', '0', 'Default', 'ADMINISTRATOR', '1', '1', '2007-05-10 13:48:47', '1', '1', '1', '1', '', '1', '0', '237220479463a909bc0c90c96831e1b7');

-- --------------------------------------------------------

--
-- Table structure for table `userslog`
--

CREATE TABLE IF NOT EXISTS `userslog` (
  `NickName` varchar(15) NOT NULL COMMENT 'اسم المستخدم',
  `Gmt` datetime NOT NULL COMMENT 'الوقت حسب غرينتش',
  `IpNbr` varchar(15) NOT NULL COMMENT 'رقم الايبي',
  `SessionId` varchar(35) DEFAULT NULL,
  `FromPage` varchar(256) NOT NULL COMMENT 'الصفحة التي اتى منها',
  `CurrentPage` varchar(256) NOT NULL COMMENT 'الصفحة الحالية'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لوغ  دخول المستخدمين';


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
