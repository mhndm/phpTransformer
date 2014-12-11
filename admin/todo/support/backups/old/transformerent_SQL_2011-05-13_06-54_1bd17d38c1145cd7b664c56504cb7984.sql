#SKD101|transformerent|77|2011.05.13 06:54:25|1143|154|3|1|1|25|13|6|232|300|5|1|1|13|16|4|16|56|9|1|18|1|1|3|1|2|2|4|2|6|13|16|3|3|7|6|64|4|1|8|4|1|5|6|12|4|2|3|23|8|3|6|9|11|22|2

DROP TABLE IF EXISTS adminlog;
CREATE TABLE `adminlog` (
  `TryName` varchar(15) NOT NULL COMMENT 'الاسم المحاول الدخول فيه',
  `TryPassword` varchar(35) NOT NULL COMMENT 'كلمة سر المحاولة',
  `TryDate` datetime NOT NULL COMMENT 'الوقت حسب غريبتش',
  `tryIp` varchar(15) NOT NULL COMMENT 'رقم الايبي المحاول منه'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS adminperm;
CREATE TABLE `adminperm` (
  `AdminID` varchar(11) NOT NULL COMMENT 'رقم المدير',
  `constName` varchar(4) NOT NULL COMMENT 'صلاحية لاصل المشروع او لبرنامج او لبلوك',
  `varName` varchar(100) NOT NULL COMMENT 'اسم المتغير',
  `varValue` varchar(100) NOT NULL COMMENT 'قيمة المتغير',
  `perm` int(1) NOT NULL COMMENT 'له صلاحية'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='جدول صلاحيات المدراء';

INSERT INTO `adminperm` VALUES
('20110000004', 'blok', 'todo', 'Images', 0),
('20110000004', 'blok', 'todo', 'Partner', 1),
('20110000004', 'blok', 'subdo', 'NewPool', 1),
('20110000004', 'blok', 'subdo', 'DelPool', 1),
('20110000004', 'blok', 'subdo', 'WhatUserPool', 1),
('20110000004', 'blok', 'subdo', 'EditPool', 1),
('20110000004', 'blok', 'subdo', 'ListPool', 1),
('20110000004', 'blok', 'todo', 'Pool', 1),
('20110000004', 'blok', 'todo', 'Gsearch', 1),
('20110000004', 'blok', 'todo', 'Language', 1),
('20110000004', 'blok', 'todo', 'Ads', 1),
('20110000004', 'blok', 'todo', 'Statistics', 1),
('20110000004', 'blok', 'subdo', 'EditElement', 1),
('20110000004', 'blok', 'subdo', 'AddElement', 1),
('20110000004', 'blok', 'subdo', 'BrowseMenu', 1),
('20110000004', 'blok', 'subdo', 'DeleteElement', 1),
('20110000004', 'blok', 'todo', 'MainMenu', 1),
('20110000004', 'prog', 'todo', 'fomaconakdi', 1),
('20110000004', 'prog', 'subdo', 'TestPerm', 1),
('20110000004', 'prog', 'subdo', 'delMedia', 1),
('20110000004', 'prog', 'subdo', 'allMedia', 1),
('20110000004', 'prog', 'subdo', 'addMedia', 1),
('20110000004', 'prog', 'subdo', 'editMedia', 1),
('20110000004', 'prog', 'subdo', 'cmntMedia', 1),
('20110000004', 'prog', 'subdo', 'ClearDB', 1),
('20110000004', 'prog', 'subdo', 'GalleryParameter', 1),
('20110000004', 'prog', 'todo', 'gallery', 1),
('20110000004', 'prog', 'todo', 'rss', 1),
('20110000004', 'prog', 'subdo', 'Newmessage', 1),
('20110000004', 'prog', 'subdo', 'deleteMessage', 1),
('20110000004', 'prog', 'subdo', 'editMessage', 1),
('20110000004', 'prog', 'subdo', 'BrowseMessages', 1),
('20110000004', 'prog', 'subdo', 'RequestedWebsite', 1),
('20110000004', 'prog', 'todo', 'messagecenter', 1),
('20110000004', 'prog', 'subdo', 'EditLisence', 1),
('20110000004', 'prog', 'subdo', 'GenerateLicense', 1),
('20110000004', 'prog', 'subdo', 'DelLisence', 1),
('20110000004', 'prog', 'subdo', 'GenerateNew', 1),
('20110000004', 'prog', 'subdo', 'ViewRequest', 1),
('20110000004', 'prog', 'todo', 'getlicense', 1),
('20110000004', 'prog', 'subdo', 'EditFeed', 1),
('20110000004', 'prog', 'subdo', 'DeleteFeed', 1),
('20110000004', 'prog', 'subdo', 'BrowseFeeds', 1),
('20110000004', 'prog', 'subdo', 'NewFeed', 1),
('20110000004', 'prog', 'todo', 'newsservice', 1),
('20110000004', 'prog', 'todo', 'weather', 1),
('20110000004', 'prog', 'subdo', 'ServicesManange', 1),
('20110000004', 'prog', 'todo', 'services', 1),
('20110000004', 'prog', 'subdo', 'PartnersManange', 1),
('20110000004', 'prog', 'todo', 'geoip', 1),
('20110000004', 'prog', 'todo', 'careers', 1),
('20110000004', 'prog', 'todo', 'contactus', 1),
('20110000004', 'prog', 'todo', 'exlink', 1),
('20110000004', 'prog', 'subdo', 'positions', 1),
('20110000004', 'prog', 'subdo', 'customers', 1),
('20110000004', 'prog', 'subdo', 'PriceList', 1),
('20110000004', 'prog', 'todo', 'ads', 1),
('20110000004', 'prog', 'subdo', 'editNews', 1),
('20110000004', 'prog', 'subdo', 'NewsCom', 1),
('20110000004', 'prog', 'subdo', 'addNews', 1),
('20110000004', 'prog', 'subdo', 'NewNewsCat', 1),
('20110000004', 'prog', 'subdo', 'NewsCat', 1),
('20110000004', 'prog', 'subdo', 'allNews', 1),
('20110000004', 'prog', 'subdo', 'deleteNews', 1),
('20110000004', 'prog', 'todo', 'news', 1),
('20110000004', 'prog', 'todo', 'fomacoorderadmin', 1),
('20110000004', 'prog', 'todo', 'usercp', 1),
('20110000004', 'prog', 'todo', 'pool', 1),
('20110000004', 'prog', 'todo', 'tellfriend', 1),
('20110000004', 'prog', 'subdo', 'ListPages', 1),
('20110000004', 'prog', 'subdo', 'deletepages', 1),
('20110000004', 'prog', 'subdo', 'editpages', 1),
('20110000004', 'prog', 'subdo', 'NewPage', 1),
('20110000004', 'prog', 'todo', 'pages', 1),
('20110000004', 'core', 'subdo', 'EditTrans', 1),
('20110000004', 'core', 'subdo', 'LisTrans', 1),
('20110000004', 'core', 'todo', 'Translations', 1),
('20110000004', 'core', 'subdo', 'NewTrans', 1),
('20110000004', 'core', 'todo', 'recycle', 1),
('20110000004', 'core', 'subdo', 'EditElement', 1),
('20110000004', 'core', 'subdo', 'AddElement', 1),
('20110000004', 'core', 'todo', 'mainmenu', 1),
('20110000004', 'core', 'subdo', 'DeleteElement', 1),
('20110000004', 'core', 'subdo', 'BrowseMenu', 1),
('20110000004', 'core', 'subdo', 'SubMenu', 1),
('20110000004', 'core', 'subdo', 'ChildsOfMenu', 1),
('20110000004', 'core', 'subdo', 'editMenu', 1),
('20110000004', 'core', 'subdo', 'AddElemnts', 1),
('20110000004', 'core', 'subdo', 'AddMenu', 1),
('20110000004', 'core', 'subdo', 'AllElemnts', 1),
('20110000004', 'core', 'subdo', 'RootMenu', 1),
('20110000004', 'core', 'subdo', 'delteMenu', 1),
('20110000004', 'core', 'todo', 'layersmenu', 1),
('20110000004', 'core', 'subdo', 'delnews', 1),
('20110000004', 'core', 'subdo', 'editnews', 1),
('20110000004', 'core', 'subdo', 'AddNews', 1),
('20110000004', 'core', 'todo', 'newsbar', 1),
('20110000004', 'core', 'todo', 'optimize', 1),
('20110000004', 'core', 'todo', 'restore', 1),
('20110000004', 'core', 'todo', 'Error', 1),
('20110000004', 'core', 'todo', 'backup', 1),
('20110000004', 'core', 'todo', 'database', 1),
('20110000004', 'core', 'todo', 'bugsandreport', 1),
('20110000004', 'core', 'subdo', 'delTheme', 1),
('20110000004', 'core', 'todo', 'Update', 1),
('20110000004', 'core', 'todo', 'Addons', 1),
('20110000004', 'core', 'todo', 'NewTheme', 1),
('20110000004', 'core', 'todo', 'installer', 1),
('20110000004', 'core', 'todo', 'newblock', 1),
('20110000004', 'core', 'todo', 'newprograms', 1),
('20110000004', 'core', 'todo', 'robotsadmin', 1),
('20110000004', 'core', 'todo', 'SEO', 1),
('20110000004', 'core', 'todo', 'cache', 1),
('20110000004', 'core', 'todo', 'languages', 1),
('20110000004', 'core', 'todo', 'themes', 1),
('20110000004', 'core', 'todo', 'webfolder', 1),
('20110000004', 'core', 'todo', 'options', 1),
('20110000004', 'core', 'todo', 'contieslangs', 1),
('20110000004', 'core', 'todo', 'faildlogin', 1),
('20110000004', 'core', 'todo', 'antiflood', 1),
('20110000004', 'core', 'todo', 'firewall', 1),
('20110000004', 'core', 'todo', 'blocking', 1),
('20110000004', 'core', 'todo', 'specialpermision', 1),
('20110000004', 'core', 'todo', 'blockspermisions', 1),
('20110000004', 'core', 'todo', 'programspermisions', 1),
('20110000004', 'core', 'todo', 'programscontrol', 1),
('20110000004', 'core', 'todo', 'blockscontrol', 1),
('20110000004', 'core', 'subdo', 'editl', 1),
('20110000004', 'core', 'subdo', 'Newletter', 1),
('20110000004', 'core', 'subdo', 'Listletter', 1),
('20110000004', 'core', 'subdo', 'deletel', 1),
('20110000004', 'core', 'todo', 'Letters', 1),
('20110000004', 'core', 'todo', 'Maillist', 1),
('20110000004', 'core', 'subdo', 'adminNew', 1),
('20110000004', 'core', 'subdo', 'adminDelete', 1),
('20110000004', 'core', 'subdo', 'adminPerm', 1),
('20110000004', 'core', 'subdo', 'listAdmins', 1),
('20110000004', 'core', 'subdo', 'EditGroup', 1),
('20110000004', 'core', 'todo', 'Admins', 1),
('20110000004', 'core', 'subdo', 'ChangeUserGroup', 1),
('20110000004', 'core', 'subdo', 'UsersGroup', 1),
('20110000004', 'core', 'subdo', 'SwitchGroup', 1),
('20110000004', 'core', 'subdo', 'DeleteGroup', 1),
('20110000004', 'core', 'subdo', 'NewGroup', 1),
('20110000004', 'core', 'todo', 'Groups', 1),
('20110000004', 'core', 'subdo', 'BanUser', 1),
('20110000004', 'core', 'subdo', 'ResetPassword', 1),
('20110000004', 'core', 'subdo', 'SearchUser', 1),
('20110000004', 'core', 'subdo', 'DeleteUser', 1),
('20110000004', 'core', 'subdo', 'NewUser', 1),
('20110000004', 'core', 'todo', 'members', 1),
('20110000004', 'blok', 'todo', 'FreeBlock', 1),
('20110000004', 'blok', 'todo', 'translate', 1),
('20110000004', 'blok', 'todo', 'fomacoorderBlock', 1);

DROP TABLE IF EXISTS admins;
CREATE TABLE `admins` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='جدول المدير';

INSERT INTO `admins` VALUES
('200700000-1', 'admin@phptransformer.com', '2011-04-05 10:53:24', 'fe80::a998:ae3:', '', '', 'admin/todo/support/backups/', '0000-00-00 00:00:00', 1),
('20070000001', 'mhndm@$mhndm.com', '2011-03-11 08:55:06', 'fe80::a998:ae3:', '', '', '/root/', '0000-00-00 00:00:00', 0),
('20110000004', 'ali.sms@foma-co.com', '2011-02-28 15:05:20', 'fe80::a998:ae3:', '', '', '/', '0000-00-00 00:00:00', 0);

DROP TABLE IF EXISTS bancltrans;
CREATE TABLE `bancltrans` (
  `IdTrans` varchar(11) NOT NULL COMMENT 'رقم الحركة',
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم المعلن',
  `Debit` double NOT NULL COMMENT 'مدين',
  `Credit` double NOT NULL COMMENT 'دائن',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `ValueDate` datetime NOT NULL COMMENT 'تاريخ الاستحقاق',
  `Desc` varchar(100) NOT NULL COMMENT 'البيان',
  PRIMARY KEY (`IdTrans`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='حركة زبون الاعلان المتعلقة بالتح';

DROP TABLE IF EXISTS banner;
CREATE TABLE `banner` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='لاعلانات';

DROP TABLE IF EXISTS bannerclients;
CREATE TABLE `bannerclients` (
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم زبون الاعلان',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `AdminOk` varchar(1) NOT NULL COMMENT 'تم الموافقة على حساب المعلن من قبل المدير نعم او لا',
  `adsPayment` varchar(20) NOT NULL COMMENT 'طريقة الدفع',
  UNIQUE KEY `idBanClnt` (`idBanClnt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='المستخدمين المعلينين';

INSERT INTO `bannerclients` VALUES
('20070000001', '200700000-1', '1', '12');

DROP TABLE IF EXISTS bannerplans;
CREATE TABLE `bannerplans` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خطط الاعلان';

DROP TABLE IF EXISTS bannerpositions;
CREATE TABLE `bannerpositions` (
  `IdBanPos` varchar(11) NOT NULL COMMENT 'رقم موضع الاعلان',
  `PositionNbr` varchar(2) NOT NULL COMMENT 'مكان الاعلان كرقم',
  `PositionName` varchar(15) NOT NULL COMMENT 'اسم الموضع',
  `PosWidth` varchar(11) NOT NULL COMMENT 'عرض مكان الاعلان',
  `PosHeight` varchar(11) NOT NULL COMMENT 'طول مكان الاعلان',
  UNIQUE KEY `IdBanPos` (`IdBanPos`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='مواضع الاعلانات في الموق';

INSERT INTO `bannerpositions` VALUES
('20070000001', '1', 'Ads Block', '160', '250');

DROP TABLE IF EXISTS blacklist;
CREATE TABLE `blacklist` (
  `BlackWord` varchar(100) NOT NULL COMMENT 'الكلمة المحظورة',
  `BlockReason` varchar(1024) NOT NULL COMMENT 'سبب الحظر',
  `BlockDate` datetime NOT NULL COMMENT 'تاريخ الحظر'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الكلمات المحظورة للاستعمال في ال';

DROP TABLE IF EXISTS blocklang;
CREATE TABLE `blocklang` (
  `idblocklang` varchar(11) NOT NULL COMMENT 'رقم الجدول',
  `BlockName` varchar(35) NOT NULL COMMENT 'اسم البلوك',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BlockTitle` varchar(35) NOT NULL COMMENT 'عنوان البلوك بهذه اللغة'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `blocklang` VALUES
('20070000001', 'MainMenu', '20070000001', 'الائحة الرئيسية'),
('20070000002', 'Search', '20070000001', 'بـحــث'),
('20070000003', 'Account', '20070000001', 'دخول الأعضاء'),
('20070000004', 'statistics', '20070000001', 'إحصائيات'),
('20070000005', 'MainMenu', '20070000002', 'Main Menu'),
('20070000006', 'Search', '20070000002', 'Search'),
('20070000007', 'Account', '20070000002', 'Account'),
('20070000008', 'Ads', '20070000002', 'Advertising'),
('20070000009', 'Language', '20070000002', 'Language'),
('20070000010', 'Language', '20070000001', 'لغة الموقع'),
('20070000012', 'Pool', '20070000001', 'تصويت'),
('20070000012', 'Pool', '20070000002', 'Pool'),
('20070000008', 'Ads', '20070000001', 'اعلانات'),
('20080000014', 'FreeBlock', '20070000002', 'Free Block'),
('20080000013', 'FreeBlock', '20070000001', 'فرب بلوك'),
('20090000000', 'translate', '20070000001', 'ترجمة الموقع'),
('20090000001', 'translate', '20070000002', 'Translate Website'),
('20100000000', 'Partner', '20070000001', 'Partner'),
('20100000001', 'Partner', '20070000002', 'Partner'),
('20100000002', 'Images', '20070000001', 'Images'),
('20100000003', 'Images', '20070000002', 'Images'),
('20110000009', 'x helloworldBlock', '20070000002', 'x helloworldBlock'),
('20110000008', 'x helloworldBlock', '20070000001', 'x helloworldBlock'),
('20110000006', 'fomacoorderBlock', '20070000001', 'fomacoorderBlock'),
('20110000007', 'fomacoorderBlock', '20070000002', 'fomacoorderBlock');

DROP TABLE IF EXISTS blocks;
CREATE TABLE `blocks` (
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
  UNIQUE KEY `BlockName_2` (`BlockName`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='البلوكات';

INSERT INTO `blocks` VALUES
('MainMenu', '1', '1', 'M', 2, '20070000001', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '2011-05-13 06:53:56', '0', ''),
('Account', '1', '1', 'S', 1, '20070000002', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', '0'),
('Statistics', '1', '1', 'S', 2, '20070000003', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', '0'),
('Ads', '1', '1', 'S', 3, '20070000004', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', 'dfgsd fdsf sdf sdf '),
('Gsearch', '1', '1', 'M', 7, '20070000005', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '2011-05-13 06:53:56', '0', ''),
('Language', '1', '1', 'S', 4, '20070000006', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', '0'),
('Pool', '1', '1', 'S', 5, '20070000008', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', '0'),
('Partner', '1', '1', 'M', 1, '20100000005', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', 'fdg fgfd fdg dfg '),
('Images', '1', '1', 'M', 3, '20100000006', '', '', '0000-00-00 00:00:00', '0', '0'),
('FreeBlock', '1', '1', 'S', 6, '20080000064', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '2011-05-13 06:53:56', '0', ''),
('translate', '1', '1', 'S', 7, '20090000000', '', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '0000-00-00 00:00:00', '0', 'rdre fdg fdg fdg '),
('x helloworldBlock', '1', '1', 'M', 1, '20110000008', '1', '', '0000-00-00 00:00:00', '0', '0'),
('fomacoorderBlock', '1', '1', 'M', 1, '20110000009', '0', '', '0000-00-00 00:00:00', '0', '0');

DROP TABLE IF EXISTS campaign;
CREATE TABLE `campaign` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الحملات الاعلانية';

DROP TABLE IF EXISTS careers;
CREATE TABLE `careers` (
  `CvId` varchar(11) NOT NULL,
  `FirstNameValue` varchar(35) DEFAULT NULL,
  `FatherNameValue` varchar(35) DEFAULT NULL,
  `MotherNameValue` varchar(35) DEFAULT NULL,
  `GrandFatherNameValue` varchar(35) DEFAULT NULL,
  `FamilyNameValue` varchar(35) DEFAULT NULL,
  `BirthDateValue` varchar(35) DEFAULT NULL,
  `BirthLocationValue` varchar(35) DEFAULT NULL,
  `CertifecateFrom3Value` varchar(35) DEFAULT NULL,
  `SexValue` varchar(1) DEFAULT NULL,
  `NationalityValue` varchar(35) DEFAULT NULL,
  `SegelNbrValue` varchar(35) DEFAULT NULL,
  `SegelLocationValue` varchar(35) DEFAULT NULL,
  `DamanNbrValue` varchar(35) DEFAULT NULL,
  `celibateValue` varchar(35) DEFAULT NULL,
  `MariageValue` varchar(35) DEFAULT NULL,
  `WidowerValue` varchar(35) DEFAULT NULL,
  `DivorcedValue` varchar(35) DEFAULT NULL,
  `FianceValue` varchar(35) DEFAULT NULL,
  `SpendName1Value` varchar(35) DEFAULT NULL,
  `Relative1Value` varchar(35) DEFAULT NULL,
  `Sex1Value` varchar(1) DEFAULT NULL,
  `BirthDate1Value` varchar(35) DEFAULT NULL,
  `SpendName2Value` varchar(35) DEFAULT NULL,
  `Relative2Value` varchar(35) DEFAULT NULL,
  `Sex2Value` varchar(1) DEFAULT NULL,
  `BirthDate2Value` varchar(35) DEFAULT NULL,
  `SpendName3Value` varchar(35) DEFAULT NULL,
  `Relative3Value` varchar(35) DEFAULT NULL,
  `Sex3Value` varchar(1) DEFAULT NULL,
  `BirthDate3Value` varchar(35) DEFAULT NULL,
  `SpendName4Value` varchar(35) DEFAULT NULL,
  `Relative4Value` varchar(35) DEFAULT NULL,
  `Sex4Value` varchar(1) DEFAULT NULL,
  `BirthDate4Value` varchar(35) DEFAULT NULL,
  `SpendName5Value` varchar(35) DEFAULT NULL,
  `Sex5Value` varchar(1) DEFAULT NULL,
  `BirthDate5Value` varchar(35) DEFAULT NULL,
  `SpendName6Value` varchar(35) DEFAULT NULL,
  `Relative6Value` varchar(35) DEFAULT NULL,
  `Sex6Value` varchar(1) DEFAULT NULL,
  `BirthDate6Value` varchar(35) DEFAULT NULL,
  `HealthStatusValue` varchar(35) DEFAULT NULL,
  `HearingValue` varchar(1) DEFAULT NULL,
  `ViewingValue` varchar(1) DEFAULT NULL,
  `TalkingValue` varchar(1) DEFAULT NULL,
  `DidUSmokeYesValue` varchar(1) DEFAULT NULL,
  `DidUSmokeNoValue` varchar(1) DEFAULT NULL,
  `DidUDoObligingYesValue` varchar(1) DEFAULT NULL,
  `DidUDoObligingNoValue` varchar(1) DEFAULT NULL,
  `ObligingOtherValue` varchar(35) DEFAULT NULL,
  `TownValue` varchar(35) DEFAULT NULL,
  `RueValue` varchar(35) DEFAULT NULL,
  `BuildingValue` varchar(35) DEFAULT NULL,
  `BuildOwnerValue` varchar(35) DEFAULT NULL,
  `PhoneValue` varchar(35) DEFAULT NULL,
  `CellulaireValue` varchar(35) DEFAULT NULL,
  `EmailValue` varchar(35) DEFAULT NULL,
  `EducationLevel1Value` varchar(35) DEFAULT NULL,
  `Average1Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom1Value` varchar(35) DEFAULT NULL,
  `CertifecateYear1Value` varchar(35) DEFAULT NULL,
  `EducationLevel2Value` varchar(35) DEFAULT NULL,
  `Average2Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom2Value` varchar(35) DEFAULT NULL,
  `CertifecateYear2Value` varchar(35) DEFAULT NULL,
  `EducationLevel3Value` varchar(35) DEFAULT NULL,
  `Average3Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom3` varchar(35) DEFAULT NULL,
  `CertifecateYear3Value` varchar(35) DEFAULT NULL,
  `EducationLevel4Value` varchar(35) DEFAULT NULL,
  `Average14Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom14Value` varchar(35) DEFAULT NULL,
  `CertifecateYear4Value` varchar(35) DEFAULT NULL,
  `EducationLevel5Value` varchar(35) DEFAULT NULL,
  `Average5Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom5Value` varchar(35) DEFAULT NULL,
  `CertifecateYear5Value` varchar(35) DEFAULT NULL,
  `CycleName1Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle1Value` varchar(35) DEFAULT NULL,
  `CycleFrom1Value` varchar(35) DEFAULT NULL,
  `CycleDate1Value` varchar(35) DEFAULT NULL,
  `CycleName2Value` varchar(35) DEFAULT NULL,
  `CycleInterval2Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle12Value` varchar(35) DEFAULT NULL,
  `CycleFrom2Value` varchar(35) DEFAULT NULL,
  `CycleName3Value` varchar(35) DEFAULT NULL,
  `CycleInterval3Value` varchar(35) DEFAULT NULL,
  `CycleDate2Value` varchar(35) DEFAULT NULL,
  `CycleInterval1Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle13Value` varchar(35) DEFAULT NULL,
  `CycleFrom3Value` varchar(35) DEFAULT NULL,
  `CycleDate3Value` varchar(35) DEFAULT NULL,
  `CycleName4Value` varchar(35) DEFAULT NULL,
  `CycleInterval4Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle14Value` varchar(35) DEFAULT NULL,
  `CycleFrom4Value` varchar(35) DEFAULT NULL,
  `CycleDate4Value` varchar(35) DEFAULT NULL,
  `CycleName5Value` varchar(35) DEFAULT NULL,
  `CycleInterval5Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle15Value` varchar(35) DEFAULT NULL,
  `CycleFrom5Value` varchar(35) DEFAULT NULL,
  `CycleDate5Value` varchar(35) DEFAULT NULL,
  `LangName1Value` varchar(35) DEFAULT NULL,
  `ReadExcellent1Value` varchar(1) DEFAULT NULL,
  `ReadGood1Value` varchar(1) DEFAULT NULL,
  `ReadMoyen1Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `WriteExcellent1Value` varchar(1) DEFAULT NULL,
  `WriteGood1Value` varchar(1) DEFAULT NULL,
  `WriteMoyen1Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent1Value` varchar(1) DEFAULT NULL,
  `SpeakGood1Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen1Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `LangName2Value` varchar(35) DEFAULT NULL,
  `ReadExcellent2Value` varchar(1) DEFAULT NULL,
  `ReadGood2Value` varchar(1) DEFAULT NULL,
  `ReadMoyen2Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen2Value` varchar(1) DEFAULT NULL,
  `WriteGood2Value` varchar(1) DEFAULT NULL,
  `WriteMoyen2Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen2Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent2Value` varchar(1) DEFAULT NULL,
  `SpeakGood2Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen2Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen2Value` varchar(35) DEFAULT NULL,
  `LangName3Value` varchar(35) DEFAULT NULL,
  `ReadGood3Value` varchar(1) DEFAULT NULL,
  `ReadMoyen3Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `WriteExcellent3Value` varchar(1) DEFAULT NULL,
  `WriteGood3Value` varchar(1) DEFAULT NULL,
  `WriteMoyen3Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent3Value` varchar(1) DEFAULT NULL,
  `SpeakGood3Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen3Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `DontKnowValue` varchar(1) DEFAULT NULL,
  `DriverValue` varchar(1) DEFAULT NULL,
  `SupportValue` varchar(1) DEFAULT NULL,
  `ProgramerValue` varchar(1) DEFAULT NULL,
  `OtherExperienceValue` varchar(50) DEFAULT NULL,
  `CompName1Value` varchar(35) DEFAULT NULL,
  `ConctactMethode1Value` varchar(35) DEFAULT NULL,
  `FromDate1Value` varchar(35) DEFAULT NULL,
  `ToDate1Value` varchar(35) DEFAULT NULL,
  `OldJob1Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary1Value` varchar(35) DEFAULT NULL,
  `WhyLeft1Value` varchar(35) DEFAULT NULL,
  `CompName2Value` varchar(35) DEFAULT NULL,
  `ConctactMethode2Value` varchar(35) DEFAULT NULL,
  `FromDate2Value` varchar(35) DEFAULT NULL,
  `ToDate2Value` varchar(35) DEFAULT NULL,
  `OldJob2Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary2Value` varchar(35) DEFAULT NULL,
  `WhyLeft2Value` varchar(35) DEFAULT NULL,
  `CompName3Value` varchar(35) DEFAULT NULL,
  `ConctactMethode3Value` varchar(35) DEFAULT NULL,
  `FromDate3Value` varchar(35) DEFAULT NULL,
  `ToDate3Value` varchar(35) DEFAULT NULL,
  `OldJob3Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary3Value` varchar(35) DEFAULT NULL,
  `WhyLeft3Value` varchar(35) DEFAULT NULL,
  `CompName4Value` varchar(35) DEFAULT NULL,
  `ConctactMethode4Value` varchar(35) DEFAULT NULL,
  `FromDate4Value` varchar(35) DEFAULT NULL,
  `ToDate4Value` varchar(35) DEFAULT NULL,
  `OldJob4Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary4Value` varchar(35) DEFAULT NULL,
  `WhyLeft4Value` varchar(35) DEFAULT NULL,
  `CompName5Value` varchar(35) DEFAULT NULL,
  `ConctactMethode5Value` varchar(35) DEFAULT NULL,
  `FromDate5Value` varchar(35) DEFAULT NULL,
  `ToDate5Value` varchar(35) DEFAULT NULL,
  `OldJob5Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary5Value` varchar(35) DEFAULT NULL,
  `WhyLeft5Value` varchar(35) DEFAULT NULL,
  `MustExcutingInOldJobsValue` varchar(100) DEFAULT NULL,
  `DiduDoAnotherJobsOverTimeValue` varchar(35) DEFAULT NULL,
  `DoYouRejectWorkOverTimeYesValue` varchar(1) DEFAULT NULL,
  `DoYouRejectWorkOverTimeNoValue` varchar(1) DEFAULT NULL,
  `DoYouRejectCallingOldJobValue` varchar(35) DEFAULT NULL,
  `HowDoYouHearAboutUsValue` varchar(35) DEFAULT NULL,
  `WhyYouWantToJoinValue` varchar(35) DEFAULT NULL,
  `WhatJobYouWichValue` varchar(35) DEFAULT NULL,
  `WhenUCanStartValue` varchar(35) DEFAULT NULL,
  `WishedSalaryValue` varchar(35) DEFAULT NULL,
  `TalkAboutSkillsInThisJobValue` varchar(50) DEFAULT NULL,
  `DidYouSendUsAnCVYesValue` varchar(1) DEFAULT NULL,
  `DidYouSendUsAnCVNoValue` varchar(1) DEFAULT NULL,
  `ifYesWriteCVNumberHereValue` varchar(35) DEFAULT NULL,
  `DoYouHaveNearbyInTheCompanyValue` varchar(50) DEFAULT NULL,
  `OutName1Value` varchar(35) DEFAULT NULL,
  `OutContact1Value` varchar(35) DEFAULT NULL,
  `OutJobDesc1Value` varchar(35) DEFAULT NULL,
  `OutName2Value` varchar(35) DEFAULT NULL,
  `OutContact2Value` varchar(35) DEFAULT NULL,
  `OutJobDesc2Value` varchar(35) DEFAULT NULL,
  `OutName3Value` varchar(35) DEFAULT NULL,
  `OutContact3Value` varchar(35) DEFAULT NULL,
  `OutJobDesc3Value` varchar(35) DEFAULT NULL,
  `TrueInfoValue` varchar(35) DEFAULT NULL,
  `WriteExcellent2Value` varchar(1) NOT NULL,
  `ReadExcellent3Value` varchar(1) NOT NULL,
  PRIMARY KEY (`CvId`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS categorie;
CREATE TABLE `categorie` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ThemName` varchar(7) NOT NULL COMMENT 'اسم الشكل',
  PRIMARY KEY (`IdCat`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS catlang;
CREATE TABLE `catlang` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `CatName` varchar(15) NOT NULL COMMENT 'اسم المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل نوع الخير محذوف',
  PRIMARY KEY (`IdCat`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `catlang` VALUES
('20070000001', '20070000001', 'تجارية', '1'),
('20070000001', '20070000002', 'Commerce', '1'),
('20070000002', '20070000002', 'General News', ''),
('20070000002', '20070000001', 'اخبار عامة', ''),
('20100000000', '20070000001', 'أخبار عامة', '1'),
('20100000000', '20070000002', 'General News', '1');

DROP TABLE IF EXISTS cclang;
CREATE TABLE `cclang` (
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `Contry` varchar(50) NOT NULL COMMENT 'اسم البلد',
  `Langcc` varchar(10) NOT NULL COMMENT 'لغة البلد',
  `rank` bigint(11) NOT NULL,
  PRIMARY KEY (`cc`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='لغة البلدان على اساس كود البلد';

INSERT INTO `cclang` VALUES
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
('AM', 'Armenia (Հայաստան)', 'English', 1),
('AW', 'Aruba', 'English', 1),
('AP', 'Asia/Pacific Region', 'English', 1),
('AU', 'Australia', 'English', 1),
('AT', 'Austria (Österreich)', 'English', 1),
('AZ', 'Azerbaijan (Azərbaycan)', 'English', 1),
('BS', 'Bahamas', 'English', 1),
('BH', 'Bahrain (بحرين)', 'Arabic', 1),
('BD', 'Bangladesh (বাংলাদেশ)', 'English', 1),
('BB', 'Barbados', 'English', 1),
('BY', 'Belarus (Белару́сь)', 'English', 1),
('BE', 'Belgium (België)', 'English', 1),
('BZ', 'Belize', 'English', 1),
('BJ', 'Benin (Bénin)', 'English', 1),
('BM', 'Bermuda', 'English', 1),
('BT', 'Bhutan (འབྲུག་ཡུལ)', 'English', 1),
('BO', 'Bolivia', 'English', 1),
('BA', 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'English', 1),
('BW', 'Botswana', 'English', 1),
('BR', 'Brazil (Brasil)', 'English', 1),
('IO', 'British Indian Ocean Territory', 'English', 1),
('BN', 'Brunei (Brunei Darussalam)', 'English', 1),
('BG', 'Bulgaria (България)', 'English', 1),
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
('CN', 'China (中国)', 'English', 1),
('CO', 'Colombia', 'English', 1),
('KM', 'Comoros (Comores)', 'English', 1),
('CG', 'Congo', 'English', 1),
('CD', 'Congo, The Democratic Republic of the', 'English', 1),
('CK', 'Cook Islands', 'English', 1),
('CR', 'Costa Rica', 'English', 1),
('CI', 'Côte D\'Ivoire', 'English', 1),
('HR', 'Croatia (Hrvatska)', 'English', 1),
('CU', 'Cuba', 'English', 1),
('CY', 'Cyprus (Κυπρος)', 'English', 1),
('CZ', 'Czech Republic (Česko)', 'English', 1),
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
('GE', 'Georgia (საქართველო)', 'English', 1),
('DE', 'Germany (Deutschland)', 'English', 1),
('GH', 'Ghana', 'English', 1),
('GI', 'Gibraltar', 'English', 1),
('GR', 'Greece (&#39;Eλλας)', 'English', 1),
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
('HU', 'Hungary (Magyarország)', 'English', 1),
('IS', 'Iceland (Ísland)', 'English', 1),
('IN', 'India', 'English', 1),
('ID', 'Indonesia', 'English', 1),
('IR', 'Iran,  (الجمهورية الاسلامية في ايران)', 'Arabic', 1),
('IQ', 'Iraq (العراق)', 'Arabic', 1),
('IE', 'Ireland', 'English', 1),
('IL', 'Israel Enemy (ישראל)', 'English', 1),
('IT', 'Italy (Italia)', 'English', 1),
('JM', 'Jamaica', 'English', 1),
('JP', 'Japan', 'English', 1),
('JO', 'Jordan (الأردن)', 'Arabic', 1),
('KZ', 'Kazakhstan (Қазақстан)', 'English', 1),
('KE', 'Kenya', 'English', 1),
('KI', 'Kiribati', 'English', 1),
('EH', 'Western Sahara (صحراوية)', 'English', 1),
('KR', 'South Korea (한국)', 'English', 1),
('KW', 'Kuwait (الكويت)', 'Arabic', 1),
('KG', 'Kyrgyzstan (Кыргызстан)', 'English', 1),
('LA', 'Lao People\'s Democratic Republic (ນລາວ)', 'English', 1),
('LV', 'Latvia (Latvija)', 'English', 1),
('LB', 'Lebanon (لبنان)', 'Arabic', 1),
('LS', 'Lesotho', 'English', 1),
('LR', 'Liberia', 'English', 1),
('LY', 'Libyan Arab Jamahiriya (ليبيا)', 'Arabic', 1),
('LI', 'Liechtenstein', 'English', 1),
('LT', 'Lithuania (Lietuva)', 'English', 1),
('LU', 'Luxembourg (Lëtzebuerg)', 'English', 1),
('MO', 'Macau', 'English', 1),
('MK', 'Macedonia (Македонија)', 'English', 1),
('MG', 'Madagascar (Madagasikara)', 'English', 1),
('MW', 'Malawi', 'English', 1),
('MY', 'Malaysia', 'English', 1),
('MV', 'Maldives (ގުޖޭއްރާ ޔާއްރިހޫމްޖ)', 'English', 1),
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
('MN', 'Mongolia (Монгол Улс)', 'English', 1),
('ME', 'Montenegro (Црна Гора)', 'English', 1),
('MS', 'Montserrat', 'English', 1),
('MA', 'Morocco (المغرب)', 'Arabic', 1),
('MZ', 'Mozambique (Moçambique)', 'English', 1),
('MM', 'Myanmar (Լեռնային Ղարաբաղ)', 'English', 1),
('NA', 'Namibia', 'English', 1),
('NR', 'Nauru (Naoero)', 'English', 1),
('NP', 'Nepal (नेपाल)', 'English', 1),
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
('PA', 'Panama (Panamá)', 'English', 1),
('PG', 'Papua New Guinea', 'English', 1),
('PY', 'Paraguay', 'English', 1),
('PE', 'Peru (Perú)', 'English', 1),
('PH', 'Philippines (Pilipinas)', 'English', 1),
('PL', 'Poland (Polska)', 'English', 1),
('PT', 'Portugal', 'English', 1),
('PR', 'Puerto Rico', 'English', 1),
('QA', 'Qatar (قطر)', 'Arabic', 1),
('RE', 'Reunion', 'English', 1),
('RO', 'Romania (România)', 'English', 1),
('RU', 'Russia (Россия)', 'English', 1),
('RW', 'Rwanda', 'English', 1),
('KN', 'Saint Kitts and Nevis', 'English', 1),
('LC', 'Saint Lucia', 'English', 1),
('VC', 'Saint Vincent and the Grenadines', 'English', 1),
('WS', 'Samoa', 'English', 1),
('SM', 'San Marino', 'English', 1),
('ST', 'Sao Tome and Principe', 'English', 1),
('SA', 'Saudi Arabia (المملكة العربية السعودية)', 'Arabic', 1),
('SN', 'Senegal (Sénégal)', 'English', 1),
('RS', 'Serbia (Србија)', 'English', 1),
('SC', 'Seychelles', 'English', 1),
('SL', 'Sierra Leone', 'English', 1),
('SG', 'Singapore (Singapura)', 'English', 1),
('SK', 'Slovakia (Slovensko)', 'English', 1),
('SI', 'Slovenia (Slovenija)', 'English', 1),
('SB', 'Solomon Islands', 'English', 1),
('SO', 'Somalia (Soomaaliya)', 'English', 1),
('ZA', 'South Africa', 'English', 1),
('ES', 'Spain (España)', 'English', 1),
('LK', 'Sri Lanka', 'English', 1),
('SD', 'Sudan (السودان)', 'Arabic', 1),
('SR', 'Suriname', 'English', 1),
('SZ', 'Swaziland', 'English', 1),
('SE', 'Sweden (Sverige)', 'English', 1),
('CH', 'Switzerland (Schweiz)', 'English', 1),
('SY', 'Syria (سورية)', 'Arabic', 1),
('TW', 'Taiwan (台灣)', 'English', 1),
('TJ', 'Tajikistan (Тоҷикистон)', 'English', 1),
('TZ', 'Tanzania, United Republic of', 'English', 1),
('TH', 'Thailand (ราชอาณาจักรไทย)', 'English', 1),
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
('UA', 'Ukraine (Україна)', 'English', 1),
('AE', 'United Arab Emirates (الإمارات العربية المتحدة)', 'English', 1),
('GB', 'United Kingdom', 'English', 1),
('US', 'United States', 'English', 1),
('UM', 'United States Minor Outlying Islands', 'English', 1),
('UY', 'Uruguay', 'English', 1),
('UZ', 'Uzbekistan (O&#39;zbekiston)', 'English', 1),
('VU', 'Vanuatu', 'English', 1),
('VE', 'Venezuela', 'English', 1),
('VN', 'Vietnam (Việt Nam) ', 'English', 1),
('VG', 'Virgin Islands, British', 'English', 1),
('VI', 'Virgin Islands, U.S.', 'English', 1),
('YE', 'Yemen (اليمن)', 'Arabic', 1),
('ZM', 'Zambia', 'English', 1),
('ZW', 'Zimbabwe', 'English', 1),
('TL', 'East Timor (Timor-Leste)', 'English', 1),
('KP', 'North Korea (조선)', 'English', 1),
('XX', 'UnKnow', 'English', 680);

DROP TABLE IF EXISTS contactus;
CREATE TABLE `contactus` (
  `IdDep` varchar(11) NOT NULL,
  `DepEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`IdDep`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS contactuslang;
CREATE TABLE `contactuslang` (
  `IdDep` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `DepName` varchar(128) NOT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

DROP TABLE IF EXISTS errlog;
CREATE TABLE `errlog` (
  `IdErr` double NOT NULL AUTO_INCREMENT COMMENT 'رقم الجدول',
  `errno` double NOT NULL COMMENT 'رقم الخطأ',
  `errmsg` longtext NOT NULL COMMENT 'رسالة الخطأ',
  `filename` longtext NOT NULL COMMENT 'اسم الملف',
  `linenum` double NOT NULL COMMENT 'رقم السطر',
  `DateErr` datetime NOT NULL,
  PRIMARY KEY (`IdErr`)
) ENGINE=MyISAM AUTO_INCREMENT=301 /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='جدول اخطاء البرنامج';

INSERT INTO `errlog` VALUES
('1', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/includes/Login.php', '213', '2011-03-12 08:59:32'),
('2', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:33'),
('3', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:33'),
('4', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/index.php', '107', '2011-03-12 08:59:34'),
('5', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/includes/Login.php', '213', '2011-03-12 08:59:34'),
('6', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:34'),
('7', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:34'),
('8', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/index.php', '107', '2011-03-12 08:59:36'),
('9', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/includes/Login.php', '213', '2011-03-12 08:59:36'),
('10', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:36'),
('11', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 08:59:36'),
('12', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/includes/Login.php', '213', '2011-03-12 09:02:19'),
('13', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 09:02:20'),
('14', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 09:02:20'),
('15', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/index.php', '107', '2011-03-12 09:02:21'),
('16', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'D:/xampp/htdocs/phptransformer/includes/Login.php', '213', '2011-03-12 09:02:21'),
('17', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 09:02:21'),
('18', '2', 'Warning : Cannot modify header information - headers already sent by (output started at D:/xampp/htdocs/phptransformer/index.php:17)', 'Unknown', '0', '2011-03-12 09:02:21'),
('19', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '135', '2011-03-12 09:40:12'),
('20', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '156', '2011-03-12 09:54:24'),
('21', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 09:55:15'),
('22', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 09:55:15'),
('23', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '56', '2011-03-12 09:55:15'),
('24', '8', 'Notice : Undefined variable: IdLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('25', '8', 'Notice : Undefined variable: FullNameLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('26', '8', 'Notice : Undefined variable: EmailLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('27', '8', 'Notice : Undefined variable: PhoneNbrLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('28', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('29', '8', 'Notice : Undefined variable: TownLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('30', '8', 'Notice : Undefined variable: AddressDetailsLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('31', '8', 'Notice : Undefined variable: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('32', '8', 'Notice : Undefined variable: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('33', '8', 'Notice : Undefined variable: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('34', '8', 'Notice : Undefined variable: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 09:55:15'),
('35', '8', 'Notice : Undefined variable: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 09:55:15'),
('36', '8', 'Notice : Undefined variable: IdLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 09:55:15'),
('37', '8', 'Notice : Undefined variable: FullNameLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 09:55:15'),
('38', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 09:59:04'),
('39', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 09:59:04'),
('40', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '56', '2011-03-12 09:59:04'),
('41', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '133', '2011-03-12 09:59:10'),
('42', '8', 'Notice : Undefined variable: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '123', '2011-03-12 10:05:03'),
('43', '8', 'Notice : Undefined variable: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '125', '2011-03-12 10:05:03'),
('44', '8', 'Notice : Undefined variable: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '127', '2011-03-12 10:05:03'),
('45', '8', 'Notice : Undefined variable: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '129', '2011-03-12 10:05:03'),
('46', '8', 'Notice : Undefined variable: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '131', '2011-03-12 10:05:03'),
('47', '8', 'Notice : Undefined variable: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '134', '2011-03-12 10:05:03'),
('48', '8', 'Notice : Undefined variable: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '137', '2011-03-12 10:05:03'),
('49', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:05:03'),
('50', '8', 'Notice : Undefined variable: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '141', '2011-03-12 10:05:03'),
('51', '8', 'Notice : Undefined variable: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '144', '2011-03-12 10:05:03'),
('52', '8', 'Notice : Undefined variable: HaveDomainValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '147', '2011-03-12 10:05:03'),
('53', '8', 'Notice : Undefined variable: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '148', '2011-03-12 10:05:03'),
('54', '8', 'Notice : Undefined variable: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '149', '2011-03-12 10:05:03'),
('55', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '140', '2011-03-12 10:06:17'),
('56', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:08:36'),
('57', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:08:36'),
('58', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '92', '2011-03-12 10:08:36'),
('59', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '140', '2011-03-12 10:08:37'),
('60', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:10:47'),
('61', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:12:01'),
('62', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:13:39'),
('63', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:13:39'),
('64', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:13:39'),
('65', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:13:40'),
('66', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:14:05'),
('67', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:14:05'),
('68', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:14:05'),
('69', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:14:05'),
('70', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '44', '2011-03-12 10:15:02'),
('71', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '45', '2011-03-12 10:15:02'),
('72', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '46', '2011-03-12 10:15:02'),
('73', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '47', '2011-03-12 10:15:02'),
('74', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '48', '2011-03-12 10:15:02'),
('75', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:15:02'),
('76', '8', 'Notice : Undefined index: HaveDomainValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:15:02'),
('77', '8', 'Notice : Undefined index: HaveDomainValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '53', '2011-03-12 10:15:02'),
('78', '8', 'Notice : Undefined index: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '54', '2011-03-12 10:15:02'),
('79', '8', 'Notice : Undefined index: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '55', '2011-03-12 10:15:02'),
('80', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:15:02'),
('81', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '44', '2011-03-12 10:15:58'),
('82', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '45', '2011-03-12 10:15:58'),
('83', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '46', '2011-03-12 10:15:58'),
('84', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '47', '2011-03-12 10:15:58'),
('85', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '48', '2011-03-12 10:15:58'),
('86', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:15:58'),
('87', '8', 'Notice : Undefined index: HaveDomainValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:15:58'),
('88', '8', 'Notice : Undefined index: HaveDomainValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '53', '2011-03-12 10:15:58'),
('89', '8', 'Notice : Undefined index: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '54', '2011-03-12 10:15:58'),
('90', '8', 'Notice : Undefined index: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '55', '2011-03-12 10:15:58'),
('91', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:15:58'),
('92', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:15:58'),
('93', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:15:58'),
('94', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '138', '2011-03-12 10:15:59'),
('95', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '44', '2011-03-12 10:19:15'),
('96', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '45', '2011-03-12 10:19:15'),
('97', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '47', '2011-03-12 10:19:15'),
('98', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '48', '2011-03-12 10:19:15'),
('99', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:19:15'),
('100', '8', 'Notice : Undefined index: HaveDomainValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '54', '2011-03-12 10:19:15'),
('101', '8', 'Notice : Undefined index: HaveDomainValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '55', '2011-03-12 10:19:15'),
('102', '8', 'Notice : Undefined index: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '57', '2011-03-12 10:19:15'),
('103', '8', 'Notice : Undefined index: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '58', '2011-03-12 10:19:15'),
('104', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:19:15'),
('105', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:19:15'),
('106', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '93', '2011-03-12 10:19:15'),
('107', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '141', '2011-03-12 10:19:15'),
('108', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:20:22'),
('109', '8', 'Notice : Undefined index: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '61', '2011-03-12 10:20:22'),
('110', '8', 'Notice : Undefined index: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:20:22'),
('111', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:20:22'),
('112', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:20:22'),
('113', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:20:22'),
('114', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '145', '2011-03-12 10:20:22'),
('115', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:21:25'),
('116', '8', 'Notice : Undefined index: AlreadyProgValueNo', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '61', '2011-03-12 10:21:25'),
('117', '8', 'Notice : Undefined index: AlreadyProgValueYes', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:21:25'),
('118', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:21:25'),
('119', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:21:25'),
('120', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:21:25'),
('121', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '145', '2011-03-12 10:21:26'),
('122', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:23:02'),
('123', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '61', '2011-03-12 10:23:02'),
('124', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:23:02'),
('125', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:23:02'),
('126', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '104', '2011-03-12 10:23:02'),
('127', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '152', '2011-03-12 10:23:03'),
('128', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:23:40'),
('129', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '61', '2011-03-12 10:23:40'),
('130', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:23:40'),
('131', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:23:40'),
('132', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '104', '2011-03-12 10:23:40'),
('133', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '152', '2011-03-12 10:23:41'),
('134', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:25:08'),
('135', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '61', '2011-03-12 10:25:08'),
('136', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:25:08'),
('137', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '97', '2011-03-12 10:25:08'),
('138', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '104', '2011-03-12 10:25:08'),
('139', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '152', '2011-03-12 10:25:08'),
('140', '8', 'Notice : Undefined index: AlreadyProgNameValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '50', '2011-03-12 10:26:57'),
('141', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:26:57'),
('142', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:26:57'),
('143', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:26:57'),
('144', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '105', '2011-03-12 10:26:57'),
('145', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '153', '2011-03-12 10:26:57'),
('146', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:28:48'),
('147', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:28:48'),
('148', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:28:48'),
('149', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '105', '2011-03-12 10:28:48'),
('150', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '153', '2011-03-12 10:28:49'),
('151', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:29:04'),
('152', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:29:04'),
('153', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:29:04'),
('154', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '105', '2011-03-12 10:29:04'),
('155', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '153', '2011-03-12 10:29:04'),
('156', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:30:33'),
('157', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:30:33'),
('158', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '98', '2011-03-12 10:30:33'),
('159', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '105', '2011-03-12 10:30:33'),
('160', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '153', '2011-03-12 10:30:34'),
('161', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:35:29'),
('162', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:35:29'),
('163', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:35:29'),
('164', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '121', '2011-03-12 10:35:29'),
('165', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '169', '2011-03-12 10:35:30'),
('166', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:36:31'),
('167', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:36:31'),
('168', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:36:31'),
('169', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '121', '2011-03-12 10:36:31'),
('170', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '169', '2011-03-12 10:36:32'),
('171', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:37:26'),
('172', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:37:26'),
('173', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:37:26'),
('174', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '121', '2011-03-12 10:37:26'),
('175', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '169', '2011-03-12 10:37:27'),
('176', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:38:46'),
('177', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:38:46'),
('178', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:38:46'),
('179', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '124', '2011-03-12 10:38:46'),
('180', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '172', '2011-03-12 10:38:46'),
('181', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:38:54'),
('182', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:38:54'),
('183', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:38:54'),
('184', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '124', '2011-03-12 10:38:54'),
('185', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '172', '2011-03-12 10:38:55'),
('186', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '172', '2011-03-12 10:39:14'),
('187', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:40:00'),
('188', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '114', '2011-03-12 10:40:00'),
('189', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '124', '2011-03-12 10:40:00'),
('190', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '172', '2011-03-12 10:40:01'),
('191', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:40:11'),
('192', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '172', '2011-03-12 10:40:11'),
('193', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '107', '2011-03-12 10:41:07'),
('194', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '171', '2011-03-12 10:41:07'),
('195', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 10:41:42'),
('196', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:41:42'),
('197', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:41:42'),
('198', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:41:42'),
('199', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '107', '2011-03-12 10:41:43'),
('200', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '171', '2011-03-12 10:41:43'),
('201', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '49', '2011-03-12 10:42:04'),
('202', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:42:04'),
('203', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:42:04'),
('204', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:42:04'),
('205', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '107', '2011-03-12 10:42:05'),
('206', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:42:05'),
('207', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '120', '2011-03-12 10:42:05'),
('208', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '124', '2011-03-12 10:42:05'),
('209', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '171', '2011-03-12 10:42:05'),
('210', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '171', '2011-03-12 10:42:17'),
('211', '8', 'Notice : Undefined variable: name', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:43:04'),
('212', '8', 'Notice : Undefined variable: value', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '52', '2011-03-12 10:43:04'),
('213', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '62', '2011-03-12 10:43:04'),
('214', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '171', '2011-03-12 10:43:05'),
('215', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '106', '2011-03-12 10:45:32'),
('216', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '170', '2011-03-12 10:45:32'),
('217', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '60', '2011-03-12 10:46:32'),
('218', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '102', '2011-03-12 10:46:32'),
('219', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '166', '2011-03-12 10:46:32'),
('220', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '166', '2011-03-12 10:46:45'),
('221', '8', 'Notice : Undefined variable: LicenseCountry', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '56', '2011-03-12 10:48:34'),
('222', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '162', '2011-03-12 10:48:35'),
('223', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '162', '2011-03-12 10:49:51'),
('224', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:50:38'),
('225', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:50:38'),
('226', '8', 'Notice : Undefined index: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '80', '2011-03-12 10:50:54'),
('227', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '81', '2011-03-12 10:50:54'),
('228', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 10:50:54'),
('229', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:50:54'),
('230', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '84', '2011-03-12 10:50:54'),
('231', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:50:54'),
('232', '8', 'Notice : Undefined index: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:50:54'),
('233', '8', 'Notice : Undefined index: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 10:50:54'),
('234', '8', 'Notice : Undefined index: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '88', '2011-03-12 10:50:54'),
('235', '8', 'Notice : Undefined index: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:50:54'),
('236', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:50:54'),
('237', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '108', '2011-03-12 10:50:54'),
('238', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '112', '2011-03-12 10:50:54'),
('239', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:50:54'),
('240', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:50:55'),
('241', '8', 'Notice : Undefined index: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '80', '2011-03-12 10:52:01'),
('242', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '81', '2011-03-12 10:52:01'),
('243', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 10:52:01'),
('244', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:52:01'),
('245', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '84', '2011-03-12 10:52:01'),
('246', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:52:01'),
('247', '8', 'Notice : Undefined index: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:52:01'),
('248', '8', 'Notice : Undefined index: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 10:52:01'),
('249', '8', 'Notice : Undefined index: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '88', '2011-03-12 10:52:01'),
('250', '8', 'Notice : Undefined index: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:52:01'),
('251', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:52:01'),
('252', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '108', '2011-03-12 10:52:01'),
('253', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '112', '2011-03-12 10:52:01'),
('254', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:52:01'),
('255', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:52:01'),
('256', '8', 'Notice : Undefined index: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '80', '2011-03-12 10:53:15'),
('257', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '81', '2011-03-12 10:53:15'),
('258', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 10:53:15'),
('259', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:53:15'),
('260', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '84', '2011-03-12 10:53:15'),
('261', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:53:15'),
('262', '8', 'Notice : Undefined index: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:53:15'),
('263', '8', 'Notice : Undefined index: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 10:53:15'),
('264', '8', 'Notice : Undefined index: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '88', '2011-03-12 10:53:15'),
('265', '8', 'Notice : Undefined index: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:53:15'),
('266', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:53:15'),
('267', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '108', '2011-03-12 10:53:15'),
('268', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '112', '2011-03-12 10:53:15'),
('269', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:53:15'),
('270', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:53:15'),
('271', '8', 'Notice : Undefined index: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '80', '2011-03-12 10:53:50'),
('272', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '81', '2011-03-12 10:53:50'),
('273', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 10:53:50'),
('274', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:53:50'),
('275', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '84', '2011-03-12 10:53:50'),
('276', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:53:50'),
('277', '8', 'Notice : Undefined index: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:53:50'),
('278', '8', 'Notice : Undefined index: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 10:53:50'),
('279', '8', 'Notice : Undefined index: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '88', '2011-03-12 10:53:50'),
('280', '8', 'Notice : Undefined index: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:53:50'),
('281', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:53:50'),
('282', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '108', '2011-03-12 10:53:50'),
('283', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '112', '2011-03-12 10:53:50'),
('284', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:53:50'),
('285', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:53:50'),
('286', '8', 'Notice : Undefined index: LicenseFullName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '80', '2011-03-12 10:54:43'),
('287', '8', 'Notice : Undefined index: LicensePhoneNbr', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '81', '2011-03-12 10:54:43'),
('288', '8', 'Notice : Undefined index: LicenseTown', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '82', '2011-03-12 10:54:43'),
('289', '8', 'Notice : Undefined index: LicenseComment', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '83', '2011-03-12 10:54:43'),
('290', '8', 'Notice : Undefined index: LicenseEmail', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '84', '2011-03-12 10:54:43'),
('291', '8', 'Notice : Undefined index: LicenseAddressDetails', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '85', '2011-03-12 10:54:43'),
('292', '8', 'Notice : Undefined index: DidUHavedomainName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '86', '2011-03-12 10:54:43'),
('293', '8', 'Notice : Undefined index: AlreadyProgName', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '87', '2011-03-12 10:54:43'),
('294', '8', 'Notice : Undefined index: HostingRequest', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '88', '2011-03-12 10:54:43'),
('295', '8', 'Notice : Undefined index: HaveDomain', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '90', '2011-03-12 10:54:43'),
('296', '8', 'Notice : Undefined index: AlreadyProgValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '99', '2011-03-12 10:54:43'),
('297', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '108', '2011-03-12 10:54:43'),
('298', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '112', '2011-03-12 10:54:43'),
('299', '8', 'Notice : Undefined index: TypeLicense', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '116', '2011-03-12 10:54:43'),
('300', '8', 'Notice : Undefined variable: HaveDomainValue', 'D:/xampp/htdocs/phptransformer/Programs/getlicense/index.php', '163', '2011-03-12 10:54:43');

DROP TABLE IF EXISTS errpages;
CREATE TABLE `errpages` (
  `ErrNumber` varchar(4) NOT NULL COMMENT 'رقم صفحة الخطأ',
  `ErrPage` longtext NOT NULL COMMENT 'صفحة الخطأ',
  PRIMARY KEY (`ErrNumber`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='أخطاء المستخدم في طلب الموقع';

INSERT INTO `errpages` VALUES
('400', '<div align=\"center\">						  						  <font size=\"7\">400&nbsp;</font> 						   						   						  </div>'),
('401', '<div align=\"center\">						  						  <font size=\"7\">401</font> 						   						  </div>'),
('403', '<div align=\"center\">						  <font size=\"7\">403</font> 						  </div>'),
('404', '						  						  						  <div align=\"center\">						  						  <font size=\"7\">404</font> <br /></div> 						   						  '),
('500', '<div align=\"center\">						  						  <font size=\"7\">500</font> 						   						  </div>');

DROP TABLE IF EXISTS externallinks;
CREATE TABLE `externallinks` (
  `Id` varchar(11) NOT NULL COMMENT 'رقم اللنك',
  `Link` text NOT NULL COMMENT 'عنوان اللنك',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الروابط الخارجية';

INSERT INTO `externallinks` VALUES
('20100000000', 'http://centos.org/\\');

DROP TABLE IF EXISTS floodprotection;
CREATE TABLE `floodprotection` (
  `IP` varchar(32) NOT NULL COMMENT 'رقم ايبي المسجل للفلود',
  `TIME` varchar(22) /*!40101 CHARACTER SET latin1 */ /*!40101 COLLATE latin1_general_ci */ NOT NULL COMMENT 'الوقت للفلود'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='من اجل الحماية من اللب الزائد على';

INSERT INTO `floodprotection` VALUES
(' fe80::a998:ae3:15d7:3f0', '1301997370.9466');

DROP TABLE IF EXISTS fomacodataorder;
CREATE TABLE `fomacodataorder` (
  `IdData` varchar(11) DEFAULT NULL,
  `IdOrder` varchar(11) DEFAULT NULL,
  `lineNumber` varchar(3) DEFAULT NULL,
  `ItemType` varchar(11) DEFAULT NULL,
  `Description` varchar(128) DEFAULT NULL,
  `Height` varchar(3) DEFAULT NULL,
  `Width` varchar(3) DEFAULT NULL,
  `Lenght` varchar(3) DEFAULT NULL,
  `Quantity` varchar(6) DEFAULT NULL,
  `Cubic` varchar(15) DEFAULT NULL,
  `DataGridNote` varchar(15) NOT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `fomacodataorder` VALUES
('20080000000', '20080000000', '1', '**EX', 'لوح إسفنج', '2', '120', '200', '2', '4.8', '1'),
('20080000001', '20080000000', '2', '*EXS', 'لوح إسفنج', '3', '60', '60', '3', '6.42', '2'),
('20080000002', '20080000000', '3', 'SL42', 'فراش إسفنج', '12', '120', '200', '5', '78.42', '3'),
('20080000003', '20080000000', '4', 'X01*', 'فراش إسفنج', '50', '50', '50', '6', '115.92', '4'),
('20080000004', '20080000000', '5', 'BBS*', 'فراش إسفنج', '40', '40', '120', '55', '643.92', '5'),
('20080000005', '20080000000', '6', 'X01*', 'فراش إسفنج', '56', '55', '56', '22', '833.648', '6'),
('20080000006', '20080000000', '7', '*EXS', 'لوح إسفنج', '2', '22', '22', '2', '833.745', '7'),
('20080000007', '20080000000', '8', 'BB25', 'لوح إسفنج', '3', '3', '3', '3', '833.749', '3'),
('20080000008', '20080000000', '9', '**EX', 'لوح إسفنج', '3', '3', '3', '3', '833.753', '3'),
('20080000009', '20080000000', '10', '*EXS', 'لوح إسفنج', '3', '3', '3', '3', '833.757', '3'),
('20080000010', '20080000000', '11', '**EX', 'فراش إسفنج', '33', '33', '33', '25', '878.678', '3'),
('20080000011', '20080000000', '12', 'SL42', 'لوح إسفنج', '3', '3', '3', '33', '878.723', '3'),
('20080000012', '20080000003', '1', '**EX', 'لوح إسفنج', '2', '20', '120', '2', '0.48', '');

DROP TABLE IF EXISTS fomacodesc;
CREATE TABLE `fomacodesc` (
  `Descid` varchar(11) DEFAULT NULL,
  `TheDesc` varchar(128) DEFAULT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `fomacodesc` VALUES
('20080000001', 'لوح إسفنج'),
('20080000002', 'مقعد صوفة'),
('20080000003', 'مسند كونيك'),
('20080000004', 'فراش إسفنج'),
('20080000005', 'وسادة إسفنج'),
('20080000006', 'طراحة إسفنج'),
('20080000007', 'تكاية لإسفنج'),
('20080000008', 'بلوك إسفنج'),
('20080000009', 'ستوك إسفنج'),
('20080000010', 'جلود لإسفنج'),
('20080000011', 'نثر إسفنج'),
('20080000012', 'طراحة زاوية'),
('20080000013', 'مسند زاوية'),
('20080000014', 'مسند صوفة'),
('20080000015', 'وسادة إسطوانية 15 سنتم'),
('20080000016', 'وسادة إسطوانية 20 سنتم');

DROP TABLE IF EXISTS fomacoheaderorder;
CREATE TABLE `fomacoheaderorder` (
  `IdOrder` varchar(11) DEFAULT NULL,
  `Ordernumber` varchar(11) DEFAULT NULL,
  `ClientName` varchar(15) DEFAULT NULL,
  `DeliveryTo` varchar(35) DEFAULT NULL,
  `ChipAddress` varchar(35) DEFAULT NULL,
  `Organizer` varchar(15) DEFAULT NULL,
  `HeaderNotes` varchar(1024) DEFAULT NULL,
  `CurrentDate` datetime DEFAULT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `IsPosted` varchar(1) DEFAULT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `fomacoheaderorder` VALUES
('20080000000', '', 'fomaco', 'هيثم بزي', 'المعمورة', 'محسن الموسوي', 'نرجو تسليم الطلبية حسب الوقت المحدد', '2008-02-09 03:12:48', '2008-02-10 03:01:26', '1'),
('20080000001', '', 'fomaco', 'هيثم بزي', 'شسيش', 'شسيشسي', 'سيشسي', '2008-02-09 04:11:09', '2008-02-09 04:02:28', '1'),
('20080000002', '', 'fomaco', 'عبدو', 'الشياح', 'لؤي', 'حلو عنا', '2008-02-09 04:55:49', '2008-02-10 04:51:53', '1'),
('20080000003', '', 'admin', 'sdfdf', 'sdf', 'sdfdsf', 'sdf', '2008-11-27 10:34:09', '2008-11-28 00:00:00', '0');

DROP TABLE IF EXISTS fomacoitems;
CREATE TABLE `fomacoitems` (
  `ItmeId` varchar(11) DEFAULT NULL,
  `ItemCode` varchar(35) DEFAULT NULL,
  `ItmeText` varchar(128) DEFAULT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `fomacoitems` VALUES
('20080000001', '**EX', 'EX إسفنج أسمر ضغط 36'),
('20080000002', '*EXS', 'EXS إسفنج أسمر طري ضغط 36'),
('20080000003', 'SL42', 'SL إسفنج أسمر ضغط 42'),
('20080000004', 'X01*', 'X إسفنج أبيض ضغط 16'),
('20080000005', 'BBS*', 'BBS إسفنج أسمر ضغط 25'),
('20080000006', 'X03*', 'X إسفنج أبيض ضغط 16 طول 200'),
('20080000007', 'X04*', 'X إسفنج أسمر ضغط 16 طول 200'),
('20080000008', 'AS**', 'AS إسفنج أسمر ضغط 32'),
('20080000009', 'X02*', 'X إسفنج أسمر ضغط 16'),
('20080000010', 'C18*', 'C إسفنج أسمر ضغط 18'),
('20080000011', 'C20*', 'C إسفنج أسمر ضغط 20'),
('20080000012', 'C22*', 'C إسفنج أسمر ضغط 22'),
('20080000013', 'BB25', 'BB إسفنج أسمر ضغط 25'),
('20080000014', 'SF**', 'SF إسفنج زهر ضغط 26'),
('20080000015', 'B28*', 'B إسفنج أسمر ضغط 28'),
('20080000016', 'BS**', 'BS إسفنج أسمر طري ضغط 28');

DROP TABLE IF EXISTS fomaconakdi;
CREATE TABLE `fomaconakdi` (
  `IDNakdi` varchar(11) NOT NULL COMMENT 'الرقم',
  `IDFacture` varchar(11) NOT NULL,
  `Date` datetime NOT NULL COMMENT 'تاريخ الادخال',
  `FactureDate` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `Zaboun` varchar(60) NOT NULL COMMENT 'اسم الزبون',
  `NakdiName` varchar(60) NOT NULL COMMENT 'اسمه الوهمي',
  `Mandoub` varchar(60) NOT NULL COMMENT 'مندوبه',
  `Debit` double NOT NULL COMMENT 'مدين',
  `Credit` double NOT NULL COMMENT 'دائن',
  `Mashrou3` varchar(60) NOT NULL COMMENT 'المشروع',
  `HasPayed` tinyint(1) NOT NULL COMMENT 'تم قبضها',
  `HasMailed` tinyint(1) NOT NULL COMMENT 'تم ارسالها بالبريد',
  `Note` text NOT NULL COMMENT 'ملاحظات',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم الذي ادخل المعلومة',
  PRIMARY KEY (`IDNakdi`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `fomaconakdi` VALUES
('20110000000', '614292', '2011-02-17 15:55:03', '2011-02-11', 'المحل', 'عباس حمود', 'م. طلال', '347', '347', 'Sponge', 1, 1, '', '20110000001'),
('20110000001', '614301', '2011-02-17 15:54:01', '2011-02-12', 'توفيق بو زيد', 'علي عباس', 'م. طلال', '856', '856', 'Sponge', 1, 1, '', '20110000001'),
('20110000002', '614302', '2011-02-17 15:52:55', '2011-02-12', 'المحل', 'حاتم عباس', 'م. طلال', '459', '459', 'Sponge', 1, 1, '', '20110000001'),
('20110000003', '614303', '2011-02-17 15:51:09', '2011-02-12', 'المحل', 'فارس اسكندر', 'م. طلال', '688', '688', 'Sponge', 1, 1, '', '20110000001'),
('20110000004', '614305', '2011-02-17 15:52:45', '2011-02-12', 'أكرم عساف', 'نادر حمود', 'م. طلال', '2600', '2600', 'Sponge', 1, 1, '', '20110000001'),
('20110000010', '614332', '2011-02-18 14:51:59', '2011-02-16', 'المحل', 'كايد مشيك', 'م. طلال', '942', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000011', '614335', '2011-02-18 14:51:52', '2011-02-16', 'المحل', 'هادي جمعة', 'م. طلال', '623', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000013', '614338', '2011-02-18 14:51:34', '2011-02-16', 'المحل', 'جميل أسعد', 'م. طلال', '850', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000014', '614339', '2011-02-18 14:51:28', '2011-02-16', 'المحل', 'جمال طراف', 'م. طلال', '799', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000015', '614340', '2011-02-17 16:05:24', '2011-02-16', 'المحل', 'حسين السبعيني', 'م. طلال', '814', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000016', '614356', '2011-02-18 14:51:22', '2011-02-17', 'هيثم بزي', 'أمين دياب', 'م. طلال', '781', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000017', '614357', '2011-02-18 14:51:17', '2011-02-17', 'هيثم بزي', 'حيدر أبو حيدر', 'م. طلال', '808', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000018', '614358', '2011-02-18 14:51:09', '2011-02-17', 'هيثم بزي', 'ابراهيم السبلاني   ', 'م. طلال', '855', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000019', '614359', '2011-02-18 14:51:01', '2011-02-17', 'هيثم بزي', 'رامز ابراهيم', 'م. طلال', '810', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000020', '614360', '2011-02-18 14:50:51', '2011-02-17', 'هيثم بزي', 'بشار برجاوي', 'م. طلال', '812', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000021', '614361', '2011-02-18 14:46:22', '2011-02-17', 'هيثم بزي', 'أشرف الموسوي', 'م. طلال', '592', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000022', '614362', '2011-02-18 14:46:13', '2011-02-17', 'هيثم بزي', 'دريد سعد الدين', 'م. طلال', '606', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000023', '614364', '2011-02-18 14:46:05', '2011-02-17', 'المحل', 'عباس خليل', 'م. طلال', '113', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000024', '614245', '2011-02-17 15:52:05', '2011-02-07', 'شركة سنتر أبو جخ', 'اميل خوري', 'م. عامر بو جخ', '3100', '3100', 'Sponge', 1, 1, '', '20110000001'),
('20110000025', '614270', '2011-02-17 15:52:38', '2011-02-09', 'سعدو برو', 'سعدو برو', 'م. صالة المبيعات', '675', '675', 'Sponge', 1, 1, '', '20110000001'),
('20110000026', '614288', '2011-02-17 16:03:28', '2011-02-11', 'حكمت الجمعة', 'خالد السواق', 'م. حكمت', '393', '393', 'Sponge', 1, 1, '', '20110000001'),
('20110000027', '614325', '2011-02-17 15:53:38', '2011-02-14', 'أبو عبدو', 'حكمت عثمان', 'م. أبو عبدو', '46', '46', 'Sponge', 1, 1, '', '20110000001'),
('20110000028', '614347', '2011-02-17 15:49:11', '2011-02-16', 'حكمت الجمعة', 'وائل شرف الدين', 'م. حكمت', '253', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000029', '614290', '2011-02-18 10:50:29', '2011-02-11', 'المحل', 'غندور', 'م. طلال', '309', '309', 'Mattress', 1, 1, '', '20110000005'),
('20110000030', '614317', '2011-02-18 10:49:46', '2011-02-14', 'المحل', 'رشيد مزهر', 'م. طلال', '142', '142', 'Mattress', 1, 1, '', '20110000005'),
('20110000031', '614318', '2011-02-18 10:49:13', '2011-02-14', 'المحل', 'وجيه طرابلسي', 'م. طلال', '277', '277', 'Mattress', 1, 1, '', '20110000005'),
('20110000032', '614329', '2011-02-18 07:49:46', '2011-02-16', 'المحل', 'سامي عواضة', 'م. طلال', '837', '837', 'Mattress', 1, 1, '', '20110000005'),
('20110000033', '614330', '2011-02-18 10:48:41', '2011-02-16', 'المحل', 'غسان جعفر', 'م. طلال', '812', '812', 'Mattress', 1, 1, '', '20110000005'),
('20110000034', '614334', '2011-02-18 10:47:18', '2011-02-16', 'المحل', 'سهيل العريبي', 'م. طلال', '597', '597', 'Mattress', 1, 1, '', '20110000005'),
('20110000035', '614353', '2011-02-18 10:53:16', '2011-02-17', 'المحل', 'نسيم حمية', 'م. طلال', '309', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000036', '614354', '2011-02-18 10:52:36', '2011-02-17', 'المحل', 'خالد الضيقة', 'م. طلال', '193', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000037', '614376', '2011-02-17 16:14:17', '2011-02-18', 'المحل', 'أمين الحلاني', 'م. طلال', '657', '0', 'Sponge', 0, 0, '', '20110000001'),
('20110000038', '614377', '2011-02-17 16:15:01', '2011-02-18', 'المحل', 'انطوان أبو عرابي', 'م. طلال', '861', '0', 'Sponge', 0, 0, '', '20110000001'),
('20110000039', '614378', '2011-02-17 16:15:35', '2011-02-18', 'المحل', 'حنا الحلبي', 'م. طلال', '651', '0', 'Sponge', 0, 0, '', '20110000001'),
('20110000040', '614355', '2011-02-18 10:51:35', '2011-02-17', 'المحل', 'خليل القاق', 'م. طلال', '25', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000041', '614333', '2011-02-18 10:48:12', '2011-02-16', 'المحل', 'غالب الموسوي', 'م. طلال', '564', '564', 'Mattress', 1, 1, '', '20110000005'),
('20110000042', '614365', '2011-02-18 10:50:58', '2011-02-17', 'المحل', 'عادل ايوب', 'م. طلال', '59', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000043', '614373', '2011-02-18 10:46:30', '2011-02-18', 'المحل', 'نضال حوماني', 'م. طلال', '1067', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000044', '614374', '2011-02-18 10:45:27', '2011-02-18', 'المحل', 'نزار ناصرالدين', 'م. طلال', '978', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000045', '614375', '2011-02-18 10:44:39', '2011-02-18', 'المحل', 'لويس نهرا', 'م. طلال', '529', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000046', '614379', '2011-02-18 10:42:56', '2011-02-18', 'المحل', 'علي حمية', 'م. طلال', '337', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000047', '614381', '2011-02-18 10:41:40', '2011-02-18', 'سعد ابوعرابي', 'طوني ملكي', 'م. سعد', '355', '0', 'Mattress', 0, 1, '', '20110000005'),
('20110000048', '614287', '2011-02-18 10:49:53', '2011-02-11', 'سلمان ديراني', '', 'م. صالة المبيعات', '742', '742', 'Mattress', 1, 1, '', '20110000005'),
('20110000049', '614296', '2011-02-18 10:32:42', '2011-02-11', 'علي سماحة', '', 'م. صالة المبيعات', '160', '160', 'Mattress', 1, 1, '', '20110000005'),
('20110000050', '614300', '2011-02-18 10:33:15', '2011-02-11', 'حسن حبيب', '', 'م. صالة المبيعات', '180', '180', 'Mattress', 1, 1, '', '20110000005'),
('20110000051', '614310', '2011-02-18 10:49:28', '2011-02-12', 'شادي الزين', '', 'م. صالة المبيعات', '225', '225', 'Mattress', 1, 1, '', '20110000005'),
('20110000056', '614337', '2011-02-18 10:48:43', '2011-02-16', 'محمد مشيك', '', 'م. صالة المبيعات', '350', '350', 'Mattress', 1, 1, '', '20110000005'),
('20110000057', '614345', '2011-02-18 10:48:09', '2011-02-16', 'ناصيف مينا', '', 'م. صالة المبيعات', '150', '150', 'Mattress', 1, 1, '', '20110000005'),
('20110000058', '614348', '2011-02-18 10:47:40', '2011-02-16', 'نبيل رعد', '', 'م. صالة المبيعات', '130', '130', 'Mattress', 1, 1, '', '20110000005'),
('20110000059', '614349', '2011-02-18 10:46:37', '2011-02-16', 'كرم شكر', '', 'م. صالة المبيعات', '120', '120', 'Mattress', 1, 1, '', '20110000005'),
('20110000060', '614350', '2011-02-18 10:46:08', '2011-02-16', 'فوزي سيف الدين', '', 'م. صالة المبيعات', '275', '275', 'Mattress', 1, 1, '', '20110000005'),
('20110000061', '614366', '2011-02-18 10:45:33', '2011-02-17', 'وسام يحي', '', 'م. صالة المبيعات', '185', '185', 'Mattress', 1, 1, '', '20110000005'),
('20110000062', '614367', '2011-02-18 10:45:00', '2011-02-17', 'يوسف السيد احمد', '', 'م. صالة المبيعات', '125', '125', 'Mattress', 1, 1, '', '20110000005'),
('20110000063', '614380', '2011-02-18 09:30:29', '2011-02-18', 'سعد ابوعرابي', 'غابي سعد', 'م. سعد', '144', '0', 'Sponge', 0, 1, '', '20110000001'),
('20110000065', '614387', '2011-02-18 14:39:40', '2011-02-19', 'حسن غصين', 'صابر الزيات', 'م. طلال', '403', '0', 'Sponge', 0, 0, '', '20110000001'),
('20110000066', '9999999999', '2011-03-11 13:31:04', '2011-03-11', 'فوزي سيف الدين', 'رسي بيسب', 'م. عامر بو جخ', '234324', '0', 'Mattress', 0, 0, 'يبي بيبس', '200700000-1');

DROP TABLE IF EXISTS gallery;
CREATE TABLE `gallery` (
  `IdMedia` varchar(11) NOT NULL,
  `Path` text NOT NULL,
  `AddDate` datetime NOT NULL,
  `MapLocation` text NOT NULL,
  `MediaRank` varchar(11) NOT NULL,
  `MediaType` varchar(10) NOT NULL,
  PRIMARY KEY (`IdMedia`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='جدول المكتبة';

INSERT INTO `gallery` VALUES
('20110000009', 'Programs/gallery/Albums/one/tachometer.png', '2011-04-04 15:15:57', '', '', 'png'),
('20110000007', 'Programs/gallery/Albums/two', '2011-04-04 15:15:50', '', '', 'folder'),
('20110000006', 'Programs/gallery/Albums/one', '2011-04-04 15:15:49', '', '', 'folder'),
('20110000005', 'Programs/gallery/Albums/fomaco-logo.gif', '2011-04-04 15:15:49', '', '', 'gif'),
('20110000004', 'Programs/gallery/Albums/DSCF5494.jpg', '2011-04-04 15:15:49', '', '', 'jpg'),
('20110000003', 'Programs/gallery/Albums/mx2AxYxgqRA.youtube', '2011-03-11 09:20:01', '', '', 'youtube'),
('20110000002', 'Programs/gallery/Albums/MOV00045-13-12-2010.MPG', '2011-03-03 16:53:28', '', '', 'MPG'),
('20110000000', 'Programs/gallery/Albums/NewWinRARarchive.rar', '2011-03-02 15:44:50', '', '', 'rar'),
('20110000001', 'Programs/gallery/Albums/New folder', '2011-03-02 15:53:58', '', '', 'folder');

DROP TABLE IF EXISTS galleryfav;
CREATE TABLE `galleryfav` (
  `IdCmnt` varchar(11) NOT NULL,
  `IdMedia` varchar(11) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`IdCmnt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تفضيلات و تعليقات الزوار';

INSERT INTO `galleryfav` VALUES
('20110000000', '20110000009', '20070000000', '<p>dsadsadsa</p>', '2011-04-05 10:09:13');

DROP TABLE IF EXISTS gallerylang;
CREATE TABLE `gallerylang` (
  `IdMedia` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `Caption` text NOT NULL,
  `Desc` longtext NOT NULL,
  `Place` text NOT NULL,
  `Tags` text NOT NULL,
  PRIMARY KEY (`IdMedia`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='لغة المكتبة';

INSERT INTO `gallerylang` VALUES
('20110000009', '20070000001', '', 'asd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sadasd sda sdasd asd sad', '', ''),
('20110000009', '20070000002', '', '', '', ''),
('20110000007', '20070000001', '', '', '', ''),
('20110000007', '20070000002', '', '', '', ''),
('20110000006', '20070000001', '', '', '', ''),
('20110000006', '20070000002', '', '', '', ''),
('20110000005', '20070000001', '', '', '', ''),
('20110000005', '20070000002', '', '', '', ''),
('20110000004', '20070000002', '', '', '', ''),
('20110000004', '20070000001', '', '', '', ''),
('20110000003', '20070000001', 'تجربة من يوتيوب', '', '', ''),
('20110000003', '20070000002', 'youtube test', '', '', ''),
('20110000000', '20070000001', '', '', '', ''),
('20110000000', '20070000002', '', '', '', ''),
('20110000001', '20070000001', '', '', '', ''),
('20110000001', '20070000002', '', '', '', ''),
('20110000002', '20070000001', '', '', '', ''),
('20110000002', '20070000002', '', '', '', '');

DROP TABLE IF EXISTS galleryparams;
CREATE TABLE `galleryparams` (
  `ThumbsWidth` int(11) NOT NULL,
  `ThumbsHeight` int(11) NOT NULL,
  `ColumsNbr` int(11) NOT NULL,
  `CellWidthMax` int(11) NOT NULL,
  `CellHeightMax` int(11) NOT NULL,
  `PrintFilenames` tinyint(1) NOT NULL
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خصائص المعرض';

INSERT INTO `galleryparams` VALUES
(200, 200, 5, 200, 160, 1);

DROP TABLE IF EXISTS gballonlang;
CREATE TABLE `gballonlang` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BallonTitle` text NOT NULL COMMENT 'عنوان البالون',
  `BallonDesk` mediumtext NOT NULL COMMENT 'شرح البالون',
  PRIMARY KEY (`BallonId`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='البالون حسب اللغة';

DROP TABLE IF EXISTS gballons;
CREATE TABLE `gballons` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `BallonX` double NOT NULL COMMENT 'مكان البالون X',
  `BallonY` double NOT NULL COMMENT 'مكان البالون Y',
  `BallonIcon` text NOT NULL COMMENT 'ايقونة البالون',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف ؟',
  PRIMARY KEY (`BallonId`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تحديد موقع على الخريطة';

DROP TABLE IF EXISTS googlemap;
CREATE TABLE `googlemap` (
  `key` text NOT NULL COMMENT 'كود جوجل',
  `MapWidth` int(11) NOT NULL COMMENT 'عرض الخريطة',
  `MapHeight` int(11) NOT NULL COMMENT 'طول الخريطة',
  `EarthX` double NOT NULL COMMENT 'مكان الخريطة x',
  `EarthY` double NOT NULL COMMENT 'مكان الخريطة y',
  `MapType` varchar(10) NOT NULL COMMENT 'نوع الخريطة',
  `Altitude` tinyint(4) NOT NULL COMMENT 'الارتفاع عن الارض بين 18 و 1'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خريطة جوجل';

INSERT INTO `googlemap` VALUES
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, '33.896464', '36.049158', 'SATELLITE', 17);

DROP TABLE IF EXISTS groups;
CREATE TABLE `groups` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `GroupName` varchar(15) NOT NULL COMMENT 'اسم المجموعة',
  `Desc` varchar(50) NOT NULL COMMENT 'شرح المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف؟',
  UNIQUE KEY `GroupId` (`GroupId`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='مجموعات المستخدمين';

INSERT INTO `groups` VALUES
('20070000000', 'Guests', 'الزوار عادة يكون لهم صلاحية القراءة فقط', ''),
('20070000001', 'Users', 'المستخدمين المسجلين', ''),
('200700000-1', 'Admins', 'المدراء', '');

DROP TABLE IF EXISTS gsearch;
CREATE TABLE `gsearch` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='البحث عبر خدمة جوجل';

INSERT INTO `gsearch` VALUES
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window');

DROP TABLE IF EXISTS ipbanned;
CREATE TABLE `ipbanned` (
  `idip` double NOT NULL AUTO_INCREMENT COMMENT ' رقم الطرد',
  `ipStart` varchar(15) NOT NULL COMMENT 'بداية الايبي',
  `ipEnd` varchar(15) NOT NULL COMMENT 'نهاية الايبي',
  `reason` varchar(256) NOT NULL COMMENT 'السبب',
  `date` datetime NOT NULL COMMENT 'التاريخ',
  PRIMARY KEY (`idip`)
) ENGINE=MyISAM AUTO_INCREMENT=4 /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='طرد الزوار المزعجين';

DROP TABLE IF EXISTS languages;
CREATE TABLE `languages` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `LangName` varchar(15) NOT NULL COMMENT 'اسم اللغة',
  `Hits` varchar(7) NOT NULL COMMENT 'احصائيات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل اللغة محذوفة؟',
  UNIQUE KEY `IdLang` (`IdLang`),
  UNIQUE KEY `LangName` (`LangName`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='اللغات';

INSERT INTO `languages` VALUES
('20070000001', 'Arabic', '6001', '0'),
('20070000002', 'English', '285', '0');

DROP TABLE IF EXISTS layersmenu;
CREATE TABLE `layersmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '1',
  `text` text /*!40101 CHARACTER SET utf8 */,
  `href` text /*!40101 CHARACTER SET utf8 */,
  `title` text /*!40101 CHARACTER SET utf8 */,
  `icon` text /*!40101 CHARACTER SET utf8 */,
  `target` text /*!40101 CHARACTER SET utf8 */,
  `orderfield` int(11) DEFAULT '0',
  `expanded` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=311 /*!40101 DEFAULT CHARSET=latin1 */;

DROP TABLE IF EXISTS layersmenulang;
CREATE TABLE `layersmenulang` (
  `language` varchar(15) /*!40101 CHARACTER SET utf8 */ NOT NULL,
  `id` int(11) NOT NULL,
  `text` text /*!40101 CHARACTER SET utf8 */,
  `title` text /*!40101 CHARACTER SET utf8 */,
  PRIMARY KEY (`language`,`id`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=latin1 */;

DROP TABLE IF EXISTS letters;
CREATE TABLE `letters` (
  `idLetter` varchar(11) /*!40101 CHARACTER SET utf8 */ NOT NULL COMMENT 'رقم الرسالة',
  `LatterName` varchar(100) /*!40101 CHARACTER SET utf8 */ NOT NULL COMMENT 'اسم الرسالة',
  `Deleted` varchar(1) /*!40101 CHARACTER SET utf8 */ NOT NULL COMMENT 'هل هو محذوف؟',
  PRIMARY KEY (`idLetter`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ /*!40101 COLLATE=utf8_estonian_ci */ COMMENT='الرسائل النموذجية';

INSERT INTO `letters` VALUES
('20110000000', 'تذكير', '1'),
('20110000001', 'asdasd', '');

DROP TABLE IF EXISTS letterslang;
CREATE TABLE `letterslang` (
  `idLetter` varchar(11) NOT NULL COMMENT 'رقم الرسالة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleLetter` varchar(256) NOT NULL COMMENT 'عنوان الرسالة',
  `BodyLetter` longtext NOT NULL COMMENT 'الرسالة'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='رسائل نموذجية';

INSERT INTO `letterslang` VALUES
('20110000000', '20070000001', 'تذكير', '<p>&nbsp;</p>\r\n<p>{AdminSign}</p>\r\n<p>تذكير</p>'),
('20110000000', '20070000002', 'تذكير', '<p>{AdminSign}</p>\r\n<p>تذكير</p>'),
('20110000001', '20070000001', 'sadsadasdasdasdasd', '<p>asd</p>'),
('20110000001', '20070000002', 'asdasd', '<p>asdasd</p>');

DROP TABLE IF EXISTS licensept;
CREATE TABLE `licensept` (
  `IdLicense` varchar(11) NOT NULL,
  `FullNameLicense` varchar(35) NOT NULL,
  `EmailLicense` varchar(50) NOT NULL,
  `PhoneNbrLicense` varchar(35) NOT NULL,
  `LicenseCountry` varchar(35) NOT NULL,
  `TownLicense` varchar(35) NOT NULL,
  `AddressDetailsLicense` varchar(100) NOT NULL,
  `TypeLicense` varchar(35) NOT NULL,
  `HaveDomain` varchar(3) NOT NULL,
  `AlreadyProgName` varchar(100) NOT NULL,
  `DidUHavedomainName` varchar(35) NOT NULL,
  `LicenseComment` varchar(1024) NOT NULL,
  `AlreadyProg` varchar(3) NOT NULL,
  `LicenseKey` text NOT NULL,
  `LicenseOk` varchar(1) NOT NULL,
  `Deleted` varchar(1) NOT NULL,
  `RegStartDate` datetime NOT NULL,
  `RegEndDate` datetime NOT NULL,
  `RegSource` varchar(5) NOT NULL COMMENT '"ENC" mean Encrypted or "OPN" mean "Open source"',
  `RegPakage` varchar(5) NOT NULL COMMENT '"STD" mean Sandard OR "ADV" mean Advanced',
  `HostingRequest` varchar(1) NOT NULL,
  `RequestDate` datetime NOT NULL COMMENT 'تاريخ الطلب',
  `PartnerID` varchar(11) NOT NULL COMMENT 'رقم الوكيل',
  `PartnerCom` double NOT NULL COMMENT 'عمولة الوكيل',
  `ComPaid` tinyint(1) NOT NULL COMMENT 'هل تم دفع العمولة للوكيل',
  `PayRec` tinyint(1) NOT NULL COMMENT 'هل تم قبض المبلغ من الزبون',
  `ContractValue` double NOT NULL COMMENT 'قيمة عقد الصيانة مع عمولة الوكيل و دون الحسم للزبون',
  `CustomerDisc` double NOT NULL COMMENT 'قيمة حسم للعميل',
  PRIMARY KEY (`IdLicense`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تراخيص المواقع ';

INSERT INTO `licensept` VALUES
('20110000000', 'محسنوف', 'sads@sds.com', '23432', 'XX', 'sadsad', 'asdsa', 'StandardLicense', 'yes', '', 'localhost', '', 'no', '9c9AxMToxNzoyMQ==694338bc8475ec94MjAxMC0xMS0wMShYWFhYWFhYWA==TElGRVRJTUVYWF3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0', '2011-03-15 15:22:08', '20070000001', '50.01', 0, 0, '365', '15'),
('20110000001', 'محسن الموسوي', 'mhndm@localhost.com', '58564465', 'LB', 'beirut', 'high way', 'FullLicense', 'yes', '', 'pc-it-manager', '', 'no', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', '1', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '0', '2011-03-16 08:32:55', '', '0', 0, 0, '0', '0');

DROP TABLE IF EXISTS mainmenu;
CREATE TABLE `mainmenu` (
  `IdMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `Target` varchar(256) NOT NULL COMMENT 'وجهة النك',
  `Order` int(2) NOT NULL COMMENT 'ترتيبه من الاعلى',
  `External` varchar(1) NOT NULL COMMENT 'هل هذا الرابط خارجي؟',
  UNIQUE KEY `IdMM` (`IdMM`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='عناصر الائحة الرئيسية';

INSERT INTO `mainmenu` VALUES
('20110000002', 'asdsadddsd', 'asds', 3, '0'),
('20110000003', 'http://pc-it-manager/phptransformer/Prog-pages_pagenbr-2_Lang-English_nl-1.pt', '', 4, '0'),
('20110000004', 'http://pc-it-manager/phptransformer/Prog-pages_pagenbr-1_Lang-Arabic_nl-1.pt', '', 5, '0'),
('20110000005', 'http://pc-it-manager/phptransformer/Prog-pages_pagenbr-2_Lang-Arabic_nl-1.pt', '', 6, '0'),
('20110000006', 'http://pc-it-manager/phptransformer/Prog-pages_pagenbr-3_Lang-Arabic_nl-1.pt', '', 7, '0'),
('20110000007', 'http://pc-it-manager/phptransformer/Prog-pages_pagenbr-4_Lang-Arabic_nl-1.pt', '', 8, '0');

DROP TABLE IF EXISTS marqlang;
CREATE TABLE `marqlang` (
  `idmarque` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Message` varchar(125) NOT NULL COMMENT 'الرسالة',
  UNIQUE KEY `idmarque` (`idmarque`,`idLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='شريط الاخبار حسب اللغة';

DROP TABLE IF EXISTS marques;
CREATE TABLE `marques` (
  `idMarque` varchar(11) NOT NULL COMMENT 'رقم الخبر ',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `StartDate` datetime NOT NULL COMMENT 'تاريخ البدء',
  `EndDate` datetime NOT NULL COMMENT 'تاريخ الانتهاء',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف؟',
  UNIQUE KEY `idMarque` (`idMarque`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='شريط الاخبار';

DROP TABLE IF EXISTS menlang;
CREATE TABLE `menlang` (
  `idMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleElement` varchar(35) NOT NULL COMMENT 'اسم العنصر بهذه اللغة',
  UNIQUE KEY `idMM` (`idMM`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='اسماء عناصر الائحة الرئيسية حسب �';

INSERT INTO `menlang` VALUES
('20100000000', '20070000001', 'Page Title'),
('20110000002', '20070000001', 'شسيسشي شسيس يي'),
('20110000002', '20070000002', 'asd sadsa sad aaa'),
('20110000003', '20070000001', 'sadsad'),
('20110000003', '20070000002', 'asdsad'),
('20110000004', '20070000001', 'شسيس شي سشي'),
('20110000004', '20070000002', 'asd sd sad '),
('20110000005', '20070000001', 'شسي ستالت شيس ي'),
('20110000005', '20070000002', 'QWE GHJG FDG'),
('20110000006', '20070000001', 'يسبيب'),
('20110000006', '20070000002', 'asdsad'),
('20110000007', '20070000001', 'شسي شس123 123'),
('20110000007', '20070000002', ' ضصثصضثضص ثصض');

DROP TABLE IF EXISTS messagecenter;
CREATE TABLE `messagecenter` (
  `idMsgCntr` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `Message` text NOT NULL,
  `To` varchar(100) NOT NULL,
  `PubDate` datetime NOT NULL,
  `ExpDate` datetime NOT NULL,
  `Published` varchar(1) NOT NULL,
  PRIMARY KEY (`idMsgCntr`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='ارسال رسائل لزبائن pt';

DROP TABLE IF EXISTS messagecenterrec;
CREATE TABLE `messagecenterrec` (
  `idMsgCntrRec` varchar(11) NOT NULL,
  `ReferelUrl` varchar(1024) NOT NULL,
  `TimeReq` datetime NOT NULL,
  `Alert` varchar(1) NOT NULL,
  PRIMARY KEY (`idMsgCntrRec`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تسجيلات طلبات الرسائل';

DROP TABLE IF EXISTS moderators;
CREATE TABLE `moderators` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `Permission` varchar(1) NOT NULL COMMENT 'الصلاحية',
  UNIQUE KEY `GroupId` (`GroupId`,`ObjectId`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الاشراف';

INSERT INTO `moderators` VALUES
('200700000-1', '20100000000', '1'),
('20070000000', '20100000000', '1'),
('20070000001', '20100000000', '1'),
('200700000-1', '20110000000', '1'),
('20070000000', '20110000000', '1'),
('20070000001', '20110000000', '1'),
('200700000-1', '20110000001', '1'),
('200700000-1', '20110000002', '1'),
('200700000-1', '20110000003', '1'),
('200700000-1', '20110000004', '1'),
('200700000-1', '20110000005', '1'),
('200700000-1', '20110000006', '1'),
('200700000-1', '20110000007', '1'),
('200700000-1', '20110000008', '1'),
('200700000-1', '20110000009', '1'),
('200700000-1', '20110000010', '1');

DROP TABLE IF EXISTS news;
CREATE TABLE `news` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `IdUserName` varchar(11) NOT NULL COMMENT 'رقم الكاتب',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `Hits` varchar(7) NOT NULL COMMENT 'زيارة',
  `NewsPic` varchar(50) NOT NULL COMMENT 'صورة للخبر',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف ؟',
  PRIMARY KEY (`IdNews`),
  UNIQUE KEY `IdNews` (`IdNews`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الاخبار';

INSERT INTO `news` VALUES
('20100000000', '200700000-1', '2010-11-01 14:40:16', '1', '32', 'news.jpg', '1'),
('20110000000', '200700000-1', '2011-03-02 09:52:13', '1', '3', 'news.jpg', ''),
('20110000001', '200700000-1', '2011-03-01 09:53:39', '1', '8', 'news.jpg', '');

DROP TABLE IF EXISTS newscategoies;
CREATE TABLE `newscategoies` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقمم الخبر',
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  UNIQUE KEY `IdNews` (`IdNews`,`IdCat`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='ربط الخبر بمجموعة';

INSERT INTO `newscategoies` VALUES
('20100000000', '20070000002'),
('20110000000', '20070000002'),
('20110000001', '20070000002');

DROP TABLE IF EXISTS newscomment;
CREATE TABLE `newscomment` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `CommentTitle` varchar(100) NOT NULL COMMENT 'عنوان التعليق',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `CommentDate` datetime NOT NULL COMMENT 'تاريخ التعليق',
  `theComment` varchar(500) NOT NULL COMMENT 'نص التعليق',
  `idComment` varchar(11) NOT NULL COMMENT 'رقم التعليق',
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تعليقات على الخبر';

INSERT INTO `newscomment` VALUES
('20110000000', 'xzc xc xzc xzc xzc', '20070000000', '', '2011-03-02 09:55:24', '<p>zxc xzc xzc xzc xzc xzc</p>', '20110000000'),
('20110000000', 'ؤءر ءؤر ءؤر ءؤر ؤء', '20070000001', '', '2011-03-02 09:55:53', '<p>ءؤر ءؤر ءؤر ؤءر ءؤر</p>', '20110000001'),
('20110000001', 'ضصثضصث ضصث صضث ص', '20070000000', '', '2011-03-02 09:56:17', '<p>ضصث ضصث صضث صضث يءئبيسبسشب سيب يب</p>', '20110000002'),
('20110000001', 'مستقبلن تمامن', '20070000000', '', '2011-03-02 09:56:51', '<p>ىةةوىةو ةو ةووة ةوىة</p>', '20110000003'),
('20110000001', 'تسشتك دمدم ', '20070000001', '', '2011-03-02 09:57:19', '<p>يئبؤ يب يسبةى وىلا لارلاىلافغعفغع غفعفق 65456 456 5</p>', '20110000004'),
('20110000000', 'salam', '20070000000', '', '2011-03-02 09:57:44', '<p>soto kipida</p>', '20110000005'),
('20110000001', ' ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ماذا سيكون ', '20070000000', '', '2011-03-02 10:40:07', '<p>&nbsp;يجب أن يكون شي ماهنا</p>', '20110000006');

DROP TABLE IF EXISTS newslang;
CREATE TABLE `newslang` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقمم اللغة',
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `Tilte` varchar(125) DEFAULT NULL,
  `SubTitle` varchar(35) NOT NULL COMMENT 'العنوان الفرعي للخبر',
  `Breif` text NOT NULL COMMENT 'مختصر الخبر',
  `FullMessage` longtext NOT NULL COMMENT 'الخبر كاملا',
  `Note` varchar(200) NOT NULL COMMENT 'ملاحظة',
  PRIMARY KEY (`IdLang`,`IdNews`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='الاخبار حسب اللغة';

INSERT INTO `newslang` VALUES
('20070000001', '20100000000', 'عنوان الخبر', 'عنوان فرعي للخبر', '<p style=\"text-align: center;\">عربي\r\n<p style=\"text-align: center;\"><img src=\"Programs/news/images/news.jpg\" alt=\"\" width=\"50\" height=\"50\" /> <a href=\"Prog-pages_pagenbr-1_Lang-Arabic_nl-1.pt\">مختصر الخب</a>ر', '<p><img src=\"images/logorss.jpg\" alt=\"\" width=\"213\" height=\"150\" /></p>\r\n<p>كامل الخبر</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"http://pc-it-manager/phptransformer/Prog-exlink_Id-20100000000_Lang-Arabic_nl-1.pt\">http</a></p>\r\n<p><img src=\"http://www.google.com.lb/logos/2010/lebanonind10-hp.jpg\" alt=\"\" width=\"345\" height=\"151\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'ملاحظة على الخبر'),
('20070000002', '20100000000', 'News title', 'news sub title', '<p style=\"text-align: center;\">Eng\r\n<p style=\"text-align: center;\"><img src=\"Programs/news/images/news.jpg\" alt=\"\" width=\"50\" height=\"50\" /> مختصر الخبر', '<p><img src=\"images/logorss.jpg\" alt=\"\" width=\"213\" height=\"150\" /></p>\r\n<p>كامل الخبر</p>\r\n<p>&nbsp;</p>\r\n<p>http</p>\r\n<p><img src=\"http://www.google.com.lb/logos/2010/lebanonind10-hp.jpg\" alt=\"\" width=\"345\" height=\"151\" /></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'news note'),
('20070000001', '20110000000', 'سيشب سشيشسي شسي ', 'لارىلارى ؤء ؤءؤ ءئؤ ', 'شسبسش يسشيلاا لاغف ف عغ فققث فثص يثس بيس ب', '<p>شسبسش يسشيلاا لاغف ف عغ فققث فثص يثس بيس ب</p>', ''),
('20070000002', '20110000000', 'ASD SA HGJ HG UIOPUIO DSAD', 'dfsg dsfdf sdf dsf dsf dsf ', 'dsaf nb nbmew rewr&nbsp; hj jh kj k&nbsp; dfg dsf sda sd dsf', '<p>dsaf nb nbmew rewr&nbsp; hj jh kj k&nbsp; dfg dsf sda sd dsf</p>', ''),
('20070000001', '20110000001', 'يبل بيل سيب سي بيسش ب سشيب شصث ضصث ', 'غفعف غع لؤ بي ليب ل ', 'asd sadasd sad sad sadsa dsad sad asds asd asd sad sad asdsa sad saas sad sad sad sad as', '<p>شسيسشي سيب رلاى لا ى رلاى رلاى رلاى رلاى رلا لارى</p>', ''),
('20070000002', '20110000001', 'fg adfsadf sad  bnvm m, mnf ', 'cvbvc bvb vcb ', 'cxvb bvc bvcb vb', '<p>cxvb bvc bvcb vb</p>', '');

DROP TABLE IF EXISTS newsservice;
CREATE TABLE `newsservice` (
  `IdNewsServ` varchar(11) NOT NULL COMMENT 'رقم السطر',
  `WebName` varchar(1024) NOT NULL COMMENT 'اسم الموقع',
  `FeedName` varchar(35) NOT NULL COMMENT 'اسم المغذي',
  `FeedCode` varchar(10) NOT NULL COMMENT 'كود المغذي',
  `FeedUrl` varchar(1024) NOT NULL COMMENT 'عنوان المغذي',
  `FeedLang` varchar(15) NOT NULL COMMENT 'لغة المغذي',
  `Available` varchar(1) NOT NULL COMMENT 'متوفر',
  PRIMARY KEY (`IdNewsServ`),
  UNIQUE KEY `FeedCode` (`FeedCode`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خدمة الاخبار للمواقع الخارجية';

INSERT INTO `newsservice` VALUES
('20080000000', 'Al Jazeera', 'أخبار الجزيرة', 'jscar', 'http://www.aljazeera.net/PORTAL/RSS/RSS-Portal.xml', 'Arabic', '1'),
('20080000001', 'Al Jazeera', 'Al Jazeera English', 'jscen', 'http://english.aljazeera.net/NR/exeres/4D6139CD-6BB5-438A-8F33-96A7F25F40AF.htm?ArticleGuid=55ABE840-AC30-41D2-BDC9-06BBE2A36665', 'English', '1'),
('20080000002', 'Google News', 'Google عربي', 'gglar', 'http://news.google.com/news?ned=ar&output=rss', 'Arabic', '1'),
('20080000003', 'Google News', 'Google English', 'gglen', 'http://news.google.com/news?ned=us&output=rss', 'English', '1'),
('20080000004', 'bbc', 'bbc Arabic', 'bbcar', 'http://newsrss.bbc.co.uk/rss/arabic/news/rss.xml', 'Arabic', '1'),
('20080000005', 'bbc', 'bbc News Front Page ', 'bbcennfp', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml', 'English', '1'),
('20080000006', 'bbc', 'bbc World', 'bbcwrld', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/world/rss.xml', 'English', '1'),
('20080000007', 'bbc', 'bbc UK', 'bbcuk', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/uk/rss.xml', 'English', '1'),
('20080000008', 'bbc', 'bbc England ', 'bbcengld', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/england/rss.xml', 'English', '1'),
('20080000009', 'bbc', 'bbc Northern Ireland ', 'bbcni', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/northern_ireland/rss.xml', 'English', '1'),
('20080000010', 'bbc', 'bbc Scotland ', 'bbcsl', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/scotland/rss.xml', 'English', '1'),
('20080000011', 'bbc', 'bbc Wales', 'bbcwls', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/wales/rss.xml', 'English', '1'),
('20080000012', 'bbc', 'bbc Business ', 'bbcbzns', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/business/rss.xml', 'English', '1'),
('20080000013', 'bbc', 'bbc Politics', 'bbcpltc', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/uk_politics/rss.xml', 'English', '1'),
('20080000014', 'bbc', 'bbc Health', 'bbchlt', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/health/rss.xml', 'English', '1'),
('20080000015', 'bbc', 'bbc Education', 'bbcedu', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/education/rss.xml', 'English', '1'),
('20080000016', 'bbc', 'bbc Science/Nature ', 'bbcscna', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/sci/tech/rss.xml', 'English', '1'),
('20080000017', 'bbc', 'bbc Technology ', 'bbctech', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/technology/rss.xml', 'English', '1'),
('20080000018', 'bbc', 'bbc Entertainment ', 'bbcent', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/entertainment/rss.xml', 'English', '1'),
('20080000019', 'bbc', 'bbc Have Your Say ', 'bbchys', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/talking_point/rss.xml', 'English', '1'),
('20080000020', 'bbc', 'bbc Magazine', 'bbcmag', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/magazine/rss.xml', 'English', '1'),
('20080000021', 'bbc', 'bbc Week At a Glance ', 'bbcwaag', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/week_at-a-glance/rss.xml', 'English', '1'),
('20080000022', 'bbc', 'bbc Programmes', 'bbprog', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/programmes/rss.xml', 'English', '1'),
('20080000023', 'bbc', 'bbc Latest Published Stories ', 'bbclps', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/latest_published_stories/rss.xml', 'English', '1'),
('20080000024', 'Manar TV', 'الأخبار', 'mnrar', 'http://www.almanar.com.lb/NewsSite/RSS_Main.aspx?language=ar', 'Arabic', '1'),
('20080000025', 'Manar TV', 'News', 'mnren', 'http://www.almanar.com.lb/NewsSite/RSS_Main.aspx?language=en', 'English', '1'),
('20080000026', 'Press', 'Press Latest News', 'prsln', 'http://www.presstv.ir/rss', 'English', '1'),
('20080000027', 'Press', 'Press Iran News', 'prsin', 'http://www.presstv.ir/rss/?section=iran', 'English', '1'),
('20080000028', 'Press', 'Press Middle East News', 'prsmen', 'http://www.presstv.ir/rss/?section=middleeast', 'English', '1'),
('20080000029', 'Press', 'Press US News', 'prsusn', 'http://www.presstv.ir/rss/?section=us', 'English', '1'),
('20080000030', 'Press', 'Press Asia / Pacific news', 'prsapn', 'http://www.presstv.ir/rss/?section=asiapacific', 'English', '1'),
('20080000031', 'Press', 'Press Africa News', 'prsafn', 'http://www.presstv.ir/rss/?section=africa', 'English', '1'),
('20080000032', 'Press', 'Press Europe News', 'prseun', 'http://www.presstv.ir/rss/?section=europe', 'English', '1'),
('20080000033', 'Press', 'Press Americas News', 'prsamn', 'http://www.presstv.ir/rss/?section=americas', 'English', '1'),
('20080000034', 'Press', 'Press Sci/Tech', 'prssctc', 'http://www.presstv.ir/rss/?section=scitech', 'English', '1'),
('20080000035', 'Press', 'Press Health News', 'prshln', 'http://www.presstv.ir/rss/?section=health', 'English', '1'),
('20080000036', 'Press', 'Press Sports News', 'prssprt', 'http://www.presstv.ir/rss/?section=sports', 'English', '1'),
('20080000037', 'Press', 'Press Society News', 'prssctn', 'http://www.presstv.ir/rss/?section=society', 'English', '1'),
('20080000038', 'Reuters', 'Reuters Top News', 'rtrstn', 'http://feeds.reuters.com/reuters/topNews?format=xml', 'English', '1'),
('20080000039', 'Reuters', 'Reuters Business News', 'rtrsbzns', 'http://feeds.reuters.com/reuters/businessNews?format=xml', 'English', '1'),
('20080000040', 'Reuters', 'Reuters U.S.', 'rtrsus', 'http://feeds.reuters.com/Reuters/domesticNews?format=xml', 'English', '1'),
('20080000041', 'Reuters', 'Reuters International News', 'rtrsintn', 'http://feeds.reuters.com/reuters/worldNews?format=xml', 'English', '1'),
('20080000042', 'Reuters', 'Reuters Politics', 'rtrspol', 'http://feeds.reuters.com/Reuters/PoliticsNews?format=xml', 'English', '1'),
('20080000043', 'Reuters', 'Reuters Entertainment News', 'rtrsentn', 'http://feeds.reuters.com/reuters/entertainment?format=xml', 'English', '1'),
('20080000044', 'Reuters', 'Reuters Environment', 'rtrsenv', 'http://feeds.reuters.com/reuters/environment?format=xml', 'English', '1'),
('20080000045', 'Reuters', 'Reuters Technology News', 'rtrstechn', 'http://feeds.reuters.com/reuters/technologyNews?format=xml', 'English', '1'),
('20080000046', 'Reuters', 'Reuters Science News', 'rtrsscn', 'http://feeds.reuters.com/reuters/scienceNews?format=xml', 'English', '1'),
('20080000047', 'Reuters', 'Reuters Internet News', 'rtrsintnt', 'http://feeds.reuters.com/Reuters/InternetNews?format=xml', 'English', '1'),
('20080000048', 'Reuters', 'Reuters Sports News', 'rtrssprt', 'http://feeds.reuters.com/reuters/sportsNews?format=xml', 'English', '1'),
('20080000049', 'Reuters', 'Reuters Health News', 'rtrshltn', 'http://feeds.reuters.com/reuters/healthNews?format=xml', 'English', '1'),
('20080000050', 'Reuters', 'Reuters Oddly Enough', 'rtrsoden', 'http://feeds.reuters.com/reuters/oddlyEnoughNews?format=xml', 'English', '1'),
('20080000051', 'Reuters', 'Reuters In Depth', 'rtrsind', 'http://feeds.reuters.com/reuters/inDepthNews?format=xml', 'English', '1'),
('20080000052', 'Reuters', 'Reuters Lifestyle', 'rtrslstl', 'http://feeds.reuters.com/reuters/lifestyle?format=xml', 'English', '1'),
('20080000053', 'Reuters', 'Reuters Travel', 'rtrstrvl', 'http://feeds.reuters.com/reuters/features/destinations?format=xml', 'English', '1'),
('20080000054', 'Reuters', 'Reuters Tech', 'rtrstech', 'http://feeds.reuters.com/reuters/features/techlife?format=xml', 'English', '1'),
('20080000055', 'Reuters', 'Reuters Health & Fitness', 'rtrshlft', 'http://feeds.reuters.com/reuters/features/wellbeing?format=xml', 'English', '1'),
('20080000056', 'Reuters', 'Reuters Money', 'rtrsmn', 'http://feeds.reuters.com/reuters/features/personalfinance?format=xml', 'English', '1'),
('20080000057', 'Reuters', 'Reuters Autos', 'rtrsato', 'http://feeds.reuters.com/reuters/features/autos?format=xml', 'English', '1'),
('20080000058', 'Aarabiya', 'العربية.نت | الصفحة الرئيسية', 'arbmp', 'http://www.alarabiya.net/rss/rss_top08.xml', 'Arabic', '1'),
('20080000059', 'Aarabiya', 'العربية.نت | الصفحة السياسية', 'arbpp', 'http://www.alarabiya.net/rss/PoliticsPage.xml', 'Arabic', '1'),
('20080000060', 'Aarabiya', 'العربية.نت | الصفحة الرياضية', 'arbsp', 'http://www.alarabiya.net/rss/SportsPage.xml', 'Arabic', '1'),
('20080000061', 'Aarabiya', 'الأسواق العربية | الصفحة الرئيسية', 'arbbzns', 'http://www.alaswaq.net/files/rss/index.xml', 'Arabic', '1'),
('20080000062', 'Aarabiya', 'العربية.نت | الصفحة الأخيرة', 'arblp', 'http://www.alarabiya.net/rss/LastPage.xml', 'Arabic', '1'),
('20080000063', 'Aarabiya', 'العربية.نت | آخر الأخبار', 'arbln', 'http://www.alarabiya.net/rss/rssLatestNews.xml', 'Arabic', '1');

DROP TABLE IF EXISTS objects;
CREATE TABLE `objects` (
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `ObjectName` varchar(35) NOT NULL COMMENT 'اسم العنصر',
  UNIQUE KEY `ObjectId` (`ObjectId`,`ObjectName`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='عناصر يتم التحكم بالوصول اليها ه�';

INSERT INTO `objects` VALUES
('20110000000', '{PageNumber} 1'),
('20110000001', '{PageNumber} 2'),
('20110000002', '{PageNumber} 3'),
('20110000003', '{PageNumber} 4');

DROP TABLE IF EXISTS oldstatistics;
CREATE TABLE `oldstatistics` (
  `MonthDate` varchar(8) NOT NULL COMMENT 'الشهر و السنة',
  `IPNbr` varchar(15) NOT NULL COMMENT 'ايبي بلد الزيارة',
  `Hits` varchar(7) NOT NULL COMMENT 'عدد الزيارات'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='في الاحصاءات للاشهرو السنوات الق';

DROP TABLE IF EXISTS opstatistics;
CREATE TABLE `opstatistics` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='مستعرضات و انظمة تشغيل الزوار';

INSERT INTO `opstatistics` VALUES
('5', '1', '1', '1', '21', '1', '25', '1', '1', '1', '1');

DROP TABLE IF EXISTS pagelang;
CREATE TABLE `pagelang` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `PageTitle` varchar(256) NOT NULL COMMENT 'عنوان الصفحة',
  `Content` longtext NOT NULL COMMENT 'محتوى الصفحة',
  PRIMARY KEY (`IdPage`,`IdLang`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `pagelang` VALUES
('20110000000', '20070000001', 'شسيس شي سشي', '<p>شسي شسي سشيس شي</p>'),
('20110000000', '20070000002', 'asd sd sad ', '<p>asd sad sad sd</p>'),
('20110000001', '20070000001', 'شسي ستالت شيس ي', '<p><strong>مضمون </strong>الصفحة الأولى</p>\r\n<p>\\r\\n</p>\r\n<p><img src=\"images/phpTransformer-software-box-1.5.png\" alt=\"\" /></p>'),
('20110000001', '20070000002', 'QWE GHJG FDG', '<p><strong>مضمون </strong>الصفحة الأولى</p>\r\n<p>\\r\\n</p>\r\n<p><img src=\"images/phpTransformer-software-box-1.5.png\" alt=\"\" /></p>'),
('20110000002', '20070000001', 'يسبيب', '<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>\r\n<p>&nbsp;</p>\r\n<p>يسبسيبيسبسيبيسبسيب يسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبسيبيسبس يبيسبسيبيسبسيبيسبسيبي سبسيبيسبسيبيسبسيبيسبسيبيسبسيب</p>'),
('20110000002', '20070000002', 'asdsad', '<p>sadsad</p>'),
('20110000003', '20070000001', 'شسي شس123 123', '<p>ضصث ضصث صضث صضث</p>'),
('20110000003', '20070000002', ' ضصثصضثضص ثصض', '<p>ث ضصثصض</p>');

DROP TABLE IF EXISTS pages;
CREATE TABLE `pages` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `PageNbr` bigint(11) DEFAULT NULL,
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر للصلاحيات',
  `Hits` double NOT NULL COMMENT 'عدد الزيارات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هذه الصفحة محذوفة ؟',
  PRIMARY KEY (`IdPage`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `pages` VALUES
('20110000000', 1, '20110000000', '894', '0'),
('20110000001', 2, '20110000001', '173', '0'),
('20110000002', 3, '20110000002', '52', '0'),
('20110000003', 4, '20110000003', '1', '0');

DROP TABLE IF EXISTS params;
CREATE TABLE `params` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خصائص الوقع الافتراضية';

INSERT INTO `params` VALUES
('pages', 'Arabic', 'Default', '0', '1', '1', '1', 'Month', '1', '2', '1', '1', '1', '1', '1', '1', '1', '1', 'http://phptransformer.com/GeoIpDectecter/index.php?ip=', '0', '5', '3', '10', '0.065', '1', '0', '7', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 'pages', 'Account', 'sendmail', 0, 86400, '', 'هذا إسم موقعي الرائع', 'YY-XXXXXXX-X', 1, '2011-05-13 06:53:56', '2.5', '', 'core');

DROP TABLE IF EXISTS partners;
CREATE TABLE `partners` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `StartDate` datetime NOT NULL COMMENT 'تاريخ بدء التعامل',
  `ComCode` varchar(11) NOT NULL COMMENT 'رمز التخفيض',
  `PartComForm` text NOT NULL COMMENT 'فورميلا احتساب العمولة',
  `CustDiscForm` text NOT NULL COMMENT 'فورميلا احتساب حسم الزبون',
  UNIQUE KEY `ComCode` (`ComCode`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='شركاء تسويق البرنامج';

INSERT INTO `partners` VALUES
('20070000001', '2010-03-14 10:14:30', 'ABCD', '50.00', '15.00'),
('20070000001', '2011-03-14 10:14:30', 'XYZW', '50.01', '15.00'),
('20110000004', '2011-03-16 10:44:32', 'QWER', '45.00', '10.00'),
('20110000008', '2009-03-09 16:13:40', 'serv', '50', '15'),
('20110000007', '2008-03-15 00:00:00', 'yuio', '50', '15');

DROP TABLE IF EXISTS plugins;
CREATE TABLE `plugins` (
  `id` varchar(11) NOT NULL COMMENT 'رقم الاضافة',
  `name` varchar(1024) NOT NULL COMMENT 'اسم الاضافة'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='جدول الاضافات المفعلة';

DROP TABLE IF EXISTS poolchoices;
CREATE TABLE `poolchoices` (
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار',
  `idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `cheked` varchar(1) NOT NULL COMMENT 'هل هو معلم',
  PRIMARY KEY (`idpc`,`idpt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خيارت التصويت';

INSERT INTO `poolchoices` VALUES
('20100000002', '20100000000', '0'),
('20100000001', '20100000000', '1'),
('20100000000', '20100000000', '0'),
('20100000003', '20100000000', '0'),
('20110000000', '20110000000', '1'),
('20110000001', '20110000000', '0');

DROP TABLE IF EXISTS poollangchoices;
CREATE TABLE `poollangchoices` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم خيار التصويت',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان الخيار',
  `Choise` varchar(100) NOT NULL COMMENT 'الخيار بهذه اللغة',
  PRIMARY KEY (`IdLang`,`idpc`,`Idpt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='خيارات التصويت بلغة معينة';

INSERT INTO `poollangchoices` VALUES
('20070000002', '20100000000', '20100000000', 'dasd'),
('20070000001', '20100000003', '20100000000', 'sa'),
('20070000001', '20100000002', '20100000000', 'dasdasd'),
('20070000001', '20100000001', '20100000000', 'asd'),
('20070000001', '20100000000', '20100000000', 'asdasddasd'),
('20070000002', '20100000001', '20100000000', 'asdasdas'),
('20070000002', '20100000002', '20100000000', 'asd'),
('20070000002', '20100000003', '20100000000', 'sadas'),
('20070000001', '20110000000', '20110000000', 'sdfsd'),
('20070000001', '20110000001', '20110000000', 'sdf'),
('20070000002', '20110000000', '20110000000', 'sdf'),
('20070000002', '20110000001', '20110000000', 'sdfdsf');

DROP TABLE IF EXISTS poollangtitles;
CREATE TABLE `poollangtitles` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم العنوان',
  `Title` varchar(100) NOT NULL COMMENT 'العنوان بهذه اللغة',
  PRIMARY KEY (`IdLang`,`Idpt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='نص عنوان باللغات';

INSERT INTO `poollangtitles` VALUES
('20070000002', '20100000000', 'sadsa'),
('20070000001', '20100000000', 'wsdsad'),
('20070000001', '20110000000', 'sdfdsf'),
('20070000002', '20110000000', 'sdfsdf');

DROP TABLE IF EXISTS pooltitle;
CREATE TABLE `pooltitle` (
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `poolstart` datetime NOT NULL COMMENT 'تاريخ بدء التصويت',
  `poolend` datetime NOT NULL COMMENT 'تاريخ نهاية التصويت',
  `multichoice` varchar(1) NOT NULL COMMENT 'هل يسمح بتعدد الخيارات',
  `published` varchar(1) NOT NULL COMMENT 'هل مجهز للنشر',
  `lastpol` varchar(1) NOT NULL COMMENT 'هل هو ىخر تصويت',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل التصويت محذوف؟',
  PRIMARY KEY (`Idpt`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='التصويتات';

INSERT INTO `pooltitle` VALUES
('20100000000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '1', '0', '1'),
('20110000000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '1', '1', '1');

DROP TABLE IF EXISTS poolusers;
CREATE TABLE `poolusers` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان التصويت',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار المصوت له',
  `IpPool` varchar(15) NOT NULL COMMENT 'رقم ايبي التصويت',
  `Comment` varchar(250) NOT NULL COMMENT 'تعليق المستخدم'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='تصويت المستخدمين';

INSERT INTO `poolusers` VALUES
('20070000000', '20100000000', '20100000001', 'fe80::a998:ae3:', ''),
('20070000000', '20100000000', '20100000001', 'fe80::a998:ae3:', ''),
('200700000-1', '20100000000', '20100000001', 'fe80::a998:ae3:', 'ftu');

DROP TABLE IF EXISTS programs;
CREATE TABLE `programs` (
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
  UNIQUE KEY `ProgramName` (`ProgramName`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `programs` VALUES
('20070000000', 'pages', '1', '1', '1', '1', '1', '1', '1', '1', '20070000000', '927', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 1, 86400, '2011-05-13 06:53:56', '2.5', ''),
('20070000001', 'account', '1', '1', '1', '0', '1', '1', '1', '1', '20070000001', '29', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20070000003', 'tellfriend', '1', '1', '1', '1', '1', '1', '1', '1', '20070000003', '1', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', 'the tell friend dsec new ver '),
('20070000004', 'pool', '1', '1', '1', '1', '1', '1', '1', '1', '20070000009', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20070000005', 'usercp', '1', '1', '1', '1', '1', '1', '1', '1', '20070000010', '21', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20110000003', 'fomacoorderadmin', '1', '1', '1', '1', '1', '1', '1', '1', '20110000006', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20070000007', 'news', '1', '1', '1', '1', '1', '1', '1', '1', '20070000001', '24', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20070000008', 'ads', '1', '1', '1', '1', '1', '1', '1', '1', '20070000012', '1', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20070000009', 'exlink', '1', '1', '1', '1', '1', '1', '1', '1', '20070000016', '1', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000012', 'contactus', '1', '1', '1', '1', '1', '1', '1', '1', '20080000018', '3', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000013', 'careers', '1', '1', '1', '1', '1', '0', '1', '1', '20080000021', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000014', 'geoip', '1', '1', '1', '1', '1', '1', '1', '1', '20080000023', '1', '0', '9c9AxMToxNzoyMQ==694338bc8475ec94MjAxMC0xMS0wMShYWFhYWFhYWA==TElGRVRJTUVYWF3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', 'the geoip desc updates'),
('20080000015', 'services', '1', '1', '1', '1', '1', '1', '1', '1', '20080000024', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000016', 'weather', '1', '1', '1', '1', '1', '1', '1', '1', '20080000025', '1', '0', '', 0, 21600, '0000-00-00 00:00:00', '0', '0'),
('20080000017', 'newsservice', '1', '1', '1', '1', '1', '1', '1', '1', '20080000026', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000018', 'getlicense', '1', '1', '1', '1', '1', '1', '1', '1', '20080000027', '365', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000019', 'messagecenter', '1', '1', '1', '1', '1', '1', '1', '1', '20080000028', '1', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000020', 'rss', '1', '0', '0', '0', '0', '0', '0', '1', '20080000029', '1', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20080000022', 'gallery', '1', '1', '1', '1', '1', '0', '1', '1', '20080000033', '103', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20110000004', 'x helloworld', '1', '1', '1', '1', '1', '1', '1', '1', '20110000007', '1', '1', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20110000001', 'fomaconakdi', '1', '1', '0', '0', '1', '0', '1', '1', '20110000001', '17', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '0'),
('20110000005', 'update', '1', '0', '0', '0', '0', '0', '0', '1', '20110000009', '402', '0', '', 0, 0, '0000-00-00 00:00:00', '0', ''),
('20110000006', 'welcome', '1', '1', '1', '1', '1', '1', '1', '1', '20110000010', '180', '0', '', 0, 0, '0000-00-00 00:00:00', '0', '');

DROP TABLE IF EXISTS screens;
CREATE TABLE `screens` (
  `ScreenXY` varchar(10) NOT NULL COMMENT 'ارتفاع و عرض الشاشة',
  `Hits` bigint(7) NOT NULL COMMENT 'عدد الشاشات'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='احصائيات شاشات الزوار';

INSERT INTO `screens` VALUES
('Anknow', 8),
('1024x768', 1),
('1440x900', 18),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('1280x800', 1);

DROP TABLE IF EXISTS services;
CREATE TABLE `services` (
  `IdService` varchar(11) NOT NULL,
  `ServiceName` varchar(35) NOT NULL,
  `Available` varchar(1) NOT NULL,
  `AdminMustOk` varchar(1) NOT NULL,
  PRIMARY KEY (`IdService`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=latin1 */;

INSERT INTO `services` VALUES
('20070000000', 'GeoIp', '1', '0'),
('20070000001', 'Weather', '1', '0'),
('20080000000', 'NewsService', '1', '0');

DROP TABLE IF EXISTS servicespartners;
CREATE TABLE `servicespartners` (
  `SpId` varchar(11) NOT NULL COMMENT '&#1585;&#1602;&#1605; &#1575;&#1604;&#1587;&#1591;&#1585;',
  `IdService` varchar(11) NOT NULL COMMENT '&#1585;&#1602;&#1605; &#1575;&#1604;&#1582;&#1583;&#1605;&#1577;',
  `UserId` varchar(11) NOT NULL COMMENT '&#1585;&#1602;&#1605; &#1575;&#1604;&#1605;&#1587;&#1578;&#1582;&#1583;&#1605; &#1605;&#1606; &#1580;&#1583;&#1608;&#1604; &#1575;&#1604;&#1605;&#1587;&#1578;&#1582;&#1583;&#1605;&#1610;&#1606;',
  `PartnerSite` varchar(1024) NOT NULL COMMENT '&#1605;&#1608;&#1602;&#1593; &#1575;&#1604;&#1588;&#1585;&#1610;&#1603; &#1575;&#1604;&#1582;&#1575;&#1585;&#1580;&#1610;',
  `PartnerId` varchar(11) NOT NULL COMMENT '&#1585;&#1602;&#1605; &#1575;&#1604;&#1588;&#1585;&#1610;&#1603; &#1575;&#1604;&#1582;&#1575;&#1585;&#1580;&#1610;',
  `PartnerKey` varchar(11) NOT NULL COMMENT '&#1603;&#1608;&#1583; &#1575;&#1604;&#1588;&#1585;&#1610;&#1603; &#1575;&#1604;&#1582;&#1575;&#1585;&#1580;&#1610;',
  `Runing` varchar(1) NOT NULL COMMENT '&#1607;&#1604; &#1607;&#1584;&#1607; &#1575;&#1604;&#1582;&#1583;&#1605;&#1577; &#1588;&#1594;&#1575;&#1604;&#1577; &#1576;&#1575;&#1604;&#1606;&#1587;&#1576;&#1577; &#1604;&#1607;&#1567;',
  `AdminOk` varchar(1) NOT NULL,
  PRIMARY KEY (`SpId`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='&#1575;&#1604;&#1588;&#1585;&#1603;&#1575;&#1569; &#1575;&#1';

DROP TABLE IF EXISTS themes;
CREATE TABLE `themes` (
  `ThemeName` varchar(100) NOT NULL COMMENT 'اسم مجلد الشكل',
  `Active` varchar(1) NOT NULL COMMENT '  او محذوف نشط او لا',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `License` text NOT NULL COMMENT 'رقم ترخيص الدعم الفني',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  PRIMARY KEY (`ThemeName`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `themes` VALUES
('Default', '1', '2011-05-13 06:53:56', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', ''),
('tech', '1', '2011-05-13 06:53:56', '2.5', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==MDAwMC0wMC0wMC3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1cGMtaXQtbWFuYWdlcnx8QU5Z', ''),
('mattress', '1', '0000-00-00 00:00:00', '0', '', ''),
('foma', '1', '0000-00-00 00:00:00', '0', '9c9AwMDowMDowMA==694338bc8475ec94MDAwMC0wMC0wMCAwMDowMDowMA==888', ''),
('Fomaco', '0', '0000-00-00 00:00:00', '0', '', ''),
('nabisheeth', '0', '0000-00-00 00:00:00', '0', '', '');

DROP TABLE IF EXISTS update;
;

INSERT INTO `update` VALUES;

DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
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
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='اسماء المستخدمين للموقع';

INSERT INTO `users` VALUES
('20070000001', '20070000001', 'Y-m-d H:i:s', 'محسن', 'mhndm', 'حيدر', 'نور الدين الموسوي', '2007-08-20', '1', '+2', 'LB', 'Beiruth', '123', 'asds', '9618', '9618', '9618324234324', '9618324234324', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2011-02-16 08:40:23', 'fe80::a998:ae3:', '', '', '', 'Arabic', '', '3110', 'http://www.gravatar.com/avatar/829546e9372b7889552499e738bcbddf?s=80&d=mm&r=g', 'mhndm@yahoo.com', 'www.mysite.com', '0', 'tech', '<p>      mhndm </p><p>Information Technologie&nbsp;</p>', '1', '1', '2007-08-20 09:35:07', '1', '1', '1', '1', '', '1', '0', 'kapffhcs4lg55pi8qmmnka7hp1'),
('20070000000', '20070000000', 'Y-m-d H:i:s', 'Guest', 'Guest', 'parent', 'family', '0000-00-00', '1', '+2', 'US', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2011-02-16 08:40:23', 'fe80::a998:ae3:', 'None', 'None', 'None', 'Arabic', '12:00-16:00', '8640', '', 'None', 'None', '0', 'Default', 'Guest', '1', '1', '0000-00-00 00:00:00', '0', '0', '0', '0', '', '1', '0', 'ica01vgt6g16fpp19a1avq5u96'),
('200700000-1', '200700000-1', 'Y-m-d H:i:s', 'مدير', 'admin', 'مدير', 'الموقع', '1900-05-10', '1', '2', 'IR', 'beiruth', '', '', '', '', '', '', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2011-05-12 11:56:56', 'fe80::a998:ae3:', 'Computer', 'Administrator', 'IT', 'Arabic', '12:00-16:00', '2592000', 'images/avatars/cal.jpg', 'user@phptransformer.com', 'www.phptransformer.com', '0', 'tech', 'ADMINISTRATOR', '1', '1', '2007-05-10 13:48:47', '1', '1', '1', '1', '', '1', '0', '4541a41d91b7550e6fff687bd5a2ecd5'),
('20110000005', '20070000001', 'Y-m-d H:i:s', 'xxx', 'xxx', '', 'xxx', '0000-00-00', '', '', 'xx', '', '', '', '', '', '', '', 'b1fe5b47ef35884f35936c77330b6c2c', '2011-03-01 08:28:23', 'fe80::a998:ae3:', '', '', '', 'Arabic', '', '86400', '', 'xxx@xx.xxx', '', '0', 'Default', '', '0', '1', '2011-03-01 08:28:23', '0', '0', '0', '1', '338491882d54a2094afca4c40bdaa7ef', '1', '1', 'g8u86et6njqmrfbpv1kdim3b10'),
('20110000006', '20070000001', 'Y-m-d H:i:s', 'ASWDASD', 'ASDSA', ' ', 'ASDSAD', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', 'ASDASD@ASDSAD.COM', ' ', '0', 'Default', ' ', '0', '1', '2011-03-09 15:05:25', '0', '0', '1', '1', '1', '1', '1', ''),
('20110000007', '20070000001', 'Y-m-d H:i:s', 'شسي سي', 'سشي سشي', ' ', 'شسي سي ', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', 'asdsad@asdsa.com', ' ', '0', 'Default', ' ', '0', '1', '2011-03-09 15:51:14', '0', '0', '1', '1', '1', '1', '1', ''),
('20110000008', '20070000001', 'Y-m-d H:i:s', 'شسيسشي', 'فغعغفع', ' ', 'ببلبيل', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', '250cf8b51c773f3f8dc8b4be867a9a02', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', 'sadsad@فففف.com', ' ', '0', 'Default', ' ', '0', '1', '2011-03-09 15:51:29', '0', '0', '1', '1', '1', '1', '1', ''),
('20110000009', '20070000001', 'Y-m-d H:i:s', 'cxbvxcvbcxvbdft', 'sdsadsabnm', '', 'ffgfdg', '0000-00-00', '', '', 'xx', '', '', '', '', '', '', '', '202cb962ac59075b964b07152d234b70', '2011-04-20 09:37:35', 'fe80::a998:ae3:', '', '', '', 'Arabic', '', '86400', '', 'asdsad@asds.com', '', '0', 'Default', '', '0', '1', '2011-04-20 09:37:35', '0', '0', '0', '1', 'e12b0a9b209688e99d62967a996259c2', '1', '', ''),
('20110000004', '20070000001', ' H:i:s', 'حسين', 'ali.sms', '', 'صليبي', '0000-00-00', '', '', 'xx', '', '', '', '', '', '', '', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2011-02-16 15:25:49', 'fe80::a998:ae3:', '', '', '', 'English', '', '86400', '', 'ali.sms@foma-co.com', '', '0', 'Default', '', '0', '1', '2011-02-16 15:25:49', '0', '0', '0', '1', 'f26ea0c9dca89865159f378bb8845258', '1', '1', '614d07fb7446889a89bc4a28d4cb7897'),
('20110000010', '20070000001', 'Y-m-d H:i:s', 'nmnmnm', 'nmnmnmnm', '', 'nmnmn', '0000-00-00', '', '', 'xx', '', '', '', '', '', '', '', '1226351087b4af98010b0edd1c6282c9', '2011-04-20 09:39:38', 'fe80::a998:ae3:', '', '', '', 'Arabic', '', '86400', '', 'nmnmn@sdfdsf.com', '', '0', 'Default', '', '0', '1', '2011-04-20 09:39:38', '0', '0', '0', '1', 'e25319c0dcd64b022f348a3d5c1fb5a4', '1', '', ''),
('20110000011', '20070000001', 'Y-m-d H:i:s', '', '', ' ', '', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'd41d8cd98f00b204e9800998ecf8427e', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', ' ', '0', 'Default', ' ', '0', '1', '2011-05-10 11:56:32', '0', '0', '1', '1', '1', '', '', '');

DROP TABLE IF EXISTS userslog;
CREATE TABLE `userslog` (
  `NickName` varchar(15) NOT NULL COMMENT 'اسم المستخدم',
  `Gmt` datetime NOT NULL COMMENT 'الوقت حسب غرينتش',
  `IpNbr` varchar(15) NOT NULL COMMENT 'رقم الايبي',
  `SessionId` varchar(35) DEFAULT NULL,
  `FromPage` varchar(256) NOT NULL COMMENT 'الصفحة التي اتى منها',
  `CurrentPage` varchar(256) NOT NULL COMMENT 'الصفحة الحالية'
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */ COMMENT='لوغ  دخول المستخدمين';

INSERT INTO `userslog` VALUES
('Guest', '2011-05-12 11:20:50', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', '', ''),
('Guest', '2011-05-12 11:20:50', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 13:20:36', 'fe80::a998:ae3:', 'gh5v5r2a8ufng2fj05bk9nii74', '', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', '', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 13:20:36', 'fe80::a998:ae3:', 'gh5v5r2a8ufng2fj05bk9nii74', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', '', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', '', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', '', ''),
('Guest', '2011-05-12 13:20:49', 'fe80::a998:ae3:', 'pkplq2oud42ob28hfervjpc8p2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', 'http://pc-it-manager/phptransformer/Prog-pages_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', '', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', 'http://pc-it-manager/phptransformer/Prog-getlicense_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', '', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', 'http://pc-it-manager/phptransformer/Prog-getlicense_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', '', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', 'http://pc-it-manager/phptransformer/Prog-getlicense_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', '', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', 'http://pc-it-manager/phptransformer/Prog-getlicense_Lang-Arabic_nl-1.pt', ''),
('Guest', '2011-05-12 16:19:35', 'fe80::a998:ae3:', 'r53clftpdl7tqbps5v6f7jf9j2', '', '');

DROP TABLE IF EXISTS xxtest;
CREATE TABLE `xxtest` (
  `ID` int(11) NOT NULL,
  `NAME` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM /*!40101 DEFAULT CHARSET=utf8 */;

INSERT INTO `xxtest` VALUES
(1, 'ONE'),
(2, 'TWO');

